<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Rainbow Edu</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        /* ── DEKORASI AWAN BACKGROUND ── */
        .clouds { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
        .cloud { position: absolute; opacity: 0.55; animation: drift linear infinite; }
        .cloud svg path { fill: white; }
        .cloud-1  { top: 4%;  left: -120px; width: 220px; animation-duration: 60s; animation-delay: 0s; }
        .cloud-2  { top: 12%; left: -80px;  width: 140px; animation-duration: 75s; animation-delay: -20s; opacity: 0.35; }
        .cloud-3  { top: 28%; left: -160px; width: 180px; animation-duration: 55s; animation-delay: -10s; }
        .cloud-4  { top: 55%; left: -100px; width: 160px; animation-duration: 80s; animation-delay: -35s; opacity: 0.3; }
        .cloud-5  { top: 72%; left: -140px; width: 200px; animation-duration: 65s; animation-delay: -5s; }
        .cloud-6  { top: 88%; left: -90px;  width: 130px; animation-duration: 70s; animation-delay: -45s; opacity: 0.35; }
        @keyframes drift { from { transform: translateX(0); } to { transform: translateX(calc(100vw + 300px)); } }
        .cloud-1 svg path { fill: #ffd6d6; } .cloud-2 svg path { fill: #ffe4cc; } .cloud-3 svg path { fill: #d6f5d6; }
        .cloud-4 svg path { fill: #cce5ff; } .cloud-5 svg path { fill: #e0d6ff; } .cloud-6 svg path { fill: #ffd6f5; }

        body {
            font-family: 'Nunito', sans-serif;
            background: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .app {
            width: 100%;
            max-width: 1100px;
            height: 96vh;
            max-height: 760px;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 8px 40px rgba(0,0,0,0.12);
            position: relative;
            z-index: 1;
        }

        /* ══ SIDEBAR ══ */
        .sidebar {
            width: 300px;
            min-width: 300px;
            border-right: 1px solid #e8ecf0;
            display: flex;
            flex-direction: column;
            background: #fff;
        }

        .sidebar-top {
            padding: 18px 16px 14px;
            border-bottom: 1px solid #e8ecf0;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .brand-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, #4f83f1, #7b5ea7);
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0;
        }

        .brand-title { font-size: 15px; font-weight: 700; color: #1a202c; }
        .brand-sub   { font-size: 11px; color: #9aa5b4; font-weight: 500; }

        .search-box {
            display: flex; align-items: center; gap: 8px;
            background: #f4f6f9; border-radius: 10px; padding: 8px 12px;
        }

        .search-box input {
            background: none; border: none; outline: none;
            font-size: 13px; color: #333; font-family: inherit; width: 100%;
        }

        .search-box input::placeholder { color: #aab0bc; }
        .search-icon { color: #aab0bc; font-size: 14px; flex-shrink: 0; }

        .section-title {
            font-size: 11px; font-weight: 700; color: #9aa5b4;
            text-transform: uppercase; letter-spacing: 0.07em;
            padding: 12px 16px 6px;
        }

        .guru-list { flex: 1; overflow-y: auto; }
        .guru-list::-webkit-scrollbar { width: 4px; }
        .guru-list::-webkit-scrollbar-thumb { background: #e0e4ea; border-radius: 4px; }

        .guru-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 16px; cursor: pointer;
            text-decoration: none; color: inherit;
            transition: background 0.15s; position: relative;
        }

        .guru-item:hover { background: #f7f9fc; }
        .guru-item.active { background: #eef2ff; }

        .guru-item.active::after {
            content: ''; position: absolute; left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 36px;
            background: #4f83f1; border-radius: 0 3px 3px 0;
        }

        .avatar {
            width: 42px; height: 42px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 15px; color: #fff;
            flex-shrink: 0; position: relative;
        }

        .online-ring {
            position: absolute; bottom: 1px; right: 1px;
            width: 11px; height: 11px;
            background: #44d98e; border-radius: 50%; border: 2px solid #fff;
        }

        .guru-meta { flex: 1; min-width: 0; }

        .guru-row1 {
            display: flex; justify-content: space-between; align-items: center;
        }

        .guru-name {
            font-size: 13.5px; font-weight: 700; color: #1a202c;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }

        .guru-item.active .guru-name { color: #4f83f1; }
        .guru-time { font-size: 11px; color: #b0bac6; margin-left: 6px; flex-shrink: 0; }

        .guru-sub {
            font-size: 12px; color: #9aa5b4;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 2px;
        }

        .sidebar-footer {
            padding: 12px 16px; border-top: 1px solid #e8ecf0;
            display: flex; align-items: center; gap: 10px;
        }

        .footer-avatar {
            width: 36px; height: 36px; border-radius: 50%; background: #e2e8f0;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px; color: #4a5568;
        }

        .footer-name { font-size: 13px; font-weight: 700; color: #1a202c; }
        .footer-sub  { font-size: 11px; color: #9aa5b4; }

        /* ══ CHAT MAIN ══ */
        .chat-main {
            flex: 1; display: flex; flex-direction: column;
            min-width: 0; background: #f7f9fc;
        }

        .chat-header {
            background: #fff; border-bottom: 1px solid #e8ecf0;
            padding: 0 20px; height: 64px;
            display: flex; align-items: center; gap: 12px; flex-shrink: 0;
        }

        .btn-back {
            background: none; border: none; color: #9aa5b4;
            cursor: pointer; padding: 6px 8px; border-radius: 8px;
            font-size: 16px; text-decoration: none;
            transition: all 0.15s; display: none; align-items: center;
        }

        .btn-back:hover { background: #f4f6f9; color: #555; }

        .header-info { flex: 1; min-width: 0; }
        .header-name { font-size: 15px; font-weight: 700; color: #1a202c; }

        .header-status {
            font-size: 12px; color: #44d98e;
            display: flex; align-items: center; gap: 5px; margin-top: 1px;
        }

        .dot-pulse { width: 7px; height: 7px; background: #44d98e; border-radius: 50%; }

        .siswa-badge {
            background: #eef2ff; color: #4f83f1;
            font-size: 12px; font-weight: 600;
            padding: 5px 12px; border-radius: 20px;
            display: flex; align-items: center; gap: 5px; white-space: nowrap;
        }

        .header-action {
            width: 36px; height: 36px; background: none; border: none;
            border-radius: 9px; color: #9aa5b4; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; transition: all 0.15s;
        }

        .header-action:hover { background: #f4f6f9; color: #555; }

        /* Messages */
        .chat-messages {
            flex: 1; overflow-y: auto;
            padding: 20px 24px;
            display: flex; flex-direction: column; gap: 3px;
        }

        .chat-messages::-webkit-scrollbar { width: 4px; }
        .chat-messages::-webkit-scrollbar-thumb { background: #d4dae3; border-radius: 4px; }

        .date-sep {
            display: flex; align-items: center; gap: 10px;
            margin: 12px 0 8px;
        }

        .date-sep::before, .date-sep::after {
            content: ''; flex: 1; height: 1px; background: #e8ecf0;
        }

        .date-sep span {
            font-size: 11px; font-weight: 600; color: #b0bac6;
            background: #f7f9fc; padding: 3px 12px; border-radius: 20px;
        }

        .msg {
            display: flex; align-items: flex-end; gap: 8px;
        }

        .msg.new-msg { animation: pop-in 0.18s ease; }

        @keyframes pop-in {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .msg.sent { flex-direction: row-reverse; }

        .msg-av {
            width: 26px; height: 26px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 10px; font-weight: 700; color: #fff; flex-shrink: 0;
        }

        .msg.sent .msg-av,
        .msg.consec .msg-av { visibility: hidden; }

        .bubble {
            max-width: 65%;
            padding: 9px 13px 7px;
            border-radius: 14px; position: relative;
        }

        .msg.sent .bubble {
            background: #4f83f1; color: #fff;
            border-bottom-right-radius: 4px;
        }

        .msg.sent.consec .bubble {
            border-bottom-right-radius: 14px;
            border-top-right-radius: 4px;
        }

        .msg.received .bubble {
            background: #fff; color: #1a202c;
            border-bottom-left-radius: 4px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }

        .msg.received.consec .bubble {
            border-bottom-left-radius: 14px;
            border-top-left-radius: 4px;
        }

        .bubble-text {
            font-size: 13.5px; line-height: 1.5;
            word-break: break-word; padding-right: 44px;
        }

        .bubble-foot {
            position: absolute; bottom: 6px; right: 10px;
            display: flex; align-items: center; gap: 3px;
        }

        .msg-time { font-size: 10px; color: rgba(255,255,255,0.65); white-space: nowrap; }
        .msg.received .msg-time { color: #b0bac6; }

        .tick { font-size: 11px; color: rgba(255,255,255,0.6); line-height: 1; }
        .tick.read { color: #a8d4ff; }

        /* Empty */
        .no-chat {
            flex: 1; display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 12px;
            color: #9aa5b4; text-align: center; padding: 32px;
        }

        .no-chat-icon {
            width: 72px; height: 72px; background: #eef2ff; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; font-size: 32px;
        }

        .no-chat h3 { font-size: 17px; color: #2d3748; font-weight: 700; }
        .no-chat p  { font-size: 13px; color: #9aa5b4; max-width: 220px; line-height: 1.6; }

        /* Input */
        .chat-input {
            background: #fff; border-top: 1px solid #e8ecf0;
            padding: 12px 16px; flex-shrink: 0;
        }

        .input-row { display: flex; align-items: center; gap: 10px; }

        .input-side {
            width: 38px; height: 38px; background: none; border: none;
            border-radius: 50%; color: #9aa5b4; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; transition: all 0.15s; flex-shrink: 0;
        }

        .input-side:hover { background: #f4f6f9; color: #555; }

        .input-wrap {
            flex: 1; background: #f4f6f9; border-radius: 22px;
            display: flex; align-items: center; padding: 0 16px;
            transition: box-shadow 0.2s;
        }

        .input-wrap:focus-within {
            box-shadow: 0 0 0 2px rgba(79,131,241,0.25);
            background: #fff;
        }

        .input-wrap input {
            flex: 1; background: none; border: none; outline: none;
            font-size: 13.5px; font-family: inherit; color: #1a202c; padding: 11px 0;
        }

        .input-wrap input::placeholder { color: #aab0bc; }

        .send-btn {
            width: 42px; height: 42px; background: #4f83f1; border: none;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.15s; flex-shrink: 0;
        }

        .send-btn:hover { background: #3a6de0; transform: scale(1.05); }
        .send-btn:active { transform: scale(0.95); }
        .send-btn svg { width: 17px; height: 17px; fill: #fff; transform: translateX(1px); }

        @media (max-width: 680px) {
            body { background: #fff; align-items: flex-start; }
            .app { max-width: 100%; height: 100vh; max-height: 100vh; border-radius: 0; box-shadow: none; }
            .sidebar { display: none; }
            .btn-back { display: flex !important; }
        }
    </style>
<script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

<!-- Dekorasi awan melayang -->
<div class="clouds">
    <div class="cloud cloud-1"><svg viewBox="0 0 200 80" xmlns="http://www.w3.org/2000/svg"><path d="M30,60 Q10,60 10,45 Q10,30 25,28 Q22,10 40,10 Q52,10 58,20 Q65,8 80,8 Q100,8 105,25 Q118,20 130,28 Q145,25 150,38 Q160,38 160,50 Q160,62 148,62 Z"/></svg></div>
    <div class="cloud cloud-2"><svg viewBox="0 0 140 56" xmlns="http://www.w3.org/2000/svg"><path d="M20,42 Q6,42 6,30 Q6,18 18,17 Q15,4 30,4 Q40,4 45,12 Q52,3 65,3 Q82,3 86,17 Q96,14 104,22 Q114,20 116,30 Q122,30 122,40 Q122,48 112,48 Z"/></svg></div>
    <div class="cloud cloud-3"><svg viewBox="0 0 180 70" xmlns="http://www.w3.org/2000/svg"><path d="M28,54 Q8,54 8,40 Q8,26 22,24 Q18,8 36,8 Q48,8 54,18 Q62,6 78,6 Q100,6 104,22 Q116,18 126,26 Q140,22 144,36 Q154,36 154,48 Q154,58 142,60 Z"/></svg></div>
    <div class="cloud cloud-4"><svg viewBox="0 0 160 64" xmlns="http://www.w3.org/2000/svg"><path d="M24,50 Q6,50 6,36 Q6,22 20,20 Q16,6 34,6 Q46,6 52,16 Q58,4 74,4 Q96,4 100,20 Q110,16 120,24 Q132,20 136,34 Q146,34 146,44 Q146,56 134,56 Z"/></svg></div>
    <div class="cloud cloud-5"><svg viewBox="0 0 200 76" xmlns="http://www.w3.org/2000/svg"><path d="M32,58 Q10,58 10,44 Q10,30 24,28 Q20,10 40,10 Q54,10 60,20 Q68,8 84,8 Q108,8 112,26 Q122,22 134,30 Q148,26 152,40 Q164,40 164,52 Q164,62 150,64 Z"/></svg></div>
    <div class="cloud cloud-6"><svg viewBox="0 0 130 52" xmlns="http://www.w3.org/2000/svg"><path d="M18,40 Q4,40 4,28 Q4,16 16,15 Q12,2 28,2 Q38,2 44,10 Q50,2 62,2 Q80,2 84,16 Q94,12 100,20 Q110,18 112,28 Q118,28 118,38 Q118,46 108,46 Z"/></svg></div>
</div>

<div class="app">

    {{-- ════ SIDEBAR ════ --}}
    @if(auth()->user()->role_type == 'orang_tua')
    <aside class="sidebar">
        <div class="sidebar-top">
            <div class="sidebar-brand">
                <div class="brand-icon"><i class="ph-duotone ph-rainbow" style="color: #ec4899;"></i></div>
                <div>
                    <div class="brand-title">Rainbow Edu</div>
                    <div class="brand-sub">Pesan & Konsultasi</div>
                </div>
            </div>
            <div class="search-box">
                <span class="search-icon"><i class="ph-duotone ph-magnifying-glass"></i></span>
                <input type="text" id="searchGuru" placeholder="Cari guru...">
            </div>
        </div>

        <div class="section-title">Daftar Guru</div>

        <div class="guru-list" id="guruList">
            @forelse($guruList as $guru)
                @php
                    $palette = ['#4f83f1','#e05c97','#f0944d','#44b89e','#7b5ea7','#e6534a'];
                    $c = $palette[$loop->index % count($palette)];
                @endphp
                <a href="{{ route('chat.show', [$siswa->id, $guru->id]) }}"
                   class="guru-item {{ $guru->id == ($penerimaId ?? null) ? 'active' : '' }}"
                   data-name="{{ strtolower($guru->name) }}">
                    <div class="avatar" style="background:{{ $c }}">
                        {{ strtoupper(substr($guru->name, 0, 1)) }}
                        <span class="online-ring"></span>
                    </div>
                    <div class="guru-meta">
                        <div class="guru-row1">
                            <span class="guru-name">{{ $guru->name }}</span>
                            <span class="guru-time">Aktif</span>
                        </div>
                        <div class="guru-sub">Guru {{ $guru->guru_type ?? '' }}</div>
                    </div>
                </a>
            @empty
                <div style="padding:30px;text-align:center;color:#9aa5b4;font-size:13px;">
                    Belum ada guru terdaftar
                </div>
            @endforelse
        </div>

        <div class="sidebar-footer">
            <div class="footer-avatar">
                {{ strtoupper(substr($siswa->nama_lengkap, 0, 1)) }}
            </div>
            <div>
                <div class="footer-name">{{ $siswa->nama_lengkap }}</div>
                <div class="footer-sub">{{ $siswa->layanan }}</div>
            </div>
        </div>
    </aside>
    @endif

    {{-- ════ CHAT MAIN ════ --}}
    <main class="chat-main">

        @if(isset($penerimaId) && $penerimaId)
            @php
                $lawanBicara = App\Models\User::find($penerimaId);
                $hp = ['#4f83f1','#e05c97','#f0944d','#44b89e','#7b5ea7'];
                $hc = $hp[($lawanBicara->id ?? 0) % count($hp)];
                $lastId = $chats->last()?->id ?? 0;
            @endphp

            {{-- Header --}}
            <header class="chat-header">
                <a href="javascript:void(0)" onclick="goBack()" class="btn-back">&#8592;</a>
                <div class="avatar" style="width:40px;height:40px;font-size:14px;background:{{ $hc }}">
                    {{ strtoupper(substr($lawanBicara->name, 0, 1)) }}
                </div>
                <div class="header-info">
                    <div class="header-name">{{ $lawanBicara->name }}</div>
                    <div class="header-status">
                        <span class="dot-pulse"></span>
                        @if(auth()->user()->role_type == 'orang_tua')
                            Guru {{ $lawanBicara->guru_type ?? '' }}
                        @else
                            {{ $lawanBicara->role_type == 'orang_tua' ? 'Orang Tua' : 'Guru' }}
                        @endif
                    </div>
                </div>
                <div class="siswa-badge"><i class="ph-duotone ph-user-focus"></i> {{ $siswa->nama_lengkap }}</div>
                <button class="header-action" title="Cari"><i class="ph-duotone ph-magnifying-glass"></i></button>
                <button class="header-action" title="Opsi">&#8230;</button>
            </header>

            {{-- Messages --}}
            <div class="chat-messages" id="chat-messages">
                @forelse($chats as $i => $chat)
                    @php
                        $isSent   = $chat->pengirim_id == auth()->id();
                        $isConsec = $i > 0
                                 && $chats[$i-1]->pengirim_id == $chat->pengirim_id
                                 && $chat->created_at->diffInMinutes($chats[$i-1]->created_at) < 5;
                        $isNewDay = $i == 0
                                 || $chats[$i-1]->created_at->format('Y-m-d') != $chat->created_at->format('Y-m-d');
                        $avp = ['#4f83f1','#e05c97','#f0944d','#44b89e','#7b5ea7'];
                        $avc = $avp[($chat->pengirim_id ?? 0) % count($avp)];
                    @endphp

                    @if($isNewDay)
                    <div class="date-sep">
                        <span>
                            @if($chat->created_at->isToday()) Hari Ini
                            @elseif($chat->created_at->isYesterday()) Kemarin
                            @else {{ $chat->created_at->translatedFormat('d F Y') }}
                            @endif
                        </span>
                    </div>
                    @endif

                    <div class="msg {{ $isSent ? 'sent' : 'received' }} {{ $isConsec ? 'consec' : '' }}"
                         data-id="{{ $chat->id }}"
                         style="margin-bottom:{{ $isConsec ? '2px' : '6px' }}">
                        @if(!$isSent)
                            <div class="msg-av" style="background:{{ $avc }}">
                                {{ strtoupper(substr($lawanBicara->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="bubble">
                            <div class="bubble-text">{{ $chat->pesan }}</div>
                            <div class="bubble-foot">
                                <span class="msg-time">{{ $chat->created_at->format('H:i') }}</span>
                                @if($isSent)
                                    <span class="tick {{ $chat->is_read ? 'read' : '' }}">
                                        {{ $chat->is_read ? '✓✓' : '✓' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-chat" id="empty-state">
                        <div class="no-chat-icon"><i class="ph-duotone ph-chat-teardrop-dots"></i></div>
                        <h3>Mulai Percakapan</h3>
                        <p>Kirim pesan pertama kepada {{ $lawanBicara->name }}</p>
                    </div>
                @endforelse
            </div>

            {{-- Input --}}
            <div class="chat-input">
                <form class="input-row" id="chat-form" method="POST" action="{{ route('chat.send') }}">
                    @csrf
                    <input type="hidden" name="siswa_id"    value="{{ $siswa->id }}">
                    <input type="hidden" name="penerima_id" value="{{ $penerimaId }}">
                    <button type="button" class="input-side" title="Emoji"><i class="ph-duotone ph-smiley"></i></button>
                    <div class="input-wrap">
                        <input type="text"
                               name="pesan"
                               id="message-input"
                               placeholder="Tulis pesan..."
                               autocomplete="off"
                               required>
                    </div>
                    <button type="button" class="input-side" title="Lampiran"><i class="ph-duotone ph-paperclip"></i></button>
                    <button type="submit" class="send-btn" id="send-btn">
                        <svg viewBox="0 0 24 24"><path d="M2 21L23 12 2 3v7l15 2-15 2z"/></svg>
                    </button>
                </form>
            </div>

            {{-- Data untuk JS --}}
            <script>
                // Semua data yang dibutuhkan JS disimpan di sini, digenerate sekali oleh Blade
                const CHAT_CONFIG = {
                    lastId:       {{ $lastId }},
                    siswaId:      {{ $siswa->id }},
                    penerimaId:   {{ $penerimaId }},
                    currentUserId:{{ auth()->id() }},
                    pollUrl:      "{{ route('chat.poll') }}",  // endpoint polling (lihat petunjuk di bawah)
                    senderInitial: "{{ strtoupper(substr($lawanBicara->name, 0, 1)) }}",
                    avColors:     ['#4f83f1','#e05c97','#f0944d','#44b89e','#7b5ea7'],
                };
            </script>

        @else
            <div class="no-chat" style="flex:1">
                <div class="no-chat-icon"><i class="ph-duotone ph-chat-teardrop-dots"></i></div>
                <h3>Rainbow Edu Chat</h3>
                <p>Pilih guru dari daftar untuk memulai percakapan.</p>
            </div>
        @endif

    </main>
</div>

<script>
    /* ── Utilities ── */
    function goBack() { window.history.back(); }

    function scrollBottom(smooth) {
        const el = document.getElementById('chat-messages');
        if (!el) return;
        el.scrollTo({ top: el.scrollHeight, behavior: smooth ? 'smooth' : 'auto' });
    }

    function esc(t) {
        const d = document.createElement('div');
        d.textContent = t;
        return d.innerHTML;
    }

    function formatTime(dateStr) {
        const d = new Date(dateStr);
        return d.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    }

    /* ── Build bubble HTML ── */
    function buildBubble(chat, isSent, isConsec) {
        const av    = CHAT_CONFIG.avColors[(chat.pengirim_id ?? 0) % CHAT_CONFIG.avColors.length];
        const avHtml = isSent ? '' : `<div class="msg-av" style="background:${av}">${esc(CHAT_CONFIG.senderInitial)}</div>`;
        const tick   = isSent ? `<span class="tick">${chat.is_read ? '✓✓' : '✓'}</span>` : '';
        const mbottom = isConsec ? '2px' : '6px';

        return `
            <div class="msg ${isSent ? 'sent' : 'received'} ${isConsec ? 'consec' : ''} new-msg"
                 data-id="${chat.id}"
                 style="margin-bottom:${mbottom}">
                ${avHtml}
                <div class="bubble">
                    <div class="bubble-text">${esc(chat.pesan)}</div>
                    <div class="bubble-foot">
                        <span class="msg-time">${formatTime(chat.created_at)}</span>
                        ${tick}
                    </div>
                </div>
            </div>`;
    }

    /* ── Send message ── */
    document.getElementById('chat-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const input   = document.getElementById('message-input');
        const sendBtn = document.getElementById('send-btn');
        if (!input.value.trim()) return;

        sendBtn.style.opacity = '0.5';
        sendBtn.disabled = true;

        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (!data.success) return;
            input.value = '';

            const box   = document.getElementById('chat-messages');
            const empty = document.getElementById('empty-state');
            if (empty) empty.remove();

            // Append hanya bubble baru, tanpa replace innerHTML
            box.insertAdjacentHTML('beforeend', buildBubble(data.chat, true, false));
            CHAT_CONFIG.lastId = data.chat.id;
            scrollBottom(true);
        })
        .catch(console.error)
        .finally(() => { sendBtn.style.opacity = '1'; sendBtn.disabled = false; });
    });

    /* ── Enter to send ── */
    document.getElementById('message-input')?.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('chat-form').dispatchEvent(new Event('submit'));
        }
    });

    /* ── Polling: HANYA pesan baru setelah lastId ──
       Tambahkan route di Laravel:
         Route::get('/chat/poll', [ChatController::class, 'poll'])->name('chat.poll');

       Contoh method poll() di ChatController:
         public function poll(Request $request) {
             $chats = Chat::where('siswa_id', $request->siswa_id)
                 ->where(function($q) use ($request) {
                     $q->where('pengirim_id', auth()->id())->where('penerima_id', $request->penerima_id)
                       ->orWhere('pengirim_id', $request->penerima_id)->where('penerima_id', auth()->id());
                 })
                 ->where('id', '>', $request->last_id)
                 ->orderBy('id')
                 ->get();
             return response()->json($chats);
         }
    ── */
    function pollNewMessages() {
        if (typeof CHAT_CONFIG === 'undefined') return;

        const params = new URLSearchParams({
            siswa_id:    CHAT_CONFIG.siswaId,
            penerima_id: CHAT_CONFIG.penerimaId,
            last_id:     CHAT_CONFIG.lastId,
        });

        fetch(`${CHAT_CONFIG.pollUrl}?${params}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(messages => {
            if (!messages.length) return;

            const box = document.getElementById('chat-messages');
            const empty = document.getElementById('empty-state');
            if (empty) empty.remove();

            // Cek apakah user sedang scroll di bawah
            const isAtBottom = box.scrollHeight - box.scrollTop - box.clientHeight < 80;

            messages.forEach((chat, i) => {
                const isSent   = chat.pengirim_id == CHAT_CONFIG.currentUserId;
                // isConsec: bandingkan dengan elemen terakhir di DOM
                const lastEl   = box.querySelector('.msg:last-child');
                const lastSenderId = lastEl ? parseInt(lastEl.dataset.senderId || '0') : 0;
                const isConsec = false; // sederhana, tidak konsecutif untuk pesan polling
                box.insertAdjacentHTML('beforeend', buildBubble(chat, isSent, isConsec));
                CHAT_CONFIG.lastId = chat.id;
            });

            if (isAtBottom) scrollBottom(true);
        })
        .catch(() => {}); // silent fail, coba lagi di interval berikutnya
    }

    /* ── Search guru ── */
    document.getElementById('searchGuru')?.addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#guruList .guru-item').forEach(el => {
            el.style.display = (el.dataset.name || '').includes(q) ? 'flex' : 'none';
        });
    });

    /* ── Init ── */
    document.addEventListener('DOMContentLoaded', function() {
        scrollBottom(false);

        // Polling ringan setiap 4 detik — hanya append pesan baru, TIDAK replace DOM
        if (typeof CHAT_CONFIG !== 'undefined') {
            setInterval(pollNewMessages, 4000);
        }
    });
</script>
</body>
</html>