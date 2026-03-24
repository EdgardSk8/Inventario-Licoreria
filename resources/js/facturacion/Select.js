$(document).ready(function() {

/*  ╔════════ Selector Clientes ════════╗ 
    ╚═══════════════════════════════════╝ */

    $.get('/clientes/pos', function(res) {

        if(res.success) {

            let select = $('select#clientes'); 
            select.empty();
            let idSeleccionado = null;

            res.data.forEach(cliente => {

                if(cliente.id_cliente == 1) {idSeleccionado = cliente.id_cliente; }// ══════ Por ID ══════ //
                if(cliente.nombre_cliente === 'Cliente Generico') {idSeleccionado = cliente.id_cliente; }// ══════ Por nombre ══════ //
                select.append(`<option value="${cliente.id_cliente}"> ${cliente.nombre_cliente} </option>`);
            });

            $('#clientes').select2(); // ══════ Inicializar select2 ══════ //
            if(idSeleccionado){ select.val(idSeleccionado).trigger('change'); } // ═══ Seleccionar por defecto ═══ //

        }

    });

/*  ╔════════ Selector Metodo de Pago ════════╗ 
    ╚═════════════════════════════════════════╝ */

    $.get('/metodo-pago/pos', function(res) {
        
        if(res.success) {

            let select = $('#metodo_pago'); 
            select.empty();
            res.data.forEach(metodo_pago => {
                select.append(`<option value="${metodo_pago.id_metodo_pago}">${metodo_pago.nombre_metodo_pago} </option>`);
            }); 

            $('#metodo_pago').select2();

        }
    });


}); // Fin de Funcion










