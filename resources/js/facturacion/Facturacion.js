$(document).ready(function () {

    let carrito = [];
    const tablaProductos = inicializarTablaProductos();
    eventosProductos(tablaProductos);

    /* ╔════════════ FUNCIONES ════════════╗ */
    /* ╚═══════════════════════════════════╝ */

/* ═════════════ INICIALIZAR TABLA ═════════════*/

    function inicializarTablaProductos() {

        return $('#tablaProductos').DataTable({

            processing: true, ajax: { url: '/productos/pos', type: 'GET', dataSrc: 'data' },

            columns: [ 
                
                { data: 'nombre_producto' },

                { data: 'precio_venta', render: function(data){ return 'C$ ' + parseFloat(data).toFixed(1); } }, // Muestra un decimal

                { data: 'stock_actual' },

                { data: 'id_producto', render: function(data, type, row) { // Acciones

                        return `
                            <button class="btn btn-sm btn-dark agregarProducto"
                                data-id="${row.id_producto}"
                                data-nombre="${row.nombre_producto}"
                                data-precio="${row.precio_venta}">
                                <i class="bi bi-cart-plus"></i>
                                Agregar
                            </button>
                            
                        `;
                    }
                },
            ],
            
            ...Traduccion // Constante de traduccion de datatables

        });
    }

/* ═════════════ () ═════════════*/

    function eventosProductos(tabla) {

        $('#tablaProductos').on('click', '.agregarProducto', function(){

            const producto = {
                id: $(this).data('id'),
                nombre: $(this).data('nombre'),
                precio: parseFloat($(this).data('precio'))
            };

            agregarProductoCarrito(producto);
        });
    }

/* ═════════════ () ═════════════*/

    function agregarProductoCarrito(producto) {

        let existente = carrito.find(p => p.id === producto.id);

        if (existente) {
            existente.cantidad++;
        } else {
            carrito.push({
                ...producto,
                cantidad: 1
            });
        }

        renderCarrito();
    }

/* ═════════════ () ═════════════*/

    function renderCarrito() {

        let html = '';
        let total = 0;

        carrito.forEach((p, i) => {

            let subtotal = p.precio * p.cantidad;
            total += subtotal;

            html += `
                <tr>
                    <td>${p.nombre}</td>
                    <td class="col-md-1">
                        <input type="number" value="${p.cantidad}" min="1"
                            class="form-control form-control-sm cantidad"
                            data-index="${i}">
                    </td>
                    <td>${p.precio.toFixed(2)}</td>
                    <td>${subtotal.toFixed(2)}</td>
                    <td>
                        <button class="btn btn-sm btn-danger eliminar" data-index="${i}">
                            X
                        </button>
                    </td>
                </tr>
            `;
        });

        $('#carrito').html(html);
        $('#total').text('C$ ' + total.toFixed(2));
        calcularVueltos();
    }




    /* ╔════════════ EVENTOS CARRITO ════════════╗ */
    /* ╚═════════════════════════════════════════╝ */

    // ❌ ELIMINAR
    $('#carrito').on('click', '.eliminar', function(){
        const i = $(this).data('index');
        carrito.splice(i, 1);
        renderCarrito();
    });

    // 🔄 CAMBIAR CANTIDAD
    $('#carrito').on('input', '.cantidad', function(){
        const i = $(this).data('index');
        carrito[i].cantidad = parseInt($(this).val());
        renderCarrito();
    });


$('#btnFacturar').click(function () {

    if (carrito.length === 0) {
        mostrarToast('Agregue productos', 'danger');
        return;
    }

    let cliente = $('#clientes').val();
    if (!cliente) {
        mostrarToast('Seleccione cliente', 'danger');
        return;
    }

    let total = parseFloat($('#total').text().replace(/[^\d.-]/g, '')) || 0;
    let recibido = parseFloat($('#pagoCordobas').val()) || 0;

    if (recibido < total) {
        mostrarToast('Pago insuficiente', 'danger');
        return;
    }

    let data = {
        cliente: cliente,
        carrito: carrito,
        total: total,
        recibido: recibido
    };

    $.ajax({
        url: '/facturar/pos',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(res) {

            if(res.success){
                mostrarToast('Factura realizada', 'success');

                carrito = [];
                renderCarrito();
                $('#pagoCordobas').val('');
                $('#pagoDolares').val('');
                $('#vueltoCordobas').val('');
                $('#vueltoDolares').val('');
            }
        },
        error: function() {
            mostrarToast('Error al facturar', 'danger');
        }
    });

});













});