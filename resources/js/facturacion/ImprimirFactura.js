async function imprimirFactura(data) {

    let empresa;

    try {
        empresa = await obtenerCredencialesEmpresa();
    } catch (e) {
        console.error("❌ Error cargando empresa:", e);
        alert("No se pudieron cargar datos de la empresa");
        return;
    }

    const cliente = data?.cliente ?? {};
    const productos = Array.isArray(data?.productos)
        ? data.productos
        : Array.isArray(data?.carrito)
            ? data.carrito
            : [];

    if (productos.length === 0) {
        console.warn("⚠️ No hay productos para imprimir");
        return;
    }

    // 🔥 FECHA CON TU FUNCION GLOBAL
    const fecha = window.formatearFechaDiaHora(data?.fecha_venta ?? new Date());

    // 🔥 TITULO FACTURA DESDE BACKEND
    const numeroFactura = data?.numero_factura ?? data?.factura ?? 'FACTURA';
    const tituloFactura = `Factura ${numeroFactura}`;

    let filas = "";
    let subtotalGeneral = 0;
    let impuestoTotal = 0;
    let totalFinal = 0;

    productos.forEach(p => {

        const nombre = p.nombre ?? p.nombre_producto ?? '';
        const cantidad = Number(p.cantidad ?? 0);
        const precio = Number(p.precio ?? 0);
        const impuesto = Number(p.impuesto ?? 0);
        const totalLinea = Number(p.total ?? (precio * cantidad + impuesto * cantidad));

        subtotalGeneral += precio * cantidad;
        impuestoTotal += impuesto * cantidad;
        totalFinal += totalLinea;

        filas += `
            <tr>
                <td>${nombre}</td>
                <td style="text-align:center;">${cantidad}</td>
                <td style="text-align:right;">C$ ${precio.toFixed(2)}</td>
                <td style="text-align:right;">C$ ${impuesto}</td>
                <td style="text-align:right;">C$ ${totalLinea.toFixed(2)}</td>
            </tr>
        `;
    });

    const recibido = Number(data?.monto_recibido ?? totalFinal);
    const vuelto = Number(data?.vuelto ?? (recibido - totalFinal));

    const ventana = window.open('', '_blank', 'width=450,height=650');

    if (!ventana) {
        alert("Activa ventanas emergentes para imprimir");
        return;
    }

    ventana.document.write(`
        <html>
        <head>
            <title>${tituloFactura}</title>

            <style>
                body {
                    font-family: Arial;
                    font-size: 12.5px;
                    padding: 12px;
                    color: #111;
                }

                .header {
                    text-align: center;
                    margin-bottom: 12px;
                }

                .header strong {
                    font-size: 14px;
                }

                .empresa {
                    font-size: 11px;
                    line-height: 1.3;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 12px;
                    font-size: 11.8px; /* 🔥 +2px visual */
                }

                th, td {
                    border-bottom: 1px solid #ddd;
                    padding: 8px 6px; /* 🔥 +2px en padding */
                }

                th {
                    background: #f2f2f2;
                    font-size: 11px;
                    font-weight: bold;
                }

                .cliente {
                    margin-top: 12px;
                    font-size: 11px;
                    line-height: 1.4;
                }

                .resumen {
                    margin-top: 12px;
                    font-size: 12px;
                    line-height: 1.5;
                }

                .totales {
                    margin-top: 10px;
                    font-size: 12.5px;
                    text-align: right;
                    font-weight: bold;
                }
            </style>
        </head>

        <body>

            <div class="header">
                <strong>${empresa?.nombre_empresa ?? ''}</strong><br>
                <div class="empresa">
                    RUC: ${empresa?.ruc_empresa ?? ''}<br>
                    ${empresa?.direccion_empresa ?? ''}<br>
                    Tel: ${empresa?.telefono_empresa ?? ''}
                </div>
            </div>

            <div class="cliente">
                Cliente: ${cliente?.nombre_cliente ?? 'Consumidor final'}<br>
                Fecha: ${fecha}
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Impuesto</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    ${filas}
                </tbody>
            </table>

            <div class="resumen">
                Subtotal: C$ ${subtotalGeneral.toFixed(2)}<br>
                Impuesto: C$ ${impuestoTotal.toFixed(2)}<br>
                <strong>Total: C$ ${totalFinal.toFixed(2)}</strong>
            </div>

            <div class="totales">
                Pagó: C$ ${recibido.toFixed(2)}<br>
                Vuelto: C$ ${vuelto.toFixed(2)}
            </div>

        </body>
        </html>
    `);

    ventana.document.close();

    ventana.onload = () => {
        ventana.focus();
        ventana.print();

        ventana.onafterprint = () => ventana.close();

        setTimeout(() => {
            if (!ventana.closed) ventana.close();
        }, 3000);
    };
}

async function obtenerCredencialesEmpresa() {

    return new Promise((resolve, reject) => {

        $.ajax({
            url: '/credenciales/mostrar',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (res) {

                if (res.success && res.data) {
                    resolve(res.data);
                } else {
                    reject('No data');
                }
            },

            error: function (xhr) {
                console.error('Error AJAX credenciales:', xhr.responseText);
                reject('Error servidor');
            }
        });

    });
}