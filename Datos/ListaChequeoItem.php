<?php

class CheckListItem
{

	private $idCheckListItem;
	private $nombreCheckListItem;
	private $estadoLogico;

	public function __construct()
	{		        	

	}

	public function cargarCheckListItem($idCheckListItem, $nombreCheckListItem)
	{
    	$this->setIdCheckListItem($idCheckListItem);
    	$this->setNombreCheckListItem($nombreCheckListItem);
	}

	public function nuevoItem($nombreCheckListItem,$idCheckList, $db)
	{
		$this->setNombreCheckListItem($nombreCheckListItem);	
		$query = $db->RunSP("SP_CHECK_LIST_ITEM",SELECT, array('crearCheckListItem','',$idCheckList,$this->getNombreCheckListItem(),''));  
		$this->setIdCheckListItem($query[0]["PK_D_ID_CHECK_LIST_ITEM"]);
		$this->setEstadoLogico(1);
	}

	public function modificarItem($idCheckList,$idCheckListItem,$nombreCheckListItem,$db)
	{
		$db->RunSP("SP_CHECK_LIST_ITEM",UPDATE, array('modificarCheckListItem',$idCheckListItem,$idCheckList,$nombreCheckListItem,''));  
	}

	public function eliminarItem($idCheckList,$idCheckListItem,$db)
	{
		$db->RunSP("SP_CHECK_LIST_ITEM",UPDATE, array('eliminarCheckListItem',$idCheckListItem,$idCheckList,'',''));  
	}


	public function getIdCheckListItem()
	{
		return $this->idCheckListItem;
	}

	private function setIdCheckListItem($idCheckListItem)
	{
		$this->idCheckListItem = $idCheckListItem;
	}

	public function getNombreCheckListItem()
	{
		return $this->nombreCheckListItem;
	}

	private function setNombreCheckListItem($nombreCheckListItem)
	{
		$this->nombreCheckListItem = $nombreCheckListItem;
	}

	public function getEstadoLogico()
	{
		return $this->estadoLogico;
	}

	private function setEstadoLogico($estadoLogico)
	{
		$this->estadoLogico = $estadoLogico;
	}

}

?>