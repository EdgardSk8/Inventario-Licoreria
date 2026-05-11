<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/principal/principal');
});

/*  ╔════════════ Insercion de controladores ════════════╗ 
    ╚════════════════════════════════════════════════════╝ */

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\TipoGastoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CredencialesController;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\MovimientoInventarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\MovimientoCajaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\TransferenciaCajaCuentaController;
use App\Http\Controllers\MovimientoCuentaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\MovimientoGastoController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RolPermisoController;

/*  ╔════════════ LOGIN ═════════════╗ 
    ╚════════════════════════════════╝ */

Route::view('/login', 'login.Login')->name('login'); 

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/* ════════════════════════════════════════════════════════════════════════════════════════════════════════════ */

/*  ╔════════════ Cargar de Vistas Dinamicas ════════════╗ 
    ╚════════════════════════════════════════════════════╝ */

Route::view('/dashboard', 'dashboard.Dashboard')
    ->middleware('permiso:ver_dashboard')
    ->name('dashboard');

Route::view('/usuarios', 'usuarios.Usuario')
    ->middleware('permiso:ver_usuarios')
    ->name('usuarios');

Route::view('/usuarios/detalle', 'usuarios.DetalleUsuario')
    ->middleware('permiso:ver_usuarios')
    ->name('detalle.usuarios');

Route::view('/proveedores', 'proveedores.Proveedores')
    ->middleware('permiso:ver_proveedores')
    ->name('proveedores');

Route::view('/proveedores/detalle', 'proveedores.DetalleProveedor')
    ->middleware('permiso:ver_proveedores')
    ->name('detalle.proveedores');

Route::view('/productos', 'productos.Productos')
    ->middleware('permiso:ver_productos')
    ->name('productos');

Route::view('/productos/detalle', 'productos.DetalleProducto')
    ->middleware('permiso:ver_productos')
    ->name('detalle.productos');

Route::view('/roles', 'roles.Roles')
    ->middleware('permiso:ver_roles')
    ->name('roles');

Route::view('/permisos', 'permisos.Permisos')
    ->middleware('permiso:gestionar_roles_permisos')
    ->name('permisos');

Route::view('/categorias', 'categorias.Categorias')
    ->middleware('permiso:ver_categorias')
    ->name('categorias');

Route::view('/clientes', 'clientes.Clientes')
    ->middleware('permiso:ver_clientes')
    ->name('clientes');

Route::view('/clientes/detalle', 'clientes.DetalleCliente')
    ->middleware('permiso:ver_clientes')
    ->name('detalle.clientes');

Route::view('/compras/crear', 'compras.CrearCompra')
    ->middleware('permiso:registrar_compras')
    ->name('crear.compras');

Route::view('/compras', 'compras.Compras')
    ->middleware('permiso:ver_compras')
    ->name('compras');

Route::view('/compras/detalle', 'compras.DetalleCompra')
    ->middleware('permiso:ver_compras')
    ->name('detalle.compras');

Route::view('/ventas', 'ventas.Ventas')
    ->middleware('permiso:ver_ventas')
    ->name('ventas');

Route::view('/ventas/detalle', 'ventas.DetalleVenta')
    ->middleware('permiso:ver_ventas')
    ->name('detalle.ventas');

Route::view('/impuestos', 'impuestos.Impuestos')
    ->middleware('permiso:ver_impuestos')
    ->name('impuestos');

Route::view('/cajas', 'cajas.Cajas')
    ->middleware('permiso:ver_cajas')
    ->name('cajas');

Route::view('/cajas/detalle', 'cajas.DetalleCaja')
    ->middleware('permiso:ver_cajas')
    ->name('detalle.cajas');

Route::view('/cajas/movimientos', 'movimiento_caja.Movimientos_Caja')
    ->middleware('permiso:ver_cajas')
    ->name('movimientos.cajas');

Route::view('/inventario/movimientos', 'inventario.MovimientosInventario')
    ->middleware('permiso:ver_inventario')
    ->name('movimientos.inventario');

Route::view('/gastos', 'gastos.Gastos')
    ->middleware('permiso:ver_gastos')
    ->name('gastos');

Route::view('/tipos-gasto', 'tipos_gasto.TiposGasto')
    ->middleware('permiso:ver_tipos_gasto')
    ->name('tipos.gasto');

Route::view('/metodos-pago', 'metodos_pago.MetodosPago')
    ->middleware('permiso:ver_metodos_pago')
    ->name('metodos.pago');

