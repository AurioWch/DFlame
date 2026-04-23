<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DFlame')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.2/anime.min.js"></script>
    <style>
        :root {
            --bg-dark: #0a0a0a;
            --bg-card: rgba(0, 0, 0, 0.45);
            --accent: #FFD319;
            --accent-hover: #ffdb4d;
            --text: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.5);
            --border: rgba(255, 255, 255, 0.08);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-dark);
            color: var(--text);
        }

        .layout {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 240px;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .sidebar-wallpaper {
            position: absolute; inset: 0;
            background: url('https://w.wallhaven.cc/full/y8/wallhaven-y8ke3k.jpg') center/cover no-repeat;
            z-index: 0;
        }

        .sidebar-overlay {
            position: absolute; inset: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .sidebar-lights {
            position: absolute; inset: 0;
            z-index: 2;
            pointer-events: none;
        }

        .sidebar-wind {
            position: absolute; inset: 0;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(255,255,255,0.015) 50%, 
                transparent 100%);
            z-index: 3;
            animation: windShimmer 8s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes windShimmer {
            0%, 100% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }

        .sidebar-content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            flex-direction: column;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
        }

        .sidebar-header {
            padding: 1.5rem 1.2rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: .8rem;
        }

        .sidebar-logo .icon {
            width: 38px; height: 38px;
        }

        .sidebar-logo .name {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--accent);
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
            overflow-y: auto;
        }

        .nav-section {
            margin-bottom: 1rem;
        }

        .nav-section-title {
            font-size: .65rem;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: .5rem 1.2rem;
            margin-bottom: .3rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: .8rem;
            padding: .8rem 1.2rem;
            color: var(--text-muted);
            text-decoration: none;
            font-size: .85rem;
            font-weight: 400;
            transition: all .2s;
            position: relative;
        }

        .nav-item:hover {
            color: var(--text);
            background: rgba(255, 211, 25, 0.05);
        }

        .nav-item:hover::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 2px;
            background: var(--accent);
        }

        .nav-item.active {
            color: var(--accent);
            background: rgba(255, 211, 25, 0.1);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: var(--accent);
        }

        .nav-item svg {
            width: 18px; height: 18px;
            flex-shrink: 0;
            fill: currentColor;
        }

        .sidebar-footer {
            padding: 1rem 1.2rem;
            border-top: 1px solid var(--border);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: .8rem;
            margin-bottom: .8rem;
        }

        .user-avatar {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--bg-dark);
            font-size: .9rem;
        }

        .user-name {
            font-size: .85rem;
            color: var(--text);
            font-weight: 500;
        }

        .user-role {
            font-size: .7rem;
            color: var(--text-muted);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .6rem .9rem;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 8px;
            color: #fca5a5;
            font-size: .8rem;
            text-decoration: none;
            transition: all .2s;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .logout-btn svg {
            width: 14px; height: 14px;
            fill: currentColor;
        }

        .main {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            background: #ffffff;
        }

        .light {
            position: absolute;
            width: 3px; height: 3px;
            background: rgba(255, 255, 200, 0.5);
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(255, 255, 200, 0.3);
        }

        @stack('styles')
    </style>
</head>
<body>

<div class="layout">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-wallpaper"></div>
        <div class="sidebar-overlay"></div>
        <div class="sidebar-lights" id="lights"></div>
        <div class="sidebar-wind"></div>

        <div class="sidebar-content">
            <div class="sidebar-header">
                <div class="sidebar-logo" id="logo">
                    <svg class="icon" viewBox="0 0 48 48" fill="none">
                        <rect x="8" y="4" width="32" height="38" rx="4" fill="#FFD319"/>
                        <rect x="12" y="8" width="24" height="30" rx="2" fill="#ffdb4d"/>
                        <rect x="16" y="12" width="16" height="2" fill="#FFD319"/>
                        <rect x="16" y="16" width="14" height="2" fill="#000"/>
                        <rect x="16" y="20" width="16" height="2" fill="#FFD319"/>
                        <rect x="16" y="24" width="12" height="2" fill="#000"/>
                        <rect x="16" y="28" width="16" height="2" fill="#FFD319"/>
                        <path d="M36 8 L44 4 L44 42 L36 38 Z" fill="#FFD319"/>
                        <path d="M36 8 L44 4 L44 42 L36 38 Z" fill="#FFD319" fill-opacity="0.3"/>
                    </svg>
                    <span class="name">DFlame</span>
                </div>
            </div>

            <nav class="sidebar-nav" id="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Principal</div>
                    <a href="/dashboard" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                        Dashboard
                    </a>
                </div>
                
                @if(\App\Helpers\PermisosHelper::tienePermiso(2))
                <div class="nav-section">
                    <div class="nav-section-title">Gestión</div>
                    <a href="{{ route('usuarios.index') }}" class="nav-item {{ request()->is('usuarios*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
                        Usuarios
                    </a>
                </div>
                @endif

                @if(\App\Helpers\PermisosHelper::tienePermiso(3))
                <div class="nav-section">
                    <div class="nav-section-title">Configuración</div>
                    <a href="{{ route('roles.index') }}" class="nav-item {{ request()->is('configuracion/roles*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                        Roles y Permisos
                    </a>
                </div>
                @endif
            </nav>

            <div class="sidebar-footer" id="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">{{ strtoupper(substr(session('login_usuario'), 0, 1)) }}</div>
                    <div>
                        <div class="user-name">{{ session('login_usuario') }}</div>
                        <div class="user-role">{{ \App\Helpers\PermisosHelper::getNombreRol() }}</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" class="logout-btn">
                    <svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
                    Cerrar sesión
                </a>
            </div>
        </div>
    </aside>

    <main class="main">
        @yield('content')
    </main>
</div>

<script>
const lightsContainer = document.getElementById('lights');
for (let i = 0; i < 20; i++) {
    const light = document.createElement('div');
    light.className = 'light';
    light.style.left = Math.random() * 100 + '%';
    light.style.top = Math.random() * 100 + '%';
    lightsContainer.appendChild(light);
}

anime({
    targets: '.light',
    translateY: function() { return anime.random(-80, 80); },
    translateX: function() { return anime.random(-50, 50); },
    opacity: [0.1, 0.5, 0.1],
    scale: [0.3, 1, 0.3],
    easing: 'easeInOutSine',
    duration: function() { return anime.random(8000, 14000); },
    delay: function() { return anime.random(0, 5000); },
    loop: true
});

anime.timeline({ easing: 'easeOutExpo' })
    .add({ targets:'#sidebar', opacity:[0,1], translateX:[-20,0], duration:600 })
    .add({ targets:'#logo', opacity:[0,1], translateX:[-10,0], duration:400 }, '-=300')
    .add({ targets:'#sidebar-nav .nav-item', opacity:[0,1], translateX:[-10,0], delay:anime.stagger(60), duration:300 }, '-=200')
    .add({ targets:'#sidebar-footer', opacity:[0,1], translateY:[10,0], duration:300 }, '-=100');
</script>

</body>
</html>