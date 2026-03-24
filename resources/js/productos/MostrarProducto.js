$(document).ready(function () {

    // 🔎 Filtro para ocultar inactivos
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            const ocultar = $('#toggleInactivosProductos').is(':checked');
            if (!ocultar) return true;

            const estado = data[5]; // columna estado
            return estado.includes('Activo');
        }
    );

    $('#toggleInactivosProductos').on('change', function() {
        tabla.draw();
    });
    
    $('#tablaProductos').on('click', '.editarProducto', function() {
        const id = $(this).data('id'); // obtiene el id del producto
        abrirModalEditar(id);           // llama a la función que abre el modal
    });

/* ════════════════════════════════════════════════════════════════════════════════════════════ */

    function abrirModalDetalles(id){
        $.get(`/productos/${id}/editar`, function(resProducto){
            const p = resProducto.producto;

            $('#detalle_nombre_producto').text(p.nombre_producto);
            $('#detalle_descripcion_producto').text(p.descripcion_producto || '-');
            $('#detalle_fecha_producto').text(
            p.fecha_creacion_producto 
                ? formatearFecha(p.fecha_creacion_producto) 
                : '-'
        );
            $('#detalle_categoria_producto').text(p.categoria?.nombre_categoria || 'SIN CATEGORIA');
            $('#detalle_ubicacion_producto').text(p.ubicacion?.nombre_ubicacion || 'SIN UBICACION');
            $('#detalle_impuesto_producto').text(p.impuesto?.nombre_impuesto || 'SIN IMPUESTO ASIGNADO');
            $('#detalle_precio_compra').text(`C$ ${parseFloat(p.precio_compra).toFixed(2)}`);
            $('#detalle_precio_venta').text(`C$ ${parseFloat(p.precio_venta).toFixed(2)}`);
            $('#detalle_stock_producto').text(p.stock_actual);
            $('#detalle_estado_producto').text(p.estado_producto == 1 ? 'Activo' : 'Inactivo');

            // 🔥 Imagen con mensaje
            if(p.imagen_producto){
                $('#detalle_imagen_producto')
                    .attr('src', `/imagenes/productos/${p.imagen_producto}`)
                    .removeClass('d-none');

                $('#sin_imagen_texto').addClass('d-none');
            } else {
                $('#detalle_imagen_producto').addClass('d-none');
                $('#sin_imagen_texto').removeClass('d-none');
            }

            const modal = new bootstrap.Modal(document.getElementById('modalDetalleProducto'));
            modal.show();
        }).fail(function(){
            mostrarToast('Error al cargar detalles del producto', 'danger');
        });
    }

    $('#tablaProductos').on('click', '.detallesProducto', function(){
        const id = $(this).data('id');
        abrirModalDetalles(id);
    });


    // 📊 Inicializar DataTable
    const tabla = $('#tablaProductos').DataTable({
        processing: true,
        ajax: {
            url: '/productos/mostrar',
            type: 'GET',
            dataSrc: 'productos'
        },
        columns: [

            // 🖼 Imagen
            {
                data: 'imagen_producto',
                render: function(data){
                    if(data){
                        return `<img src="/imagenes/productos/${data}" width="40">`;
                    } else {
                        return `<img src="/img/noproducto.png" width="30">`;
                    }
                }
            },

            // 🧾 Nombre
            { data: 'nombre_producto' },

            // 🏷 Categoría (relación)
            { 
                data: 'categoria.nombre_categoria',
                defaultContent: 'Sin categoría'
            },

            // 💰 Precio compra
            { 
                data: 'precio_compra',
                render: function(data){
                    return `C$ ${parseFloat(data).toFixed(2)}`;
                }
            },

            // 💵 Precio venta
            { 
                data: 'precio_venta',
                render: function(data){
                    return `C$ ${parseFloat(data).toFixed(2)}`;
                }
            },

            // 🔘 Estado
            {
                data: 'estado_producto',
                render: function(data){
                    return data == 1 
                        ? '<span class="estado estado-activo">Activo</span>'
                        : '<span class="estado estado-inactivo">Inactivo</span>';
                }
            },

            // ⚙️ Acciones
            {
                data: 'id_producto',
                orderable: false,
                searchable: false,
                render: function(data, type, row){

                    let botonEstado = row.estado_producto == 1 
                        ? `<button class="btn-baja bajaProducto" data-id="${data}">Dar Baja</button>` 
                        : `<button class="btn-baja bajaProducto" data-id="${data}">Activar</button>`;
                    
                    let botonDetalles = `<button class="btn-detalles detallesProducto" data-id="${data}">Detalles</button>`;
                    
                        return `
                        <button class="btn-editar editarProducto" data-id="${data}">Editar</button>
                        ${botonEstado}
                        ${botonDetalles}
                    `;

                }
            }
        ],
        ...Traduccion // Constante de traduccion de datatables
    });

    // 🔎 Mostrar imagen en modal con mejoras
    $('#tablaProductos').on('mouseenter', 'td img', function() {
        $(this).css('cursor', 'pointer'); // cursor pointer al pasar por encima
    });

    $('#tablaProductos').on('click', 'td img', function() {
        const src = $(this).attr('src');

        // Crear modal si no existe
        let modalElement = document.getElementById("modalImagenProducto");
        if (!modalElement) {
            const modalHTML = `
            <div class="modal fade" id="modalImagenProducto" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background: transparent; border: none; position: relative;">
                        
                        <!-- Imagen -->
                        <img id="imagenModalProducto" src="" style="max-width: 100%; max-height: 100vh; display: block; margin: 0 auto; cursor: pointer;">
                    </div>
                </div>
            </div>`;
            document.body.insertAdjacentHTML("beforeend", modalHTML);
            modalElement = document.getElementById("modalImagenProducto");
        }

        const imagenModal = modalElement.querySelector("#imagenModalProducto");
        imagenModal.src = src;

        // Mostrar modal
        const modal = new bootstrap.Modal(modalElement, {
            backdrop: true,
            keyboard: true
        });
        modal.show();

        // Cerrar modal al hacer click en la imagen
        imagenModal.onclick = function() {
            modal.hide();
        };
    });

    // 📥 Abrir modal y cargar datos
    function abrirModalEditar(id) {
        // 🔹 Primero cargamos los selects desde el endpoint
        $.get('/productos/formulario?solo_activos=1', function(res){
            const data = res.data;

            // 🏷 Categorías
            const selectCat = $('#editar_id_categoria');
            selectCat.empty().append('<option value="" disabled selected>Seleccione</option>');
            data.categorias.forEach(cat => {
                selectCat.append(`<option value="${cat.id_categoria}">${cat.nombre_categoria}</option>`);
            });

            // 📍 Ubicaciones
            const selectUbic = $('#editar_id_ubicacion');
            selectUbic.empty().append('<option value="">Seleccione</option>');
            data.ubicaciones.forEach(ubi => {
                selectUbic.append(`<option value="${ubi.id_ubicacion}">${ubi.nombre_ubicacion}</option>`);
            });

            // 💰 Impuestos
            const selectImp = $('#editar_id_impuesto');
            selectImp.empty().append('<option value="" disabled selected>Seleccione</option>');
            data.impuestos.forEach(imp => {
                selectImp.append(`<option value="${imp.id_impuesto}">${imp.nombre_impuesto}</option>`);
            });

            // 🔹 Ahora obtenemos los datos del producto
            $.get(`/productos/${id}/editar`, function(resProducto){
                const producto = resProducto.producto;

                // Campos de texto
                $('#editar_id_producto').val(producto.id_producto);
                $('#editar_nombre_producto').val(producto.nombre_producto);
                $('#editar_descripcion_producto').val(producto.descripcion_producto);
                $('#editar_precio_compra').val(producto.precio_compra);
                $('#editar_precio_venta').val(producto.precio_venta);
                $('#editar_stock_actual').val(producto.stock_actual);

                // Seleccionar los valores correctos en los selects
                selectCat.val(producto.id_categoria);
                selectUbic.val(producto.id_ubicacion);
                selectImp.val(producto.id_impuesto);

                // Preview de la imagen
                if(producto.imagen_producto){
                    $('#preview_editar_imagen_producto')
                        .attr('src', `/imagenes/productos/${producto.imagen_producto}`)
                        .removeClass('d-none');
                } else {
                    $('#preview_editar_imagen_producto').addClass('d-none');
                }

                // 🔹 Mostrar modal
                const modal = new bootstrap.Modal(document.getElementById("modalEditarProducto"));
                modal.show();
            }).fail(function(){
                mostrarToast('Error al cargar los datos del producto', 'danger');
            });

        }).fail(function(){
            mostrarToast('Error al cargar datos del formulario', 'danger');
        });

    }

    // Botón Actualizar Producto
