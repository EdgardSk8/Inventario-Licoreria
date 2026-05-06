


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

$(document).on('click', '.btn', function (e) {

    const btn = $(e.currentTarget);
    if (btn.prop('disabled')) { e.preventDefault(); e.stopImmediatePropagation(); return false; }
    btn.prop('disabled', true);
    setTimeout(() => { btn.prop('disabled', false); }, 500);
    console.log("Funcion anti doble click aplicada");

});

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
        "mayo","junio","julio","agosto",
        "septiembre","octubre","noviembre","diciembre"
    ];

    const diaSemana = dias[fecha.getDay()];
    const dia = fecha.getDate();
    const mes = meses[fecha.getMonth()];
    const año = fecha.getFullYear();

    return `${diaSemana} ${dia} de ${mes} ${año}`;
}

// Versión simple: Día/Mes/Año
// Formato: DD/MM/YYYY HH:MM AM/PM
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








