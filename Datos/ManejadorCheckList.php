<?php

if(!class_exists('Query')){ include 'Query.php'; }
include("ListaChequeo.php");

class ManejadorCheckList
{
	private $checkList;
	private $db; 

	public function __construct()
	{		    
    	$this->db = new Query('Principal');
    	$this->checkList = array();
	}

	public function obtenerCheckList()
	{
		$query = $this->db->RunSP("SP_CHECK_LIST",SELECT, array('obtenerCheckList','','',''));      
		for($i = 0; $i < count($query); $i++)
		{
			$checkList = new CheckList();			
			$checkList->cargarCheckList($query[$i]["PK_D_ID_CHECK_LIST"],$query[$i]["V_NOMBRE_CHECK_LIST"],'');						
			$query2 = $this->db->RunSP("SP_CHECK_LIST_ITEM",SELECT, array('obtenerCheckListItem','',$checkList->getIdCheckList(),'',''));      
			for($j = 0; $j < count($query2); $j++)
			{				
				$checkListItem = new CheckListItem();			
				$checkListItem->cargarCheckListItem($query2[$j]["PK_D_ID_CHECK_LIST_ITEM"],$query2[$j]["V_NOMBRE_ITEM"]);			
				$checkList->setListaCheckListItem($checkListItem);
		    }
			array_push($this->checkList, $checkList);
		}
	}

	public function obtenerCheckListId($idCheckList)
	{
		$query = $this->db->RunSP("SP_CHECK_LIST",SELECT, array('obtenerCheckListId',$idCheckList,'',''));      
		for($i = 0; $i < count($query); $i++)
		{
			$checkList = new CheckList();			
			$checkList->cargarCheckList($query[$i]["PK_D_ID_CHECK_LIST"],$query[$i]["V_NOMBRE_CHECK_LIST"],'');						
			$query2 = $this->db->RunSP("SP_CHECK_LIST_ITEM",SELECT, array('obtenerCheckListItem','',$checkList->getIdCheckList(),'',''));      
			for($j = 0; $j < count($query2); $j++)
			{				
				$checkListItem = new CheckListItem();			
				$checkListItem->cargarCheckListItem($query2[$j]["PK_D_ID_CHECK_LIST_ITEM"],$query2[$j]["V_NOMBRE_ITEM"]);			
				$checkList->setListaCheckListItem($checkListItem);
		    }
			array_push($this->checkList, $checkList);
		}
	}


	public function nuevoCheckList($nombreCheckList, $listaCheckListItem)
	{
		if(!$this->validarExistenciaCheckList($nombreCheckList))
		{
			$checkList = new CheckList();				
			$checkList->nuevoCheckList($nombreCheckList, $listaCheckListItem,$this->db);			
			return true;
		}
		else
		{
			return false;
		}
	}

	public function nuevoCheckListItem($idCheckList, $listaCheckListItem)
	{
			$checkList = new CheckList();				
			$checkList->nuevoCheckListItem($idCheckList, $listaCheckListItem,$this->db);			
			return true;
	}	

	public function eliminarCheckList($idCheckList)
	{
		$checkList = new CheckList();
		$checkList->eliminarCheckList($idCheckList,$this->db);			
	}

	private function validarExistenciaCheckList($nombreCheckList)
	{
		$query = $this->db->RunSP("SP_CHECK_LIST",SELECT, array('validarExistenciaCheckList','',$nombreCheckList,''));      
		if($query[0]["PK_D_ID_CHECK_LIST"] != 0)
			return true;
		return false;
	}

	public function modificarCheckListItem($idCheckList,$idCheckListItem,$nombreCheckListItem)
	{
		$checkListItem = new CheckListItem();	
		$checkListItem->modificarItem($idCheckList,$idCheckListItem,$nombreCheckListItem,$this->db);
	}

	public function eliminarCheckListItem($idCheckList,$idCheckListItem)
	{
		$checkListItem = new CheckListItem();	
		$checkListItem->eliminarItem($idCheckList,$idCheckListItem,$this->db);
	}

	public function modificarNombreCheckLis($idCheckList,$nombreCheckList)
	{
		$checkList = new CheckList();
		$checkList->cargarCheckList($idCheckList,$nombreCheckList);
		$checkList->modificarNombreCheckList($this->db);
	}	


	public function getCheckList()
	{
		return $this->checkList;
	}

	private function setCheckList($checkList)
	{
		$this->$checkList = $checkList;
	}

}

?>