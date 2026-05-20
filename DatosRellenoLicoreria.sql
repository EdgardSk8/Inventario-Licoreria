-- =========================================
-- CATEGORIAS
-- =========================================

INSERT INTO categoria
(nombre_categoria, descripcion_categoria, estado_categoria)
VALUES
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
-- UBICACIONES
-- =========================================

INSERT INTO ubicaciones
(nombre_ubicacion, descripcion_ubicacion, estado_ubicacion)
VALUES
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
-- CUENTAS
-- =========================================

INSERT INTO cuentas
(nombre_cuenta, tipo_cuenta, descripcion, saldo_actual, estado, created_at, updated_at)
VALUES
('Caja General','EFECTIVO','Caja principal del negocio',5000,1,NOW(),NOW()),
('BAC Credomatic','BANCARIA','Cuenta BAC principal',120000,1,NOW(),NOW()),
('Lafise','BANCARIA','Cuenta Lafise operaciones',65000,1,NOW(),NOW()),
('Banpro','BANCARIA','Cuenta Banpro ventas',98000,1,NOW(),NOW()),
('Caja Gastos','EFECTIVO','Caja destinada a gastos operativos y administrativos',12000,1,NOW(),NOW()),
('Cuenta Compras','EFECTIVO','Fondos destinados para compras e inventario',30000,1,NOW(),NOW());

-- =========================================
-- CAJAS
-- =========================================

INSERT INTO cajas
(fecha_apertura, fecha_cierre, monto_inicial, monto_final, monto_teorico, monto_real, diferencia, estado_caja, id_usuario)
VALUES
('2026-05-01 08:00:00','2026-05-01 22:00:00',5000,12500,12450,12500,50,0,1),
('2026-05-02 08:00:00','2026-05-02 22:00:00',5000,13800,13800,13750,-50,0,2),
('2026-05-03 08:00:00','2026-05-03 22:00:00',5000,15200,15150,15200,50,0,2),
('2026-05-04 08:00:00','2026-05-04 22:00:00',5000,16700,16650,16700,50,0,1),
('2026-05-05 08:00:00','2026-05-04 22:00:00',5000,16700,16650,16700,50,0,1);

-- =========================================
-- PRODUCTOS (30)
-- =========================================

INSERT INTO productos
(nombre_producto, descripcion_producto, id_categoria, id_impuesto, id_ubicacion, imagen_producto, precio_compra, precio_venta, stock_actual, estado_producto)
VALUES
('Johnnie Walker Black Label','Whisky escocés 750ml',1,2,1,'ImagenProducto1.png',950,1450,45,1),
('Johnnie Walker Blue Label','Whisky premium 750ml',1,2,1,'ImagenProducto2.png',6800,9500,8,1),
('Chivas Regal 12','Whisky escocés 750ml',1,2,1,'ImagenProducto3.png',1100,1650,32,1),
('Jack Daniels Old No.7','Whisky Tennessee 750ml',1,2,2,'ImagenProducto4.png',850,1350,40,1),
('Ballantines Finest','Whisky escocés 750ml',1,2,2,'ImagenProducto5.png',700,1100,38,1),

('Flor de Caña 7 años','Ron añejo 750ml',2,2,3,'ImagenProducto6.png',420,650,60,1),
('Flor de Caña 18 años','Ron premium 750ml',2,2,3,'ImagenProducto7.png',1450,2200,18,1),
('Bacardi Carta Blanca','Ron blanco 750ml',2,2,3,'ImagenProducto8.png',380,580,55,1),
('Zacapa 23','Ron premium Guatemala',2,2,3,'ImagenProducto9.png',1800,2800,14,1),
('Captain Morgan','Ron especiado 750ml',2,2,3,'ImagenProducto10.png',450,700,35,1),

('Absolut Vodka','Vodka sueco 750ml',3,2,4,'ImagenProducto11.png',520,850,44,1),
('Smirnoff Red','Vodka clásico 750ml',3,2,4,'ImagenProducto12.png',350,550,52,1),
('Grey Goose','Vodka premium francés',3,2,4,'ImagenProducto13.png',1500,2300,12,1),
('Ciroc','Vodka premium 750ml',3,2,4,'ImagenProducto14.png',1750,2600,10,1),

