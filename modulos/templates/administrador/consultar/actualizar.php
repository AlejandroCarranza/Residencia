<?php
$id_contacto = $_POST['id_contacto'];
$tel_oficina = $_POST['tel_oficina'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$calle = $_POST['calle'];
$numero_int = $_POST['numero_int'];
$numero_ext = $_POST['numero_ext'];
$colonia = $_POST['colonia'];
$municipio = $_POST['municipio'];
$localidad = $_POST['localidad'];
$codigo_postal = $_POST['codigo_postal'];
$fk_id_subcomision = $_POST['fk_id_subcomision'];
$fk_id_partido = $_POST['fk_id_partido'];

include_once '../../../includes/psl-config.php';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
        $update = mysqli_query($con, "UPDATE contactos SET tel_oficina = '$tel_oficina', celular = '$celular', 
            email = '$email', calle = '$calle', numero_int = '$numero_int', numero_ext = '$numero_ext',
			colonia = '$colonia', municipio = '$municipio', localidad = '$localidad', codigo_postal = '$codigo_postal',
            fk_id_subcomision = '$fk_id_subcomision', fk_id_partido = '$fk_id_partido'
            WHERE id_contacto = '$id_contacto' ")
	        
        or die(mysql_error());
        if ($update){
        echo "1";
        }else{
        echo "0";
        }
mysqli_close($con);
?>