<?php

$opcion = $_POST["HD_VALIDACION"];

if($opcion == 'cargarSolicitudContratos')
{	
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejoPersona.php");
	include('lib/nusoap.php');
	
	$wsdl="http://orfeo.idrd.gov.co/orfeo-3.8.0/webServices/servidor.php?wsdl"; 
	$cliente = new nusoap_client($wsdl,'wsdl');
	$arregloParametros = array('3', '230', $_POST["fechaInicio"], $_POST["fechaFinal"], '180', '', '618');
	$resultadoSolicitudes = $cliente->call('listadoRadicados', $arregloParametros);

	//print_r($resultadoSolicitudes);
	/*$pruebaArray = array();
	$seguimientoContrato = array(1,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(2,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(3,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(4,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(5,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(6,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(7,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(8,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(9,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(10,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(11,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(12,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(13,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);
	$seguimientoContrato = array(14,'Asunto','Dependencia','Solicitante', 'Fecha Solicitud');
	array_push($pruebaArray, $seguimientoContrato);	
	$resultadoSolicitudes = $pruebaArray;*/

	if ($cliente->fault)
	{		
		echo '<br><div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No se pueden obtener las solicitudes de contrato, por favor comuníquese con el área de sistemas.</div>';
			
	}
	else
	{
		$err = $cliente->getError();
		if ($err) 
		{		
			echo '<br><div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No se pueden obtener las solicitudes de contrato, por favor comuníquese con el área de sistemas.</div>';
			echo "Entro: " . $cliente->getError();
		} 
		else
		{								
			if($resultadoSolicitudes != null)
			{

				$manejoPersona = new ManejoPersona();
				$personas = $manejoPersona->otbenerFuncionario();
			    
			    if($personas != null)
			    {
		    		    $listadoAbogado = "<select class='form-control'";
		    		    $listadoAbogado2 = " required>";
		    		    $listadoAbogado2 .= "<option></option>";
					
		    		    foreach($personas as $persona)
						{
							$listadoAbogado2 .= "<option value='" . $persona->getIdPersona() . "'>" . $persona->getPrimerApellido() . " " .  $persona->getPrimerNombre() .  "</option>";											
						}
						$listadoAbogado2 .= "</select>";												
			    }
			    else
			    {
						$listadoAbogado = "<strong>!No hay abogados registrados.</strong>";
						$listadoAbogado2 = "";
			    }


				$manejadorAsignacion = new ManejadorAsignacion();
				$manejadorAsignacion->obtenerSolicitudContrato($resultadoSolicitudes);
				$resultadoSolicitudesFinal = $manejadorAsignacion->getSeguimientoContrato();
				if($resultadoSolicitudesFinal != null)
				{
					$asignacionContrato = "<br><br><div class='table-responsive'><table class='table table-bordered table-responsive'>
					        					<tr>
					        		 				<th>Radicado</th> <th>Asunto</th> <th>Solicitante</th> <th>Fecha Solicitud</th> <th>Área</th> <th>Subdirección</th> <th>Abogado</th> <th>Opciones</th>
						  						</tr>";	

					foreach ($resultadoSolicitudesFinal as $resultadoSolicitud)
					{											
							$asignacionContrato .= "<tr id='" . $resultadoSolicitud->getIdSolicitud() . "'>";					 
							$asignacionContrato .= "<td>" . $resultadoSolicitud->getIdSolicitud()  . "</td>";
							$asignacionContrato .= "<td>" . $resultadoSolicitud->getAsunto()  . "</td>";
							$asignacionContrato .= "<td>" . $resultadoSolicitud->getSolicitante()  . "</td>";
							$asignacionContrato .= "<td>" . $resultadoSolicitud->getFechaSolicitud()  . "</td>";
							$asignacionContrato .= "<td>" . $resultadoSolicitud->getNombreArea()  . "</td>";
							$asignacionContrato .= "<td>" . $resultadoSolicitud->getIdSubdireccion()  . "</td>";							
							
							if($listadoAbogado2 != "")
							{
								$asignacionContrato .= "<td>" . $listadoAbogado  .  " id='" . $resultadoSolicitud->getIdSolicitud() .  "_ABOG' " . $listadoAbogado2 . "</td>";
								//$asignacionContrato .= "<td><button type='button' class='asignar_abogado btn btn-link' id='". $resultadoSolicitud->getIdSolicitud() ."' title='Asignar Abogado'><span class='glyphicon glyphicon-saved'></span></button></td>";										
								$asignacionContrato .= "<td><button type='button' class='btn btn-link' onClick='asignar_abogado(" . $resultadoSolicitud->getIdSolicitud() . ",\"" . remplazarCaracteres($resultadoSolicitud->getAsunto()) . "\", \"" . $resultadoSolicitud->getSolicitante() . "\", \"" . $resultadoSolicitud->getFechaSolicitud() . "\", \"" . $resultadoSolicitud->getNombreArea() . "\", \"" . $resultadoSolicitud->getIdSubdireccion() . "\")' title='Asignar Abogado'><span class='glyphicon glyphicon-saved'></span></button></td>";		
							}
							else
							{
								$asignacionContrato .= "<td>" . $listadoAbogado  .  "</td>";							
								$asignacionContrato .= "<td> -- </td>";							
							}

							$asignacionContrato .= "</tr>";					 
					}

					$asignacionContrato .= "</table></div>";

					$asignacionContrato .= "<script>

													function asignar_abogado(idRadicado,asunto,solicitante,fecha, area, subdireccion)
													{												  		
												  		
												  		var idAbogado = $('#' + idRadicado + '_ABOG').val();												  														  		
														asignarAbogdo(idRadicado,asunto,solicitante,fecha,idAbogado, area, subdireccion);
													}

											</script>";					
					echo $asignacionContrato;
				}
				else
				{
					echo '<br><div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No hay nuevas solicitudes de contrato para este rango de fechas.</div>';					
				}

			}
			else
			{
				echo '<br><div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No hay nuevas solicitudes de contrato para este rango de fechas.</div>';				

			}
		
		}		
	}
	

}