('Jose Cuervo Especial','Tequila reposado',4,2,4,'ImagenProducto15.png',600,950,25,1),
('Don Julio Reposado','Tequila premium',4,2,4,'ImagenProducto16.png',2200,3400,9,1),
('Patron Silver','Tequila premium',4,2,4,'ImagenProducto17.png',2400,3600,7,1),

('Bombay Sapphire','Ginebra premium',5,2,4,'ImagenProducto18.png',720,1100,20,1),
('Tanqueray London Dry','Ginebra importada',5,2,4,'ImagenProducto19.png',780,1200,16,1),

('Casillero del Diablo','Vino tinto chileno',6,1,5,'ImagenProducto20.png',280,450,30,1),
('Santa Rita 120','Vino tinto',6,1,5,'ImagenProducto21.png',240,390,28,1),
('Concha y Toro Reservado','Vino tinto',6,1,5,'ImagenProducto22.png',300,480,26,1),

('Gato Negro Blanco','Vino blanco',7,1,5,'ImagenProducto23.png',260,420,20,1),
('Frontera Chardonnay','Vino blanco',7,1,5,'ImagenProducto24.png',290,460,19,1),

('Toña','Cerveza nacional lata',8,2,7,'ImagenProducto25.png',28,45,300,1),
('Victoria Frost','Cerveza nacional',8,2,7,'ImagenProducto26.png',30,48,280,1),
('Heineken','Cerveza importada',8,2,8,'ImagenProducto27.png',42,65,180,1),
('Corona Extra','Cerveza mexicana',8,2,8,'ImagenProducto28.png',45,70,150,1),

('Baileys Irish Cream','Licor cremoso',9,2,6,'ImagenProducto29.png',780,1250,15,1),
('Red Bull','Bebida energética',10,1,7,'ImagenProducto30.png',55,85,200,1);

-- =========================================
-- COMPRAS
-- =========================================

INSERT INTO compras
(numero_factura_compra, id_proveedor, id_usuario, fecha_compra, subtotal_compra, descuento_compra, impuesto_compra, total_compra, estado_compra, id_caja, id_cuenta, id_metodo_pago, id_tipo_factura)
VALUES
('COMP-0001',1,1,'2026-05-01 10:00:00',25000,0,2500,27500,1,1,2,3,1),
('COMP-0002',2,1,'2026-05-02 11:30:00',18500,500,1800,19800,1,2,2,2,1),
('COMP-0003',3,1,'2026-05-03 15:00:00',42000,0,4200,46200,1,3,3,3,1),
('COMP-0004',4,2,'2026-05-04 09:20:00',12000,0,1200,13200,1,4,1,1,1),
('COMP-0005',5,2,'2026-05-05 14:10:00',9800,0,980,10780,1,5,4,2,1);

-- =========================================
-- DETALLE COMPRAS
-- =========================================

INSERT INTO detalle_compras
(id_compra, id_producto, cantidad_compra, precio_unitario_compra, subtotal_detalle_compra)
VALUES
(1,1,12,950,11400),
(1,6,20,420,8400),
(1,25,100,28,2800),

(2,2,4,6800,27200),
(2,11,15,520,7800),
(2,27,60,42,2520),

(3,7,10,1450,14500),
(3,13,8,1500,12000),
(3,16,5,2200,11000),

(4,20,20,280,5600),
(4,21,15,240,3600),
(4,30,50,55,2750),

(5,26,120,30,3600),
(5,28,80,45,3600),
(5,29,6,780,4680);

-- =========================================
-- VENTAS
-- =========================================

INSERT INTO ventas
(numero_factura, fecha_venta, id_cliente, id_usuario, id_caja, id_cuenta, subtotal_venta, impuesto_venta, total_venta, estado_venta, id_metodo_pago, monto_recibido, vuelto, moneda)
VALUES

