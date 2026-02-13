<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BroadcastController extends Controller
{
    /**
     * Daftar broadcast
     */
    public function index(Request $request)
    {
        $query = Notification::with('creator')
                    ->orderBy('created_at', 'desc');
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $notifications = $query->paginate(10);
        
        return view('admin.broadcast.index', compact('notifications'));
    }

    /**
     * Form buat broadcast baru
     */
    public function create()
    {
        $gurus = User::where('role_type', 'guru')->get();
        $ortus = User::where('role_type', 'orang_tua')->get();
        
        return view('admin.broadcast.create', compact('gurus', 'ortus'));
    }

    /**
     * Store broadcast
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'target' => 'required|in:semua,guru,orang_tua,siswa,spesifik',
            'target_ids' => 'required_if:target,spesifik|array',
            'scheduled_at' => 'nullable|date|after_or_equal:now'
        ]);

        DB::beginTransaction();
        try {
            $notification = Notification::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'target' => $request->target,
                'target_ids' => $request->target == 'spesifik' ? $request->target_ids : null,
                'created_by' => auth()->id(),
                'scheduled_at' => $request->scheduled_at,
                'status' => $request->scheduled_at ? 'terjadwal' : 'draft'
            ]);

            // Jika langsung kirim
            if (!$request->scheduled_at && $request->has('send_now')) {
                $this->sendNotification($notification);
            }

            DB::commit();

            return redirect()->route('admin.broadcast.index')
                ->with('success', 'Broadcast berhasil ' . ($request->scheduled_at ? 'dijadwalkan' : 'disimpan'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat broadcast: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Detail broadcast
     */
    public function show($id)
    {
        $notification = Notification::with(['creator', 'users'])
                                   ->findOrFail($id);
                                   
        $stats = [
            'total' => $notification->users()->count(),
            'read' => $notification->users()->wherePivot('is_read', true)->count(),
            'unread' => $notification->users()->wherePivot('is_read', false)->count()
        ];
        
        return view('admin.broadcast.show', compact('notification', 'stats'));
    }

    /**
     * Kirim broadcast
     */
    public function send($id)
    {
        $notification = Notification::findOrFail($id);
        
        if ($notification->status == 'terkirim') {
            return response()->json([
                'success' => false,
                'message' => 'Broadcast sudah terkirim'
            ], 400);
        }

        $this->sendNotification($notification);

        return response()->json([
            'success' => true,
            'message' => 'Broadcast berhasil dikirim'
        ]);
    }

    /**
     * Delete broadcast
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Broadcast berhasil dihapus'
        ]);
    }

    /**
     * Send notification to users
     */
    private function sendNotification(Notification $notification)
    {
        $users = collect();
        
        switch ($notification->target) {
            case 'semua':
                $users = User::whereIn('role_type', ['guru', 'orang_tua'])->get();
                break;
            case 'guru':
                $users = User::where('role_type', 'guru')->get();
                break;
            case 'orang_tua':
                $users = User::where('role_type', 'orang_tua')->get();
                break;
            case 'siswa':
                // Akan diimplementasi nanti
                break;
            case 'spesifik':
                $users = User::whereIn('id', $notification->target_ids ?? [])->get();
                break;
        }

        foreach ($users as $user) {
            UserNotification::create([
                'notification_id' => $notification->id,
                'user_id' => $user->id,
                'is_read' => false
            ]);

            // TODO: Kirim email, WhatsApp, atau notifikasi realtime
        }

        $notification->update([
            'status' => 'terkirim',
            'sent_at' => now()
        ]);
    }

    /**
     * Statistik broadcast
     */
    public function stats()
    {
        $totalBroadcast = Notification::count();
        $sentToday = Notification::whereDate('sent_at', today())->count();
        $scheduled = Notification::where('status', 'terjadwal')->count();
        
        $topRead = Notification::withCount('users')
            ->orderBy('users_count', 'desc')
            ->limit(5)
            ->get();
            
        return view('admin.broadcast.stats', compact(
            'totalBroadcast',
            'sentToday',
            'scheduled',
            'topRead'
        ));
    }
}