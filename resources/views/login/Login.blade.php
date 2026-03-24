<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<title>Login - Sistema POS</title>

@include('principal.links')

@vite(['resources/css/login/login.css'])

<script src="{{ Vite::asset('resources/js/login/Login.js') }}"></script>
<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

<div class="d-flex justify-content-center align-items-center login-container">

    <div class="card login-card p-4">

        <!-- 🏪 Título -->
        <div class="text-center mb-3">
            <i class="bi bi-shop fs-1"></i>
            <div class="login-title mt-2">Sistema POS</div>
            <small class="text-muted">Iniciar sesión</small>
        </div>

        <!-- 🧾 Formulario -->
        <form id="formLogin">
            @csrf

            <!-- Usuario -->
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>
                    <input 
                        type="text" 
                        name="nombre_usuario" 
                        class="form-control"
                        placeholder="Ingrese su usuario"
                        required
                    >
                </div>
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control"
                        placeholder="Ingrese su contraseña"
                        required
                    >
                </div>
            </div>

            <!-- Botón -->
            <div class="d-grid">
                <button class="btn btn-dark">
                    <i class="bi bi-box-arrow-in-right"></i> Ingresar
                </button>
            </div>

        </form>

    </div>

</div>

<div class="toast-container position-fixed top-0 end-0 p-3">

  <div id="toastMensaje" class="toast text-bg-success border-0">

    <div class="d-flex">
      <div class="toast-body" id="toastTexto"></div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>

  </div>

</div>


</body>
</html>