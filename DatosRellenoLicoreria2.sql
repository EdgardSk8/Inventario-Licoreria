-- =========================================
-- CLIENTES
-- =========================================

INSERT INTO clientes
(nombre_cliente, cedula_cliente, ruc_cliente, telefono_cliente, direccion_cliente, correo_cliente, estado_cliente, fecha_creacion_cliente)
VALUES
('Cliente Generico','','','','','',1,'2026-01-05'),
('Carlos Martínez','001-050126-913C','J0310501268845K','88880003','Managua','carlos.martinez@gmail.com',1,'2026-01-05'),
('Ana Rodríguez','211-050126-204D','J0310501263321M','88880004','Chinandega','ana.rodriguez@gmail.com',1,'2026-01-05'),
('Luis García','131-050126-775E','J0310501265590P','88880005','Estelí','luis.garcia@gmail.com',1,'2026-01-05'),
('Pedro Sánchez','241-050126-118F','J0310501267712R','88880006','Masaya','pedro.sanchez@gmail.com',1,'2026-01-05'),
('Jorge Mendoza','151-050226-663G','J0310502264451T','88880007','Granada','jorge.mendoza@gmail.com',1,'2026-02-05'),
('José Castillo','281-050226-902H','J0310502269988V','88880008','León','jose.castillo@gmail.com',1,'2026-02-05'),
('Miguel Vargas','271-050226-314J','J0310502262233X','88880009','Rivas','miguel.vargas@gmail.com',1,'2026-02-05'),
('Andrea Ruiz','001-050226-587K','J0310502266677Z','88880010','Managua','andrea.ruiz@gmail.com',1,'2026-02-05'),
('Daniel López','211-050226-439L','J0310502261209Q','88880011','Chinandega','daniel.lopez@gmail.com',1,'2026-02-05');

-- =========================================
-- CUENTAS
-- =========================================

INSERT INTO cuentas (nombre_cuenta, tipo_cuenta, descripcion, saldo_actual, estado, created_at, updated_at) VALUES
('Caja General','EFECTIVO','Caja principal del negocio',5000,1,NOW(),NOW()),
('BAC Credomatic','BANCARIA','Cuenta BAC principal',120000,1,NOW(),NOW()),
('Lafise','BANCARIA','Cuenta Lafise operaciones',65000,1,NOW(),NOW()),
('Banpro','BANCARIA','Cuenta Banpro ventas',98000,1,NOW(),NOW()),
('Caja Gastos','EFECTIVO','Caja destinada a gastos operativos y administrativos',12000,1,NOW(),NOW()),
('Cuenta Compras','EFECTIVO','Fondos destinados para compras e inventario',30000,1,NOW(),NOW());

-- =========================================
-- CAJAS (ids 1-10)
-- =========================================

INSERT INTO cajas
(fecha_apertura, fecha_cierre, monto_inicial, monto_final, monto_teorico, monto_real, diferencia, estado_caja, id_usuario) VALUES
('2026-05-05 08:00:00','2026-05-05 22:00:00',5000,17500,17450,17500,50,0,1),
('2026-05-06 08:00:00','2026-05-06 22:00:00',5000,18200,18200,18150,-50,0,2),
('2026-05-07 08:00:00','2026-05-07 22:00:00',5000,19000,18950,19000,50,0,1),
('2026-05-08 08:00:00','2026-05-08 22:00:00',5000,20100,20050,20100,50,0,2),
('2026-05-09 08:00:00','2026-05-09 22:00:00',5000,20900,20900,20850,-50,0,1),
('2026-05-10 08:00:00','2026-05-10 22:00:00',5000,21800,21750,21800,50,0,2),
('2026-05-11 08:00:00','2026-05-11 22:00:00',5000,22500,22500,22450,-50,0,1),
('2026-05-12 08:00:00','2026-05-12 22:00:00',5000,23300,23250,23300,50,0,2),
('2026-05-13 08:00:00','2026-05-13 22:00:00',5000,24100,24100,24050,-50,0,1),
('2026-05-14 08:00:00','2026-05-14 22:00:00',5000,25000,24950,25000,50,0,2);

-- =========================================
-- UBICACIONES
-- =========================================

INSERT INTO ubicaciones (nombre_ubicacion, descripcion_ubicacion, estado_ubicacion) VALUES
('Estante A1','Whiskys premium',1),
('Estante A2','Whiskys económicos',1),
('Estante B1','Rones añejos',1),
('Estante B2','Vodkas y ginebras',1),
('Estante C1','Cervezas nacionales',1),
('Estante C2','Cervezas importadas',1),
('Refrigerador 1','Bebidas frías',1),
('Refrigerador 2','Cervezas premium',1),
('Bodega 1','Inventario general',1),
('Bodega 2','Productos importados',1);

-- =========================================
-- CATEGORIAS
-- =========================================

