<?php require_once("includes/connection_db.php");?>
<?php require_once("includes/functions.php");?>
<?php obtener_pagina()?>;
<?php include("includes/header.php");?>
	<table id="estructura">
		<tr>
			<td id="menu">
			<?php echo menu($curso_reg,$capitulo_reg);?>
			<br>
				<br>
				<a href="new-course.php">AGREGAR CURSO</a>
            </ul>
			</td>
			<td id="pagina">
			<?php if(!is_null($curso_reg)){ ?>
			<h2><?php echo $curso_reg["nombre"];
			 ?></h2>	
			<?php } elseif(!is_null($capitulo_reg)) { ?>
				<h2><?php echo $capitulo_reg["nombre"]; ?></h2>
				<div id="pagina-contenido">
					<?php 
					echo $capitulo_reg["contenido"];
					?>
					</div>
					<?php } else { ?>
				<h2>Selecciona algún curso o capítulo</h2>		
				<?php }	?>
			</td>
		</tr>
	</table>
	<?php require_once("includes/footer.php");?>
		