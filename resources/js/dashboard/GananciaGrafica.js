$(document).ready(function () {

    let chart = null;
    document.getElementById('titulo').textContent = 'Panel de Ganancias';

    const $ = id => document.getElementById(id);

    /* ══════════════════ [ELEMENTOS] ═══════════════════ */

    const Filtro_Ganancias       = $('Filtro-Ganancias');
    const Tipo_Grafica_Ganancias = $('Tipo-Grafica-Ganancias');

    const Select_Anio_Ganancias  = $('Select-Anio-Ganancias');
    const Select_Mes_Ganancias   = $('Select-Mes-Ganancias');
    const Select_Dia_Ganancias   = $('Select-Dia-Ganancias');

    const Fecha_Inicio_Ganancias  = $('Fecha-Inicio-Ganancias');
    const Fecha_Fin_Ganancias     = $('Fecha-Fin-Ganancias');

    const BTN_Limpiar_Ganancias   = $('BTN-Limpiar-Ganancias');

    const ctx_Ganancias = $('chartGanancias');

    /* ══════════════════ [SELECTORES] ══════════════════ */

    async function Cargar_Anios_Ganancias() {

        const response = await fetch('/dashboard/ganancias');
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

        Select_Anio_Ganancias.innerHTML = `<option value="">Año</option>`;

        anios.sort((a, b) => b - a)
            .forEach(anio => {
                Select_Anio_Ganancias.innerHTML += `
                    <option value="${anio}">${anio}</option>
                `;
            });
    }

    function Cargar_Meses_Ganancias() {

        Select_Mes_Ganancias.innerHTML = `<option value="">Mes</option>`;

        Meses.forEach((mes, index) => {
            Select_Mes_Ganancias.innerHTML += `
                <option value="${index + 1}">${mes}</option>
            `;
        });
    }

    function Cargar_Dias_Ganancias() {

        const anio = Number(Select_Anio_Ganancias.value);
        const mes  = Number(Select_Mes_Ganancias.value);

        Select_Dia_Ganancias.innerHTML = `<option value="">Día</option>`;

        if (!anio || !mes) return;

        const totalDias = new Date(anio, mes, 0).getDate();

        for (let i = 1; i <= totalDias; i++) {
            Select_Dia_Ganancias.innerHTML += `
                <option value="${i}">${i}</option>
            `;
        }
    }

    /* ══════════════════ [FUNCIONES] ══════════════════ */

    async function obtenerGanancias() {

        const params = new URLSearchParams({

            tipo: Filtro_Ganancias.value,

            anio: Select_Anio_Ganancias.value,
            mes: Select_Mes_Ganancias.value,
            dia: Select_Dia_Ganancias.value,

            inicio: Fecha_Inicio_Ganancias.value,
            fin: Fecha_Fin_Ganancias.value

        });

        const response = await fetch(`/dashboard/ganancias?${params}`);
        const data = await response.json();

        let datos = [];

        switch (Filtro_Ganancias.value) {

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

            document.getElementById('kpi-ganancia-total').innerText = moneda(kpis.ganancia_total ?? 0);
            document.getElementById('kpi-ingresos').innerText = moneda(kpis.ingresos ?? 0);
            document.getElementById('kpi-ganancia-unidad').innerText = moneda(kpis.ganancia_por_unidad ?? 0);
            document.getElementById('kpi-margen-venta').innerText = `${Number(kpis.margen_por_venta ?? 0).toFixed(2)}%`;
            document.getElementById('kpi-ventas-totales').innerText = Number(kpis.ventas_totales ?? 0).toLocaleString('es-NI');
        }

    /* ═════════════════ [RENDER GRAFICA] ═════════════════ */

    function renderGrafica(datos = []) {

        if (chart) chart.destroy();

        const labels = datos.map(item => item.label);

        chart = new Chart(ctx_Ganancias, {

            type: Tipo_Grafica_Ganancias.value,

            data: {

                labels,

                datasets: [
                    {
                        label: 'Ganancias (C$)',
                        data: datos.map(item => Number(item.ganancia ?? 0)),
                        backgroundColor: Colores.colores_2,
                        borderWidth: 1,
                        tension: 0.4,
                        fill: Tipo_Grafica_Ganancias.value === 'line',
                        yAxisID: 'y',
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
                                const ganancia = Number(item.ganancia ?? 0);
                                return `Ganancia: ${moneda(ganancia)}`;
                            }
                        }
                    }
                }
            }
        });
    }

    /* ═══════════════════════ [EVENTOS] ═══════════════════════ */

    Filtro_Ganancias.addEventListener('change', obtenerGanancias);
    Tipo_Grafica_Ganancias.addEventListener('change', obtenerGanancias);

    Select_Anio_Ganancias.addEventListener('change', () => {
        ResetearInputs(Select_Mes_Ganancias);
        Select_Mes_Ganancias.disabled = !Select_Anio_Ganancias.value;
        Cargar_Dias_Ganancias();
        ResetearInputs(Fecha_Inicio_Ganancias, Fecha_Fin_Ganancias);
        obtenerGanancias();
    });

    Select_Mes_Ganancias.addEventListener('change', () => {
        ResetearInputs(Select_Dia_Ganancias);
        Select_Dia_Ganancias.disabled = !Select_Mes_Ganancias.value;
        Cargar_Dias_Ganancias();
        ResetearInputs(Fecha_Inicio_Ganancias, Fecha_Fin_Ganancias);
        obtenerGanancias();
    });

    Select_Dia_Ganancias.addEventListener('change', () => {
        ResetearInputs(Fecha_Inicio_Ganancias, Fecha_Fin_Ganancias);
        obtenerGanancias();
    });

    Fecha_Inicio_Ganancias.addEventListener('change', () => {
        ResetearInputs(Select_Anio_Ganancias, Select_Mes_Ganancias, Select_Dia_Ganancias);
        obtenerGanancias();
    });

    Fecha_Fin_Ganancias.addEventListener('change', () => {
        ResetearInputs(Select_Anio_Ganancias, Select_Mes_Ganancias, Select_Dia_Ganancias);
        obtenerGanancias();
    });

    BTN_Limpiar_Ganancias.addEventListener('click', () => {

        Filtro_Ganancias.value = 'dia';
        Tipo_Grafica_Ganancias.value = 'bar';

        ResetearInputs(
            Select_Anio_Ganancias,
            Select_Mes_Ganancias,
            Select_Dia_Ganancias,
            Fecha_Inicio_Ganancias,
            Fecha_Fin_Ganancias
        );

        obtenerGanancias();
    });

    /* ═══════════════════════ [INICIO] ═══════════════════════ */

    Cargar_Anios_Ganancias();
    Cargar_Meses_Ganancias();
    Cargar_Dias_Ganancias();

    obtenerGanancias();

    FlatPickr(Fecha_Inicio_Ganancias);
    FlatPickr(Fecha_Fin_Ganancias);

    Chart.register(PluginSinDatos);

});