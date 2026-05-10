$(document).ready(function () {

    let chart = null;
    document.getElementById('titulo').textContent = 'Panel Analítico';
    const $ = id => document.getElementById(id);

    /* ══════════════════ [ELEMENTOS] ═══════════════════ */

    const Filtro_Ventas        = $('Filtro-Ventas');
    const Tipo_Grafica_Ventas   = $('Tipo-Grafica-Ventas');
    const Select_Anio_Ventas    = $('Select-Anio-Ventas');
    const Select_Mes_Ventas     = $('Select-Mes-Ventas');
    const Select_Dia_Ventas     = $('Select-Dia-Ventas');
    const Fecha_Inicio_Ventas   = $('Fecha-Inicio-Ventas');
    const Fecha_Fin_Ventas      = $('Fecha-Fin-Ventas');
    const BTN_Limpiar_Ventas    = $('BTN-Limpiar-Ventas');
    const ctx_Ventas = $('chartVentas');

    /* ══════════════════ [SELECTORES] ══════════════════ */

    async function Cargar_Anios_Ventas() {

        const response = await fetch('/dashboard/ventas');
        const data = await response.json();

        const anios = [ 
            ...new Set(
                data.
                    grafica.map(item => {
                        const fecha = new Date(item.label);
                        if (isNaN(fecha)) return null; 
                        return fecha.getFullYear();
                    }) .filter(Boolean)
            )
        ];

        Select_Anio_Ventas.innerHTML = `<option value="">Año</option>`;

        anios .sort((a, b) => b - a)
            .forEach(anio => {
                Select_Anio_Ventas.innerHTML += ` <option value="${anio}">${anio}</option> `;
            });
    } // FIN DE FUNCION CARGAR

    function Cargar_Meses_Ventas() {
        Select_Mes_Ventas.innerHTML = ` <option value="">Mes</option> `;
        Meses.forEach((mes, index) => {
            Select_Mes_Ventas.innerHTML += ` <option value="${index + 1}"> ${mes} </option> `;
        });
    } // FIN DE FUNCION CARGAR

    function Cargar_Dias_Ventas() {

        const anio = Number(Select_Anio_Ventas.value);
        const mes  = Number(Select_Mes_Ventas.value);

        Select_Dia_Ventas.innerHTML = ` <option value="">Día</option> `;
        if(!anio || !mes) return;
        const totalDias = new Date(anio, mes, 0).getDate();

        for(let i = 1; i <= totalDias; i++) {
            Select_Dia_Ventas.innerHTML += ` <option value="${i}"> ${i} </option> `;
        }
    } // FIN DE FUNCION CARGAR

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

        switch(Filtro_Ventas.value){

            case 'clientes': datos = data.clientes; break;
            case 'usuarios': datos = data.usuarios; break;
            case 'metodos_pago': datos = data.metodos_pago; break;
            case 'estado': datos = data.estado; break;
            case 'dias_fuertes': datos = data.dias_fuertes; break;
            default: datos = data.grafica; break;

        }

        renderGrafica(datos);

    } // FIN DE FUNCION OBTENER

    /* ═════════════════ [RENDERIZADO] ═════════════════ */

    function renderGrafica(datos = []) {

        if(chart) chart.destroy();

        const labels = datos.map(item => item.label);

        chart = new Chart(ctx_Ventas, {

            type: Tipo_Grafica_Ventas.value,

            data: {

                labels,

               datasets: [
                            {
                                label: 'Ingresos (C$)',
                                data: datos.map(item => Number(item.total)),
                                backgroundColor: Colores.colores_2,
                                // borderColor: Colores.bordes_2,
                                borderWidth: 1,
                                tension: 0.4,
                                fill: Tipo_Grafica_Ventas.value === 'line',
                                yAxisID: 'y',
                            },
                            {
                                label: 'Ventas (cantidad)',
                                data: datos.map(item => Number(item.cantidad ?? item.ventas ?? 0)),
                                backgroundColor: Colores.colores_1,
                                // borderColor: Colores.bordes_1,
                                borderWidth: 2,
                                hidden: true,
                                tension: 0.4,
                                fill: false,
                                yAxisID: 'y1',
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

                                const total = Number(item.total ?? 0);
                                const cantidad = Number(item.cantidad ?? item.ventas ?? 0);

                                return [
                                    ` Saldo: C$ ${total.toFixed(2)}`,
                                    `Ventas: ${cantidad}`
                                ];
                            }
                        }
                    }
                }
            }
        });
    }

    /* ═══════════════════════ [ESCUCHADORES] ═══════════════════════ */
    Filtro_Ventas.addEventListener('change', obtenerVentas);
    Tipo_Grafica_Ventas.addEventListener('change', obtenerVentas);

    /* ═══════════════════════ [ANIO] ═══════════════════════ */
    Select_Anio_Ventas.addEventListener('change', () => {
        ResetearInputs(Select_Mes_Ventas);
        Select_Mes_Ventas.disabled = !Select_Anio_Ventas.value;
        Cargar_Dias_Ventas();
        ResetearInputs(Fecha_Inicio_Ventas, Fecha_Fin_Ventas)
        obtenerVentas();
    });

    /* ═══════════════════════ [MES] ═══════════════════════ */
    Select_Mes_Ventas.addEventListener('change', () => {
        ResetearInputs(Select_Dia_Ventas);
        Select_Dia_Ventas.disabled = !Select_Mes_Ventas.value;
        Cargar_Dias_Ventas();
        ResetearInputs(Fecha_Inicio_Ventas, Fecha_Fin_Ventas)
        obtenerVentas();
    });

    /* ═══════════════════════ [DIA] ═══════════════════════ */
    Select_Dia_Ventas.addEventListener('change', () => {
        ResetearInputs(Fecha_Inicio_Ventas, Fecha_Fin_Ventas)
        obtenerVentas();
    });

    /* ═════════════════════ [FECHAS] ══════════════════════ */
    Fecha_Inicio_Ventas.addEventListener('change', () => {
        ResetearInputs(Select_Anio_Ventas, Select_Mes_Ventas, Select_Dia_Ventas)
        obtenerVentas();
    });

    Fecha_Fin_Ventas.addEventListener('change', () => {
        ResetearInputs(Select_Anio_Ventas, Select_Mes_Ventas, Select_Dia_Ventas)
        obtenerVentas();
    });

    /* ═════════════════════ [LIMPIAR] ═════════════════════ */
    BTN_Limpiar_Ventas.addEventListener('click', () => {
        Filtro_Ventas.value = 'dia';
        Tipo_Grafica_Ventas.value = 'bar';
        ResetearInputs(Select_Anio_Ventas, Select_Mes_Ventas, Select_Dia_Ventas, Fecha_Inicio_Ventas, Fecha_Fin_Ventas);
        obtenerVentas();
    });

    /* ═══ [INICIALIZADOR] ═══ */
    
    Cargar_Anios_Ventas();
    Cargar_Meses_Ventas();
    Cargar_Dias_Ventas();
    obtenerVentas();
    FlatPickr(Fecha_Inicio_Ventas);
    FlatPickr(Fecha_Fin_Ventas );
    Chart.register(PluginSinDatos); // Aplica para todos los archivos de graficas

});