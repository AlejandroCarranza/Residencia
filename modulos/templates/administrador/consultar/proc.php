<?php 

include_once '../../../includes/psl-config.php';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$q=$_POST['q'];

$result=mysqli_query($con,"SELECT * from contactos where nombre LIKE '".$q."%' LIMIT 0 , 10");
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}

while($fila = mysqli_fetch_array($result))
{
echo '<div class="sugerencias" onclick="myFunction2('.$fila["id_contacto"].')"> '.utf8_encode($fila['titulo'].' '.$fila['nombre'].' '.$fila['apellido_paterno'].' '.$fila['apellido_materno'].' ').'</div>';
}

mysqli_free_result($result);
mysqli_close($con);
?>