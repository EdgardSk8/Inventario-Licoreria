
Enum "movimientos_caja_tipo_movimiento_caja_enum" {
  "INGRESO"
  "SALIDA"
}

Enum "movimientos_cuentas_tipo_movimiento_enum" {
  "INGRESO"
  "SALIDA"
}

Enum "movimientos_inventario_tipo_movimiento_enum" {
  "ENTRADA"
  "SALIDA"
  "AJUSTE"
}

Enum "movimientos_inventario_tipo_referencia_enum" {
  "VENTA"
  "COMPRA"
  "DEVOLUCION"
  "TRASLADO"
  "AJUSTE"
}

Table "cajas" {
  "id_caja" int(10) [pk, not null]
  "fecha_apertura" datetime [not null, default: `current_timestamp()`]
  "fecha_cierre" datetime
  "monto_inicial" decimal(10,2) [not null]
  "monto_final" decimal(10,2)
  "monto_teorico" decimal(10,2)
  "monto_real" decimal(10,2)
  "diferencia" decimal(10,2)
  "estado_caja" tinyint(1) [not null, default: 1]
  "id_usuario" int(10) [not null]
}

Table "categoria" {
  "id_categoria" int(10) [pk, not null]
  "nombre_categoria" varchar(100) [not null]
  "descripcion_categoria" varchar(150)
  "estado_categoria" tinyint(1) [not null, default: 1]
  "fecha_creacion_categoria" datetime [not null, default: `current_timestamp()`]
}

Table "clientes" {
  "id_cliente" int(10) [pk, not null]
  "nombre_cliente" varchar(150) [not null]
  "cedula_cliente" varchar(16)
  "ruc_cliente" varchar(20)
  "telefono_cliente" varchar(20)
  "direccion_cliente" varchar(200)
  "correo_cliente" varchar(100)
  "estado_cliente" tinyint(1) [not null, default: 1]
  "fecha_creacion_cliente" datetime [not null, default: `current_timestamp()`]
}

Table "compras" {
  "id_compra" int(10) [pk, not null]
  "numero_factura_compra" varchar(50)
  "id_proveedor" int(10)
  "id_usuario" int(10) [not null]
  "fecha_compra" datetime [not null, default: `current_timestamp()`]
  "subtotal_compra" decimal(10,2) [not null]
  "descuento_compra" decimal(10,2)
  "impuesto_compra" decimal(10,2)
  "total_compra" decimal(10,2) [not null]
  "estado_compra" tinyint(1) [not null, default: 1]
  "id_caja" int(10)
  "id_cuenta" int(10)
  "id_metodo_pago" int(10)
  "id_tipo_factura" int(10)
}

Table "credenciales" {
  "id" bigint(20) [pk, not null]
  "nombre_empresa" varchar(150) [not null]
  "ruc_empresa" varchar(20)
  "direccion_empresa" varchar(200)
  "telefono_empresa" varchar(20)
  "correo_empresa" varchar(100)
  "tipo_cambio" decimal(10,2)
  "created_at" timestamp
  "updated_at" timestamp
}

Table "cuentas" {
  "id_cuenta" int(10) [pk, not null]
  "nombre_cuenta" varchar(100) [not null]
  "tipo_cuenta" varchar(50)
  "descripcion" text
  "saldo_actual" decimal(10,2) [not null, default: 0.00]
  "estado" tinyint(1) [not null, default: 1]
  "created_at" timestamp
  "updated_at" timestamp
}

Table "detalle_compras" {
  "id_detalle_compra" int(10) [pk, not null]
  "id_compra" int(10) [not null]
  "id_producto" int(10) [not null]
  "cantidad_compra" int(11) [not null]
  "precio_unitario_compra" decimal(10,2) [not null]
  "subtotal_detalle_compra" decimal(10,2) [not null]
}

Table "detalle_ventas" {
  "id_detalle_venta" int(10) [pk, not null]
  "id_venta" int(10) [not null]
  "id_producto" int(10) [not null]
  "cantidad_venta" int(11) [not null]
  "precio_unitario_venta" decimal(10,2) [not null]
  "subtotal_detalle_venta" decimal(10,2) [not null]
  "porcentaje_impuesto" decimal(5,2) [not null]
  "monto_impuesto" decimal(10,2) [not null]
}

Table "devoluciones" {
  "id_devolucion" bigint(20) [pk, not null]
  "id_venta" int(10) [not null]
  "id_producto" int(10) [not null]
  "id_usuario" int(10) [not null]
  "cantidad" int(11) [not null]
  "monto" decimal(10,2) [not null]
  "motivo" varchar(150)
  "fecha" datetime [not null, default: `current_timestamp()`]
}

Table "gastos" {
  "id_gasto" int(10) [pk, not null]
  "id_tipo_gasto" int(10) [not null]
  "descripcion_gasto" varchar(200) [not null]
  "monto_gasto" decimal(10,2) [not null]
  "fecha_gasto" datetime [not null, default: `current_timestamp()`]
  "id_usuario" int(10) [not null]
  "id_caja" int(10)
  "id_cuenta" int(10)
}

Table "impuestos" {
  "id_impuesto" int(10) [pk, not null]
  "nombre_impuesto" varchar(100) [not null]
  "porcentaje_impuesto" decimal(5,2) [not null]
  "estado_impuesto" tinyint(1) [not null, default: 1]
  "fecha_creacion_impuesto" datetime [not null, default: `current_timestamp()`]
}

Table "metodos_pago" {
  "id_metodo_pago" int(10) [pk, not null]
  "nombre_metodo_pago" varchar(100) [not null]
  "descripcion_metodo_pago" varchar(150)
  "estado_metodo_pago" tinyint(1) [not null, default: 1]
}

Table "migrations" {
  "id" int(10) [pk, not null]
  "migration" varchar(255) [not null]
  "batch" int(11) [not null]
}

Table "movimientos_caja" {
  "id_movimiento_caja" int(10) [pk, not null]
  "id_caja" int(10) [not null]
  "tipo_movimiento_caja" movimientos_caja_tipo_movimiento_caja_enum [not null]
  "concepto_movimiento_caja" varchar(150) [not null]
  "monto_movimiento_caja" decimal(10,2) [not null]
  "fecha_movimiento_caja" datetime [not null, default: `current_timestamp()`]
  "id_usuario" int(10) [not null]
  "id_transferencia" int(10)
  "id_referencia" int(11)
  "id_cuenta_destino" int(10)
}

Table "movimientos_cuentas" {
  "id_movimiento_cuenta" int(10) [pk, not null]
  "id_cuenta" int(10) [not null]
  "tipo_movimiento" movimientos_cuentas_tipo_movimiento_enum [not null]
  "monto" decimal(10,2) [not null]
  "descripcion" varchar(150)
  "fecha" datetime [not null, default: `current_timestamp()`]
  "id_usuario" int(10) [not null]
  "id_transferencia" int(10)
}

Table "movimientos_inventario" {
  "id_movimiento_inventario" int(10) [pk, not null]
  "id_producto" int(10) [not null]
  "tipo_movimiento" movimientos_inventario_tipo_movimiento_enum [not null]
  "cantidad_movimiento" int(11) [not null]
  "stock_resultante" int(11) [not null]
  "motivo_movimiento" varchar(150)
  "id_referencia" int(10)
  "tipo_referencia" movimientos_inventario_tipo_referencia_enum
  "precio_unitario" decimal(10,2)
  "fecha_movimiento" datetime [not null, default: `current_timestamp()`]
  "id_usuario" int(10) [not null]
}

