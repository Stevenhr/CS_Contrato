function cargarCheckList()
{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/CheckList.php',
			   data: {HD_VALIDACION : 'cargarCheckList'}, 
			   success: function(data)
			   {							   					   		
			   		$("#DV_CARGA").html('');
			   		$("#DV_CONTENIDO").html(data);			   		
			   }
			 });			

}


$('#BTN_CERRAR_VENTANA').click(function()
{	  
	$('#MODAL_NUEVO_CHECK_LIST').modal('hide');	  
});			

$('#BTN_CERRAR_VENTANA_INFORMACION_CHECK_LIST').click(function()
{	  
	$('#MODAL_INFORMACION_CHECK_LIST').modal('hide');	
});			

$('#BTN_CERRAR_VENTANA_MOD').click(function()
{	  
	$('#MODAL_EDITAR_CHECK_LIST').modal('hide');	
});			

$('#BTN_CERRAR_VENTANA_NUEVO_ITEM_CHECK_LIST').click(function()
{	  
	$('#MODAL_NUEVO_ITEM_CHECK_LIST').modal('hide');	
});			


$('#BTN_AGREGAR_CHECK_LIST').click(function()
{		
	$('#TX_CHECK_LIST').val('');
	$('#LB_TITULO_MODAL').html("Agregar CheckList");		
	$('#DV_ITEM_CHECK_LIST').html("");
	$('#HD_VALIDACION').val('crearCheckList');		
	$('#HD_ID_CHECK_LIST').val(0);		
	$('#MODAL_NUEVO_CHECK_LIST').modal('show');	
	$('#INFORMACION_CONFIRMACION_CHECK_LIST').hide();	
	$('#DV_CARGA_2').html('');	
	
});

$('#BTN_CANCELAR_ELIMINAR_ITEM').click(function()
{			
	$('#MODAL_INFORMACION_CHECK_LIST').modal('hide');	
});

$('#BTN_ELIMINAR_ITEM').click(function()
{			
	
	if($('#HD_ID_CHECK_LIST').val() == 0)
	{		
		$('#INFORMACION_CHECK_LIST').html('<div class="alert alert-dismissible alert-alert"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> Ha ocurrido un error inesperado, Por favor comuniquese con el área de sistemas.</div>');					
	}
	else
	{		
		var idCheckList = $('#HD_ID_CHECK_LIST').val();
		$.ajax({
			   type: "POST",
			   url: '../Logica/CheckList.php',
			   data: {HD_VALIDACION : 'eliminarCheckList', ID_CHECK_LIST : idCheckList}, 
			   success: function(data)
			   {								   					
					$('#INFORMACION_CONFIRMACION_CHECK_LIST').hide();	
					if(data == 1)
					{						
						$('#INFORMACION_CHECK_LIST').html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> Se ha eliminado correctamente el Check List.</div>');				
						$('#HD_ID_CHECK_LIST').val(0);	
						cargarCheckList();					   	
					}
					else
					{						
						$('#INFORMACION_CHECK_LIST').html('<div class="alert alert-dismissible alert-alert"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> Ha ocurrido un error inesperado, Por favor comuniquese con el área de sistemas.</div>');				
					}
			   }

			 });		

	}
	
	
});


$('#BTN_ANADIR_ITEM').click(function()
{	
	$('#DV_ITEM_CHECK_LIST').append('<div class="form-group"><label class="col-sm-2 control-label">Nombre Item: </label><div class="col-sm-10"><input type="text" name="TX_ITEM[]" class="form-control" placeholder="Item" maxlength="99" required /></div></div>');	
});

$( document ).ready(function() {

	$("#FR_NUEVO_CHECK_LIST").submit(function()
	{
		$("#DV_CARGA_2").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/CheckList.php',
			   data: $("#FR_NUEVO_CHECK_LIST").serialize(),
			   success: function(data)
			   {								   
					if(data == 1)
					{
						$("#DV_CARGA_2").html('');
						$('#MODAL_NUEVO_CHECK_LIST').modal('hide');
						cargarCheckList();						
						$('#INFORMACION_CHECK_LIST').html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> Se ha agregado correctamente el CheckList</div>');
						$('#MODAL_INFORMACION_CHECK_LIST').modal('show');
					}
					else
					{
						$("#DV_CARGA_2").html(data);
					}
					
			   }
			 });		
		return false;
	});

	$("#FR_MODAL_NUEVO_ITEM_CHECK_LIST").submit(function()
	{		
		$("#DV_CARGA_3").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/CheckList.php',
			   data: $("#FR_MODAL_NUEVO_ITEM_CHECK_LIST").serialize(),
			   success: function(data)
			   {								   
					if(data == 1)
					{
						$("#DV_CARGA_3").html('');
						$('#MODAL_NUEVO_ITEM_CHECK_LIST').modal('hide');
						$('#HD_ID_CHECK_LIST_3').val(0);							
						cargarCheckList();						
						$('#INFORMACION_CHECK_LIST').html('<div class="alert alert-dismissible alert-success"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> Se ha agregado correctamente los item al CheckList</div>');
						$('#MODAL_INFORMACION_CHECK_LIST').modal('show');
					}
					else
					{
						$("#DV_CARGA_3").html(data);
					}
					
			   }
			 });		
		return false;
	});

   
});