Route::view('/facturacion', 'facturacion.Facturacion')
    ->middleware('permiso:usar_facturacion')
    ->name('facturacion');

Route::view('/credenciales', 'credenciales.Credenciales')
    ->middleware('permiso:ver_credenciales')
    ->name('credenciales');

Route::view('/transferencia', 'transferenciacajacuenta.Transferencia')
    ->middleware('permiso:transferir_cuentas')
    ->name('transferencia');

Route::view('/cuentas', 'cuentas.Cuentas')
    ->middleware('permiso:ver_cuentas')
    ->name('cuentas');

Route::view('/cuentas/movimientos', 'movimiento_cuenta.Movimientos_Cuentas')
    ->middleware('permiso:ver_cuentas')
    ->name('movimientos.cuentas');

Route::view('/gastos/movimientos', 'movimiento_gasto.Movimientos_Gastos')
    ->middleware('permiso:ver_gastos')
    ->name('movimientos.gastos');

/* ════════════════════════════════════════════════════════════════════════════════════════════════════════════ */
    
/*  ╔═══════════ Endpoint DASHBOARD ═════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/dashboard/ventas', [DashboardController::class, 'ventas'])->middleware('permiso:ver_dashboard');
Route::get('/dashboard/movimiento-inventario', [DashboardController::class, 'movimientoinventario'])->middleware('permiso:ver_dashboard');

/* CONTROLADORES */