Table "permisos" {
  "id_permiso" int(10) [pk, not null]
  "nombre_permiso" varchar(100) [not null]
  "descripcion_permiso" varchar(150)
  "modulo_permiso" varchar(50) [not null]
  "estado_permiso" tinyint(1) [not null, default: 1]
  "fecha_creacion_permiso" datetime [not null, default: `current_timestamp()`]
}

Table "productos" {
  "id_producto" int(10) [pk, not null]
  "nombre_producto" varchar(150) [not null]
  "descripcion_producto" text
  "id_categoria" int(10) [not null]
  "id_impuesto" int(10) [not null]
  "id_ubicacion" int(10)
  "imagen_producto" varchar(255)
  "precio_compra" decimal(10,2) [not null]
  "precio_venta" decimal(10,2) [not null]
  "stock_actual" int(11) [not null, default: 0]
  "estado_producto" tinyint(1) [not null, default: 1]
  "fecha_creacion_producto" datetime [not null, default: `current_timestamp()`]
}

Table "proveedores" {
  "id_proveedor" int(10) [pk, not null]
  "nombre_proveedor" varchar(150) [not null]
  "ruc_proveedor" varchar(15)
  "telefono_proveedor" varchar(20)
  "direccion_proveedor" varchar(200)
  "correo_proveedor" varchar(100)
  "estado_proveedor" tinyint(1) [not null, default: 1]
  "fecha_creacion_proveedor" datetime [not null, default: `current_timestamp()`]
}

Table "roles" {
  "id_rol" int(10) [pk, not null]
  "nombre_rol" varchar(50) [not null]
  "descripcion_rol" varchar(150)
  "estado_rol" tinyint(1) [not null, default: 1]
  "fecha_creacion_rol" datetime [not null, default: `current_timestamp()`]
}

Table "rol_permiso" {
  "id_rol_permiso" int(10) [pk, not null]
  "id_rol" int(10) [not null]
  "id_permiso" int(10) [not null]
  "fecha_asignacion_rol_permiso" datetime [not null, default: `current_timestamp()`]
}

Table "tipos_factura" {
  "id_tipo_factura" int(10) [pk, not null]
  "nombre_tipo_factura" varchar(50) [not null]
  "descripcion_tipo_factura" varchar(150)
  "estado" tinyint(1) [not null, default: 1]
  "created_at" timestamp
  "updated_at" timestamp
}

Table "tipo_gasto" {
  "id_tipo_gasto" int(10) [pk, not null]
  "nombre_tipo_gasto" varchar(100) [not null]
  "descripcion_tipo_gasto" varchar(150)
  "estado_tipo_gasto" tinyint(1) [not null, default: 1]
}

Table "transferencias_caja_cuenta" {
  "id_transferencia" int(10) [pk, not null]
  "id_caja_origen" int(10)
  "id_cuenta_destino" int(10) [not null]
  "monto" decimal(10,2) [not null]
  "concepto" varchar(150) [not null, default: 'Transferencia caja a cuenta']
  "id_usuario" int(10) [not null]
  "fecha" datetime [not null, default: `current_timestamp()`]
}

Table "ubicaciones" {
  "id_ubicacion" int(10) [pk, not null]
  "nombre_ubicacion" varchar(100) [not null]
  "descripcion_ubicacion" varchar(150)
  "estado_ubicacion" tinyint(1) [not null, default: 1]
}

Table "usuarios" {
  "id_usuario" int(10) [pk, not null]
  "nombre_completo_usuario" varchar(150) [not null]
  "cedula_identidad_usuario" varchar(16) [not null]
  "nombre_usuario" varchar(50) [not null]
  "password_hash_usuario" varchar(255) [not null]
  "id_rol_usuario" int(10) [not null]
  "estado_usuario" tinyint(1) [not null, default: 1]
  "fecha_creacion_usuario" datetime [not null, default: `current_timestamp()`]
}

Table "ventas" {
  "id_venta" int(10) [pk, not null]
  "numero_factura" varchar(50) [not null]
  "fecha_venta" datetime [not null, default: `current_timestamp()`]
  "id_cliente" int(10)
  "id_usuario" int(10) [not null]
  "id_caja" int(10)
  "id_cuenta" int(10)
  "subtotal_venta" decimal(10,2) [not null]
  "impuesto_venta" decimal(10,2) [not null]
  "total_venta" decimal(10,2) [not null]
  "estado_venta" tinyint(1) [not null, default: 1]
  "id_metodo_pago" int(10) [not null]
  "monto_recibido" decimal(10,2)
  "vuelto" decimal(10,2)
  "moneda" varchar(10) [not null, default: 'NIO']
}

Ref "cajas_id_usuario_foreign":"usuarios"."id_usuario" < "cajas"."id_usuario"

Ref "compras_id_caja_foreign":"cajas"."id_caja" < "compras"."id_caja"

Ref "compras_id_cuenta_foreign":"cuentas"."id_cuenta" < "compras"."id_cuenta"

Ref "compras_id_metodo_pago_foreign":"metodos_pago"."id_metodo_pago" < "compras"."id_metodo_pago"

Ref "compras_id_proveedor_foreign":"proveedores"."id_proveedor" < "compras"."id_proveedor" [delete: set null]

Ref "compras_id_tipo_factura_foreign":"tipos_factura"."id_tipo_factura" < "compras"."id_tipo_factura"

Ref "compras_id_usuario_foreign":"usuarios"."id_usuario" < "compras"."id_usuario"

Ref "detalle_compras_id_compra_foreign":"compras"."id_compra" < "detalle_compras"."id_compra"

Ref "detalle_compras_id_producto_foreign":"productos"."id_producto" < "detalle_compras"."id_producto"

Ref "detalle_ventas_id_producto_foreign":"productos"."id_producto" < "detalle_ventas"."id_producto"

Ref "detalle_ventas_id_venta_foreign":"ventas"."id_venta" < "detalle_ventas"."id_venta"

Ref "devoluciones_id_producto_foreign":"productos"."id_producto" < "devoluciones"."id_producto" [update: cascade]

Ref "devoluciones_id_usuario_foreign":"usuarios"."id_usuario" < "devoluciones"."id_usuario" [update: cascade]

Ref "devoluciones_id_venta_foreign":"ventas"."id_venta" < "devoluciones"."id_venta" [update: cascade]

Ref "gastos_id_caja_foreign":"cajas"."id_caja" < "gastos"."id_caja"

Ref "gastos_id_cuenta_foreign":"cuentas"."id_cuenta" < "gastos"."id_cuenta"

Ref "gastos_id_tipo_gasto_foreign":"tipo_gasto"."id_tipo_gasto" < "gastos"."id_tipo_gasto"

Ref "gastos_id_usuario_foreign":"usuarios"."id_usuario" < "gastos"."id_usuario"

Ref "movimientos_caja_id_caja_foreign":"cajas"."id_caja" < "movimientos_caja"."id_caja"

Ref "movimientos_caja_id_cuenta_destino_foreign":"cuentas"."id_cuenta" < "movimientos_caja"."id_cuenta_destino"

Ref "movimientos_caja_id_transferencia_foreign":"transferencias_caja_cuenta"."id_transferencia" < "movimientos_caja"."id_transferencia"

Ref "movimientos_caja_id_usuario_foreign":"usuarios"."id_usuario" < "movimientos_caja"."id_usuario"

Ref "movimientos_cuentas_id_cuenta_foreign":"cuentas"."id_cuenta" < "movimientos_cuentas"."id_cuenta"

