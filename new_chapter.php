<?php require_once("includes/connection_db.php");?>
<?php require_once("includes/functions.php");?>
<?php obtener_pagina(); ?>
<?php include("includes/header.php");?>
	<table id="estructura">
		<tr>
			<td id="menu">
			<?php echo menu($curso_reg,$capitulo_reg); ?>
			</td>
			<td id="pagina">
			<h2>Agregar Nuevo Capitulo</h2>
			<form action="create_chapter.php?curso=<?php echo urlencode($curso_reg["id"]); ?>" method="post">
				<p>Nombre de capitulo :<input  name="nombre"></p>
				<p>Posición:
				<select name="posicion">
				<?php
					$resultado = obtener_capitulos_por_curso($curso_reg["id"]);
					$num = mysql_num_rows($resultado);
					for($i=1;$i<=$num+1;$i++)
					{
						echo "<option value=\"{$i}\">{$i}</option>";
					}					
				?>
				</select>
				</p>
				<p>Visible:
<input type="radio" name="visibilidad" value="0">NO</input>
<input type="radio" name="visibilidad" value="1">SI</input>
				</p>
				<p>Contenido :<br>
				<textarea name="contenido" rows="20" cols="80"></textarea></p>
				<input type="submit" value="Crear capitulo"/>
			</form><br><br>
			<a href="edit_course.php?curso=<?php echo urlencode($curso_reg["id"]); ?>">Cancelar</a>
			</td>
		</tr>
	</table>
	<?php require_once("includes/footer.php");?>
		