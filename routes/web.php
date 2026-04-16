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

/*  ╔════════════ LOGIN ═════════════╗ 
    ╚════════════════════════════════╝ */

Route::view('/login', 'login.Login')->name('login'); 

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*  ╔════════════ Cargar de Vistas Dinamicas ════════════╗ 
    ╚════════════════════════════════════════════════════╝ */

Route::view('/dashboard', 'dashboard')->name('dashboard'); 
Route::view('/usuarios', 'usuarios.Usuario')->name('usuarios'); 
Route::view('/usuarios/detalle', 'usuarios.DetalleUsuario')->name('detalle.usuarios'); 
Route::view('/proveedores', 'proveedores.Proveedores')->name('proveedores'); 
Route::view('/proveedores/detalle', 'proveedores.DetalleProveedor')->name('detalle.proveedores'); 
Route::view('/productos', 'productos.Productos')->name('productos'); 
Route::view('/productos/detalle', 'productos.DetalleProducto')->name('detalle.productos'); 
Route::view('/roles', 'roles.Roles')->name('roles'); 
Route::view('/permisos', 'permisos.Permisos')->name('permisos'); 
Route::view('/categorias', 'categorias.Categorias')->name('categorias'); 
Route::view('/clientes', 'clientes.Clientes')->name('clientes'); 
Route::view('/clientes/detalle', 'clientes.DetalleCliente')->name('detalle.clientes'); 
Route::view('/compras', 'compras.Compras')->name('compras'); 
Route::view('/compras/detalle', 'compras.DetalleCompra')->name('detalle.compras'); 
Route::view('/ventas', 'ventas.Ventas')->name('ventas'); 
Route::view('/ventas/detalle', 'ventas.DetalleVenta')->name('detalle.ventas'); 
Route::view('/impuestos', 'impuestos.Impuestos')->name('impuestos'); 
Route::view('/cajas', 'cajas.Cajas')->name('cajas'); 
Route::view('/cajas/detalle', 'cajas.DetalleCaja')->name('detalle.cajas'); 
Route::view('/cajas/movimientos', 'movimiento_caja.Movimientos_Caja')->name('movimientos.cajas'); 
Route::view('/inventario/movimientos', 'inventario.MovimientosInventario')->name('movimientos.inventario'); 
Route::view('/gastos', 'gastos.Gastos')->name('gastos'); 
Route::view('/tipos-gasto', 'tipos_gasto.TiposGasto')->name('tipos.gasto'); 
Route::view('/metodos-pago', 'metodos_pago.MetodosPago')->name('metodos.pago'); 
Route::view('/facturacion', 'facturacion.Facturacion')->name('facturacion'); 
Route::view('/credenciales', 'credenciales.Credenciales')->name('credenciales');
Route::view('/cuenta', 'cuenta.Cuenta')->name('cuentas'); 

/* CONTROLADORES */