INSERT INTO categoria (nombre_categoria, descripcion_categoria, estado_categoria) VALUES
('Whisky','Whiskys nacionales e importados',1),
('Ron','Rones premium y clásicos',1),
('Vodka','Vodkas nacionales e importados',1),
('Tequila','Tequilas blancos y reposados',1),
('Ginebra','Ginebras premium',1),
('Vino Tinto','Vinos tintos importados',1),
('Vino Blanco','Vinos blancos y espumosos',1),
('Cerveza','Cervezas nacionales e importadas',1),
('Licores','Licores dulces y cremosos',1),
('Energéticas','Bebidas energéticas',1);

-- =========================================
-- TIPO GASTO
-- =========================================

INSERT INTO tipo_gasto (nombre_tipo_gasto, descripcion_tipo_gasto, estado_tipo_gasto) VALUES
('Servicios Públicos','Pago de luz, agua, internet, teléfono',1),
('Mantenimiento','Reparaciones, limpieza y mantenimiento del local',1),
('Sueldos','Pago de salarios al personal',1),
('Impuestos','Pagos de impuestos locales y nacionales',1),
('Otros','Gastos varios no contemplados en otras categorías',1),
('Transporte y Distribución','Fletes, entregas y transporte de mercadería',1),
('Compras de Inventario','Compra de productos para reventa',1),
('Publicidad y Marketing','Anuncios, promociones y redes sociales',1),
('Empaques y Desechables','Bolsas, vasos, hielo, servilletas',1),
('Seguridad','Guardas de seguridad, cámaras y vigilancia',1),
('Comisiones Bancarias','Cobros por uso de POS y transferencias',1),
('Alquiler del Local','Pago mensual del establecimiento',1),
('Equipos y Mobiliario','Compra de estanterías, refrigeradores, etc.',1);

-- =========================================
-- GASTOS
-- =========================================

INSERT INTO gastos (id_tipo_gasto, nombre_gasto, descripcion_gasto, estado_gasto, fecha_inicio, fecha_pago, proximo_pago, estado_pago, ultimo_pago) VALUES
(1,'Pago de Energía','Factura mensual DISNORTE',0,'2026-01-01','2026-05-01','2026-06-01',1,'2026-05-01'),
(1,'Internet Negocio','Servicio Claro Empresas',0,'2026-01-01','2026-05-02','2026-06-02',1,'2026-05-02'),
(3,'Salario Cajero','Pago mensual cajero',0,'2026-01-01','2026-05-05','2026-06-05',1,'2026-05-05'),
(12,'Alquiler Local','Renta mensual',0,'2026-01-01','2026-05-03','2026-06-03',1,'2026-05-03'),
(8,'Publicidad Facebook','Campaña redes sociales',0,'2026-05-01','2026-05-10','2026-06-10',1,'2026-05-10');

-- =========================================
-- PRODUCTOS (30)
-- stock_actual refleja el estado FINAL después de todas las compras y ventas
-- =========================================

INSERT INTO productos
(nombre_producto, descripcion_producto, id_categoria, id_impuesto, id_ubicacion, imagen_producto, precio_compra, precio_venta, stock_actual, estado_producto)
VALUES
('Johnnie Walker Black Label','Whisky escocés 750ml',1,2,1,'ImagenProducto1.png',950,1450,37,1),
('Johnnie Walker Blue Label','Whisky premium 750ml',1,2,1,'ImagenProducto2.png',6800,9500,19,1),
('Chivas Regal 12','Whisky escocés 750ml',1,2,1,'ImagenProducto3.png',1100,1650,50,1),
('Jack Daniels Old No.7','Whisky Tennessee 750ml',1,2,2,'ImagenProducto4.png',850,1350,50,1),
('Ballantines Finest','Whisky escocés 750ml',1,2,2,'ImagenProducto5.png',700,1100,40,1),
('Flor de Caña 7 años','Ron añejo 750ml',2,2,3,'ImagenProducto6.png',420,650,56,1),
('Flor de Caña 18 años','Ron premium 750ml',2,2,3,'ImagenProducto7.png',1450,2200,51,1),
('Bacardi Carta Blanca','Ron blanco 750ml',2,2,3,'ImagenProducto8.png',380,580,50,1),
('Zacapa 23','Ron premium Guatemala',2,2,3,'ImagenProducto9.png',1800,2800,50,1),
('Captain Morgan','Ron especiado 750ml',2,2,3,'ImagenProducto10.png',450,700,50,1),
('Absolut Vodka','Vodka sueco 750ml',3,2,4,'ImagenProducto11.png',520,850,62,1),
('Smirnoff Red','Vodka clásico 750ml',3,2,4,'ImagenProducto12.png',350,550,50,1),
('Grey Goose','Vodka premium francés',3,2,4,'ImagenProducto13.png',1500,2300,43,1),
('Ciroc','Vodka premium 750ml',3,2,4,'ImagenProducto14.png',1750,2600,50,1),
('Jose Cuervo Especial','Tequila reposado',4,2,4,'ImagenProducto15.png',600,950,50,1),
('Don Julio Reposado','Tequila premium',4,2,4,'ImagenProducto16.png',2200,3400,30,1),
('Patron Silver','Tequila premium',4,2,4,'ImagenProducto17.png',2400,3600,30,1),
('Bombay Sapphire','Ginebra premium',5,2,4,'ImagenProducto18.png',720,1100,45,1),
('Tanqueray London Dry','Ginebra importada',5,2,4,'ImagenProducto19.png',780,1200,50,1),
('Casillero del Diablo','Vino tinto chileno',6,1,5,'ImagenProducto20.png',280,450,60,1),
('Santa Rita 120','Vino tinto',6,1,5,'ImagenProducto21.png',240,390,65,1),
('Concha y Toro Reservado','Vino tinto',6,1,5,'ImagenProducto22.png',300,480,50,1),
('Gato Negro Blanco','Vino blanco',7,1,5,'ImagenProducto23.png',260,420,44,1),
('Frontera Chardonnay','Vino blanco',7,1,5,'ImagenProducto24.png',290,460,50,1),
('Toña','Cerveza nacional lata',8,2,7,'ImagenProducto25.png',28,45,385,1),
('Victoria Frost','Cerveza nacional',8,2,7,'ImagenProducto26.png',30,48,420,1),
('Heineken','Cerveza importada',8,2,8,'ImagenProducto27.png',42,65,221,1),
('Corona Extra','Cerveza mexicana',8,2,8,'ImagenProducto28.png',45,70,380,1),
('Baileys Irish Cream','Licor cremoso',9,2,6,'ImagenProducto29.png',780,1250,31,1),
('Red Bull','Bebida energética',10,1,7,'ImagenProducto30.png',55,85,238,1);

