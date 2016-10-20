<?php require_once("includes/connection_db.php");?>
<?php require_once("includes/functions.php");?>
<?php

	if(intval($_GET["curso"]) == 0)
	{
		header("Location: content.php");
		exit;
	}

	$errores = validar_campos_obligatorios (array("nombre","posicion","visibilidad"));

	
	
	if (!empty($errores))
	{
		header("location: new_chapter.php?curso=" . urlencode($_GET["curso"]));
		exit;
	}
?>

<?php
	$curso_id = ($_GET["curso"]);
	$nombre = (htmlentities($_POST["nombre"],ENT_QUOTES,"UTF-8"));
	$posicion = (htmlentities ($_POST["posicion"],ENT_QUOTES,"UTF-8"));
	$visibilidad = (htmlentities ($_POST["visibilidad"],ENT_QUOTES,"UTF-8"));
	$contenido = (htmlentities ($_POST["contenido"],ENT_QUOTES,"UTF-8"));

	$consulta = "INSERT INTO capitulos (
	nombre,posicion,visibilidad,contenido,curso_id
	) VALUES (
	'{$nombre}',{$posicion},{$visibilidad},'{$contenido}',{$curso_id}
	)";

	if (mysql_query($consulta,$conexion))
	{
		header("Location: content.php");
		exit;
	}
	else 
	{
		echo "No se pudo crear el capitulo:" . mysql_error();
	}

?>
<?php mysql_close ($conexion);?>