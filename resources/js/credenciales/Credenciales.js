$(document).ready(function () {

    function cargarCredenciales() {

        $.ajax({
            url: '/empresa/mostrar', type: 'GET', dataType: 'json',

            success: function (res) {

                if (res.success && res.data) {

                    let data = res.data;

                    $('#nombre_empresa').text(data.nombre_empresa ?? '-');
                    $('#ruc_empresa').text(data.ruc_empresa ?? '-');
                    $('#direccion_empresa').text(data.direccion_empresa ?? '-');
                    $('#telefono_empresa').text(data.telefono_empresa ?? '-');
                    $('#correo_empresa').text(data.correo_empresa ?? '-');

                } else { mostrarError('No hay configuración registrada'); }

            }, error: function () { mostrarError('Error al cargar datos'); }

        });
    }

    // ⚠️ Manejo de error
    function mostrarError(mensaje) {
        $('#nombre_empresa').text(mensaje);
        $('#ruc_empresa').text('-');
        $('#direccion_empresa').text('-');
        $('#telefono_empresa').text('-');
        $('#correo_empresa').text('-');
    }

    // 🚀 Inicializar
    cargarCredenciales();

});