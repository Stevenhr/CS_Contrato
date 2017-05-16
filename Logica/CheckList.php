<?php

include("../Datos/ManejadorCheckList.php");
$opcion = $_POST["HD_VALIDACION"];

if($opcion == 'cargarCheckList')
{	
	$manejadorCheckList = new ManejadorCheckList();
	$manejadorCheckList->obtenerCheckList();
	$listaCheckList = $manejadorCheckList->getCheckList();
	if(count($listaCheckList) != 0)
	{
		session_start();
		$ariaExpandes = 1;
		$actividadesOpciones = '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';				   	
		foreach ($listaCheckList as $checkList)
		{	
			if($ariaExpandes == 1)
			{
				$ariaExpandes++;
				$ariaExpandesContent = '<a data-toggle="collapse" data-parent="#accordion" aria-expanded="true" id="LB_NOMBRE_CL_' . $checkList->getIdCheckList() . '" ';
				$ariaExpandesContent2 = '<div class="panel-collapse collapse in" role="tabpanel" ';
			}
			else
			{
				$ariaExpandes++;
				$ariaExpandesContent = '<a class="collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" id="LB_NOMBRE_CL_' . $checkList->getIdCheckList() . '" ';
				$ariaExpandesContent2 = '<div class="panel-collapse collapse" role="tabpanel" ';				
			}


			$actividadesOpciones .= '<div class="panel panel-default">';
			$actividadesOpciones .= '<div class="panel-heading" role="tab" id="heading' . $checkList->getIdCheckList() . '">';
			$actividadesOpciones .= '<h4 class="panel-title">';
			$actividadesOpciones .= $ariaExpandesContent . ' href="#collapse' . $checkList->getIdCheckList() .  '" aria-controls="collapse' . $checkList->getIdCheckList() .  '">';
			$actividadesOpciones .= $checkList->getNombreCheckList();
			$actividadesOpciones .= '</a>';
			

			if($_SESSION['Creación Check-List'] == 1)
				$actividadesOpciones .= '<button type="button" class="Crear_Item_CheckList btn btn-link" id="' .  $checkList->getIdCheckList() . '" title="Agregar Item CheckList"><span class="glyphicon glyphicon-list-alt"></span></button>';
			else
				$actividadesOpciones .= '<button type="button" class="btn btn-link" title="Agregar Item CheckList" disabled="disabled"><span class="glyphicon glyphicon-list-alt"></span></button>';				

			if($_SESSION['Modificar Check-List'] == 1)
				$actividadesOpciones .= '<button type="button" class="Editar_CheckList btn btn-link" id="' .  $checkList->getIdCheckList() . '" title="Editar CheckList"><span class="glyphicon glyphicon-pencil"></span></button>';
			else
				$actividadesOpciones .= '<button type="button" class="btn btn-link" title="Editar CheckList" disabled="disabled"><span class="glyphicon glyphicon-pencil"></span></button>';				

			if($_SESSION['Eliminar Check-List'] == 1)
				$actividadesOpciones .= '<button type="button" class="Eliminar_CheckList btn btn-link" id="' . $checkList->getIdCheckList() . '" title="Eliminar CheckList"><span class="glyphicon glyphicon-remove"></span></button>';
			else
				$actividadesOpciones .= '<button type="button" class="btn btn-link" title="Eliminar CheckList" disabled="disabled"><span class="glyphicon glyphicon-remove"></span></button>';				

			$actividadesOpciones .= '</h4></div>';
			$actividadesOpciones .= $ariaExpandesContent2 .' id="collapse' . $checkList->getIdCheckList() .  '" aria-labelledby="headingOne' . $checkList->getIdCheckList() . '">';
			$actividadesOpciones .= '<div class="panel-body">';

			$listaCheckListItem = $checkList->getListaCheckListItem();
			if(count($listaCheckListItem) == 0)
			{
				$actividadesOpciones .= "<strong>No hay opciones de chequeo disponbiles.</strong>";
			}
			else
			{
				
				$actividadesOpciones .= "<div class='table-responsive'><table class='table table-bordered table-striped'>
            							<thead><tr>
            		 						<th>Item CheckList</th>
		  								      </tr></thead>";						

				$actividadesOpciones .= "<tbody>";

				foreach ($listaCheckListItem as $listaItem)
				{					
					$actividadesOpciones .= "<tr>";
					$actividadesOpciones .= '<td id="TR_ITEM_MOD' .  $checkList->getIdCheckList() . '-' . $listaItem->getIdCheckListItem() . '">' . $listaItem->getNombreCheckListItem() . '</td>';
					$actividadesOpciones .= "</tr>";
				}			

				$actividadesOpciones .= "</tbody></table></div>";
			}

			$actividadesOpciones .= '</div></div></div>';			

		}
		$actividadesOpciones .= '</div>';

		$actividadesOpciones .= "<script>
									
									$('.Crear_Item_CheckList').click(function(){
										  var idCheckList = $(this).attr('id');
										  adicionarItemCheckList(idCheckList);
										
															          });		 									

									$('.Editar_CheckList').click(function(){
										  var idCheckList = $(this).attr('id');
										  modificarCheckList(idCheckList);
										
															          });		 
															  
									$('.Eliminar_CheckList').click(function(){
										  var idCheckList = $(this).attr('id');
										  eliminarCheckList(idCheckList);
															  });
								 </script>";

		echo $actividadesOpciones;
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>No existen ChekcList Registrados.</div>';
	}
	
}

