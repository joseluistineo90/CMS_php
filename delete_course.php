<?php require_once("includes/connection_db.php");?>
<?php require_once("includes/functions.php");?>
<?php
	if(intval($_GET["curso"]) == 0)
	{
		header ("Location :content.php ");
		exit;
	}
	$consulta = "DELETE FROM cursos 
				WHERE id=" . $_GET["curso"];
				mysql_query($consulta,$conexion);
				if(mysql_affected_rows()==1)
				{
					header ("Location :content.php ");
		exit;
	} else
	{
		echo "<p>Error al intentar eliminar curso: "  . mysql_error() . "</p>";
	}
?>
<?php
	if (isset($conexion)) {
		
	
		mysql_close($conexion);
		}
	?>