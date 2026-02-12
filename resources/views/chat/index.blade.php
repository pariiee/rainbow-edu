<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Rainbow Edu</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 25px;
            height: 90vh;
        }

        /* Sidebar Guru */
        .sidebar {
            background: white;
            border-radius: 24px;
            padding: 25px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .sidebar h3 {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .guru-list {
            flex: 1;
            overflow-y: auto;
        }

        .guru-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 8px;
        }

        .guru-item:hover {
            background: #f7fafc;
        }

        .guru-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .guru-avatar {
            width: 40px;
            height: 40px;
            background: #e2e8f0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #4a5568;
        }

        .guru-item.active .guru-avatar {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .guru-info {
            flex: 1;
        }

        .guru-name {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 2px;
        }

        .guru-type {
            font-size: 12px;
            color: #718096;
        }

        .guru-item.active .guru-type {
            color: rgba(255,255,255,0.9);
        }

        /* Chat Area */
        .chat-area {
            background: white;
            border-radius: 24px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .chat-header {
            padding: 25px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .chat-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 600;
        }

        .chat-info {
            flex: 1;
        }

        .chat-name {
            font-size: 18px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .chat-status {
            font-size: 13px;
            color: #718096;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .chat-messages {
            flex: 1;
            padding: 25px;
            overflow-y: auto;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .message {
            display: flex;
            margin-bottom: 10px;
        }

        .message.sent {
            justify-content: flex-end;
        }

        .message.received {
            justify-content: flex-start;
        }

        .message-bubble {
            max-width: 70%;
            padding: 14px 18px;
            border-radius: 18px;
            position: relative;
        }

        .message.sent .message-bubble {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .message.received .message-bubble {
            background: white;
            color: #2d3748;
            border-bottom-left-radius: 4px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .message-text {
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 4px;
        }

        .message-time {
            font-size: 11px;
            opacity: 0.7;
            text-align: right;
        }

        .chat-input {
            padding: 25px;
            border-top: 2px solid #f0f0f0;
            background: white;
        }

        .input-group {
            display: flex;
            gap: 15px;
        }

        .input-group input {
            flex: 1;
            padding: 16px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 16px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .btn-send {
            padding: 16px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-send:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-back {
            padding: 12px 20px;
            background: #f0f0f0;
            color: #666;
            border: none;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-right: 15px;
        }

        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #718096;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
            
            .message-bubble {
                max-width: 85%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar Daftar Guru (khusus Orang Tua) -->
        @if(auth()->user()->role_type == 'orang_tua')
        <div class="sidebar">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 25px;">
                <a href="{{ route('orangtua.home') }}" class="btn-back" style="padding: 8px 16px;">
                    ←
                </a>
                <h3>Daftar Guru</h3>
            </div>
            
            <div class="guru-list">
                @forelse($guruList as $guru)
                <a href="{{ route('chat.show', [$siswa->id, $guru->id]) }}" 
                   class="guru-item {{ $guru->id == $penerimaId ? 'active' : '' }}"
                   style="text-decoration: none;">
                    <div class="guru-avatar">
                        {{ strtoupper(substr($guru->name, 0, 1)) }}
                    </div>
                    <div class="guru-info">
                        <div class="guru-name">{{ $guru->name }}</div>
                        <div class="guru-type">{{ $guru->guru_type }}</div>
                    </div>
                </a>
                @empty
                <div style="text-align: center; padding: 30px 0; color: #718096;">
                    <p>Tidak ada guru tersedia</p>
                </div>
                @endforelse
            </div>
            
            <div style="margin-top: 20px; padding-top: 20px; border-top: 2px solid #f0f0f0;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 40px; height: 40px; background: #e2e8f0; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        {{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-weight: 600; font-size: 14px;">{{ $siswa->nama_lengkap }}</div>
                        <div style="font-size: 12px; color: #718096;">{{ $siswa->layanan }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Chat Area -->
        <div class="chat-area">
            @if(isset($penerimaId) && $penerimaId)
                @php
                    $lawanBicara = App\Models\User::find($penerimaId);
                @endphp
                
                <div class="chat-header">
                    @if(auth()->user()->role_type == 'guru')
                    <a href="{{ route('guru.paud.home') }}" class="btn-back">
                        ←
                    </a>
                    @endif
                    
                    <div class="chat-avatar">
                        {{ strtoupper(substr($lawanBicara->name, 0, 1)) }}
                    </div>
                    <div class="chat-info">
                        <div class="chat-name">{{ $lawanBicara->name }}</div>
                        <div class="chat-status">
                            <span style="display: inline-block; width: 8px; height: 8px; background: #38a169; border-radius: 50%;"></span>
                            {{ auth()->user()->role_type == 'orang_tua' ? 'Guru ' . $lawanBicara->guru_type : 'Orang Tua' }}
                        </div>
                    </div>
                    <div style="color: #718096; font-size: 14px;">
                        {{ $siswa->nama_lengkap }}
                    </div>
                </div>

                <div class="chat-messages" id="chat-messages">
                    @forelse($chats as $chat)
                        <div class="message {{ $chat->pengirim_id == auth()->id() ? 'sent' : 'received' }}">
                            <div class="message-bubble">
                                <div class="message-text">{{ $chat->pesan }}</div>
                                <div class="message-time">
                                    {{ $chat->created_at->format('H:i') }}
                                    @if($chat->pengirim_id == auth()->id() && $chat->is_read)
                                        ✓✓
                                    @elseif($chat->pengirim_id == auth()->id())
                                        ✓
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div style="font-size: 48px; margin-bottom: 15px;">💬</div>
                            <h3 style="margin-bottom: 8px; color: #2d3748;">Belum Ada Pesan</h3>
                            <p style="color: #718096;">Mulai percakapan dengan {{ $lawanBicara->name }}</p>
                        </div>
                    @endforelse
                </div>

                <div class="chat-input">
                    <form id="chat-form" method="POST" action="{{ route('chat.send') }}">
                        @csrf
                        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                        <input type="hidden" name="penerima_id" value="{{ $penerimaId }}">
                        <div class="input-group">
                            <input type="text" name="pesan" id="message-input" 
                                   placeholder="Tulis pesan..." autocomplete="off" required>
                            <button type="submit" class="btn-send">
                                <span>📤</span> Kirim
                            </button>
                        </div>
                    </form>
                </div>
            @else
                <div class="empty-state">
                    <div style="font-size: 64px; margin-bottom: 20px;">💬</div>
                    <h2 style="margin-bottom: 10px; color: #2d3748;">Pilih Guru</h2>
                    <p style="color: #718096;">Pilih guru untuk memulai percakapan</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Auto scroll ke bawah
        function scrollToBottom() {
            const messages = document.getElementById('chat-messages');
            if (messages) {
                messages.scrollTop = messages.scrollHeight;
            }
        }

        // Kirim pesan via AJAX
        document.getElementById('chat-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            const messageInput = document.getElementById('message-input');
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageInput.value = '';
                    
                    // Tambah pesan ke chat
                    const messagesDiv = document.getElementById('chat-messages');
                    const emptyState = messagesDiv.querySelector('.empty-state');
                    if (emptyState) emptyState.remove();
                    
                    const messageHtml = `
                        <div class="message sent">
                            <div class="message-bubble">
                                <div class="message-text">${data.chat.pesan}</div>
                                <div class="message-time">${new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})} ✓</div>
                            </div>
                        </div>
                    `;
                    messagesDiv.insertAdjacentHTML('beforeend', messageHtml);
                    scrollToBottom();
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Scroll ke bawah saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            scrollToBottom();
            
            // Refresh chat setiap 5 detik (nanti ganti dengan Pusher)
            setInterval(function() {
                location.reload();
            }, 5000);
        });
    </script>
</body>
</html>