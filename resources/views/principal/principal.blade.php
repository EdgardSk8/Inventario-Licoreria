<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- <title>Sistema</title> -->

@include('principal.links')

@vite(['resources/css/app.css'])
@vite(['resources/css/principal/principal.css'])

@vite(['resources/js/principal/cargavistahijo.js'])
@vite(['resources/js/principal/logout.js'])
@vite(['resources/js/FuncionesGlobales.js'])

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>



</style>

</head>

<body>

<div class="d-flex">

    <!-- ╔════════════ SIDEBAR ════════════╗ -->

    <div class="sidebar">

        <div class="sidebar-title">
            <i class="bi bi-shop"></i>
            Sistema POS
        </div>

        <div class="sidebar-menu">

            @if(in_array('vista_dashboard', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 text-info"></i>
                Dashboard
            </a>
            @endif

            <!-- ╔════════════ VENTAS ════════════╗ -->

            <div class="sidebar-section">
                Ventas
            </div>

            @if(in_array('vista_facturacion', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('facturacion') }}">
                <i class="bi bi-receipt text-success"></i>
                Facturación
            </a>
            @endif

            @if(in_array('vista_ventas', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('ventas') }}">
                <i class="bi bi-clock-history text-primary"></i>
                Historial de Ventas
            </a>
            @endif

            @if(in_array('vista_clientes', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('clientes') }}">
                <i class="bi bi-person-lines-fill text-warning"></i>
                Clientes
            </a>
            @endif

            <!-- ╔════════════ COMPRAS ════════════╗ -->

            <div class="sidebar-section">
                Compras
            </div>

            @if(in_array('vista_crear_compras', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('crear.compras') }}">
                <i class="bi bi-cart-check text-success"></i>
                Realizar Compra
            </a>
            @endif

            @if(in_array('vista_compras', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('compras') }}">
                <i class="bi bi-card-checklist text-primary"></i>
                Lista de Compras
            </a>
            @endif

            @if(in_array('vista_proveedores', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('proveedores') }}">
                <i class="bi bi-truck text-info"></i>
                Proveedores
            </a>
            @endif

            <!-- ╔════════════ CAJA ════════════╗ -->

            <div class="sidebar-section">
                Caja
            </div>

            @if(in_array('vista_cajas', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('cajas') }}">
                <i class="bi bi-wallet2 text-success"></i>
                Cajas
            </a>
            @endif

            @if(in_array('vista_movimientos_cajas', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('movimientos.cajas') }}">
                <i class="bi bi-cash-stack text-primary"></i>
                Movimientos de Caja
            </a>
            @endif

            <!-- ╔════════════ CUENTAS ════════════╗ -->

            <div class="sidebar-section">
                Cuentas
            </div>

            @if(in_array('vista_cuentas', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('cuentas') }}">
                <i class="bi bi-bank text-success"></i>
                Cuentas
            </a>
            @endif

            @if(in_array('vista_movimientos_cuentas', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('movimientos.cuentas') }}">
                <i class="bi bi-cash-coin text-primary"></i>
                Movimientos de Cuenta
            </a>
            @endif

            <!-- ╔════════════ TRANSFERENCIAS ════════════╗ -->

            <div class="sidebar-section">
                Transferencias
            </div>

            @if(in_array('vista_transferenciacajacuenta', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('transferencia') }}">
                <i class="bi bi-arrow-left-right text-warning"></i>
                Caja → Cuenta
            </a>
            @endif

            <!-- ╔════════════ GASTOS ════════════╗ -->

            <div class="sidebar-section">
                Gastos
            </div>

            @if(in_array('vista_gastos', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('gastos') }}">
                <i class="bi bi-cash-stack text-danger"></i>
                Gastos
            </a>
            @endif

            @if(in_array('vista_tipos_gasto', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('tipos.gasto') }}">
                <i class="bi bi-tags text-primary"></i>
                Tipos de Gasto
            </a>
            @endif

            @if(in_array('vista_movimientos_gastos', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('movimientos.gastos') }}">
                <i class="bi bi-arrow-left-right text-success"></i>
                Movimiento Gastos
            </a>
            @endif

            <!-- ╔════════════ INVENTARIO ════════════╗ -->

            <div class="sidebar-section">
                Inventario
            </div>

            @if(in_array('vista_productos', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('productos') }}">
                <i class="bi bi-box-seam text-primary"></i>
                Productos
            </a>
            @endif

            @if(in_array('vista_categorias', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('categorias') }}">
                <i class="bi bi-tags text-warning"></i>
                Categorías
            </a>
            @endif

            @if(in_array('vista_movimientos_inventario', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('movimientos.inventario') }}">
                <i class="bi bi-arrow-left-right text-success"></i>
                Movimientos Inventario
            </a>
            @endif

            <!-- ╔════════════ ADMINISTRACIÓN ════════════╗ -->

            <div class="sidebar-section">
                Administración
            </div>

            @if(in_array('vista_usuarios', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('usuarios') }}">
                <i class="bi bi-people text-primary"></i>
                Usuarios
            </a>
            @endif

            @if(in_array('vista_roles', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('roles') }}">
                <i class="bi bi-person-badge text-success"></i>
                Roles
            </a>
            @endif

            @if(in_array('vista_permisos', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('permisos') }}">
                <i class="bi bi-shield-lock text-danger"></i>
                Permisos
            </a>
            @endif

            <div class="sidebar-section">
                Reportes
            </div>

                <a href="" class="sidebar-link cargar-vista"
                    data-url="{{ route('reportes') }}">
                        <i class="bi bi-file-earmark-bar-graph-fill text-warning"></i>
                    Reportes
                </a>

            <!-- ╔════════════ CONFIG ════════════╗ -->

            <div class="sidebar-section">
                Configuración
            </div>

            @if(in_array('vista_impuestos', session('permisos', [])))
                <a href="" class="sidebar-link cargar-vista"
                data-url="{{ route('impuestos') }}">
                    <i class="bi bi-percent text-warning"></i>
                    Impuestos
                </a>
            @endif

            @if(in_array('vista_metodos_pago', session('permisos', [])))
            <a href="" class="sidebar-link cargar-vista"
               data-url="{{ route('metodos.pago') }}">
                <i class="bi bi-credit-card text-primary"></i>
                Métodos de Pago
            </a>
            @endif

            @if(in_array('vista_credenciales', session('permisos', [])))
                <a href="" class="sidebar-link cargar-vista"
                data-url="{{ route('credenciales') }}">
                    <i class="bi bi-building text-success"></i>
                    Credenciales Empresa
                </a>
            @endif

            @if(in_array('vista_respaldo', session('permisos', [])))
                <a href="" class="sidebar-link cargar-vista"
                data-url="{{ route('respaldo') }}">
                    <i class="bi bi-database-fill-lock text-primary"></i>
                    Respaldo y restauración de base de datos
                </a>
            @endif
            <div style="margin-top: 50px"></div>

        </div>

    </div>

    <!-- ╔════════════ CONTENT ════════════╗ -->

    <div class="content">

        <div class="topbar d-flex justify-content-between align-items-center px-2">

            <div id="titulo"></div>

            <div id="perfil">

                <strong>
                    {{ session('usuario')['nombre'] ?? 'Invitado' }}
                </strong>

                <small>
                    ({{ session('usuario')['rol'] ?? 'Sin rol' }})
                </small>

                <button id="btnLogout" class="btn btn-sm">
                    Cerrar sesión
                    <i class="bi bi-box-arrow-right"></i>
                </button>

            </div>

        </div>

        <div id="contenido-dinamico">
            @yield('contenido')
        </div>

    </div>

</div>

</body>
</html>