<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">

<title>Sistema</title>

<!-- @vite(['resources/js/app.js']) -->
@include('principal.links')
@vite(['resources/css/principal/principal.css'])
@vite(['resources/css/principal/footer.css'])
@vite(['resources/css/app.css'])

@vite(['resources/js/principal/cargavistahijo.js'])
@vite(['resources/js/principal/cerrar_acordeon.js'])
@vite(['resources/js/principal/logout.js'])
@vite(['resources/js/FuncionesGlobales.js'])


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
@if(in_array('vista_dashboard', session('permisos', [])))
<!-- ╔════════════ DASHBOARD ════════════╗ -->
<div id="dashboardbtn">
    <i class="bi bi-speedometer2"></i>
    
        <a href="" class="cargar-vista" data-url="{{ route('dashboard') }}">Dashboard</a>
   
</div>
 @endif
<!-- ╔════════════ VENTAS ═══════════════╗ -->
<div class="accordion-item border-0">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#ventas">
            <i class="bi bi-cash-coin me-2"></i> Ventas
        </button>
    </h2>

    <div id="ventas" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">
        <div class="submenu">

            @if(in_array('vista_facturacion', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('facturacion') }}">
                    <i class="bi bi-receipt me-2"></i> Facturación
                </a>
            @endif

            @if(in_array('vista_ventas', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('ventas') }}">
                    <i class="bi bi-clock-history me-2 text-primary"></i> Historial de Ventas
                </a>
            @endif

            @if(in_array('vista_clientes', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('clientes') }}">
                    <i class="bi bi-person-lines-fill me-2 text-warning"></i> Clientes
                </a>
            @endif

        </div>
    </div>
</div>

<!-- ╔════════════ COMPRAS ══════════════╗ -->
<div class="accordion-item border-0">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#compras">
            <i class="bi bi-truck me-2"></i> Compras
        </button>
    </h2>

    <div id="compras" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">
        <div class="submenu">

            @if(in_array('vista_crear_compras', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('crear.compras') }}">
                    <i class="bi bi-cart-check me-2 text-success"></i> Realizar Compra
                </a>
            @endif

            @if(in_array('vista_compras', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('compras') }}">
                    <i class="bi bi-card-checklist me-2"></i> Lista de compras
                </a>
            @endif

            @if(in_array('vista_proveedores', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('proveedores') }}">
                    <i class="bi bi-truck me-2 text-primary"></i> Proveedores
                </a>
            @endif

        </div>
    </div>
</div>

<!-- ╔════════════ CAJA ═══════════════╗ -->
<div class="accordion-item border-0">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#caja">
            <i class="bi bi-wallet2 me-2"></i> Caja
        </button>
    </h2>

    <div id="caja" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">
        <div class="submenu">

            @if(in_array('vista_cajas', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('cajas') }}">
                    <i class="bi bi-wallet2 me-2 text-success"></i> Cajas
                </a>
            @endif

            @if(in_array('vista_movimientos_cajas', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('movimientos.cajas') }}">
                    <i class="bi bi-cash-stack me-2 text-primary"></i> Movimientos de Caja
                </a>
            @endif

        </div>
    </div>
</div>

<!-- ╔════════════ CUENTAS ═════════════╗ -->
<div class="accordion-item border-0">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#cuentas">
            <i class="bi bi-bank me-2"></i> Cuentas
        </button>
    </h2>

    <div id="cuentas" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">
        <div class="submenu">

            @if(in_array('vista_cuentas', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('cuentas') }}">
                    <i class="bi bi-bank me-2 text-success"></i> Cuentas
                </a>
            @endif

            @if(in_array('vista_movimientos_cuentas', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('movimientos.cuentas') }}">
                    <i class="bi bi-cash-coin me-2 text-primary"></i> Movimientos de Cuenta
                </a>
            @endif

        </div>
    </div>
</div>

<!-- ╔════════════ TRANSFERENCIAS ═════════════╗ -->
<div class="accordion-item border-0">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#transferencias">
            <i class="bi bi-arrow-left-right me-2"></i> Transferencias
        </button>
    </h2>

    <div id="transferencias" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">
        <div class="submenu">

            @if(in_array('vista_transferenciacajacuenta', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('transferencia') }}">
                    <i class="bi bi-arrow-left-right me-2 text-primary"></i>
                    Transferencias Caja → Cuenta
                </a>
            @endif

        </div>
    </div>
</div>

