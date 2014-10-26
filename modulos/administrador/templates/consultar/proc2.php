<?php

include 'conexion.php';

$codigo=$_POST['vcod'];
$con=conexion();
$Telefono="Telefono";

$sql="select * from contactos where id_contacto='".$codigo."'";
$res=mysql_query($sql,$con);

if(mysql_num_rows($res)==0){

 echo '<b>No hay dato</b>';

}else{

 $fila=mysql_fetch_array($res); 

 	echo '<img class="tarjetaFoto" src="consultar/user.png">';
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
?>