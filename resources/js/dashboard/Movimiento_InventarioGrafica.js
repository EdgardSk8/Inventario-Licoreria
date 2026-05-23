$(document).ready(function () {

    let chart = null;

    document.getElementById('titulo').textContent = 'Panel Inventario';

    const $ = id => document.getElementById(id);

    /* ══════════════════ [ELEMENTOS] ═══════════════════ */

    const Filtro_Inventario       = $('Filtro-Inventario');
    const Tipo_Grafica_Inventario = $('Tipo-Grafica-Inventario');

    const Select_Anio_Inventario  = $('Select-Anio-Inventario');
    const Select_Mes_Inventario   = $('Select-Mes-Inventario');
    const Select_Dia_Inventario   = $('Select-Dia-Inventario');

    const Fecha_Inicio_Inventario = $('Fecha-Inicio-Inventario');
    const Fecha_Fin_Inventario    = $('Fecha-Fin-Inventario');

    const BTN_Limpiar_Inventario  = $('BTN-Limpiar-Inventario');

    const ctx_Inventario          = $('Chart-Inventario');

    /* ══════════════════ [SELECTORES] ══════════════════ */

    async function Cargar_Anios_Inventario() {

        const response = await fetch('/dashboard/movimiento-inventario');
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

        Select_Anio_Inventario.innerHTML = `<option value="">Año</option>`;

        anios.sort((a, b) => b - a).forEach(anio => {
            Select_Anio_Inventario.innerHTML += `
                <option value="${anio}">${anio}</option>
            `;
        });
    }

    function Cargar_Meses_Inventario() {

        Select_Mes_Inventario.innerHTML = `<option value="">Mes</option>`;

        Meses.forEach((mes, index) => {
            Select_Mes_Inventario.innerHTML += `
                <option value="${index + 1}">${mes}</option>
            `;
        });
    }

    function Cargar_Dias_Inventario() {

        const anio = Number(Select_Anio_Inventario.value);
        const mes  = Number(Select_Mes_Inventario.value);

        Select_Dia_Inventario.innerHTML = `<option value="">Día</option>`;

        if (!anio || !mes) return;

        const totalDias = new Date(anio, mes, 0).getDate();

        for (let i = 1; i <= totalDias; i++) {
            Select_Dia_Inventario.innerHTML += `
                <option value="${i}">${i}</option>
            `;
        }
    }

    /* ══════════════════ [FUNCIONES] ══════════════════ */

    async function obtenerMovimientos() {

        const params = new URLSearchParams({

            tipo: Filtro_Inventario.value,
            anio: Select_Anio_Inventario.value,
            mes: Select_Mes_Inventario.value,
            dia: Select_Dia_Inventario.value,
            inicio: Fecha_Inicio_Inventario.value,
            fin: Fecha_Fin_Inventario.value
        });

        const response = await fetch(`/dashboard/movimiento-inventario?${params}`);
        const data = await response.json();

        renderKPIs(data.kpis);
        renderGrafica(data.grafica);
    }

    /* ═════════════════ [KPIs] ═════════════════ */

    function renderKPIs(kpis) {

        if (!kpis) return;

        document.getElementById('kpi-total-movimientos').innerText =
            Number(kpis.total_movimientos ?? 0).toLocaleString('es-NI');

        document.getElementById('kpi-entradas').innerText =
            Number(kpis.entradas ?? 0).toLocaleString('es-NI');

        document.getElementById('kpi-salidas').innerText =
            Number(kpis.salidas ?? 0).toLocaleString('es-NI');

        document.getElementById('kpi-ajustes').innerText =
            Number(kpis.ajustes ?? 0).toLocaleString('es-NI');

        document.getElementById('kpi-balance').innerText =
            Number(kpis.balance ?? 0).toLocaleString('es-NI');

        document.getElementById('kpi-promedio').innerText =
            Number(kpis.promedio_movimiento ?? 0).toLocaleString('es-NI', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
    }

    /* ═════════════════ [RENDER GRAFICA] ═════════════════ */

    function renderGrafica(datos = []) {

        if (chart) chart.destroy();

        const labels = datos.map(item => item.label);

        chart = new Chart(ctx_Inventario, {

            type: Tipo_Grafica_Inventario.value,

            data: {

                labels,

                datasets: [
                    {
                        label: 'Entradas',
                        data: datos.map(i => Number(i.entradas ?? 0)),
                        backgroundColor: Colores.colores_1,
                        //borderColor: 'rgb(25, 135, 84)',
                        borderWidth: 1,
                        tension: 0.4,
                        fill: Tipo_Grafica_Inventario.value === 'line'
                    },
                    {
                        label: 'Salidas',
                        data: datos.map(i => Number(i.salidas ?? 0)),
                        backgroundColor: Colores.colores_2,
                        //borderColor: 'rgb(220, 53, 69)',
                        borderWidth: 1,
                        tension: 0.4,
                        fill: Tipo_Grafica_Inventario.value === 'line'
                    },
                    {
                        label: 'Ajustes',
                        data: datos.map(i => Number(i.ajustes ?? 0)),
                        backgroundColor: 'rgba(255, 193, 7, 0.7)',
                        borderColor: 'rgb(255, 193, 7)',
                        borderWidth: 1,
                        tension: 0.4,
                        hidden: true,
                        fill: Tipo_Grafica_Inventario.value === 'line'
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

                            title: function (context) {
                                return formatearFechaDashboard(
                                    datos[context[0].dataIndex].label
                                );
                            },

                            label: function (context) {

                                const item = datos[context.dataIndex];

                                if (context.dataset.label === 'Entradas')
                                    return `Entradas: ${item.entradas}`;

                                if (context.dataset.label === 'Salidas')
                                    return `Salidas: ${item.salidas}`;

                                return `Ajustes: ${item.ajustes}`;
                            }
                        }
                    }
                }
            }
        });
    }

    /* ═════════════════ [EVENTOS] ═════════════════ */

    Filtro_Inventario.addEventListener('change', obtenerMovimientos);
    Tipo_Grafica_Inventario.addEventListener('change', obtenerMovimientos);

    Select_Anio_Inventario.addEventListener('change', () => {
        ResetearInputs(Select_Mes_Inventario);
        Select_Mes_Inventario.disabled = !Select_Anio_Inventario.value;
        Cargar_Dias_Inventario();
        ResetearInputs(Fecha_Inicio_Inventario, Fecha_Fin_Inventario);
        obtenerMovimientos();
    });

    Select_Mes_Inventario.addEventListener('change', () => {
        ResetearInputs(Select_Dia_Inventario);
        Select_Dia_Inventario.disabled = !Select_Mes_Inventario.value;
        Cargar_Dias_Inventario();
        ResetearInputs(Fecha_Inicio_Inventario, Fecha_Fin_Inventario);
        obtenerMovimientos();
    });

    Select_Dia_Inventario.addEventListener('change', () => {
        ResetearInputs(Fecha_Inicio_Inventario, Fecha_Fin_Inventario);
        obtenerMovimientos();
    });

    Fecha_Inicio_Inventario.addEventListener('change', () => {
        ResetearInputs(Select_Anio_Inventario, Select_Mes_Inventario, Select_Dia_Inventario);
        obtenerMovimientos();
    });

    Fecha_Fin_Inventario.addEventListener('change', () => {
        ResetearInputs(Select_Anio_Inventario, Select_Mes_Inventario, Select_Dia_Inventario);
        obtenerMovimientos();
    });

    BTN_Limpiar_Inventario.addEventListener('click', () => {

        Filtro_Inventario.value = 'dia';
        Tipo_Grafica_Inventario.value = 'bar';

        ResetearInputs(
            Select_Anio_Inventario,
            Select_Mes_Inventario,
            Select_Dia_Inventario,
            Fecha_Inicio_Inventario,
            Fecha_Fin_Inventario
        );

        obtenerMovimientos();
    });

    /* ═════════════════ [INIT] ═════════════════ */

    Cargar_Anios_Inventario();
    Cargar_Meses_Inventario();
    Cargar_Dias_Inventario();
    obtenerMovimientos();

    FlatPickr(Fecha_Inicio_Inventario);
    FlatPickr(Fecha_Fin_Inventario);
});