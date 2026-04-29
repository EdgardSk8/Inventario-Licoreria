<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use App\Models\MovimientoCaja;
use App\Models\MovimientoCuenta;
use App\Models\MovimientoGasto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Cuenta;
use App\Models\Caja;

class GastoController extends Controller
{

/*  ╔════════════ Mostrar Gastos ════════════╗ 
    ╚════════════════════════════════════════╝ */
    
    public function MostrarGastos()
    {
        try {

            $hoy = now()->startOfDay();

            $gastos = Gasto::with(['tipoGasto', 'movimientosGasto'])
                ->get()
                ->map(function ($gasto) use ($hoy) {

                    $ultimo = $gasto->movimientosGasto
                        ->sortByDesc('fecha')
                        ->first();

                    $estadoPago = 'SIN PAGAR';
                    $dias_restantes = null;
                    $dias_atraso = null;

                    /* ═══════════════════════════════════════
                    🔹 BASE REAL: PROXIMO PAGO
                    ═══════════════════════════════════════ */

                    $fechaBase = $gasto->proximo_pago
                        ? \Carbon\Carbon::parse($gasto->proximo_pago)->startOfDay()
                        : ($gasto->fecha_pago
                            ? \Carbon\Carbon::parse($gasto->fecha_pago)->startOfDay()
                            : null
                        );

                        if ($fechaBase) {

                            if ($hoy->gt($fechaBase)) {

                                $estadoPago = $ultimo ? 'PAGADO' : 'ATRASADO';
                                $dias_atraso = $fechaBase->diffInDays($hoy);

                            } else {

                                $estadoPago = $ultimo ? 'PAGADO' : 'SIN PAGAR';
                                $dias_restantes = $hoy->diffInDays($fechaBase);
                            }
                        }

                    return [
                        'id_gasto' => $gasto->id_gasto,
                        'nombre_gasto' => $gasto->nombre_gasto,
                        'descripcion_gasto' => $gasto->descripcion_gasto,
                        'estado_gasto' => $gasto->estado_gasto,

                        'tipo' => $gasto->tipoGasto->nombre_tipo_gasto ?? 'N/A',

                        'fecha_pago' => $gasto->fecha_pago,
                        'proximo_pago' => $gasto->proximo_pago,

                        'estado_pago' => $estadoPago,
                        'dias_restantes' => $dias_restantes,
                        'dias_atraso' => $dias_atraso,

                        'ultimo_pago_fecha' => $ultimo?->fecha,
                        'ultimo_pago_monto' => $ultimo?->monto,
                    ];
                });

            return response()->json([
                'success' => true,
                'gastos' => $gastos
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener gastos',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔═════════════ Crear Gastos ═════════════╗ 
    ╚════════════════════════════════════════╝ */

    public function CrearGasto(Request $request)
    {
        try {

            $request->validate([
                'id_tipo_gasto'     => 'required|integer|exists:tipo_gasto,id_tipo_gasto',
                'nombre_gasto'      => 'required|string|max:150',
                'descripcion_gasto' => 'nullable|string|max:200',
                'fecha_pago'        => 'nullable|date',
                'proximo_pago'      => 'nullable|date'
            ]);

            /* ═══════════════════════════════════════
            🔴 VALIDACIÓN LÓGICA
            ═══════════════════════════════════════ */

            if (!$request->fecha_pago && !$request->proximo_pago) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Debe definir una fecha de pago o próxima fecha de pago'
                ], 422);
            }

            /* ═══════════════════════════════════════
            🔥 FECHAS NORMALIZADAS
            ═══════════════════════════════════════ */

            $fecha_pago   = $request->fecha_pago;
            $proximo_pago = $request->proximo_pago ?? $fecha_pago;

            /* ═══════════════════════════════════════
            🔥 CREACIÓN
            ═══════════════════════════════════════ */

            $gasto = Gasto::create([
                'id_tipo_gasto'     => $request->id_tipo_gasto,
                'nombre_gasto'      => $request->nombre_gasto,
                'descripcion_gasto' => $request->descripcion_gasto,

                'fecha_pago'        => $fecha_pago,
                'proximo_pago'      => $proximo_pago,

                'estado_pago'       => 'PENDIENTE',
                'estado_gasto'      => true,
            ]);

            return response()->json([
                'success' => true,
                'mensaje' => 'Gasto creado correctamente',
                'gasto'   => $gasto
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al crear gasto',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

/*  ╔═════════════ Editar Gastos ════════════╗ 
    ╚════════════════════════════════════════╝ */

    public function EditarGasto($id)
    {
        try {

            $gasto = Gasto::where('id_gasto', $id)->first();

            if (!$gasto) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Gasto no encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'gasto' => $gasto
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener gasto',
                'detalle' => $e->getMessage()
            ], 500);

        }
    }

/*  ╔══════════ Actualizar Gastos ═══════════╗ 
    ╚════════════════════════════════════════╝ */

    public function ActualizarGasto(Request $request, $id)
    {
        try {

            $gasto = Gasto::where('id_gasto', $id)->first();

            if (!$gasto) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Gasto no encontrado'
                ], 404);
            }

            $validator = Validator::make(

                [
                    'id_tipo_gasto' => $request->id_tipo_gasto,
                    'nombre_gasto' => $request->nombre_gasto,
                    'descripcion_gasto' => $request->descripcion_gasto,
                    'estado_gasto' => $request->estado_gasto
                ],

                [
                    'id_tipo_gasto' => [
                        'required',
                        'exists:tipo_gasto,id_tipo_gasto'
                    ],

                    'nombre_gasto' => [
                        'required',
                        'string',
                        'max:150'
                    ],

                    'descripcion_gasto' => [
                        'nullable',
                        'string',
                        'max:200'
                    ],

                    'estado_gasto' => [
                        'required',
                        'boolean'
                    ]
                ],

                [
                    'id_tipo_gasto.exists' => 'El tipo de gasto no existe.',
                    'nombre_gasto.required' => 'El nombre del gasto es obligatorio.'
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $gasto->id_tipo_gasto = $request->id_tipo_gasto;
            $gasto->nombre_gasto = $request->nombre_gasto;
            $gasto->descripcion_gasto = $request->descripcion_gasto;
            $gasto->estado_gasto = $request->estado_gasto;

            $gasto->save();

            return response()->json([
                'success' => true,
                'mensaje' => 'Gasto actualizado correctamente'
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al actualizar gasto',
                'detalle' => $e->getMessage()
            ], 500);

        }
    }

/*  ╔═════════════ Pagar Gastos ═════════════╗ 
    ╚════════════════════════════════════════╝ */

 public function DetalleGasto($id)
{

   
    $gasto = Gasto::with([
        'tipoGasto',
        'movimientosGasto.usuario',
        'movimientosGasto.caja',
        'movimientosGasto.cuenta'
    ])->find($id);

    if (!$gasto) {
        return response()->json([
            'success' => false
        ], 404);
    }

    return response()->json([
        'success' => true,
        'gasto' => [
            'id_gasto' => $gasto->id_gasto,
            'nombre_gasto' => $gasto->nombre_gasto,
            'descripcion_gasto' => $gasto->descripcion_gasto,
            'tipo' => $gasto->tipoGasto->nombre_tipo_gasto ?? '—',
            'estado_pago' => $gasto->estado_pago ?? 'SIN PAGAR',

            // 🔥 FIX REAL: asegurar orden correcto del último pago
            'ultimo_pago_fecha' =>
                optional($gasto->movimientosGasto->sortByDesc('fecha')->first())->fecha,

            // 🔥 HISTORIAL
            'movimientos' => $gasto->movimientosGasto->map(function ($m) {

                return [
                    'id' => $m->id_movimiento_gasto,
                    'fecha' => $m->fecha,
                    'monto' => $m->monto,
                    'origen' => $m->origen,

                    'usuario' => [
                        'id' => $m->id_usuario,
                        'nombre' => $m->usuario?->nombre_usuario ?? '—'
                    ],


                    // 🔥 CAJA (SIN TOCAR)
                    'id_caja' => $m->id_caja,
                    'caja' => $m->caja?->id_caja,

                    // 🔥 CUENTA (SIN TOCAR)
                    'id_cuenta' => $m->id_cuenta,
                    'cuenta' => $m->cuenta?->nombre_cuenta,
                ];
            })->values()
        ]
    ]);
}

    public function EditarMovimientoGasto(Request $request)
    {
        try {

            \Log::info('INICIO EDITAR MOVIMIENTO', $request->all());

            $request->validate([
                'id_movimiento_gasto' => 'required|exists:movimientos_gastos,id_movimiento_gasto',
                'monto'               => 'required|numeric|min:0.01',
                'id_caja'             => 'nullable|exists:cajas,id_caja',
                'id_cuenta'           => 'nullable|exists:cuentas,id_cuenta',
            ]);

            if (!$request->id_caja && !$request->id_cuenta) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Debe seleccionar caja o cuenta'
                ], 422);
            }

            if ($request->id_caja && $request->id_cuenta) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Solo puede usar caja o cuenta'
                ], 422);
            }

            DB::beginTransaction();

            $mov = MovimientoGasto::lockForUpdate()
                ->find($request->id_movimiento_gasto);

            if (!$mov) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Movimiento no encontrado'
                ], 404);
            }

            \Log::info('MOVIMIENTO ORIGINAL', $mov->toArray());

            $montoNuevo = (float) $request->monto;
            $montoViejo = (float) $mov->monto;

            /* =====================================================
                🔴 REVERSAR MOVIMIENTO ANTERIOR
            ===================================================== */

            if ($mov->origen === 'CAJA' && $mov->id_caja) {

                $cajaOld = Caja::lockForUpdate()->find($mov->id_caja);

                if ($cajaOld) {

                    // devolver dinero
                    $cajaOld->monto_inicial += $montoViejo;
                    $cajaOld->save();

                    // reverso lógico (opcional auditoría)
                    MovimientoCaja::create([
                        'id_caja' => $cajaOld->id_caja,
                        'tipo_movimiento_caja' => 'INGRESO',
                        'concepto_movimiento_caja' => 'Reverso edición gasto',
                        'monto_movimiento_caja' => $montoViejo,
                        'fecha_movimiento_caja' => now(),
                        'id_usuario' => session('usuario.id')
                    ]);
                }
            }

            if ($mov->origen === 'CUENTA' && $mov->id_cuenta) {

                $cuentaOld = Cuenta::lockForUpdate()->find($mov->id_cuenta);

                if ($cuentaOld) {

                    $cuentaOld->saldo_actual += $montoViejo;
                    $cuentaOld->save();

                    MovimientoCuenta::create([
                        'id_cuenta' => $cuentaOld->id_cuenta,
                        'tipo_movimiento' => 'INGRESO',
                        'descripcion' => 'Reverso edición gasto',
                        'monto' => $montoViejo,
                        'fecha' => now(),
                        'id_usuario' => session('usuario.id')
                    ]);
                }
            }

            /* =====================================================
                🔵 APLICAR NUEVO ORIGEN
            ===================================================== */

            // ================= CAJA =================
            if ($request->id_caja) {

                $caja = Caja::lockForUpdate()->find($request->id_caja);

                if (!$caja) {
                    DB::rollBack();
                    return response()->json(['success' => false, 'mensaje' => 'Caja no encontrada'], 404);
                }

                // 🔥 VALIDAR CAJA CERRADA
                if (isset($caja->estado_caja) && $caja->estado_caja == 0) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'mensaje' => 'La caja está cerrada'
                    ], 422);
                }

                // saldo real
                $totalIngresos = MovimientoCaja::where('id_caja', $caja->id_caja)
                    ->where('tipo_movimiento_caja', 'INGRESO')
                    ->sum('monto_movimiento_caja');

                $totalSalidas = MovimientoCaja::where('id_caja', $caja->id_caja)
                    ->where('tipo_movimiento_caja', 'SALIDA')
                    ->sum('monto_movimiento_caja');

                $saldoCaja = $caja->monto_inicial + $totalIngresos - $totalSalidas;

                if ($montoNuevo > $saldoCaja) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'mensaje' => 'Saldo insuficiente en caja'
                    ], 422);
                }

                // descontar
                $caja->monto_inicial -= $montoNuevo;
                $caja->save();

                // movimiento auditoría
                MovimientoCaja::create([
                    'id_caja' => $caja->id_caja,
                    'tipo_movimiento_caja' => 'SALIDA',
                    'concepto_movimiento_caja' => 'Edición gasto',
                    'monto_movimiento_caja' => $montoNuevo,
                    'fecha_movimiento_caja' => now(),
                    'id_usuario' => session('usuario.id')
                ]);

                $mov->origen = 'CAJA';
                $mov->id_caja = $caja->id_caja;
                $mov->id_cuenta = null;
            }

            // ================= CUENTA =================
            if ($request->id_cuenta) {

                $cuenta = Cuenta::lockForUpdate()->find($request->id_cuenta);

                if (!$cuenta) {
                    DB::rollBack();
                    return response()->json(['success' => false, 'mensaje' => 'Cuenta no encontrada'], 404);
                }

                if ($montoNuevo > $cuenta->saldo_actual) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'mensaje' => 'Saldo insuficiente en cuenta'
                    ], 422);
                }

                $cuenta->saldo_actual -= $montoNuevo;
                $cuenta->save();

                MovimientoCuenta::create([
                    'id_cuenta' => $cuenta->id_cuenta,
                    'tipo_movimiento' => 'SALIDA',
                    'descripcion' => 'Edición gasto',
                    'monto' => $montoNuevo,
                    'fecha' => now(),
                    'id_usuario' => session('usuario.id')
                ]);

                $mov->origen = 'CUENTA';
                $mov->id_cuenta = $cuenta->id_cuenta;
                $mov->id_caja = null;
            }

            /* =====================================================
                🟢 ACTUALIZAR MOVIMIENTO
            ===================================================== */

            $mov->monto = $montoNuevo;
            $mov->save();

            DB::commit();

            \Log::info('MOVIMIENTO ACTUALIZADO OK');

            return response()->json([
                'success' => true,
                'mensaje' => 'Movimiento actualizado correctamente'
            ]);

        } catch (\Throwable $e) {

            DB::rollBack();

            \Log::error('ERROR EDITAR MOVIMIENTO', [
                'mensaje' => $e->getMessage(),
                'linea' => $e->getLine(),
                'archivo' => $e->getFile()
            ]);

            return response()->json([
                'success' => false,
                'mensaje' => 'Error interno',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


    public function PagarGasto(Request $request)
    {
        try {

            $request->validate([
                'id_gasto' => 'required|exists:gastos,id_gasto',
                'monto' => 'required|numeric|min:0.01',
                'id_caja' => 'nullable|exists:cajas,id_caja',
                'id_cuenta' => 'nullable|exists:cuentas,id_cuenta',
                'renovar_vencimiento' => 'nullable|string',
                'nueva_fecha' => 'nullable|date'
            ]);

            DB::beginTransaction();

            $gasto = Gasto::lockForUpdate()->find($request->id_gasto);

            if (!$gasto) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Gasto no encontrado'
                ], 404);
            }

            if (!$request->id_caja && !$request->id_cuenta) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Debe seleccionar caja o cuenta'
                ], 422);
            }

            if ($request->id_caja && $request->id_cuenta) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Solo puede usar caja o cuenta'
                ], 422);
            }

            $idUsuario = session('usuario.id');

            if (!$idUsuario) {
                return response()->json([
                    'success' => false,
                    'mensaje' => 'Usuario no autenticado'
                ], 401);
            }

            $monto = $request->monto;
            $fecha = now();
            $concepto = 'Pago de gasto: ' . $gasto->nombre_gasto;

            /* ═══════════════════════════════
                🔥 PAGO CON CAJA
            ═══════════════════════════════ */
            if ($request->id_caja) {

                $caja = Caja::lockForUpdate()->find($request->id_caja);

                if (!$caja) {
                    return response()->json([
                        'success' => false,
                        'mensaje' => 'Caja no encontrada'
                    ], 404);
                }

                $totalIngresos = MovimientoCaja::where('id_caja', $caja->id_caja)
                    ->where('tipo_movimiento_caja', 'INGRESO')
                    ->sum('monto_movimiento_caja');

                $totalSalidas = MovimientoCaja::where('id_caja', $caja->id_caja)
                    ->where('tipo_movimiento_caja', 'SALIDA')
                    ->sum('monto_movimiento_caja');

                $saldoCaja = $caja->monto_inicial + $totalIngresos - $totalSalidas;

                if ($monto > $saldoCaja) {
                    return response()->json([
                        'success' => false,
                        'mensaje' => 'Saldo insuficiente en caja'
                    ], 422);
                }

                // 🔥 DESCONTAR CAJA (MOVIMIENTO)
                MovimientoCaja::create([
                    'id_caja' => $caja->id_caja,
                    'tipo_movimiento_caja' => 'SALIDA',
                    'concepto_movimiento_caja' => $concepto,
                    'monto_movimiento_caja' => $monto,
                    'fecha_movimiento_caja' => $fecha,
                    'id_usuario' => $idUsuario
                ]);
            }

            /* ═══════════════════════════════
                🔥 PAGO CON CUENTA
            ═══════════════════════════════ */
            if ($request->id_cuenta) {

                $cuenta = Cuenta::lockForUpdate()->find($request->id_cuenta);

                if (!$cuenta) {
                    return response()->json([
                        'success' => false,
                        'mensaje' => 'Cuenta no encontrada'
                    ], 404);
                }

                if ($monto > $cuenta->saldo_actual) {
                    return response()->json([
                        'success' => false,
                        'mensaje' => 'Saldo insuficiente en cuenta'
                    ], 422);
                }

                // 🔥 DESCONTAR CUENTA
                $cuenta->saldo_actual -= $monto;
                $cuenta->save();

                // 🔥 MOVIMIENTO CUENTA
                MovimientoCuenta::create([
                    'id_cuenta' => $cuenta->id_cuenta,
                    'tipo_movimiento' => 'SALIDA',
                    'descripcion' => $concepto,
                    'monto' => $monto,
                    'fecha' => $fecha,
                    'id_usuario' => $idUsuario
                ]);
            }

            /* ═══════════════════════════════
                🔥 REGISTRO GASTO
            ═══════════════════════════════ */
            MovimientoGasto::create([
                'id_gasto' => $gasto->id_gasto,
                'monto' => $monto,
                'origen' => $request->id_caja ? 'CAJA' : 'CUENTA',
                'id_caja' => $request->id_caja,
                'id_cuenta' => $request->id_cuenta,
                'fecha' => $fecha,
                'id_usuario' => $idUsuario,
                'observacion' => $concepto
            ]);

            /* ═══════════════════════════════
                🔥 RENOVACIÓN DE VENCIMIENTO
            ═══════════════════════════════ */
            if ($request->renovar_vencimiento) {

                if ($request->renovar_vencimiento === 'auto') {

                    $gasto->fecha_pago = $gasto->fecha_pago
                        ? \Carbon\Carbon::parse($gasto->fecha_pago)->addMonth()
                        : now()->addMonth();

                } elseif ($request->renovar_vencimiento === 'manual' && $request->nueva_fecha) {

                    $gasto->fecha_pago = $request->nueva_fecha;
                }

                $gasto->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'mensaje' => 'Pago registrado correctamente'
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'success' => false,
                'mensaje' => 'Errores de validación',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'mensaje' => 'Error al registrar pago',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }

    public function MostrarCajasGastos()
    {
        try {

            $cajas = Caja::with('usuario')
                ->where('estado_caja', 1)
                ->orderBy('id_caja', 'asc')
                ->get()
                ->map(function ($caja) {

                    $totalIngresos = MovimientoCaja::where('id_caja', $caja->id_caja)
                        ->where('tipo_movimiento_caja', 'INGRESO')
                        ->sum('monto_movimiento_caja');

                    $totalSalidas = MovimientoCaja::where('id_caja', $caja->id_caja)
                        ->where('tipo_movimiento_caja', 'SALIDA')
                        ->sum('monto_movimiento_caja');

                    $saldo = $caja->monto_inicial + $totalIngresos - $totalSalidas;

                    return [
                        'id' => $caja->id_caja,
                        'display' => "Caja #{$caja->id_caja} - {$caja->usuario->nombre_usuario} (Saldo: C$ " . number_format($saldo, 2) . ")"
                    ];
                });

            return response()->json([
                'success' => true,
                'cajas' => $cajas
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener cajas',
                'detalle' => $e->getMessage()
            ], 500);
        }
    }


    public function MostrarCuentasGastos()
    {
        try {
            // Trae solo las cuentas activas
            $cuentas = Cuenta::where('estado', 1)
                ->orderBy('nombre_cuenta', 'asc')
                ->get();

            // Formatea los datos para el <select>
            $data = $cuentas->map(function ($cuenta) {
                return [
                    'id' => $cuenta->id_cuenta, // valor real que se envía al backend
                    'nombre' => $cuenta->nombre_cuenta,
                    'saldo_actual' => number_format($cuenta->saldo_actual, 2),
                    'display' => "{$cuenta->nombre_cuenta} (Saldo: C$ " . number_format($cuenta->saldo_actual, 2) . ")"
                ];
            });

            return response()->json([
                'success' => true,
                'cuentas' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mensaje' => 'Error al obtener cuentas'
            ], 500);
        }
    }
}