if($opcion == 'crearCheckList')
{	
	if(isset($_POST["TX_ITEM"]))
	{				
		$manejadorCheckList = new ManejadorCheckList();		
		if($manejadorCheckList->nuevoCheckList($_POST["TX_CHECK_LIST"] , $_POST["TX_ITEM"]))
		{
			echo 1;
		}
		else
		{
			echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>El CheckList que desea ingresar al módulo ya se encuentra registrado.</div>';
		}
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Debe tener al menos un item para poder crear el CheckList.</div>';
	}
}

if($opcion == 'eliminarCheckList')
{
	$manejadorCheckList = new ManejadorCheckList();		
	$manejadorCheckList->eliminarCheckList($_POST["ID_CHECK_LIST"]);
	echo 1;
}

if($opcion == 'obtenerCheckListId')
{
	$manejadorCheckList = new ManejadorCheckList();		
	$manejadorCheckList->obtenerCheckListId($_POST["ID_CHECK_LIST"]);
	$listaCheckList = $manejadorCheckList->getCheckList();
	if(count($listaCheckList) != 0)
	{
		
		foreach ($listaCheckList as $checkList)
		{	
			
			$actividadesOpciones = '<div class="table-responsive"><table  class="table table-bordered table-striped"><tbody><tr>';
			$actividadesOpciones .= '<td><label>Nombre CheckList: </label></td>';			
			$actividadesOpciones .= '<td><input type="text" class="form-control" id="LB_NOMBRE_CL_MOD' . $checkList->getIdCheckList() . '" placeholder="Nombre CheckList" maxlength="200" value="' . $checkList->getNombreCheckList()  . '" required readonly/></td>';
			$actividadesOpciones .= '<td><button type="button" class="btn btn-link" title="Editar Nombre CheckList" onClick="habilitarCampoItemNombre(' . $checkList->getIdCheckList() . ')"  ><span class="glyphicon glyphicon-pencil"></span></button>';
			$actividadesOpciones .= '<button type="button" class="btn btn-link" title="Guardar CheckList" onClick="guardarCampoItemNombre(' . $checkList->getIdCheckList() . ')" ><span class="glyphicon glyphicon-floppy-disk"></span></button></td>';
			$actividadesOpciones .= '</tbody></tr></table></div>';
		

			$actividadesOpciones .= "<div class='table-responsive'><table class='table table-bordered table-striped' id='TB_LIST_ITEM'>
            							<thead><tr>
            		 						<th>Item CheckList</th>
            		 						<th>Opciones</th>
		  								       </tr></thead>";	
			$actividadesOpciones .= "<tbody>";		  													

			$listaCheckListItem = $checkList->getListaCheckListItem();
			foreach ($listaCheckListItem as $listaItem)
			{
					$actividadesOpciones .= "<tr id='FILAITEM" . $checkList->getIdCheckList() . '-' . $listaItem->getIdCheckListItem() . "'>";					
					$actividadesOpciones .= '<td><input type="text" id="TX_ITEM_MOD' .  $checkList->getIdCheckList() . '-' . $listaItem->getIdCheckListItem() . '" class="form-control" placeholder="Item" value="' .  $listaItem->getNombreCheckListItem() . '"maxlength="99" required readonly /></td>';					
					$actividadesOpciones .= '<td>
												<button type="button" class="btn btn-link" title="Editar Item CheckList" onClick="habilitarCampoItem(' . $checkList->getIdCheckList() . ',' . $listaItem->getIdCheckListItem() . ')" ><span class="glyphicon glyphicon-pencil"></span></button>
												<button type="button" class="btn btn-link" title="Guardar Item CheckList" onClick="modificarCampoItem(' . $checkList->getIdCheckList() . ',' . $listaItem->getIdCheckListItem() . ')"><span class="glyphicon glyphicon-floppy-disk"></span></button>
												<button type="button" class="btn btn-link" title="Eliminar Item CheckList" onClick="eliminarCampoItem(' . $checkList->getIdCheckList() . ',' . $listaItem->getIdCheckListItem() . ')"><span class="glyphicon glyphicon-remove"></span></button>
											</td>';
					$actividadesOpciones .= "</tr>";
			}				
			break;
		}
		$actividadesOpciones .= "</tbody></table></div>";
		$actividadesOpciones .= "									
									<script>
											function habilitarCampoItemNombre(idCheckList)
											{
												$('#LB_NOMBRE_CL_MOD' + idCheckList).attr('readonly', false);
											}
											function guardarCampoItemNombre(idCheckList)
											{												
												guardarCampoItemNombre1(idCheckList);
											}
											function habilitarCampoItem(idCheckList, idCheckListItem)
											{																																																											
												$('#TX_ITEM_MOD' + idCheckList + '-' + idCheckListItem).attr('readonly', false);  		
											}
											function modificarCampoItem(idCheckList, idCheckListItem)
											{
												modificarCampoItem1(idCheckList, idCheckListItem, $('#TX_ITEM_MOD' + idCheckList + '-' + idCheckListItem).val());												
											}
											function eliminarCampoItem(idCheckList, idCheckListItem)											
											{
												 eliminarCampoItem1(idCheckList, idCheckListItem);																							 
											}
									</script>
								";

		echo $actividadesOpciones;
	}	
	else
	{
		echo 0;
	}
}

