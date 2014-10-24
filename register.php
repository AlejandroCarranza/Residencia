<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Directorio: Formulario de Registro</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Regístrate para acceder</h1>
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <ul>
            <li>Los nombres de usuario pueden tener dígitos, mayúsculas y minúsculas</li>
            <li>La contraseña debe ser de al menos 6 caracteres</li>
            <li>La contraseña debe contener:
                <ul>
                    <li>Por lo menos una letra mayúscula (A..Z)</li>
                    <li>Por lo menos una letra minúscula (a..z)</li>
                    <li>Por lo menos un número (0..9)</li>
                </ul>
            </li>
            <li>La contraseña y su confirmación deben ser iguales</li>
        </ul>
        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">
            Nombre de Usuario: <input type='text' 
                name='username' 
                id='username' /><br>
            Nombre: <input type="text" name="nombre" id="nombre" /><br>
            Apellido Paterno: <input type="text" name="apellido_paterno" id="apellido_paterno" /><br>
            Apellido Materno: <input type="text" name="apellido_materno" id="apellido_materno" /><br>
            Email: <input type="text" name="email" id="email" /><br>
            Contraseña: <input type="password"
                             name="password" 
                             id="password"/><br>
            Confirmar contraseña: <input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" /><br>
            <input type="submit" 
                   value="Registrar" 
                   onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.nombre,
                                   this.form.apellido_paterno,
                                   this.form.apellido_materno,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd);" /> 
        </form>
        <p>Regresar a la página de <a href="index.php">inicio</a>.</p>
    </body>
</html>

<?php
