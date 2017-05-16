<?php

class SeguimientoContrato
{
	private $idSolicitud;
	private $idModalidadTramite;
	private $nombreSubdireccion;
	private $nombreArea;
	private $idCheckList;
	private $idActuacion;
	private $idMotivo;
	private $idDocumento;
	private $idPersona;
	private $fechaSolicitud;
	private $asunto;
	private $solicitante;
	private $objeto;
	private $valorEstimado;
	private $fechaRadicacion;
	private $fechaSesionComiteAprobacion;
	private $fechaPublicacionSecop;
	private $fechaAudienciaRiesgo;
	private $jornadaAudienciaRiesgo;
	private $numeroAperturaProceso;
	private $fechaResolucionAperturaProceso;	
	private $fechaPublicacionPrepliegosSecop;
	private $fechaPublicacionPliegosSecop;
	private $fechaCierreProceso;
	private $fechaPublicacionEvaluacionPreliminar;
	private $fechaSesionComiteAprobacion2;
	private $fechaPublicacionEvaluaiconDefinitiva;
	private $fechaAudienciaAdjudicacion;
	private $jornadaAudienciaAdjudicacion;
	private $numeroResolucionAdjudicacion;
	private $fechaResolucionAdjudicacion;
	private $fechaElaboracionContrato;
	private $numeroSuscripcion;
	private $nombreContratista;
	private $valorContrato;
	private $plazoEjecucion;
	private $supervisor;
	private $fechaEntregaConcepto;

	public function __construct()
	{

	}
	

	public function validarExistenciaSolicitud($resultadoSolicitud, $db)
	{
		$this->setIdSolicitud($resultadoSolicitud["RADICADO"]);
		$this->setAsunto($resultadoSolicitud["ASUNTO"]);		
		$this->setNombreArea($resultadoSolicitud["DEPENDENCIA_RADICA"]);				
		$this->setIdSubdireccion($resultadoSolicitud["DEPENDENCIA_PADRE"]);		
		$this->setSolicitante($resultadoSolicitud["USUARIO_REASIGNA"]);
		$this->setFechaSolicitud($resultadoSolicitud["FECHA_REASIGNACION"]);
		
		$query = $db->RunSP("SP_SOLICITUD_CONTRATO",SELECT, array('validarExistenciaSolicitud', '', '', $this->getIdSolicitud(),'','','','','','','','','','','','',''));
		if($query[0]["PK_D_ID_SOLICTITUD"] == 0)
			return true;
		else
			return false;	
	}

	public function asignarAbogado($idSolicitud, $asunto, $solicitante, $fechaSolicitud, $idPersona, $nombreArea, $nombreSubdireccion)
	{
		$this->setIdSolicitud($idSolicitud);
		$this->setAsunto($asunto);		
		$this->setSolicitante($solicitante);
		$this->setFechaSolicitud($fechaSolicitud);		
		$this->setIdPersona($idPersona);	
		$this->setNombreArea($nombreArea);				
		$this->setIdSubdireccion($nombreSubdireccion);							
	}

	public function guardarAbogado($db)
	{
		$db->RunSP("SP_SOLICITUD_CONTRATO",INSERT, array('asignarAbogado', '', '', $this->getIdSolicitud(),$this->getIdPersona(),'', $this->getIdSubdireccion(),'','','','',$this->getFechaSolicitud(),$this->getAsunto(),$this->getSolicitante(),$this->getNombreArea(),'',''));
	}

	public function modificarAbogado($db)
	{
		$db->RunSP("SP_SOLICITUD_CONTRATO",UPDATE, array('reasignarAbogado', '', '', $this->getIdSolicitud(),$this->getIdPersona(),'','','','','','','','','','','',''));
	}

	public function activarProceso($db)
	{
		$db->RunSP("SP_SOLICITUD_CONTRATO_ESTADO",UPDATE, array('iniciarProceso', $this->getIdSolicitud(), ''));
	}	

	public function guardarIniciacion($idSolicitud, $objeto, $idModalidadTramite, $valorEstimado, $nombreSubdireccion, $db)
	{
		$db->RunSP("SP_SOLICITUD_CONTRATO",UPDATE, array('agregarIniciacion', '', '', $idSolicitud, '',$idModalidadTramite, $nombreSubdireccion ,'','','','','','','', $objeto, $valorEstimado,''));
	}

