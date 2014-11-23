<?php
include_once '../../../includes/psl-config.php';
include_once '../../../includes/db_connect.php';
require_once('ImageManipulator.php');
$id_contacto=$_POST['codigoFoto'];
if ($_FILES['fotoCarga']['error'] > 0) {
    echo "Error: Se debe elegir imagen";
} else {
    // array of valid extensions
    $validExtensions = array('.jpg', '.jpeg', '.png');
    // get extension of the uploaded file
    $fileExtension = strrchr($_FILES['fotoCarga']['name'], ".");
    // check if file Extension is on the list of allowed ones
    if (in_array($fileExtension, $validExtensions)) {
        $newName = $id_contacto.'.jpg';
        $manipulator = new ImageManipulator($_FILES['fotoCarga']['tmp_name']);
        // resizing to 200x200
        $newImage = $manipulator->resample(200, 200);
        // saving file to uploads folder
        $manipulator->save('../../../statics/images/contactos/' .$newName);
        $mensaje = "Carga completa";
        //echo "<script type='text/javascript'>alert('$mensaje');</script>";
        if ($uno = $mysqli->prepare("UPDATE contactos SET foto = '1' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }


        
    } else {
        echo 'Se debe elegir imagen.';
    }
}
 header('Location: ../admin.php');
?>