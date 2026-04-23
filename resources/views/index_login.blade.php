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
        :root {
            --bg-dark: #000000;
            --bg-card: rgba(0, 0, 0, 0.45);
            --bg-input: #111111;
            --accent: #FFD319;
            --accent-hover: #ffdb4d;
            --text: #ffffff;
            --text-muted: #888888;
            --border: rgba(255, 255, 255, 0.1);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--bg-dark);
            color: var(--text);
            overflow: hidden;
        }

        /* Wallpaper background */
        .wallpaper {
            position: fixed; inset: 0;
            background: url('https://w.wallhaven.cc/full/y8/wallhaven-y8ke3k.jpg') center/cover no-repeat;
            z-index: 0;
        }

        /* Overlay oscuro */
        .overlay {
            position: fixed; inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        /* Light particles */
        .lights {
            position: fixed; inset: 0;
            z-index: 2;
            pointer-events: none;
        }

        .light {
            position: absolute;
            width: 4px; height: 4px;
            background: rgba(255, 255, 200, 0.6);
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(255, 255, 200, 0.4);
        }

        /* Wind effect overlay */
        .wind {
            position: fixed; inset: 0;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(255,255,255,0.02) 50%, 
                transparent 100%);
            z-index: 3;
            animation: windShimmer 8s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes windShimmer {
            0%, 100% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }

        .scene {
            display: flex; align-items: center; justify-content: center;
            min-height: 100vh;
            padding: 1.5rem;
            position: relative;
            z-index: 10;
        }

        .card {
            width: 100%; max-width: 380px;
            background: var(--bg-card);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2.2rem;
            opacity: 0;
            transform: translateY(20px);
        }

        .logo {
            display: flex; align-items: center; gap: .7rem;
            margin-bottom: 1.8rem;
            opacity: 0;
        }
        .logo-icon { width: 44px; height: 44px; }
        .logo-text {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--accent);
        }

        .headline { margin-bottom: 1.8rem; opacity: 0; }
        .headline h1 { font-size: 1.4rem; font-weight: 600; }
        .headline p { font-size: .85rem; color: var(--text-muted); margin-top: .3rem; }

        .error-box {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 10px;
            padding: .75rem 1rem; font-size: .85rem; color: #fca5a5;
            margin-bottom: 1.2rem;
            opacity: 0;
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
            background: rgba(255, 211, 25, 0.1);
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
            margin: 1.5rem 0;
            opacity: 0;
        }
        .divider-line { flex: 1; height: 1px; background: var(--border); }
        .divider-text { font-size: .7rem; color: var(--text-muted); }

        .options {
            display: flex; justify-content: space-between;
            font-size: .8rem;
            opacity: 0;
        }
        .options a { color: var(--text-muted); text-decoration: none; transition: color .2s; }
        .options a:hover { color: var(--accent); }

        .foot {
            margin-top: 1.5rem; text-align: center;
            font-size: .7rem; color: rgba(255,255,255,0.3);
            opacity: 0;
        }
    </style>
</head>
<body>

<div class="wallpaper"></div>
<div class="overlay"></div>

<div class="lights" id="lights"></div>
<div class="wind"></div>

<div class="scene">
    <div class="card" id="card">

        <div class="logo" id="logo">
            <svg class="logo-icon" viewBox="0 0 48 48" fill="none">
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
// Create floating light particles
const lightsContainer = document.getElementById('lights');
for (let i = 0; i < 35; i++) {
    const light = document.createElement('div');
    light.className = 'light';
    light.style.left = Math.random() * 100 + '%';
    light.style.top = Math.random() * 100 + '%';
    lightsContainer.appendChild(light);
}

// Animate lights floating
anime({
    targets: '.light',
    translateY: function() { return anime.random(-100, 100); },
    translateX: function() { return anime.random(-80, 80); },
    opacity: [0.1, 0.6, 0.1],
    scale: [0.3, 1, 0.3],
    easing: 'easeInOutSine',
    duration: function() { return anime.random(8000, 14000); },
    delay: function() { return anime.random(0, 5000); },
    loop: true
});

// Card entrance animation
anime.timeline({ easing: 'easeOutExpo' })
    .add({ targets:'#card', opacity:[0,1], translateY:[20,0], duration:800 })
    .add({ targets:'#logo', opacity:[0,1], translateX:[-15,0], duration:500 }, '-=400')
    .add({ targets:'#headline', opacity:[0,1], translateY:[10,0], duration:400 }, '-=300')
    .add({ targets:'#err-box', opacity:[0,1], duration:300 }, '-=200')
    .add({ targets:['#f-user','#f-pass'], opacity:[0,1], translateY:[10,0], delay:anime.stagger(100), duration:400 })
    .add({ targets:'#btn', opacity:[0,1], translateY:[10,0], duration:400 })
    .add({ targets:'#divider', opacity:[0,1], duration:300 })
    .add({ targets:'#options', opacity:[0,1], duration:300 })
    .add({ targets:'#foot', opacity:[0,1], duration:300 });
</script>

</body>
</html>