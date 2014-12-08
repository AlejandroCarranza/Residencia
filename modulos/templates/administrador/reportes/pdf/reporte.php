<?php

require "fpdf.php";
include_once '../../../../includes/psl-config.php'; 

class PDF extends FPDF
{
}

//Crea conexion al servidor mysql con los datos de psl-config.php
$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if (mysqli_connect_errno()) {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

$tabla = "";
$comite = "";

$subcomite= $_POST['subcomite'];


$consulta1 = "SELECT nombre_subcomision FROM subcomisiones WHERE id_subcomision = '".$subcomite."' ";
$result1=mysqli_query($con, $consulta1) or die (mysqli_error($con)); 
if($result1 === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}
while($fila1 = mysqli_fetch_array($result1))
{
	$comite = $fila1['nombre_subcomision'];
}

if (($subcomite == 5) or ($subcomite == 7) or ($subcomite == 8) or ($subcomite == 10) ) {
	$tabla = "puestos";
}
else{
	$tabla = "cargos";
}

//DELCARACION DE LA HOJA
$pdf=new PDF('P', 'mm', 'Letter');
$pdf->SetMargins(20, 18);
$pdf->AliasNbPages();
$pdf->AddPage();


//DATOS DEL TITULO
$pdf->SetTextColor(0x00, 0x00, 0x00);
$pdf->SetFont("Arial", "b", 8);
$pdf->Cell(30,25,'',0,0,'C',$pdf->Image('../../../../statics/images/logo-mini.png', 20,12, 40));
$pdf->Cell(0, 5, utf8_decode(''), 0, 1, 'L');
$pdf->Cell(0, 5, utf8_decode('"Titulo"'), 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode('"Algún contenido"'). $subcomite);


//MOSTRAMOS LA TABLA
$pdf->Ln();
$pdf->Cell(20, 5, "Id",1,0, 'C');
$pdf->Cell(25, 5, "Nombre",1,0, 'C');
$pdf->Cell(55, 5, "Email",1,0, 'C');
$pdf->Cell(55, 5, utf8_decode("Teléfono"),1,1, 'C');


$consulta = "SELECT * FROM $tabla join contactos on $tabla.id_contacto=contactos.id_contacto WHERE id_subcomision = '".$subcomite."' ";
$result=mysqli_query($con, $consulta) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}
while($fila = mysqli_fetch_array($result))
{
	$pdf->Cell(20, 5, $fila['id_contacto'],1,0, 'L');
	$pdf->Cell(25, 5, $fila['nombre'],1,0, 'L');
	$pdf->Cell(55, 5, $fila['email'],1,0, 'L');
	$pdf->Cell(55, 5, $fila['tel_oficina'],1,1, 'L');
}

$pdf->Output();
//$pdf->Output("Reporte-".$comite.".pdf","D");

?>