function eliminarCheckList(idCheckList)
{
	$('#HD_ID_CHECK_LIST').val(idCheckList);
	$('#MODAL_INFORMACION_CHECK_LIST').modal('show');
	$('#INFORMACION_CONFIRMACION_CHECK_LIST').show();	
	$('#INFORMACION_CHECK_LIST').html('');
}

function modificarCheckList(idCheckList)
{
	$('#HD_ID_CHECK_LIST_2').val(idCheckList);
	$("#DV_CARGA_3").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$('#MODAL_EDITAR_CHECK_LIST').modal('show');	
	$('#DV_ITEM_CHECK_LIST_MOD').html('');	
	
	$.ajax({
		   type: "POST",
		   url: '../Logica/CheckList.php',
		   data: {HD_VALIDACION : 'obtenerCheckListId', ID_CHECK_LIST : idCheckList}, 
		   success: function(data)
		   {								   
				if(data == 0)
				{
					$("#DV_CARGA_3").html('<div class="alert alert-dismissible alert-alert"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> Ha ocurrido un error inesperado, Por favor comuniquese con el área de sistemas.</div>');
				}
				else
				{
					$("#DV_CARGA_3").html('');
					$('#DV_ITEM_CHECK_LIST_MOD').html(data);	
				}
		   }
		 });	

}

function modificarCampoItem1(idCheckList, idCheckListItem, nombreItem)
{	
	if(nombreItem == "")
	{

	}
	else
	{
		$.ajax({
			   type: "POST",
			   url: '../Logica/CheckList.php',
			   data: {HD_VALIDACION : 'modificarCheckListId', ID_CHECK_LIST : idCheckList, ID_CHECK_LIST_ITEM : idCheckListItem, NOMBRE_ITEM : nombreItem}, 
			   success: function(data)
			   {								   				
					if(data == 1)
					{
						$('#TX_ITEM_MOD' + idCheckList + '-' + idCheckListItem).attr('readonly', true);  		
						var new_row = '<td id="TR_ITEM_MOD' +  idCheckList + '-' + idCheckListItem + '">' +  nombreItem + '</td>';
						$('#TR_ITEM_MOD' + idCheckList + '-' + idCheckListItem).html(nombreItem);					
					}
			   }
			 });		
	}
}

function eliminarCampoItem1(idCheckList, idCheckListItem)
{		
		$.ajax({
			   type: "POST",
			   url: '../Logica/CheckList.php',
			   data: {HD_VALIDACION : 'eliminarCheckListId', ID_CHECK_LIST : idCheckList, ID_CHECK_LIST_ITEM : idCheckListItem}, 
			   success: function(data)
			   {								   									
					if(data == 1)
					{
						$('#FILAITEM' + idCheckList + '-' + idCheckListItem).hide(650);
						$('#TR_ITEM_MOD' + idCheckList + '-' + idCheckListItem).hide(650);
					}
			   }
			 });				
}

function guardarCampoItemNombre1(idCheckList)
{
	var nombreCheckList = $('#LB_NOMBRE_CL_MOD' + idCheckList).val();
		$.ajax({
			   type: "POST",
			   url: '../Logica/CheckList.php',
			   data: {HD_VALIDACION : 'modificarNombreCheckList', ID_CHECK_LIST : idCheckList, NOMBRE_CHECK_LIST : nombreCheckList}, 
			   success: function(data)
			   {								   														
					if(data == 1)
					{
						$('#LB_NOMBRE_CL_' + idCheckList).html(nombreCheckList);						
						$('#LB_NOMBRE_CL_MOD' + idCheckList).attr('readonly', true);	
					}
			   }
			 });				
}

$('#BTN_ANADIR_ITEM_NUEVO_CHECK_LIST').click(function()
{	
	$('#DV_ITEM_NUEVO_ITEM_CHECK_LIST').append('<div class="form-group"><label class="col-sm-2 control-label">Nombre Item: </label><div class="col-sm-10"><input type="text" name="TX_NUEVO_ITEM[]" class="form-control" placeholder="Item" maxlength="99" required /></div></div>');	
});

function adicionarItemCheckList(idCheckList)
{
    inputTxNuevoItem = document.getElementsByName('TX_NUEVO_ITEM[]');
    for (i=0; i<inputTxNuevoItem.length; i++)    			
	{
		inputTxNuevoItem[i].value = "";
	}	

	$('#HD_ID_CHECK_LIST_3').val(idCheckList);		
	$('#DV_CARGA_3').html('');	
	$('#DV_ITEM_NUEVO_ITEM_CHECK_LIST').html('');	
	$('#MODAL_NUEVO_ITEM_CHECK_LIST').modal('show');	
	$('#INFORMACION_CONFIRMACION_CHECK_LIST').hide();
   	
}
