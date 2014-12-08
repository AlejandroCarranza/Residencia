<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
 
sec_session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Directorio en línea (PRUEBAS)</title>
</head>
<body>
	<?php if ((login_check($mysqli) == true) && (($_SESSION['type'] == '1')||($_SESSION['type'] == '2'))): ?>
	<header>
		<div class="titular">
			<h1 class="titulo">Nombre del sistema</h1>
		</div>
	</header>
	<div class="contenido">
		CLASE 0
 <table name="tabla_partidos" width="500" border="1">
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Nombre</th>
    <th scope="col">Siglas</th>
			<?php
			$consultaSub = $mysqli->prepare("SELECT id_partido, nombre_partido, siglas FROM partidos");
			$consultaSub->execute();
			$consultaSub->bind_result($id_partido, $nombre_partido, $siglas);
			$consultaSub->store_result();
			while($consultaSub->fetch()){ ?>
			<tr>
			<td><?php echo $id_partido; ?></td>
			<td><?php echo utf8_encode($nombre_partido); ?></td>
			<td><?php echo $siglas; ?></td>
			<?php }
			echo "</tr";
			?>
</table>
 <table name="tabla_contactos" width="500" border="1">
    <tr>
    <th scope="col">ID</th>
    <th scope="col">Nombre</th>
    <th scope="col">Puesto</th>
			<?php
			$consultaSub = $mysqli->prepare("SELECT id_contacto, nombre, apellido_paterno, apellido_materno, pc FROM contactos");
			$consultaSub->execute();
			$consultaSub->bind_result($id_contacto, $nombre, $apellido_paterno, $apellido_materno, $pc);
			$consultaSub->store_result();
			while($consultaSub->fetch()){ ?>
			<tr>
			<td><?php echo $id_contacto; ?></td>
			<td><?php echo utf8_encode($nombre." ".$apellido_paterno." ".$apellido_materno); ?></td>
			<td><?php echo $pc; ?></td>
			<?php }
			echo "</tr";
			?>
</table>
	</div>
	        <?php else : ?>
            <p>
                <span class="error">No estás autorizado para ver esta página.</span>
            </p>
        <?php endif; ?>
</body>
</html>