
-- TABLA USUARIOS
CREATE TABLE usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    correo TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- TABLA CATEGORIAS
CREATE TABLE categorias (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL
);

-- TABLA PRODUCTOS
CREATE TABLE productos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    categoria_id INTEGER,
    titulo TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    precio REAL NOT NULL,
    precio_anterior REAL,
    descuento TEXT,
    stock INTEGER DEFAULT 0,
    imagen TEXT,
    meses TEXT,
    envio TEXT,
    vendidos INTEGER DEFAULT 0,
    ubicacion TEXT,
    FOREIGN KEY (categoria_id)
    REFERENCES categorias(id)
);

-- TABLA CARRITO
CREATE TABLE carrito (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    usuario_id INTEGER,
    producto_id INTEGER,
    cantidad INTEGER DEFAULT 1,
    subtotal REAL,
    estado TEXT DEFAULT 'carrito',
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id)
    REFERENCES usuarios(id),
    FOREIGN KEY (producto_id)
    REFERENCES productos(id)
);

-- CATEGORIAS
INSERT INTO categorias(nombre)
VALUES('Celulares'),('Laptops'),('Accesorios');

-- PRODUCTOS
INSERT INTO productos
(categoria_id,titulo,descripcion,precio,precio_anterior,descuento,stock,imagen,meses,envio,vendidos,ubicacion)
VALUES
(1,'Samsung Galaxy S24 Ultra 256GB','Pantalla AMOLED 120Hz, Snapdragon 8 Gen 3 y cámara de 200MP.',13999,29999,'53% OFF',20,'../img/p1.webp','15 meses sin intereses','Llega gratis mañana',120,'San Luis Potosí'),
(1,'iPhone 15 Pro Max 256GB','Procesador A17 Pro, titanio y cámara avanzada para fotografía profesional.',25999,28999,'10% OFF',12,'../img/p2.webp','18 meses sin intereses','Envío gratis',95,'Ciudad de México'),
(1,'Xiaomi Redmi Note 13 Pro','Celular con gran batería, pantalla AMOLED y cámara de alta resolución.',6999,7999,'12% OFF',35,'../img/p3.webp','12 meses sin intereses','Llega mañana',210,'Guadalajara'),
(2,'Laptop HP Victus Ryzen 7','Laptop gamer con RTX 4050 y 16GB RAM.',21999,24999,'11% OFF',8,'../img/p4.webp','18 meses sin intereses','Envío gratis',40,'Monterrey'),
(2,'MacBook Air M2','Laptop ultradelgada con chip Apple M2 y 8GB RAM.',24999,27999,'8% OFF',10,'../img/p5.webp','24 meses sin intereses','FULL envío gratis',60,'Ciudad de México'),
(2,'Lenovo IdeaPad Gaming 3','Laptop para gaming y programación con Ryzen 5.',17999,19999,'10% OFF',14,'../img/p6.webp','15 meses sin intereses','Envío gratis',33,'Puebla'),
(3,'Audífonos Sony WH-1000XM5','Cancelación de ruido premium y sonido envolvente.',6999,7999,'13% OFF',18,'../img/p7.webp','12 meses sin intereses','FULL envío gratis',150,'Querétaro'),
(3,'Mouse Logitech G502','Mouse gamer ergonómico con iluminación RGB.',1299,1599,'18% OFF',50,'../img/p8.webp','6 meses sin intereses','Llega mañana',320,'León'),
(3,'Teclado Mecánico Redragon','Teclado RGB mecánico para gaming y productividad.',999,1399,'28% OFF',45,'../img/p9.webp','6 meses sin intereses','Envío gratis',280,'Toluca'),
(1,'Motorola Edge 50 Fusion','Pantalla OLED y excelente rendimiento para multitarea.',8999,10999,'18% OFF',25,'../img/p10.webp','12 meses sin intereses','FULL envío gratis',75,'Aguascalientes'),
(2,'ASUS TUF Gaming F15','Laptop gamer Intel Core i7 con RTX 4060.',26999,30999,'12% OFF',6,'../img/p11.webp','24 meses sin intereses','Envío gratis',22,'Monterrey'),
(3,'Monitor Samsung 27 pulgadas','Monitor Full HD ideal para oficina y gaming.',3499,4299,'19% OFF',28,'../img/p12.webp','9 meses sin intereses','Llega mañana',110,'San Luis Potosí'),
(1,'Huawei Nova 12i','Smartphone con gran batería y carga rápida.',5999,6999,'14% OFF',30,'../img/p13.webp','9 meses sin intereses','Envío gratis',55,'Mérida'),
(2,'Dell Inspiron 15','Laptop para oficina y estudiantes con SSD de 512GB.',15499,17999,'13% OFF',16,'../img/p14.webp','12 meses sin intereses','FULL envío gratis',48,'Cancún'),
(3,'Smartwatch Xiaomi Watch 2','Reloj inteligente con monitoreo de salud y GPS.',2499,3299,'24% OFF',40,'../img/p15.webp','6 meses sin intereses','Llega gratis mañana',170,'Guadalajara');