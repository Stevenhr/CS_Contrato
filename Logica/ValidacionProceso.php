<?php

$opcion = $_POST["HD_VALIDACION"];

if($opcion == 'validarInicioProcesoItems')
{	
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	
	$manejadorItemsProceso->cararModadlidadTramite();
	$modalidadTramite = $manejadorItemsProceso->getModalidadTramite();

	/*$manejadorItemsProceso->cargarSubdirecciones();
	$subdireccion = $manejadorItemsProceso->getSubdireccion();*/

	$manejadorItemsProceso->cargarActuaciones();
	$actuacion = $manejadorItemsProceso->getActuacion();

	$manejadorItemsProceso->cargarMotivo();
	$motivo = $manejadorItemsProceso->getMotivo();

	$manejadorItemsProceso->cargarDocumento();
	$documento = $manejadorItemsProceso->getDocumento();

	if($modalidadTramite != null && $actuacion != null && $motivo != null && $documento != null)
	{
		echo 1;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>No se puede ver los procesos hasta que todos los Item\'s de Proceso se encuentren diligenciados.</div>';
	}
}

if($opcion == 'cargarContratosAsignados')
{	
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();		
	$manejadorAsignacion->obtenerSolicitudContratoAsignadosPersona($_SESSION["ID_PERSONA_MOD_CONTR"]);
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
					$asignacionContrato .= "<td><button type='button' class='btn btn-link' onClick='ver_proceso(" . $resultadoSolicitud->getIdSolicitud() . ",\"" . $resultadoSolicitud->getAsunto() . "\", \"" . $resultadoSolicitud->getSolicitante() . "\", \"" . $resultadoSolicitud->getFechaSolicitud() . "\", \"" . $resultadoSolicitud->getNombreArea() . "\", \"" . $resultadoSolicitud->getIdSubdireccion() . "\")' title='Ver Proceso'><span class='glyphicon glyphicon-eye-open'></span></button></td>";		
					$asignacionContrato .= "</tr>";					 
			}

			$asignacionContrato .= "</table></div>";

			$asignacionContrato .= "
				 	<script>
						function ver_proceso(idRadicado,asunto,solicitante,fecha, area, subidreccion)
						{												  		
							verProceso(idRadicado,asunto,solicitante,fecha, area, subidreccion);
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

if($opcion == 'finalizarProceso')
{	
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_FINAL"]))
		$observacion = "Se interrumpe el proceso, Razón: " . $_POST["TA_OBSERVACION_FINAL"];
	else		
		$observacion = "Proceso Termiando Correctamente";

	$manejadorAsignacion = new ManejadorAsignacion();	
	$manejadorAsignacion->finalizarProceso($_POST["HD_ID_SOLICITUD"], $observacion);	
	echo 1;
}


if($opcion == 'cargarModalidadTramite')
{

	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cararModadlidadTramite();
	$modalidadTramite = $manejadorItemsProceso->getModalidadTramite();	

    if($modalidadTramite != null)
    {
    	$opcionModadlidad = "";
    	foreach($modalidadTramite as $modalidad)
	    {
			$opcionModadlidad .= "<option value='" .  $modalidad->getIdModalidadTramite() . "'>" .  $modalidad->getNombreModalidadTramite() . "</option>";
	    }
	    echo $opcionModadlidad;
    }
    else
    {
    	echo "";
    }
}

if($opcion == 'cargarSubdirecciones')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cargarSubdirecciones();
	$subdirecciones = $manejadorItemsProceso->getSubdireccion();

    if($subdirecciones != null)
    {
    	$opcionSubdireccion = "";
    	foreach($subdirecciones as $subdireccion)
	    {
			$opcionSubdireccion .= "<option value='" .  $subdireccion->getIdSubdireccion() . "'>" .  $subdireccion->getNombreSubdireccion() . "</option>";
	    }
	    echo $opcionSubdireccion;
    }
    else
    {
    	echo "";
    }
}

if($opcion == 'cargarCheckList')
{
	include("../Datos/ManejadorCheckList.php");
	$manejadorCheckList = new ManejadorCheckList();
	$manejadorCheckList->obtenerCheckList();
	$listaCheckList = $manejadorCheckList->getCheckList();

    if($listaCheckList != null)
    {
    	$opcionCheckList = "";
    	foreach($listaCheckList as $checkList)
	    {
			$opcionCheckList .= "<option value='" .  $checkList->getIdCheckList() . "'>" .  $checkList->getNombreCheckList() . "</option>";
	    }
	    echo $opcionCheckList;
    }
    else
    {
    	echo "";
    }
}

