<?php
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php'; 
//Inicia la función 
sec_session_start();
// Comprueba que la sesion activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

require_once('ImageManipulator.php');
$id_contacto=$_POST['codigoFoto'];
if ($_FILES['fotoCarga']['error'] > 0) {
    echo "Error: Se debe elegir imagen";
} else {
    // extensiones válidas
    $validExtensions = array('.jpg', '.jpeg', '.png');
    // obtiene del extensión del archivo subido
    $fileExtension = strrchr($_FILES['fotoCarga']['name'], ".");
    // verifica que la extensión esté entre las permitidas
    if (in_array($fileExtension, $validExtensions)) {
        $newName = $id_contacto.'.jpg'; // prepara el nuevo nombre de la imagen
        $manipulator = new ImageManipulator($_FILES['fotoCarga']['tmp_name']);
        // redimensiona a 200x200
        $newImage = $manipulator->resample(200, 200);
        // sube el archivo y lo posiciona en la carpeta
        $manipulator->save('../../../statics/images/contactos/' .$newName);
        $mensaje = "Carga completa";
        // indica que el contacto ahora tiene foto
        if ($uno = $mysqli->prepare("UPDATE contactos SET foto = '1' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }


        
    } else {
        echo 'Se debe elegir imagen.';
    }
}
 header('Location: ../admin.php');

  }
// Si no se aprueba la sesión muestra el mensaje
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php
}
?>