-- =========================================
-- COMPRAS
-- =========================================

INSERT INTO compras
(numero_factura_compra, id_proveedor, id_usuario, fecha_compra,
 subtotal_compra, descuento_compra, impuesto_compra, total_compra,
 estado_compra, id_cuenta, id_metodo_pago, id_tipo_factura)
VALUES
('COMP-0001',1,1,'2026-05-01 10:00:00',22600,0,2260,24860,1,6,3,1),
('COMP-0002',2,1,'2026-05-02 11:30:00',37520,500,3702,40722,1,6,2,1),
('COMP-0003',3,1,'2026-05-03 15:00:00',37500,0,3750,41250,1,6,3,1),
('COMP-0004',4,2,'2026-05-04 09:20:00',11950,0,1195,13145,1,6,1,1),
('COMP-0005',5,2,'2026-05-05 14:10:00',11880,0,1188,13068,1,6,2,1);

-- =========================================
-- DETALLE COMPRAS
-- =========================================

INSERT INTO detalle_compras
(id_compra, id_producto, cantidad_compra, precio_unitario_compra, subtotal_detalle_compra) VALUES
(1,1,12,950,11400), (1,6,20,420,8400), (1,25,100,28,2800),
(2,2,4,6800,27200), (2,11,15,520,7800), (2,27,60,42,2520),
(3,7,10,1450,14500), (3,13,8,1500,12000), (3,16,5,2200,11000),
(4,20,20,280,5600), (4,21,15,240,3600), (4,30,50,55,2750),
(5,26,120,30,3600), (5,28,80,45,3600), (5,29,6,780,4680);

-- =========================================
-- VENTAS
-- =========================================

INSERT INTO ventas
(numero_factura, fecha_venta, id_cliente, id_usuario, id_caja, id_cuenta,
 subtotal_venta, impuesto_venta, total_venta, estado_venta,
 id_metodo_pago, monto_recibido, vuelto, moneda)
