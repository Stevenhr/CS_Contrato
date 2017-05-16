<?php

class ItemProcesoModalidad
{
	private $idItemProceso;
	private $idModalidadTramite;	

	public function __construct()
	{		        	

	}

	public function getIdItemProceso()
	{    	
    	return $this->idItemProceso;
	}

	public function setIdItemProceso($idItemProceso)
	{    	
    	$this->idItemProceso = $idItemProceso;
	}			

	public function getIdModalidadTramite()
	{    	
    	return $this->idModalidadTramite;
	}

	public function setIdModalidadTramite($idModalidadTramite)
	{    	
    	$this->idModalidadTramite = $idModalidadTramite;
	}				

	public function guardar($idItemProceso, $idModalidadTramite, $db)
	{
		$db->RunSP("SP_ITEM_PROCESO",INSERT, array('guardarPanel', $idItemProceso, $idModalidadTramite));
	}

	public function eliminarPorModalidad($idModalidadTramite, $db)
	{
		$db->RunSP("SP_ITEM_PROCESO",INSERT, array('eliminarPanelPorModalidad', null, $idModalidadTramite));
	}	

}

?>