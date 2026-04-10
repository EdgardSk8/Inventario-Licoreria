<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">

<title>Sistema</title>
<script src="{{ Vite::asset('resources/js/EspaniolTabla.js') }}"></script>
@include('principal.links')

@vite(['resources/css/principal/principal.css'])
@vite(['resources/css/principal/footer.css'])
@vite(['resources/css/app.css'])

@vite(['resources/js/principal/cargavistahijo.js'])
@vite(['resources/js/principal/cerrar_acordeon.js'])
@vite(['resources/js/principal/logout.js'])

<meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<!----------------------------------->
<!-------------- BODY --------------->
<!----------------------------------->

<body>

<div class="d-flex">

    <!-- ╔════════════ SIDEBAR ════════════╗ -->
    <!-- ╚═════════════════════════════════╝ -->

    <div class="sidebar">

        <div class="sidebar-title">
            <i class="bi bi-shop"></i> Sistema POS
        </div>

        <div class="accordion accordion-flush" id="menuSidebar">

        <!-- ╔════════════ DASHBOARD ════════════╗ -->
        <!-- ╚═══════════════════════════════════╝ -->

        <div id="dashboardbtn">
            <i class="bi bi-speedometer2"></i>
            <a href="" class="cargar-vista" data-url="{{ route('dashboard') }}">Dashboard</a>
        </div>


        <!-- ╔═══════════ FACTURACION ═══════════╗ -->
        <!-- ╚═══════════════════════════════════╝ -->

        <!-- <div id="facturacionbtn">
            <i class="bi bi-receipt me-1"></i>
            <a href="" class="cargar-vista" data-url="{{ route('facturacion') }}">Facturacion</a>
        </div> -->

 
<!--     <div class="accordion-item border-0">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#factura">

                    <i class="bi bi-people me-2"></i> Facturacion

                </button>

            </h2>

            <div id="factura" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">

                <div class="submenu">

                    <a href="" class="cargar-vista" data-url="{{ route('facturacion') }}">Facturacion</a>

                </div>

            </div>

        </div> -->

<!-- ═════════════════════════════════════════════════════════════════════════════════════════════  -->

        <!-- ╔════════════ VENTAS ═══════════════╗ -->
        <!-- ╚═══════════════════════════════════╝ -->

        <div class="accordion-item border-0">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#ventas">

                    <i class="bi bi-cash-coin me-2"></i> Ventas

                </button>

            </h2>

            <div id="ventas" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">

                <div class="submenu">

                    <a href="" class="cargar-vista" data-url="{{ route('facturacion') }}">
                        <i class="bi bi-receipt me-2 "></i> Facturación
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('ventas') }}">
                        <i class="bi bi-clock-history me-2 text-primary"></i> Historial de Ventas
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('clientes') }}">
                        <i class="bi bi-person-lines-fill me-2 text-warning"></i> Clientes
                    </a>

                </div> <!-- Fin de Submenu -->

            </div> <!-- Fin de Acordeon -->

        </div>

<!-- ═════════════════════════════════════════════════════════════════════════════════════════════  -->

        <!-- ╔════════════ COMPRAS ══════════════╗ -->
        <!-- ╚═══════════════════════════════════╝ -->

        <div class="accordion-item border-0">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#compras">

                    <i class="bi bi-truck me-2"></i> Compras

                </button>

            </h2>

            <div id="compras" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">

                <div class="submenu">

                     <a href="" class="cargar-vista" data-url="{{ route('compras') }}">
                        <i class="bi bi-cart-check me-2 text-success"></i> Realizar Compra
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('proveedores') }}">
                        <i class="bi bi-truck me-2 text-primary"></i> Proveedores
                    </a>

                </div> <!-- Fin de Submenu -->

            </div> <!-- Fin de Acordeon -->

        </div>

<!-- ═════════════════════════════════════════════════════════════════════════════════════════════  -->

        <!-- ╔══════════════ CAJA ═══════════════╗ -->
        <!-- ╚═══════════════════════════════════╝ -->

        <div class="accordion-item border-0">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#caja">

                    <i class="bi bi-wallet2 me-2"></i> Caja

                </button>

            </h2>

            <div id="caja" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">

                <div class="submenu">

                    <a href="" class="cargar-vista" data-url="{{ route('cajas') }}">
                        <i class="bi bi-wallet2 me-2 text-success"></i> Cajas
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('movimientos.cajas') }}">
                        <i class="bi bi-arrow-left-right me-2 text-primary"></i> Movimiento de Cajas
                    </a>

                </div> <!-- Fin de Submenu -->

            </div> <!-- Fin de Acordeon -->

        </div>

