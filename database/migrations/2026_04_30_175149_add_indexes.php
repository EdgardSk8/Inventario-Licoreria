<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* =========================
         * CAJAS
         * ========================= */
        Schema::table('cajas', function (Blueprint $table) {
            $table->index(['id_usuario', 'estado_caja'], 'idx_cajas_usuario_estado');
        });

        /* =========================
         * CATEGORIAS
         * ========================= */

        Schema::table('categoria', function (Blueprint $table) {
            $table->index('estado_categoria', 'idx_categoria_estado');
        });

        /* =========================
         * MOVIMIENTOS CAJA
         * ========================= */
        Schema::table('movimientos_caja', function (Blueprint $table) {
            $table->index(['id_caja', 'fecha_movimiento_caja'], 'idx_mov_caja_fecha');
            $table->index(['id_caja', 'tipo_movimiento_caja'], 'idx_mov_caja_tipo');
            $table->index(['id_usuario', 'fecha_movimiento_caja'], 'idx_mov_caja_usuario_fecha');
        });

        /* =========================
         * MOVIMIENTOS CUENTAS
         * ========================= */
        Schema::table('movimientos_cuentas', function (Blueprint $table) {
            $table->index(['id_cuenta', 'tipo_movimiento'], 'idx_mov_cuenta_tipo');
            $table->index(['id_usuario', 'fecha'], 'idx_mov_cuenta_usuario_fecha');
        });

        /* =========================
         * MOVIMIENTOS GASTOS
         * ========================= */
        Schema::table('movimientos_gastos', function (Blueprint $table) {
            $table->index(['id_gasto', 'fecha'], 'idx_mov_gastos_fecha');
            $table->index(['id_usuario', 'fecha'], 'idx_mov_gastos_usuario_fecha');
            $table->index(['id_caja', 'fecha'], 'idx_mov_gastos_caja_fecha');
            $table->index(['id_cuenta', 'fecha'], 'idx_mov_gastos_cuenta_fecha');
        });

        /* =========================
         * INVENTARIO
         * ========================= */
        Schema::table('movimientos_inventario', function (Blueprint $table) {
            $table->index(['id_producto', 'fecha_movimiento'], 'idx_inv_producto_fecha');
            $table->index(['tipo_movimiento', 'id_producto'], 'idx_inv_tipo_producto');
            $table->index(['id_usuario', 'fecha_movimiento'], 'idx_inv_usuario_fecha');
        });

        /* =========================
         * VENTAS (CRÍTICO)
         * ========================= */
        Schema::table('ventas', function (Blueprint $table) {
            $table->index(['id_usuario', 'fecha_venta'], 'idx_ventas_usuario_fecha');
            $table->index(['id_cliente', 'fecha_venta'], 'idx_ventas_cliente_fecha');
            $table->index(['id_caja', 'fecha_venta'], 'idx_ventas_caja_fecha');
            $table->index(['id_metodo_pago', 'fecha_venta'], 'idx_ventas_pago_fecha');
        });

        /* =========================
         * DETALLE VENTAS
         * ========================= */
        Schema::table('detalle_ventas', function (Blueprint $table) {
            $table->index(['id_venta', 'id_producto'], 'idx_detventas_venta_producto');
            $table->index(['id_producto'], 'idx_detventas_producto');
        });


        /* =========================
         * CUENTAS
         * ========================= */

        Schema::table('cuentas', function (Blueprint $table) {
            $table->index(['estado', 'nombre_cuenta'], 'idx_cuentas_estado_nombre');
        });

        /* =========================
         * COMPRAS
         * ========================= */
        Schema::table('compras', function (Blueprint $table) {
            $table->index(['id_usuario', 'fecha_compra'], 'idx_compras_usuario_fecha');
            $table->index(['id_proveedor', 'fecha_compra'], 'idx_compras_proveedor_fecha');
            $table->index(['id_caja', 'fecha_compra'], 'idx_compras_caja_fecha');
        });

        /* =========================
         * DETALLE COMPRAS
         * ========================= */
        Schema::table('detalle_compras', function (Blueprint $table) {
            $table->index(['id_compra', 'id_producto'], 'idx_detcompras_compra_producto');
            $table->index(['id_producto'], 'idx_detcompras_producto');
        });

        /* =========================
         * PRODUCTOS
         * ========================= */
       Schema::table('productos', function (Blueprint $table) {
            $table->index(['estado_producto', 'id_categoria'], 'idx_estado_categoria');
            $table->index(['estado_producto', 'id_impuesto'], 'idx_estado_impuesto');
            $table->index(['estado_producto', 'nombre_producto'], 'idx_estado_nombre'); // 🔥 clave
            $table->fullText('nombre_producto'); // 🚀 PRO
        });

        /* =========================
         * CLIENTES / PROVEEDORES
         * ========================= */
        Schema::table('clientes', function (Blueprint $table) {
            $table->index('estado_cliente', 'idx_clientes_estado');
            $table->index('nombre_cliente', 'idx_clientes_nombre');
        });

        Schema::table('proveedores', function (Blueprint $table) {
            $table->index(['estado_proveedor'], 'idx_proveedores_estado');
        });

        /* =========================
         * TRANSFERENCIAS
         * ========================= */
        Schema::table('transferencias_caja_cuenta', function (Blueprint $table) {
            $table->index(['id_caja_origen', 'fecha'], 'idx_transfer_caja_fecha');
            $table->index(['id_cuenta_destino', 'fecha'], 'idx_transfer_cuenta_fecha');
            $table->index(['id_usuario', 'fecha'], 'idx_transfer_usuario_fecha');
        });

        /* =========================
         * GASTOS (TABLA BASE)
         * ========================= */
        Schema::table('gastos', function (Blueprint $table) {
            $table->index(['id_tipo_gasto'], 'idx_gastos_tipo');
            $table->index(['estado_pago'], 'idx_gastos_estado_pago');
            $table->index(['fecha_pago'], 'idx_gastos_fecha_pago');
            $table->index(['proximo_pago'], 'idx_gastos_proximo_pago');
        });
    }

    public function down(): void
    {
        Schema::table('cajas', function (Blueprint $table) {
            $table->dropIndex('idx_cajas_usuario_estado');
            $table->dropIndex('idx_cajas_usuario_fecha');
        });

        Schema::table('movimientos_caja', function (Blueprint $table) {
            $table->dropIndex('idx_mov_caja_fecha');
            $table->dropIndex('idx_mov_caja_tipo');
            $table->dropIndex('idx_mov_caja_usuario_fecha');
        });

        Schema::table('movimientos_cuentas', function (Blueprint $table) {
            $table->dropIndex('idx_mov_cuentas_fecha');
            $table->dropIndex('idx_mov_cuentas_usuario_fecha');
        });

        Schema::table('movimientos_gastos', function (Blueprint $table) {
            $table->dropIndex('idx_mov_gastos_fecha');
            $table->dropIndex('idx_mov_gastos_usuario_fecha');
            $table->dropIndex('idx_mov_gastos_caja_fecha');
            $table->dropIndex('idx_mov_gastos_cuenta_fecha');
        });

        Schema::table('movimientos_inventario', function (Blueprint $table) {
            $table->dropIndex('idx_inv_producto_fecha');
            $table->dropIndex('idx_inv_tipo_producto');
            $table->dropIndex('idx_inv_usuario_fecha');
        });

        Schema::table('ventas', function (Blueprint $table) {
            $table->dropIndex('idx_ventas_usuario_fecha');
            $table->dropIndex('idx_ventas_cliente_fecha');
            $table->dropIndex('idx_ventas_caja_fecha');
            $table->dropIndex('idx_ventas_pago_fecha');
        });

        Schema::table('detalle_ventas', function (Blueprint $table) {
            $table->dropIndex('idx_detventas_venta_producto');
            $table->dropIndex('idx_detventas_producto');
        });

        Schema::table('compras', function (Blueprint $table) {
            $table->dropIndex('idx_compras_usuario_fecha');
            $table->dropIndex('idx_compras_proveedor_fecha');
            $table->dropIndex('idx_compras_caja_fecha');
        });

        Schema::table('detalle_compras', function (Blueprint $table) {
            $table->dropIndex('idx_detcompras_compra_producto');
            $table->dropIndex('idx_detcompras_producto');
        });

        Schema::table('productos', function (Blueprint $table) {
            $table->dropIndex('idx_productos_categoria');
            $table->dropIndex('idx_productos_impuesto');
            $table->dropIndex('idx_productos_ubicacion');
            $table->dropIndex('idx_productos_estado');
        });

        Schema::table('clientes', function (Blueprint $table) {
            $table->dropIndex('idx_clientes_estado');
        });

        Schema::table('proveedores', function (Blueprint $table) {
            $table->dropIndex('idx_proveedores_estado');
        });

        Schema::table('transferencias_caja_cuenta', function (Blueprint $table) {
            $table->dropIndex('idx_transfer_caja_fecha');
            $table->dropIndex('idx_transfer_cuenta_fecha');
            $table->dropIndex('idx_transfer_usuario_fecha');
        });

        Schema::table('gastos', function (Blueprint $table) {
            $table->dropIndex('idx_gastos_tipo');
            $table->dropIndex('idx_gastos_estado_pago');
            $table->dropIndex('idx_gastos_fecha_pago');
            $table->dropIndex('idx_gastos_proximo_pago');
        });
    }
};