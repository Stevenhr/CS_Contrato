<?php

if(!class_exists('Query')){ include 'Query.php'; }
include("ModalidadTramite.php");
include("Subdireccion.php");
include("Actuacion.php");
include("Motivo.php");
include("Documento.php");
include("VariableSoporte.php");
include("ItemProcesoModalidad.php");

class ManejadorItemsProceso
{
	
	private $modalidadTramite;
	private $subdireccion;
	private $actuacion;
	private $motivo;
	private $documento;
	private $variableSoporte;
	private $db; 
	private $mensaje; 

	public function __construct()
	{		        	
		$this->db = new Query('Principal');
		$this->modalidadTramite = array();
		$this->subdireccion = array();
		$this->actuacion = array();
		$this->motivo = array();
		$this->documento = array();
		$this->variableSoporte = array();
	}

	public function cararModadlidadTramite()
	{
		$query = $this->db->RunSP("SP_MODALIDAD_TRAMITE",SELECT, array('obtenerModalidadTramite','','',''));      
		for($i = 0; $i < count($query); $i++)
		{
			$modalidadTramite = new ModalidadTramite();			
			$modalidadTramite->asignarDatos($query[$i]["PK_I_ID_MODADLIDAD_TRAMITE"],$query[$i]["V_NOMBRE_MODADLIDAD_TRAMITE"],$query[$i]["B_ESTADO_LOGICO"]);						
			array_push($this->modalidadTramite, $modalidadTramite);
		}
	}

	public function obtenerTramiteId($idModalidadTramite)
	{
		$modalidadTramite = new ModalidadTramite();	
		$modalidadTramite->obtenerTramiteId($idModalidadTramite, $this->db);
		return $modalidadTramite->getNombreModalidadTramite();
	}

    public function obtenerPanel()
    {		
		$query = $this->db->RunSP("SP_ITEM_PROCESO",SELECT, array('obtenerPanel', null, null));
		$itemProcesoArray = array();
		for($i = 0; $i < count($query); $i++)
		{
			$itemProceso = new ItemProceso();
			$itemProceso->setIdItemProceso($query[$i]["PK_I_ID_ITEM_PROCESO"]);
			$itemProceso->setNombreItemProceso($query[$i]["V_NOMBRE_ITEM_PROCESO"]);
			$itemProceso->setNsombrePanelItemProceso($query[$i]["V_NOMBRE_PANEL"]);
			array_push($itemProcesoArray, $itemProceso);
		}
		return $itemProcesoArray;
    }	

    public function obtenerPanelPorId($idModalidadTramite)
    {		
		$query = $this->db->RunSP("SP_ITEM_PROCESO",SELECT, array('obtenerPanelPorId', null, $idModalidadTramite));
		$itemProcesoArray = array();
		for($i = 0; $i < count($query); $i++)
		{
			$itemProceso = new ItemProceso();
			$itemProceso->setIdItemProceso($query[$i]["PK_I_ID_ITEM_PROCESO"]);
			array_push($itemProcesoArray, $itemProceso);
		}
		return $itemProcesoArray;
    }	    

	public function modificarModadlidadTramite($idModalidadTramite,$nombreModalidadTramite, $itemPanelNavegacion)
	{
		$modalidadTramite = new ModalidadTramite();			
		$modalidadTramite->asignarDatos($idModalidadTramite,$nombreModalidadTramite,1);						
		if($modalidadTramite->modificar($this->db))
		{
			$itemProcesoModalidad = new ItemProcesoModalidad();
			$itemProcesoModalidad->eliminarPorModalidad($idModalidadTramite, $this->db);
			foreach ($itemPanelNavegacion as $idItemProceso)
			{
				$itemProcesoModalidad->guardar($idItemProceso, $idModalidadTramite, $this->db);
			}
			return true;
		}
		else
		{
			return false;
		}
	}	

	public function eliminarModadlidadTramite($idModalidadTramite,$nombreModalidadTramite)
	{
		$modalidadTramite = new ModalidadTramite();			
		$modalidadTramite->asignarDatos($idModalidadTramite,$nombreModalidadTramite,0);						
		return $modalidadTramite->modificar($this->db);
	}	


