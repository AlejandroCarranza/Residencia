<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);
 
if (! $error) {
    $error = 'Oops! Un error desconocido ha ocurrido.';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Directorio: Error</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <h1>Ocurrió un problema</h1>
        <p class="error"><?php echo $error; ?></p>  
    </body>
</html>