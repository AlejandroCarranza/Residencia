<?php
include_once '../../../includes/psl-config.php';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$tabla= $_POST['catalago'];

if ($tabla === "0") {
	echo "Seleccione una opción";
}
else{

//Consulta SQL que busca los contactos desde la tabla cargos o puestos segun el boton que selecciono el usuario
$consulta = "SELECT * FROM $tabla ";

$result=mysqli_query($con, $consulta) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}
 echo '<table border="1">';
 echo '<tr>';

if ($tabla == "dependencias") {
	
 echo '<td>Nombre</td>';
 echo '<td>Tipo</td>';
 echo '<td>Editar</td>';
 echo '</tr>';

while($fila = mysqli_fetch_array($result))
{

	echo '<tr>';
	echo '<td>'.utf8_encode($fila['nombre_dependencia']).'</td>';
	echo '<td>'.$fila['tipo_dependencia'].'</td>';
 
 ?>
<td><a href="#" class="icon-profile icoVerMas" onclick="myFunction7(<?php echo $fila['id_dependencia']; ?>)"></a></td>
<?php
 echo '</tr>';
}
}

//Si selecciono partidos
elseif ($tabla == "partidos") {
	
 echo '<td>Nombre</td>';
 echo '<td>Siglas</td>';
 echo '<td>Editar</td>';
 echo '</tr>';

while($fila = mysqli_fetch_array($result))
{

	echo '<tr>';
	echo '<td>'.utf8_encode($fila['nombre_partido']).'</td>';
	echo '<td>'.$fila['siglas'].'</td>';
 
 ?>
<td><a href="#" class="icon-profile icoVerMas" onclick="myFunction7(<?php echo $fila['id_partido']; ?>)"></a></td>
<?php
 echo '</tr>';

}
}

//Si selecciono Subcomisiones
elseif ($tabla == "subcomisiones") {
	
 echo '<td>Nombre</td>';
 echo '<td>Editar</td>';
 echo '</tr>';

while($fila = mysqli_fetch_array($result))
{

	echo '<tr>';
	echo '<td>'.utf8_encode($fila['nombre_subcomision']).'</td>';
 
 ?>
<td><a href="#" class="icon-profile icoVerMas" onclick="myFunction7(<?php echo $fila['id_subcomision']; ?>)"></a></td>
<?php
 echo '</tr>';
}
}

echo '<div id="pers"></div>';
echo '</table>';

?>
	<form method="post" display="none" id="formPref">
		<input id="valor1" name="valor1" type="hidden" value="0">
		<input id="valor2" name="valor2" type="hidden" value="<?php echo $tabla; ?>">
	</form>
<?php
mysqli_free_result($result);
mysqli_close($con);
} //fin del if de comparacion a nulo

?> 