Ref "movimientos_cuentas_id_transferencia_foreign":"transferencias_caja_cuenta"."id_transferencia" < "movimientos_cuentas"."id_transferencia"

Ref "movimientos_cuentas_id_usuario_foreign":"usuarios"."id_usuario" < "movimientos_cuentas"."id_usuario"

Ref "movimientos_inventario_id_producto_foreign":"productos"."id_producto" < "movimientos_inventario"."id_producto" [delete: cascade]

Ref "movimientos_inventario_id_usuario_foreign":"usuarios"."id_usuario" < "movimientos_inventario"."id_usuario" [delete: cascade]

Ref "productos_id_categoria_foreign":"categoria"."id_categoria" < "productos"."id_categoria"

Ref "productos_id_impuesto_foreign":"impuestos"."id_impuesto" < "productos"."id_impuesto"

Ref "productos_id_ubicacion_foreign":"ubicaciones"."id_ubicacion" < "productos"."id_ubicacion" [delete: set null]

Ref "rol_permiso_id_permiso_foreign":"permisos"."id_permiso" < "rol_permiso"."id_permiso"

Ref "rol_permiso_id_rol_foreign":"roles"."id_rol" < "rol_permiso"."id_rol"

Ref "transferencias_caja_cuenta_id_caja_origen_foreign":"cajas"."id_caja" < "transferencias_caja_cuenta"."id_caja_origen" [delete: set null]

Ref "transferencias_caja_cuenta_id_cuenta_destino_foreign":"cuentas"."id_cuenta" < "transferencias_caja_cuenta"."id_cuenta_destino"

Ref "transferencias_caja_cuenta_id_usuario_foreign":"usuarios"."id_usuario" < "transferencias_caja_cuenta"."id_usuario"

Ref "usuarios_id_rol_usuario_foreign":"roles"."id_rol" < "usuarios"."id_rol_usuario"

Ref "ventas_id_caja_foreign":"cajas"."id_caja" < "ventas"."id_caja"

Ref "ventas_id_cliente_foreign":"clientes"."id_cliente" < "ventas"."id_cliente"

Ref "ventas_id_cuenta_foreign":"cuentas"."id_cuenta" < "ventas"."id_cuenta" [delete: set null]

Ref "ventas_id_metodo_pago_foreign":"metodos_pago"."id_metodo_pago" < "ventas"."id_metodo_pago"

Ref "ventas_id_usuario_foreign":"usuarios"."id_usuario" < "ventas"."id_usuario"

Records cajas(id_caja, fecha_apertura, fecha_cierre, monto_inicial, monto_final, monto_teorico, monto_real, diferencia, estado_caja, id_usuario) {
  1, '2024-05-20 08:00:00', '2024-05-20 18:30:00', 150, 850.75, 850.75, 850.75, 0, 0, 1
  2, '2025-05-20 08:00:00', '2025-05-20 18:30:00', 200, 450, null, null, null, 0, 2
  3, '2026-05-19 09:15:00', '2026-05-19 17:00:00', 100, 420, 420, 410, `-10.00`, 0, 2
  4, '2026-04-15 20:17:22', '2026-04-15 20:17:34', 1000, 11466.7, null, null, null, 0, 1
  5, '2026-04-15 21:00:08', '2026-04-15 21:00:47', 1000, 13370.3, null, null, null, 0, 1
  6, '2026-04-15 21:00:50', '2026-04-15 21:01:39', 1000, 13531.9, null, null, null, 0, 1
}

Records categoria(id_categoria, nombre_categoria, descripcion_categoria, estado_categoria, fecha_creacion_categoria) {
  1, 'Ron', null, 1, '2026-04-15 21:13:37'
  2, 'Whisky', null, 1, '2026-04-15 21:13:37'
  3, 'Vodka', null, 1, '2026-04-15 21:13:37'
  4, 'Tequila', null, 1, '2026-04-15 21:13:37'
  5, 'Cerveza', null, 1, '2026-04-15 21:13:37'
  6, 'Ginebra', null, 1, '2026-04-15 21:13:37'
  7, 'Licores dulces', null, 1, '2026-04-15 21:13:37'
}

Records clientes(id_cliente, nombre_cliente, cedula_cliente, ruc_cliente, telefono_cliente, direccion_cliente, correo_cliente, estado_cliente, fecha_creacion_cliente) {
  1, 'Cliente Generico', null, null, '', null, null, 1, '2026-04-15 21:13:37'
  2, 'Maria Lopez', null, null, '88880002', null, null, 1, '2026-04-15 21:13:37'
  3, 'Carlos Martinez', null, null, '88880003', null, null, 1, '2026-04-15 21:13:37'
  4, 'Ana Rodriguez', null, null, '88880004', null, null, 1, '2026-04-15 21:13:37'
  5, 'Luis Garcia', null, null, '88880005', null, null, 1, '2026-04-15 21:13:37'
  6, 'Pedro Sanchez', null, null, '88880006', null, null, 1, '2026-04-15 21:13:37'
  7, 'Daniel Torres', null, null, '88880007', null, null, 1, '2026-04-15 21:13:37'
  8, 'Jorge Mendoza', null, null, '88880008', null, null, 1, '2026-04-15 21:13:37'
  9, 'Jose Castillo', null, null, '88880009', null, null, 1, '2026-04-15 21:13:37'
  10, 'Miguel Vargas', null, null, '88880010', null, null, 1, '2026-04-15 21:13:37'
  11, 'Andrea Ruiz', null, null, '88880011', null, null, 1, '2026-04-15 21:13:37'
  12, 'Claudia Flores', null, null, '88880012', null, null, 1, '2026-04-15 21:13:37'
  13, 'Mario Chavez', null, null, '88880013', null, null, 1, '2026-04-15 21:13:37'
  14, 'Rosa Herrera', null, null, '88880014', null, null, 1, '2026-04-15 21:13:37'
  15, 'Elena Morales', null, null, '88880015', null, null, 1, '2026-04-15 21:13:37'
  16, 'Oscar Duarte', null, null, '88880016', null, null, 1, '2026-04-15 21:13:37'
  17, 'Ricardo Vega', null, null, '88880017', null, null, 1, '2026-04-15 21:13:37'
  18, 'Patricia Diaz', null, null, '88880018', null, null, 1, '2026-04-15 21:13:37'
  19, 'Eduardo Rivas', null, null, '88880019', null, null, 1, '2026-04-15 21:13:37'
  20, 'Fernando Ramos', null, null, '88880020', null, null, 1, '2026-04-15 21:13:37'
}

Records compras(id_compra, numero_factura_compra, id_proveedor, id_usuario, fecha_compra, subtotal_compra, descuento_compra, impuesto_compra, total_compra, estado_compra, id_caja, id_cuenta, id_metodo_pago, id_tipo_factura) {
  1, 'FAC-001', 1, 1, '2026-04-15 20:13:37', 150, null, 22.5, 172.5, 1, 1, null, null, null
  2, 'FAC-002', 2, 1, '2026-04-15 20:13:37', 220, null, 33, 253, 1, null, 1, null, null
  3, 'FAC-003', 1, 2, '2026-04-15 20:13:37', 98, null, 14.7, 112.7, 1, 2, null, null, null
  4, 'FAC-004', 3, 1, '2026-04-15 20:13:37', 310, null, 46.5, 356.5, 1, null, 2, null, null
  5, 'FAC-005', 2, 2, '2026-04-15 20:13:37', 75, null, 11.25, 86.25, 1, 2, null, null, null
}

