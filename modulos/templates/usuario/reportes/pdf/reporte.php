<?php
require "fpdf.php";
include_once '../../../../../includes/psl-config.php';
include_once '../../../../../includes/db_connect.php';
include_once '../../../../../includes/functions.php'; 
//Inicia la funcion 
sec_session_start();
// Comprueba que la sesion activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '1')){

class PDF extends FPDF {
	// Pie de página
	function Footer() {
    	// Posición: a 1,5 cm del final
    	$this->SetY(-15);
    	// Arial italic 8
    	$this->SetFont('Arial','b',8);
    	// Número de página
    	$this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

//Crea conexion al servidor mysql con los datos de psl-config.php
$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	if (mysqli_connect_errno()) {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
//Campos para lograr que utf-8 funcione perfectamente
$acentos = $con->query("SET NAMES 'utf8'");
mysqli_set_charset($con,"utf8");

$tabla = "";
$comite = "";

$subcomite= $_POST['subcomite'];


$consulta1 = "SELECT nombre_subcomision FROM subcomisiones WHERE id_subcomision = '".$subcomite."' ";
$result1=mysqli_query($con, $consulta1) or die (mysqli_error($con)); 
if($result1 === FALSE) {
    die(mysqli_error());
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
$pdf->SetFont("Arial", "b", 12);
//Logotipo
$pdf->Cell(30,25,'',0,0,'C',$pdf->Image('../../../../statics/images/logo-mini.png', 20,12, 40));
//Titulo
$pdf->SetXY(20, 18);
$pdf->Cell(0, 5, utf8_decode('Subcomité de '.$comite."."), 0, 3, 'C');
//Información
$pdf->SetFont("Arial", "", 10);
$pdf->SetXY(20, 34);
$pdf->Cell(0, 5, utf8_decode('Presentamos un listado con todos los integrantes del subcomité de '.$comite."."), 0, 3, 'L');

if ($tabla == "cargos") {
	$consulta = " SELECT *
FROM $tabla sub
INNER JOIN contactos c ON sub.id_contacto =  c.id_contacto
INNER JOIN dependencias d ON sub.id_dependencia =  d.id_dependencia
WHERE id_subcomision = '".$subcomite."' ";

//MOSTRAMOS LA TABLA
$pdf->SetFont("Arial", "b", 8);
$pdf->SetXY(0, 38);
$pdf->Ln();
$pdf->Cell(55, 5, "Nombre",1,0, 'C');
$pdf->Cell(45, 5, "Dependencia",1,0, 'C');
$pdf->Cell(50, 5, "Email",1,0, 'C');
$pdf->Cell(25, 5, utf8_decode("Teléfono"),1,1, 'C');

$result=mysqli_query($con, $consulta) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}
while($fila = mysqli_fetch_array($result))
{
	$pdf->SetFont("Arial", "", 8);
	$pdf->Cell(55, 5, utf8_decode($fila['nombre'].' '.$fila['apellido_paterno'].' '.$fila['apellido_materno']),1,0, 'L');
	$pdf->Cell(45, 5, $fila['nombre_dependencia'],1,0, 'L');
	$pdf->Cell(50, 5, $fila['email'],1,0, 'L');
	$pdf->Cell(25, 5, $fila['tel_oficina'],1,1, 'L');
}

}
else {
$consulta = "SELECT * FROM $tabla join contactos on $tabla.id_contacto=contactos.id_contacto WHERE id_subcomision = '".$subcomite."' ";

//MOSTRAMOS LA TABLA
$pdf->SetFont("Arial", "b", 8);
$pdf->SetXY(0, 38);
$pdf->Ln();
$pdf->Cell(55, 5, "Nombre",1,0, 'C');
$pdf->Cell(45, 5, "Lugar",1,0, 'C');
$pdf->Cell(50, 5, "Email",1,0, 'C');
$pdf->Cell(25, 5, utf8_decode("Teléfono"),1,1, 'C');

$result=mysqli_query($con, $consulta) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}
while($fila = mysqli_fetch_array($result))
{
	$pdf->SetFont("Arial", "", 8);
	$pdf->Cell(55, 5, utf8_decode($fila['nombre']. " ". $fila['apellido_paterno']." ". $fila['apellido_materno']),1,0, 'L');
	$pdf->Cell(45, 5, $fila['extra'],1,0, 'L');
	$pdf->Cell(50, 5, $fila['email'],1,0, 'L');
	$pdf->Cell(25, 5, $fila['tel_oficina'],1,1, 'L');
}
}


$pdf->Output();
//$pdf->Output("Reporte-".$comite.".pdf","D");

}
// Si no se aprueba la sesion muestra el mensaje
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php
}

?>
