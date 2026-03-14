function formatearFecha(fechaSQL) {

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

    let horas = fecha.getHours();
    const minutos = fecha.getMinutes().toString().padStart(2,'0');

    const ampm = horas >= 12 ? 'PM' : 'AM';

    horas = horas % 12;
    horas = horas ? horas : 12;

    const horasFormateadas = horas.toString().padStart(2,'0');

    return `${diaSemana}, ${dia} de ${mes} del ${año}, ${horasFormateadas}:${minutos} ${ampm}`;
}
