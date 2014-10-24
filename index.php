<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'SÍ';
} else {
    $logged = 'NO';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Directorio: Log In</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
        <link rel="stylesheet" href="css/estilos.css" />
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/normalize.css">

    </head>
    <body>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error al tratar de entrar!</p>';
        }
        ?> 
        <header class="encabezado">
            <img src="images/logo-mini.png" alt="Logo" class="encabezado-logo">
        </header>
        <form action="includes/process_login.php" method="post" name="login_form" class="formulario">                      
            <h3 class="form-login">Inicia Sesión</h3>
            <input type="text" name="usuario" class="form-usuario" placeholder="Usuario"/>
            <input type="password" name="password" id="password" class="form-pass" placeholder="Contraseña"/>
            <input type="submit" value="Entrar" class="form-btnEnviar" onclick="formhash(this.form, this.form.password);" />

        </form>
        <p>Si nos estás registrado, por favor <a href="register.php">regístrate</a>.</p>

    </body>
</html>