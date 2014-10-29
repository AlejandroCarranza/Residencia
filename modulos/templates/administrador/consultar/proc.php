<?php

$con=mysqli_connect("localhost","root","root","directorio");
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
echo '<div class="sugerencias" onclick="myFunction2('.$fila["id_contacto"].')"> '.$fila['titulo'].' '.$fila['nombre'].' '.$fila['apellido_paterno'].' '.$fila['apellido_materno'].'</div>';
}

mysqli_free_result($result);
mysqli_close($con);
?>