VALUES
-- ENERO
('VTA-20260103-00001','2026-01-03 11:20:00',2,2,1,NULL,1450,145,1595,1,1,1800,205,'NIO'),
('VTA-20260105-00002','2026-01-05 14:10:00',3,1,1,NULL,9680,968,10648,1,2,11000,352,'NIO'),
('VTA-20260106-00003','2026-01-06 19:40:00',4,2,2,NULL,905,65,970,1,1,1000,30,'NIO'),
('VTA-20260108-00004','2026-01-08 20:00:00',5,2,2,NULL,4500,450,4950,1,3,5000,50,'NIO'),
('VTA-20260110-00005','2026-01-10 16:15:00',6,1,3,NULL,3550,355,3905,1,1,4000,95,'NIO'),
('VTA-20260112-00006','2026-01-12 18:30:00',7,2,3,NULL,2340,234,2574,1,2,2600,26,'NIO'),
('VTA-20260115-00007','2026-01-15 21:10:00',8,2,4,NULL,5625,563,6188,1,4,6200,12,'NIO'),
('VTA-20260118-00008','2026-01-18 13:45:00',9,1,4,NULL,2750,275,3025,1,1,3100,75,'NIO'),
('VTA-20260120-00009','2026-01-20 10:05:00',2,2,5,NULL,1600,160,1760,1,2,1800,40,'NIO'),
('VTA-20260124-00010','2026-01-24 22:00:00',3,1,5,NULL,9990,999,10989,1,3,11000,11,'NIO'),
-- FEBRERO
('VTA-20260202-00011','2026-02-02 09:30:00',4,2,1,NULL,2100,210,2310,1,1,2500,190,'NIO'),
('VTA-20260204-00012','2026-02-04 15:20:00',5,1,1,NULL,3520,352,3872,1,2,4000,128,'NIO'),
('VTA-20260206-00013','2026-02-06 17:55:00',6,2,2,NULL,1450,145,1595,1,1,1600,5,'NIO'),
('VTA-20260208-00014','2026-02-08 20:45:00',7,2,2,NULL,5280,528,5808,1,4,6000,192,'NIO'),
('VTA-20260210-00015','2026-02-10 12:10:00',8,1,3,NULL,2860,286,3146,1,3,3200,54,'NIO'),
('VTA-20260212-00016','2026-02-12 18:00:00',9,2,3,NULL,5830,583,6413,1,1,6500,87,'NIO'),
('VTA-20260215-00017','2026-02-15 21:25:00',2,1,4,NULL,1925,193,2118,1,2,2200,82,'NIO'),
('VTA-20260218-00018','2026-02-18 11:40:00',3,2,4,NULL,9635,964,10599,1,1,11000,401,'NIO'),
('VTA-20260221-00019','2026-02-21 14:50:00',4,2,5,NULL,4510,451,4961,1,3,5000,39,'NIO'),
('VTA-20260225-00020','2026-02-25 19:35:00',5,1,5,NULL,1485,149,1634,1,4,1700,66,'NIO'),
-- MARZO
('VTA-20260301-00021','2026-03-01 10:00:00',6,2,1,NULL,2420,242,2662,1,1,2700,38,'NIO'),
('VTA-20260303-00022','2026-03-03 13:20:00',7,1,1,NULL,3960,396,4356,1,2,4400,44,'NIO'),
('VTA-20260305-00023','2026-03-05 18:10:00',8,2,2,NULL,5390,539,5929,1,3,6000,71,'NIO'),
('VTA-20260307-00024','2026-03-07 20:50:00',9,2,2,NULL,2035,204,2239,1,1,2300,61,'NIO'),
('VTA-20260310-00025','2026-03-10 16:40:00',2,1,3,NULL,3025,303,3328,1,2,3400,72,'NIO'),
('VTA-20260312-00026','2026-03-12 19:00:00',3,2,3,NULL,5610,561,6171,1,4,6200,29,'NIO'),
('VTA-20260315-00027','2026-03-15 11:35:00',4,1,4,NULL,1595,160,1755,1,1,1800,45,'NIO'),
('VTA-20260318-00028','2026-03-18 15:10:00',5,2,4,NULL,4290,429,4719,1,3,4800,81,'NIO'),
('VTA-20260322-00029','2026-03-22 21:45:00',6,2,5,NULL,3080,308,3388,1,2,3500,112,'NIO'),
('VTA-20260326-00030','2026-03-26 17:15:00',7,1,5,NULL,1925,193,2118,1,1,2200,82,'NIO'),
-- ABRIL
('VTA-20260402-00031','2026-04-02 09:45:00',8,2,1,NULL,2640,264,2904,1,1,3000,96,'NIO'),
('VTA-20260404-00032','2026-04-04 13:50:00',9,1,1,NULL,4620,462,5082,1,2,5200,118,'NIO'),
('VTA-20260406-00033','2026-04-06 18:25:00',2,2,2,NULL,1760,176,1936,1,3,2000,64,'NIO'),
('VTA-20260408-00034','2026-04-08 20:15:00',3,2,2,NULL,5720,572,6292,1,4,6500,208,'NIO'),
('VTA-20260410-00035','2026-04-10 12:40:00',4,1,3,NULL,3410,341,3751,1,1,3800,49,'NIO'),
('VTA-20260412-00036','2026-04-12 16:55:00',5,2,3,NULL,2145,215,2360,1,2,2400,40,'NIO'),
('VTA-20260415-00037','2026-04-15 19:30:00',6,1,4,NULL,5060,506,5566,1,3,5600,34,'NIO'),
('VTA-20260418-00038','2026-04-18 21:00:00',7,2,4,NULL,3135,314,3449,1,1,3500,51,'NIO'),
('VTA-20260422-00039','2026-04-22 11:25:00',8,2,5,NULL,4125,413,4538,1,2,4600,62,'NIO'),
('VTA-20260426-00040','2026-04-26 18:05:00',9,1,5,NULL,1540,154,1694,1,4,1700,6,'NIO'),
-- MAYO
('VTA-20260501-00041','2026-05-01 12:15:00',2,2,1,NULL,1595,160,1755,1,1,1800,45,'NIO'),
('VTA-20260501-00042','2026-05-01 13:40:00',3,2,1,NULL,3080,308,3388,1,2,3400,12,'NIO'),
('VTA-20260502-00043','2026-05-02 18:20:00',4,2,2,NULL,1045,105,1150,1,1,1200,50,'NIO'),
('VTA-20260503-00044','2026-05-03 20:10:00',5,1,3,NULL,4620,462,5082,1,3,5100,18,'NIO'),
('VTA-20260504-00045','2026-05-04 16:00:00',6,2,4,NULL,3960,396,4356,1,1,4400,44,'NIO'),
('VTA-20260505-00046','2026-05-05 21:30:00',7,2,5,NULL,2035,204,2239,1,2,2300,61,'NIO'),
('VTA-20260505-00047','2026-05-05 22:00:00',8,1,5,NULL,1012,101,1113,1,4,1150,37,'NIO'),
('VTA-20260506-00048','2026-05-06 19:25:00',9,2,5,NULL,5940,594,6534,1,1,6600,66,'NIO'),
('VTA-20260508-00049','2026-05-08 12:30:00',6,2,4,NULL,3025,303,3328,1,2,3400,72,'NIO'),
('VTA-20260511-00050','2026-05-11 20:30:00',5,2,4,NULL,5280,528,5808,1,2,6000,192,'NIO');

