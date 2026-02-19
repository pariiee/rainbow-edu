<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    /**
     * Show chat page for specific siswa and guru
     */
    public function show($siswaId, $guruId = null)
    {
        $user = Auth::user();
        $siswa = Siswa::with(['guru', 'orangTua'])->findOrFail($siswaId);
        
        // Validasi akses
        if ($user->role_type === 'orang_tua' && $siswa->orang_tua_id !== $user->id) {
            abort(403);
        }
        
        if ($user->role_type === 'guru' && $siswa->guru_id !== $user->id) {
            abort(403);
        }

        // Tentukan lawan bicara
        if ($user->role_type === 'orang_tua') {
            $guru = $siswa->guru;
            $penerimaId = $guruId ?? $guru->id;
        } else {
            $penerimaId = $siswa->orang_tua_id;
        }

        // Ambil semua chat
        $chats = Chat::with(['pengirim', 'penerima'])
                    ->where('siswa_id', $siswaId)
                    ->where(function($q) use ($user, $penerimaId) {
                        $q->where(function($q2) use ($user, $penerimaId) {
                            $q2->where('pengirim_id', $user->id)
                               ->where('penerima_id', $penerimaId);
                        })->orWhere(function($q2) use ($user, $penerimaId) {
                            $q2->where('pengirim_id', $penerimaId)
                               ->where('penerima_id', $user->id);
                        });
                    })
                    ->orderBy('created_at', 'asc')
                    ->get();

        // Mark unread messages as read
        Chat::where('siswa_id', $siswaId)
            ->where('penerima_id', $user->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        // Untuk orang tua, ambil daftar guru yang bisa di-chat
        $guruList = collect();
        if ($user->role_type === 'orang_tua') {
            $guruList = User::where('role_type', 'guru')
                          ->where('guru_type', $siswa->guru->guru_type ?? 'PAUD')
                          ->get();
        }

        return view('chat.index', compact('siswa', 'chats', 'penerimaId', 'guruList'));
    }

    /**
     * Send new message
     */
    public function send(Request $request)
    {
        $request->validate([
            'siswa_id'    => 'required|exists:siswa,id',
            'penerima_id' => 'required|exists:users,id',
            'pesan'       => 'required|string|max:1000'
        ]);

        $user  = Auth::user();
        $siswa = Siswa::findOrFail($request->siswa_id);

        // Validasi akses
        if ($user->role_type === 'orang_tua' && $siswa->orang_tua_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        if ($user->role_type === 'guru' && $siswa->guru_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $chat = Chat::create([
            'siswa_id'    => $request->siswa_id,
            'pengirim_id' => $user->id,
            'penerima_id' => $request->penerima_id,
            'pesan'       => $request->pesan,
            'is_read'     => false,
        ]);

        $chat->load(['pengirim', 'penerima']);

        // Broadcast event (nanti implementasi dengan Pusher)
        // event(new NewChatMessage($chat));

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'chat'    => $chat
            ]);
        }

        return back()->with('success', 'Pesan terkirim');
    }

    /**
     * Poll for new messages after a given ID.
     * Dipanggil oleh front-end setiap beberapa detik untuk mendapatkan
     * pesan baru tanpa me-reload seluruh halaman (menghindari kedip).
     *
     * GET /chat/poll?siswa_id=1&penerima_id=2&last_id=50
     */
    public function poll(Request $request)
    {
        $request->validate([
            'siswa_id'    => 'required|exists:siswa,id',
            'penerima_id' => 'required|exists:users,id',
            'last_id'     => 'required|integer|min:0',
        ]);

        $user = Auth::user();

        // Pastikan user boleh mengakses percakapan ini
        $siswa = Siswa::findOrFail($request->siswa_id);

        if ($user->role_type === 'orang_tua' && $siswa->orang_tua_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($user->role_type === 'guru' && $siswa->guru_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Ambil hanya pesan baru (id > last_id) dalam percakapan ini
        $newChats = Chat::where('siswa_id', $request->siswa_id)
            ->where(function ($q) use ($user, $request) {
                $q->where(function ($q2) use ($user, $request) {
                    $q2->where('pengirim_id', $user->id)
                       ->where('penerima_id', $request->penerima_id);
                })->orWhere(function ($q2) use ($user, $request) {
                    $q2->where('pengirim_id', $request->penerima_id)
                       ->where('penerima_id', $user->id);
                });
            })
            ->where('id', '>', $request->last_id)
            ->orderBy('id', 'asc')
            ->get();

        // Tandai pesan yang diterima sebagai sudah dibaca
        if ($newChats->isNotEmpty()) {
            Chat::where('siswa_id', $request->siswa_id)
                ->where('pengirim_id', $request->penerima_id)
                ->where('penerima_id', $user->id)
                ->where('is_read', false)
                ->update([
                    'is_read' => true,
                    'read_at' => now(),
                ]);
        }

        return response()->json($newChats);
    }

    /**
     * Get unread messages count
     */
    public function unreadCount()
    {
        $user = Auth::user();
        
        $count = Chat::where('penerima_id', $user->id)
                    ->where('is_read', false)
                    ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Mark messages as read
     */
    public function markAsRead(Request $request)
    {
        $request->validate([
            'siswa_id'    => 'required|exists:siswa,id',
            'pengirim_id' => 'required|exists:users,id'
        ]);

        Chat::where('siswa_id', $request->siswa_id)
            ->where('pengirim_id', $request->pengirim_id)
            ->where('penerima_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);

        return response()->json(['success' => true]);
    }
}