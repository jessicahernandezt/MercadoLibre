<?php

session_start();

include("conexion.php");

$id = $_GET['id'];

$query = "SELECT * FROM productos WHERE id = $id";

$resultado = $db->query($query);

$producto = $resultado->fetchArray();

?>

<!DOCTYPE html>
<html lang="es">
<!-- Encabezado  -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles-producto.css">
    <title>Mercado Libre</title>
</head>
<!-- Cuerpo de la pagina -->
<script>

function actualizarContador(){

    fetch("contador_carrito.php")

    .then(res => res.text())

    .then(data => {

        document.getElementById(
            "contador-carrito"
        ).textContent = data;

    });

}

actualizarContador();

</script>
<body>
    <header class="header">

        <!-- Fila superior -->
        <div class="header-top">

            <div class="logo">
                <img src="../img/mercado-libre-logo.png" alt="Logo Mercado Libre">
            </div>

            <div class="buscador">
                <form>
                    <input type="text" placeholder="Buscar productos, marcas y más...">
                    <button type="submit">
                        <img src="../img/lupa.png" alt="Buscar">
                    </button>
                </form>
            </div>


            <img src="../img/002.webp" alt="Logo Mercado Libre" class="img-banner">

        </div>

        </div>

        <!-- Barra de navegación -->
        <nav class="nav">

            <ul class="menu-left">
                <li><a href="catalogo.php">Catalogo</a></li>
                <li><a href="#">Ofertas</a></li>
                <li><a href="#">Cupones</a></li>
                <li><a href="#">Supermercado</a></li>
                <li><a href="#">Moda</a></li>
                <li><a href="#">Mercado Play</a></li>
                <li><a href="#">Vender</a></li>
                <li><a href="#">Ayuda</a></li>
            </ul>

            <ul class="menu-right">
                <li><a href="register.php">Crea tu cuenta</a></li>
                <li><a href="login.php">Ingresa</a></li>
                <li><a href="#">Mis compras</a></li>
                <li class="carrito-icono">
                    <a href="carrito.php">
                        <img src="../img/shopping-cart-empty-side-view_34568.png" class="img-carrito">
                        <span id="contador-carrito" class="contador">0</span>
                    </a>
                </li>
            </ul>

        </nav>

    </header>


<main class="contenedor-producto">

    <div class="galeria">

        <img src="../img/<?php echo $producto['imagen']; ?>">

    </div>

    <div class="info-producto">

        <h1 class="titulo">

            <?php echo $producto['titulo']; ?>

        </h1>

        <p class="precio-anterior">

            $<?php echo number_format($producto['precio_anterior']); ?>

        </p>

        <p class="precio">

            $<?php echo number_format($producto['precio']); ?>

            <span class="descuento">

                <?php echo $producto['descuento']; ?>

            </span>

        </p>

        <p class="meses">

            <?php echo $producto['meses']; ?>

        </p>

        <p class="envio">

            <?php echo $producto['envio']; ?>

        </p>

        <p>

            <?php echo $producto['descripcion']; ?>

        </p>

              <form action="agregar_carrito.php" method="POST">

    <input
        type="hidden"
        name="producto_id"
        value="<?php echo $producto['id']; ?>"
    >

    <button class="btn-agregar">

        Agregar al carrito

    </button>

</form>

    </div>

</main>

</body>
</html>