<!-- ╔════════════ GASTOS ══════════════╗ -->
<div class="accordion-item border-0">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#gastos">
            <i class="bi bi-receipt me-2"></i> Gastos
        </button>
    </h2>

    <div id="gastos" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">
        <div class="submenu">

            @if(in_array('vista_gastos', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('gastos') }}">
                    <i class="bi bi-cash-stack me-2 text-danger"></i> Gastos
                </a>
            @endif

            @if(in_array('vista_tipos_gasto', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('tipos.gasto') }}">
                    <i class="bi bi-tags me-2 text-primary"></i> Tipos de Gasto
                </a>
            @endif

            @if(in_array('vista_movimientos_gastos', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('movimientos.gastos') }}">
                    <i class="bi bi-arrow-left-right me-2 text-success"></i> Movimiento gastos
                </a>
            @endif

        </div>
    </div>
</div>

<!-- ╔════════════ INVENTARIO ════════════╗ -->
<div class="accordion-item border-0">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#productos">
            <i class="bi bi-box-seam me-2"></i> Inventario
        </button>
    </h2>

    <div id="productos" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">
        <div class="submenu">

            @if(in_array('vista_productos', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('productos') }}">
                    <i class="bi bi-box-seam me-2 text-primary"></i> Productos
                </a>
            @endif

            @if(in_array('vista_categorias', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('categorias') }}">
                    <i class="bi bi-tags me-2 text-warning"></i> Categorías
                </a>
            @endif

            @if(in_array('vista_movimientos_inventario', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('movimientos.inventario') }}">
                    <i class="bi bi-arrow-left-right me-2 text-success"></i> Movimientos de inventario
                </a>
            @endif

        </div>
    </div>
</div>

<!-- ╔════════════ ADMINISTRACIÓN ════════════╗ -->
<div class="accordion-item border-0">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#admin">
            <i class="bi bi-people me-2"></i> Administración
        </button>
    </h2>

    <div id="admin" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">
        <div class="submenu">

            @if(in_array('vista_usuarios', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('usuarios') }}">
                    <i class="bi bi-people me-2 text-primary"></i> Usuarios
                </a>
            @endif

            @if(in_array('vista_roles', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('roles') }}">
                    <i class="bi bi-person-badge me-2 text-success"></i> Roles
                </a>
            @endif

            @if(in_array('vista_permisos', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('permisos') }}">
                    <i class="bi bi-shield-lock me-2 text-danger"></i> Permisos
                </a>
            @endif

        </div>
    </div>
</div>

<!-- ╔════════════ CONFIGURACIÓN ════════════╗ -->
<div class="accordion-item border-0">
    <h2 class="accordion-header">
        <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#config">
            <i class="bi bi-gear me-2"></i> Configuración
        </button>
    </h2>

    <div id="config" class="accordion-collapse collapse" data-bs-parent="#menuSidebar">
        <div class="submenu">

            @if(in_array('vista_impuestos', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('impuestos') }}">
                    <i class="bi bi-percent me-2 text-warning"></i> Impuestos
                </a>
            @endif

            @if(in_array('vista_metodos_pago', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('metodos.pago') }}">
                    <i class="bi bi-credit-card me-2 text-primary"></i> Métodos de Pago
                </a>
            @endif

            @if(in_array('vista_credenciales', session('permisos', [])))
                <a href="" class="cargar-vista" data-url="{{ route('credenciales') }}">
                    <i class="bi bi-building me-2 text-success"></i> Credenciales de Empresa
                </a>
            @endif

        </div>
    </div>
</div>

    </div>

</div>


<!-- ╔═════════ CONTENIDO ═════════╗ -->
<!-- ╚═════════════════════════════╝ -->

<div class="content flex-grow-1">

    <div class="topbar d-flex justify-content-between align-items-center px-2">
        
        <!-- 🧾 Título -->
        <div id="titulo"></div>

        <!-- 👤 Usuario -->
        <div id="perfil">

            <strong>
                {{ session('usuario')['nombre'] ?? 'Invitado' }}
            </strong>

            <small>
                ({{ session('usuario')['rol'] ?? 'Sin rol' }})
            </small>

            <button id="btnLogout" class="btn btn-sm">
                Cerrar sesion
                <i class="bi bi-box-arrow-right"></i>
            </button>

        </div>

    </div>

    <div id="contenido-dinamico" class="ds">
        @yield('contenido')
    </div>

</body>
</html>