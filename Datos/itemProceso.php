<?php

class ItemProceso
{
	private $idItemProceso;
	private $nombreItemProceso;
	private $nombrePanelItemProceso;

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

	public function getNombreItemProceso()
	{    	
    	return $this->nombreItemProceso;
	}

	public function setNombreItemProceso($nombreItemProceso)
	{    	
    	$this->nombreItemProceso = $nombreItemProceso;
	}				

	public function getNombrePanelItemProceso()
	{    	
    	return $this->nombrePanelItemProceso;
	}

	public function setNsombrePanelItemProceso($nombrePanelItemProceso)
	{    	
    	$this->nombrePanelItemProceso = $nombrePanelItemProceso;
	}					
}

?>