<?php require_once("includes/connection_db.php");?>
<?php require_once("includes/functions.php");?>
<?php
	if(intval($_GET["capitulo"]) == 0)
	{
		header ("Location :content.php ");
		exit;
	}
	$consulta = "DELETE FROM capitulos 
				WHERE id=" . $_GET["capitulo"];
				mysql_query($consulta,$conexion);
				if(mysql_affected_rows()==1)
				{
					header ("Location :content.php ");
		exit;
	} else
	{
		echo "<p>Error al intentar eliminar capitulos: "  . mysql_error() . "</p>";
		<a href=\"content.php\">Regresar a la página principal</a>;
	}
?>
<?php
	if (isset($conexion)) {
		
	
		mysql_close($conexion);
		}
	?>