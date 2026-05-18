
window.AppContext = { usuario: null, credenciales: null };

async function cargarContextoSistema() {

    try {
        const [me, cred] = await Promise.all([
            $.get('/me'),
            $.get('/credenciales/mostrar')
        ]);

        if (me && me.success) { window.AppContext.usuario = me.data; }
        if (cred && cred.success) { window.AppContext.credenciales = cred.data; }

    } catch (error) { console.error('Error cargando contexto:', error); }
}

$(document).ready(function () { cargarContextoSistema(); });

PlantillaPDF = function (config = {}) {

    return {
        extend: 'pdfHtml5',
        orientation: 'landscape',
        pageSize: 'A4', 
        filename: config.filename || 'REPORTE', 
        title: config.title || 'REPORTE',
        footer: false ,exportOptions: { columns: ':visible' },

        customize: function (doc) {

            const empresaData = window.AppContext?.credenciales || {};
            const usuarioData = window.AppContext?.usuario || {};

            const empresa   = empresaData.nombre_empresa || 'SIN EMPRESA';
            const direccion = empresaData.direccion_empresa || '';
            const telefono  = empresaData.telefono_empresa || '';

            const usuario   = usuarioData.nombre || 'INVITADO';

            const fecha = formatearFechaDiaHora
                ? formatearFechaDiaHora(new Date())
                : new Date().toLocaleString();

            const tipoReporte = config.tipoReporte || 'REPORTE GENERAL';

            // =================================================
            // ESTILO GENERAL
            // =================================================
            doc.pageMargins = [5, 5, 5, 5];

            doc.defaultStyle = {
                fontSize: 9
            };

            // =================================================
            // HEADER PDF
            // =================================================
            doc.content.unshift({
                stack: [

                    {
                        text: empresa,
                        fontSize: 15,
                        bold: true,
                        alignment: 'center',
                        color: '#1f2937'
                    },

                    {
                        text: direccion,
                        alignment: 'center',
                        fontSize: 9,
                        color: '#6b7280'
                    },

                    {
                        // text: telefono,
                        // alignment: 'center',
                        // fontSize: 9,
                        // color: '#6b7280'
                    },

                    {
                        text: tipoReporte,
                        alignment: 'center',
                        fontSize: 12,
                        bold: true,
                        color: '#2563eb',
                        margin: [0, 2, 0, 2]
                    },

                    {
                        text: `Usuario: ${usuario} | ${fecha}`,
                        alignment: 'center',
                        fontSize: 8,
                        color: '#374151'
                    }

                ],
                margin: [0, 0, 0, 10]
            });

            // =================================================
            // BUSCAR TABLA
            // =================================================
            let table = doc.content.find(c => c.table);
                if (!table) return;
            let body = table.table.body;

            // =================================================
            // ESTILO TABLA
            // =================================================
            table.layout = {
                fillColor: function (rowIndex) {
                    return rowIndex === 0 ? '#1f2937' : null;
                },
                hLineColor: () => '#e5e7eb',
                vLineColor: () => '#e5e7eb',
                paddingLeft: () => 6,
                paddingRight: () => 6,
                paddingTop: () => 4,
                paddingBottom: () => 4
            };

            doc.styles.tableHeader = {
                fillColor: '#1f2937',
                color: 'white',
                bold: true,
                fontSize: 10,
                alignment: 'center'
            };

            doc.styles.tableBodyOdd = {
                alignment: 'center'
            };

            doc.styles.tableBodyEven = {
                alignment: 'center'
            };

            // =================================================
            // ZEBRA STRIPES
            // =================================================
            for (let i = 1; i < body.length; i++) {
                body[i].forEach(cell => {
                    cell.fillColor = (i % 2 === 0) ? '#f9fafb' : null;
                });
            }

            // =================================================
            // FOOTER TABLA
            // =================================================
            let lastRow = body[body.length - 1];

            if (lastRow) {
                lastRow.forEach(cell => {
                    cell.fillColor = '#e5e7eb';
                    cell.bold = true;
                });
            }
        }
    };
};