-- ENERO
('VTA-20260103-00001','2026-01-03 11:20:00',2,2,1,1,1200,120,1320,1,1,1500,180,'NIO'),
('VTA-20260105-00002','2026-01-05 14:10:00',3,1,1,2,2500,250,2750,1,2,3000,250,'NIO'),
('VTA-20260106-00003','2026-01-06 19:40:00',4,2,2,1,1800,180,1980,1,1,2000,20,'NIO'),
('VTA-20260108-00004','2026-01-08 20:00:00',5,2,2,2,3400,340,3740,1,3,4000,260,'NIO'),
('VTA-20260110-00005','2026-01-10 16:15:00',6,1,3,3,950,95,1045,1,1,1200,155,'NIO'),
('VTA-20260112-00006','2026-01-12 18:30:00',7,2,3,1,4200,420,4620,1,2,5000,380,'NIO'),
('VTA-20260115-00007','2026-01-15 21:10:00',8,2,4,2,5100,510,5610,1,4,6000,390,'NIO'),
('VTA-20260118-00008','2026-01-18 13:45:00',9,1,4,1,2750,275,3025,1,1,3500,475,'NIO'),
('VTA-20260120-00009','2026-01-20 10:05:00',2,2,5,3,1600,160,1760,1,2,2000,240,'NIO'),
('VTA-20260124-00010','2026-01-24 22:00:00',3,1,5,4,3900,390,4290,1,3,4500,210,'NIO'),

-- FEBRERO
('VTA-20260202-00011','2026-02-02 09:30:00',4,2,1,1,2100,210,2310,1,1,2500,190,'NIO'),
('VTA-20260204-00012','2026-02-04 15:20:00',5,1,1,2,3200,320,3520,1,2,4000,480,'NIO'),
('VTA-20260206-00013','2026-02-06 17:55:00',6,2,2,1,1450,145,1595,1,1,2000,405,'NIO'),
('VTA-20260208-00014','2026-02-08 20:45:00',7,2,2,2,4800,480,5280,1,4,5500,220,'NIO'),
('VTA-20260210-00015','2026-02-10 12:10:00',8,1,3,3,2600,260,2860,1,3,3000,140,'NIO'),
('VTA-20260212-00016','2026-02-12 18:00:00',9,2,3,1,5300,530,5830,1,1,6000,170,'NIO'),
('VTA-20260215-00017','2026-02-15 21:25:00',2,1,4,2,1750,175,1925,1,2,2000,75,'NIO'),
('VTA-20260218-00018','2026-02-18 11:40:00',3,2,4,1,2950,295,3245,1,1,3500,255,'NIO'),
('VTA-20260221-00019','2026-02-21 14:50:00',4,2,5,3,4100,410,4510,1,3,5000,490,'NIO'),
('VTA-20260225-00020','2026-02-25 19:35:00',5,1,5,4,1350,135,1485,1,4,1500,15,'NIO'),

-- MARZO
('VTA-20260301-00021','2026-03-01 10:00:00',6,2,1,1,2200,220,2420,1,1,2500,80,'NIO'),
('VTA-20260303-00022','2026-03-03 13:20:00',7,1,1,2,3600,360,3960,1,2,4000,40,'NIO'),
('VTA-20260305-00023','2026-03-05 18:10:00',8,2,2,1,4900,490,5390,1,3,5500,110,'NIO'),
('VTA-20260307-00024','2026-03-07 20:50:00',9,2,2,2,1850,185,2035,1,1,2500,465,'NIO'),
('VTA-20260310-00025','2026-03-10 16:40:00',2,1,3,3,2750,275,3025,1,2,3200,175,'NIO'),
('VTA-20260312-00026','2026-03-12 19:00:00',3,2,3,1,5100,510,5610,1,4,6000,390,'NIO'),
('VTA-20260315-00027','2026-03-15 11:35:00',4,1,4,2,1450,145,1595,1,1,2000,405,'NIO'),
('VTA-20260318-00028','2026-03-18 15:10:00',5,2,4,1,3900,390,4290,1,3,4500,210,'NIO'),
('VTA-20260322-00029','2026-03-22 21:45:00',6,2,5,3,2800,280,3080,1,2,3500,420,'NIO'),
('VTA-20260326-00030','2026-03-26 17:15:00',7,1,5,4,1750,175,1925,1,1,2000,75,'NIO'),

