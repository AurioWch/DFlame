<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DFlame — Sistema de Gestión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.2/anime.min.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg-dark: #000000;
            --bg-card: #111111;
            --bg-input: #1a1a1a;
            --accent: #FFD319;
            --accent-hover: #ffdb4d;
            --text: #ffffff;
            --text-muted: #888888;
            --border: #333333;
        }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-dark);
            color: var(--text);
            overflow: hidden;
        }

        .bg-glow {
            position: fixed;
            width: 400px; height: 400px;
            background: rgba(255, 211, 25, 0.03);
            filter: blur(80px);
            border-radius: 50%;
            pointer-events: none;
        }
        .glow-1 { top: -10%; right: -10%; }
        .glow-2 { bottom: -10%; left: -10%; }

        .scene {
            display: flex; align-items: center; justify-content: center;
            min-height: 100vh; padding: 1.5rem;
            position: relative; z-index: 1;
        }

        .card {
            width: 100%; max-width: 380px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2.2rem;
            opacity: 0; transform: translateY(20px);
        }

        .logo {
            display: flex; align-items: center; gap: .7rem;
            margin-bottom: 1.8rem; opacity: 0;
        }
        .logo-icon {
            width: 44px; height: 44px;
        }
        .logo-text {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--accent);
        }

        .headline { margin-bottom: 1.8rem; opacity: 0; }
        .headline h1 { font-size: 1.4rem; font-weight: 600; }
        .headline p { font-size: .85rem; color: var(--text-muted); margin-top: .3rem; }

        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 10px;
            padding: .75rem 1rem; font-size: .85rem; color: #fca5a5;
            margin-bottom: 1.2rem; opacity: 0;
            display: flex; align-items: center; gap: .5rem;
        }

        .field { margin-bottom: 1.1rem; opacity: 0; }
        .field label {
            display: block; font-size: .7rem;
            font-weight: 500;
            letter-spacing: .05em;
            text-transform: uppercase;
            color: var(--text-muted); margin-bottom: .45rem;
        }
        .input-wrap { position: relative; }
        .input-wrap .ico {
            position: absolute; left: 1rem; top: 50%;
            transform: translateY(-50%);
            width: 18px; height: 18px;
            fill: var(--text-muted);
            transition: fill .2s;
            z-index: 1;
        }
        .field input {
            width: 100%;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 10px; color: #fff;
            font-family: 'Poppins', sans-serif; font-size: .95rem;
            padding: .85rem 1rem .85rem 2.8rem;
            outline: none;
            transition: border-color .2s, background .2s;
        }
        .field input::placeholder { color: var(--text-muted); }
        .field input:focus {
            border-color: var(--accent);
            background: rgba(255, 211, 25, 0.05);
        }
        .field input:focus ~ .ico { fill: var(--accent); }

        .btn {
            width: 100%; margin-top: 1.5rem;
            padding: .95rem;
            background: var(--accent);
            border: none; border-radius: 10px;
            color: var(--bg-dark);
            font-family: 'Poppins', sans-serif;
            font-size: .9rem; font-weight: 600;
            cursor: pointer;
            transition: background .2s, transform .1s;
            opacity: 0;
        }
        .btn:hover { background: var(--accent-hover); }
        .btn:active { transform: scale(.98); }

        .divider {
            display: flex; align-items: center; gap: 1rem;
            margin: 1.5rem 0; opacity: 0;
        }
        .divider-line { flex: 1; height: 1px; background: var(--border); }
        .divider-text { font-size: .7rem; color: var(--text-muted); }

        .options {
            display: flex; justify-content: space-between;
            font-size: .8rem; opacity: 0;
        }
        .options a { color: var(--text-muted); text-decoration: none; transition: color .2s; }
        .options a:hover { color: var(--accent); }

        .foot {
            margin-top: 1.5rem; text-align: center;
            font-size: .7rem; color: rgba(255,255,255,0.2); opacity: 0;
        }
    </style>
</head>
<body>

<div class="bg-glow glow-1"></div>
<div class="bg-glow glow-2"></div>

<div class="scene">
    <div class="card" id="card">

        <div class="logo" id="logo">
            <svg class="logo-icon" viewBox="0 0 48 48" fill="none">
                <rect x="8" y="4" width="32" height="38" rx="4" fill="#FFD319"/>
                <rect x="12" y="8" width="24" height="30" rx="2" fill="#ffdb4d"/>
                <rect x="16" y="12" width="16" height="2" fill="#FFD319"/>
                <rect x="16" y="16" width="14" height="2" fill="#111111"/>
                <rect x="16" y="20" width="16" height="2" fill="#FFD319"/>
                <rect x="16" y="24" width="12" height="2" fill="#111111"/>
                <rect x="16" y="28" width="16" height="2" fill="#FFD319"/>
                <path d="M36 8 L44 4 L44 42 L36 38 Z" fill="#FFD319"/>
                <path d="M36 8 L44 4 L44 42 L36 38 Z" fill="#FFD319" fill-opacity="0.3"/>
            </svg>
            <span class="logo-text">DFlame</span>
        </div>

        <div class="headline" id="headline">
            <h1>Iniciar sesión</h1>
            <p>Accede a tu cuenta para continuar</p>
        </div>

        @if($errors->any())
        <div class="error-box" id="err-box">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm0-14v4m0 4h.01"/></svg>
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="field" id="f-user">
                <label for="login_usuario">Usuario</label>
                <div class="input-wrap">
                    <input type="text" id="login_usuario" name="login_usuario" placeholder="Ingresa tu usuario" autocomplete="username" required value="{{ old('login_usuario') }}">
                    <svg class="ico" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
            </div>

            <div class="field" id="f-pass">
                <label for="password">Contraseña</label>
                <div class="input-wrap">
                    <input type="password" id="password" name="password" placeholder="••••••••" autocomplete="current-password" required>
                    <svg class="ico" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
            </div>

            <button type="submit" class="btn" id="btn">
                Ingresar
            </button>
        </form>

        <div class="divider" id="divider">
            <span class="divider-line"></span>
            <span class="divider-text">FACTURACIÓN</span>
            <span class="divider-line"></span>
        </div>

        <div class="options" id="options">
            <a href="#">¿Olvidaste tu contraseña?</a>
            <a href="#">Ayuda</a>
        </div>

        <div class="foot" id="foot">
            Sistema seguro • DFlame © {{ date('Y') }}
        </div>

    </div>
</div>

<script>
anime.timeline({ easing: 'easeOutExpo' })
    .add({ targets:'.bg-glow', opacity:[0,1], scale:[0.8,1], duration:1500 })
    .add({ targets:'#card', opacity:[0,1], translateY:[20,0], duration:700 }, '-=800')
    .add({ targets:'#logo', opacity:[0,1], translateX:[-15,0], duration:400 }, '-=300')
    .add({ targets:'#headline', opacity:[0,1], translateY:[10,0], duration:300 }, '-=200')
    .add({ targets:'#err-box', opacity:[0,1], duration:300 }, '-=150')
    .add({ targets:['#f-user','#f-pass'], opacity:[0,1], translateY:[10,0], delay:anime.stagger(80), duration:300 })
    .add({ targets:'#btn', opacity:[0,1], translateY:[10,0], duration:300 })
    .add({ targets:'#divider', opacity:[0,1], duration:300 })
    .add({ targets:'#options', opacity:[0,1], duration:300 })
    .add({ targets:'#foot', opacity:[0,1], duration:300 });
</script>

</body>
</html>