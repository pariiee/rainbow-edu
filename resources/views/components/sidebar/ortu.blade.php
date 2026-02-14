/* SIDEBAR */
<style>
.sidebar {
    width: 260px;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background: white;
    padding: 25px 20px;
    box-shadow: 4px 0 20px rgba(0,0,0,0.08);
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    margin-bottom: 30px;
}

.sidebar-header h2 {
    font-size: 22px;
    color: #333;
}

.sidebar-header p {
    font-size: 13px;
    color: #777;
}

.sidebar-menu {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.menu-item {
    padding: 14px 16px;
    border-radius: 12px;
    text-decoration: none;
    color: #444;
    font-weight: 500;
    transition: 0.2s;
}

.menu-item:hover {
    background: #f3f4f6;
}

.menu-item.active {
    background: linear-gradient(135deg,#667eea,#764ba2);
    color: white;
}

.menu-divider {
    height: 1px;
    background: #eee;
    margin: 15px 0;
}

.menu-logout {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: #ff4757;
    color: white;
    cursor: pointer;
    font-weight: 600;
}

/* CONTENT SHIFT */
.main-content {
    margin-left: 260px;
}
</style>


<div class="sidebar">

    <!-- LOGO -->
    <div class="sidebar-header">
        <h2>🎓 Rainbow Edu</h2>
        <p>Dashboard Orang Tua</p>
    </div>

    <!-- MENU -->
    <nav class="sidebar-menu">

        <a href="{{ route('orangtua.home') }}"
           class="menu-item {{ request()->routeIs('orangtua.home') ? 'active' : '' }}"> 
            🏠 Dashboard
        </a>

        <a href="{{ route('ortu.form') }}"
           class="menu-item {{ request()->routeIs('ortu.form') ? 'active' : '' }}">
            📝 Data Siswa
        </a>

        <a href="{{ route('ortu.jadwal.index') }}"
           class="menu-item {{ request()->routeIs('ortu.jadwal.*') ? 'active' : '' }}">
            📅 Jadwal Belajar
        </a>

        @if(isset($siswa))
        <a href="{{ route('chat.show', $siswa->id) }}"
           class="menu-item">
            💬 Chat Guru
        </a>
        @endif

        <div class="menu-divider"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="menu-logout">
                🚪 Logout
            </button>
        </form>

    </nav>
</div>
