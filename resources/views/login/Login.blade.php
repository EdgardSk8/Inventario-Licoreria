<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login - Sistema POS</title>

@include('principal.links')

@vite(['resources/css/login/login.css'])

<script src="{{ Vite::asset('resources/js/login/Login.js') }}"></script>
<script src="{{ Vite::asset('resources/js/MensajeToast.js') }}"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

<!-- FONDO -->
<div class="background-shape shape-1"></div>
<div class="background-shape shape-2"></div>

<div class="login-container">

    <div class="login-box">

        <!-- PANEL IZQUIERDO -->
        <div class="login-side">

            <div class="brand-mini">

                <div>
                    <h1>Tellez S.A</h1>
                    <span>Sistema POS</span>
                </div>

                <img 
                    src="{{ asset('img/icono.png') }}"
                    alt="Logo"
                    class="logo"
                >

            </div>

            <div class="side-content">

                <h2>
                    <!-- Control total de tu negocio -->
                </h2>

                <p>
                    <!-- Gestión moderna de ventas, inventario,
                    cajas y facturación en un solo sistema. -->
                </p>

            </div>

        </div>

        <!-- PANEL DERECHO -->
<!-- PANEL DERECHO -->
        <div class="login-form-panel">

            <div class="form-card">

                <div class="form-header">

                    <h3>LOGIN</h3>

                    <p>
                        Acceso al sistema administrativo
                    </p>

                </div>

                <form id="formLogin">

                    @csrf

                    <!-- Usuario -->
                    <div class="form-group">

                        <label>USUARIO</label>

                        <div class="input-modern">

                            <i class="bi bi-person"></i>

                            <input 
                                type="text"
                                name="nombre_usuario"
                                placeholder="Ingrese su usuario"
                                required
                            >

                        </div>

                    </div>

                    <!-- Password -->
                    <div class="form-group">

                        <label>CONTRASEÑA</label>

                        <div class="input-modern">

                            <i class="bi bi-lock"></i>

                            <input 
                                type="password"
                                name="password"
                                placeholder="Ingrese su contraseña"
                                required
                            >

                        </div>

                    </div>

                    <button class="btn-login">

                        <i class="bi bi-box-arrow-in-right"></i>

                        INGRESAR

                    </button>

                </form>

                <div class="footer-login">

                    © {{ date('Y') }} Tellez S.A

                </div>

            </div>

        </div>

    </div>

</div>

<!-- TOAST -->
<div class="toast-container position-fixed top-0 end-0 p-3">

    <div id="toastMensaje" class="toast text-bg-success border-0">

        <div class="d-flex">

            <div class="toast-body" id="toastTexto"></div>

            <button 
                type="button"
                class="btn-close btn-close-white me-2 m-auto"
                data-bs-dismiss="toast">
            </button>

        </div>

    </div>

</div>

</body>
</html>