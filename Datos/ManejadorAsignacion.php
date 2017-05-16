<?php

if(!class_exists('Query')){ include 'Query.php'; }
include("SeguimientoContrato.php");

class ManejadorAsignacion
{
	private $seguimientoContrato;
	private $db; 

	public function __construct()
	{
		$this->db = new Query('Principal');
		$this->seguimientoContrato = array();
	}

	public function obtenerSolicitudContrato($resultadoSolicitudes)
	{
		foreach ($resultadoSolicitudes as $resultadoSolicitud)
		{
				$seguimientoContrato = new SeguimientoContrato();
				if($seguimientoContrato->validarExistenciaSolicitud($resultadoSolicitud, $this->db))
				{
					array_push($this->seguimientoContrato, $seguimientoContrato);
				}			
		}		
	}

	public function asignarContrato($idSolicitud, $asunto, $solicitante, $fechaSolicitud, $idPersona, $nombreArea, $nombreSubdireccion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->asignarAbogado($idSolicitud, $asunto, $solicitante, $fechaSolicitud, $idPersona, $nombreArea, $nombreSubdireccion);
		$seguimientoContrato->guardarAbogado($this->db);

		$persona = new Persona();
		$persona->cargarPersonaPorId($idPersona);

		$manejadorHistorial = new ManejadorHistorial();
		$historial = "El funcionario(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " asigna la elaboración del contrato al abogado(a): " . $persona->getPrimerNombre() . " " . $persona->getPrimerApellido() . ", El proceso queda en espera hasta que al abogado(a) le entreguen los documentos.";		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);

	}

	public function reasignarContrato($idSolicitud, $idPersona)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->asignarAbogado($idSolicitud, null, null, null, $idPersona, null, null);
		$seguimientoContrato->modificarAbogado($this->db);

		$persona = new Persona();
		$persona->cargarPersonaPorId($idPersona);