	public function guardarModadlidadTramite($nombreModalidadTramite, $itemPanelNavegacion)
	{				
		$modalidadTramite = new ModalidadTramite();			
		$modalidadTramite->asignarDatos(-1,$nombreModalidadTramite,1);						
		if($modalidadTramite->guardar($this->db))
		{
			$modalidadTramite->obtenerIdTramitePorNombre($nombreModalidadTramite, $this->db);
			$idModalidadTramite = $modalidadTramite->getIdModalidadTramite();
			$itemProcesoModalidad = new ItemProcesoModalidad();
			foreach ($itemPanelNavegacion as $idItemProceso)
			{
				$itemProcesoModalidad->guardar($idItemProceso, $idModalidadTramite, $this->db);
			}
			return true;
		}
		else
		{
			return false;
		}
	}	

	public function cargarSubdirecciones()
	{
		$query = $this->db->RunSP("SP_SUB_SOLICITANTE",SELECT, array('obtenerSubdirecciones','','',''));      
		for($i = 0; $i < count($query); $i++)
		{
			$subdireccion = new Subdireccion();			
			$subdireccion->asignarDatos($query[$i]["PK_I_ID_SUB_SOLICITANTE"],$query[$i]["V_NOMBRE_SUB_SOLICITANTE"],$query[$i]["B_ESTADO_LOGICO"]);						
			array_push($this->subdireccion, $subdireccion);
		}
	}

	public function cargarSubdireccionesProceso()
	{
		$query = $this->db->RunSP("SP_SUB_SOLICITANTE",SELECT, array('obtenerSubdireccionesProceso','','',''));      
		for($i = 0; $i < count($query); $i++)
		{
			$subdireccion = new Subdireccion();			
			$subdireccion->asignarDatos(null, $query[$i]["V_SUB_SOLICITANTE"], null);						
			array_push($this->subdireccion, $subdireccion);
		}
	}	

	public function modificarSubdireccion($idSubdireccion,$nombreSubdireccion)
	{
		$subdireccion = new Subdireccion();			
		$subdireccion->asignarDatos($idSubdireccion,$nombreSubdireccion,1);						
		return $subdireccion->modificar($this->db);
	}	

	public function eliminarSubdireccion($idSubdireccion,$nombreSubdireccion)
	{
		$subdireccion = new Subdireccion();			
		$subdireccion->asignarDatos($idSubdireccion,$nombreSubdireccion,0);						
		return $subdireccion->modificar($this->db);
	}	

	public function guardarSubdireccion($nombreSubdireccion)
	{
		$subdireccion = new Subdireccion();			
		$subdireccion->asignarDatos(-1,$nombreSubdireccion,1);						
		return $subdireccion->guardar($this->db);
	}		



	public function cargarActuaciones()
	{
		$query = $this->db->RunSP("SP_ACTUACION",SELECT, array('obtenerActuacion','','','',''));      
		for($i = 0; $i < count($query); $i++)
		{
			$actuacion = new Actuacion();			
			$actuacion->asignarDatos($query[$i]["PK_I_ID_ACTUACION"],$query[$i]["V_NOMBRE_ACTUACION"],$query[$i]["B_ACCION_ACTUACION"],$query[$i]["B_ESTADO_LOGICO"]);						
			array_push($this->actuacion, $actuacion);
		}
	}

	public function modificarActuacion($idActuacion,$nombreActuacion,$accionActuacion)
	{
		$actuacion = new Actuacion();			
		$actuacion->asignarDatos($idActuacion,$nombreActuacion,$accionActuacion,1);						
		return $actuacion->modificar($this->db);
	}	

	public function eliminarActuacion($idActuacion,$nombreActuacion,$accionActuacion)
	{
		$actuacion = new Actuacion();			
		$actuacion->asignarDatos($idActuacion,$nombreActuacion,$accionActuacion,0);						
		return $actuacion->modificar($this->db);
	}	

	public function guardarActuacion($nombreActuacion, $accionActuacion)
	{
		$actuacion = new Actuacion();			
		$actuacion->asignarDatos(-1,$nombreActuacion,$accionActuacion,1);						
		return $actuacion->guardar($this->db);
	}		



	public function cargarMotivo()
	{
		$query = $this->db->RunSP("SP_MOTIVO",SELECT, array('obtenerMotivo','','',''));      
		for($i = 0; $i < count($query); $i++)
		{
			$motivo = new Motivo();			
			$motivo->asignarDatos($query[$i]["PK_I_ID_ACTUACION_MOTIVO"],$query[$i]["V_NOMBRE_ACTUACION_MOTIVO"],$query[$i]["B_ESTADO_LOGICO"]);						
			array_push($this->motivo, $motivo);
		}
	}	

