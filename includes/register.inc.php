<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    // Saneamiento y validación de los datos recibidos
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $nombre=filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellido_paterno=filter_input(INPUT_POST, 'apellido_paterno', FILTER_SANITIZE_STRING);
    $apellido_materno=filter_input(INPUT_POST, 'apellido_materno', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Correo no válido.
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // La contraseña codificada debería ser de 128 caracteres de largo
        // Si no es así, algo muy raro ha pasado
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }

    // La validiación de nombre de usuario y la contraseña fueron realizadas en el lado del cliente
    // Esto debería estar bien ya que nadie saca ventaja por romper esas reglas.
 
    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Checa si existe el email
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // Ya existe un usuario con esta dirección de email.
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
                        $stmt->close();
        }
                $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }
 
    // Checha si existe el nombre de usuario
    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
 
                if ($stmt->num_rows == 1) {
                        // Ya existe un usuario con este nombre de usario.
                        $error_msg .= '<p class="error">A user with this username already exists</p>';
                        $stmt->close();
                }
                $stmt->close();
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }
 
    if (empty($error_msg)) {
        // Crea una sal random
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Contraseña con sal (salted password)
        $password = hash('sha512', $password . $random_salt);

 
        // Inserta el nuevo usuario en la base de datos
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, nombre, apellido_paterno, apellido_materno, email, password, salt) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('sssssss', $username, $nombre, $apellido_paterno, $apellido_materno, $email, $password, $random_salt);
            // Ejecuta la sentencia preparada.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        }
        header('Location: ./register_success.php');
    }
}