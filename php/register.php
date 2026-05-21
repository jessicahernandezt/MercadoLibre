<?php

include("conexion.php");

$mensaje = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "
        INSERT INTO usuarios
        (
            nombre,
            correo,
            password
        )
        VALUES
        (
            '$nombre',
            '$correo',
            '$password'
        )
    ";

    $db->exec($query);

// REDIRECCIONAR AL LOGIN

header("Location: login.php?registro=ok");
exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Registro</title>

    <link rel="stylesheet" href="../css/styles-login.css">

</head>

<body>

<div class="login-container">

    <div class="login-box">

        <h2>Crear cuenta</h2>

        <form method="POST">

            <label>Nombre</label>

            <input type="text" name="nombre" required>

            <label>Correo</label>

            <input type="email" name="correo" required>

            <label>Contraseña</label>

            <input type="password" name="password" required>

            <button type="submit" class="btn-primary">
                Registrarse
            </button>

        </form>

        <p style="color:green;">
            <?php echo $mensaje; ?>
        </p>

        <a href="login.php">
            Ya tengo cuenta
        </a>

    </div>

</div>

</body>
</html>