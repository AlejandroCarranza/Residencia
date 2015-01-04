<?php
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php'; 
//Inicia la función 
sec_session_start();
// Comprueba que la sesión activa corresponda al módulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '1')){


$codigo=$_POST['idFoto'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Actualizar Foto</title>
<script type='text/javascript'>
function validarF() {

    // Validación de la foto
    // Se explica la función en cada alert
    var input, file;


    if (!window.FileReader) {
        alert("La API de archivos no es soportada por este navegador");
        return;
    }

    input = document.getElementById('fotoCarga');
    if (!input) {
        alert("No se puede encontrar el elemento");
    }
    else if (!input.files) {
        alert("Este navegador no permite la carga de archivos");
    }
    else if (!input.files[0]) {
        alert("Seleccione un archivo");
    }

    else if(input.files[0].size>1024000){
        alert("El archivo excede el tamaño permitido");
    }
    else{
        document.getElementById("formFoto").submit();
    }

}


</script>
</head>
<body>
<form method="post" name="formFoto" id="formFoto" accept-charset="utf-8" enctype="multipart/form-data" action="consultar/upload.php">
    <div class="row">
      <label for="fotoCarga">Seleccione una imagen para cargar. (Imágenes de 1MB o menos)</label><br />
      <input type="file" name="fotoCarga" id="fotoCarga" />
      <input name="codigoFoto" type="hidden" value="<?php echo $codigo;?>">
    </div>
    <div class="row">
      <input type="button" value="Cargar" id="boton3" name="boton3" onclick="validarF()"/>
    </div>
  </form>
  <?php
}
// Si no se aprueba la sesion muestra el mensaje
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php
} 
?>
</body>
</html>