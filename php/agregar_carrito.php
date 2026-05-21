<?php

include("conexion.php");

session_start();

if(!isset($_SESSION['usuario_id'])){

    header("Location: login.php");

    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$producto_id = $_POST['producto_id'];


// VERIFICAR SI YA EXISTE

$query = "

SELECT *
FROM carrito

WHERE usuario_id = $usuario_id
AND producto_id = $producto_id
AND estado = 'carrito'

";

$resultado = $db->query($query);

$producto = $resultado->fetchArray();


// SI YA EXISTE

if($producto){

    $cantidadNueva =
    $producto['cantidad'] + 1;

    $subtotalNuevo =
    $producto['subtotal'] +
    $producto['subtotal'] / $producto['cantidad'];

    $db->exec("

    UPDATE carrito

    SET
        cantidad = $cantidadNueva,
        subtotal = $subtotalNuevo

    WHERE id = ".$producto['id']."

    ");

}else{

    // OBTENER PRECIO

    $queryProducto = "

    SELECT *
    FROM productos

    WHERE id = $producto_id

    ";

    $resultadoProducto =
    $db->query($queryProducto);

    $dataProducto =
    $resultadoProducto->fetchArray();

    $precio =
    $dataProducto['precio'];

    // INSERTAR

    $db->exec("

    INSERT INTO carrito
    (
        usuario_id,
        producto_id,
        cantidad,
        subtotal,
        estado
    )
    VALUES
    (
        $usuario_id,
        $producto_id,
        1,
        $precio,
        'carrito'
    )

    ");

}


header("Location: carrito.php");

?>