Records credenciales(id, nombre_empresa, ruc_empresa, direccion_empresa, telefono_empresa, correo_empresa, tipo_cambio, created_at, updated_at) {
  1, 'Tellez S.A.', 'J0310000000001', 'Barrio San Juan, León, Nicaragua', '8888-9999', 'contacto@tellez.com', 37, '2026-04-16 01:13:37', '2026-04-16 01:13:37'
}

Records cuentas(id_cuenta, nombre_cuenta, tipo_cuenta, descripcion, saldo_actual, estado, created_at, updated_at) {
  1, 'Caja General', 'EFECTIVO', 'Caja principal del negocio', 2101.39, 1, '2026-04-16 01:13:37', '2026-04-16 01:13:37'
  2, 'Banco BAC', 'BANCARIA', 'Cuenta bancaria principal', 6600, 1, '2026-04-16 01:13:37', '2026-04-16 01:13:37'
  3, 'Banco Lafise', 'BANCARIA', 'Cuenta secundaria', 3200.5, 1, '2026-04-16 01:13:37', '2026-04-16 01:13:37'
  4, 'Cuenta de Ahorro', 'AHORRO', 'Fondo de ahorro del negocio', 11467.2, 1, '2026-04-16 01:13:37', '2026-04-16 01:13:37'
  5, 'Cuenta Inactiva', 'BANCARIA', 'Cuenta no utilizada', 97.75, 1, '2026-04-16 01:13:37', '2026-04-16 01:13:37'
  6, 'Billetera Movil', 'AHORRO', 'Dinero Baje', 1000, 1, null, null
}

Records detalle_compras(id_detalle_compra, id_compra, id_producto, cantidad_compra, precio_unitario_compra, subtotal_detalle_compra) {
  1, 1, 1, 10, 18, 180
  2, 1, 4, 5, 14, 70
  3, 2, 6, 50, 0.7, 35
  4, 2, 7, 50, 0.75, 37.5
  5, 3, 11, 30, 0.5, 15
  6, 3, 12, 30, 0.5, 15
  7, 4, 2, 8, 35, 280
  8, 4, 3, 5, 55, 275
  9, 5, 16, 20, 0.7, 14
  10, 5, 18, 15, 0.8, 12
}

Records detalle_ventas(id_detalle_venta, id_venta, id_producto, cantidad_venta, precio_unitario_venta, subtotal_detalle_venta, porcentaje_impuesto, monto_impuesto) {
  1, 1, 1, 2, 18, 36, 10, 3.6
  2, 1, 3, 1, 15, 15, 15, 2.25
  3, 2, 2, 3, 20, 60, 10, 6
  4, 3, 4, 2, 16, 32, 15, 4.8
  5, 3, 5, 1, 19, 19, 10, 1.9
  6, 4, 6, 2, 14, 28, 15, 4.2
  7, 4, 7, 1, 22, 22, 10, 2.2
  8, 5, 8, 2, 25, 50, 15, 7.5
  9, 6, 1, 1, 18, 18, 10, 1.8
  10, 6, 2, 1, 20, 20, 10, 2
  11, 7, 3, 2, 15, 30, 15, 4.5
  12, 7, 4, 1, 16, 16, 15, 2.4
  13, 8, 5, 2, 19, 38, 10, 3.8
  14, 9, 6, 1, 14, 14, 15, 2.1
  15, 9, 7, 1, 22, 22, 10, 2.2
  16, 10, 8, 3, 25, 75, 15, 11.25
  17, 11, 3, 1, 2500, 2500, 10, 250
  18, 11, 2, 2, 1500, 3000, 10, 300
  19, 11, 13, 2, 24, 48, 15, 7.2
  20, 11, 9, 1, 65, 65, 10, 6.5
  21, 12, 4, 6, 650, 3900, 10, 390
  22, 13, 1, 1, 850, 850, 10, 85
  23, 13, 3, 1, 2500, 2500, 10, 250
  24, 14, 15, 8, 18, 144, 0, 0
  25, 15, 11, 2, 25, 50, 15, 7.5
  26, 15, 19, 1, 30, 30, 15, 4.5
  27, 15, 20, 1, 31, 31, 15, 4.65
  28, 16, 4, 2, 650, 1300, 10, 130
  29, 16, 19, 1, 30, 30, 15, 4.5
  30, 16, 20, 1, 31, 31, 15, 4.65
  31, 16, 15, 1, 18, 18, 0, 0
  32, 17, 15, 5, 18, 90, 0, 0
  33, 18, 11, 2, 25, 50, 15, 7.5
  34, 18, 9, 1, 65, 65, 10, 6.5
  35, 18, 13, 1, 24, 24, 15, 3.6
  36, 19, 20, 6, 31, 186, 15, 27.9
  37, 20, 3, 2, 2500, 5000, 10, 500
  38, 20, 1, 1, 850, 850, 10, 85
  39, 21, 4, 1, 650, 650, 10, 65
  40, 21, 15, 1, 18, 18, 0, 0
  41, 21, 20, 1, 31, 31, 15, 4.65
  42, 21, 19, 1, 30, 30, 15, 4.5
  43, 22, 4, 9, 650, 5850, 10, 585
  44, 22, 15, 5, 18, 90, 0, 0
  45, 22, 20, 2, 31, 62, 15, 9.3
  46, 23, 17, 1, 95, 95, 15, 14.25
  47, 23, 5, 3, 1000, 3000, 10, 300
  48, 23, 2, 1, 1500, 1500, 10, 150
  49, 23, 13, 2, 24, 48, 15, 7.2
  50, 23, 15, 1, 18, 18, 0, 0
}

Records gastos(id_gasto, id_tipo_gasto, descripcion_gasto, monto_gasto, fecha_gasto, id_usuario, id_caja, id_cuenta) {
  1, 1, 'Pago de electricidad del mes', 120.5, '2026-04-15 20:13:37', 1, 1, null
  2, 2, 'Limpieza general del local', 75, '2026-04-15 20:13:37', 1, 1, null
  3, 3, 'Pago de salario empleado', 500, '2026-04-15 20:13:37', 1, null, 1
  4, 4, 'Pago de impuesto municipal', 80.75, '2026-04-15 20:13:37', 1, null, 2
  5, 5, 'Compra de útiles de oficina', 45, '2026-04-15 20:13:37', 1, 1, null
}

Records impuestos(id_impuesto, nombre_impuesto, porcentaje_impuesto, estado_impuesto, fecha_creacion_impuesto) {
  1, 'IVA', 15, 1, '2026-04-15 20:13:37'
  2, 'ISC Bebidas', 10, 1, '2026-04-15 20:13:37'
  3, 'Exento', 0, 1, '2026-04-15 20:13:37'
}

Records metodos_pago(id_metodo_pago, nombre_metodo_pago, descripcion_metodo_pago, estado_metodo_pago) {
  1, 'Efectivo', 'Pago físico con papel moneda o monedas', 1
  2, 'Tarjeta de Débito/Crédito', 'Pagos procesados por terminal bancaria (POS)', 1
  3, 'Transferencia Bancaria', 'Depósitos directos a cuenta corriente o ahorros', 1
}

