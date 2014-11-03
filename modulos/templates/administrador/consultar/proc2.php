<?php
$con=mysqli_connect("localhost","unUsuario","5twPJM2G5pmt65r","directorio");
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
	
	echo '<a href="#" class="cancelar icon-cancel-circle" onclick="ocultarCon()"></a>';
 	$rutaFoto='../statics/images/contactos/'.$fila['id_contacto'].'.jpg';
 	echo '<img class="tarjetaFoto" src="'.$rutaFoto.'">';
	echo '<p class="tarjetaNom">'.$fila['titulo']. " ".$fila['nombre']. " ".$fila['apellido_paterno']. " ".$fila['apellido_materno'].'</p>';

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
<?php
}
mysqli_free_result($result);
mysqli_close($con);
?>