	public function guardarVerificacionDocumentos($idSolicitud, $idCheckList, $idActuacion, $idMotivo, $idDocumento, $db)
	{
		$db->RunSP("SP_SOLICITUD_CONTRATO",UPDATE, array('guardarVerificacionDocumentos', '', '', $idSolicitud, '','' , '' , $idCheckList , $idActuacion, $idMotivo , $idDocumento ,'','','', '' , '',''));
	}

	public function obtenerSeguimientoId($idSolicitud, $db)
	{
		$query = $db->RunSP("SP_SOLICITUD_CONTRATO",SELECT, array('obtenerContratoIdSolicituId', '', '', $idSolicitud, '','' , '' , '' , '', '', '','','','', '' , '',''));				
		if(count($query) > 0)
		{
			$this->setIdSolicitud($query[0]["PK_D_ID_SOLICTITUD"]);
			$this->setIdPersona($query[0]["FK_D_ID_PERSONA"]);
			$this->setFechaSolicitud($query[0]["DA_FECHA_SOLICITUD"]);
			$this->setAsunto($query[0]["V_ASUNTO"]);
			$this->setSolicitante($query[0]["V_SOLICITANTE"]);	
			$this->setNombreArea($query[0]["V_AREA_SOLICITANTE"]);				
			$this->setIdSubdireccion($query[0]["V_SUB_SOLICITANTE"]);											
		}
		else
		{
			$this->setIdSolicitud(null);
		}
	}

	public function guardarFechaRadicacion($idSolicitud, $fechaRadicacion, $db)
	{
		$db->RunSP("SP_FECHA_RADICACION",UPDATE, array('GuardarFechaRadicacion', $idSolicitud, $fechaRadicacion));
	}

	public function guardarFechaSesionComiteAprobacion($idSolicitud, $fechaSesionComiteAprobacion, $db)
	{
		$db->RunSP("SP_FECHA_SESION_COMITE_APROBRACION",UPDATE, array('guardarFechaSesionComiteAprobracion', $idSolicitud, $fechaSesionComiteAprobacion));
	}

	public function guardarFechaPublicacionConSecop($idSolicitud, $fechaPublicacionSecop, $db)
	{
		$db->RunSP("SP_FECHA_PUBLICACION_CON_SECOP",UPDATE, array('guardarFechaPublicacionConSecop', $idSolicitud, $fechaPublicacionSecop));
	}

	public function guardarFechaAudienciaRiesgos($idSolicitud, $fechaAudienciaRiesgo, $jornada, $db)
	{				
		$resultado = $db->RunSP("SP_FECHA_AUDIENCIA_RIESGO", SELECT , array('validarFechaAudienciaRiesgos', $idSolicitud, $fechaAudienciaRiesgo, $jornada));		
		if($resultado[0]['Resultado'] == 1)
		{
			$db->RunSP("SP_FECHA_AUDIENCIA_RIESGO",UPDATE, array('guardarFechaAudienciaRiesgos', $idSolicitud, $fechaAudienciaRiesgo, $jornada));			
			return 1;
		}
		else
		{
			return 0;
		}		
	}	

	public function guardarNumeroFechaAperturaProceso($idSolicitud, $numeroAperturaProceso, $fechaResolucionAperturaProceso, $db)
	{				
		$db->RunSP("SP_NUMERO_FECHA_APERTURA_PROCESO", UPDATE , array('guardarNumeroFechaResolucionAperProc', $idSolicitud, $numeroAperturaProceso, $fechaResolucionAperturaProceso));		
	}	

	public function guardarFechaPublicacionPrepliegosSECOP($idSolicitud, $fechaPublicacionPrepliegosSecop, $db)
	{				
		$db->RunSP("SP_PUBLICACION_SECOP", UPDATE , array('guardarFechaPublicacionPrepliegosSECOP', $idSolicitud, $fechaPublicacionPrepliegosSecop, null));		
	}	

	public function guardarFechaPublicacionPliegosDefinitivoSECOP($idSolicitud, $fechaPublicacionPliegosSecop, $db)
	{				
		$db->RunSP("SP_PUBLICACION_SECOP", UPDATE , array('guardarFechaPublicacionPliegosDefinitivoSECOP', $idSolicitud, null, $fechaPublicacionPliegosSecop));		
	}	