Records migrations(id, migration, batch) {
  1, '2026_03_05_024934_create_roles_table', 1
  2, '2026_03_05_024940_create_permisos_table', 1
  3, '2026_03_05_024946_create_categoria_table', 1
  4, '2026_03_05_024951_create_impuestos_table', 1
  5, '2026_03_05_024957_create_metodos_pago_table', 1
  6, '2026_03_05_025026_create_tipo_gasto_table', 1
  7, '2026_03_05_025326_create_usuarios_table', 1
  8, '2026_03_05_025331_create_rol_permiso_table', 1
  9, '2026_03_05_025337_create_proveedores_table', 1
  10, '2026_03_05_025342_create_clientes_table', 1
  11, '2026_03_05_025352_create_ubicaciones_table', 1
  12, '2026_03_05_025353_create_productos_table', 1
  13, '2026_03_05_025427_create_cajas_table', 1
  14, '2026_03_05_025430_create_cuentas_table', 1
  15, '2026_03_05_025431_create_tipos_factura_table', 1
  16, '2026_03_05_025432_create_compras_table', 1
  17, '2026_03_05_025439_create_ventas_table', 1
  18, '2026_03_05_025450_create_detalle_compras_table', 1
  19, '2026_03_05_025457_create_detalle_ventas_table', 1
  20, '2026_03_05_025510_create_movimientos_inventario_table', 1
  21, '2026_03_05_025515_create_transferencias_caja_cuenta_table', 1
  22, '2026_03_05_025516_create_movimientos_caja_table', 1
  23, '2026_03_05_025522_create_gastos_table', 1
  24, '2026_03_17_170953_create_movimientos_cuentas_table', 1
  25, '2026_03_19_034055_create_credenciales_table', 1
  26, '2026_03_19_034829_create_devoluciones_table', 1
}

Records movimientos_caja(id_movimiento_caja, id_caja, tipo_movimiento_caja, concepto_movimiento_caja, monto_movimiento_caja, fecha_movimiento_caja, id_usuario, id_transferencia, id_referencia, id_cuenta_destino) {
  1, 1, 'INGRESO', 'Apertura de caja', 2000, '2026-04-15 20:13:37', 1, null, null, null
  2, 1, 'INGRESO', 'Venta mostrador', 350.5, '2026-04-15 20:13:37', 1, null, 1, null
  3, 1, 'SALIDA', 'Pago de proveedor', 500, '2026-04-15 20:13:37', 1, null, 2, null
  4, 1, 'SALIDA', 'Gasto operativo', 120.75, '2026-04-15 20:13:37', 1, null, null, null
  5, 1, 'SALIDA', 'Transferencia a cuenta bancaria', 800, '2026-04-15 20:13:37', 1, null, null, 1
  6, 1, 'SALIDA', 'Transferencia a cuenta Caja General', 50.75, '2026-04-15 20:14:09', 1, null, null, 1
  7, 1, 'SALIDA', 'Transferencia a cuenta Caja General', 50.75, '2026-04-15 20:16:29', 1, null, null, 1
  8, 4, 'INGRESO', 'Ingreso por ventas', 6176.7, '2026-04-15 21:17:27', 1, null, 11, null
  9, 4, 'INGRESO', 'Ingreso por ventas', 4290, '2026-04-15 21:17:33', 1, null, 12, null
  10, 4, 'SALIDA', 'Transferencia a cuenta Cuenta de Ahorro', 1466.7, '2026-04-15 20:17:55', 1, null, null, 4
  11, 3, 'SALIDA', 'Transferencia a cuenta Banco BAC', 20, '2026-04-15 20:18:48', 1, null, null, 2
  12, 1, 'SALIDA', 'Transferencia a cuenta Cuenta de Ahorro', 0.5, '2026-04-15 20:35:12', 1, null, null, 4
  13, 3, 'SALIDA', 'Transferencia a cuenta Banco BAC', 80, '2026-04-15 20:53:33', 1, null, null, 2
  14, 4, 'SALIDA', 'Transferencia a cuenta Banco BAC', 1500, '2026-04-15 20:59:10', 1, null, null, 2
  15, 5, 'INGRESO', 'Ingreso por ventas', 3685, '2026-04-15 22:00:14', 1, null, 13, null
  16, 5, 'INGRESO', 'Ingreso por ventas', 144, '2026-04-15 22:00:18', 1, null, 14, null
  17, 5, 'INGRESO', 'Ingreso por ventas', 127.65, '2026-04-15 22:00:22', 1, null, 15, null
  18, 5, 'INGRESO', 'Ingreso por ventas', 1518.15, '2026-04-15 22:00:28', 1, null, 16, null
  19, 5, 'INGRESO', 'Ingreso por ventas', 90, '2026-04-15 22:00:32', 1, null, 17, null
  20, 5, 'INGRESO', 'Ingreso por ventas', 156.6, '2026-04-15 22:00:36', 1, null, 18, null
  21, 5, 'INGRESO', 'Ingreso por ventas', 213.9, '2026-04-15 22:00:41', 1, null, 19, null
  22, 5, 'INGRESO', 'Ingreso por ventas', 6435, '2026-04-15 22:00:46', 1, null, 20, null
  23, 6, 'INGRESO', 'Ingreso por ventas', 803.15, '2026-04-15 22:00:55', 1, null, 21, null
  24, 6, 'INGRESO', 'Ingreso por ventas', 6596.3, '2026-04-15 22:01:05', 1, null, 22, null
  25, 6, 'INGRESO', 'Ingreso por ventas', 5132.45, '2026-04-15 22:01:36', 1, null, 23, null
  26, 1, 'SALIDA', 'Transferencia a cuenta Cuenta Inactiva', 77.75, '2026-04-15 22:30:23', 1, null, null, 5
  27, 1, 'SALIDA', 'Transferencia a cuenta Cuenta Inactiva', 20, '2026-04-16 14:25:31', 1, null, null, 5
}

Records movimientos_cuentas(id_movimiento_cuenta, id_cuenta, tipo_movimiento, monto, descripcion, fecha, id_usuario, id_transferencia) {
  1, 1, 'INGRESO', 5000, 'Saldo inicial cuenta', '2026-04-15 20:13:37', 1, null
  2, 1, 'INGRESO', 1200, 'Transferencia desde caja', '2026-04-15 20:13:37', 1, null
  3, 1, 'SALIDA', 500, 'Pago de proveedor', '2026-04-15 20:13:37', 1, null
  4, 2, 'INGRESO', 3200.5, 'Depósito inicial', '2026-04-15 20:13:37', 1, null
  5, 2, 'SALIDA', 300, 'Pago de servicios', '2026-04-15 20:13:37', 1, null
  6, 3, 'INGRESO', 10000, 'Fondo de ahorro inicial', '2026-04-15 20:13:37', 1, null
  7, 3, 'SALIDA', 1500, 'Uso de ahorro para inversión', '2026-04-15 20:13:37', 1, null
  8, 1, 'INGRESO', 50.75, 'Transferencia desde caja #1', '2026-04-15 20:14:09', 1, null
  9, 1, 'INGRESO', 50.75, 'Transferencia desde caja #1', '2026-04-15 20:16:29', 1, null
  10, 4, 'INGRESO', 1466.7, 'Transferencia desde caja #4', '2026-04-15 20:17:55', 1, null
  11, 2, 'INGRESO', 20, 'Transferencia desde caja #3', '2026-04-15 20:18:48', 1, null
  12, 4, 'INGRESO', 0.5, 'Transferencia desde caja #1', '2026-04-15 20:35:12', 1, null
  13, 2, 'INGRESO', 80, 'Transferencia desde caja #3', '2026-04-15 20:53:33', 1, null
  14, 2, 'INGRESO', 1500, 'Transferencia desde caja #4', '2026-04-15 20:59:10', 1, null
  15, 5, 'INGRESO', 77.75, 'Transferencia desde caja #1', '2026-04-15 22:30:23', 1, null
  16, 5, 'INGRESO', 20, 'Transferencia desde caja #1', '2026-04-16 14:25:31', 1, null
}

