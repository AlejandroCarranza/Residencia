<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Forma segura de empezar una sesión de PHP.
 
if (isset($_POST['usuario'], $_POST['p'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['p']; // La contraseña codificada (supuestamente)

    $password = openssl_digest($password, 'sha512');

    ?>
    <?php
    
    if (login($usuario, $password, $mysqli) == true) {
        // Login exitoso.
        if ($_SESSION['type'] == '0') {
        //header('Location: ../modulos/templates/usuario/index0.php');
        $resultado[]=array("logstatus"=>"1","nombre"=>"Alejandro", "apellido"=>"Carranza");
        echo json_encode($resultado);
        }
        if ($_SESSION['type'] == '1') {
        //header('Location: ../templates/index1.php');
        $resultado[]=array("logstatus"=>"1","nombre"=>"Alejandro", "apellido"=>"Carranza");
        echo json_encode($resultado);
        }
        if ($_SESSION['type'] == '2') {
        //header('Location: ../modulos/templates/administrador/admin.php');
        $resultado[]=array("logstatus"=>"1","nombre"=>"Alejandro", "apellido"=>"Carranza");
        echo json_encode($resultado);
        }

    } else {
        // No se pudo entrar
        echo "Error en el logueo";
    }
} else {
    // La variables POST correctas no fueron enviadas a esta página.
    echo 'Invalid Request';
}