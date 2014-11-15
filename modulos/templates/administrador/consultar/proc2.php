<?php
include_once '../../../includes/psl-config.php';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id_contacto=$_POST['vcod'];

$consultaSQL = "SELECT * FROM contactos where id_contacto='".$id_contacto."' ";

$result=mysqli_query($con, $consultaSQL) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}

$result=mysqli_query($con, $consultaSQL) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}

while($fila = mysqli_fetch_array($result))
{
	
	echo '<a href="#" class="cancelar icon-cancel-circle" title="Cerrar" onclick="ocultarCon()"></a>';
?>
	<a href="#" class="editar icon-pencil" title="Editar" onclick="myFunction4(<?php echo $fila['id_contacto']; ?>)"></a>
<?php
 	$rutaFoto='../../statics/images/contactos/'.$fila['id_contacto'].'.jpg';
 	$partido = $fila['fk_id_partido'];

 	echo '<img class="tarjetaFoto" src="'.$rutaFoto.'">';
	echo '<p class="tarjetaNom">'.utf8_encode($fila['titulo']. " ".$fila['nombre']. " ".$fila['apellido_paterno']. " ".$fila['apellido_materno'].' '). '</p>';

	echo '<p class="tarjetaBasic">'."Telefono: ". " " .$fila['tel_oficina'].'</p>';
	echo '<p class="tarjetaBasic">'."Celular: ". " " .$fila['celular'].'</p>';
	echo '<p class="tarjetaBasic">' ."E-mail: ". " ".$fila['email'].'</p>';

	?> 
	<a href="#" onclick="verMas('mostrarMas')">Leer más</a>

	<div style="display:none" id="mostrarMas"> 
<?php
	echo '<p class="etiquetaTit">Dirección</p>';
	echo '<p class="tarjetaBasic">' ."Calle: ". " ".$fila['calle'].'</p>';
	echo '<p class="tarjetaBasic">' ."No Ext: ". " ".$fila['numero_ext'].'</p>';
	echo '<p class="tarjetaBasic">' ."No Int: ". " ".$fila['numero_int'].'</p>';
	echo '<p class="tarjetaBasic">' ."Colonia: ". " ".$fila['colonia'].'</p>';
	echo '<p class="tarjetaBasic">' ."Municipio: ". " ".$fila['municipio'].'</p>';

	if ($partido > 0) {
		$rutaPartido='../../statics/images/partidos/'.$partido.'.png';
		echo '<img class="tarjetaPartido" src="'.$rutaPartido.'">';
	
	}
?> 
</div>
<input type="hidden" value="" id="idCon" name="idCon" >
<div id="editarCon"></div>
<?php
}
mysqli_free_result($result);
mysqli_close($con);
?>