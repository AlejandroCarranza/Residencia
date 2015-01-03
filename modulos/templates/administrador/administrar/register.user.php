<?php
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/functions.php';

sec_session_start();
// Comprueba que la sesion activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

$mysqli->set_charset("utf8");
$error="";
if (isset($_POST['nombreUsuario'], $_POST['username'])) {
    // Saneamiento y recepción de datos
    $username=filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $nombre=filter_input(INPUT_POST, 'nombreUsuario', FILTER_SANITIZE_STRING);
    $apellido_paterno=filter_input(INPUT_POST, 'apellidoPUsuario', FILTER_SANITIZE_STRING);
    $apellido_materno=filter_input(INPUT_POST, 'apellidoMUsuario', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'emailUsuario', FILTER_SANITIZE_EMAIL);
    $tipo = filter_input(INPUT_POST, 'tipoUsuario', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Verificación de email existente  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // Ya existe un usuario con este correo
            $error .= 'Ya existe un usuario con este correo. ';
            $stmt->close();
            echo $error;
        }
    }


    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Verificación de nombre de usuario ya existente 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // El nombre de usuario ya está en uso
            $error .= 'Este nombre de usuario ya está en uso. ';
            $stmt->close();
            echo $error;  
        }
    }
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    $password = hash('sha512', $password . $random_salt);

if($error==""){
        // Inserta el nuevo usuario en la base de datos

        // Preparación de la sentencia
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, nombre, apellido_paterno, apellido_materno, email, type, password, salt)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssssss', $username, $nombre, $apellido_paterno, $apellido_materno, $email, $tipo, $password, $random_salt);
            // Ejecución de la sentencia.
            if (! $insert_stmt->execute()) {
                echo "Error al agregar el usuario";
            } echo "1";
        }
    }


}

}
// Si no se aprueba la sesion muestra el mensaje
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php }

?>