<?php
include_once 'functions.php';
sec_session_start();
 
// Reasigna todos los valores de sesión.
$_SESSION = array();
 
// Obtiene los parámetros de sesión.
$params = session_get_cookie_params();
 
// Elimina la cookie actual.
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// Destruye la sesión.
session_destroy();
header('Location: ../index.php');