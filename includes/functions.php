<?php
function verificar_consulta($consulta)
{
if(!$consulta)
		{
		die("No se pudo realizarconexion a la basedatos :" .mysql_error());	
		}
}

function validar_campos_obligatorios($campos_obligatorios,$errores)	
 {
 		foreach ($campos_obligatorios as $campo) 
{
		if(!isset($_POST[$campo]) || (empty ($_POST[$campo]) && !is_numeric($_POST[$campo])))
	{
		$errores[]=$campo;
	}
  }
 }
function obtener_cursos()
{   
	global $conexion;
	$consulta = "SELECT * 
	FROM cursos
	ORDER BY posicion ASC";
	$cursos = mysql_query($consulta,$conexion);//eliminé la variable $conexion, aparecía como nula.
	verificar_consulta($cursos);
	return $cursos;
}

function obtener_capitulos_por_curso  ($curso_id)
{
	global $conexion;
	$consulta = "SELECT  *
				FROM capitulos 
				WHERE curso_id = {$curso_id} 
				ORDER BY posicion ASC";
						$capitulos = mysql_query($consulta,$conexion);
					verificar_consulta($capitulos);
					return $capitulos;
}
function obtener_curso_por_id($curso_id)
{
	global $conexion;
	$consulta = "SELECT * FROM cursos WHERE id=" . $curso_id . " LIMIT 1";
	$respuesta =mysql_query($consulta,$conexion);
	verificar_consulta($respuesta);
	if($curso = mysql_fetch_array($respuesta)) 
	{
		return $curso;
	}
	else 
	{
		return NULL;
	}
	
	}

	function obtener_capitulo_por_id($capitulo_id)
{
	global $conexion;
	$consulta = "SELECT * FROM capitulos WHERE id=" . $capitulo_id . " LIMIT 1";
	$respuesta =mysql_query($consulta,$conexion);
	verificar_consulta($respuesta);
	if($capitulo = mysql_fetch_array($respuesta)) 
	{
		return $capitulo;
	}
	else 
	{
		return NULL;
	}
	
	}

	// funcion obtener pagina minuto 6.
	function obtener_pagina()
	{       
			global $curso_reg;
			global $capitulo_reg;
if(isset($_GET["curso"]))
{
	$curso_reg = obtener_curso_por_id($_GET["curso"]);
	$capitulo_reg = NULL;
} 
elseif (isset($_GET["capitulo"]))
 {
 	$capitulo_reg = obtener_capitulo_por_id($_GET["capitulo"]);
 	$curso_reg = NULL; 
 }
 	else
 	{
 		$capitulo_reg = NULL;
 		$curso_reg = NULL;
 	}
	}
function menu($curso_reg,$capitulo_reg) 	
 {
 	$salida = "<ul class=\"cursos\">";
	$cursos = obtener_cursos();
	while($curso = mysql_fetch_array($cursos))
		{
		$salida .= "<li";
		if($curso["id"] == $curso_reg["id"] )
		{
		$salida .= "class=\"selected\"";
		}	

		$salida .= "><a href=\"edit_course.php?curso=" .urlencode($curso["id"]) ."\">" . $curso["nombre"] . "</a></li><ul class = 'capitulos'>";
				
	$capitulos = obtener_capitulos_por_curso($curso["id"]);
		while($capitulo = mysql_fetch_array($capitulos))
			{
				$salida .= "<li";
				if($capitulo["id"] == $capitulo_reg["id"] )
				{
				$salida .= "class=\"selected\"";
				}
				$salida .= "><a href=\"content.php?capitulo=" . urlencode($capitulo["id"]) . "\">" . $capitulo["nombre"] . "</a></li>";
					}
                $salida .= "</ul>";
             }
                $salida .= "</ul>";
                return $salida;
            }
?>					