-- =========================================
-- DETALLE VENTAS
-- =========================================

INSERT INTO detalle_ventas
(id_venta, id_producto, cantidad_venta, precio_unitario_venta, subtotal_detalle_venta, porcentaje_impuesto, monto_impuesto)
VALUES
-- ENERO
(1,1,1,1450,1450,10,145),
(2,2,1,9500,9500,10,950),
(2,25,4,45,180,10,18),
(3,6,1,650,650,10,65),
(3,30,3,85,255,0,0),
(4,16,1,3400,3400,10,340),
(4,18,1,1100,1100,10,110),
(5,13,1,2300,2300,10,230),
(5,27,10,65,650,10,65),
(6,20,2,450,900,15,135),
(6,23,2,420,840,15,126),
(7,11,1,850,850,10,85),
(8,7,2,2200,4400,10,440),
(8,29,1,1250,1250,10,125),
(9,1,1,1450,1450,10,145),
(10,2,1,9500,9500,10,950),
(10,25,2,45,90,10,9),
-- FEBRERO
(11,6,1,650,650,10,65),
(11,30,4,85,340,0,0),
(12,16,1,3400,3400,10,340),
(12,18,1,1100,1100,10,110),
(13,13,1,2300,2300,10,230),
(13,27,8,65,520,10,52),
(14,20,2,450,900,15,135),
(14,23,2,420,840,15,126),
(15,11,1,850,850,10,85),
(16,7,2,2200,4400,10,440),
(16,29,1,1250,1250,10,125),
(17,1,1,1450,1450,10,145),
(18,2,1,9500,9500,10,950),
(18,25,3,45,135,10,14),
(19,6,1,650,650,10,65),
(19,30,2,85,170,0,0),
(20,16,1,3400,3400,10,340),
-- MARZO
(21,18,1,1100,1100,10,110),
(22,13,1,2300,2300,10,230),
(23,27,6,65,390,10,39),
(24,7,1,2200,2200,10,220),
(25,29,1,1250,1250,10,125),
(26,20,2,450,900,15,135),
(27,23,2,420,840,15,126),
(28,11,1,850,850,10,85),
(29,6,1,650,650,10,65),
(30,30,3,85,255,0,0),
-- ABRIL
(31,1,1,1450,1450,10,145),
(32,2,1,9500,9500,10,950),
(33,25,2,45,90,10,9),
(34,16,1,3400,3400,10,340),
(35,18,1,1100,1100,10,110),
(36,13,1,2300,2300,10,230),
(37,27,5,65,325,10,33),
(38,7,2,2200,4400,10,440),
(39,29,1,1250,1250,10,125),
(40,20,2,450,900,15,135),
-- MAYO
(41,1,1,1450,1450,10,145),
(42,2,1,9500,9500,10,950),
(43,25,4,45,180,10,18),
(44,16,1,3400,3400,10,340),
(45,18,1,1100,1100,10,110),
(46,13,1,2300,2300,10,230),
(47,27,10,650,6500,10,650),
(48,7,2,2200,4400,10,440),
(49,29,1,1250,1250,10,125),
(50,20,2,450,900,15,135);

-- =========================================
-- MOVIMIENTOS INVENTARIO
-- stock_resultante recalculado correctamente para cada movimiento
-- =========================================

INSERT INTO movimientos_inventario
(id_producto, tipo_movimiento, cantidad_movimiento, stock_resultante, motivo_movimiento, id_referencia, tipo_referencia, precio_unitario, fecha_movimiento, id_usuario) VALUES
-- ENTRADAS POR COMPRAS
-- COMPRA 1
(1,'ENTRADA',12,NULL,'Compra COMP-0001',1,'COMPRA',950,'2026-05-01 10:00:00',1),
(6,'ENTRADA',20,NULL,'Compra COMP-0001',1,'COMPRA',420,'2026-05-01 10:00:00',1),
(25,'ENTRADA',100,NULL,'Compra COMP-0001',1,'COMPRA',28,'2026-05-01 10:00:00',1),

-- COMPRA 2
(2,'ENTRADA',4,NULL,'Compra COMP-0002',2,'COMPRA',6800,'2026-05-02 11:30:00',1),
(11,'ENTRADA',15,NULL,'Compra COMP-0002',2,'COMPRA',520,'2026-05-02 11:30:00',1),
(27,'ENTRADA',60,NULL,'Compra COMP-0002',2,'COMPRA',42,'2026-05-02 11:30:00',1),

