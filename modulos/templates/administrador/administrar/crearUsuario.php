<?php
include_once 'register.user.php';
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Nuevo Usuario</title>
    <script type="text/JavaScript" src="../../statics/js/sha512.js"></script>
<script type="text/javascript">
function validateFormUsuario() {
    var username = document.forms["formUsuario"]["username"].value;
    var nombre = document.forms["formUsuario"]["nombreUsuario"].value;
    var apellidoP = document.forms["formUsuario"]["apellidoPUsuario"].value;
    var apellidoM = document.forms["formUsuario"]["apellidoMUsuario"].value;
    var email = document.forms["formUsuario"]["emailUsuario"].value;
    var password = document.forms["formUsuario"]["password"].value;
    var password2 = document.forms["formUsuario"]["confirmarpwd"].value;

    if (username == null || username == "") {
        alert("Es necesario elegir nombre de usuario");
        return false;
    }
    re = /^\w+$/; 
    if(!re.test(username)) { 
        alert("El nombre de usuario solo puede tener letras, números y guiones bajos.");
        return false; 
    }
    if (nombre == null || nombre == "" ||
        apellidoP == null || apellidoP == "" ||
        apellidoM == null || apellidoM == ""
        ) {
        alert("Datos de nombre incompletos");
        return false;
    }
        if (email == null || email == "") {
        alert("Es necesario ingresar email");
        return false;
    }
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) ){
        alert("Email inválido");
        return false;
    }
    if (password == null || password == "" ||
        password2 == null || password2 == ""
        ) {
        alert("Faltan datos de contraseña");
        return false;
    }
    if (password.length < 6) {
        alert('La contraseña debe ser de al menos seis caracteres.');
        return false;
    }
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password)) {
        alert('La contraseña debe tener al menos una letra mayúscula, una minúscula y un número.');
        return false;
    }
        if (password != password2) {
        alert("La confirmación de la contraseña debe ser igual a la contraseña");
        return false;
    }
    
    else {
        document.forms["formUsuario"]["password"].value= hex_sha512(password);
        document.forms["formUsuario"]["confirmarpwd"].value= hex_sha512(password);
        return true;
    }
    
}
</script>
<script type="text/javascript">
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $('#boton2').click( function() {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        if(validateFormUsuario()){                               // Primero validará el formulario.
            $.post("administrar/register.user.php",$('#formUsuario').serialize(),function(res){
                if(res == "1"){
                    alert("Usuario Guardado");
                    document.formUsuario.reset();
                } else {
                    alert("Error. Usuario no guardado. "+res);
                    document.forms["formUsuario"]["password"].value= "";
                    document.forms["formUsuario"]["confirmarpwd"].value= "";
                }
            });
        }
    });    
});
</script>
</head>
<body>
    <h1>Registro de usuarios</h1>
    <div id="formInsertUsuario">
        <form method="post" name="formUsuario" id="formUsuario" accept-charset="utf-8" enctype="multipart/form-data">
            <input type="text" class="input" id="username" name="username" placeholder="Nombre de usuario" />
            <input type="text" class="input" id="nombreUsuario" name="nombreUsuario" placeholder="Nombre(s)">
            <input type="text" class="input" id="apellidoPUsuario" name="apellidoPUsuario" placeholder="Apellido Paterno">
            <input type="text" class="input" id="apellidoMUsuario" name="apellidoMUsuario" placeholder="Apellido Materno">
            <input type="text" class="input" id="emailUsuario" name="emailUsuario" placeholder="Email"/>
            <br>
            <select name="tipoUsuario">
                <option value="" disabled selected>Tipo de Usuario</option>
                <option value="2">Administrador</option>
                <option value="1">Usuario</option>
                <option value="0">Invitado</option>
                <option value="4">Invitado Tipo 2</option>
            </select>
            <input type="password" class="input" id="password" name="password" placeholder="Contraseña"/>
            <input type="password" class="input" id="confirmarpwd" name="confirmarpwd" placeholder="Confirmar contraseña"/>
            <br>
            <input id="boton2" name="boton2" type="button" value="Registrar"/> 
        </form>
    </div>
    <script src="../../statics/js/jquery-2.1.0.min.js"></script>
    <script src="../../statics/js/AJAX.js"></script>
</body>

</html>