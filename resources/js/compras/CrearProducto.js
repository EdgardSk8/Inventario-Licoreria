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
                    `<option value="${imp.id_impuesto}" data-iva="${imp.porcentaje_impuesto}">
                        ${imp.nombre_impuesto} (${parseFloat(imp.porcentaje_impuesto)}%)
                    </option>`
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


/* ---------------------------------------------------------------------------------------------------- */

function inicializarCrearVenta() {

    const checkVenta = $('#crear_check_venta'); 
    const checkRedondeo = $('#crear_redondeo_venta');

    const inputPorcentaje = $('#crear_porcentaje_venta');
    const inputPrecioCompra = $('#crear_precio_compra');
    const inputPrecioVenta = $('#crear_precio_venta'); 
    const inputPrecioTotal = $('#crear_precio_venta_TOTAL');
    const selectImpuesto = $('#crear_id_impuesto');

    let porcentajeOriginal = parseFloat(inputPorcentaje.val()) || 0;
    let bloqueando = false;
    let modoRedondeo = false;

    // 🔹 Habilitar / deshabilitar inputs
    function toggleInputs() {
        if (checkVenta.is(':checked')) {
            inputPorcentaje.prop('disabled', false);
            inputPrecioVenta.prop('disabled', true);
            inputPrecioTotal.prop('disabled', true);
        } else {
            inputPorcentaje.prop('disabled', true);
            inputPrecioVenta.prop('disabled', false);
            inputPrecioTotal.prop('disabled', false);
        }
    }

    // 🔹 Calcular desde % o precio base
    function calcularTodo() {
        if (bloqueando || modoRedondeo) return;
        bloqueando = true;

        let precioCompra = parseFloat(inputPrecioCompra.val()) || 0;
        let iva = parseFloat(selectImpuesto.find(':selected').data('iva')) || 0;

        if (checkVenta.is(':checked')) {
            let porcentaje = parseFloat(inputPorcentaje.val()) || 0;

            let precioBase = precioCompra * (1 + porcentaje / 100);
            let precioTotal = precioBase * (1 + iva / 100);

            inputPrecioVenta.val(precioBase.toFixed(2));
            inputPrecioTotal.val(precioTotal.toFixed(2));

            porcentajeOriginal = porcentaje;

        } else {
            let precioBase = parseFloat(inputPrecioVenta.val()) || 0;

            let precioTotal = precioBase * (1 + iva / 100);
            inputPrecioTotal.val(precioTotal.toFixed(2));
        }

        bloqueando = false;
    }

    // 🔥 Calcular desde TOTAL
    function calcularDesdeTotal() {
        if (bloqueando) return;
        bloqueando = true;

        modoRedondeo = false;

        let precioCompra = parseFloat(inputPrecioCompra.val()) || 0;
        let total = parseFloat(inputPrecioTotal.val()) || 0;
        let iva = parseFloat(selectImpuesto.find(':selected').data('iva')) || 0;

        if (precioCompra <= 0 || total <= 0) {
            bloqueando = false;
            return;
        }

        let precioBase = total / (1 + iva / 100);
        let porcentaje = ((precioBase / precioCompra) - 1) * 100;

        inputPrecioVenta.val(precioBase.toFixed(2));
        inputPorcentaje.val(porcentaje.toFixed(2));

        porcentajeOriginal = porcentaje;

        bloqueando = false;
    }

    // 🔹 Redondeo PRO
    function redondearTotal() {

        modoRedondeo = true;

        let iva = parseFloat(selectImpuesto.find(':selected').data('iva')) || 0;

        if (checkVenta.is(':checked')) {

            let precioCompra = parseFloat(inputPrecioCompra.val()) || 0;

            let totalConIva = precioCompra * (1 + porcentajeOriginal / 100) * (1 + iva / 100);
            let totalRedondeado = Math.ceil(totalConIva);

            let baseRedondeada = totalRedondeado / (1 + iva / 100);
            let nuevoPorcentaje = ((baseRedondeada / precioCompra) - 1) * 100;

            porcentajeOriginal = nuevoPorcentaje;

            inputPorcentaje.val(nuevoPorcentaje.toFixed(3));
            inputPrecioVenta.val(baseRedondeada.toFixed(2));
            inputPrecioTotal.val(totalRedondeado);

        } else {

            let precioBase = parseFloat(inputPrecioVenta.val()) || 0;

            let totalConIva = precioBase * (1 + iva / 100);
            let totalRedondeado = Math.ceil(totalConIva);

            let nuevoPrecioVenta = totalRedondeado / (1 + iva / 100);

            inputPrecioVenta.val(nuevoPrecioVenta.toFixed(2));
            inputPrecioTotal.val(totalRedondeado);
        }
    }

    // 🔹 Inicial
    toggleInputs();
    calcularTodo();

    // 🔄 Eventos
    checkVenta.on('change', () => { 
        modoRedondeo = false;
        toggleInputs(); 
        calcularTodo(); 
    });

    inputPrecioCompra.on('input', () => {
        modoRedondeo = false;
        calcularTodo();
    });

    inputPorcentaje.on('input', () => {
        modoRedondeo = false;
        calcularTodo();
    });

    inputPrecioVenta.on('input', () => {
        modoRedondeo = false;
        calcularTodo();
    });

    selectImpuesto.on('change', () => {
        modoRedondeo = false;
        calcularTodo();
    });

    inputPrecioTotal.on('input', calcularDesdeTotal);

    // 🔹 Botón redondeo
    checkRedondeo.on('click', function(e) {
        e.preventDefault();
        redondearTotal();
        checkRedondeo.prop('checked', false);
    });

    // 🔹 Modal crear
    $('#modalCrearProducto').on('shown.bs.modal', function () {
        modoRedondeo = false;
        toggleInputs();
        calcularTodo();
    });
}

// 🚀 INICIALIZAR
inicializarCrearVenta();

/* ---------------------------------------------------------------------------------------------------- */

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

            let producto = res.producto;

            // 🧠 Insertar en Select2 y seleccionarlo
            let newOption = new Option(producto.text, producto.id, true, true);
            $('#producto_select').append(newOption).trigger('change'); // selecciona automáticamente

            // 🔹 Tomar la cantidad y precio que puso el usuario en el modal
            let cantidad = parseFloat($('#crear_stock_actual').val()) || 0;
            let precio = parseFloat($('#crear_precio_compra').val()) || 0;

            $('#cantidad').val(cantidad);
            $('#precio').val(precio);

            $('#producto_select').trigger('select2:select'); // asegura que select2 registre el cambio
            $('#btnAgregar').click();

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