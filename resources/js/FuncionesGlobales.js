


window.BloqueoBTN = function (handler, tiempo = 1000) {
    
    return function (e) {

        console.log("Funcion de bloqueo por doble Click aplicado \n (/js/FuncionesGlobales.js)");

        const btn = $(this);
        if (btn.prop('disabled')) return;
        btn.prop('disabled', true);

        setTimeout(() => { btn.prop('disabled', false); }, tiempo);

        handler.call(this, e);
    };
}

window.formatearCedula = function(inputId) {
    
    const cedula = document.getElementById(inputId);
    if (!cedula) return;

    cedula.addEventListener("input", function () {
        let valor = this.value.replace(/[^0-9a-zA-Z]/g, "");

        let numeros = valor.slice(0, 13).replace(/[^0-9]/g, "");
        let letra = valor.slice(13, 14).replace(/[^a-zA-Z]/g, "").toUpperCase();

        valor = numeros + letra;

        if (valor.length > 3) valor = valor.slice(0, 3) + "-" + valor.slice(3);
        if (valor.length > 10) valor = valor.slice(0, 10) + "-" + valor.slice(10);

        this.value = valor;
    });
}

$(document).on('click', '.btn', function (e) {

    const btn = $(e.currentTarget);
    if (btn.prop('disabled')) { e.preventDefault(); e.stopImmediatePropagation(); return false; }
    btn.prop('disabled', true);
    setTimeout(() => { btn.prop('disabled', false); }, 500);
    console.log("Funcion anti doble click aplicada");

});

window.moneda = function(valor, decimales = 2) {
    return 'C$ ' + parseFloat(valor || 0).toLocaleString('es-NI', {
        minimumFractionDigits: decimales,
        maximumFractionDigits: decimales
    });
}

// MOSTRAR TOAST
window.mostrarToast = function (mensaje, tipo = "success") {
    const toastElemento = document.getElementById("toastMensaje");
    const toastTexto = document.getElementById("toastTexto");

    toastElemento.className = `toast text-bg-${tipo} border-0`;
    toastTexto.textContent = mensaje;

    const toast = new bootstrap.Toast(toastElemento, { delay: 5000 });
    toast.show();
}

window.Traduccion = {
    language: {
        search: "Buscar:",
        lengthMenu: "Mostrar _MENU_ registros",
        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        infoEmpty: "Mostrando 0 a 0 de 0 registros",
        infoFiltered: "(filtrado de _MAX_ registros totales)",
        zeroRecords: "No se encontraron resultados",
        emptyTable: "No hay datos disponibles",
        paginate: {
            first: "Primero",
            previous: "Anterior",
            next: "Siguiente",
            last: "Último"
        }
    }
};

$.extend(true, $.fn.dataTable.defaults, {
    scrollY: true,
    paging: true,
    responsive: true,
    processing: true,
    lengthMenu: [50, 60, 70, 80, 90, 100, 500, 1000], pageLength: 50,
    ...Traduccion,
    dom: '<"top"lf>rt<"bottom"ip><"clear">',
});

window.validarRUC = function(ruc) {

    if (!ruc || ruc.trim() === '') { return true; }

    ruc = ruc.trim().toUpperCase();

    const regex = /^[A-Z][0-9]{13}$/;

    if (!regex.test(ruc)) {

        mostrarToast(
            'El RUC debe tener una letra inicial y 13 números',
            'danger'
        );

        return false;
    }

    return true;
}

window.validarInputRUC = function(input) {

    let valor = $(input).val().toUpperCase();
    valor = valor.replace(/[^A-Z0-9]/g, '');
    let resultado = '';

    if (/^[A-Z]/.test(valor)) {

        resultado += valor.charAt(0);
        let resto = valor.slice(1).replace(/[^0-9]/g, '');
        resultado += resto.slice(0, 13);
    }

    $(input).val(resultado);
}

