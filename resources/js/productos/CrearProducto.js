$(document).ready(function () {

    // 🚀 Cargar selects (categoría, ubicación, impuesto)
    function cargarSelects() {
        $.get('/productos/formulario?solo_activos=1', function(res){

            const data = res.data;

            // 🏷 Categorías
            $('#crear_id_categoria').empty().append('<option value="">Seleccione</option>');
            data.categorias.forEach(cat => {
                $('#crear_id_categoria').append(
                    `<option value="${cat.id_categoria}">${cat.nombre_categoria}</option>`
                );
            });

            // 📍 Ubicaciones
            $('#crear_id_ubicacion').empty().append('<option value="">Seleccione</option>');
            data.ubicaciones.forEach(ubi => {
                $('#crear_id_ubicacion').append(
                    `<option value="${ubi.id_ubicacion}">${ubi.nombre_ubicacion}</option>`
                );
            });

            // 💰 Impuestos
            $('#crear_id_impuesto').empty().append('<option value="">Seleccione</option>');
            data.impuestos.forEach(imp => {
                $('#crear_id_impuesto').append(
                    `<option value="${imp.id_impuesto}">${imp.nombre_impuesto}</option>`
                );
            });

        }).fail(function(){
            mostrarToast('Error al cargar datos del formulario', 'danger');
        });
    }

    // Ejecutar al cargar
    cargarSelects();

    // 🖼 PREVIEW DE IMAGEN
    $('#crear_imagen_producto').on('change', function(e){

        const file = e.target.files[0];
        const preview = $('#preview_imagen_producto');

        if(file){
            const reader = new FileReader();

            reader.onload = function(e){
                preview.attr('src', e.target.result);
                preview.removeClass('d-none');
            };

            reader.readAsDataURL(file);
        }
    });

    // 🟢 Guardar producto
    $('#btnGuardarProducto').click(function() {

        const nombre = $('#crear_nombre_producto').val().trim();
        const descripcion = $('#crear_descripcion_producto').val().trim();
        const categoria = $('#crear_id_categoria').val();
        const ubicacion = $('#crear_id_ubicacion').val();
        const impuesto = $('#crear_id_impuesto').val();
        const precioCompra = $('#crear_precio_compra').val();
        const precioVenta = $('#crear_precio_venta').val();
        const stock = $('#crear_stock_actual').val();
        const imagen = $('#crear_imagen_producto')[0].files[0];

        // 🔎 Validaciones
        if(nombre === ''){
            mostrarToast('El nombre del producto es obligatorio', 'danger');
            return;
        }

        if(!categoria || !ubicacion || !impuesto){
            mostrarToast('Debe seleccionar categoría, ubicación e impuesto', 'danger');
            return;
        }

        // 📦 FormData
        const formData = new FormData();

        formData.append('nombre_producto', nombre);
        formData.append('descripcion_producto', descripcion);
        formData.append('id_categoria', categoria);
        formData.append('id_ubicacion', ubicacion);
        formData.append('id_impuesto', impuesto);
        formData.append('precio_compra', precioCompra);
        formData.append('precio_venta', precioVenta);
        formData.append('stock_actual', stock);

        if(imagen){
            formData.append('imagen_producto', imagen);
        }

        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        // 🚀 AJAX
        $.ajax({
            url: '/productos/crear',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            success: function(res){

                mostrarToast('Producto creado correctamente', 'success');

                // 🧹 Limpiar
                $('#formCrearProducto')[0].reset();

                $('#preview_imagen_producto')
                    .attr('src', '')
                    .addClass('d-none');

                // ❌ Cerrar modal
                const modalElement = document.getElementById("modalCrearProducto");
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if(modalInstance) modalInstance.hide();

                // 🔄 Recargar tabla
                if($.fn.DataTable.isDataTable('#tablaProductos')){
                    $('#tablaProductos').DataTable().ajax.reload();
                }
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
                } 
                else if(err.responseJSON && err.responseJSON.mensaje){
                    mostrarToast(err.responseJSON.mensaje, 'danger');
                } 
                else {
                    mostrarToast('Error inesperado del servidor', 'danger');
                }
            }
        });

    });

    // 🧼 Limpiar modal
    $('#modalCrearProducto').on('hidden.bs.modal', function () {
        $('#formCrearProducto')[0].reset();

        $('#preview_imagen_producto')
            .attr('src', '')
            .addClass('d-none');
    });

});