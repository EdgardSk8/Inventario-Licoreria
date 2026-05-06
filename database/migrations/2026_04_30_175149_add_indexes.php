<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        /* =========================
         * USUARIOS / ROLES
         * ========================= */
        Schema::table('usuarios', function (Blueprint $table) {
            $table->index(['id_rol_usuario', 'estado_usuario'], 'idx_usuarios_rol_estado');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->index('estado_rol', 'idx_roles_estado');
        });

        /* =========================
         * CLIENTES / PROVEEDORES
         * ========================= */
        Schema::table('clientes', function (Blueprint $table) {
            $table->index(['estado_cliente', 'nombre_cliente'], 'idx_clientes_estado_nombre');
        });

        Schema::table('proveedores', function (Blueprint $table) {
            $table->index(['estado_proveedor', 'nombre_proveedor'], 'idx_proveedores_estado_nombre');
        });

        /* =========================
         * PRODUCTOS (POS CRÍTICO)
         * ========================= */
        Schema::table('productos', function (Blueprint $table) {
            $table->index(['estado_producto', 'id_categoria'], 'idx_productos_estado_categoria');
            $table->index(['estado_producto', 'id_impuesto'], 'idx_productos_estado_impuesto');
            $table->index(['stock_actual'], 'idx_productos_stock');
        });

        /* =========================
         * VENTAS (LO MÁS CRÍTICO DEL SISTEMA)
         * ========================= */
        Schema::table('ventas', function (Blueprint $table) {
            $table->index(['fecha_venta', 'estado_venta'], 'idx_ventas_fecha_estado');
            $table->index(['id_usuario', 'fecha_venta'], 'idx_ventas_usuario_fecha');
            $table->index(['id_caja', 'fecha_venta'], 'idx_ventas_caja_fecha');
            $table->index(['id_cliente', 'fecha_venta'], 'idx_ventas_cliente_fecha');
            $table->index(['id_metodo_pago', 'fecha_venta'], 'idx_ventas_pago_fecha');
        });

        Schema::table('detalle_ventas', function (Blueprint $table) {
            $table->index(['id_venta'], 'idx_detalleventas_venta');
            $table->index(['id_producto'], 'idx_detalleventas_producto');
        });

        /* =========================
         * COMPRAS
         * ========================= */
        Schema::table('compras', function (Blueprint $table) {
            $table->index(['fecha_compra', 'estado_compra'], 'idx_compras_fecha_estado');
            $table->index(['id_usuario', 'fecha_compra'], 'idx_compras_usuario_fecha');
            $table->index(['id_proveedor', 'fecha_compra'], 'idx_compras_proveedor_fecha');
            $table->index(['id_caja', 'fecha_compra'], 'idx_compras_caja_fecha');
        });

        Schema::table('detalle_compras', function (Blueprint $table) {
            $table->index(['id_compra'], 'idx_detallecompras_compra');
            $table->index(['id_producto'], 'idx_detallecompras_producto');
        });

        /* =========================
         * CAJAS (MUY USADO EN APERTURA / CIERRE)
         * ========================= */
        Schema::table('cajas', function (Blueprint $table) {
            $table->index(['estado_caja'], 'idx_cajas_estado');
            $table->index(['id_usuario', 'estado_caja'], 'idx_cajas_usuario_estado');
        });

        /* =========================
         * MOVIMIENTOS CAJA
         * ========================= */
        Schema::table('movimientos_caja', function (Blueprint $table) {
            $table->index(['id_caja', 'fecha_movimiento_caja'], 'idx_movcaja_caja_fecha');
            $table->index(['id_usuario', 'fecha_movimiento_caja'], 'idx_movcaja_usuario_fecha');
            $table->index(['tipo_movimiento_caja'], 'idx_movcaja_tipo');
        });

        /* =========================
         * MOVIMIENTOS INVENTARIO (KARDEX)
         * ========================= */
        Schema::table('movimientos_inventario', function (Blueprint $table) {
            $table->index(['id_producto', 'fecha_movimiento'], 'idx_kardex_producto_fecha');
            $table->index(['tipo_movimiento', 'id_producto'], 'idx_kardex_tipo_producto');
            $table->index(['id_referencia', 'tipo_referencia'], 'idx_kardex_referencia');
        });

        /* =========================
         * CUENTAS
         * ========================= */
        Schema::table('cuentas', function (Blueprint $table) {
            $table->index(['estado', 'nombre_cuenta'], 'idx_cuentas_estado_nombre');
        });

        Schema::table('movimientos_cuentas', function (Blueprint $table) {
            $table->index(['id_cuenta', 'fecha'], 'idx_movcuenta_cuenta_fecha');
            $table->index(['id_usuario', 'fecha'], 'idx_movcuenta_usuario_fecha');
        });

        /* =========================
         * GASTOS
         * ========================= */
        Schema::table('gastos', function (Blueprint $table) {
            $table->index(['estado_pago', 'fecha_pago'], 'idx_gastos_estado_fecha');
            $table->index(['id_tipo_gasto'], 'idx_gastos_tipo');
        });

        Schema::table('movimientos_gastos', function (Blueprint $table) {
            $table->index(['id_gasto', 'fecha'], 'idx_movgastos_gasto_fecha');
            $table->index(['id_usuario', 'fecha'], 'idx_movgastos_usuario_fecha');
        });

        /* =========================
         * TRANSFERENCIAS
         * ========================= */
        Schema::table('transferencias_caja_cuenta', function (Blueprint $table) {
            $table->index(['id_caja_origen', 'fecha'], 'idx_transfer_caja_fecha');
            $table->index(['id_cuenta_destino', 'fecha'], 'idx_transfer_cuenta_fecha');
        });

        /* =========================
         * FACTURACION / POS
         * ========================= */
        Schema::table('ventas', function (Blueprint $table) {
            $table->index(['numero_factura'], 'idx_ventas_factura');
        });

        Schema::table('compras', function (Blueprint $table) {
            $table->index(['numero_factura_compra'], 'idx_compras_factura');
        });

        /* =========================
         * FULLTEXT (BUSQUEDA POS)
         * ========================= */
        Schema::table('productos', function (Blueprint $table) {
            $table->fullText('nombre_producto');
        });
    }

    public function down(): void
    {
        // Puedes borrar igual los índices si quieres rollback limpio
    }
};