	public function guardarFechaCierreProcesos($idSolicitud, $fechaCierreProceso, $db)
	{						
		$resultado = $db->RunSP("SP_FECHA_CIERRE_PROCESO", SELECT , array('validarFechaCierreProcesos2', $idSolicitud, $fechaCierreProceso));		
		if($resultado[0]['Resultado'] == 1)
		{
			$db->RunSP("SP_FECHA_CIERRE_PROCESO", UPDATE , array('guardarFechaCierreProcesos', $idSolicitud, $fechaCierreProceso));		
			return 1;
		}
		else
		{
			return $resultado[0]['Resultado'];
		}				
	}	

	public function guardarFechaPublicacionEvaluacionPreliminar($idSolicitud, $fechaPublicacionEvaluacionPreliminar, $db)
	{						
		$db->RunSP("SP_FECHA_PUBLICACION_EVAL_PRELIMINAR",UPDATE, array('GuardarFechapPubEvalPreliminar', $idSolicitud, $fechaPublicacionEvaluacionPreliminar));	
	}		

	public function guardarFechaSesionComiteAprobacion2($idSolicitud, $fechaSesionComiteAprobacion2, $db)
	{
		$db->RunSP("SP_FECHA_SESION_COMITE_APROBACION_2",UPDATE, array('guardarFechaSesionComiteAprobracion2', $idSolicitud, $fechaSesionComiteAprobacion2));
	}	

	public function guardarFechaPublicacionEvaluaiconDefinitiva($idSolicitud, $fechaPublicacionEvaluaiconDefinitiva, $db)
	{
		$db->RunSP("SP_FECHA_PUBLICACION_EVAL_DEFINITIVA",UPDATE, array('guardarFechaPublicacionEvaluaiconDefinitiva', $idSolicitud, $fechaPublicacionEvaluaiconDefinitiva));
	}	
	
	public function guardarFechaAudienciaAdjudicacion($idSolicitud, $fechaAudienciaAdjudicacion, $jornada, $db)
	{				
		$resultado = $db->RunSP("SP_FECHA_AUDIENCIA_ADJUDICACION", SELECT , array('validarFechaAudienciaAdjudicacion', $idSolicitud, $fechaAudienciaAdjudicacion, $jornada));		
		if($resultado[0]['Resultado'] == 1)
		{
			$db->RunSP("SP_FECHA_AUDIENCIA_ADJUDICACION",UPDATE, array('guardarFechaAudienciaAdjudicacion', $idSolicitud, $fechaAudienciaAdjudicacion, $jornada));			
			return 1;
		}
		else
		{
			return $resultado[0]['Resultado'];
		}		
	}	

	public function guardarFechaNumeroResolucionAdjudicacion($idSolicitud, $numeroResolucionAdjudicacion, $fechaResolucionAdjudicacion, $db)
	{
		$db->RunSP("SP_RESOLUCION_ADJUDICACION",UPDATE, array('guardarFechaNumeroResolucionAdjudicacion', $idSolicitud, $numeroResolucionAdjudicacion, $fechaResolucionAdjudicacion));
	}	

	public function guardarElaboracionContrato($idSolicitud, $fechaElaboracionContrato, $numeroSuscripcion, $nombreContratista, $valorContrato, $plazoEjecucion, $supervisor, $db)
	{
		$db->RunSP("SP_ELABORACION_CONTRATO",UPDATE, array('guardarElaboracionContrato', $idSolicitud, $fechaElaboracionContrato, $numeroSuscripcion, $nombreContratista, $valorContrato, $plazoEjecucion, $supervisor));
	}	

	public function guardarFechaEntregaConcepto($idSolicitud, $fechaEntregaConcepto, $db)
	{
		$db->RunSP("SP_FECHA_ENTREGA_CONCEPTO",UPDATE, array('guardarFechaEntregaConcepto', $idSolicitud, $fechaEntregaConcepto));
	}			

	public function getIdSolicitud()
	{
		return $this->idSolicitud;
	}

	public function setIdSolicitud($idSolicitud)
	{
		$this->idSolicitud = $idSolicitud;
	}	

	public function getIdModalidadTramite()
	{
		return $this->idModalidadTramite;
	}

	public function setIdModalidadTramite($idModalidadTramite)
	{
		$this->idModalidadTramite = $idModalidadTramite;
	}		

	public function getIdSubdireccion()
	{
		return $this->nombreSubdireccion;
	}

	public function setIdSubdireccion($nombreSubdireccion)
	{
		$this->nombreSubdireccion = $nombreSubdireccion;
	}			

	public function getIdCheckList()
	{
		return $this->idCheckList;
	}

