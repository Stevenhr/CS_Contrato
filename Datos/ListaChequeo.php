<?php

include("ListaChequeoItem.php");

class CheckList
{

	private $idCheckList;
	private $nombreCheckList;
	private $listaCheckListItem;
	private $estadoLogico;

	public function __construct()
	{		        	
		$this->listaCheckListItem = array();
	}

	public function cargarCheckList($idCheckList, $nombreCheckList)
	{    	
    	$this->setIdCheckList($idCheckList);
    	$this->setNombreCheckList($nombreCheckList);	
	}

	public function nuevoCheckList($nombreCheckList, $listaCheckListItem, $db)
	{
		$this->setNombreCheckList($nombreCheckList);	
		$this->guardarCheckList($db);
		foreach ($listaCheckListItem as $item)
		{
			$checkListItem = new CheckListItem();
			$checkListItem->nuevoItem($item,$this->getIdCheckList(), $db);						
			$this->setListaCheckListItem($checkListItem);
		}			
	}

	public function nuevoCheckListItem($idCheckList, $listaCheckListItem, $db)
	{
		$this->setIdCheckList($idCheckList);			
		foreach ($listaCheckListItem as $item)
		{
			$checkListItem = new CheckListItem();
			$checkListItem->nuevoItem($item,$this->getIdCheckList(), $db);						
			$this->setListaCheckListItem($checkListItem);
		}			
	}	

	private function guardarCheckList($db)
	{
		$query = $db->RunSP("SP_CHECK_LIST",SELECT, array('crearCheckList','',$this->getNombreCheckList(),''));  
		$this->setIdCheckList($query[0]["PK_D_ID_CHECK_LIST"]);	
		$this->setEstadoLogico(1);	
	}

	public function eliminarCheckList($idCheckList,$db)
	{
		$this->setIdCheckList($idCheckList);
		$db->RunSP("SP_CHECK_LIST",UPDATE, array('eliminarCheckList',$this->getIdCheckList(), '', ''));  
	}

	public function modificarNombreCheckList($db)
	{		
		$db->RunSP("SP_CHECK_LIST",UPDATE, array('modificarNombreCheckList',$this->getIdCheckList(), $this->getNombreCheckList(), ''));  	
	}

	public function obtenerCheckListId($idCheckList, $db)
	{
		$query = $db->RunSP("SP_CHECK_LIST",SELECT, array('obtenerCheckListId', $idCheckList,'',''));      
		$this->setIdCheckList($query[0]["PK_D_ID_CHECK_LIST"]);
		$this->setNombreCheckList($query[0]["V_NOMBRE_CHECK_LIST"]);
		$this->setEstadoLogico($query[0]["B_ESTADO_LOGICO"]);

		$query2 = $db->RunSP("SP_CHECK_LIST_ITEM",SELECT, array('obtenerCheckListItemId','', $idCheckList,'',''));      
		for($j = 0; $j < count($query2); $j++)
		{				
			$checkListItem = new CheckListItem();			
			$checkListItem->cargarCheckListItem($query2[$j]["PK_D_ID_CHECK_LIST_ITEM"],$query2[$j]["V_NOMBRE_ITEM"]);			
			$this->setListaCheckListItem($checkListItem);
	    }	
	}


	public function getIdCheckList()
	{
		return $this->idCheckList;
	}

	private function setIdCheckList($idCheckList)
	{
		$this->idCheckList = $idCheckList;
	}

	public function getNombreCheckList()
	{
		return $this->nombreCheckList;
	}

	private function setNombreCheckList($nombreCheckList)
	{
		$this->nombreCheckList = $nombreCheckList;
	}

	public function getListaCheckListItem()
	{
		return $this->listaCheckListItem;
	}

	public function setListaCheckListItem($listaCheckListItem)
	{		
		array_push($this->listaCheckListItem, $listaCheckListItem);
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