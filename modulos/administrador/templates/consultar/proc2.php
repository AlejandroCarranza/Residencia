<?php

include 'conexion.php';

$codigo=$_POST['vcod'];
$con=conexion();

$sql="select * from contactos where id_contacto='".$codigo."'";
$res=mysql_query($sql,$con);

if(mysql_num_rows($res)==0){

 echo '<b>No hay dato</b>';

}else{

 $fila=mysql_fetch_array($res); 

 echo '<table border="1">';
 //Tabla
 echo '<tr>';
 echo '<th>Id_Contacto</th>';
 echo '<th>Nombre</th>';
 echo '<th>apellido_paterno</th>';
 echo '<th>apellido_materno</th>';
 echo '</tr>';

 echo '<tr>';
 echo '<th>'.$fila['id_contacto'].'</th>';
 echo '<th>'.$fila['nombre'].'</th>';
 echo '<th>'.$fila['apellido_paterno'].'</th>';
 echo '<th>'.$fila['apellido_materno'].'</th>';
 echo '</tr>';

 echo '</table>';

}

?>