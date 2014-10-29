<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['usuario'], $_POST['p'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($usuario, $password, $mysqli) == true) {
        // Login success
        if ($_SESSION['type'] == '0') {
        header('Location: ../modulos/templates/usuario/index0.php');
        }
        if ($_SESSION['type'] == '1') {
        header('Location: ../templates/index1.php');
        }
        if ($_SESSION['type'] == '2') {
        header('Location: ../modulos/templates/administrador/admin.php');
        }

    } else {
        // Login failed 
        header('Location: ../index.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}