/*  ╔════════════ Endpoint Empresa ══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/credenciales/{id}/editar', [CredencialesController::class, 'EditarCredencial']);
Route::put('/credenciales/{id}/actualizar', [CredencialesController::class, 'ActualizarCredenciales']);
Route::get('/tipo-cambio', [CredencialesController::class, 'MostrarTipoCambio']);
Route::post('/tipo-cambio', [CredencialesController::class, 'ActualizarTipoCambio']);

Route::get('/empresa/mostrar', [CredencialesController::class, 'MostrarCredenciales']);


/*  ╔════════════ Endpoint Usuario ══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::post('/usuarios/crear', [UsuarioController::class, 'CrearUsuario']);
Route::get('/usuarios/{id}/editar', [UsuarioController::class, 'EditarUsuario']);
Route::put('/usuarios/{id}/actualizar', [UsuarioController::class, 'ActualizarUsuario']);
Route::get('/usuarios/mostrar', [UsuarioController::class, 'MostrarUsuarios']);
Route::post('/usuarios/cambiar-estado/{id}', [UsuarioController::class, 'cambiarEstadoUsuario']);

Route::get('/roles-usuario/mostrar', [UsuarioController::class, 'MostrarRolesUsuario']);

/*  ╔═══════════ Endpoint Categorias ════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/categorias/mostrar', [CategoriaController::class, 'MostrarCategorias']);
Route::post('/categorias/crear', [CategoriaController::class, 'CrearCategoria']);
Route::get('/categorias/{id}/editar', [CategoriaController::class, 'EditarCategoria']);
Route::put('/categorias/{id}/actualizar', [CategoriaController::class, 'ActualizarCategoria']);
Route::post('/categorias/cambiar-estado/{id}', [CategoriaController::class, 'CambiarEstadoCategoria']);

/*  ╔════════════ Endpoint Impuestos ════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/impuestos/mostrar', [ImpuestoController::class, 'MostrarImpuestos']);
Route::post('/impuestos/crear', [ImpuestoController::class, 'CrearImpuesto']);
Route::get('/impuestos/{id}/editar', [ImpuestoController::class, 'EditarImpuesto']);
Route::put('/impuestos/{id}/actualizar', [ImpuestoController::class, 'ActualizarImpuesto']);
Route::post('/impuestos/cambiar-estado/{id}', [ImpuestoController::class, 'CambiarEstadoImpuesto']);

/*  ╔═══════════ Endpoint Metodo Pago ═══════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/metodos-pago/mostrar', [MetodoPagoController::class, 'MostrarMetodosPago']);
Route::post('/metodos-pago/crear', [MetodoPagoController::class, 'CrearMetodoPago']);
Route::get('/metodos-pago/{id}/editar', [MetodoPagoController::class, 'EditarMetodoPago']);
Route::put('/metodos-pago/{id}/actualizar', [MetodoPagoController::class, 'ActualizarMetodoPago']);
Route::post('/metodos-pago/cambiar-estado/{id}', [MetodoPagoController::class, 'CambiarEstadoMetodoPago']);

/*  ╔══════════ Endpoint Tipo de Gasto ══════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/tipo-gasto/mostrar', [TipoGastoController::class, 'MostrarTipoGasto']);
Route::post('/tipo-gasto/crear', [TipoGastoController::class, 'CrearTipoGasto']);
Route::get('/tipo-gasto/{id}/editar', [TipoGastoController::class, 'EditarTipoGasto']);
Route::put('/tipo-gasto/{id}/actualizar', [TipoGastoController::class, 'ActualizarTipoGasto']);
Route::post('/tipo-gasto/cambiar-estado/{id}', [TipoGastoController::class, 'CambiarEstadoTipoGasto']);

/*  ╔══════════════ Endpoint Cliente ══════════════╗ 
    ╚══════════════════════════════════════════════╝ */

Route::get('/clientes/mostrar', [ClienteController::class, 'MostrarClientes']);
Route::post('/clientes/crear', [ClienteController::class, 'CrearCliente']);
Route::get('/clientes/{id}/editar', [ClienteController::class, 'EditarCliente']);
Route::put('/clientes/{id}/actualizar', [ClienteController::class, 'ActualizarCliente']);
Route::post('/clientes/cambiar-estado/{id}', [ClienteController::class, 'CambiarEstadoCliente']);

/*  ╔════════════ Endpoint Proveedores ════════════╗ 
    ╚══════════════════════════════════════════════╝ */

Route::get('/proveedores/mostrar', [ProveedorController::class, 'MostrarProveedores']);
Route::post('/proveedores/crear', [ProveedorController::class, 'CrearProveedor']);
Route::get('/proveedores/{id}/editar', [ProveedorController::class, 'EditarProveedor']);
Route::put('/proveedores/{id}/actualizar', [ProveedorController::class, 'ActualizarProveedor']);
Route::post('/proveedores/cambiar-estado/{id}', [ProveedorController::class, 'CambiarEstadoProveedor']);

/*  ╔══════════════ Endpoint Cajas ══════════════╗ 
    ╚════════════════════════════════════════════╝ */

/*Route::post('/cajas/abrir', [CajaController::class, 'AbrirCaja']);
Route::post('/cajas/cerrar', [CajaController::class, 'CerrarCaja']);*/

