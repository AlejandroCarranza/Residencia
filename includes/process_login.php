<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Forma segura de empezar una sesión de PHP
 
if (isset($_POST['usuario'], $_POST['p'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['p']; // La contraseña codificada.
 
    if (login($usuario, $password, $mysqli) == true) {
        // Éxito al entrar
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
        // No se pudo entrar
        header('Location: ../index.php?error=1');
    }
} else {
    // La variables POST correctas no fueron enviadas a esta página.
    echo 'Invalid Request';
}