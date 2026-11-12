<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"><link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Iniciar sesión · Nexora Tech</title>
</head>
<body>
<main class="login">
    <div class="login-izq" role="img" aria-label="Cubos decorativos"></div>
    <section class="login-der">
        <div class="login-caja">
            <h1>NEXORA TECH</h1>
            <p class="sub">Iniciar sesión para continuar</p>

            <form method="POST" action="/login" novalidate>
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                @error('email')<div class="error-login">{{ $message }}</div>@enderror

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required>
                @error('password')<div class="error-login">{{ $message }}</div>@enderror

                <button type="submit" class="btn btn-oscuro">Iniciar sesión</button>
            </form>

            <a href="/recuperar-contrasena" class="btn btn-rosa">¿Olvidaste tu contraseña?</a>
        </div>
    </section>
</main>
</body>
</html>
