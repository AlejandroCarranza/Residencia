<?php
include_once '../../../includes/psl-config.php';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$subcomite = $_POST['valor1'];
$tabla = $_POST['valor2'];

$cargo = "cargos";

//Consulta SQL que busca los contactos desde la tabla cargos o puestos segun el boton que selecciono el usuario
$consulta = "SELECT * FROM $tabla join contactos on $tabla.id_contacto=contactos.id_contacto WHERE id_subcomision = '".$subcomite."' ";

$result=mysqli_query($con, $consulta) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}
//Despliegue de la lista de contactos que cumplieron las condiciones
 echo '<table border="1">';
 echo '<tr>';
 echo '<td>Id_Contacto</td>';
 echo '<td>Nombre</td>';
 echo '<td>Puesto</td>';
 echo '<td>    </td>';
 echo '</tr>';

while($fila = mysqli_fetch_array($result))
{

 echo '<tr>';
 echo '<td>'.$fila['id_contacto'].'</td>';
 echo '<td>'.utf8_encode($fila['titulo']. " ".$fila['nombre']. " ".$fila['apellido_paterno']. " ".$fila['apellido_materno'].' '). '</td>';
 
if ($tabla == $cargo) {
	 echo '<td>'.$fila['cargo'].'</td>';
}
else{
	echo '<td>'.$fila['puesto'].'</td>';
}
 ?>
<td><a href="#" class="icon-profile icoVerMas" onclick="myFunction3(<?php echo $fila['id_contacto']; ?>)"></a></td>
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