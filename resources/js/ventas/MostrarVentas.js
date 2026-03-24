$(document).ready(function () {

    $('#tablaVentas').DataTable({

        processing: true,

        ajax: { url: '/ventas/mostrar', type: 'GET', dataSrc: 'ventas' },

        columns: [ { data: 'numero_factura' },
            { data: 'cliente.nombre_cliente'},
            { data: 'usuario.nombre_usuario' },
            { data: 'fecha_venta', render: function(data){ return formatearFecha(data); } },
            { data: 'subtotal_venta' },
            { data: 'impuesto_venta' },
            { data: 'total_venta' },
            { data: 'metodo_pago.nombre_metodo_pago' },
            { data: 'estado_venta', render: function(data){ return data == 1 ? 'Activa' : 'Anulada';} }
        ],
        ...Traduccion // Constante de traduccion de datatables
    }); // Fin de datatables

});