/*  ╔════════════ Endpoint Empresa ══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/credenciales/{id}/editar', [CredencialesController::class, 'EditarCredencial'])->middleware('permiso:ver_credenciales');
Route::put('/credenciales/{id}/actualizar', [CredencialesController::class, 'ActualizarCredenciales'])->middleware('permiso:editar_credenciales');
Route::get('/tipo-cambio', [CredencialesController::class, 'MostrarTipoCambio'])->middleware('permiso:ver_credenciales');
Route::post('/tipo-cambio', [CredencialesController::class, 'ActualizarTipoCambio'])->middleware('permiso:editar_credenciales');
Route::get('/empresa/mostrar', [CredencialesController::class, 'MostrarCredenciales'])->middleware('permiso:ver_credenciales');


/*  ╔════════════ Endpoint Usuario ══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::post('/usuarios/crear', [UsuarioController::class, 'CrearUsuario']) ->middleware('permiso:crear_usuarios');
Route::get('/usuarios/{id}/editar', [UsuarioController::class, 'EditarUsuario']) ->middleware('permiso:editar_usuarios');
Route::put('/usuarios/{id}/actualizar', [UsuarioController::class, 'ActualizarUsuario']) ->middleware('permiso:editar_usuarios');
Route::get('/usuarios/mostrar', [UsuarioController::class, 'MostrarUsuarios']) ->middleware('permiso:ver_usuarios');
Route::post('/usuarios/cambiar-estado/{id}', [UsuarioController::class, 'cambiarEstadoUsuario']) ->middleware('permiso:editar_usuarios');

Route::get('/roles-usuario/mostrar', [UsuarioController::class, 'MostrarRolesUsuario'])->middleware('permiso:ver_roles');

/*  ╔═══════════ Endpoint Categorias ════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/categorias/mostrar', [CategoriaController::class, 'MostrarCategorias'])->middleware('permiso:ver_categorias');
Route::post('/categorias/crear', [CategoriaController::class, 'CrearCategoria'])->middleware('permiso:crear_categorias');
Route::get('/categorias/{id}/editar', [CategoriaController::class, 'EditarCategoria'])->middleware('permiso:ver_categorias');
Route::put('/categorias/{id}/actualizar', [CategoriaController::class, 'ActualizarCategoria'])->middleware('permiso:editar_categorias');
Route::post('/categorias/cambiar-estado/{id}', [CategoriaController::class, 'CambiarEstadoCategoria'])->middleware('permiso:editar_categorias');

/*  ╔════════════ Endpoint Impuestos ════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/impuestos/mostrar', [ImpuestoController::class, 'MostrarImpuestos'])->middleware('permiso:ver_impuestos');
Route::post('/impuestos/crear', [ImpuestoController::class, 'CrearImpuesto'])->middleware('permiso:crear_impuestos');
Route::get('/impuestos/{id}/editar', [ImpuestoController::class, 'EditarImpuesto'])->middleware('permiso:ver_impuestos');
Route::put('/impuestos/{id}/actualizar', [ImpuestoController::class, 'ActualizarImpuesto'])->middleware('permiso:editar_impuestos');
Route::post('/impuestos/cambiar-estado/{id}', [ImpuestoController::class, 'CambiarEstadoImpuesto'])->middleware('permiso:editar_impuestos');

/*  ╔═══════════ Endpoint Metodo Pago ═══════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/metodos-pago/mostrar', [MetodoPagoController::class, 'MostrarMetodosPago'])->middleware('permiso:ver_metodos_pago');
Route::post('/metodos-pago/crear', [MetodoPagoController::class, 'CrearMetodoPago'])->middleware('permiso:crear_metodos_pago');
Route::get('/metodos-pago/{id}/editar', [MetodoPagoController::class, 'EditarMetodoPago'])->middleware('permiso:ver_metodos_pago');
Route::put('/metodos-pago/{id}/actualizar', [MetodoPagoController::class, 'ActualizarMetodoPago'])->middleware('permiso:editar_metodos_pago');
Route::post('/metodos-pago/cambiar-estado/{id}', [MetodoPagoController::class, 'CambiarEstadoMetodoPago'])->middleware('permiso:editar_metodos_pago');

/*  ╔══════════════ Endpoint Gastos ═════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/gastos/mostrar', [GastoController::class, 'MostrarGastos']) ->middleware('permiso:ver_gastos');
Route::post('/gastos/crear', [GastoController::class, 'CrearGasto']) ->middleware('permiso:crear_gastos');
Route::get('/gastos/editar/{id}', [GastoController::class, 'EditarGasto']) ->middleware('permiso:editar_gastos');
Route::post('/gastos/actualizar/{id}', [GastoController::class, 'ActualizarGasto']) ->middleware('permiso:editar_gastos');
Route::post('/gastos/pagar', [GastoController::class, 'PagarGasto']) ->middleware('permiso:pagar_gastos');
Route::get('/gastos-cuentas/mostrar', [GastoController::class, 'MostrarCuentasGastos']) ->middleware('permiso:ver_gastos');
Route::get('/gastos-cajas/mostrar', [GastoController::class, 'MostrarCajasGastos']) ->middleware('permiso:ver_gastos');
Route::get('/gastos/detalle/{id}', [GastoController::class, 'DetalleGasto']) ->middleware('permiso:ver_gastos');
Route::post('/gastos/movimiento/editar', [GastoController::class, 'EditarMovimientoGasto']) ->middleware('permiso:editar_gastos');

/*  ╔════════ Endpoint Movimiento Gasto ═════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/movimientos-gastos/mostrar', [MovimientoGastoController::class, 'MostrarMovimientosGastos'])->middleware('permiso:ver_gastos');


/*  ╔══════════ Endpoint Tipo de Gasto ══════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/tipo-gasto/mostrar', [TipoGastoController::class, 'MostrarTipoGasto']) ->middleware('permiso:ver_tipos_gasto');
Route::post('/tipo-gasto/crear', [TipoGastoController::class, 'CrearTipoGasto']) ->middleware('permiso:crear_tipos_gasto');
Route::get('/tipo-gasto/{id}/editar', [TipoGastoController::class, 'EditarTipoGasto']) ->middleware('permiso:ver_tipos_gasto');
Route::put('/tipo-gasto/{id}/actualizar', [TipoGastoController::class, 'ActualizarTipoGasto']) ->middleware('permiso:editar_tipos_gasto');
Route::post('/tipo-gasto/cambiar-estado/{id}', [TipoGastoController::class, 'CambiarEstadoTipoGasto']) ->middleware('permiso:editar_tipos_gasto');

/*  ╔══════════════ Endpoint Cliente ══════════════╗ 
    ╚══════════════════════════════════════════════╝ */

Route::get('/clientes/mostrar', [ClienteController::class, 'MostrarClientes']) ->middleware('permiso:ver_clientes');
Route::post('/clientes/crear', [ClienteController::class, 'CrearCliente']) ->middleware('permiso:crear_clientes');
Route::get('/clientes/{id}/editar', [ClienteController::class, 'EditarCliente']) ->middleware('permiso:ver_clientes');
Route::put('/clientes/{id}/actualizar', [ClienteController::class, 'ActualizarCliente']) ->middleware('permiso:editar_clientes');
Route::post('/clientes/cambiar-estado/{id}', [ClienteController::class, 'CambiarEstadoCliente']) ->middleware('permiso:editar_clientes');

/*  ╔════════════ Endpoint Proveedores ════════════╗ 
    ╚══════════════════════════════════════════════╝ */

