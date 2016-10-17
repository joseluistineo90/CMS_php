<?php require_once("includes/connection_db.php");?>
<?php require_once("includes/functions.php");?>
<?php
	$nombre = (htmlentities($_POST["nombre"],ENT_QUOTES,"UTF-8"));
	$posicion = (htmlentities ($_POST["posicion"],ENT_QUOTES,"UTF-8"));
	$visibilidad = (htmlentities ($_POST["visibilidad"],ENT_QUOTES,"UTF-8"));

	$consulta = "INSERT INTO cursos (
	nombre,posicion,visibilidad
	) VALUES (
	'{$nombre}',{$posicion},{$visibilidad}
	)";

	if (mysql_query($consulta,$conexion))
	{
		header("location: content.php");
		exit;
	}
	else 
	{
		echo "No se pudo crear el curso:" . mysql_error();
	}

?>
<?php mysql_close ($conexion);?>