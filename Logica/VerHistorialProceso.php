<?php

$opcion = $_POST["HD_VALIDACION"];

if($opcion == 'busquedaNumeroRadicado')
{
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");
	
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->obtenerSeguimientoId($_POST["TX_RADICADO"]);
	$seguimientoContratos = $manejadorAsignacion->getSeguimientoContrato();

	if($seguimientoContratos != null)
	{
		foreach ($seguimientoContratos as $seguimientoContrato)
		{
			$reporteHistorial = '<br><br><blockquote><p><strong>' . $seguimientoContrato->getAsunto() . '</strong></p><footer>' .  $seguimientoContrato->getIdSolicitud() . '</footer><footer>' .  $seguimientoContrato->getSolicitante() . '</footer><footer>' .  $seguimientoContrato->getFechaSolicitud() . '</footer><footer>' .  $seguimientoContrato->getNombreArea() . '</footer><footer>' .  $seguimientoContrato->getIdSubdireccion() . '</footer></blockquote>';
			break;	
		}

		$manejadorHistorial = new ManejadorHistorial();
		$manejadorHistorial->obtenerHistorial($seguimientoContrato->getIdSolicitud(), $manejadorAsignacion->getDb());
		$historial = $manejadorHistorial->getHistorial();
		$reporteHistorial .= '<table class="table table-hover">';
		$reporteHistorial .= '<thead><tr><th>Fecha</th><th>Operación</th></tr></thead>';
		$reporteHistorial .= '<tbody>';
		$fechaRango1 = null;
		$fechaRango2 = null;
		$auxFecha = null;	
		$conFecha = -1;	
		foreach ($historial as $historia)
		{
			if($fechaRango1 == null)
			{
				$fechaRango1 = new DateTime($historia->getFecha());			
				$textoFecha = "";			
			}
			else
			{				
				if($conFecha == -1)
				{
					$fechaRango2 = new DateTime($historia->getFecha());
					$auxFecha = $fechaRango2;
					$conFecha++;
				}	
				else
				{
					$fechaRango1 = $auxFecha;
					$fechaRango2 = new DateTime($historia->getFecha());
					$auxFecha = $fechaRango2;
				}		

				$interval = date_diff($fechaRango1, $fechaRango2);
				$textoFecha = "<h6><em>Tiempo transcurrido al proceso anterior: " . $interval->format('%R%a días') . ".</em></h6>";					
			}

			$reporteHistorial .= "<tr>";
			$reporteHistorial .= "<th scope='row'>" . $historia->getFecha() . "</th>";
			$reporteHistorial .= "<td>" . $historia->getSeguimiento() . ".<br><br><br>" . $textoFecha . "</td>";
			$reporteHistorial .= "</tr>";
		}			
		$reporteHistorial .= '</tbody></table>';
		echo $reporteHistorial;					
	}
	else
	{
		echo 0;
	}
}

if($opcion == 'cargarFuncionarios')
{
	session_start();
	include("../Datos/ManejoPersona.php");
	$manejoPersona = new ManejoPersona();
	$personas = $manejoPersona->otbenerFuncionario();

    if($personas != null)
    {     
	    $vectorAbogado = array();
	    $i = 0;
	    foreach($personas as $persona)
	    {				 
			 $vectorAbogado[$i]["idPersona"] = $persona->getIdPersona();
			 $vectorAbogado[$i]["nombrePersona"] = $persona->getPrimerApellido() . " " . $persona->getPrimerNombre();
			 $i++;
	    }	  
	    print_r(json_encode($vectorAbogado));
    }
    else
    {
    	echo 0;
    }   
}

if($opcion == 'cargarSubdireccionesProceso')
{
	session_start();
	include("../Datos/ManejadorItemsProceso.php");
	$manejoItemProceso = new ManejadorItemsProceso();
	$manejoItemProceso->cargarSubdireccionesProceso();
	$subdirecciones = $manejoItemProceso->getSubdireccion();

    if($subdirecciones != null)
    {     
	    $vectorSubdirecciones = array();
	    $i = 0;
	    foreach($subdirecciones as $subdireccion)
	    {				 
			 $vectorSubdirecciones[$i]["nombreSubdireccion"] = $subdireccion->getNombreSubdireccion();			 
			 $i++;
	    }	  
	    print_r(json_encode($vectorSubdirecciones));
    }
    else
    {
    	echo 0;
    }   
}

if($opcion == 'busquedaAbogado')
{
	
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");
	
	$manejadorAsignacion = new ManejadorAsignacion();

		$manejadorAsignacion->obtenerSolicitudContratoAsignadosPersonaFecha($_POST["SL_ABOGADO"], $_POST["TX_FECHA_INICIO"], $_POST["TX_FECHA_FINAL"]);		
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

if($opcion == 'busquedaSubdireccion')
{
	
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");
	
	$manejadorAsignacion = new ManejadorAsignacion();

		$manejadorAsignacion->obtenerSolicitudContratoAsignadosSubdireccion($_POST["SL_SUBDIRECCION"], $_POST["TX_FECHA_INICIO_2"], $_POST["TX_FECHA_FINAL_2"]);		
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