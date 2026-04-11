$(document).ready(function () {

/*-------------------------------------------------------------------------------------------------------------------*/

    let carrito = [];
    const tablaProductos = inicializarTablaProductos();
    eventosProductos(tablaProductos);
    document.getElementById('titulo').textContent = 'SISTEMA DE FACTURACION';

/*-------------------------------------------------------------------------------------------------------------------*/

/* ═════════════ (INICIALIZAR TABLA) ═════════════*/

    function inicializarTablaProductos() {

        return $('#tablaProductos').DataTable({

            processing: true, ajax: { url: '/productos/pos', type: 'GET', dataSrc: 'data' },

            columns: [ 
                
                { data: 'nombre_producto' },
                { data: 'precio_con_iva',  render: function(data){ return moneda(data, 1); } },
                { data: 'stock_actual' },
                { data: 'id_producto', render: function(data, type, row) { // Acciones

                    let deshabilitado = row.stock_actual <= 0 ? 'disabled' : '';
                    let clase = row.stock_actual <= 0 ? 'btn-secondary' : 'btn-dark';

                        return `
                            <button class="btn btn-sm ${clase} agregarProducto"
                                data-id="${row.id_producto}"
                                data-nombre="${row.nombre_producto}"
                                data-precio="${row.precio_con_iva}" 
                                data-stock="${row.stock_actual}"
                                ${deshabilitado}>
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

/*-------------------------------------------------------------------------------------------------------------------*/

    function moneda(valor, decimales = 2) {
        return 'C$ ' + parseFloat(valor || 0).toFixed(decimales);
    }

/*-------------------------------------------------------------------------------------------------------------------*/

/* ═════════════ (EVENTO AGREGAR PRODUCTOS) ═════════════*/

    function eventosProductos(tabla) {

        $('#tablaProductos').on('click', '.agregarProducto', function(){

            const producto = {
                id: $(this).data('id'),
                nombre: $(this).data('nombre'),
                precio: parseFloat($(this).data('precio')),
                stock: parseInt($(this).data('stock'))
            };

            agregarProductoCarrito(producto);
        });
    }

/*-------------------------------------------------------------------------------------------------------------------*/

/* ═════════════ (FUNCION AGREGAR PRODUCTOS AL CARRITO) ═════════════*/

    function agregarProductoCarrito(producto) {

        let existente = carrito.find(p => p.id === producto.id);

        if (existente) { // EVITA VENDER MAS DE LO QUE EXISTE
            if (existente.cantidad >= existente.stock) { mostrarToast(`No hay más stock de ${existente.nombre}`, 'danger'); 
                return; }

            existente.cantidad++; } 

            else { carrito.push({ ...producto, cantidad: 1 }); }

        renderCarrito();

    }

/*-------------------------------------------------------------------------------------------------------------------*/

/* ═════════════ (RENDERIZAR TABLA DEL CARRITO) ═════════════ */

    function renderCarrito() {

        let TABLACARRITO = ''; let total = 0;

        carrito.forEach((p, i) => {

            let subtotal = p.precio * p.cantidad; total += subtotal;

            TABLACARRITO += `
                <tr>
                    <td>${p.nombre}</td>
                    <td class="col-md-1">
                        <input type="number" value="${p.cantidad}" min="1"
                            class="form-control form-control-sm cantidad"
                            data-index="${i}">
                    </td>
                    <td>C$ ${p.precio.toFixed(2)}</td>
                    <td>C$ ${subtotal.toFixed(2)}</td>
                    <td>
                        <button class="btn btn-sm btn-danger eliminar" data-index="${i}">
                            X
                        </button>
                    </td>
                </tr>
            `;
        });

        $('#carrito').html(TABLACARRITO);
        $('#total').text('C$ ' + total.toFixed(2));
        calcularVueltos();
    }

/*-------------------------------------------------------------------------------------------------------------------*/

    /* ═══════ EVENTO: ELIMINAR PRODUCTO DEL CARRITO ═══════ */

    $('#carrito').on('click', '.eliminar', function(){
        const i = $(this).data('index'); carrito.splice(i, 1); renderCarrito();
    }); // Elimina el producto seleccionado del carrito actual

    /* ═══════ EVENTO: CAMBIAR CANTIDAD DEL PRODUCTO ═══════ */

    $('#carrito').on('input', '.cantidad', function(){
        const i = $(this).data('index'); carrito[i].cantidad = parseInt($(this).val()); renderCarrito();
    }); // Actualiza la cantidad del producto y recalcula totales

/*-------------------------------------------------------------------------------------------------------------------*/

    /* ═══════ VALIDAR Y FACTURAR DEL CARRITO ═══════ */

    $('#btnFacturar').click(async function () {

        $('#btnFacturar').prop('disabled', true); // Evita Doble Click

        let cliente = $('#clientes').val();
        let total = parseFloat($('#total').text().replace(/[^\d.-]/g, '')) || 0;
        let recibido = parseFloat($('#pagoCordobas').val()) || 0;

        // VALIDAR ANTES DE FACTURAR
        if (!validarFactura(cliente, total, recibido)) { $('#btnFacturar').prop('disabled', false); return; }

        let stockOk = await validarStockBD();
        if (!stockOk) { $('#btnFacturar').prop('disabled', false); return; }

        let data = { cliente: cliente, carrito: carrito, total: total, recibido: recibido };

        $.ajax({

            url: '/facturar/pos', method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function(res) {

                if(res.success){ mostrarToast('Factura realizada', 'success');

                    carrito = [];
                    renderCarrito();

                    $('#pagoCordobas').val('');
                    $('#pagoDolares').val('');
                    $('#vueltoCordobas').val('');
                    $('#vueltoDolares').val('');

                    tablaProductos.ajax.reload(null, false); // RECARGA TABLA AL FACTURAR
                }

                $('#btnFacturar').prop('disabled', false); // HABILITA BTN FACTURAR
            }, 
            error: function() {
                mostrarToast('Error al facturar', 'danger'); $('#btnFacturar').prop('disabled', false);
            }
        });
    });

/*-------------------------------------------------------------------------------------------------------------------*/

    /* ═══════ VALIDACIÓN: DATOS DE FACTURA ═══════ */

    function validarFactura(cliente, total, recibido){

        if (carrito.length === 0) { mostrarToast('Agregue productos', 'danger'); return false; }
        if (!cliente) { mostrarToast('Seleccione cliente', 'danger'); return false; }
        if (recibido < total) { mostrarToast('Pago insuficiente', 'danger'); return false; }

        for (let p of carrito) {
            if (p.cantidad > p.stock) { mostrarToast(`Stock insuficiente para ${p.nombre}`, 'danger'); return false; }
        }

        return true;
    }

/*-------------------------------------------------------------------------------------------------------------------*/

    async function validarStockBD() {

        let res = await fetch('/validar-stock-carrito', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ carrito })
        });

        let data = await res.json();

        if (!data.ok) {
            mostrarToast(data.mensaje, 'danger');

            let p = carrito.find(x => x.id == data.id);
            if (p) p.stock = data.stock;

            return false;
        }

        return true;
    }

});