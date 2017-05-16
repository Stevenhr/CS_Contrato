<?php

include("../Datos/Persona.php");

$opcion = $_POST["opcion"];

if($opcion == 1)
{	
	validarUsuario($_POST["idPersona"]);
}

function validarUsuario($idPersona)
{	
	$persona = new Persona();
	if($persona->cargarPersonaPorId($idPersona))
	{
		session_start();
		$_SESSION['idPersona'] = $persona->getIdPersona();
		$resultadoPersona = array();
		$resultadoPersona[0]["idPersona"] = $persona->getIdPersona();		
		$resultadoPersona[0]["Primer_Apellido"] = $persona->getPrimerApellido();				
		$resultadoPersona[0]["Primer_Nombre"] = $persona->getPrimerNombre();								
		print_r(json_encode($resultadoPersona[0]));  
	}
	else
	{
		echo 0;
	}
}

if($opcion == 'proximosEventosPorAbogado')
{	
	include("../Datos/ManejadorCalendario.php");
	$manejadorCalendario = new ManejadorCalendario();
	$manejadorCalendario->proximosEventosPorAbogado($_POST["idPersona"]);
	$calendarios = $manejadorCalendario->getCalendario();

	if($calendarios != null)
	{				
		
		$proximoEvento = '<blockquote><p><kbd>AUDIENCIAS EN LOS PROXIMOS 15 DÍAS.</kbd></p></blockquote>';
		$proximoEvento .= '<div class="table-responsive"><table class="table table-hover">';
		$proximoEvento .= '<tr><th>ABOGADO</th><th>FECHA AUDIENCIA DE RIESGO</th><th>JORNADA</th><th>FECHA CIERRE PROCESOS</th><th>FECHA AUDIENCIA ADJUDICACIÓN</th><th>JORNADA</th></tr>';

		foreach ($calendarios as $calendario)
		{			
			$proximoEvento .= "<tr>";			
			$proximoEvento .= "<td>" .  $calendario->getNombreAbogado() .  "</td>";			
			if($calendario->getFechaAudienciaRiesgo() != null)
			{
				$proximoEvento .= "<td class='danger'>" .  $calendario->getFechaAudienciaRiesgo() .  "</td>";				
				$proximoEvento .= "<td class='danger'>" .  $calendario->getJornadaAudienciaRiesgo() .  "</td>";			
			}
			else
			{
				$proximoEvento .= "<td>" .  $calendario->getFechaAudienciaRiesgo() .  "</td>";			
				$proximoEvento .= "<td>" .  $calendario->getJornadaAudienciaRiesgo() .  "</td>";							
			}
			if($calendario->getFechaCierreProcesos() != null)
			{
				$proximoEvento .= "<td class='danger'>" .  $calendario->getFechaCierreProcesos() .  "</td>";				
			}
			else
			{
				$proximoEvento .= "<td>" .  $calendario->getFechaCierreProcesos() .  "</td>";			
			}			
			if($calendario->getFechaAudienciaAdjudicacion() != null)
			{
				$proximoEvento .= "<td class='danger'>" .  $calendario->getFechaAudienciaAdjudicacion() .  "</td>";				
				$proximoEvento .= "<td class='danger'>" .  $calendario->getJornadaAudienciaAdjudicacion() .  "</td>";			
			}
			else
			{
				$proximoEvento .= "<td>" .  $calendario->getFechaAudienciaAdjudicacion() .  "</td>";			
				$proximoEvento .= "<td>" .  $calendario->getJornadaAudienciaAdjudicacion() .  "</td>";							
			}			
			$proximoEvento .= "</tr>";			
		}

		$proximoEvento .= '</div></table/>';
		echo $proximoEvento;
	}
	else
	{
		echo '';
	}
}

?>