Route::get('/cajas/registro', [CajaController::class, 'RegistroCajas']);

/*  ╔════════════ Endpoint Productos ════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/productos/mostrar', [ProductoController::class, 'MostrarProductos']);
Route::post('/productos/crear', [ProductoController::class, 'CrearProducto']);
Route::get('/productos/{id}/editar', [ProductoController::class, 'EditarProducto']);
Route::put('/productos/{id}/actualizar', [ProductoController::class, 'ActualizarProducto']);
Route::post('/productos/cambiar-estado/{id}', [ProductoController::class, 'CambiarEstadoProducto']);

Route::get('/productos/formulario', [ProductoController::class, 'ObtenerDatosFormularioProducto']);


/*  ╔══════════════ Endpoint Roles ══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/roles/mostrar', [RolController::class, 'MostrarRoles']);
Route::post('/roles/crear', [RolController::class, 'CrearRol']);
Route::get('/roles/{id}/editar', [RolController::class, 'EditarRol']);
Route::put('/roles/{id}/actualizar', [RolController::class, 'ActualizarRol']);
Route::post('/roles/cambiar-estado/{id}', [RolController::class, 'CambiarEstadoRol']);

/*  ╔══════════════ Endpoint Ventas ═════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/ventas/mostrar', [VentaController::class, 'MostrarVentas']);

/*  ╔══════════ Endpoint Detalle Ventas ═════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/ventas/{id}/detalle', [DetalleVentaController::class, 'MostrarDetalleVenta']);

/*  ╔══════ Movimiento Inventario (Kardex) ══════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/movimiento-inventario/mostrar', [MovimientoInventarioController::class, 'MostrarMovimientosInventario']);

/*  ╔═══════ Movimiento caja (Kardex) ═══════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/movimientos-caja/mostrar', [MovimientoCajaController::class, 'MostrarMovimientosCaja']);


/*  ╔═══════════ Cuentas (Kardex) ═══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/movimientos-caja-cuenta/mostrar', [TransferenciaCajaCuentaController::class, 'MostrarCajaTransferencia']);
Route::post('/movimientos-caja-cuenta/transferir', [TransferenciaCajaCuentaController::class, 'TransferenciaCajaCuenta']);
Route::get('/movimientos-caja-cuenta/detalle/{id}', [TransferenciaCajaCuentaController::class, 'MostrarDetalleCuenta']);

/*  ╔════════════════ FACTURACION ═══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/productos/pos', [FacturacionController::class, 'MostrarProductosPOS']);
Route::get('/clientes/pos', [FacturacionController::class, 'MostrarClientesPOS']);
Route::post('/facturar/pos', [FacturacionController::class, 'FacturarProductosPOS']);
Route::get('/metodo-pago/pos', [FacturacionController::class, 'MostrarMetodoPagoPOS']);
Route::post('/validar-stock-carrito', [FacturacionController::class, 'ValidarStockCarrito']);

Route::post('/caja/abrir', [CajaController::class, 'AbrirCaja']);
Route::post('/caja/cerrar', [CajaController::class, 'CerrarCaja']);
Route::get('/caja/verificar', [CajaController::class, 'VerificarCaja']);


/*  ╔═════════════ Endpoint Compras ═════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::post('/compra/crear', [CompraController::class, 'RegistrarCompra']);

Route::get('/proveedores-compra/mostrar', [CompraController::class, 'MostrarProveedoresCompras']);
Route::get('/tipo-factura-compra/mostrar', [CompraController::class, 'MostrarTiposFacturaCompras']);
Route::get('/metodo-pago-compra/mostrar', [CompraController::class, 'MostrarMetodosPagoCompras']);
Route::get('/cuenta-compra/mostrar', [CompraController::class, 'MostrarCuentasCompras']);
Route::get('/caja-compra/mostrar', [CompraController::class, 'mostrarCajasAbiertas']);
Route::get('/productos-compra/mostrar', [CompraController::class, 'MostrarProductosCompras']);
