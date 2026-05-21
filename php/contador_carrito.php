<?php

include("conexion.php");

session_start();

if(!isset($_SESSION['usuario_id'])){

    echo 0;

    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$query = "

SELECT
SUM(carrito.cantidad) AS total

FROM carrito

WHERE carrito.usuario_id = $usuario_id
AND carrito.estado = 'carrito'

";

$resultado = $db->query($query);

$data = $resultado->fetchArray();

echo $data['total'] ? $data['total'] : 0;

?>