	public function setIdCheckList($idCheckList)
	{
		$this->idCheckList = $idCheckList;
	}				

	public function getIdActuacion()
	{
		return $this->idActuacion;
	}

	public function setIdActuacion($idActuacion)
	{
		$this->idActuacion = $idActuacion;
	}					

	public function getIdMotivo()
	{
		return $this->idMotivo;
	}

	public function setIdMotivo($idMotivo)
	{
		$this->idMotivo = $idMotivo;
	}						

	public function getIdDocumento()
	{
		return $this->idDocumento;
	}

	public function setIdDocumento($idDocumento)
	{
		$this->idDocumento = $idDocumento;
	}							

	public function getIdPersona()
	{
		return $this->idPersona;
	}

	public function setIdPersona($idPersona)
	{
		$this->idPersona = $idPersona;
	}								

	public function getFechaSolicitud()
	{
		return $this->fechaSolicitud;
	}

	public function setFechaSolicitud($fechaSolicitud)
	{
		$this->fechaSolicitud = $fechaSolicitud;
	}							

	public function getAsunto()
	{
		return $this->asunto;
	}

	public function setAsunto($asunto)
	{
		$this->asunto = $asunto;
	}									

	public function getSolicitante()
	{
		return $this->solicitante;
	}

	public function setSolicitante($solicitante)
	{
		$this->solicitante = $solicitante;
	}										

	public function getObjeto()
	{
		return $this->objeto;
	}

	public function setObjeto($objeto)
	{
		$this->objeto = $objeto;
	}								

	public function getValorEstimado()
	{
		return $this->valorEstimado;
	}

	public function setValorEstimado($valorEstimado)
	{
		$this->valorEstimado = $valorEstimado;
	}									

	public function getFechaRadicacion()
	{
		return $this->fechaRadicacion;
	}

	public function setFechaRadicacion($fechaRadicacion)
	{
		$this->fechaRadicacion = $fechaRadicacion;
	}					

	public function getNombreArea()
	{
		return $this->nombreArea;
	}

	public function setNombreArea($nombreArea)
	{
		$this->nombreArea = $nombreArea;
	}															

	public function getFechaSesionComiteAprobacion()
	{
		return $this->fechaSesionComiteAprobacion;
	}

	public function setFechaSesionComiteAprobacion($fechaSesionComiteAprobacion)
	{
		$this->fechaSesionComiteAprobacion = $fechaSesionComiteAprobacion;
	}																

	public function getFechaPublicacionSecop()
	{
		return $this->fechaPublicacionSecop;
	}

	public function setFechaPublicacionSecop($fechaPublicacionSecop)
	{
		$this->fechaPublicacionSecop = $fechaPublicacionSecop;
	}					
	
	public function getFechaAudienciaRiesgo()
	{
		return $this->fechaAudienciaRiesgo;
	}

	public function setFechaAudienciaRiesgo($fechaAudienciaRiesgo)
	{
		$this->fechaAudienciaRiesgo = $fechaAudienciaRiesgo;
	}	
	
	public function getJornadaAudienciaRiesgo()
	{
		return $this->jornadaAudienciaRiesgo;
	}

	public function setJornadaAudienciaRiesgo($jornadaAudienciaRiesgo)
	{
		$this->jornadaAudienciaRiesgo = $jornadaAudienciaRiesgo;
	}		

	public function getNumeroAperturaProceso()
	{
		return $this->numeroAperturaProceso;
	}

	public function setNumeroAperturaProceso($numeroAperturaProceso)
	{
		$this->numeroAperturaProceso = $numeroAperturaProceso;
	}		

	public function getFechaResolucionAperturaProceso()
	{
		return $this->fechaResolucionAperturaProceso;
	}

	public function setFechaResolucionAperturaProceso($fechaResolucionAperturaProceso)
	{
		$this->fechaResolucionAperturaProceso = $fechaResolucionAperturaProceso;
	}			
				
	public function getFechaPublicacionPrepliegosSecop()
	{
		return $this->fechaPublicacionPrepliegosSecop;
	}

	public function setFechaPublicacionPrepliegosSecop($fechaPublicacionPrepliegosSecop)
	{
		$this->fechaPublicacionPrepliegosSecop = $fechaPublicacionPrepliegosSecop;
	}				

	public function getFechaPublicacionPliegosSecop()
	{
		return $this->fechaPublicacionPliegosSecop;
	}