// Botón Actualizar Producto
    $('#btnActualizarProducto').click(function() {
        const id = $('#editar_id_producto').val();
        const nombre = $('#editar_nombre_producto').val().trim();
        const descripcion = $('#editar_descripcion_producto').val().trim();
        const id_categoria = $('#editar_id_categoria').val();
        const id_ubicacion = $('#editar_id_ubicacion').val();
        const id_impuesto = $('#editar_id_impuesto').val();
        const precio_compra = $('#editar_precio_compra').val();
        const precio_venta = $('#editar_precio_venta').val();
        const stock = $('#editar_stock_actual').val();
        const imagen = $('#editar_imagen_producto')[0].files[0]; // archivo seleccionado

        // Validaciones básicas
        if(nombre === ''){
            mostrarToast('El nombre del producto es obligatorio', 'danger');
            return;
        }
        /*
        if(!id_categoria || !id_ubicacion || !id_impuesto){
            mostrarToast('Seleccione categoría, ubicación e impuesto', 'danger');
            return;
        }
*/
        // FormData para enviar datos + archivo
        const formData = new FormData();
        formData.append('nombre_producto', nombre);
        formData.append('descripcion_producto', descripcion);
        formData.append('id_categoria', id_categoria);
        formData.append('id_ubicacion', id_ubicacion);
        formData.append('id_impuesto', id_impuesto);
        formData.append('precio_compra', precio_compra);
        formData.append('precio_venta', precio_venta);
        formData.append('stock_actual', stock);
        if(imagen) formData.append('imagen_producto', imagen);

        // Spoofing PUT para Laravel
        formData.append('_method', 'PUT');
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: `/productos/${id}/actualizar`,
            type: 'POST', // POST con _method=PUT
            data: formData,
            processData: false,
            contentType: false,
            success: function(res){
                mostrarToast('Producto actualizado correctamente', 'success');
                $('#tablaProductos').DataTable().ajax.reload();

                // Cerrar modal
                const modalElement = document.getElementById("modalEditarProducto");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();
            },
            error: function(err){
                console.error(err);
                if(err.status === 422){
                    const errores = err.responseJSON.errors;
                    let mensaje = '';
                    for(let campo in errores){
                        mensaje = errores[campo][0];
                        break;
                    }
                    mostrarToast(mensaje, 'danger');
                } else if(err.responseJSON && err.responseJSON.mensaje){
                    mostrarToast(err.responseJSON.mensaje, 'danger');
                } else {
                    mostrarToast('Error inesperado del servidor', 'danger');
                }
            }
        });
    });

    // Opcional: Preview de nueva imagen antes de guardar
    $('#editar_imagen_producto').on('change', function() {
        const file = this.files[0];
        if(file){
            $('#preview_editar_imagen_producto')
                .attr('src', URL.createObjectURL(file))
                .removeClass('d-none');
        }
    });

});