<!-- ═════════════════════════════════════════════════════════════════════════════════════════════  -->

        <!-- ╔═════════════ GASTOS ══════════════╗ -->
        <!-- ╚═══════════════════════════════════╝ -->

        <div class="accordion-item border-0">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#gastos">

                    <i class="bi bi-receipt me-2"></i> Gastos

                </button>

            </h2>

            <div id="gastos" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">

                <div class="submenu">

                    <a href="" class="cargar-vista" data-url="{{ route('gastos') }}">
                        <i class="bi bi-cash-stack me-2 text-danger"></i> Gastos
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('tipos.gasto') }}">
                        <i class="bi bi-tags me-2 text-primary"></i> Tipos de Gasto
                    </a>

                </div> <!-- Fin de Submenu -->

            </div> <!-- Fin de Acordeon -->

        </div>

<!-- ═════════════════════════════════════════════════════════════════════════════════════════════  -->

        <!-- ╔════════════ PRODUCTOS ════════════╗ -->
        <!-- ╚═══════════════════════════════════╝ -->

        <div class="accordion-item border-0">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#productos">

                    <i class="bi bi-box-seam me-2"></i> Inventario

                </button>

            </h2>

            <div id="productos" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">

                <div class="submenu">

                    <a href="" class="cargar-vista" data-url="{{ route('productos') }}">
                        <i class="bi bi-box-seam me-2 text-primary"></i> Productos
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('categorias') }}">
                        <i class="bi bi-tags me-2 text-warning"></i> Categorías
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('movimientos.inventario') }}">
                        <i class="bi bi-arrow-left-right me-2 text-success"></i> Movimientos de inventario
                    </a>

                </div> <!-- Fin de Submenu -->

            </div> <!-- Fin de Acordeon -->

        </div>

<!-- ═════════════════════════════════════════════════════════════════════════════════════════════  -->

    <!-- ╔══════════ ADMINISTRACIÓN ══════════╗ -->
    <!-- ╚════════════════════════════════════╝ -->

        <div class="accordion-item border-0">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#admin">

                    <i class="bi bi-people me-2"></i> Administración

                </button>

            </h2>

            <div id="admin" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">

                <div class="submenu">

                    <a href="" class="cargar-vista" data-url="{{ route('usuarios') }}">
                        <i class="bi bi-people me-2 text-primary"></i> Usuarios
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('roles') }}">
                        <i class="bi bi-person-badge me-2 text-success"></i> Roles
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('permisos') }}">
                        <i class="bi bi-shield-lock me-2 text-danger"></i> Permisos
                    </a>

                </div> <!-- Fin de Submenu -->

            </div> <!-- Fin de Acordeon -->

        </div>

<!-- ═════════════════════════════════════════════════════════════════════════════════════════════  -->

    <!-- ╔═════════ CONFIGURACIÓN ══════════╗ -->
    <!-- ╚══════════════════════════════════╝ -->

        <div class="accordion-item border-0">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#config">

                    <i class="bi bi-gear me-2"></i> Configuración

                </button>

            </h2>

            <div id="config" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">

                <div class="submenu">

                    <a href="" class="cargar-vista" data-url="{{ route('impuestos') }}">
                        <i class="bi bi-percent me-2 text-warning"></i> Impuestos
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('metodos.pago') }}">
                        <i class="bi bi-credit-card me-2 text-primary"></i> Métodos de Pago
                    </a>

                    <a href="" class="cargar-vista" data-url="{{ route('credenciales') }}">
                        <i class="bi bi-building me-2 text-success"></i> Credenciales de Empresa
                    </a>

                </div> <!-- Fin de Submenu -->

            </div> <!-- Fin de Acordeon -->

        </div>

<!-- ═════════════════════════════════════════════════════════════════════════════════════════════  -->

    </div>

</div>


<!-- ╔═════════ CONTENIDO ═════════╗ -->
<!-- ╚═════════════════════════════╝ -->

<div class="content flex-grow-1">

    <div class="topbar d-flex justify-content-between align-items-center px-2">
        
        <!-- 🧾 Título -->
        <div id="titulo"></div>

        <!-- 👤 Usuario -->
        <div>
            <strong>{{ session('usuario.nombre') ?? 'Invitado' }}</strong>
            <small class="text-muted">({{ session('usuario.rol') ?? 'Sin rol' }}) </small>

                <button id="btnLogout" class="btn btn-sm">Cerrar sesion
                    <i class="bi bi-box-arrow-right"> </i>
                </button>
        </div>

    </div>

    <div id="contenido-dinamico" class="p-2">@yield('contenido')</div>

    <!-- 
    @include('principal.footer')
    -->

</div>


</body>
</html>