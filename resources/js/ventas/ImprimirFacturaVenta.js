$(document).on('click', '#btnImprimir', function () {

    let contenido = document.getElementById('areaImprimir').innerHTML;

    let ventana = window.open('', '', 'width=800,height=600');

    ventana.document.write(`
        <html>
        <head>
            <title>Factura</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <style>
                body { padding: 20px; font-size: 12px; }
                table { width: 100%; }
            </style>
        </head>
        <body>
            ${contenido}
        </body>
        </html>
    `);

    ventana.document.close();
    ventana.print();
});