-- ABRIL
('VTA-20260402-00031','2026-04-02 09:45:00',8,2,1,1,2400,240,2640,1,1,3000,360,'NIO'),
('VTA-20260404-00032','2026-04-04 13:50:00',9,1,1,2,4200,420,4620,1,2,5000,380,'NIO'),
('VTA-20260406-00033','2026-04-06 18:25:00',2,2,2,1,1600,160,1760,1,3,2000,240,'NIO'),
('VTA-20260408-00034','2026-04-08 20:15:00',3,2,2,2,5200,520,5720,1,4,6000,280,'NIO'),
('VTA-20260410-00035','2026-04-10 12:40:00',4,1,3,3,3100,310,3410,1,1,3500,90,'NIO'),
('VTA-20260412-00036','2026-04-12 16:55:00',5,2,3,1,1950,195,2145,1,2,2500,355,'NIO'),
('VTA-20260415-00037','2026-04-15 19:30:00',6,1,4,2,4600,460,5060,1,3,5500,440,'NIO'),
('VTA-20260418-00038','2026-04-18 21:00:00',7,2,4,1,2850,285,3135,1,1,3500,365,'NIO'),
('VTA-20260422-00039','2026-04-22 11:25:00',8,2,5,3,3750,375,4125,1,2,4500,375,'NIO'),
('VTA-20260426-00040','2026-04-26 18:05:00',9,1,5,4,1400,140,1540,1,4,2000,460,'NIO'),

-- MAYO
('VTA-20260501-00041','2026-05-01 12:15:00',2,2,1,1,1500,150,1650,1,1,2000,350,'NIO'),
('VTA-20260501-00042','2026-05-01 13:40:00',3,2,1,2,2800,280,3080,1,2,3080,0,'NIO'),
('VTA-20260502-00043','2026-05-02 18:20:00',4,2,2,2,950,95,1045,1,1,1200,155,'NIO'),
('VTA-20260503-00044','2026-05-03 20:10:00',5,1,3,3,4200,420,4620,1,3,4620,0,'NIO'),
('VTA-20260504-00045','2026-05-04 16:00:00',6,2,4,1,3600,360,3960,1,1,4000,40,'NIO'),
('VTA-20260505-00046','2026-05-05 21:30:00',7,2,5,4,1850,185,2035,1,2,2035,0,'NIO'),
('VTA-20260505-00047','2026-05-05 22:00:00',8,1,5,2,920,92,1012,1,4,1012,0,'NIO'),
('VTA-20260506-00048','2026-05-06 19:25:00',9,2,5,1,5400,540,5940,1,1,6000,60,'NIO'),
('VTA-20260508-00049','2026-05-08 12:30:00',6,2,4,1,2750,275,3025,1,2,3200,175,'NIO'),
('VTA-20260511-00050','2026-05-11 20:30:00',5,2,4,1,4800,480,5280,1,2,6000,720,'NIO');

-- =========================================
-- DETALLE VENTAS
-- =========================================

INSERT INTO detalle_ventas
(id_venta, id_producto, cantidad_venta, precio_unitario_venta, subtotal_detalle_venta, porcentaje_impuesto, monto_impuesto)
VALUES

-- VTA-01
(1,1,1,1450,1450,10,145),

-- VTA-02
(2,2,1,9500,9500,10,950),
(2,25,4,45,180,10,18),

-- VTA-03
(3,6,1,650,650,10,65),
(3,30,3,85,255,0,0),

-- VTA-04
(4,16,1,3400,3400,10,340),
(4,18,1,1100,1100,10,110),

-- VTA-05
(5,13,1,2300,2300,10,230),
(5,27,10,65,650,10,65),

-- VTA-06
(6,20,2,450,900,15,135),
(6,23,2,420,840,15,126),

-- VTA-07
(7,11,1,850,850,10,85),

-- VTA-08
(8,7,2,2200,4400,10,440),
(8,29,1,1250,1250,10,125),

-- VTA-09
(9,1,1,1450,1450,10,145),

-- VTA-10
(10,2,1,9500,9500,10,950),
(10,25,2,45,90,10,9),

-- VTA-11
(11,6,1,650,650,10,65),
(11,30,4,85,340,0,0),

-- VTA-12
(12,16,1,3400,3400,10,340),
(12,18,1,1100,1100,10,110),

-- VTA-13
(13,13,1,2300,2300,10,230),
(13,27,8,65,520,10,52),

-- VTA-14
(14,20,2,450,900,15,135),
(14,23,2,420,840,15,126),

-- VTA-15
(15,11,1,850,850,10,85),

-- VTA-16
(16,7,2,2200,4400,10,440),
(16,29,1,1250,1250,10,125),

-- VTA-17
(17,1,1,1450,1450,10,145),

-- VTA-18
(18,2,1,9500,9500,10,950),
(18,25,3,45,135,10,14),

-- VTA-19
(19,6,1,650,650,10,65),
(19,30,2,85,170,0,0),

-- VTA-20
(20,16,1,3400,3400,10,340),

-- VTA-21
(21,18,1,1100,1100,10,110),

