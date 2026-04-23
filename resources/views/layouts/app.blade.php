<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DFlame')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        :root {
            --green-deep:  #062223;
            --green-pino:   #09302B;
            --green-menta:  #418B7E;
            --green-salvia: #4E977A;
            --green-musgo: #7AB37C;
            --crema:      #F7F4D1;
            --primary:   var(--green-menta);
            --primary-glow: var(--green-musgo);
            --border:    rgba(65,139,126,.25);
            --muted:     rgba(247,244,209,.4);
            --text:       var(--crema);
        }

        * { box-sizing: border-box; }

        html, body {
            height: 100%;
            font-family: 'Outfit', sans-serif;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        .layout {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 220px;
            background: var(--green-pino);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .sidebar-header {
            padding: 1.2rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: .6rem;
        }

        .sidebar-logo .icon {
            width: 32px; height: 32px;
        }

        .sidebar-logo .name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            letter-spacing: .1em;
            color: var(--primary-glow);
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem 0;
            overflow-y: auto;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: .7rem;
            padding: .75rem 1.2rem;
            color: var(--muted);
            text-decoration: none;
            font-size: .85rem;
            transition: color .15s, background .15s;
        }

        .nav-item:hover {
            color: var(--text);
            background: rgba(65,139,126,.1);
        }

        .nav-item.active {
            color: var(--primary-glow);
            background: rgba(65,139,126,.15);
            border-right: 2px solid var(--primary-glow);
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
            gap: .7rem;
            margin-bottom: .8rem;
        }

        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--green-menta);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--crema);
            font-size: .85rem;
        }

        .user-name {
            font-size: .85rem;
            color: var(--text);
        }

        .user-role {
            font-size: .7rem;
            color: var(--muted);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .5rem .8rem;
            background: rgba(239,68,68,.1);
            border: 1px solid rgba(239,68,68,.2);
            border-radius: 6px;
            color: #ef4444;
            font-size: .8rem;
            text-decoration: none;
            transition: background .15s;
        }

        .logout-btn:hover {
            background: rgba(239,68,68,.2);
        }

        .logout-btn svg {
            width: 14px; height: 14px;
            fill: currentColor;
        }

        .main {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            background: #fff;
        }

        @stack('styles')
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <svg class="icon" viewBox="0 0 48 48" fill="none">
                        <rect x="8" y="4" width="32" height="38" rx="4" fill="#4E977A"/>
                        <rect x="12" y="8" width="24" height="30" rx="2" fill="#418B7E"/>
                        <rect x="16" y="12" width="16" height="2" fill="#4E977A"/>
                        <rect x="16" y="16" width="14" height="2" fill="#F7F4D1"/>
                        <rect x="16" y="20" width="16" height="2" fill="#4E977A"/>
                        <rect x="16" y="24" width="12" height="2" fill="#F7F4D1"/>
                        <rect x="16" y="28" width="16" height="2" fill="#4E977A"/>
                        <path d="M36 8 L44 4 L44 42 L36 38 Z" fill="#418B7E"/>
                        <path d="M36 8 L44 4 L44 42 L36 38 Z" fill="#4E977A" fill-opacity="0.3"/>
                    </svg>
                    <span class="name">DFlame</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="/dashboard" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                    Dashboard
                </a>
                
                @if(\App\Helpers\PermisosHelper::tienePermiso(2))
                <a href="{{ route('usuarios.index') }}" class="nav-item {{ request()->is('usuarios*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    Usuarios
                </a>
                @endif

                @if(\App\Helpers\PermisosHelper::tienePermiso(3))
                <a href="{{ route('roles.index') }}" class="nav-item {{ request()->is('configuracion/roles*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    Roles
                </a>
                @endif
            </nav>

            <div class="sidebar-footer">
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
        </aside>

        <main class="main">
            @yield('content')
        </main>
    </div>
</body>
</html>