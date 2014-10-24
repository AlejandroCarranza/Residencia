<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insertar Usuario</title>

<script>

function validate(){ 
    var p1 = document.getElementById("contraseña").value;
    var p2 = document.getElementById("confirmacion").value;

    if (p1 != p2) {
  alert("Las contraseñas deben coincidir");
  return false;
} else {
  alert("Todo está correcto");
  return true;
}

</script>

</head>
<body>
    <h1>Registra un usuario</h1>
    <div id="formProd">
        <form action="post" id="formdata">
            <input type="text" class="input" placeholder="Nombre" id="nombre" name="nombre" >
            <input type="text" class="input" placeholder="Apellido Paterno" id="apellido_paterno" name="apellido_paterno" >
            <input type="text" class="input" placeholder="Apellido Materno" id="apellido_Materno" name="apellido_Materno" >
            <input type="email" class="input" placeholder="Email" id="email" name="email" >
            <select name="nivel" id="nivel" name="nivel">
                <option value="2">Administrador</option>
                <option value="1">Usuario</option>
                <option value="0">Invitado</option>
            </select>
            <input type="password" class="input" id="contraseña" name="contraseña" placeholder="Contraseña">
            <input type="password" class="input" id="confirmacion" name="confirmacion" placeholder="Confirma contraseña">
            <input type="button" onclick="validate()">
        </form>
    </div>
        <div id="yay" style="display:none">
            Insert Complete
        </div>
        <div id="fail" style="display:none">
            Error
        </div>  
</body>
</html>