$(document).ready(function () {

    let chart = null;

    const $ = id => document.getElementById(id);

    /* ══════════════════ [ELEMENTOS] ═══════════════════ */

    const Filtro_Inventario         = $('Filtro-Inventario');
    const Tipo_Grafica_Inventario   = $('Tipo-Grafica-Inventario');
    const Select_Anio_Inventario    = $('Select-Anio-Inventario');
    const Select_Mes_Inventario     = $('Select-Mes-Inventario');
    const Select_Dia_Inventario     = $('Select-Dia-Inventario');
    const Fecha_Inicio_Inventario   = $('Fecha-Inicio-Inventario');
    const Fecha_Fin_Inventario      = $('Fecha-Fin-Inventario');
    const BTN_Limpiar_Inventario    = $('BTN-Limpiar-Inventario');
    const ctx_Inventario = $('Chart-Inventario');

    /* ══════════════════ [SELECTORES] ══════════════════ */

    async function Cargar_Anios_Inventario() {

        const response = await fetch('/dashboard/ventas');
        const data = await response.json();

        const anios = [
            ...new Set(
                data.grafica
                    .map(item => {

                        const fecha = new Date(item.label);

                        if (isNaN(fecha)) return null;

                        return fecha.getFullYear();

                    })
                    .filter(Boolean)
            )
        ];

        Select_Anio_Inventario.innerHTML = `
            <option value="">Año</option>
        `;

        anios
            .sort((a, b) => b - a)
            .forEach(anio => {

                Select_Anio_Inventario.innerHTML += `
                    <option value="${anio}">
                        ${anio}
                    </option>
                `;
            });
    }

    function Cargar_Meses_Inventario() {

        Select_Mes_Inventario.innerHTML = `
            <option value="">Mes</option>
        `;

        Meses.forEach((mes, index) => {

            Select_Mes_Inventario.innerHTML += `
                <option value="${index + 1}">
                    ${mes}
                </option>
            `;
        });
    }

    function Cargar_Dias_Inventario() {

        const anio = Number(Select_Anio_Inventario.value);
        const mes  = Number(Select_Mes_Inventario.value);

        Select_Dia_Inventario.innerHTML = `
            <option value="">Día</option>
        `;

        if(!anio || !mes) return;

        const totalDias = new Date(anio, mes, 0).getDate();

        for(let i = 1; i <= totalDias; i++) {

            Select_Dia_Inventario.innerHTML += `
                <option value="${i}">
                    ${i}
                </option>
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

        let datos = [];

        switch(Filtro_Inventario.value) {

            case 'tipo_movimiento':
                datos = data.por_tipo_movimiento;
            break;

            case 'tipo_referencia':
                datos = data.por_tipo_referencia;
            break;

            default:
                datos = data.grafica;
            break;
        }

        renderGrafica(datos);
    }

    /* ═════════════════ [RENDERIZADO] ═════════════════ */

    function renderGrafica(datos = []) {

        if(chart) chart.destroy();

        const labels = datos.map(item => item.label);

        chart = new Chart(ctx_Inventario, {

            type: Tipo_Grafica_Inventario.value,

            data: {

                labels,

                datasets: [
                    {
                        label: 'Cantidad',

                        data: datos.map(item =>
                            Number(item.total ?? item.cantidad ?? 0)
                        ),

                        backgroundColor: Colores.colores_2,
                        borderColor: Colores.bordes_2,

                        borderWidth: 1,

                        tension: 0.4,

                        fill: Tipo_Grafica_Inventario.value === 'line',
                    }
                ]
            },

            options: {

                responsive: true,
                maintainAspectRatio: false,

                plugins: {

                    tooltip: {

                        callbacks: {

                            label: function(context) {

                                const item = datos[context.dataIndex];

                                const total = Number(
                                    item.total ??
                                    item.cantidad ??
                                    0
                                );

                                return `Cantidad: ${total}`;
                            }
                        }
                    }
                }
            }
        });
    }

    /* ═══════════════════════ [ESCUCHADORES] ═══════════════════════ */

    Filtro_Inventario.addEventListener('change', obtenerMovimientos);

    Tipo_Grafica_Inventario.addEventListener('change', obtenerMovimientos);

    /* ═══════════════════════ [ANIO] ═══════════════════════ */

    Select_Anio_Inventario.addEventListener('change', () => {

        ResetearInputs(
            Select_Mes_Inventario,
            Select_Dia_Inventario
        );

        Select_Mes_Inventario.disabled = !Select_Anio_Inventario.value;

        Select_Dia_Inventario.disabled = true;

        Cargar_Dias_Inventario();

        ResetearInputs(
            Fecha_Inicio_Inventario,
            Fecha_Fin_Inventario
        );

        obtenerMovimientos();
    });

    /* ═══════════════════════ [MES] ═══════════════════════ */

    Select_Mes_Inventario.addEventListener('change', () => {

        ResetearInputs(Select_Dia_Inventario);

        Select_Dia_Inventario.disabled = !Select_Mes_Inventario.value;

        Cargar_Dias_Inventario();

        ResetearInputs(
            Fecha_Inicio_Inventario,
            Fecha_Fin_Inventario
        );

        obtenerMovimientos();
    });

    /* ═══════════════════════ [DIA] ═══════════════════════ */

    Select_Dia_Inventario.addEventListener('change', () => {

        ResetearInputs(
            Fecha_Inicio_Inventario,
            Fecha_Fin_Inventario
        );

        obtenerMovimientos();
    });

    /* ═════════════════════ [FECHAS] ══════════════════════ */

    Fecha_Inicio_Inventario.addEventListener('change', () => {

        ResetearInputs(
            Select_Anio_Inventario,
            Select_Mes_Inventario,
            Select_Dia_Inventario
        );

        obtenerMovimientos();
    });

    Fecha_Fin_Inventario.addEventListener('change', () => {

        ResetearInputs(
            Select_Anio_Inventario,
            Select_Mes_Inventario,
            Select_Dia_Inventario
        );

        obtenerMovimientos();
    });

    /* ═════════════════════ [LIMPIAR] ═════════════════════ */

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

    /* ═══ [INICIALIZADOR] ═══ */

    Cargar_Anios_Inventario();
    Cargar_Meses_Inventario();
    Cargar_Dias_Inventario();
    obtenerMovimientos();
    FlatPickr(Fecha_Inicio_Inventario);
    FlatPickr(Fecha_Fin_Inventario);

});