if($opcion == 'modificarCheckListId')
{
	$manejadorCheckList = new ManejadorCheckList();		
	$manejadorCheckList->modificarCheckListItem($_POST["ID_CHECK_LIST"], $_POST["ID_CHECK_LIST_ITEM"], $_POST["NOMBRE_ITEM"]);
	echo 1;
}

if($opcion == 'eliminarCheckListId')
{
	$manejadorCheckList = new ManejadorCheckList();		
	$manejadorCheckList->eliminarCheckListItem($_POST["ID_CHECK_LIST"], $_POST["ID_CHECK_LIST_ITEM"]);
	echo 1;
}

if($opcion == 'modificarNombreCheckList')
{
	$manejadorCheckList = new ManejadorCheckList();		
	$manejadorCheckList->modificarNombreCheckLis($_POST["ID_CHECK_LIST"], $_POST["NOMBRE_CHECK_LIST"]);
	echo 1;
}

if($opcion == 'agregarItemCheckList')
{		
	if(isset($_POST["TX_NUEVO_ITEM"]))
	{				
		$manejadorCheckList = new ManejadorCheckList();		
		if($manejadorCheckList->nuevoCheckListItem($_POST["HD_ID_CHECK_LIST_3"] , $_POST["TX_NUEVO_ITEM"]))
		{
			echo 1;
		}
		else
		{
			echo '<div class="alert alert-dismissible alert-alert"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> Ha ocurrido un error inesperado, Por favor comuniquese con el área de sistemas.</div>';
		}
	}
	else
	{
		echo '<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Debe tener al menos un item para poder agregar el CheckList.</div>';
	}	
}

?>
