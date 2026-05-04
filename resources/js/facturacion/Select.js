$(document).ready(function () {

    $.get('/clientes/pos', function (res) {

        if (!res.success) return;

        let select = $('#clientes');
        select.empty();

        let idSeleccionado = null;

        res.data.forEach(cliente => {

            if (cliente.id_cliente == 1 || cliente.nombre_cliente === 'Cliente Generico') {
                idSeleccionado = cliente.id_cliente;
            }

            select.append(
                `<option value="${cliente.id_cliente}">
                    ${cliente.nombre_cliente}
                </option>`
            );
        });

        // 🔥 asegurar select2 existe antes de usarlo
        if ($.fn.select2) {
            select.select2();
        }

        if (idSeleccionado) {
            select.val(idSeleccionado).trigger('change');
        }
    });


    $.get('/metodo-pago/pos', function (res) {

        if (!res.success) return;

        let select = $('#metodo_pago');
        select.empty();

        res.data.forEach(metodo => {
            select.append(
                `<option value="${metodo.id_metodo_pago}">
                    ${metodo.nombre_metodo_pago}
                </option>`
            );
        });

        if ($.fn.select2) {
            select.select2();
        }
    });

});