-- VTA-22
(22,13,1,2300,2300,10,230),

-- VTA-23
(23,27,6,65,390,10,39),

-- VTA-24
(24,7,1,2200,2200,10,220),

-- VTA-25
(25,29,1,1250,1250,10,125),

-- VTA-26
(26,20,2,450,900,15,135),

-- VTA-27
(27,23,2,420,840,15,126),

-- VTA-28
(28,11,1,850,850,10,85),

-- VTA-29
(29,6,1,650,650,10,65),

-- VTA-30
(30,30,3,85,255,0,0),

-- VTA-31
(31,1,1,1450,1450,10,145),

-- VTA-32
(32,2,1,9500,9500,10,950),

-- VTA-33
(33,25,2,45,90,10,9),

-- VTA-34
(34,16,1,3400,3400,10,340),

-- VTA-35
(35,18,1,1100,1100,10,110),

-- VTA-36
(36,13,1,2300,2300,10,230),

-- VTA-37
(37,27,5,65,325,10,33),

-- VTA-38
(38,7,2,2200,4400,10,440),

-- VTA-39
(39,29,1,1250,1250,10,125),

-- VTA-40
(40,20,2,450,900,15,135),

-- VTA-41
(41,1,1,1450,1450,10,145),

-- VTA-42
(42,2,1,9500,9500,10,950),

-- VTA-43
(43,25,4,45,180,10,18),

-- VTA-44
(44,16,1,3400,3400,10,340),

-- VTA-45
(45,18,1,1100,1100,10,110),

-- VTA-46
(46,13,1,2300,2300,10,230),

-- VTA-47
(47,27,10,65,650,10,65),

-- VTA-48
(48,7,2,2200,4400,10,440),

-- VTA-49
(49,29,1,1250,1250,10,125),

-- VTA-50
(50,20,2,450,900,15,135);

-- =========================================
-- MOVIMIENTOS INVENTARIO (50)
-- =========================================
INSERT INTO movimientos_inventario
(id_producto, tipo_movimiento, cantidad_movimiento, stock_resultante, motivo_movimiento, id_referencia, tipo_referencia, precio_unitario, fecha_movimiento, id_usuario)
VALUES

-- ENERO
(1,'ENTRADA',10,55,'Compra proveedor',1,'COMPRA',950,'2026-01-03 09:00:00',1),
(1,'SALIDA',2,53,'Venta whisky',1,'VENTA',1450,'2026-01-03 14:30:00',2),

(6,'ENTRADA',20,80,'Ingreso ron',2,'COMPRA',420,'2026-01-05 10:00:00',1),
(6,'SALIDA',4,76,'Venta ron Flor',2,'VENTA',650,'2026-01-05 19:15:00',2),

(11,'ENTRADA',12,56,'Compra vodka',3,'COMPRA',520,'2026-01-08 11:00:00',1),
(11,'SALIDA',2,54,'Venta vodka',3,'VENTA',850,'2026-01-08 18:20:00',2),

(15,'ENTRADA',8,33,'Ingreso tequila',4,'COMPRA',600,'2026-01-10 09:30:00',1),
(15,'SALIDA',2,31,'Venta tequila',4,'VENTA',950,'2026-01-10 20:00:00',2),

(25,'ENTRADA',80,380,'Compra Toña',5,'COMPRA',28,'2026-01-12 08:45:00',1),
(25,'SALIDA',15,365,'Venta cerveza',5,'VENTA',45,'2026-01-12 21:00:00',2),

-- FEBRERO
(2,'ENTRADA',5,13,'Ingreso whisky premium',6,'COMPRA',6800,'2026-02-02 10:00:00',1),
(2,'SALIDA',1,12,'Venta premium',6,'VENTA',9500,'2026-02-02 19:40:00',2),

(8,'ENTRADA',16,70,'Compra ron',7,'COMPRA',380,'2026-02-04 09:20:00',1),
(8,'SALIDA',5,65,'Venta ron cliente',7,'VENTA',580,'2026-02-04 20:10:00',2),

(12,'ENTRADA',18,70,'Ingreso Smirnoff',8,'COMPRA',350,'2026-02-06 11:10:00',1),
(12,'SALIDA',4,66,'Venta Smirnoff',8,'VENTA',550,'2026-02-06 18:45:00',2),

