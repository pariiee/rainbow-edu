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
        <h2><i class="ph-duotone ph-graduation-cap"></i> Rainbow Edu</h2>
        <p>Dashboard Guru</p>
    </div>

    <!-- MENU -->
    <nav class="sidebar-menu">

        @php
            // Menentukan rute dashboard utama berdasarkan tipe guru
            $dashboardRoute = 'dashboard';
            $isActive = false;

            if (auth()->check()) {
                if (auth()->user()->guru_type === 'PAUD') {
                    $dashboardRoute = route('guru.paud.home');
                    $isActive = request()->routeIs('guru.paud.home');
                } elseif (auth()->user()->guru_type === 'Learn kursus') {
                    $dashboardRoute = route('guru.learn.home');
                    $isActive = request()->routeIs('guru.learn.home');
                } elseif (auth()->user()->guru_type === 'Homelearning kursus private') {
                    $dashboardRoute = route('guru.homelearning.home');
                    $isActive = request()->routeIs('guru.homelearning.home');
                }
            }
        @endphp

        <a href="{{ $dashboardRoute }}"
           class="menu-item {{ $isActive ? 'active' : '' }}"> 
            <i class="ph-duotone ph-house"></i> Dashboard
        </a>

        <a href="{{ route('guru.jadwal.index') }}"
           class="menu-item {{ request()->routeIs('guru.jadwal.*') ? 'active' : '' }}">
            <i class="ph-duotone ph-calendar-blank"></i> Jadwal Mengajar
        </a>

        <div class="menu-divider"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="menu-logout">
                <i class="ph-duotone ph-sign-out"></i> Logout
            </button>
        </form>

    </nav>
</div>