	public function setFechaPublicacionPliegosSecop($fechaPublicacionPliegosSecop)
	{
		$this->fechaPublicacionPliegosSecop = $fechaPublicacionPliegosSecop;
	}					

	public function getFechaCierreProceso()
	{
		return $this->fechaCierreProceso;
	}

	public function setFechaCierreProceso($fechaCierreProceso)
	{
		$this->fechaCierreProceso = $fechaCierreProceso;
	}		

	public function getFechaPublicacionEvaluacionPreliminar()
	{
		return $this->fechaPublicacionEvaluacionPreliminar;
	}

	public function setFechaPublicacionEvaluacionPreliminar($fechaPublicacionEvaluacionPreliminar)
	{
		$this->fechaPublicacionEvaluacionPreliminar = $fechaPublicacionEvaluacionPreliminar;
	}			
				

	public function getFechaSesionComiteAprobacion2()
	{
		return $this->fechaSesionComiteAprobacion2;
	}

	public function setFechaSesionComiteAprobacion2($fechaSesionComiteAprobacion2)
	{
		$this->fechaSesionComiteAprobacion2 = $fechaSesionComiteAprobacion2;
	}	

	public function getFechaPublicacionEvaluaiconDefinitiva()
	{
		return $this->fechaPublicacionEvaluaiconDefinitiva;
	}

	public function setFechaPublicacionEvaluaiconDefinitiva($fechaPublicacionEvaluaiconDefinitiva)
	{
		$this->fechaPublicacionEvaluaiconDefinitiva = $fechaPublicacionEvaluaiconDefinitiva;
	}		

	public function getFechaAudienciaAdjudicacion()
	{
		return $this->fechaAudienciaAdjudicacion;
	}

	public function setFechaAudienciaAdjudicacion($fechaAudienciaAdjudicacion)
	{
		$this->fechaAudienciaAdjudicacion = $fechaAudienciaAdjudicacion;
	}		

	public function getJornadaAudienciaAdjudicacion()
	{
		return $this->jornadaAudienciaAdjudicacion;
	}

	public function setJornadaAudienciaAdjudicacion($jornadaAudienciaAdjudicacion)
	{
		$this->jornadaAudienciaAdjudicacion = $jornadaAudienciaAdjudicacion;
	}			

	public function getNumeroResolucionAdjudicacion()
	{
		return $this->numeroResolucionAdjudicacion;
	}

	public function setNumeroResolucionAdjudicacion($numeroResolucionAdjudicacion)
	{
		$this->numeroResolucionAdjudicacion = $numeroResolucionAdjudicacion;
	}			

	public function getFechaResolucionAdjudicacion()
	{
		return $this->fechaResolucionAdjudicacion;
	}

	public function setFechaResolucionAdjudicacion($fechaResolucionAdjudicacion)
	{
		$this->fechaResolucionAdjudicacion = $fechaResolucionAdjudicacion;
	}				

	public function getFechaElaboracionContrato()
	{
		return $this->fechaElaboracionContrato;
	}

	public function setFechaElaboracionContrato($fechaElaboracionContrato)
	{
		$this->fechaElaboracionContrato = $fechaElaboracionContrato;
	}					

	public function getNumeroSuscripcion()
	{
		return $this->numeroSuscripcion;
	}

	public function setNumeroSuscripcion($numeroSuscripcion)
	{
		$this->numeroSuscripcion = $numeroSuscripcion;
	}						

	public function getNombreContratista()
	{
		return $this->nombreContratista;
	}

	public function setNombreContratista($nombreContratista)
	{
		$this->nombreContratista = $nombreContratista;
	}							

	public function getValorContrato()
	{
		return $this->valorContrato;
	}

	public function setValorContrato($valorContrato)
	{
		$this->valorContrato = $valorContrato;
	}								

	public function getPlazoEjecucion()
	{
		return $this->plazoEjecucion;
	}

	public function setPlazoEjecucion($plazoEjecucion)
	{
		$this->plazoEjecucion = $plazoEjecucion;
	}									

	public function getSupervisor()
	{
		return $this->supervisor;
	}

	public function setSsupervisor($supervisor)
	{
		$this->supervisor = $supervisor;
	}		
									
	public function getFechaEntregaConcepto()
	{
		return $this->fechaEntregaConcepto;
	}

	public function setFechaEntregaConcepto($fechaEntregaConcepto)
	{
		$this->fechaEntregaConcepto = $fechaEntregaConcepto;
	}			
}

?>