	public function modificarMotivo($idMotivo,$nombreMotivo)
	{
		$motivo = new Motivo();			
		$motivo->asignarDatos($idMotivo,$nombreMotivo,1);						
		return $motivo->modificar($this->db);
	}			

	public function eliminarMotivo($idMotivo,$nombreMotivo)
	{
		$motivo = new Motivo();			
		$motivo->asignarDatos($idMotivo,$nombreMotivo,0);						
		return $motivo->modificar($this->db);
	}		

	public function guardarMotivo($nombreActuacion)
	{
		$motivo = new Motivo();			
		$motivo->asignarDatos(-1,$nombreActuacion,1);						
		return $motivo->guardar($this->db);
	}		


	public function cargarDocumento()
	{
		$query = $this->db->RunSP("SP_DOCUMENTO",SELECT, array('obtenerDocumento','','',''));      
		for($i = 0; $i < count($query); $i++)
		{
			$documento = new Documento();			
			$documento->asignarDatos($query[$i]["PK_I_ID_ACTUACION_DOCUMENTO"],$query[$i]["V_NOMBRE_ACTUACION_DOCUMENTO"],$query[$i]["B_ESTADO_LOGICO"]);						
			array_push($this->documento, $documento);
		}
	}

	public function modificarDocumento($idDocumento,$nombreDocumento)
	{
		$documento = new Documento();			
		$documento->asignarDatos($idDocumento,$nombreDocumento,1);						
		return $documento->modificar($this->db);
	}			

	public function eliminarDocumento($idDocumento,$nombreDocumento)
	{
		$documento = new Documento();			
		$documento->asignarDatos($idDocumento,$nombreDocumento,0);						
		return $documento->modificar($this->db);
	}		

	public function guardarDocumento($nombreDocumento)
	{
		$documento = new Documento();			
		$documento->asignarDatos(-1,$nombreDocumento,1);						
		return $documento->guardar($this->db);
	}

	public function cargarVariableSoporte()
	{
		$query = $this->db->RunSP("SP_VARIABLES_ENTORNO",SELECT, array('cargarVariableEntorno','','',''));      
		for($i = 0; $i < count($query); $i++)
		{
			$variableSoporte = new VariableSoporte();			
			$variableSoporte->asignarDatos($query[$i]["PK_I_ID_VARIABLE"],$query[$i]["V_NOMBRE_VARIABLE"],$query[$i]["V_VALOR_VARIABLE"]);						
			array_push($this->variableSoporte, $variableSoporte);
		}
	}	

	public function modificarVariableDocumento($idVariableSoporte,$valorVariableSoporte)
	{
		$variableSoporte = new VariableSoporte();			
		$variableSoporte->asignarDatos($idVariableSoporte, '', $valorVariableSoporte);						
		return $variableSoporte->modificar($this->db);
	}	

	public function obtenerVariableSoporteNombre($nombreVariableSoporte)
	{
		$variableSoporte = new VariableSoporte();
		$variableSoporte->obtenerVariableSoporteNombre($nombreVariableSoporte, $this->db);
		return $variableSoporte->getValorVariableSoporte();
	}


	public function getDocumento()
	{
		return $this->documento;
	}

	private function setDocumento($documento)
	{
		$this->$documento = $documento;
	}		

	public function getMotivo()
	{
		return $this->motivo;
	}

	private function setMotivo($motivo)
	{
		$this->$motivo = $motivo;
	}		

	public function getSubdireccion()
	{
		return $this->subdireccion;
	}

	private function setSubdireccion($subdireccion)
	{
		$this->$subdireccion = $subdireccion;
	}		

	public function getActuacion()
	{
		return $this->actuacion;
	}

	private function setActuacion($actuacion)
	{
		$this->$actuacion = $actuacion;
	}			

	public function getModalidadTramite()
	{
		return $this->modalidadTramite;
	}

	private function setCheckList($modalidadTramite)
	{
		$this->$modalidadTramite = $modalidadTramite;
	}	

	public function getVariableSoporte()
	{
		return $this->variableSoporte;
	}

	private function setVariableSoporte($variableSoporte)
	{
		$this->$variableSoporte = $variableSoporte;
	}		

}

?>