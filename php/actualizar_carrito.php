<?php

include("conexion.php");

session_start();

if(!isset($_SESSION['usuario_id'])){

    header("Location: login.php");

    exit;
}

$carrito_id = $_GET['id'];

$accion = $_GET['accion'];


// OBTENER PRODUCTO

$query = "

SELECT *
FROM carrito

WHERE id = $carrito_id

";

$resultado = $db->query($query);

$detalle = $resultado->fetchArray();


// VALIDAR

if(!$detalle){

    header("Location: carrito.php");

    exit;
}


// CANTIDAD ACTUAL

$cantidad = $detalle['cantidad'];


// SUMAR

if($accion == "sumar"){

    $nuevaCantidad = $cantidad + 1;

    $db->exec("

    UPDATE carrito

    SET cantidad = $nuevaCantidad

    WHERE id = $carrito_id

    ");

}


// RESTAR

if($accion == "restar"){

    $nuevaCantidad = $cantidad - 1;

    if($nuevaCantidad <= 0){

        $db->exec("

        DELETE FROM carrito

        WHERE id = $carrito_id

        ");

    }else{

        $db->exec("

        UPDATE carrito

        SET cantidad = $nuevaCantidad

        WHERE id = $carrito_id

        ");

    }

}


// ELIMINAR

if($accion == "eliminar"){

    $db->exec("

    DELETE FROM carrito

    WHERE id = $carrito_id

    ");

}


// REGRESAR

header("Location: carrito.php");

?>