Records movimientos_inventario(id_movimiento_inventario, id_producto, tipo_movimiento, cantidad_movimiento, stock_resultante, motivo_movimiento, id_referencia, tipo_referencia, precio_unitario, fecha_movimiento, id_usuario) {
  1, 1, 'ENTRADA', 50, 50, 'Compra inicial', null, 'COMPRA', null, '2026-04-15 20:13:37', 1
  2, 1, 'SALIDA', 5, 45, 'Venta mostrador', 1, 'VENTA', 10, '2026-04-15 20:13:37', 1
  3, 2, 'ENTRADA', 30, 30, 'Compra inicial', null, 'COMPRA', null, '2026-04-15 20:13:37', 1
  4, 2, 'AJUSTE', 2, 28, 'Producto dañado', null, 'AJUSTE', null, '2026-04-15 20:13:37', 1
  5, 3, 'SALIDA', 1, 29, 'Venta despacho realizada', 11, 'VENTA', 2500, '2026-04-15 21:17:27', 1
  6, 2, 'SALIDA', 2, 38, 'Venta despacho realizada', 11, 'VENTA', 1500, '2026-04-15 21:17:27', 1
  7, 13, 'SALIDA', 2, 128, 'Venta despacho realizada', 11, 'VENTA', 24, '2026-04-15 21:17:27', 1
  8, 9, 'SALIDA', 1, 109, 'Venta despacho realizada', 11, 'VENTA', 65, '2026-04-15 21:17:27', 1
  9, 4, 'SALIDA', 6, 54, 'Venta despacho realizada', 12, 'VENTA', 650, '2026-04-15 21:17:33', 1
  10, 1, 'SALIDA', 1, 49, 'Venta despacho realizada', 13, 'VENTA', 850, '2026-04-15 22:00:14', 1
  11, 3, 'SALIDA', 1, 28, 'Venta despacho realizada', 13, 'VENTA', 2500, '2026-04-15 22:00:14', 1
  12, 15, 'SALIDA', 8, 192, 'Venta despacho realizada', 14, 'VENTA', 18, '2026-04-15 22:00:18', 1
  13, 11, 'SALIDA', 2, 148, 'Venta despacho realizada', 15, 'VENTA', 25, '2026-04-15 22:00:22', 1
  14, 19, 'SALIDA', 1, 99, 'Venta despacho realizada', 15, 'VENTA', 30, '2026-04-15 22:00:22', 1
  15, 20, 'SALIDA', 1, 99, 'Venta despacho realizada', 15, 'VENTA', 31, '2026-04-15 22:00:22', 1
  16, 4, 'SALIDA', 2, 52, 'Venta despacho realizada', 16, 'VENTA', 650, '2026-04-15 22:00:28', 1
  17, 19, 'SALIDA', 1, 98, 'Venta despacho realizada', 16, 'VENTA', 30, '2026-04-15 22:00:28', 1
  18, 20, 'SALIDA', 1, 98, 'Venta despacho realizada', 16, 'VENTA', 31, '2026-04-15 22:00:28', 1
  19, 15, 'SALIDA', 1, 191, 'Venta despacho realizada', 16, 'VENTA', 18, '2026-04-15 22:00:28', 1
  20, 15, 'SALIDA', 5, 186, 'Venta despacho realizada', 17, 'VENTA', 18, '2026-04-15 22:00:32', 1
  21, 11, 'SALIDA', 2, 146, 'Venta despacho realizada', 18, 'VENTA', 25, '2026-04-15 22:00:36', 1
  22, 9, 'SALIDA', 1, 108, 'Venta despacho realizada', 18, 'VENTA', 65, '2026-04-15 22:00:36', 1
  23, 13, 'SALIDA', 1, 127, 'Venta despacho realizada', 18, 'VENTA', 24, '2026-04-15 22:00:36', 1
  24, 20, 'SALIDA', 6, 92, 'Venta despacho realizada', 19, 'VENTA', 31, '2026-04-15 22:00:41', 1
  25, 3, 'SALIDA', 2, 26, 'Venta despacho realizada', 20, 'VENTA', 2500, '2026-04-15 22:00:46', 1
  26, 1, 'SALIDA', 1, 48, 'Venta despacho realizada', 20, 'VENTA', 850, '2026-04-15 22:00:46', 1
  27, 4, 'SALIDA', 1, 51, 'Venta despacho realizada', 21, 'VENTA', 650, '2026-04-15 22:00:55', 1
  28, 15, 'SALIDA', 1, 185, 'Venta despacho realizada', 21, 'VENTA', 18, '2026-04-15 22:00:55', 1
  29, 20, 'SALIDA', 1, 91, 'Venta despacho realizada', 21, 'VENTA', 31, '2026-04-15 22:00:55', 1
  30, 19, 'SALIDA', 1, 97, 'Venta despacho realizada', 21, 'VENTA', 30, '2026-04-15 22:00:55', 1
  31, 4, 'SALIDA', 9, 42, 'Venta despacho realizada', 22, 'VENTA', 650, '2026-04-15 22:01:05', 1
  32, 15, 'SALIDA', 5, 180, 'Venta despacho realizada', 22, 'VENTA', 18, '2026-04-15 22:01:05', 1
  33, 20, 'SALIDA', 2, 89, 'Venta despacho realizada', 22, 'VENTA', 31, '2026-04-15 22:01:05', 1
  34, 17, 'SALIDA', 1, 59, 'Venta despacho realizada', 23, 'VENTA', 95, '2026-04-15 22:01:36', 1
  35, 5, 'SALIDA', 3, 32, 'Venta despacho realizada', 23, 'VENTA', 1000, '2026-04-15 22:01:36', 1
  36, 2, 'SALIDA', 1, 37, 'Venta despacho realizada', 23, 'VENTA', 1500, '2026-04-15 22:01:36', 1
  37, 13, 'SALIDA', 2, 125, 'Venta despacho realizada', 23, 'VENTA', 24, '2026-04-15 22:01:36', 1
  38, 15, 'SALIDA', 1, 179, 'Venta despacho realizada', 23, 'VENTA', 18, '2026-04-15 22:01:36', 1
}