-- COMPRA 3
(7,'ENTRADA',10,NULL,'Compra COMP-0003',3,'COMPRA',1450,'2026-05-03 15:00:00',1),
(13,'ENTRADA',8,NULL,'Compra COMP-0003',3,'COMPRA',1500,'2026-05-03 15:00:00',1),
(16,'ENTRADA',5,NULL,'Compra COMP-0003',3,'COMPRA',2200,'2026-05-03 15:00:00',1),

-- COMPRA 4
(20,'ENTRADA',20,NULL,'Compra COMP-0004',4,'COMPRA',280,'2026-05-04 09:20:00',1),
(21,'ENTRADA',15,NULL,'Compra COMP-0004',4,'COMPRA',240,'2026-05-04 09:20:00',1),
(30,'ENTRADA',50,NULL,'Compra COMP-0004',4,'COMPRA',55,'2026-05-04 09:20:00',1),

-- COMPRA 5
(26,'ENTRADA',120,NULL,'Compra COMP-0005',5,'COMPRA',30,'2026-05-05 14:10:00',1),
(28,'ENTRADA',80,NULL,'Compra COMP-0005',5,'COMPRA',45,'2026-05-05 14:10:00',1),
(29,'ENTRADA',6,NULL,'Compra COMP-0005',5,'COMPRA',780,'2026-05-05 14:10:00',1),
(1,'SALIDA',1,NULL,'Venta VTA-20260103-00001',1,'VENTA',1450,'2026-01-03 11:20:00',2),

(2,'SALIDA',1,NULL,'Venta VTA-20260105-00002',2,'VENTA',9500,'2026-01-05 14:10:00',2),
(25,'SALIDA',4,NULL,'Venta VTA-20260105-00002',2,'VENTA',45,'2026-01-05 14:10:00',2),

(6,'SALIDA',1,NULL,'Venta VTA-20260106-00003',3,'VENTA',650,'2026-01-06 19:40:00',2),
(30,'SALIDA',3,NULL,'Venta VTA-20260106-00003',3,'VENTA',85,'2026-01-06 19:40:00',2),

(16,'SALIDA',1,NULL,'Venta VTA-20260108-00004',4,'VENTA',3400,'2026-01-08 20:00:00',2),
(18,'SALIDA',1,NULL,'Venta VTA-20260108-00004',4,'VENTA',1100,'2026-01-08 20:00:00',2),

(13,'SALIDA',1,NULL,'Venta VTA-20260110-00005',5,'VENTA',2300,'2026-01-10 16:15:00',2),
(27,'SALIDA',10,NULL,'Venta VTA-20260110-00005',5,'VENTA',65,'2026-01-10 16:15:00',2),

(20,'SALIDA',2,NULL,'Venta VTA-20260112-00006',6,'VENTA',450,'2026-01-12 18:30:00',2),
(23,'SALIDA',2,NULL,'Venta VTA-20260112-00006',6,'VENTA',420,'2026-01-12 18:30:00',2),

(11,'SALIDA',1,NULL,'Venta VTA-20260115-00007',7,'VENTA',850,'2026-01-15 21:10:00',2),

(7,'SALIDA',2,NULL,'Venta VTA-20260118-00008',8,'VENTA',2200,'2026-01-18 13:45:00',2),
(29,'SALIDA',1,NULL,'Venta VTA-20260118-00008',8,'VENTA',1250,'2026-01-18 13:45:00',2),

(1,'SALIDA',1,NULL,'Venta VTA-20260120-00009',9,'VENTA',1450,'2026-01-20 10:05:00',2),

(2,'SALIDA',1,NULL,'Venta VTA-20260124-00010',10,'VENTA',9500,'2026-01-24 22:00:00',2),
(25,'SALIDA',2,NULL,'Venta VTA-20260124-00010',10,'VENTA',45,'2026-01-24 22:00:00',2),

(6,'SALIDA',1,NULL,'Venta VTA-20260202-00011',11,'VENTA',650,'2026-02-02 09:30:00',2),
(30,'SALIDA',4,NULL,'Venta VTA-20260202-00011',11,'VENTA',85,'2026-02-02 09:30:00',2),

(16,'SALIDA',1,NULL,'Venta VTA-20260204-00012',12,'VENTA',3400,'2026-02-04 15:20:00',2),
(18,'SALIDA',1,NULL,'Venta VTA-20260204-00012',12,'VENTA',1100,'2026-02-04 15:20:00',2),

(13,'SALIDA',1,NULL,'Venta VTA-20260206-00013',13,'VENTA',2300,'2026-02-06 17:55:00',2),
(27,'SALIDA',8,NULL,'Venta VTA-20260206-00013',13,'VENTA',65,'2026-02-06 17:55:00',2),

(20,'SALIDA',2,NULL,'Venta VTA-20260208-00014',14,'VENTA',450,'2026-02-08 20:45:00',2),
(23,'SALIDA',2,NULL,'Venta VTA-20260208-00014',14,'VENTA',420,'2026-02-08 20:45:00',2),

(11,'SALIDA',1,NULL,'Venta VTA-20260210-00015',15,'VENTA',850,'2026-02-10 12:10:00',2),

