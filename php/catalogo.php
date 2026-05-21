<?php

session_start();

include("conexion.php");

$query = "SELECT * FROM productos";

$resultado = $db->query($query);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>

    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles-catalogo.css">
</head>
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
                <li><a href="../MercadoLibre/php/catalogo.php">Catalogo</a></li>
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
                <li>
                    <a href="carrito.php">
                       <div class="carrito-icono">

    <a href="carrito.php">

        <img
        src="../img/shopping-cart-empty-side-view_34568.png"
        class="img-carrito">

        <span
        id="contador-carrito"
        class="contador">

            0

        </span>

    </a>

</div>
                    </a>
                </li>
            </ul>

        </nav>

    </header>

<main>

    <div class="catalogo">

        <!-- SIDEBAR -->
          <aside class="filtros">
                <h3>Tecnologia</h3>
                <p class="resultados">4,334 resultados</p>

                <div class="filtro">
                    <span>Llega mañana</span>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="filtro">
                    <span>FULL envío gratis</span>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="filtro">
                    <span>Internacional</span>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="filtro">
                    <span>Envío gratis</span>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>
                </div>
            </aside>

        <!-- PRODUCTOS -->
        <section class="contenido">

            <div class="productos-grid">

                <?php while($producto = $resultado->fetchArray()) { ?>

<a href="producto.php?id=<?php echo $producto['id']; ?>" class="producto-link">

    <div class="producto">

        <img src="<?php echo $producto['imagen']; ?>">

        <p class="titulo">
            <?php echo $producto['titulo']; ?>
        </p>

        <?php if($producto['precio_anterior']) { ?>

            <p class="precio-anterior">
                $<?php echo number_format($producto['precio_anterior']); ?>
            </p>

        <?php } ?>

        <p class="precio">
            $<?php echo number_format($producto['precio']); ?>

            <span>
                <?php echo $producto['descuento']; ?>
            </span>
        </p>

        <p class="meses">
            <?php echo $producto['meses']; ?>
        </p>

        <p class="envio">
            <?php echo $producto['envio']; ?>
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

</a>

<?php } ?>

                       

            </div>

        </section>

    </div>

</main>

</body>
</html>