if($opcion == 'asignarAbogado')
{	
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");
	include("../Datos/Persona.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->asignarContrato($_POST["idRadicado"], $_POST["asunto"], $_POST["solicitante"], $_POST["fecha"], $_POST["idAbogado"], $_POST["area"], $_POST["subdireccion"]);			

	echo 1;
}

if($opcion == 'cargarSolicitudContratosAsignados')
{	
		include("../Datos/ManejadorAsignacion.php");
		include("../Datos/ManejoPersona.php");
		
		$manejoPersona = new ManejoPersona();
		$personas = $manejoPersona->otbenerFuncionario();
	    
	    if($personas != null)
	    {
			    $listadoAbogado = "<select class='form-control'";
			    $listadoAbogado2 = " required>";
			    $listadoAbogado2 .= "<option></option>";
			
			    foreach($personas as $persona)
				{
					$listadoAbogado2 .= "<option value='" . $persona->getIdPersona() . "'>" . $persona->getPrimerApellido() . " " .  $persona->getPrimerNombre() .  "</option>";											
				}
				$listadoAbogado2 .= "</select>";												
	    }
	    else
	    {
				$listadoAbogado = "<strong>!No hay abogados registrados.</strong>";
				$listadoAbogado2 = "";
	    }
		
		$manejadorAsignacion = new ManejadorAsignacion();
		$manejadorAsignacion->obtenerSolicitudContratoAsignados($_POST["fechaInicio"], $_POST["fechaFinal"]);
		$resultadoSolicitudesFinal = $manejadorAsignacion->getSeguimientoContrato();
		if($resultadoSolicitudesFinal != null)
		{
			$asignacionContrato = "<br><br><div class='table-responsive'><table class='table table-bordered table-responsive'>
			        					<tr>
			        		 				<th>Radicado</th> <th>Asunto</th> <th>Solicitante</th> <th>Fecha Solicitud</th> <th>Abogado</th> <th>Opciones</th>
				  						</tr>";	

			foreach ($resultadoSolicitudesFinal as $resultadoSolicitud)
			{											
					$asignacionContrato .= "<tr id='" . $resultadoSolicitud->getIdSolicitud() . "'>";					 
					$asignacionContrato .= "<td>" . $resultadoSolicitud->getIdSolicitud()  . "</td>";
					$asignacionContrato .= "<td>" . $resultadoSolicitud->getAsunto()  . "</td>";
					$asignacionContrato .= "<td>" . $resultadoSolicitud->getSolicitante()  . "</td>";
					$asignacionContrato .= "<td>" . $resultadoSolicitud->getFechaSolicitud()  . "</td>";
					
					if($listadoAbogado2 != "")
					{
						$asignacionContrato .= "<td>" . $listadoAbogado  .  " id='" . $resultadoSolicitud->getIdSolicitud() .  "_ABOG_2' " . $listadoAbogado2 . "</td>";						
						$asignacionContrato .= "<td><button type='button' class='btn btn-link' onClick='reasignar_abogado(" . $resultadoSolicitud->getIdSolicitud() . ")' title='Reasignar Abogado'><span class='glyphicon glyphicon-saved'></span></button></td>";		
					}
					else
					{
						$asignacionContrato .= "<td>" . $listadoAbogado  .  "</td>";							
						$asignacionContrato .= "<td> -- </td>";							
					}

					$asignacionContrato .= "</tr>";					 
			}

			$asignacionContrato .= "</table></div>";

			$asignacionContrato .= "<script>
											function marcarAbogado(idRadicado, idPersona)
											{
												$('#' + idRadicado + '_ABOG_2').val(idPersona);												  														  		
											}
									</script>";			

			foreach ($resultadoSolicitudesFinal as $resultadoSolicitud)
			{
				$asignacionContrato .= "<script>marcarAbogado(" .  $resultadoSolicitud->getIdSolicitud()  . "," . $resultadoSolicitud->getIdPersona() . ");</script>";
			}

			$asignacionContrato .= "<script>

											function reasignar_abogado(idRadicado)
											{												  		
										  		var idAbogado = $('#' + idRadicado + '_ABOG_2').val();												  														  		
												reasignarAbogdo(idRadicado,idAbogado);
											}

									</script>";					


			echo $asignacionContrato;

		}
		else
		{
			echo '<br><div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No hay solicitudes de contrato para este rango de fechas.</div>';				
		}

}


if($opcion == 'reasignarAbogado')
{	
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");
	include("../Datos/Persona.php");

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->reasignarContrato($_POST["idRadicado"], $_POST["idAbogado"]);	
	echo 1;
}


if($opcion == 'cargarContratosAsignadosInactivos')
{	
		include("../Datos/ManejadorAsignacion.php");
		include("../Datos/Persona.php");
							    		
		$manejadorAsignacion = new ManejadorAsignacion();
		$manejadorAsignacion->obtenerSolicitudContratoAsignadosInactivos();
		$resultadoSolicitudesFinal = $manejadorAsignacion->getSeguimientoContrato();
		if($resultadoSolicitudesFinal != null)
		{			
			$persona = new Persona();		
			$asignacionContrato = "<br><br><div class='table-responsive'><table class='table table-bordered table-responsive'>
			        					<tr>
			        		 				<th>Radicado</th> <th>Asunto</th> <th>Solicitante</th> <th>Fecha Solicitud</th> <th>Abogado</th> <th>Opciones</th>
				  						</tr>";	

			foreach ($resultadoSolicitudesFinal as $resultadoSolicitud)
			{											
					$asignacionContrato .= "<tr id='" . $resultadoSolicitud->getIdSolicitud() . "'>";					 
					$asignacionContrato .= "<td>" . $resultadoSolicitud->getIdSolicitud()  . "</td>";
					$asignacionContrato .= "<td>" . $resultadoSolicitud->getAsunto()  . "</td>";
					$asignacionContrato .= "<td>" . $resultadoSolicitud->getSolicitante()  . "</td>";
					$asignacionContrato .= "<td>" . $resultadoSolicitud->getFechaSolicitud()  . "</td>";									
							
					$persona->cargarPersonaPorId($resultadoSolicitud->getIdPersona());

					$asignacionContrato .= "<td>" . $persona->getPrimerApellido() . " " . $persona->getPrimerNombre() . "</td>";											
					$asignacionContrato .= "<td><button type='button' class='iniciar_proceso btn btn-link' id='". $resultadoSolicitud->getIdSolicitud() ."' title='Iniciar Proceso'><span class='glyphicon glyphicon-check'></span></button></td>";		

					$asignacionContrato .= "</tr>";					 
			}

			$asignacionContrato .= "</table></div>";	

			$asignacionContrato .= "
				<script>
					$('.iniciar_proceso').click(function(){
						  var idSolicitud = $(this).attr('id');
						  iniciarProceso(idSolicitud);
											          });		 
					</script>
					";

			echo $asignacionContrato;

		}
		else
		{
			echo '<br><div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No hay solicitudes de contrato para activar.</div>';				
		}
}


if($opcion == 'activarProceso')
{	
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");
	include("../Datos/Persona.php");

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->activarProceso($_POST["idSolicitud"]);	
	echo 1;
}

function remplazarCaracteres($texto)
{
	/*$vowels = array("'", "\"", "\“", "\”");
	$onlyconsonants = str_replace($vowels, "", $texto);
	return $onlyconsonants;*/
		
	$textoLimpio = ereg_replace("[^A-Za-z0-9 -_,:.áéíóúÁÉÍÓÚñÑ]", "", $texto);								
      	return $textoLimpio;	
}

?>