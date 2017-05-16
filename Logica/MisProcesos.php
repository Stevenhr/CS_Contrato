<?php

$opcion = $_POST["HD_VALIDACION"];

if($opcion == 'busquedaAbogado')
{
	
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");
	
	$manejadorAsignacion = new ManejadorAsignacion();

		$manejadorAsignacion->obtenerSolicitudContratoAsignadosPersonaFecha($_SESSION["ID_PERSONA_MOD_CONTR"], $_POST["TX_FECHA_INICIO"], $_POST["TX_FECHA_FINAL"]);		
		$resultadoSolicitudes = $manejadorAsignacion->getSeguimientoContrato();
		if($resultadoSolicitudes != null)
		{
				$asignacionContrato = "<br><div class='table-responsive' id='DIV_TABLA_CONTRATOS'><table class='table table-bordered table-responsive'>
				        					<tr>
				        		 				<th>Radicado</th> <th>Asunto</th> <th>Solicitante</th> <th>Fecha Solicitud</th>  <th>Área</th> <th>Subdirección</th> <th>Opciones</th>
					  						</tr>";	

				foreach ($resultadoSolicitudes as $resultadoSolicitud)
				{											
						$asignacionContrato .= "<tr>";					 
						$asignacionContrato .= "<td>" . $resultadoSolicitud->getIdSolicitud()  . "</td>";
						$asignacionContrato .= "<td>" . $resultadoSolicitud->getAsunto()  . "</td>";
						$asignacionContrato .= "<td>" . $resultadoSolicitud->getSolicitante()  . "</td>";
						$asignacionContrato .= "<td>" . $resultadoSolicitud->getFechaSolicitud()  . "</td>";
						$asignacionContrato .= "<td>" . $resultadoSolicitud->getNombreArea()  . "</td>";
						$asignacionContrato .= "<td>" . $resultadoSolicitud->getIdSubdireccion()  . "</td>";												
						$asignacionContrato .= "<td><button type='button' class='btn btn-link' onClick='ver_proceso_historial(" . $resultadoSolicitud->getIdSolicitud() . ")' title='Ver Proceso'><span class='glyphicon glyphicon-eye-open'></span></button></td>";		
						$asignacionContrato .= "</tr>";					 
				}

				$asignacionContrato .= "</table></div>";

				$asignacionContrato .= "
					 	<script>
							function ver_proceso_historial(idRadicado)
							{												  		
								ver_proceso_historial_2(idRadicado);
							}
						</script>
						";

				echo $asignacionContrato;
		}
		else
		{
			echo 0;		
		}		
}

?>