if($opcion == 'cargarItemCheckList')
{
	include("../Datos/ManejadorCheckList.php");
	$manejadorCheckList = new ManejadorCheckList();
	$manejadorCheckList->obtenerCheckListId($_POST["idCheckList"]);
	$checkLists = $manejadorCheckList->getCheckList();
		
	foreach ($checkLists as $checkList)
	{
		$listaChequeoItems = $checkList->getListaCheckListItem();
		if($listaChequeoItems != null)
		{
			$opcionChequeo = "";
			foreach ($listaChequeoItems as $listaChequeoItem)
			{			
				$opcionChequeo .= '<div class="checkbox" >
										<label>
	    									<input type="checkbox" value="' . $listaChequeoItem->getIdCheckListItem() . '" name="checkeItemDinamido">
	    									' .  $listaChequeoItem->getNombreCheckListItem() . '
	  									</label>
									</div>
									<input type="HIDDEN" name="HD_CHECKBOX_NAME' . $listaChequeoItem->getIdCheckListItem() . '" id="HD_CHECKBOX_NAME' . $listaChequeoItem->getIdCheckListItem() . '" value="' .  $listaChequeoItem->getNombreCheckListItem() . '" />
									';
			}
			echo $opcionChequeo;		
		}
		else
		{
			echo 0;
		}
	}	
}


if($opcion == 'cargarActuacion')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cargarActuaciones();
	$actuaciones = $manejadorItemsProceso->getActuacion();

    if($actuaciones != null)
    {
	    $opcionActuacion = "";
	    foreach($actuaciones as $actuacion)
	    {
	    	$opcionActuacion .= "<option value='" .  $actuacion->getIdActuacion() . "'>" .  $actuacion->getNombreActuacion() . "</option>";
		}
		echo $opcionActuacion;
    }
    else
    {
    	echo "";
    }
}

if($opcion == 'cargarMotivo')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cargarMotivo();
	$motivos = $manejadorItemsProceso->getMotivo();

    if($motivos != null)
    {
	    $opcionMotivo = "";
	    foreach($motivos as $motivo)
	    {
	    	$opcionMotivo .= "<option value='" .  $motivo->getIdMotivo() . "'>" .  $motivo->getNombreMotivo() . "</option>";
		}
		echo $opcionMotivo;
    }
    else
    {
    	echo "";
    }
}

if($opcion == 'cargarDocumento')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cargarDocumento();
	$documentos = $manejadorItemsProceso->getDocumento();

    if($documentos != null)
    {
	    $opcionDocumento = "";
	    foreach($documentos as $documento)
	    {
	    	$opcionDocumento .= "<option value='" .  $documento->getIdDocumento() . "'>" .  $documento->getNombreDocumento() . "</option>";
		}
		echo $opcionDocumento;
    }
    else
    {
    	echo "";
    }
}

if($opcion == 'validarEstadoActicion')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	$manejadorItemsProceso->cargarActuaciones();
	$actuaciones = $manejadorItemsProceso->getActuacion();
    foreach($actuaciones as $actuacion)
    {
    	if($actuacion->getIdActuacion() == $_POST["idActuacion"])
    	{
    		if($actuacion->getAccionActuacion() == 1 && $_POST["validacionEstadoCheckList"] == 1)
    			echo $actuacion->getAccionActuacion();
    		else if($actuacion->getAccionActuacion() == 1 && $_POST["validacionEstadoCheckList"] == 0)
    			echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>No puede seleccionar esta opción por que habilitaria el proceso sin haber aprobado el CheckList Estipulado.</div>';
    		else
    			echo $actuacion->getAccionActuacion();
    		break;
    	}	
	}

}

if($opcion == 'obtenerVariableSoporteNombre')
{
	include("../Datos/ManejadorItemsProceso.php");
	$manejadorItemsProceso = new ManejadorItemsProceso();
	echo $manejadorItemsProceso->obtenerVariableSoporteNombre($_POST["nombreVariableSoporte"]);
}


?>