window.validarTelefono = function (telefono, obligatorio = false) {

    telefono = (telefono || '').trim();

    /* VALIDAR VACIO */

    if (telefono === '') {

        if (obligatorio) {

            mostrarToast('El teléfono es obligatorio', 'danger');
            return false;
        }

        return true;
    }

    /* SOLO CARACTERES VALIDOS */

    if (!/^[0-9+()]+$/.test(telefono)) {

        mostrarToast('El teléfono solo puede contener números y los símbolos + ( )', 'danger');
        return false;
    }

    /* SOLO UN + */

    if ((telefono.match(/\+/g) || []).length > 1) {

        mostrarToast('El signo + solo puede aparecer una vez', 'danger');
        return false;
    }

    /* + SOLO AL INICIO */

    if (telefono.includes('+') && !telefono.startsWith('+')) {

        mostrarToast('El signo + solo puede ir al inicio', 'danger');
        return false;
    }

    /* SOLO UN ( */

    if ((telefono.match(/\(/g) || []).length > 1) {

        mostrarToast('Solo se permite un paréntesis de apertura', 'danger');
        return false;
    }

    /* SOLO UN ) */

    if ((telefono.match(/\)/g) || []).length > 1) {

        mostrarToast('Solo se permite un paréntesis de cierre', 'danger');
        return false;
    }

    const tieneApertura = telefono.includes('(');
    const tieneCierre = telefono.includes(')');

    /* PARENTESIS INCOMPLETOS */

    if (tieneApertura !== tieneCierre) {

        mostrarToast('Los paréntesis deben abrirse y cerrarse correctamente', 'danger');
        return false;
    }

    /* ORDEN INCORRECTO */

    if (tieneCierre && telefono.indexOf(')') < telefono.indexOf('(')) {

        mostrarToast('Los paréntesis están en orden incorrecto', 'danger');
        return false;
    }

    return true;
};

/* -------------------------------------------------------------------------------- */


window.formatearFechaDia = function(fechaSQL) {

    if (!fechaSQL) return '';

    const fecha = new Date(fechaSQL);

    const dias = [
        "Domingo","Lunes","Martes","Miércoles",
        "Jueves","Viernes","Sábado"
    ];

    const meses = [
        "enero","febrero","marzo","abril",
        "Mayo","junio","julio","agosto",
        "septiembre","octubre","noviembre","diciembre"
    ];

    const diaSemana = dias[fecha.getDay()];
    const dia = fecha.getDate();
    const mes = meses[fecha.getMonth()];
    const año = fecha.getFullYear();

    return `${diaSemana} ${dia} de ${mes} ${año}`;
}

window.formatearFecha = function(fechaSQL) { 
    if (!fechaSQL) return '';

    const fecha = new Date(fechaSQL);
    
    const dia = fecha.getDate().toString().padStart(2, '0');
    const mes = (fecha.getMonth() + 1).toString().padStart(2, '0'); // 1-12
    const año = fecha.getFullYear();

    let horas = fecha.getHours();
    const minutos = fecha.getMinutes().toString().padStart(2, '0');
    const ampm = horas >= 12 ? 'PM' : 'AM';

    horas = horas % 12;
    horas = horas ? horas : 12; // Convertir 0 a 12
    const horasFormateadas = horas.toString().padStart(2, '0');

    return `${dia}/${mes}/${año} ${horasFormateadas}:${minutos} ${ampm}`;
}

window.formatearFechaDiaHora = function(fechaSQL) { 

    if (!fechaSQL) return '';

    const fecha = new Date(fechaSQL);

    const meses = [
        "enero","febrero","marzo","abril",
        "mayo","junio","julio","agosto",
        "septiembre","octubre","noviembre","diciembre"
    ];

    const dia = fecha.getDate();
    const mes = meses[fecha.getMonth()];
    const año = fecha.getFullYear();

    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();

    // 🔥 AM / PM
    const periodo = horas >= 12 ? 'PM' : 'AM';

    // 🔥 convertir a 12 horas
    horas = horas % 12;
    horas = horas ? horas : 12; // si es 0 → 12

    minutos = minutos < 10 ? '0' + minutos : minutos;
    horas = horas < 10 ? '0' + horas : horas;

    return `${dia} de ${mes} del ${año} ${horas}:${minutos} ${periodo}`;
}