(18,'ENTRADA',10,31,'Compra ginebra',9,'COMPRA',720,'2026-02-08 10:15:00',1),
(18,'SALIDA',2,29,'Venta ginebra',9,'VENTA',1100,'2026-02-08 21:20:00',2),

(26,'ENTRADA',100,390,'Ingreso Victoria',10,'COMPRA',30,'2026-02-10 08:00:00',1),
(26,'SALIDA',20,370,'Venta Victoria',10,'VENTA',48,'2026-02-10 22:00:00',2),

-- MARZO
(3,'ENTRADA',8,40,'Reposición whisky',11,'COMPRA',1100,'2026-03-01 09:00:00',1),
(3,'SALIDA',2,38,'Venta whisky',11,'VENTA',1650,'2026-03-01 18:00:00',2),

(9,'ENTRADA',4,18,'Ingreso Zacapa',12,'COMPRA',1800,'2026-03-03 10:40:00',1),
(9,'SALIDA',1,17,'Venta Zacapa',12,'VENTA',2800,'2026-03-03 20:15:00',2),

(14,'ENTRADA',6,16,'Compra Ciroc',13,'COMPRA',1750,'2026-03-05 11:00:00',1),
(14,'SALIDA',2,14,'Venta Ciroc',13,'VENTA',2600,'2026-03-05 21:40:00',2),

(20,'ENTRADA',15,45,'Ingreso vino',14,'COMPRA',280,'2026-03-07 09:30:00',1),
(20,'SALIDA',3,42,'Venta vino',14,'VENTA',450,'2026-03-07 19:00:00',2),

(27,'ENTRADA',50,220,'Compra Heineken',15,'COMPRA',42,'2026-03-10 08:50:00',1),
(27,'SALIDA',12,208,'Venta Heineken',15,'VENTA',65,'2026-03-10 22:10:00',2),

-- ABRIL
(4,'ENTRADA',12,54,'Compra proveedor',16,'COMPRA',850,'2026-04-02 10:00:00',1),
(4,'SALIDA',3,51,'Venta POS',16,'VENTA',1350,'2026-04-02 18:30:00',2),

(10,'ENTRADA',10,45,'Ingreso licor',17,'COMPRA',450,'2026-04-04 11:00:00',1),
(10,'SALIDA',2,43,'Venta cliente',17,'VENTA',700,'2026-04-04 20:10:00',2),

(16,'ENTRADA',4,15,'Compra Don Julio',18,'COMPRA',2200,'2026-04-06 09:40:00',1),
(16,'SALIDA',1,14,'Venta Don Julio',18,'VENTA',3400,'2026-04-06 21:20:00',2),

(22,'ENTRADA',10,36,'Ingreso vino',19,'COMPRA',300,'2026-04-08 10:30:00',1),
(22,'SALIDA',3,33,'Venta vino',19,'VENTA',480,'2026-04-08 19:45:00',2),

(28,'ENTRADA',70,220,'Compra Corona',20,'COMPRA',45,'2026-04-10 08:20:00',1),
(28,'SALIDA',10,210,'Venta Corona',20,'VENTA',70,'2026-04-10 22:00:00',2),

-- MAYO
(5,'ENTRADA',20,58,'Ingreso inventario',21,'COMPRA',700,'2026-05-02 11:00:00',1),
(5,'SALIDA',4,54,'Venta mostrador',21,'VENTA',1100,'2026-05-03 21:00:00',2),

(7,'ENTRADA',10,28,'Ingreso premium',22,'COMPRA',1450,'2026-05-03 15:00:00',1),
(7,'SALIDA',2,26,'Venta premium',22,'VENTA',2200,'2026-05-06 19:25:00',2),

(13,'ENTRADA',8,20,'Ingreso Grey Goose',23,'COMPRA',1500,'2026-05-03 15:00:00',1),
(13,'SALIDA',1,19,'Venta premium',23,'VENTA',2300,'2026-05-04 16:00:00',2),

(17,'ENTRADA',4,11,'Ingreso Patron',24,'COMPRA',2400,'2026-05-03 15:00:00',1),
(17,'SALIDA',1,10,'Venta Patron',24,'VENTA',3600,'2026-05-05 18:30:00',2),

(21,'ENTRADA',15,43,'Ingreso vino',25,'COMPRA',240,'2026-05-04 09:20:00',1),
(21,'SALIDA',4,39,'Venta vino',25,'VENTA',390,'2026-05-04 20:00:00',2),

