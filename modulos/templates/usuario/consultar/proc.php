<?php 

//Se enlazan los archivos necesarios
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php';

//Inicia la funcion 
sec_session_start();
// Comprueba que la sesion activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '1')){

//Se crea una conexion a la base de datos usando las variables del archivo psl-config.php
$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Se comprueba conexion a la base de datos
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Se recibe el valor enviado en la consulta 1
$q = $_POST['q'];

//Se realiza la consulta segun el valor recibido en q, pero solo busca las 10 primeras similares
$result=mysqli_query($con,"SELECT * from contactos where nombre LIKE '".$q."%' LIMIT 0 , 10");
if($result === FALSE) {
    die(mysqli_error());
}

// Se guarda el resultado de la consulta en un array
while($fila = mysqli_fetch_array($result))
{
	//Imprime los nombres almacenados en el array
	echo '<div class="sugerencias" onclick="myFunction2('.$fila["id_contacto"].')"> '.utf8_encode($fila['titulo'].' '.$fila['nombre'].' '.$fila['apellido_paterno'].' '.$fila['apellido_materno'].' ').'</div>';
}
//Se liberan recursos
mysqli_free_result($result);
mysqli_close($con);

}
// Si no se aprueba la sesion muestra el mensaje
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php
}
?>