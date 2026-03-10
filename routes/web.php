<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/principal/principal');
});

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;


/* VISTAS DINAMICAS */

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
Route::view('/cajas/movimientos', 'cajas.MovimientosCaja')->name('movimientos.cajas'); 
Route::view('/inventario/movimientos', 'inventario.MovimientosInventario')->name('movimientos.inventario'); 
Route::view('/gastos', 'gastos.Gastos')->name('gastos'); 
Route::view('/tipos-gasto', 'tipos_gasto.TiposGasto')->name('tipos.gasto'); 
Route::view('/metodos-pago', 'metodos_pago.MetodosPago')->name('metodos.pago'); 

/* CONTROLADORES */

/*  ╔════════════ Endpoint Usuario ══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::post('/usuarios/crear', [UsuarioController::class, 'CrearUsuario']);
Route::get('/usuarios/{id}/editar', [UsuarioController::class, 'EditarUsuario']);
Route::put('/usuarios/{id}/actualizar', [UsuarioController::class, 'ActualizarUsuario']);
Route::get('/usuarios/mostrar', [UsuarioController::class, 'MostrarUsuarios']);
Route::post('/usuarios/cambiar-estado/{id}', [UsuarioController::class, 'cambiarEstadoUsuario']);

/*  ╔══════════════ Endpoint roles ══════════════╗ 
    ╚════════════════════════════════════════════╝ */

Route::get('/roles-usuario/mostrar', [RolController::class, 'MostrarRolesUsuario']);

Route::get('/roles/mostrar', [RolController::class, 'MostrarRoles']);
Route::post('/roles/crear', [RolController::class, 'CrearRol']);
Route::get('/roles/{id}/editar', [RolController::class, 'EditarRol']);
Route::put('/roles/{id}/actualizar', [RolController::class, 'ActualizarRol']);

Route::post('/roles/cambiar-estado/{id}', [RolController::class, 'CambiarEstadoRol']);
