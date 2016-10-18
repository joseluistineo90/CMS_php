<?php require_once("includes/connection_db.php");?>
<?php require_once("includes/functions.php");?>

<?php

	if(intval($_GET["curso"]) == 0)
	{
		header ("Location :content.php ");
		exit;
	}

	if(isset($_POST["nombre"]))
	{
		
	
$errores = validar_campos_obligatorios (array("nombre","posicion","visibilidad"));
	
	if (empty($errores))
	{
		$curso_id = $_GET["curso"];
	$nombre = (htmlentities($_POST["nombre"],ENT_QUOTES,"UTF-8"));
	$posicion = (htmlentities ($_POST["posicion"],ENT_QUOTES,"UTF-8"));
	$visibilidad = (htmlentities ($_POST["visibilidad"],ENT_QUOTES,"UTF-8"));
	 $consulta = "UPDATE cursos SET
	 			 nombre = '{$nombre}',		posicion = {$posicion},
	 			 visibilidad = {$visibilidad}
	 			 WHERE id = {$curso_id}
	 			 ";
	 $resultado = mysql_query($consulta,$conexion);
	 if (mysql_affected_rows() == 1)
	 {
	 	$mensaje = "Se actulizo bien el curso";
	 }
	 else 
	 {
	 	$mensaje = "Hubo un error. <br>" .mysql_error();
	 }

	  }
	   else {
	   	$mensaje = "Se han obtenido " .count($errores) . " errores";
	   }
	}
?>
<?php obtener_pagina(); ?>
<?php include("includes/header.php");?>
	<table id="estructura">
		<tr>
			<td id="menu">
			<?php echo menu($curso_reg,$capitulo_reg); ?>
			</td>
			<td id="pagina">
			<h2>Editar Curso <?php echo $curso_reg["nombre"] ?></h2>
			<form action="edit_course.php?curso=<?php echo urlencode($curso_reg["id"]); ?>" method="post">
				<p>Nombre de curso :<input  name="nombre" value="<?php echo $curso_reg["nombre"] ?>"></p>
				<p>Posición:
				<select name="posicion">
				<?php
					$todos_los_cursos =obtener_cursos();
					$num_cursos = mysql_num_rows($todos_los_cursos);
					for($i=1;$i<=$num_cursos+1;$i++)
					{
						echo "<option value=\"{$i}\"";
						if($curso_reg["posicion"] == $i) 
						{
						echo "selected";
					    }
						echo ">{$i}</option>";
					}					
				?>
				</select>
				</p>
				<p>Visible:
<input type="radio" name="visibilidad" value="0"
<?php if($curso_reg["visibilidad"] == 0){echo "checked";}?>
>NO</input>
<input type="radio" name="visibilidad" value="1"
<?php if($curso_reg["visibilidad"] == 1){echo "checked";}?>
>SI</input>
				</p>
				<input type="submit" name="" value="Editar curso"/>
			</form><br><br>
			<a href="content.php">Cancelar</a>
			<a href="delete_course.php?curso=<?php echo urldecode($curso_reg["id"]); ?>">Borrar curso</a>
			<p><?php 
			if(isset($mensaje))
			{
				echo $mensaje;
				foreach ($errores as $error) {
					echo "<br>" . "falta " . $error;
				}
			}
				?></p>
			
			</td>
		</tr>
	</table>
	<?php require_once("includes/footer.php");?>
		