(7,'SALIDA',2,NULL,'Venta VTA-20260212-00016',16,'VENTA',2200,'2026-02-12 18:00:00',2),
(29,'SALIDA',1,NULL,'Venta VTA-20260212-00016',16,'VENTA',1250,'2026-02-12 18:00:00',2),

(1,'SALIDA',1,NULL,'Venta VTA-20260215-00017',17,'VENTA',1450,'2026-02-15 21:25:00',2),

(2,'SALIDA',1,NULL,'Venta VTA-20260218-00018',18,'VENTA',9500,'2026-02-18 11:40:00',2),
(25,'SALIDA',3,NULL,'Venta VTA-20260218-00018',18,'VENTA',45,'2026-02-18 11:40:00',2),

(6,'SALIDA',1,NULL,'Venta VTA-20260221-00019',19,'VENTA',650,'2026-02-21 14:50:00',2),
(30,'SALIDA',2,NULL,'Venta VTA-20260221-00019',19,'VENTA',85,'2026-02-21 14:50:00',2),

(16,'SALIDA',1,NULL,'Venta VTA-20260225-00020',20,'VENTA',3400,'2026-02-25 19:35:00',2),

-- MARZO (21–30)
(18,'SALIDA',1,NULL,'Venta VTA-20260301-00021',21,'VENTA',1100,'2026-03-01 10:00:00',2),
(13,'SALIDA',1,NULL,'Venta VTA-20260303-00022',22,'VENTA',2300,'2026-03-03 13:20:00',2),
(27,'SALIDA',6,NULL,'Venta VTA-20260305-00023',23,'VENTA',65,'2026-03-05 18:10:00',2),
(7,'SALIDA',1,NULL,'Venta VTA-20260307-00024',24,'VENTA',2200,'2026-03-07 20:50:00',2),
(29,'SALIDA',1,NULL,'Venta VTA-20260310-00025',25,'VENTA',1250,'2026-03-10 16:40:00',2),
(20,'SALIDA',2,NULL,'Venta VTA-20260312-00026',26,'VENTA',450,'2026-03-12 19:00:00',2),
(23,'SALIDA',2,NULL,'Venta VTA-20260315-00027',27,'VENTA',420,'2026-03-15 11:35:00',2),
(11,'SALIDA',1,NULL,'Venta VTA-20260318-00028',28,'VENTA',850,'2026-03-18 15:10:00',2),
(6,'SALIDA',1,NULL,'Venta VTA-20260322-00029',29,'VENTA',650,'2026-03-22 21:45:00',2),
(30,'SALIDA',3,NULL,'Venta VTA-20260326-00030',30,'VENTA',85,'2026-03-26 17:15:00',2),

-- ABRIL (31–40)
(1,'SALIDA',1,NULL,'Venta VTA-20260402-00031',31,'VENTA',1450,'2026-04-02 09:45:00',2),
(2,'SALIDA',1,NULL,'Venta VTA-20260404-00032',32,'VENTA',9500,'2026-04-04 13:50:00',2),
(25,'SALIDA',2,NULL,'Venta VTA-20260406-00033',33,'VENTA',45,'2026-04-06 18:25:00',2),
(16,'SALIDA',1,NULL,'Venta VTA-20260408-00034',34,'VENTA',3400,'2026-04-08 20:15:00',2),
(18,'SALIDA',1,NULL,'Venta VTA-20260410-00035',35,'VENTA',1100,'2026-04-10 12:40:00',2),
(13,'SALIDA',1,NULL,'Venta VTA-20260412-00036',36,'VENTA',2300,'2026-04-12 16:55:00',2),
(27,'SALIDA',5,NULL,'Venta VTA-20260415-00037',37,'VENTA',65,'2026-04-15 19:30:00',2),
(7,'SALIDA',2,NULL,'Venta VTA-20260418-00038',38,'VENTA',2200,'2026-04-18 21:00:00',2),
(29,'SALIDA',1,NULL,'Venta VTA-20260422-00039',39,'VENTA',1250,'2026-04-22 11:25:00',2),
(20,'SALIDA',2,NULL,'Venta VTA-20260426-00040',40,'VENTA',450,'2026-04-26 18:05:00',2),

-- MAYO (41–50)
(1,'SALIDA',1,NULL,'Venta VTA-20260501-00041',41,'VENTA',1450,'2026-05-01 12:15:00',2),
(2,'SALIDA',1,NULL,'Venta VTA-20260501-00042',42,'VENTA',9500,'2026-05-01 13:40:00',2),
(25,'SALIDA',4,NULL,'Venta VTA-20260502-00043',43,'VENTA',45,'2026-05-02 18:20:00',2),
(16,'SALIDA',1,NULL,'Venta VTA-20260503-00044',44,'VENTA',3400,'2026-05-03 20:10:00',2),
(18,'SALIDA',1,NULL,'Venta VTA-20260504-00045',45,'VENTA',1100,'2026-05-04 16:00:00',2),
(13,'SALIDA',1,NULL,'Venta VTA-20260505-00046',46,'VENTA',2300,'2026-05-05 21:30:00',2),
(27,'SALIDA',10,NULL,'Venta VTA-20260505-00047',47,'VENTA',65,'2026-05-05 22:00:00',2),
(7,'SALIDA',2,NULL,'Venta VTA-20260506-00048',48,'VENTA',2200,'2026-05-06 19:25:00',2),
(29,'SALIDA',1,NULL,'Venta VTA-20260508-00049',49,'VENTA',1250,'2026-05-08 12:30:00',2),
(20,'SALIDA',2,NULL,'Venta VTA-20260511-00050',50,'VENTA',450,'2026-05-11 20:30:00',2);