window.FechaSimple = function(fechaSQL) {

    if (!fechaSQL) return '';

    const fecha = new Date(fechaSQL);

    const meses = [
        "enero","febrero","marzo","abril",
        "mayo","junio","julio","agosto",
        "septiembre","octubre","noviembre","diciembre"
    ];

    const dia = fecha.getDate();
    const mes = meses[fecha.getMonth()];
    const año = fecha.getFullYear();

    // 🔥 Primera letra en mayúscula
    const mesCapitalizado = mes.charAt(0).toUpperCase() + mes.slice(1);

    return `${dia} de ${mesCapitalizado} del ${año}`;
}

/* -------------------------------------------------------------------------------- */

window.EjeXDashboard = function(fechaSQL) {

    if (!fechaSQL) return '';

    const valor = String(fechaSQL).trim();

    // FORMATO: YYYY-MM
    if (/^\d{4}-\d{2}$/.test(valor)) {

        const [anio, mes] = valor.split('-');

        return `${mes}/${anio}`;
    }

    /* ════════════════
    FORMATO: HH:00
    Resultado: 08:00 AM
    ════════════════ */
    if (/^\d{2}:\d{2}$/.test(valor)) {

        let [horas, minutos] = valor.split(':');

        horas = Number(horas);

        const periodo = horas >= 12 ? 'PM' : 'AM';

        horas = horas % 12;
        horas = horas ? horas : 12;

        horas = horas < 10 ? '0' + horas : horas;

        return `${horas}:${minutos} ${periodo}`;
    }

    // FORMATO: YYYY-MM-DD
    if (/^\d{4}-\d{2}-\d{2}$/.test(valor)) {

        const fecha = new Date(valor + 'T00:00:00');

        return fecha.toLocaleDateString('es-NI', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }

    return valor;
}

window.formatearFechaDashboard = function(fechaSQL) {

    if (!fechaSQL) return '';

    const valor = String(fechaSQL).trim();

    const meses = [
        "Enero","Febrero","Marzo","Abril",
        "Mayo","Junio","Julio","Agosto",
        "Septiembre","Octubre","Noviembre","Diciembre"
    ];

    /* ════════════════
       FORMATO: YYYY
       Resultado: 2026
    ════════════════ */
    if (/^\d{4}$/.test(valor)) {

        return valor;
    }

    /* ════════════════
       FORMATO: YYYY-MM
       Resultado: Mayo del 2026
    ════════════════ */
    if (/^\d{4}-\d{2}$/.test(valor)) {

        const [anio, mes] = valor.split('-');

        return `${meses[Number(mes) - 1]} del ${anio}`;
    }

    if (/^\d{2}:\d{2}$/.test(valor)) {

        let [horas, minutos] = valor.split(':');

        horas = Number(horas);

        const periodo = horas >= 12 ? 'PM' : 'AM';

        horas = horas % 12;
        horas = horas ? horas : 12;

        horas = horas < 10 ? '0' + horas : horas;

        return `${horas}:${minutos} ${periodo}`;
    }

    /* ════════════════
       FORMATO: YYYY-MM-DD
       Resultado: 22 de mayo del 2026
    ════════════════ */
    if (/^\d{4}-\d{2}-\d{2}$/.test(valor)) {

        const fecha = new Date(valor + 'T00:00:00');

        const dia = fecha.getDate();
        const mes = meses[fecha.getMonth()];
        const anio = fecha.getFullYear();

        return `${dia} de ${mes} del ${anio}`;
    }

    /* ════════════════
       FORMATO DATETIME
       Resultado:
       22 de mayo del 2026 08:30 PM
    ════════════════ */
    const fecha = new Date(valor);

    if (isNaN(fecha)) return valor;

    const dia = fecha.getDate();
    const mes = meses[fecha.getMonth()];
    const anio = fecha.getFullYear();

    let horas = fecha.getHours();
    let minutos = fecha.getMinutes();

    const periodo = horas >= 12 ? 'PM' : 'AM';

    horas = horas % 12;
    horas = horas ? horas : 12;

    minutos = minutos < 10 ? '0' + minutos : minutos;
    horas = horas < 10 ? '0' + horas : horas;

    return `${dia} de ${mes} del ${anio} ${horas}:${minutos} ${periodo}`;
}

/* -------------------------------------------------------------------------------- */


window.ConfigurarFiltrosDataTable = function(tabla, config = {}) {

    let columnasSelect = config.columnasSelect || [];

    let columnasIgnorar = config.columnasIgnorar || [];

    tabla.api().columns().every(function () {

        let column = this;

        let index = column.index();

        let footer = $(column.footer());

        footer.empty();

        // Ignorar columnas
        if(columnasIgnorar.includes(index)){
            return;
        }

        // =========================
        // SELECT
        // =========================

        if(columnasSelect.includes(index)){

            let select = $(`
                <select class="form-select form-select-sm filtro-columna">
                    <option value="">Todos</option>
                </select>
            `)
            .appendTo(footer)
            .on('change', function () {

                let val = $.fn.dataTable.util.escapeRegex($(this).val());

                column
                    .search(val ? '^' + val + '$' : '', true, false)
                    .draw();

            });

            let valores = [];

            column.data().each(function (d) {

                // Limpiar HTML
                d = $('<div>').html(d).text().trim();

                if(d && !valores.includes(d)){
                    valores.push(d);
                }

            });

            valores.sort();

            valores.forEach(function (d) {

                select.append(
                    `<option value="${d}">${d}</option>`
                );

            });

        }

        // =========================
        // INPUT
        // =========================

        else{

            $(`
                <input 
                    type="text" 
                    class="form-control form-control-sm filtro-columna" 
                    placeholder="Buscar"
                >
            `)
            .appendTo(footer)
            .on('keyup change clear', function () {

                if(column.search() !== this.value){

                    column
                        .search(this.value)
                        .draw();

                }

            });

        }

    });

};


/* -------------------------------------------------------------------------------- */


/* FUNCION UTILITARIA*/
window.FlatPickr = function (elemento) {

    return flatpickr(elemento, {
        locale: 'es',
        dateFormat: 'Y-m-d',
        allowInput: true
    });
};

/* -------------------------------------------------------------------------------- */

window.ResetearInputs = function (...elementos) {

    elementos.forEach(elemento => {

        if (elemento) {

            elemento.value = '';

        }
    });
};

window.Colores = {

    colores_1: ['#6199f5','#3b82f6','#0ea5e9','#06b6d4','#2dd4bf','#22c55e','#10b981','#84cc16','#f59e0b','#eab308'],
    bordes_1: ['#2563eb','#1d4ed8','#0284c7','#0891b2','#0f766e','#16a34a','#059669','#65a30d','#d97706','#ca8a04'],
    colores_2: ['#fde047','#f97316','#ef4444','#f43f5e','#ec4899','#fb7185','#c084fc','#a855f7','#8b5cf6'],
    bordes_2: ['#a16207','#ea580c','#dc2626','#e11d48','#be185d','#fb7185','#9333ea','#7c3aed','#6d28d9']

};

window.Meses = [
    'Enero', 'Febrero', 'Marzo',
    'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre',
    'Octubre', 'Noviembre', 'Diciembre'
];

window.PluginSinDatos = {

    id: 'PluginSinDatos',

    afterDraw(chart) {

        const datos = chart.data.datasets;

        const tieneDatos = datos.some(dataset =>
            dataset.data.some(valor => Number(valor) > 0)
        );

        if (tieneDatos) return;

        const { ctx, width, height } = chart;

        ctx.save();

        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';

        ctx.font = '16px Arial';

        ctx.fillStyle = '#999';

        ctx.fillText(
            'Sin registros',
            width / 2,
            height / 2
        );

        ctx.restore();
    }
};

/* -------------------------------------------------------------------------------- */

