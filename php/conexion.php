<?php

try {

    $db = new SQLite3("../bd/db_mercado");

   /*  echo "Conexion exitosa"; */

} catch(Exception $e){

    die("Error de conexión: " . $e->getMessage());

}

?>