<?php

$opcion = $_POST["HD_VALIDACION"];

if($opcion == 'guardarIniciacion')
{	
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	include("../Datos/ModalidadTramite.php");	
	include("../Datos/Subdireccion.php");	
	
	if(isset($_POST["TA_OBSERVACION_1"]))
		$observacion = $_POST["TA_OBSERVACION_1"];
	else		
		$observacion = "--";
	
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarIniciacion($_POST["HD_ID_SOLICITUD"], $_POST["TA_OBJETO"], $_POST["SL_MODALIDAD"], $_POST["TX_VALOR_ESTIMADO"], null, $observacion);
	echo 1;
}

if($opcion == 'validarIniciacion')
{	
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarIniciacion($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["idSolicitud"] = $seguimiento->getIdSolicitud();
			$seguimientoContrato["objeto"] = $seguimiento->getObjeto();
			$seguimientoContrato["idModalidad"] = $seguimiento->getIdModalidadTramite();
			$seguimientoContrato["valorEstimando"] = $seguimiento->getValorEstimado();			
			print_r(json_encode($seguimientoContrato));
			break;
	}
	
}

if($opcion == 'guardarVerificacion')
{
	
	$idSolicitud = $_POST["HD_ID_SOLICITUD"];
	$idCheckList = $_POST["SL_CHECK_LIST"];
	$idActuacion = $_POST["SL_ACTUACION"];
	$aprobacionCheckList = $_POST["HD_VALIDACION_CHECK_LIST"];
	$datosCheckList = $_POST["HD_DATOS_CHECK_LIST"];

	if(isset($_POST["TA_OBSERVACION_2"]))
		$observacion = $_POST["TA_OBSERVACION_2"];
	else		
		$observacion = "--";


	if(isset($_POST["SL_MOTIVO"]) && isset($_POST["SL_DOCUMENTO"]))
	{
		$idMotivo = $_POST["SL_MOTIVO"];
		$idDocumento = $_POST["SL_DOCUMENTO"];
	}
	else
	{
		$idMotivo = 0;
		$idDocumento = 0;
	}

	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	include("../Datos/ListaChequeo.php");
	include("../Datos/Actuacion.php");
	include("../Datos/Motivo.php");
	include("../Datos/Documento.php");
	
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarVerificacionDocumentos($idSolicitud, $idCheckList, $idActuacion, $idMotivo, $idDocumento, $aprobacionCheckList, $datosCheckList, $observacion);
	
	if($idMotivo == 0)	
		echo 1;	
	else
		echo 0;	

}

if($opcion == 'validarVerificacionDocumentos')
{	
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarVerificacionDocumentos($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["idSolicitud"] = $seguimiento->getIdSolicitud();
			$seguimientoContrato["idCheckList"] = $seguimiento->getIdCheckList();
			$seguimientoContrato["idActuacion"] = $seguimiento->getIdActuacion();
			$seguimientoContrato["idMotivo"] = $seguimiento->getIdMotivo();
			$seguimientoContrato["idDocumento"] = $seguimiento->getIdDocumento();			
			print_r(json_encode($seguimientoContrato));
			break;
	}
	
}