Route::get('/proveedores/mostrar', [ProveedorController::class, 'MostrarProveedores']) ->middleware('permiso:ver_proveedores');
Route::post('/proveedores/crear', [ProveedorController::class, 'CrearProveedor']) ->middleware('permiso:crear_proveedores');
Route::get('/proveedores/{id}/editar', [ProveedorController::class, 'EditarProveedor']) ->middleware('permiso:ver_proveedores');
Route::put('/proveedores/{id}/actualizar', [ProveedorController::class, 'ActualizarProveedor']) ->middleware('permiso:editar_proveedores');
Route::post('/proveedores/cambiar-estado/{id}', [ProveedorController::class, 'CambiarEstadoProveedor']) ->middleware('permiso:editar_proveedores');

/*  ╔══════════════ Endpoint Cajas ══════════════╗ 
    ╚════════════════════════════════════════════╝ */

/*Route::post('/cajas/abrir', [CajaController::class, 'AbrirCaja']);
Route::post('/cajas/cerrar', [CajaController::class, 'CerrarCaja']);*/

Route::get('/cajas/registro', [CajaController::class, 'RegistroCajas']) ->middleware('permiso:ver_cajas');

/*  ╔════════════ Endpoint Productos ════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/productos/mostrar', [ProductoController::class, 'MostrarProductos']) ->middleware('permiso:ver_productos');
Route::post('/productos/crear', [ProductoController::class, 'CrearProducto']) ->middleware('permiso:crear_productos');
Route::get('/productos/{id}/editar', [ProductoController::class, 'EditarProducto']) ->middleware('permiso:editar_productos');
Route::put('/productos/{id}/actualizar', [ProductoController::class, 'ActualizarProducto']) ->middleware('permiso:editar_productos');
Route::post('/productos/cambiar-estado/{id}', [ProductoController::class, 'CambiarEstadoProducto']) ->middleware('permiso:editar_productos');

Route::get('/productos/formulario', [ProductoController::class, 'ObtenerDatosFormularioProducto']) ->middleware('permiso:ver_productos');


/*  ╔══════════════ Endpoint Roles ══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/roles/mostrar', [RolController::class, 'MostrarRoles']) ->middleware('permiso:ver_roles');
Route::post('/roles/crear', [RolController::class, 'CrearRol']) ->middleware('permiso:crear_roles');
Route::get('/roles/{id}/editar', [RolController::class, 'EditarRol']) ->middleware('permiso:editar_roles');
Route::put('/roles/{id}/actualizar', [RolController::class, 'ActualizarRol']) ->middleware('permiso:editar_roles');
Route::post('/roles/cambiar-estado/{id}', [RolController::class, 'CambiarEstadoRol']) ->middleware('permiso:editar_roles');

/*  ╔══════════════ Endpoint Ventas ═════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/ventas/mostrar', [VentaController::class, 'MostrarVentas']) ->middleware('permiso:ver_ventas');
Route::post('/ventas/anular/{id}', [VentaController::class, 'AnularVenta']) ->middleware('permiso:anular_ventas');

/*  ╔══════════ Endpoint Detalle Ventas ═════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/ventas/{id}/detalle', [DetalleVentaController::class, 'MostrarDetalleVenta']) ->middleware('permiso:ver_ventas');

/*  ╔══════ Movimiento Inventario (Kardex) ══════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/movimiento-inventario/mostrar', [MovimientoInventarioController::class, 'MostrarMovimientosInventario']) ->middleware('permiso:ver_inventario');

/*  ╔═══════ Movimiento caja (Kardex) ═══════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/movimientos-caja/mostrar', [MovimientoCajaController::class, 'MostrarMovimientosCaja']) ->middleware('permiso:ver_cajas');


/*  ╔═══════════ Cuentas (Kardex) ═══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/cuenta/mostrar', [CuentaController::class, 'MostrarCuentas']) ->middleware('permiso:ver_cuentas');
Route::post('/cuenta/crear', [CuentaController::class, 'CrearCuenta']) ->middleware('permiso:crear_cuentas');
Route::get('/cuenta/{id}/editar', [CuentaController::class, 'EditarCuenta']) ->middleware('permiso:editar_cuentas');
Route::put('/cuenta/{id}/actualizar', [CuentaController::class, 'ActualizarCuenta']) ->middleware('permiso:editar_cuentas');
Route::post('/cuenta/cambiar-estado/{id}', [CuentaController::class, 'CambiarEstadoCuenta']) ->middleware('permiso:editar_cuentas');
Route::post('/cuenta/transferir', [CuentaController::class, 'TransferirEntreCuentas']) ->middleware('permiso:transferir_cuentas');
Route::get('/cuenta/mostrarselector', [CuentaController::class, 'MostrarCuentasSelector']) ->middleware('permiso:ver_cuentas');

/*  ╔══════ Movimiento Cuentas (Kardex) ═════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/movimientos-cuenta/mostrar', [MovimientoCuentaController::class, 'MostrarMovimientosCuenta']) ->middleware('permiso:ver_cuentas');
Route::post('/cuenta/movimiento', [MovimientoCuentaController::class, 'MovimientoCuenta']) ->middleware('permiso:gestionar_cuentas');


/*  ╔════════ Transferencias (Kardex) ═══════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/movimientos-caja-cuenta/mostrar', [TransferenciaCajaCuentaController::class, 'MostrarCajaTransferencia']) ->middleware('permiso:ver_transferencias');
Route::post('/movimientos-caja-cuenta/transferir', [TransferenciaCajaCuentaController::class, 'TransferenciaCajaCuenta']) ->middleware('permiso:transferir_cuentas');
Route::get('/movimientos-caja-cuenta/detalle/{id}', [TransferenciaCajaCuentaController::class, 'MostrarDetalleCuenta']) ->middleware('permiso:ver_transferencias');

/*  ╔════════════════ FACTURACION ═══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/productos/pos', [FacturacionController::class, 'MostrarProductosPOS']) ->middleware('permiso:usar_facturacion');
Route::get('/clientes/pos', [FacturacionController::class, 'MostrarClientesPOS']) ->middleware('permiso:usar_facturacion');
Route::post('/facturar/pos', [FacturacionController::class, 'FacturarProductosPOS']) ->middleware('permiso:usar_facturacion');
Route::get('/metodo-pago/pos', [FacturacionController::class, 'MostrarMetodoPagoPOS']) ->middleware('permiso:usar_facturacion');
Route::post('/validar-stock-carrito', [FacturacionController::class, 'ValidarStockCarrito']) ->middleware('permiso:usar_facturacion');

Route::post('/caja/abrir', [CajaController::class, 'AbrirCaja']) ->middleware('permiso:gestionar_caja');
Route::post('/caja/cerrar', [CajaController::class, 'CerrarCaja']) ->middleware('permiso:gestionar_caja');
Route::get('/caja/verificar', [CajaController::class, 'VerificarCaja']) ->middleware('permiso:ver_cajas');


/*  ╔═════════════ Endpoint Compras ═════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::post('/compra/crear', [CompraController::class, 'RegistrarCompra'])->middleware('permiso:registrar_compras');

Route::get('/proveedores-compra/mostrar', [CompraController::class, 'MostrarProveedoresCompras']) ->middleware('permiso:ver_compras');
Route::get('/tipo-factura-compra/mostrar', [CompraController::class, 'MostrarTiposFacturaCompras']) ->middleware('permiso:ver_compras');
Route::get('/metodo-pago-compra/mostrar', [CompraController::class, 'MostrarMetodosPagoCompras']) ->middleware('permiso:ver_compras');
Route::get('/cuenta-compra/mostrar', [CompraController::class, 'MostrarCuentasCompras']) ->middleware('permiso:ver_compras');
Route::get('/caja-compra/mostrar', [CompraController::class, 'mostrarCajasAbiertas']) ->middleware('permiso:ver_compras');
Route::get('/productos-compra/mostrar', [CompraController::class, 'MostrarProductosCompras']) ->middleware('permiso:ver_compras');
Route::get('/compras/mostrar', [CompraController::class, 'MostrarCompras']) ->middleware('permiso:ver_compras');
Route::post('/compras/anular/{id}', [CompraController::class, 'AnularCompra']) ->middleware('permiso:anular_compras');

/*  ╔═════════ Endpoint Detalle Compras ═════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/compras/{id}/detalle', [DetalleCompraController::class, 'MostrarDetalleCompra']) ->middleware('permiso:ver_compras');

/*  ╔════════════ Endpoint Permisos ═════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/roles/permisos', [RolPermisoController::class, 'obtenerRolesPermisos']) ->middleware('permiso:gestionar_roles_permisos');
Route::post('/roles/permisos/asignar', [RolPermisoController::class, 'asignar']) ->middleware('permiso:gestionar_roles_permisos');


