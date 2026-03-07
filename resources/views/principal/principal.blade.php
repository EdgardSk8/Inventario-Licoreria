<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Sistema</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

@vite(['resources/css/principal/principal.css'])

@vite(['resources/js/principal/cargavistahijo.js'])
@vite(['resources/js/principal/cerrar_acordeon.js'])

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

        <div class="p-3">
            <i class="bi bi-speedometer2"></i>
            <a href="" class="cargar-vista" data-url="{{ route('dashboard') }}">Dashboard</a>
        </div>

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

                    <a href="" class="cargar-vista" data-url="{{ route('usuarios') }}">Usuarios</a>
                    <a href="" class="cargar-vista" data-url="{{ route('roles') }}">Roles</a>
                    <a href="" class="cargar-vista" data-url="{{ route('permisos') }}">Permisos</a>

                </div>

            </div>

        </div>

    <!-- ╔════════════ PRODUCTOS ════════════╗ -->
    <!-- ╚═══════════════════════════════════╝ -->

        <div class="accordion-item border-0">

            <h2 class="accordion-header">

                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#productos">

                    <i class="bi bi-box-seam me-2"></i> Productos

                </button>

            </h2>

            <div id="productos" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">

                <div class="submenu">

                    <a href="" class="cargar-vista" data-url="{{ route('productos') }}">Productos</a>
                    <a href="" class="cargar-vista" data-url="{{ route('categorias') }}">Categorias</a>
                    <a href="" class="cargar-vista" data-url="{{ route('movimientos.inventario') }}">Inventario</a>

                </div>

            </div>

        </div>

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

                    <a href="" class="cargar-vista" data-url="{{ route('proveedores') }}">Proveedores</a>
                    <a href="" class="cargar-vista" data-url="{{ route('compras') }}">Compras</a>

                </div>

            </div>

        </div>

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

                <a href="" class="cargar-vista" data-url="{{ route('ventas') }}">Ventas</a>
                <a href="" class="cargar-vista" data-url="{{ route('clientes') }}">Clientes</a>

                </div>

            </div>

        </div>

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

                    <a href="" class="cargar-vista" data-url="{{ route('cajas') }}">Caja</a>
                    <a href="" class="cargar-vista" data-url="{{ route('movimientos.cajas') }}">Movimientos</a>

                </div>

            </div>

        </div>

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

                    <a href="" class="cargar-vista" data-url="{{ route('gastos') }}">Gastos</a>
                    <a href="" class="cargar-vista" data-url="{{ route('tipos.gasto') }}">Tipos de Gasto</a>

                </div>

            </div>

        </div>

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

                    <a href="" class="cargar-vista" data-url="{{ route('impuestos') }}">Impuestos</a>
                    <a href="" class="cargar-vista" data-url="{{ route('metodos.pago') }}">Metodos de Pago</a>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- ╔═════════ CONTENIDO ═════════╗ -->
<!-- ╚═════════════════════════════╝ -->

<div class="content flex-grow-1">

    <div class="topbar">Panel de administración</div>
    <div id="contenido-dinamico" class="p-4">@yield('contenido')</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>