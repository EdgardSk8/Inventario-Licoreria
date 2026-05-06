<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class gastosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gastos')->insert([

            /* ================= SERVICIOS BÁSICOS ================= */
            [
                'id_tipo_gasto' => 1,
                'nombre_gasto' => 'Luz eléctrica',
                'descripcion_gasto' => 'Pago mensual de energía eléctrica del local',
                'estado_gasto' => true,
                'fecha_inicio' => '2025-01-01',
                'fecha_pago' => '2026-05-10',
                'proximo_pago' => '2026-06-10',
                'estado_pago' => 'PAGADO',
                'ultimo_pago' => '2026-05-10',
            ],

            [
                'id_tipo_gasto' => 1,
                'nombre_gasto' => 'Agua potable',
                'descripcion_gasto' => 'Servicio de agua del establecimiento',
                'estado_gasto' => true,
                'fecha_inicio' => '2025-01-01',
                'fecha_pago' => '2026-05-08',
                'proximo_pago' => '2026-06-08',
                'estado_pago' => 'PAGADO',
                'ultimo_pago' => '2026-05-08',
            ],

            [
                'id_tipo_gasto' => 1,
                'nombre_gasto' => 'Internet y telefonía',
                'descripcion_gasto' => 'Servicio de internet para sistema POS',
                'estado_gasto' => true,
                'fecha_inicio' => '2025-02-01',
                'fecha_pago' => '2026-05-12',
                'proximo_pago' => '2026-06-12',
                'estado_pago' => 'PAGADO',
                'ultimo_pago' => '2026-05-12',
            ],

            /* ================= NÓMINA ================= */
            [
                'id_tipo_gasto' => 3,
                'nombre_gasto' => 'Planilla empleados',
                'descripcion_gasto' => 'Pago quincenal de personal de tienda',
                'estado_gasto' => true,
                'fecha_inicio' => '2025-01-15',
                'fecha_pago' => '2026-05-15',
                'proximo_pago' => '2026-05-30',
                'estado_pago' => 'PAGADO',
                'ultimo_pago' => '2026-05-15',
            ],

            [
                'id_tipo_gasto' => 3,
                'nombre_gasto' => 'Horas extras',
                'descripcion_gasto' => 'Pago adicional por horas nocturnas',
                'estado_gasto' => true,
                'fecha_inicio' => '2026-04-01',
                'fecha_pago' => null,
                'proximo_pago' => '2026-06-01',
                'estado_pago' => 'PENDIENTE',
                'ultimo_pago' => null,
            ],

            /* ================= IMPUESTOS ================= */
            [
                'id_tipo_gasto' => 4,
                'nombre_gasto' => 'Impuesto municipal',
                'descripcion_gasto' => 'Pago de licencia comercial',
                'estado_gasto' => true,
                'fecha_inicio' => '2025-01-01',
                'fecha_pago' => '2026-05-20',
                'proximo_pago' => '2027-05-20',
                'estado_pago' => 'PENDIENTE',
                'ultimo_pago' => '2026-05-20',
            ],

            [
                'id_tipo_gasto' => 4,
                'nombre_gasto' => 'IVA mensual',
                'descripcion_gasto' => 'Declaración de impuestos de ventas',
                'estado_gasto' => true,
                'fecha_inicio' => '2025-01-01',
                'fecha_pago' => '2026-05-25',
                'proximo_pago' => '2026-06-25',
                'estado_pago' => 'PAGADO',
                'ultimo_pago' => '2026-05-25',
            ],

            /* ================= OPERATIVOS ================= */
            [
                'id_tipo_gasto' => 2,
                'nombre_gasto' => 'Mantenimiento del local',
                'descripcion_gasto' => 'Reparaciones menores y limpieza profunda',
                'estado_gasto' => true,
                'fecha_inicio' => '2026-03-01',
                'fecha_pago' => null,
                'proximo_pago' => '2026-06-15',
                'estado_pago' => 'PENDIENTE',
                'ultimo_pago' => null,
            ],

            [
                'id_tipo_gasto' => 2,
                'nombre_gasto' => 'Seguridad privada',
                'descripcion_gasto' => 'Servicio de vigilancia nocturna',
                'estado_gasto' => true,
                'fecha_inicio' => '2025-06-01',
                'fecha_pago' => '2026-05-01',
                'proximo_pago' => '2026-06-01',
                'estado_pago' => 'PAGADO',
                'ultimo_pago' => '2026-05-01',
            ],

            /* ================= OTROS ================= */
            [
                'id_tipo_gasto' => 5,
                'nombre_gasto' => 'Publicidad local',
                'descripcion_gasto' => 'Volantes y promociones en barrio',
                'estado_gasto' => true,
                'fecha_inicio' => '2026-04-10',
                'fecha_pago' => null,
                'proximo_pago' => '2026-06-10',
                'estado_pago' => 'PENDIENTE',
                'ultimo_pago' => null,
            ],

        ]);
    }
}