<?php

include("conexion.php");

session_start();

if(!isset($_SESSION['usuario_id'])){

    header("Location: login.php");

    exit;
}

$usuario_id = $_SESSION['usuario_id'];


// OBTENER TOTAL

$query = "

SELECT
SUM(subtotal) AS total

FROM carrito

WHERE usuario_id = $usuario_id
AND estado = 'carrito'

";

$resultado = $db->query($query);

$data = $resultado->fetchArray();

$total = $data['total'];


// GENERAR NUMERO COMPRA

$numeroCompra = rand(100000,999999);


// ACTUALIZAR ESTADO

$db->exec("

UPDATE carrito

SET
    estado = 'comprado'

WHERE usuario_id = $usuario_id
AND estado = 'carrito'

");

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Compra realizada</title>

    <link rel="stylesheet" href="../css/styles-comprar.css">

</head>

<body>

<div class="compra-box">

    <div class="ok">

        ✓

    </div>

    <h1>

        Compra realizada

    </h1>

    <p>

        Tu compra fue procesada correctamente.

    </p>

    <p class="numero">

        Compra #<?php echo $numeroCompra; ?>

    </p>

    <p class="total">

        Total:
        $<?php echo number_format($total); ?>

    </p>

    <p>

        Gracias por comprar en Mercado Libre

    </p>

    <a
    href="catalogo.php"
    class="btn">

        Volver al catálogo

    </a>

</div>

</body>
</html>