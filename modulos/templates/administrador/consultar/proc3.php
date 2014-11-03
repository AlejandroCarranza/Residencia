<?php

$con=mysqli_connect("localhost","unUsuario","5twPJM2G5pmt65r","directorio");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$search1=$_POST['valor1'];

$result=mysqli_query($con,"SELECT * from contactos where fk_id_subcomision LIKE '".$search1."' ");
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}
 echo '<table border="1">';
 echo '<tr>';
 echo '<td>Id_Contacto</td>';
 echo '<td>Nombre</td>';
 echo '<td>Subcomite</td>';
 echo '<td>Link</td>';
 echo '</tr>';

while($fila = mysqli_fetch_array($result))
{

 echo '<tr>';
 echo '<td>'.$fila['id_contacto'].'</td>';
 echo '<td>'.$fila['titulo']. " ".$fila['nombre']. " ".$fila['apellido_paterno']. " ".$fila['apellido_materno'].'';
 echo '<td>'.$fila['fk_id_subcomision'].'</td>';
 ?>
<td><a href="#" onclick="myFunction3(<?php echo $fila['id_contacto']; ?>)">Ver más</a></td>
<?php
 echo '</tr>';

?>
<input type="hidden" value="" id="vcod" name="vcod" >
<?php
}
echo '<div id="pers"></div>';
echo '</table>';
mysqli_free_result($result);
mysqli_close($con);
?>