$(document).ready(function () {

    let chart = null;

    document.getElementById('titulo').textContent = 'Panel Analítico';

    const $ = id => document.getElementById(id);

    /* ══════════════════ [ELEMENTOS] ═══════════════════ */

    const Filtro_Ventas         = $('Filtro-Ventas');
    const Tipo_Grafica_Ventas   = $('Tipo-Grafica-Ventas');

    const Select_Anio_Ventas    = $('Select-Anio-Ventas');
    const Select_Mes_Ventas     = $('Select-Mes-Ventas');
    const Select_Dia_Ventas     = $('Select-Dia-Ventas');

    const Fecha_Inicio_Ventas   = $('Fecha-Inicio-Ventas');
    const Fecha_Fin_Ventas      = $('Fecha-Fin-Ventas');

    const BTN_Limpiar_Ventas    = $('BTN-Limpiar-Ventas');

    const ctx_Ventas            = $('chartVentas');

    /* ══════════════════ [SELECTORES] ══════════════════ */

    async function Cargar_Anios_Ventas() {

        const response = await fetch('/dashboard/ventas');
        const data = await response.json();

        const anios = [
            ...new Set(
                data.grafica.map(item => {

                    const fecha = new Date(item.label);

                    if (isNaN(fecha)) return null;

                    return fecha.getFullYear();

                }).filter(Boolean)
            )
        ];

        Select_Anio_Ventas.innerHTML = `
            <option value="">Año</option>
        `;

        anios
            .sort((a, b) => b - a)
            .forEach(anio => {

                Select_Anio_Ventas.innerHTML += `
                    <option value="${anio}">
                        ${anio}
                    </option>
                `;
            });
    }

    function Cargar_Meses_Ventas() {

        Select_Mes_Ventas.innerHTML = `
            <option value="">Mes</option>
        `;

        Meses.forEach((mes, index) => {

            Select_Mes_Ventas.innerHTML += `
                <option value="${index + 1}">
                    ${mes}
                </option>
            `;
        });
    }

    function Cargar_Dias_Ventas() {

        const anio = Number(Select_Anio_Ventas.value);
        const mes  = Number(Select_Mes_Ventas.value);

        Select_Dia_Ventas.innerHTML = `
            <option value="">Día</option>
        `;

        if (!anio || !mes) return;

        const totalDias = new Date(anio, mes, 0).getDate();

        for (let i = 1; i <= totalDias; i++) {

            Select_Dia_Ventas.innerHTML += `
                <option value="${i}">
                    ${i}
                </option>
            `;
        }
    }

    /* ══════════════════ [FUNCIONES] ══════════════════ */

    async function obtenerVentas() {

        const params = new URLSearchParams({

            tipo: Filtro_Ventas.value,

            anio: Select_Anio_Ventas.value,
            mes: Select_Mes_Ventas.value,
            dia: Select_Dia_Ventas.value,

            inicio: Fecha_Inicio_Ventas.value,
            fin: Fecha_Fin_Ventas.value

        });

        const response = await fetch(`/dashboard/ventas?${params}`);
        const data = await response.json();

        let datos = [];

        switch (Filtro_Ventas.value) {

            case 'clientes':
                datos = data.clientes;
                break;

            case 'usuarios':
                datos = data.usuarios;
                break;

            case 'metodos_pago':
                datos = data.metodos_pago;
                break;

            case 'estado':
                datos = data.estado;
                break;

            case 'dias_fuertes':
                datos = data.dias_fuertes;
                break;

            default:
                datos = data.grafica;
                break;
        }

        renderGrafica(datos);
        renderKPIs(data.kpis);

    }

    /* ═════════════════ [KPIs] ═════════════════ */

    function renderKPIs(kpis) {

        if (!kpis) return;

        document.getElementById('kpi-total-ventas')
            .innerText = Number(kpis.total_ventas ?? 0).toLocaleString('es-NI');

        document.getElementById('kpi-ingresos-venta')
            .innerText = `C$ ${Number(kpis.ingresos ?? 0).toLocaleString('es-NI', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;

        document.getElementById('kpi-unidades-vendidas')
            .innerText = Number(kpis.unidades_vendidas ?? 0).toLocaleString('es-NI');

        document.getElementById('kpi-promedio-venta')
            .innerText = `C$ ${Number(kpis.promedio_venta ?? 0).toLocaleString('es-NI', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;

        document.getElementById('kpi-venta-maxima')
            .innerText = `C$ ${Number(kpis.venta_maxima ?? 0).toLocaleString('es-NI', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;

        document.getElementById('kpi-impuestos')
            .innerText = `C$ ${Number(kpis.impuestos ?? 0).toLocaleString('es-NI', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;
    }

    /* ═════════════════ [RENDER GRAFICA] ═════════════════ */

    function renderGrafica(datos = []) {

        if (chart) chart.destroy();

        const labels = datos.map(item => item.label);

        chart = new Chart(ctx_Ventas, {

            type: Tipo_Grafica_Ventas.value,

            data: {

                labels,

                datasets: [
                    {
                        label: 'Ingresos (C$)',

                        data: datos.map(item =>
                            Number(item.total ?? 0)
                        ),

                        backgroundColor: Colores.colores_2,
                        borderWidth: 1,
                        tension: 0.4,

                        fill: Tipo_Grafica_Ventas.value === 'line',

                        yAxisID: 'y',
                    },

                    {
                        label: 'Ventas (cantidad)',

                        data: datos.map(item =>
                            Number(item.cantidad ?? item.ventas ?? 0)
                        ),

                        backgroundColor: Colores.colores_1,
                        borderWidth: 2,
                        tension: 0.4,

                        fill: Tipo_Grafica_Ventas.value === 'line',

                        yAxisID: 'y1',
                    }
                ]
            },

            options: {

                scales: {

                    x: {

                        ticks: {

                            callback: function(value) {

                                const label = this.getLabelForValue(value);

                                return EjeXDashboard(label);
                            }
                        }
                    }
                },

                responsive: true,
                maintainAspectRatio: false,

                plugins: {

                    tooltip: {

                        callbacks: {
                            
                            title: function(context) {

                                const item = datos[context[0].dataIndex];

                                return formatearFechaDashboard(item.label);
                            },

                            label: function (context) {

                                const item = datos[context.dataIndex];

                                const total = Number(item.total ?? 0);

                                const cantidad = Number(
                                    item.cantidad ??
                                    item.ventas ??
                                    0
                                );

                                if (context.datasetIndex === 0) {
                                    return ` Ingresos: C$ ${total.toFixed(2)}`;
                                }

                                return ` Ventas: ${cantidad}`;
                            }
                        }
                    }
                }
            }
        });
    }

    /* ═══════════════════════ [EVENTOS] ═══════════════════════ */

    Filtro_Ventas.addEventListener('change', obtenerVentas);

    Tipo_Grafica_Ventas.addEventListener('change', obtenerVentas);

    Select_Anio_Ventas.addEventListener('change', () => {

        ResetearInputs(Select_Mes_Ventas);

        Select_Mes_Ventas.disabled = !Select_Anio_Ventas.value;

        Cargar_Dias_Ventas();

        ResetearInputs(
            Fecha_Inicio_Ventas,
            Fecha_Fin_Ventas
        );

        obtenerVentas();
    });

    Select_Mes_Ventas.addEventListener('change', () => {

        ResetearInputs(Select_Dia_Ventas);

        Select_Dia_Ventas.disabled = !Select_Mes_Ventas.value;

        Cargar_Dias_Ventas();

        ResetearInputs(
            Fecha_Inicio_Ventas,
            Fecha_Fin_Ventas
        );

        obtenerVentas();
    });

    Select_Dia_Ventas.addEventListener('change', () => {

        ResetearInputs(
            Fecha_Inicio_Ventas,
            Fecha_Fin_Ventas
        );

        obtenerVentas();
    });

    Fecha_Inicio_Ventas.addEventListener('change', () => {

        ResetearInputs(
            Select_Anio_Ventas,
            Select_Mes_Ventas,
            Select_Dia_Ventas
        );

        obtenerVentas();
    });

    Fecha_Fin_Ventas.addEventListener('change', () => {

        ResetearInputs(
            Select_Anio_Ventas,
            Select_Mes_Ventas,
            Select_Dia_Ventas
        );

        obtenerVentas();
    });

    BTN_Limpiar_Ventas.addEventListener('click', () => {

        Filtro_Ventas.value = 'dia';

        Tipo_Grafica_Ventas.value = 'bar';

        ResetearInputs(

            Select_Anio_Ventas,
            Select_Mes_Ventas,
            Select_Dia_Ventas,

            Fecha_Inicio_Ventas,
            Fecha_Fin_Ventas

        );

        obtenerVentas();
    });

    /* ═══════════════════════ [INICIO] ═══════════════════════ */

    Cargar_Anios_Ventas();

    Cargar_Meses_Ventas();

    Cargar_Dias_Ventas();

    obtenerVentas();

    FlatPickr(Fecha_Inicio_Ventas);

    FlatPickr(Fecha_Fin_Ventas);

    Chart.register(PluginSinDatos);

});