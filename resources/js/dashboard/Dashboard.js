$(document).ready(function () {

let chart = null;

document.getElementById('titulo').textContent = 'Panel Analítico';



const $ = id => document.getElementById(id);

/* ════════════════════════
ELEMENTOS
════════════════════════ */

const filtro        = $('filtro');
const tipoGrafica   = $('tipoGrafica');

const selectAnio    = $('selectAnio');
const selectMes     = $('selectMes');
const selectDia     = $('selectDia');

const fechaInicio   = $('fechaInicio');
const fechaFin      = $('fechaFin');

const btnLimpiar    = $('btnLimpiar');

const ctx = $('chartVentas');


/* ════════════════════════
COLORES
════════════════════════ */

const colores_1 = [
    '#6199f5',
    '#3b82f6',
    '#0ea5e9',
    '#06b6d4',
    '#2dd4bf',

    '#22c55e',
    '#10b981',
    '#84cc16',

    '#f59e0b',
    '#eab308'
];

const bordes_1 = [
    '#2563eb',
    '#1d4ed8',
    '#0284c7',
    '#0891b2',
    '#0f766e',

    '#16a34a',
    '#059669',
    '#65a30d',

    '#d97706',
    '#ca8a04'
];

const colores_2 = [
    '#fde047',
    '#f97316',
    '#ef4444',
    '#f43f5e',
    '#ec4899',

    '#fb7185',
    '#c084fc',
    '#a855f7',
    '#8b5cf6'
];

const bordes_2 = [
    '#a16207',
    '#ea580c',
    '#dc2626',
    '#e11d48',
    '#be185d',

    '#fb7185',
    '#9333ea',
    '#7c3aed',
    '#6d28d9'
];

/* ════════════════════════
MESES
════════════════════════ */

const meses = [
    'Enero', 'Febrero', 'Marzo',
    'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre',
    'Octubre', 'Noviembre', 'Diciembre'
];

/* ════════════════════════
FLATPICKR
════════════════════════ */

flatpickr(fechaInicio, {
    locale: 'es',
    dateFormat: 'Y-m-d',
    allowInput: true
});

flatpickr(fechaFin, {
    locale: 'es',
    dateFormat: 'Y-m-d',
    allowInput: true
});

/* ════════════════════════
SELECTS
════════════════════════ */

async function cargarAnios() {

    const response = await fetch('/dashboard/ventas');
    const data = await response.json();

    const anios = [
        ...new Set(
            data.grafica
                .map(item => {

                    const fecha = new Date(item.label);

                    if (isNaN(fecha)) return null; // 🚫 invalida

                    return fecha.getFullYear();
                })
                .filter(Boolean) // 🚫 elimina null / NaN
        )
    ];

    selectAnio.innerHTML = `<option value="">Año</option>`;

    anios
        .sort((a, b) => b - a)
        .forEach(anio => {
            selectAnio.innerHTML += `
                <option value="${anio}">${anio}</option>
            `;
        });

}

function cargarMeses() {

    selectMes.innerHTML = `
        <option value="">Mes</option>
    `;

    meses.forEach((mes, index) => {

        selectMes.innerHTML += `
            <option value="${index + 1}">
                ${mes}
            </option>
        `;
    });
}

function cargarDias() {

    const anio = Number(selectAnio.value);
    const mes  = Number(selectMes.value);

    selectDia.innerHTML = `
        <option value="">Día</option>
    `;

    if(!anio || !mes) return;

    const totalDias = new Date(anio, mes, 0).getDate();

    for(let i = 1; i <= totalDias; i++) {

        selectDia.innerHTML += `
            <option value="${i}">
                ${i}
            </option>
        `;
    }
}

/* ════════════════════════
RESETEAR FECHAS
════════════════════════ */

function resetearFechas() {

    fechaInicio.value = '';
    fechaFin.value = '';
}

/* ════════════════════════
OBTENER DATOS
════════════════════════ */

    async function obtenerVentas() {

        const params = new URLSearchParams({

            tipo: filtro.value,

            anio: selectAnio.value,
            mes: selectMes.value,
            dia: selectDia.value,

            inicio: fechaInicio.value,
            fin: fechaFin.value
        });

        const response = await fetch(`/dashboard/ventas?${params}`);
        const data = await response.json();

        let datos = [];

        switch(filtro.value){

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
    }

/* ════════════════════════
RENDER CHART
════════════════════════ */

    function renderGrafica(datos = []) {

        if(chart) chart.destroy();

        const labels = datos.map(item => item.label);

        const valores = datos.map(item => Number(item.total));

        chart = new Chart(ctx, {

            type: tipoGrafica.value,

            data: {

                labels,

               datasets: [
                            {
                                label: 'Ingresos (C$)',
                                data: datos.map(item => Number(item.total)),
                                backgroundColor: colores_1,
                                // borderColor: bordes,
                                borderWidth: 1,
                                tension: 0.4,
                                fill: tipoGrafica.value === 'line'
                            },
                            {
                                label: 'Ventas (cantidad)',
                                data: datos.map(item => Number(item.cantidad ?? item.ventas ?? 0)),
                                backgroundColor: colores_2,
                                borderColor: bordes_2,
                                borderWidth: 2,
                                hidden: true,
                                tension: 0.4,
                                fill: false
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

/* ════════════════════════
EVENTOS
════════════════════════ */

filtro.addEventListener('change', obtenerVentas);

tipoGrafica.addEventListener('change', obtenerVentas);

/* año */

selectAnio.addEventListener('change', () => {

    selectMes.value = '';

    selectMes.disabled = !selectAnio.value;

    cargarDias();

    resetearFechas();

    obtenerVentas();
});

/* mes */

selectMes.addEventListener('change', () => {

    selectDia.value = '';

    // 🔥 habilitar día si hay mes seleccionado
    selectDia.disabled = !selectMes.value;

    cargarDias();

    resetearFechas();

    obtenerVentas();
});

/* día */

selectDia.addEventListener('change', () => {

    resetearFechas();

    obtenerVentas();
});

/* fechas */

fechaInicio.addEventListener('change', () => {

    selectAnio.value = '';
    selectMes.value = '';
    selectDia.value = '';

    obtenerVentas();
});

fechaFin.addEventListener('change', () => {

    selectAnio.value = '';
    selectMes.value = '';
    selectDia.value = '';

    obtenerVentas();
});

/* limpiar */

btnLimpiar.addEventListener('click', () => {

    filtro.value = 'dia';

    tipoGrafica.value = 'bar';

    selectAnio.value = '';
    selectMes.value = '';
    selectDia.value = '';

    fechaInicio.value = '';
    fechaFin.value = '';

    obtenerVentas();
});

/* ════════════════════════
INIT
════════════════════════ */

cargarAnios();

cargarMeses();

cargarDias();

obtenerVentas();

});