if($opcion == 'guardarFechaRadicacion')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	

	if(isset($_POST["TA_OBSERVACION_3"]))
		$observacion = $_POST["TA_OBSERVACION_3"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarFechaRadicacion($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_RADICACION"], $observacion);
	echo 1;
	
}

if($opcion == 'validarFechaRadicacion')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaRadicacion($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaSolicitud"] = $seguimiento->getFechaRadicacion();
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarFechaSesionComiteAprobracion')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_4"]))
		$observacion = $_POST["TA_OBSERVACION_4"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarFechaSesionComiteAprobacion($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_SESION_COMITE_APROBACION"], $observacion);
	echo 1;
	
}

if($opcion == 'validarFechaSesionComiteAprobracion')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaSesionComiteAprobracion($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaSesionComiteAprobacion"] = $seguimiento->getFechaSesionComiteAprobacion();
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}



if($opcion == 'guardarFechaPublicacionConSecop')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_5"]))
		$observacion = $_POST["TA_OBSERVACION_5"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarFechaPublicacionConSecop($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_PUBLICACION_CONVOCATORIA_SECOP"], $observacion);
	echo 1;
	
}

if($opcion == 'validarFechaPublicacionConSecop')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaPublicacionConSecop($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaPublicacionSecop"] = $seguimiento->getFechaPublicacionSecop();
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}


if($opcion == 'guardarFechaAudienciaRiesgos')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_6"]))
		$observacion = $_POST["TA_OBSERVACION_6"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	echo $manejadorAsignacion->guardarFechaAudienciaRiesgos($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_AUDIENCIA_RIESGOS"], $_POST["SL_Jornada_AUD_RIES"], $observacion);	
}

if($opcion == 'validarFechaAudienciaRiesgos')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaAudienciaRiesgos($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaAudienciaRiesgo"] = $seguimiento->getFechaAudienciaRiesgo();
			$seguimientoContrato["jornadaAudienciaRiesgo"] = $seguimiento->getJornadaAudienciaRiesgo();
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarNumeroFechaResolucionAperProc')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_7"]))
		$observacion = $_POST["TA_OBSERVACION_7"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarNumeroFechaAperturaProceso($_POST["HD_ID_SOLICITUD"], $_POST["TX_NUMERO_RESOLUCION_APERTURA_PROCESO"], $_POST["DT_FECHA_RESOLUCION_APERTURA_PROCESO"], $observacion);
	echo 1;
	
}

if($opcion == 'validarNumeroFechaResolucionAperProc')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarNumeroFechaResolucionAperProc($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["numeroAperturaProceso"] = $seguimiento->getNumeroAperturaProceso();
			$seguimientoContrato["fechaResolucionAperturaProceso"] = $seguimiento->getFechaResolucionAperturaProceso();
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarFechaPublicacionPrepliegosSECOP')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_8"]))
		$observacion = $_POST["TA_OBSERVACION_8"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarFechaPublicacionPrepliegosSECOP($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_PUB_PREPLIEGOS_SECOP"], $observacion);
	echo 1;
	
}

if($opcion == 'validarFechaPublicacionPrepliegosSECOP')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaPublicacionPrepliegosSECOP($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaPublicacionPliegosSecop"] = $seguimiento->getFechaPublicacionPrepliegosSecop();			
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarFechaPublicacionPliegosDefinitivoSECOP')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_9"]))
		$observacion = $_POST["TA_OBSERVACION_9"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarFechaPublicacionPliegosDefinitivoSECOP($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_PUB_PLIEGOS_DEF_SECOP"], $observacion);
	echo 1;
	
}

if($opcion == 'validarFechaPublicacionPliegosDefinitivoSECOP')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaPublicacionPliegosDefinitivoSECOP($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaPublicacionPliegosSecop"] = $seguimiento->getFechaPublicacionPliegosSecop();			
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarFechaCierreProcesos')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_10"]))
		$observacion = $_POST["TA_OBSERVACION_10"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	echo $manejadorAsignacion->guardarFechaCierreProcesos($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_CIERRE_PROCESOS"], $observacion);	
	
}

if($opcion == 'validarFechaCierreProcesos')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaCierreProcesos($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaCierreProceso"] = $seguimiento->getFechaCierreProceso();			
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarFechaPublicacionEvaluacionPreliminar')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_17"]))
		$observacion = $_POST["TA_OBSERVACION_17"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarFechaPublicacionEvaluacionPreliminar($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_PUB_EVAL_PRELIMINAR"], $observacion);
	echo 1;
	
}

if($opcion == 'validarFechaPublicacionEvaluacionPreliminar')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaPublicacionEvaluacionPreliminar($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaPublicacionEvaluacionPreliminar"] = $seguimiento->getFechaPublicacionEvaluacionPreliminar();			
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}


if($opcion == 'guardarFechaSesionComiteAprobracion2')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_11"]))
		$observacion = $_POST["TA_OBSERVACION_11"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarFechaSesionComiteAprobacion2($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_SESION_COMITE_APROBACION_2"], $observacion);
	echo 1;
	
}

if($opcion == 'validarFechaSesionComiteAprobracion2')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaSesionComiteAprobracion2($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaSesionComiteAprobacion2"] = $seguimiento->getFechaSesionComiteAprobacion2();			
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarFechaPublicacionEvaluaiconDefinitiva')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_12"]))
		$observacion = $_POST["TA_OBSERVACION_12"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarFechaPublicacionEvaluaiconDefinitiva($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_PUB_EVAL_DEFINITIVA"], $observacion);
	echo 1;
	
}

if($opcion == 'validarFechaPublicacionEvaluaiconDefinitiva')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaPublicacionEvaluaiconDefinitiva($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaPublicacionEvaluaiconDefinitiva"] = $seguimiento->getFechaPublicacionEvaluaiconDefinitiva();			
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarFechaAudienciaAdjudicacion')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_13"]))
		$observacion = $_POST["TA_OBSERVACION_13"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	echo $manejadorAsignacion->guardarFechaAudienciaAdjudicacion($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_AUD_ADJUDICACION"], $_POST["SL_Jornada_AUD_ADJUDICACION"], $observacion);	
}

if($opcion == 'validarFechaAudienciaAdjudicacion2')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaAudienciaAdjudicacion2($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaAudienciaAdjudicacion"] = $seguimiento->getFechaAudienciaAdjudicacion();			
			$seguimientoContrato["jornadaAudienciaAdjudicacion"] = $seguimiento->getJornadaAudienciaAdjudicacion();			
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarFechaNumeroResolucionAdjudicacion')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_14"]))
		$observacion = $_POST["TA_OBSERVACION_14"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarFechaNumeroResolucionAdjudicacion($_POST["HD_ID_SOLICITUD"], $_POST["TX_NUMERO_RESOLUCION_ADJUDICACION"], $_POST["DT_FECHA_RESOLUCION_ADJUDICACION"], $observacion);	
	echo 1;
}

if($opcion == 'validarFechaNumeroResolucionAdjudicacion')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaNumeroResolucionAdjudicacion($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["numeroResolucionAdjudicacion"] = $seguimiento->getNumeroResolucionAdjudicacion();			
			$seguimientoContrato["fechaResolucionAdjudicacion"] = $seguimiento->getFechaResolucionAdjudicacion();			
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarElaboracionContrato')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_15"]))
		$observacion = $_POST["TA_OBSERVACION_15"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarElaboracionContrato($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_ELABORACION_CONTRATO"], $_POST["TX_NUMERO_SUSCRIPCION"], $_POST["TX_NOMBRE_CONTRATISTA"], $_POST["TX_VALOR_CONTRATO"], $_POST["TX_PLAZO_EJECUCION"], $_POST["TX_SUPERVISOR"], $observacion);	
	echo 1;
}

if($opcion == 'validarElaboracionContrato')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarElaboracionContrato($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaElaboracionContrato"] = $seguimiento->getFechaElaboracionContrato();			
			$seguimientoContrato["numeroSuscripcion"] = $seguimiento->getNumeroSuscripcion();			
			$seguimientoContrato["nombreContratista"] = $seguimiento->getNombreContratista();			
			$seguimientoContrato["valorContrato"] = $seguimiento->getValorContrato();			
			$seguimientoContrato["plazoEjecucion"] = $seguimiento->getPlazoEjecucion();			
			$seguimientoContrato["supervisor"] = $seguimiento->getSupervisor();						
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'guardarFechaEntregaConcepto')
{
	session_start();
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/ManejadorHistorial.php");	
	
	if(isset($_POST["TA_OBSERVACION_18"]))
		$observacion = $_POST["TA_OBSERVACION_18"];
	else		
		$observacion = "--";

	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->guardarFechaEntregaConcepto($_POST["HD_ID_SOLICITUD"], $_POST["DT_FECHA_ENTREGA_CONCEPTO"], $observacion);
	echo 1;
	
}

if($opcion == 'validarFechaEntregaConcepto')
{
	include("../Datos/ManejadorAsignacion.php");
	$manejadorAsignacion = new ManejadorAsignacion();
	$manejadorAsignacion->validarFechaEntregaConcepto($_POST["HD_ID_SOLICITUD"]);
	$seguimientoContrato = $manejadorAsignacion->getSeguimientoContrato(); 
	
	foreach($seguimientoContrato as $seguimiento)
	{
			$seguimientoContrato = array();
			$seguimientoContrato["fechaEntregaConcepto"] = $seguimiento->getFechaEntregaConcepto();			
			print_r(json_encode($seguimientoContrato));
			break;
	}	
}

if($opcion == 'cargarPanelNavegacion')
{
	include("../Datos/ManejadorAsignacion.php");
	include("../Datos/itemProceso.php");
	$itemProcesos = array();
	$manejadorAsignacion = new ManejadorAsignacion();
	$itemProcesoArray = $manejadorAsignacion->obtenerPanelPorTramite($_POST["SL_MODALIDAD"]);
	foreach($itemProcesoArray as $itemProceso)
	{
		array_push($itemProcesos, $itemProceso->getNombrePanelItemProceso());
	}
	print_r(json_encode($itemProcesos));	
}

if($opcion == 'terminarProcesoAnticipado')
{
	
	
}

?>