		$manejadorHistorial = new ManejadorHistorial();
		$historial = "El funcionario(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " reasigna la elaboración del contrato al abogado(a): " . $persona->getPrimerNombre() . " " . $persona->getPrimerApellido() . ".";		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);

	}	

	public function obtenerSolicitudContratoAsignados($fechaInicio, $fechaFinal)
	{
		$query = $this->db->RunSP("SP_SOLICITUD_CONTRATO",SELECT, array('obtenerContratosAsignados', $fechaInicio, $fechaFinal, '','','','','','','','','','','','','',''));
		for($i = 0; $i < count($query); $i++)
		{
			$seguimientoContrato = new SeguimientoContrato();
			$seguimientoContrato->asignarAbogado($query[$i]["PK_D_ID_SOLICTITUD"], $query[$i]["V_ASUNTO"], $query[$i]["V_SOLICITANTE"], $query[$i]["DA_FECHA_SOLICITUD"], $query[$i]["FK_D_ID_PERSONA"], $query[$i]["V_AREA_SOLICITANTE"], $query[$i]["V_SUB_SOLICITANTE"]);
			array_push($this->seguimientoContrato, $seguimientoContrato);
		}
	}

	public function obtenerSolicitudContratoAsignadosInactivos()
	{
		$query = $this->db->RunSP("SP_SOLICITUD_CONTRATO_ESTADO",SELECT, array('contratcosAsignadosInactivos', '',''));
		for($i = 0; $i < count($query); $i++)
		{
			$seguimientoContrato = new SeguimientoContrato();
			$seguimientoContrato->asignarAbogado($query[$i]["PK_D_ID_SOLICTITUD"], $query[$i]["V_ASUNTO"], $query[$i]["V_SOLICITANTE"], $query[$i]["DA_FECHA_SOLICITUD"], $query[$i]["FK_D_ID_PERSONA"], $query[$i]["V_AREA_SOLICITANTE"], $query[$i]["V_SUB_SOLICITANTE"]);
			array_push($this->seguimientoContrato, $seguimientoContrato);
		}
	}	

	public function activarProceso($idSolicitud)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->asignarAbogado($idSolicitud,null, null, null, null, null, null);
		$seguimientoContrato->activarProceso($this->db);

		$manejadorHistorial = new ManejadorHistorial();
		$historial = "El funcionario(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " entrega los documentos al abogado(a) asignado y queda activo el proceso.";		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);		
	}

	public function obtenerSolicitudContratoAsignadosPersona($idPersona)
	{
		$query = $this->db->RunSP("SP_SOLICITUD_CONTRATO",SELECT, array('obtenerContratoPersona', '', '', '', $idPersona, '', '', '', '', '', '', '', '', '', '', '', ''));
		for($i = 0; $i < count($query); $i++)
		{
			$seguimientoContrato = new SeguimientoContrato();
			$seguimientoContrato->asignarAbogado($query[$i]["PK_D_ID_SOLICTITUD"], $query[$i]["V_ASUNTO"], $query[$i]["V_SOLICITANTE"], $query[$i]["DA_FECHA_SOLICITUD"], $query[$i]["FK_D_ID_PERSONA"], $query[$i]["V_AREA_SOLICITANTE"], $query[$i]["V_SUB_SOLICITANTE"]);
			array_push($this->seguimientoContrato, $seguimientoContrato);
		}		
	}

	public function obtenerSolicitudContratoAsignadosPersonaFecha($idPersona, $fechaInicio, $fechaFinal)
	{
		$query = $this->db->RunSP("SP_SOLICITUD_CONTRATO",SELECT, array('obtenerContratoPersonaFecha', $fechaInicio, $fechaFinal, '', $idPersona, '', '', '', '', '', '', '', '', '', '', '', ''));
		for($i = 0; $i < count($query); $i++)
		{
			$seguimientoContrato = new SeguimientoContrato();
			$seguimientoContrato->asignarAbogado($query[$i]["PK_D_ID_SOLICTITUD"], $query[$i]["V_ASUNTO"], $query[$i]["V_SOLICITANTE"], $query[$i]["DA_FECHA_SOLICITUD"], $query[$i]["FK_D_ID_PERSONA"], $query[$i]["V_AREA_SOLICITANTE"], $query[$i]["V_SUB_SOLICITANTE"]);
			array_push($this->seguimientoContrato, $seguimientoContrato);
		}		
	}	

	public function obtenerSolicitudContratoAsignadosSubdireccion($nombreSubidreccion, $fechaInicio, $fechaFinal)
	{
		$query = $this->db->RunSP("SP_SOLICITUD_CONTRATO",SELECT, array('obtenerContratoPersonaSubdireccion', $fechaInicio, $fechaFinal, '', '', '', $nombreSubidreccion, '', '', '', '', '', '', '', '', '', ''));
		for($i = 0; $i < count($query); $i++)
		{
			$seguimientoContrato = new SeguimientoContrato();
			$seguimientoContrato->asignarAbogado($query[$i]["PK_D_ID_SOLICTITUD"], $query[$i]["V_ASUNTO"], $query[$i]["V_SOLICITANTE"], $query[$i]["DA_FECHA_SOLICITUD"], $query[$i]["FK_D_ID_PERSONA"], $query[$i]["V_AREA_SOLICITANTE"], $query[$i]["V_SUB_SOLICITANTE"]);
			array_push($this->seguimientoContrato, $seguimientoContrato);
		}		
	}		

	public function guardarIniciacion($idSolicitud, $objeto, $idModalidadTramite, $valorEstimado, $idSubdireccion, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarIniciacion($idSolicitud, $objeto, $idModalidadTramite, $valorEstimado, $idSubdireccion, $this->db);
		
		$modalidadTramite = new ModalidadTramite();		
		$modalidadTramite->obtenerTramiteId($idModalidadTramite, $this->db);


		$manejadorHistorial = new ManejadorHistorial();
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " inicia el proceso e ingresa los siguientes datos:<br>";		
		$historial .= "<br><strong><ins>--Objeto: </ins></strong>" . $objeto . "."; 
		$historial .= "<br><strong><ins>--Modalidad de selección o tramite: </ins></strong>" . $modalidadTramite->getNombreModalidadTramite() . "."; 
		$historial .= "<br><strong><ins>--Valor estimado contrato y/o adición: </ins></strong>$" . $valorEstimado . "."; 		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 


		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);				
	}

	public function validarIniciacion($idSolicitud)
	{
		$query = $this->db->RunSP("SP_SOLICITUD_CONTRATO",SELECT, array('validarIniciacion', '', '', $idSolicitud, '', '', '' ,'','','','','','','', '', '',''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setIdSolicitud($query[0]["PK_D_ID_SOLICTITUD"]);
		$seguimientoContrato->setObjeto($query[0]["T_OBJETO"]);
		$seguimientoContrato->setIdModalidadTramite($query[0]["FK_I_ID_MODADLIDAD_TRAMITE"]);
		$seguimientoContrato->setValorEstimado($query[0]["D_VALOR_ESTIMADO"]);		
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	

	public function guardarVerificacionDocumentos($idSolicitud, $idCheckList, $idActuacion, $idMotivo, $idDocumento, $aprobacionCheckList, $datosCheckList, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarVerificacionDocumentos($idSolicitud, $idCheckList, $idActuacion, $idMotivo, $idDocumento, $this->db);

		$checkList = new CheckList();
		$checkList->obtenerCheckListId($idCheckList, $this->db);

		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " realiza revisión del siguiente CheckList: <ins><em>" . $checkList->getNombreCheckList() . "</em></ins>.<br>";		
		/*$historial .= "<br>Los Items del CheckList son: ";

		$itemsCheckList = $checkList->getListaCheckListItem();
		foreach ($itemsCheckList as $itemCheckList)
		{
			$historial .= "<br>" . $itemCheckList->getNombreCheckListItem();		
		}*/
		$historial .= $datosCheckList;


		if($aprobacionCheckList == 1)
			$historial .= "<br><br>El CheckList es aprobado por el abogado(a)." ;
		else
			$historial .= "<br><br>El CheckList es denegado por el abogado(a)." ;

		$actuacion = new Actuacion();
		$actuacion->obtenerActuacionId($idActuacion, $this->db);

		$historial .= "<br><br><strong><ins>--La actuación otorgada es: </ins></strong>" . $actuacion->getNombreActuacion();
		if($actuacion->getAccionActuacion() == 1)
		{
			$historial .= ", <ins><em>El proceso continua con su trámite.</em></ins>";
		}
		else
		{
			$historial .= ", <ins><em>El proceso queda en espera de continuar con el trámite.</em></ins>";
			if($idMotivo > 0)
			{
				$motivo = new Motivo();
				$motivo->obtenerMotivoId($idMotivo, $this->db);

				$historial .= "<br><strong><ins>--El motivo es: </ins></strong>" . $motivo->getNombreMotivo() . ".";

				$documento = new Documento();
				$documento->obtenerDocumentoId($idDocumento, $this->db);

				$historial .= "<br><strong><ins>--El documento para su devolución es: </ins></strong>" . $documento->getNombreDocumento() . ".";

			}				
		}

		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 


		$manejadorHistorial = new ManejadorHistorial();		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);		

	}	


	public function validarVerificacionDocumentos($idSolicitud)
	{
		$query = $this->db->RunSP("SP_SOLICITUD_CONTRATO",SELECT, array('validarVerificacionDocumentos', '', '', $idSolicitud, '', '', '' ,'','','','','','','', '', '',''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setIdSolicitud($query[0]["PK_D_ID_SOLICTITUD"]);
		$seguimientoContrato->setIdCheckList($query[0]["FK_D_ID_CHECK_LIST"]);
		$seguimientoContrato->setIdActuacion($query[0]["FK_I_ID_ACTUACION"]);
		$seguimientoContrato->setIdMotivo($query[0]["FK_I_ID_ACTUACION_MOTIVO"]);
		$seguimientoContrato->setIdDocumento($query[0]["FK_I_ID_ACTUACION_DOCUMENTO"]);	
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	

	public function obtenerSeguimientoId($idSolicitud)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->obtenerSeguimientoId($idSolicitud, $this->db);
		if($seguimientoContrato->getIdSolicitud() != null)
			array_push($this->seguimientoContrato, $seguimientoContrato);
	}

	public function guardarFechaRadicacion($idSolicitud, $fechaRadicacion, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarFechaRadicacion($idSolicitud, $fechaRadicacion, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de radicación: <ins><em>" . $fechaRadicacion . "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 

		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);		

    }	

	public function validarFechaRadicacion($idSolicitud)
	{
		$query = $this->db->RunSP("SP_FECHA_RADICACION",SELECT, array('validarFechaRadicacion', $idSolicitud, ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaRadicacion($query[0]["DT_FECHA_RADICACION"]);
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	    

	public function guardarFechaSesionComiteAprobacion($idSolicitud, $fechaSesionComiteAprobacion, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarFechaSesionComiteAprobacion($idSolicitud, $fechaSesionComiteAprobacion, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de sesión de comite de aprobación: <ins><em>" . $fechaSesionComiteAprobacion . "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);		

    }	

	public function validarFechaSesionComiteAprobracion($idSolicitud)
	{
		$query = $this->db->RunSP("SP_FECHA_SESION_COMITE_APROBRACION",SELECT, array('validarFechaSesionComiteAprobracion', $idSolicitud, ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaSesionComiteAprobacion($query[0]["DT_FECHA_SESION_COMITE_APROBACION"]);
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	    


	public function guardarFechaPublicacionConSecop($idSolicitud, $fechaPublicacionSecop, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarFechaPublicacionConSecop($idSolicitud, $fechaPublicacionSecop, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de publicación convocatoria SECOP: <ins><em>" . $fechaPublicacionSecop . "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);		

    }	    

	public function validarFechaPublicacionConSecop($idSolicitud)
	{
		$query = $this->db->RunSP("SP_FECHA_PUBLICACION_CON_SECOP",SELECT, array('validarFechaPublicacionConSecop', $idSolicitud, ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaPublicacionSecop($query[0]["DT_FECHA_PUBLICACION_SECOP"]);
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	        

	public function guardarFechaAudienciaRiesgos($idSolicitud, $fechaAudienciaRiesgo, $jornada, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$retornoVerificacion = $seguimientoContrato->guardarFechaAudienciaRiesgos($idSolicitud, $fechaAudienciaRiesgo, $jornada, $this->db);

		if($retornoVerificacion == 1)
		{
			$manejadorHistorial = new ManejadorHistorial();		
			$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de audiencia de riesgos: <ins><em>" . $fechaAudienciaRiesgo . " en la jornada " .  $jornada .   "</em></ins>.<br>";		
			$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 			
			$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);		
		}
		return $retornoVerificacion;
    }	    

	public function validarFechaAudienciaRiesgos($idSolicitud)
	{
		$query = $this->db->RunSP("SP_FECHA_AUDIENCIA_RIESGO",SELECT, array('validarFechaAudienciaRiesgos2', $idSolicitud, '', ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaAudienciaRiesgo($query[0]["DT_FECHA_AUDIENCIA_RIESGO"]);
		$seguimientoContrato->setJornadaAudienciaRiesgo($query[0]["V_JORNADA_AUDIENCIA_RIESGO"]);
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	            

	public function guardarNumeroFechaAperturaProceso($idSolicitud, $numeroAperturaProceso, $fechaResolucionAperturaProceso, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarNumeroFechaAperturaProceso($idSolicitud, $numeroAperturaProceso, $fechaResolucionAperturaProceso, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa el número de apertura de proceso: <ins><em>" . $numeroAperturaProceso . " con la fecha " .  $fechaResolucionAperturaProceso .   "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);				
    }	  

	public function validarNumeroFechaResolucionAperProc($idSolicitud)
	{
		$query = $this->db->RunSP("SP_NUMERO_FECHA_APERTURA_PROCESO",SELECT, array('validarNumeroFechaResolucionAperProc', $idSolicitud, '', ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setNumeroAperturaProceso($query[0]["D_NUMERO_RESOLUCION_APERTURA_PROCESO"]);
		$seguimientoContrato->setFechaResolucionAperturaProceso($query[0]["DT_FECHA_RESOLUCION_APERTURA_PROCESO"]);
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	                      

	public function guardarFechaPublicacionPrepliegosSECOP($idSolicitud, $fechaPublicacionPrepliegosSecop, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarFechaPublicacionPrepliegosSECOP($idSolicitud, $fechaPublicacionPrepliegosSecop, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de publicación de prepliegos SECOP: <ins><em>" . $fechaPublicacionPrepliegosSecop . "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);				
    }	         

	public function validarFechaPublicacionPrepliegosSECOP($idSolicitud)
	{
		$query = $this->db->RunSP("SP_PUBLICACION_SECOP",SELECT, array('validarFechaPublicacionPrepliegosSECOP', $idSolicitud, '', ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaPublicacionPrepliegosSecop($query[0]["DT_FECHA_PUBLICACION_PREPLIEGOS_SECOP"]);		
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	                             

	public function guardarFechaPublicacionPliegosDefinitivoSECOP($idSolicitud, $fechaPublicacionPliegosSecop, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarFechaPublicacionPliegosDefinitivoSECOP($idSolicitud, $fechaPublicacionPliegosSecop, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de publicación de pliegos definitivos SECOP: <ins><em>" . $fechaPublicacionPliegosSecop . "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);				
    }	   

	public function validarFechaPublicacionPliegosDefinitivoSECOP($idSolicitud)
	{
		$query = $this->db->RunSP("SP_PUBLICACION_SECOP",SELECT, array('validarFechaPublicacionPliegosDefinitivoSECOP', $idSolicitud, '', ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaPublicacionPliegosSecop($query[0]["DT_FECHA_PUBLICACION_PLIEGOS_SECOP"]);		
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	                                              

	public function guardarFechaCierreProcesos($idSolicitud, $fechaCierreProceso, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$retornoVerificacion = $seguimientoContrato->guardarFechaCierreProcesos($idSolicitud, $fechaCierreProceso, $this->db);

		if($retornoVerificacion == 1)
		{
			$manejadorHistorial = new ManejadorHistorial();		
			$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de cierre de procesos: <ins><em>" . $fechaCierreProceso . "</em></ins>.<br>";		
			$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 		
			$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);							
		}

		return $retornoVerificacion;
    }	      

	public function validarFechaCierreProcesos($idSolicitud)
	{
		$query = $this->db->RunSP("SP_FECHA_CIERRE_PROCESO",SELECT, array('validarFechaCierreProcesos', $idSolicitud, ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaCierreProceso($query[0]["DT_FECHA_CIERRE_PROCESO"]);		
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	                                                            


	public function guardarFechaPublicacionEvaluacionPreliminar($idSolicitud, $fechaPublicacionEvaluacionPreliminar, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarFechaPublicacionEvaluacionPreliminar($idSolicitud, $fechaPublicacionEvaluacionPreliminar, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de publicación de evaluación preliminar: <ins><em>" . $fechaPublicacionEvaluacionPreliminar . "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);				
    }	  

                  
	public function validarFechaPublicacionEvaluacionPreliminar($idSolicitud)
	{
		$query = $this->db->RunSP("SP_FECHA_PUBLICACION_EVAL_PRELIMINAR",SELECT, array('ValidarFechapPubEvalPreliminar', $idSolicitud, ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaPublicacionEvaluacionPreliminar($query[0]["DT_FECHA_PUBLICACION_EVAL_PRELIMINAR"]);		
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	

	public function guardarFechaSesionComiteAprobacion2($idSolicitud, $fechaSesionComiteAprobacion2, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarFechaSesionComiteAprobacion2($idSolicitud, $fechaSesionComiteAprobacion2, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de comite de contratación - Presentación evaluación definitiva: <ins><em>" . $fechaSesionComiteAprobacion2 . "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);				
    }	                

	public function validarFechaSesionComiteAprobracion2($idSolicitud)
	{
		$query = $this->db->RunSP("SP_FECHA_SESION_COMITE_APROBACION_2",SELECT, array('validarFechaSesionComiteAprobracion2', $idSolicitud, ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaSesionComiteAprobacion2($query[0]["DT_FECHA_SESION_COMITE_APROBACION_2"]);		
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	                                                                

	public function guardarFechaPublicacionEvaluaiconDefinitiva($idSolicitud, $fechaPublicacionEvaluaiconDefinitiva, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarFechaPublicacionEvaluaiconDefinitiva($idSolicitud, $fechaPublicacionEvaluaiconDefinitiva, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha publicación de la evaluación definitiva : <ins><em>" . $fechaPublicacionEvaluaiconDefinitiva . "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);				
    }	

	public function validarFechaPublicacionEvaluaiconDefinitiva($idSolicitud)
	{
		$query = $this->db->RunSP("SP_FECHA_PUBLICACION_EVAL_DEFINITIVA",SELECT, array('validarFechaPublicacionEvaluaiconDefinitiva', $idSolicitud, ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaPublicacionEvaluaiconDefinitiva($query[0]["DT_FECHA_PUBLICACION_EVALUACION_DEFINITIVA"]);		
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	                                                                    

	public function guardarFechaAudienciaAdjudicacion($idSolicitud, $fechaAudienciaAdjudicacion, $jornada, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$retornoVerificacion = $seguimientoContrato->guardarFechaAudienciaAdjudicacion($idSolicitud, $fechaAudienciaAdjudicacion, $jornada, $this->db);

		if($retornoVerificacion == 1)
		{		
			$manejadorHistorial = new ManejadorHistorial();		
			$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de audiencia de adjudicación: <ins><em>" . $fechaAudienciaAdjudicacion . " en la jornada " .  $jornada .   "</em></ins>.<br>";		
			$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 		
			$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);		
		}		
		return $retornoVerificacion;
    }	

	public function validarFechaAudienciaAdjudicacion2($idSolicitud)
	{
		$query = $this->db->RunSP("SP_FECHA_AUDIENCIA_ADJUDICACION",SELECT, array('validarFechaAudienciaAdjudicacion2', $idSolicitud, '', ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaAudienciaAdjudicacion($query[0]["DT_FECHA_AUDIENCIA_ADJUDICACION"]);		
		$seguimientoContrato->setJornadaAudienciaAdjudicacion($query[0]["V_JORNADA_AUDIENCIA_ADJUDICACION"]);		
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	                                                                        

	public function guardarFechaNumeroResolucionAdjudicacion($idSolicitud, $numeroResolucionAdjudicacion, $fechaResolucionAdjudicacion, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarFechaNumeroResolucionAdjudicacion($idSolicitud, $numeroResolucionAdjudicacion, $fechaResolucionAdjudicacion, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa el número de resolución de adjudicación: <ins><em>" . $numeroResolucionAdjudicacion . " con la fecha " .  $fechaResolucionAdjudicacion .   "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);				
    }	

	public function validarFechaNumeroResolucionAdjudicacion($idSolicitud)
	{
		$query = $this->db->RunSP("SP_RESOLUCION_ADJUDICACION",SELECT, array('validarFechaNumeroResolucionAdjudicacion', $idSolicitud, '', ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setNumeroResolucionAdjudicacion($query[0]["D_RESOLUCION_ADJUDICACION"]);		
		$seguimientoContrato->setFechaResolucionAdjudicacion($query[0]["DT_FECHA_RESOLUCION_ADJUDICACION"]);		
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	                                                                            

	public function guardarElaboracionContrato($idSolicitud, $fechaElaboracionContrato, $numeroSuscripcion, $nombreContratista, $valorContrato, $plazoEjecucion, $supervisor, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarElaboracionContrato($idSolicitud, $fechaElaboracionContrato, $numeroSuscripcion, $nombreContratista, $valorContrato, $plazoEjecucion, $supervisor, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa información de elaboración del contrato.";
		$historial .= "<br><strong><ins>--Fecha de elaboración del contrato: </ins></strong>" . $fechaElaboracionContrato . "."; 
		$historial .= "<br><strong><ins>--Número de contrato: </ins></strong>" . $numeroSuscripcion . "."; 
		$historial .= "<br><strong><ins>--Nombre del contratista: </ins></strong>" . $nombreContratista . "."; 
		$historial .= "<br><strong><ins>--Valor del contrato: </ins></strong>" . $valorContrato . "."; 
		$historial .= "<br><strong><ins>--Plazo de ejecución: </ins></strong>" . $plazoEjecucion . "."; 
		$historial .= "<br><strong><ins>--Supervisor: </ins></strong>" . $supervisor . "."; 
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);				
    }	               

	public function validarElaboracionContrato($idSolicitud)
	{
		$query = $this->db->RunSP("SP_ELABORACION_CONTRATO",SELECT, array('validarElaboracionContrato', $idSolicitud, '', '', '', '', '', ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaElaboracionContrato($query[0]["DT_FECHA_ELABORACION_CONTRATO"]);		
		$seguimientoContrato->setNumeroSuscripcion($query[0]["V_NUMERO_SUSCRIPCION"]);		
		$seguimientoContrato->setNombreContratista($query[0]["V_NOMBRE_CONTRATISTA"]);		
		$seguimientoContrato->setValorContrato($query[0]["D_VALOR_CONTRATO"]);		
		$seguimientoContrato->setPlazoEjecucion($query[0]["V_PLAZO_EJECUCION"]);		
		$seguimientoContrato->setSsupervisor($query[0]["V_SUPERVISOR"]);				
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	                                                                                     


	public function guardarFechaEntregaConcepto($idSolicitud, $fechaEntregaConcepto, $observacion)
	{
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->guardarFechaEntregaConcepto($idSolicitud, $fechaEntregaConcepto, $this->db);

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " ingresa la fecha de entrega de concepto : <ins><em>" . $fechaEntregaConcepto . "</em></ins>.<br>";		
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacion . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);				
    }	

	public function validarFechaEntregaConcepto($idSolicitud)
	{
		$query = $this->db->RunSP("SP_FECHA_ENTREGA_CONCEPTO",SELECT, array('validarFechaEntregaConcepto', $idSolicitud, ''));		
		$seguimientoContrato = new SeguimientoContrato();
		$seguimientoContrato->setFechaEntregaConcepto($query[0]["DT_FECHA_ENTREGA_CONCEPTO"]);		
		array_push($this->seguimientoContrato, $seguimientoContrato);	
	}	    	

    public function obtenerPanelPorTramite($idModalidadTramite)
    {		
		$query = $this->db->RunSP("SP_ITEM_PROCESO",SELECT, array('obtenerPanelPorTramite', null, $idModalidadTramite));
		$itemProcesoArray = array();
		for($i = 0; $i < count($query); $i++)
		{
			$itemProceso = new ItemProceso();
			$itemProceso->setNsombrePanelItemProceso($query[$i]["V_NOMBRE_PANEL"]);
			array_push($itemProcesoArray, $itemProceso);
		}
		return $itemProcesoArray;
    }

    public function finalizarProceso($idSolicitud, $observacionFinal)
    {		
		$this->db->RunSP("SP_FINALIZAR_PROCESO", UPDATE, array('finalizarProceso', $idSolicitud));

		$manejadorHistorial = new ManejadorHistorial();		
		$historial = "El abogado(a) " . $_SESSION["NOMBRE_PERSONA_MOD_CONTR"] . " finaliza el proceso.";
		$historial .= "<br><strong><ins>--Observación: </ins></strong>" . $observacionFinal . "."; 
		
		$manejadorHistorial->guardarHistorial($idSolicitud, $historial, $this->db);						
    }    

	public function getSeguimientoContrato()
	{
		return $this->seguimientoContrato;
	}

	public function getDb()
	{
		return $this->db;
	}
}

?>