-- =========================================
-- MOVIMIENTOS GASTOS
-- =========================================

INSERT INTO movimientos_gastos
(id_gasto, monto, origen, id_caja, id_cuenta, fecha, id_usuario, observacion)
VALUES
(1,3500,'CUENTA',NULL,2,'2026-05-01 09:00:00',1,'Pago energía'),
(2,1800,'CUENTA',NULL,2,'2026-05-02 09:00:00',1,'Pago internet'),
(3,12000,'CUENTA',NULL,3,'2026-05-05 17:00:00',1,'Pago salario'),
(4,8500,'CUENTA',NULL,4,'2026-05-03 11:00:00',1,'Pago alquiler'),
(5,2200,'CAJA',5,NULL,'2026-05-10 13:00:00',1,'Publicidad Facebook');

-- =========================================
-- TRANSFERENCIAS CAJA → CUENTA
-- =========================================

INSERT INTO transferencias_caja_cuenta
(id_caja_origen, id_cuenta_destino, monto, concepto, id_usuario, fecha)
VALUES
(1,2,5000,'Depósito ventas día 1',1,'2026-05-01 22:10:00'),
(2,3,6500,'Depósito ventas día 2',1,'2026-05-02 22:15:00'),
(3,4,7200,'Depósito ventas día 3',1,'2026-05-03 22:05:00');

-- =========================================
-- MOVIMIENTOS CAJA
-- =========================================

INSERT INTO movimientos_caja
(id_caja, tipo_movimiento_caja, concepto_movimiento_caja, monto_movimiento_caja, fecha_movimiento_caja, id_usuario, id_transferencia, id_referencia, id_cuenta_destino)
VALUES
(1,'INGRESO','Venta VTA-20260501-00041',1755,'2026-05-01 12:15:00',2,NULL,41,NULL),
(1,'INGRESO','Venta VTA-20260501-00042',3388,'2026-05-01 13:40:00',2,NULL,42,NULL),
(1,'SALIDA','Transferencia bancaria a BAC',5000,'2026-05-01 22:10:00',1,1,NULL,2),
(2,'INGRESO','Venta VTA-20260502-00043',1150,'2026-05-02 18:20:00',2,NULL,43,NULL),
(2,'SALIDA','Transferencia bancaria a Lafise',6500,'2026-05-02 22:15:00',1,2,NULL,3),
(3,'INGRESO','Venta VTA-20260503-00044',5082,'2026-05-03 20:10:00',1,NULL,44,NULL),
(3,'SALIDA','Transferencia bancaria a Banpro',7200,'2026-05-03 22:05:00',1,3,NULL,4);

-- =========================================
-- MOVIMIENTOS CUENTAS
-- =========================================

INSERT INTO movimientos_cuentas
(id_cuenta, tipo_movimiento, monto, descripcion, fecha, id_usuario, id_transferencia) VALUES
-- Pagos de compras desde Cuenta Compras (id=6)
(6,'SALIDA',24860,'Pago compra COMP-0001 proveedor 1','2026-05-01 10:00:00',1,NULL),
(6,'SALIDA',40722,'Pago compra COMP-0002 proveedor 2','2026-05-02 11:30:00',1,NULL),
(6,'SALIDA',41250,'Pago compra COMP-0003 proveedor 3','2026-05-03 15:00:00',1,NULL),
(6,'SALIDA',13145,'Pago compra COMP-0004 proveedor 4','2026-05-04 09:20:00',1,NULL),
(6,'SALIDA',13068,'Pago compra COMP-0005 proveedor 5','2026-05-05 14:10:00',1,NULL),
-- Pagos de gastos
(2,'SALIDA',3500,'Gasto: Pago energía DISNORTE','2026-05-01 09:00:00',1,NULL),
(2,'SALIDA',1800,'Gasto: Pago internet Claro','2026-05-02 09:00:00',1,NULL),
(3,'SALIDA',12000,'Gasto: Pago salario cajero','2026-05-05 17:00:00',1,NULL),
(4,'SALIDA',8500,'Gasto: Pago alquiler local','2026-05-03 11:00:00',1,NULL),
-- Ingresos por transferencias desde cajas
(2,'INGRESO',5000,'Transferencia desde Caja 1','2026-05-01 22:10:00',1,1),
(3,'INGRESO',6500,'Transferencia desde Caja 2','2026-05-02 22:15:00',1,2),
(4,'INGRESO',7200,'Transferencia desde Caja 3','2026-05-03 22:05:00',1,3);