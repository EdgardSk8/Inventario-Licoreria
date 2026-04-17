function formatearFechaDia(fechaSQL) {

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

    return `${diaSemana} ${dia} ${mes} ${año}`;
}

// Versión simple: Día/Mes/Año
// Formato: DD/MM/YYYY HH:MM AM/PM
function formatearFecha(fechaSQL) {
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

function formatearFechaDiaHora(fechaSQL) {

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

    // Formato 24h con cero adelante
    horas = horas < 10 ? '0' + horas : horas;
    minutos = minutos < 10 ? '0' + minutos : minutos;

    return `${dia} de ${mes} del ${año} ${horas}:${minutos}`;
}
