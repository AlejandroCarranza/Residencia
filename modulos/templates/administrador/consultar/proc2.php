<?php
include_once '../../../includes/psl-config.php';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$codigo=$_POST['vcod'];


$result=mysqli_query($con,"SELECT * FROM contactos where id_contacto='".$codigo."' ");
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}

while($fila = mysqli_fetch_array($result))
{
	
	echo '<a href="#" class="cancelar icon-cancel-circle" title="Cerrar" onclick="ocultarCon()"></a>';
?>
	<a href="#" class="editar icon-pencil" title="Editar" onclick="myFunction4(<?php echo $fila['id_contacto']; ?>)"></a>
<?php
 	$rutaFoto='../statics/images/contactos/'.$fila['id_contacto'].'.jpg';
 	echo '<img class="tarjetaFoto" src="'.$rutaFoto.'">';
	echo '<p class="tarjetaNom">'.utf8_encode($fila['titulo']. " ".$fila['nombre']. " ".$fila['apellido_paterno']. " ".$fila['apellido_materno'].' '). '</p>';

	echo '<p class="tarjetaBasic">'."Telefono: ". " " .$fila['tel_oficina'].'</p>';
	echo '<p class="tarjetaBasic">' ."E-mail: ". " ".$fila['email'].'</p>';
	echo '<p class="tarjetaBasic">'."Dirección: ". " " .$fila['calle']. " ".$fila['numero_ext']. " " .$fila['colonia']. " " .$fila['municipio']. '</p>';
	?> 
	<a href="#" onclick="verMas('mostrarMas')">Leer más</a>

	<div style="display:none" id="mostrarMas"> 
<?php
	echo '<p class="tarjetaBasic">' ."Numero Int:  ". " ".$fila['numero_int'].'</p>';
?> 
</div>
<input type="hidden" value="" id="idCon" name="idCon" >
<div id="editarCon"></div>
<?php
}
mysqli_free_result($result);
mysqli_close($con);
?>