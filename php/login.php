<?php

session_start();

include("conexion.php");

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $correo = trim($_POST['correo']);

    $password = trim($_POST['password']);

    $query = "

    SELECT *
    FROM usuarios

    WHERE correo = '$correo'

    ";

    $resultado = $db->query($query);

    $usuario = $resultado->fetchArray();

    
    // VALIDAR USUARIO

    if($usuario){

        // VALIDAR PASSWORD

        if(password_verify($password, $usuario['password'])){

            $_SESSION['usuario'] = $usuario['nombre'];

            $_SESSION['usuario_id'] = $usuario['id'];

            header("Location: catalogo.php");

            exit;

        }else{

            $error = "Contraseña incorrecta";

        }

    }else{

        $error = "Usuario no encontrado";

    }

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Login</title>

    <link rel="stylesheet" href="../css/styles-login.css">

</head>

<body>

<div class="login-container">

    <div class="login-box">

        <h2>Iniciar sesión</h2>

        <!-- MENSAJE ÉXITO -->

        <?php if(isset($_GET['registro'])){ ?>

            <p class="success">

                Usuario registrado correctamente

            </p>

        <?php } ?>


        <!-- MENSAJE ERROR -->

        <?php if($error != ""){ ?>

            <p class="error-login">

                <?php echo $error; ?>

            </p>

        <?php } ?>


        <!-- FORMULARIO -->

        <form method="POST" id="form-login">

            <label>Correo</label>

            <input 
                type="correo"
                name="correo"
                id="correo"
                required
            >

            <label>Contraseña</label>

            <input 
                type="password"
                name="password"
                id="password"
                required
            >

            <button
            type="submit"
            class="btn-primary">

                Continuar

            </button>

        </form>

        <a href="register.php">

            Crear cuenta

        </a>

    </div>

</div>

<script src="../js/auth.js"></script>

</body>
</html>