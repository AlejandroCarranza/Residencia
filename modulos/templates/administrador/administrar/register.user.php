<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
$mysqli->set_charset("utf8");
$error="";
if (isset($_POST['nombreUsuario'], $_POST['username'])) {
    // Sanitize and validate the data passed in
    $username=filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $nombre=filter_input(INPUT_POST, 'nombreUsuario', FILTER_SANITIZE_STRING);
    $apellido_paterno=filter_input(INPUT_POST, 'apellidoPUsuario', FILTER_SANITIZE_STRING);
    $apellido_materno=filter_input(INPUT_POST, 'apellidoMUsuario', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'emailUsuario', FILTER_SANITIZE_EMAIL);
    $tipo = filter_input(INPUT_POST, 'tipoUsuario', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error .= 'Ya existe un usuario con este correo. ';
            $stmt->close();
            echo $error;
        }
    }


    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error .= 'Este nombre de usuario ya está en uso. ';
            $stmt->close();
            echo $error;  
        }
    }
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    $password = hash('sha512', $password . $random_salt);

if($error==""){
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, nombre, apellido_paterno, apellido_materno, email, type, password, salt)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssssss', $username, $nombre, $apellido_paterno, $apellido_materno, $email, $tipo, $password, $random_salt);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo "Error al agregar el usuario";
            } echo "1";
        }
    }


}


?>