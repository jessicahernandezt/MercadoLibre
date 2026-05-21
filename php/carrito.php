<?php

include("conexion.php");

session_start();

if(!isset($_SESSION['usuario_id'])){

    header("Location: login.php");

    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$query = "

SELECT
    carrito.id AS carrito_id,
    carrito.cantidad,

    productos.id,
    productos.titulo,
    productos.precio,
    productos.imagen,
    productos.envio

FROM carrito

INNER JOIN productos
ON carrito.producto_id = productos.id

WHERE carrito.usuario_id = $usuario_id
AND carrito.estado = 'carrito'

";

$resultado = $db->query($query);

$total = 0;
$totalProductos = 0;

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Carrito - Mercado Libre</title>

    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/styles-carrito.css">

</head>

<body>

<header class="header">

    <div class="header-top">

        <div class="logo">

            <a href="../index.html">

                <img src="../img/mercado-libre-logo.png">

            </a>

        </div>

        <div class="buscador">

            <form>

                <input
                type="text"
                placeholder="Buscar productos...">

                <button type="submit">

                    <img src="../img/lupa.png">

                </button>

            </form>

        </div>

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

    </div>

</header>

<main class="carrito-container">

    <!-- IZQUIERDA -->
    <div class="carrito-lista">

        <div class="carrito-header">

            <h2>Productos</h2>

            <span class="full">
                FULL
            </span>

        </div>

        <?php while($producto = $resultado->fetchArray()) {

            $subtotal =
            $producto['precio'] *
            $producto['cantidad'];

            $total += $subtotal;

            $totalProductos += $producto['cantidad'];

        ?>

        <div class="producto-carrito">

            <img
            src="<?php echo $producto['imagen']; ?>"
            class="img-producto">

            <div class="producto-info">

                <h3>

                    <?php echo $producto['titulo']; ?>

                </h3>

                <p class="precio">

                    $<?php echo number_format($producto['precio']); ?>

                </p>

                <p class="envio-gratis">

                    <?php echo $producto['envio']; ?>

                </p>

                <div class="cantidad-box">

                    <!-- RESTAR -->
                    <a
                    href="actualizar_carrito.php?id=<?php echo $producto['carrito_id']; ?>&accion=restar">
                    

                        <button>-</button>

                    </a>

                    <span>

                        <?php echo $producto['cantidad']; ?>

                    </span>

                    <!-- SUMAR -->
                    <a
                    href="actualizar_carrito.php?id=<?php echo $producto['carrito_id']; ?>&accion=sumar">

                        <button>+</button>

                    </a>

                </div>

                <!-- ELIMINAR -->
                <a
                href="actualizar_carrito.php?id=<?php echo $producto['carrito_id']; ?>&accion=eliminar"
                class="btn-eliminar">

                    Eliminar

                </a>

            </div>

            <div class="subtotal-box">

                <p class="subtotal">

                    $<?php echo number_format($subtotal); ?>

                </p>

            </div>

        </div>

        <?php } ?>

        <div class="envio-box">

            <p><strong>Envío</strong></p>

            <p class="gratis">

                Envío gratis

            </p>

        </div>

    </div>

    <!-- DERECHA -->
    <div class="carrito-resumen">

        <h3>Resumen de compra</h3>

        <div class="resumen-linea">

            <span>

                Productos (<?php echo $totalProductos; ?>)

            </span>

            <span>

                $<?php echo number_format($total); ?>

            </span>

        </div>

        <div class="resumen-linea">

            <span>Envío</span>

            <span class="gratis">

                Gratis

            </span>

        </div>

        <div class="resumen-total">

            <span>Total</span>

            <span>

                $<?php echo number_format($total); ?>

            </span>

        </div>

        <a href="comprar.php">

            <button class="btn-comprar">

                Continuar compra

            </button>

        </a>

    </div>

</main>

<footer>

    <p>© 2026 Mercado Libre</p>

</footer>

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

</body>
</html>