window.PlantillaCSV = function (config = {}) {

    return {
        extend: 'csvHtml5',footer: false,exportOptions: { columns: ':visible' },

        customize: function (csv) {

            const empresaData = window.AppContext?.credenciales || {};
            const usuarioData = window.AppContext?.usuario || {};

            const empresa   = empresaData.nombre_empresa || 'SIN EMPRESA';
            const usuario   = usuarioData.nombre || 'INVITADO';

            const fecha = window.formatearFechaDiaHora
                ? window.formatearFechaDiaHora(new Date())
                : new Date().toLocaleString('es-ES');

            const tipoReporte = config.tipoReporte || 'REPORTE GENERAL';

            const header =
`====================================
${empresa}
====================================
REPORTE: ${tipoReporte}
USUARIO: ${usuario}
FECHA: ${fecha}
====================================

`;

            return header + csv;
        }
    };
};


PlantillaExcel = function (config = {}) {

    return {
        extend: 'excelHtml5',
        filename: config.filename || 'REPORTE',

        exportOptions: { columns: ':visible' },

        customize: function (xlsx) {

            const sheet = xlsx.xl.worksheets['sheet1.xml'];

            const empresaData = window.AppContext?.credenciales || {};
            const usuarioData = window.AppContext?.usuario || {};

            const empresa = empresaData.nombre_empresa || 'SIN EMPRESA';
            const direccion = empresaData.direccion_empresa || '';
            const telefono = empresaData.telefono_empresa || '';
            const usuario = usuarioData.nombre || 'INVITADO';

            const fecha = window.formatearFechaDiaHora
                ? window.formatearFechaDiaHora(new Date())
                : new Date().toLocaleString('es-ES');

            const tipoReporte = config.tipoReporte || 'REPORTE GENERAL';

            // =========================
            // SHIFT (5 FILAS ARRIBA)
            // =========================
            $('row', sheet).each(function () {
                let r = parseInt($(this).attr('r'));
                $(this).attr('r', r + 5);
            });

            $('c', sheet).each(function () {
                let cell = $(this).attr('r');
                if (!cell) return;

                let col = cell.replace(/[0-9]/g, '');
                let row = parseInt(cell.replace(/[A-Z]/g, ''));

                $(this).attr('r', col + (row + 5));
            });

            // =========================
            // HEADER PRO (con celdas válidas)
            // =========================
            const headerRows = `
                <row r="1">
                    <c r="A1" t="inlineStr"><is><t>${tipoReporte}</t></is></c>
                </row>
                <row r="2">
                    <c r="A2" t="inlineStr"><is><t>${empresa}</t></is></c>
                </row>
                <row r="3">
                    <c r="A3" t="inlineStr"><is><t>${direccion} ${telefono}</t></is></c>
                </row>
                <row r="4">
                    <c r="A4" t="inlineStr"><is><t>Usuario: ${usuario}</t></is></c>
                </row>
                <row r="5">
                    <c r="A5" t="inlineStr"><is><t>${fecha}</t></is></c>
                </row>
            `;

            $('sheetData', sheet).prepend(headerRows);

            // =========================
            // ESTILOS (CENTRADO + NEGRITA)
            // =========================
            $('row[r="1"] c', sheet).attr('s', '2'); // título (más fuerte)
            $('row[r="2"] c', sheet).attr('s', '3'); // empresa
            $('row[r="3"] c, row[r="4"] c, row[r="5"] c', sheet).attr('s', '3');

            // =========================
            // MERGE CELLS (CORRECTO Y SEGURO)
            // =========================
            if ($('mergeCells', sheet).length === 0) {

                const mergeCells =
                    `<mergeCells count="2">
                        <mergeCell ref="A1:H1"/>
                        <mergeCell ref="A2:H2"/>
                    </mergeCells>`;

                $('worksheet', sheet).append(mergeCells);
            }

            // =========================
            // HEADER DE TABLA (fila real después del shift)
            // =========================
            $('row[r="6"] c', sheet).each(function () {
                $(this).attr('s', '4');
            });

            // =========================
            // ALTURA TÍTULO
            // =========================
            $('row[r="1"]', sheet)
                .attr('ht', '28')
                .attr('customHeight', 1);
        }
    };
};