Records permisos(id_permiso, nombre_permiso, descripcion_permiso, modulo_permiso, estado_permiso, fecha_creacion_permiso) {
  1, 'ver_usuarios', 'Permite ver usuarios', 'usuarios', 1, '2026-04-15 21:13:36'
  2, 'crear_usuarios', 'Permite crear usuarios', 'usuarios', 1, '2026-04-15 21:13:36'
  3, 'editar_usuarios', 'Permite editar usuarios', 'usuarios', 1, '2026-04-15 21:13:36'
  4, 'eliminar_usuarios', 'Permite eliminar usuarios', 'usuarios', 1, '2026-04-15 21:13:36'
  5, 'ver_roles', 'Permite ver roles', 'roles', 1, '2026-04-15 21:13:36'
  6, 'gestionar_roles_permisos', 'Permite asignar permisos a roles', 'roles', 1, '2026-04-15 21:13:36'
  7, 'ver_productos', 'Permite ver productos', 'productos', 1, '2026-04-15 21:13:36'
  8, 'crear_productos', 'Permite crear productos', 'productos', 1, '2026-04-15 21:13:36'
  9, 'editar_productos', 'Permite editar productos', 'productos', 1, '2026-04-15 21:13:36'
  10, 'eliminar_productos', 'Permite eliminar productos', 'productos', 1, '2026-04-15 21:13:36'
  11, 'ver_categorias', 'Permite ver categorias', 'categorias', 1, '2026-04-15 21:13:36'
  12, 'crear_categorias', 'Permite crear categorias', 'categorias', 1, '2026-04-15 21:13:36'
  13, 'editar_categorias', 'Permite editar categorias', 'categorias', 1, '2026-04-15 21:13:36'
  14, 'eliminar_categorias', 'Permite eliminar categorias', 'categorias', 1, '2026-04-15 21:13:36'
  15, 'ver_proveedores', 'Permite ver proveedores', 'proveedores', 1, '2026-04-15 21:13:36'
  16, 'crear_proveedores', 'Permite crear proveedores', 'proveedores', 1, '2026-04-15 21:13:36'
  17, 'editar_proveedores', 'Permite editar proveedores', 'proveedores', 1, '2026-04-15 21:13:36'
  18, 'ver_clientes', 'Permite ver clientes', 'clientes', 1, '2026-04-15 21:13:36'
  19, 'crear_clientes', 'Permite crear clientes', 'clientes', 1, '2026-04-15 21:13:36'
  20, 'editar_clientes', 'Permite editar clientes', 'clientes', 1, '2026-04-15 21:13:36'
  21, 'ver_compras', 'Permite ver compras', 'compras', 1, '2026-04-15 21:13:36'
  22, 'registrar_compras', 'Permite registrar compras', 'compras', 1, '2026-04-15 21:13:36'
  23, 'ver_ventas', 'Permite ver ventas', 'ventas', 1, '2026-04-15 21:13:36'
  24, 'registrar_ventas', 'Permite registrar ventas', 'ventas', 1, '2026-04-15 21:13:36'
  25, 'imprimir_factura', 'Permite imprimir factura', 'ventas', 1, '2026-04-15 21:13:36'
  26, 'ver_inventario', 'Permite ver inventario', 'inventario', 1, '2026-04-15 21:13:36'
  27, 'ver_reportes', 'Permite ver reportes', 'reportes', 1, '2026-04-15 21:13:36'
  28, 'generar_reportes', 'Permite generar reportes parametrizados', 'reportes', 1, '2026-04-15 21:13:36'
  29, 'exportar_reportes', 'Permite exportar reportes a Excel o PDF', 'reportes', 1, '2026-04-15 21:13:36'
  30, 'backup_base_datos', 'Permite realizar backup', 'sistema', 1, '2026-04-15 21:13:36'
}

Records productos(id_producto, nombre_producto, descripcion_producto, id_categoria, id_impuesto, id_ubicacion, imagen_producto, precio_compra, precio_venta, stock_actual, estado_producto, fecha_creacion_producto) {
  1, 'Flor de Caña 7 años', 'Ron añejo 750ml', 1, 2, null, null, 650, 850, 48, 1, '2026-04-15 20:13:37'
  2, 'Flor de Caña 12 años', 'Ron premium 750ml', 1, 2, null, null, 1200, 1500, 37, 1, '2026-04-15 20:13:37'
  3, 'Flor de Caña 18 años', 'Ron ultra premium 750ml', 1, 2, null, null, 2000, 2500, 26, 1, '2026-04-15 20:13:37'
  4, 'Bacardi Blanco', 'Ron blanco 750ml', 1, 2, null, null, 500, 650, 42, 1, '2026-04-15 20:13:37'
  5, 'Ron Abuelo 7 años', 'Ron añejo 750ml', 1, 2, null, null, 800, 1000, 32, 1, '2026-04-15 20:13:37'
  6, 'Victoria Clásica', 'Cerveza nacional 355ml', 2, 2, null, null, 25, 32, 200, 1, '2026-04-15 20:13:37'
  7, 'Toña', 'Cerveza nacional 355ml', 2, 2, null, null, 26, 33, 220, 1, '2026-04-15 20:13:37'
  8, 'Heineken', 'Cerveza importada 330ml', 2, 2, null, null, 45, 60, 120, 1, '2026-04-15 20:13:37'
  9, 'Corona Extra', 'Cerveza importada 355ml', 2, 2, null, null, 50, 65, 108, 1, '2026-04-15 20:13:37'
  10, 'Modelo Especial', 'Cerveza mexicana 355ml', 2, 2, null, null, 55, 70, 90, 1, '2026-04-15 20:13:37'
  11, 'Coca Cola 600ml', 'Refresco gaseoso', 3, 1, null, null, 18, 25, 146, 1, '2026-04-15 20:13:37'
  12, 'Pepsi 600ml', 'Refresco gaseoso', 3, 1, null, null, 18, 25, 140, 1, '2026-04-15 20:13:37'
  13, 'Fanta Naranja', 'Refresco sabor naranja', 3, 1, null, null, 17, 24, 125, 1, '2026-04-15 20:13:37'
  14, 'Sprite 600ml', 'Refresco sabor limón', 3, 1, null, null, 17, 24, 120, 1, '2026-04-15 20:13:37'
  15, 'Agua Purificada 600ml', 'Agua embotellada', 3, 3, null, null, 10, 18, 179, 1, '2026-04-15 20:13:37'
  16, 'Papas Lays Clásicas', 'Papas fritas', 4, 1, null, null, 25, 35, 80, 1, '2026-04-15 20:13:37'
  17, 'Papas Pringles', 'Papas fritas importadas', 4, 1, null, null, 70, 95, 59, 1, '2026-04-15 20:13:37'
  18, 'Galletas Oreo', 'Galletas rellenas', 4, 1, null, null, 30, 42, 90, 1, '2026-04-15 20:13:37'
  19, 'Chocolate Snickers', 'Barra de chocolate', 4, 1, null, null, 22, 30, 97, 1, '2026-04-15 20:13:37'
  20, 'Chocolate KitKat', 'Barra de chocolate', 4, 1, null, null, 23, 31, 89, 1, '2026-04-15 20:13:37'
}

Records proveedores(id_proveedor, nombre_proveedor, ruc_proveedor, telefono_proveedor, direccion_proveedor, correo_proveedor, estado_proveedor, fecha_creacion_proveedor) {
  1, 'Distribuidora Flor de Caña', null, '88887777', 'Managua', null, 1, '2026-04-15 21:13:37'
  2, 'Licores Centroamericanos', null, '88886666', 'León', null, 1, '2026-04-15 21:13:37'
  3, 'Importadora Premium', null, '88885555', 'Managua', null, 1, '2026-04-15 21:13:37'
}

Records roles(id_rol, nombre_rol, descripcion_rol, estado_rol, fecha_creacion_rol) {
  1, 'Administrador', null, 1, '2026-04-15 21:13:36'
  2, 'Cajero', null, 1, '2026-04-15 21:13:36'
  3, 'Bodeguero', null, 1, '2026-04-15 21:13:36'
}

Records rol_permiso(id_rol_permiso, id_rol, id_permiso, fecha_asignacion_rol_permiso) {
  1, 1, 1, '2026-04-15 20:13:36'
  2, 1, 2, '2026-04-15 20:13:36'
  3, 1, 3, '2026-04-15 20:13:36'
  4, 2, 1, '2026-04-15 20:13:36'
  5, 2, 2, '2026-04-15 20:13:36'
}