(23,'ENTRADA',10,29,'Ingreso vino blanco',26,'COMPRA',260,'2026-05-05 14:10:00',1),
(23,'SALIDA',2,27,'Venta vino blanco',26,'VENTA',420,'2026-05-05 21:30:00',2),

(24,'ENTRADA',10,29,'Compra Chardonnay',27,'COMPRA',290,'2026-05-05 14:10:00',1),
(24,'SALIDA',1,28,'Venta Chardonnay',27,'VENTA',460,'2026-05-06 19:25:00',2),

(29,'ENTRADA',6,21,'Ingreso Baileys',28,'COMPRA',780,'2026-05-05 14:10:00',1),
(29,'SALIDA',1,20,'Venta Baileys',28,'VENTA',1250,'2026-05-06 19:25:00',2),

(30,'ENTRADA',50,250,'Compra Red Bull',29,'COMPRA',55,'2026-05-04 09:20:00',1),
(30,'SALIDA',8,242,'Venta energéticas',29,'VENTA',85,'2026-05-02 18:20:00',2),

(1,'AJUSTE',2,58,'Ajuste inventario positivo',NULL,'AJUSTE',950,'2026-05-07 09:00:00',1),
(25,'AJUSTE',-5,375,'Producto dañado',NULL,'AJUSTE',28,'2026-05-07 09:10:00',1);

-- =========================================
-- GASTOS
-- =========================================

INSERT INTO gastos
(id_tipo_gasto, nombre_gasto, descripcion_gasto, estado_gasto, fecha_inicio, fecha_pago, proximo_pago, estado_pago, ultimo_pago)
VALUES
(1,'Pago de Energía','Factura mensual DISNORTE',1,'2026-01-01','2026-05-01','2026-06-01','PAGADO','2026-05-01'),
(1,'Internet Negocio','Servicio Claro Empresas',1,'2026-01-01','2026-05-02','2026-06-02','PAGADO','2026-05-02'),
(3,'Salario Cajero','Pago mensual cajero',1,'2026-01-01','2026-05-05','2026-06-05','PAGADO','2026-05-05'),
(12,'Alquiler Local','Renta mensual',1,'2026-01-01','2026-05-03','2026-06-03','PAGADO','2026-05-03'),
(8,'Publicidad Facebook','Campaña redes sociales',1,'2026-05-01','2026-05-10','2026-06-10','PAGADO','2026-05-10');

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
-- TRANSFERENCIAS
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
(1,'INGRESO','Venta FAC-0001',1650,'2026-05-01 12:15:00',2,NULL,1,NULL),
(1,'SALIDA','Transferencia bancaria',5000,'2026-05-01 22:10:00',1,1,NULL,2),
(2,'INGRESO','Venta FAC-0003',1045,'2026-05-02 18:20:00',2,NULL,3,NULL),
(2,'SALIDA','Transferencia bancaria',6500,'2026-05-02 22:15:00',1,2,NULL,3),
(3,'INGRESO','Venta FAC-0004',4620,'2026-05-03 20:10:00',1,NULL,4,NULL),
(3,'SALIDA','Transferencia bancaria',7200,'2026-05-03 22:05:00',1,3,NULL,4);

-- =========================================
-- MOVIMIENTOS CUENTAS
-- =========================================

INSERT INTO movimientos_cuentas
(id_cuenta, tipo_movimiento, monto, descripcion, fecha, id_usuario, id_transferencia)
VALUES
(2,'INGRESO',5000,'Transferencia caja día 1','2026-05-01 22:10:00',1,1),
(3,'INGRESO',6500,'Transferencia caja día 2','2026-05-02 22:15:00',1,2),
(4,'INGRESO',7200,'Transferencia caja día 3','2026-05-03 22:05:00',1,3),
(2,'SALIDA',3500,'Pago energía','2026-05-01 09:00:00',1,NULL),
(3,'SALIDA',12000,'Pago salario','2026-05-05 17:00:00',1,NULL);

-- =========================================
-- DEVOLUCIONES
-- =========================================

INSERT INTO devoluciones
(id_venta, id_producto, id_usuario, cantidad, monto, motivo, fecha)
VALUES
(5,27,1,2,130,'Cliente recibió producto equivocado','2026-05-05 10:00:00'),
(6,20,2,1,450,'Botella dañada','2026-05-06 15:00:00');