Records tipos_factura(id_tipo_factura, nombre_tipo_factura, descripcion_tipo_factura, estado, created_at, updated_at) {
  1, 'CONTADO', 'Factura pagada al momento de la compra', 1, '2026-04-16 01:13:37', '2026-04-16 01:13:37'
  2, 'CREDITO', 'Factura a crédito, pago diferido', 1, '2026-04-16 01:13:37', '2026-04-16 01:13:37'
  3, 'EXENTO', 'Factura exenta de impuestos', 1, '2026-04-16 01:13:37', '2026-04-16 01:13:37'
}

Records tipo_gasto(id_tipo_gasto, nombre_tipo_gasto, descripcion_tipo_gasto, estado_tipo_gasto) {
  1, 'Servicios Públicos', 'Pago de luz, agua, internet, teléfono', 1
  2, 'Mantenimiento', 'Reparaciones, limpieza y mantenimiento del local', 1
  3, 'Sueldos', 'Pago de salarios al personal', 1
  4, 'Impuestos', 'Pagos de impuestos locales y nacionales', 1
  5, 'Otros', 'Gastos varios no contemplados en otras categorías', 1
}

Records transferencias_caja_cuenta(id_transferencia, id_caja_origen, id_cuenta_destino, monto, concepto, id_usuario, fecha) {
  1, 1, 1, 50.75, 'Transferencia de Caja a Cuenta', 1, '2026-04-15 20:14:09'
  2, 1, 1, 50.75, 'Transferencia de Caja a Cuenta', 1, '2026-04-15 20:16:29'
  3, 4, 4, 1466.7, 'Transferencia de Caja a Cuenta', 1, '2026-04-15 20:17:55'
  4, 3, 2, 20, 'Transferencia de Caja a Cuenta', 1, '2026-04-15 20:18:48'
  5, 1, 4, 0.5, 'Transferencia de Caja a Cuenta', 1, '2026-04-15 20:35:12'
  6, 3, 2, 80, 'Transferencia de Caja a Cuenta', 1, '2026-04-15 20:53:33'
  7, 4, 2, 1500, 'Transferencia de Caja a Cuenta', 1, '2026-04-15 20:59:10'
  8, 1, 5, 77.75, 'Transferencia de Caja a Cuenta', 1, '2026-04-15 22:30:23'
  9, 1, 5, 20, 'Transferencia de Caja a Cuenta', 1, '2026-04-16 14:25:31'
}

Records ubicaciones(id_ubicacion, nombre_ubicacion, descripcion_ubicacion, estado_ubicacion) {
  1, 'Estante A', 'Estante principal de licores', 1
  2, 'Estante B', 'Estante secundario', 1
  3, 'Ropero 1', 'Área de almacenamiento cerrado', 1
  4, 'Bodega', 'Almacenamiento general', 1
}

Records usuarios(id_usuario, nombre_completo_usuario, cedula_identidad_usuario, nombre_usuario, password_hash_usuario, id_rol_usuario, estado_usuario, fecha_creacion_usuario) {
  1, 'Edgard Tellez', '281-151202-1003C', 'Edgard', '$2y$12$ReDv0vJPhxsRyQHbp.FTKe39JUsoSE5HhOpoaDjyEiCBVRubmoyK6', 1, 1, '2026-04-15 20:13:37'
  2, 'Cajero', '000-000000-0000B', 'cajero', '$2y$12$Bm1TTF0CKLqy.hN7P.nIHepxirtNBhwQH9TFxMrXaSHxAMDzwkchm', 2, 1, '2026-04-15 20:13:37'
}

Records ventas(id_venta, numero_factura, fecha_venta, id_cliente, id_usuario, id_caja, id_cuenta, subtotal_venta, impuesto_venta, total_venta, estado_venta, id_metodo_pago, monto_recibido, vuelto, moneda) {
  1, 'F001', '2026-04-15 20:13:37', 1, 1, 1, null, 45, 6.75, 51.75, 1, 1, null, null, 'NIO'
  2, 'F002', '2026-04-15 20:13:37', 2, 1, null, 1, 60, 9, 69, 1, 2, null, null, 'NIO'
  3, 'F003', '2026-04-15 20:13:37', 3, 2, 1, null, 51, 7.65, 58.65, 1, 1, null, null, 'NIO'
  4, 'F004', '2026-04-15 20:13:37', 1, 2, 1, null, 70, 10.5, 80.5, 1, 1, null, null, 'NIO'
  5, 'F005', '2026-04-15 20:13:37', 4, 1, null, 2, 38, 5.7, 43.7, 1, 3, null, null, 'NIO'
  6, 'F006', '2026-04-15 20:13:37', 5, 1, 1, null, 20, 3, 23, 1, 1, null, null, 'NIO'
  7, 'F007', '2026-04-15 20:13:37', 2, 2, null, 1, 46, 6.9, 52.9, 1, 2, null, null, 'NIO'
  8, 'F008', '2026-04-15 20:13:37', 3, 1, 1, null, 75, 11.25, 86.25, 1, 1, null, null, 'NIO'
  9, 'F009', '2026-04-15 20:13:37', 4, 2, 1, null, 36, 5.4, 41.4, 1, 1, null, null, 'NIO'
  10, 'F010', '2026-04-15 20:13:37', 5, 1, null, 2, 75, 11.25, 86.25, 1, 2, null, null, 'NIO'
  11, 'FAC-000011', '2026-04-15 21:17:27', 1, 1, 4, null, 5613, 563.7, 6176.7, 1, 1, 7000, 823.3, 'NIO'
  12, 'FAC-000012', '2026-04-15 21:17:33', 1, 1, 4, null, 3900, 390, 4290, 1, 1, 5000, 710, 'NIO'
  13, 'FAC-000013', '2026-04-15 22:00:14', 1, 1, 5, null, 3350, 335, 3685, 1, 1, 4000, 315, 'NIO'
  14, 'FAC-000014', '2026-04-15 22:00:18', 1, 1, 5, null, 144, 0, 144, 1, 1, 200, 56, 'NIO'
  15, 'FAC-000015', '2026-04-15 22:00:22', 1, 1, 5, null, 111, 16.65, 127.65, 1, 1, 200, 72.35, 'NIO'
  16, 'FAC-000016', '2026-04-15 22:00:28', 1, 1, 5, null, 1379, 139.15, 1518.15, 1, 1, 1600, 81.85, 'NIO'
  17, 'FAC-000017', '2026-04-15 22:00:32', 1, 1, 5, null, 90, 0, 90, 1, 1, 100, 10, 'NIO'
  18, 'FAC-000018', '2026-04-15 22:00:36', 1, 1, 5, null, 139, 17.6, 156.6, 1, 1, 200, 43.4, 'NIO'
  19, 'FAC-000019', '2026-04-15 22:00:41', 1, 1, 5, null, 186, 27.9, 213.9, 1, 1, 250, 36.1, 'NIO'
  20, 'FAC-000020', '2026-04-15 22:00:46', 1, 1, 5, null, 5850, 585, 6435, 1, 1, 7000, 565, 'NIO'
  21, 'FAC-000021', '2026-04-15 22:00:55', 1, 1, 6, null, 729, 74.15, 803.15, 1, 1, 900, 96.85, 'NIO'
  22, 'FAC-000022', '2026-04-15 22:01:05', 1, 1, 6, null, 6002, 594.3, 6596.3, 1, 1, 7000, 403.7, 'NIO'
  23, 'FAC-000023', '2026-04-15 22:01:36', 1, 1, 6, null, 4661, 471.45, 5132.45, 1, 1, 6000, 867.55, 'NIO'
}

