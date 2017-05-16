$('#BTN_CERRAR_VENTANA').click(function()
{	  
	$('#MODAL_NUEVO_ITEM_PROCESO').modal('hide');	  	
});														 


$('#BTN_MODALIDAD_TRAMITE').click(function()
{	  	
	borrarListado();
	$('#LB_ITEM_PROCESO').html('Agregar modalidad de selección o trámite.');	  	
	$('#LB_ITEM_PROCESO_2').html('Modalidad de selección o trámite: ');	
	$('#HD_VALIDACION').val('agregarModalidadTramite');	
	$('#TX_ITEM_PROCESO').val('');
	$('#MODAL_NUEVO_ITEM_PROCESO').modal('show');	  	
	$("#DV_CARGA_2").html('');
	$('#DV_ACTUACION_OPC').hide();
	$('#DV_PANEL_NAVEGACION').show();
	$('#SL_ACTUACION_ACCION_FORM').attr('disabled', true);  		
});				

$('#BTN_SUBDIRECCION').click(function()
{	  
	$('#LB_ITEM_PROCESO').html('Agregar subdirección.');	  	
	$('#LB_ITEM_PROCESO_2').html('Nombre Subdirección: ');	
	$('#HD_VALIDACION').val('agregarSubdireccion');	
	$('#TX_ITEM_PROCESO').val('');
	$('#MODAL_NUEVO_ITEM_PROCESO').modal('show');	  	
	$("#DV_CARGA_2").html('');
	$('#DV_ACTUACION_OPC').hide();
	$('#DV_PANEL_NAVEGACION').hide();
	$('#SL_ACTUACION_ACCION_FORM').attr('disabled', true);  														    		
});	

$('#BTN_MOTIVO').click(function()
{	  
	$('#LB_ITEM_PROCESO').html('Agregar motivo.');	  	
	$('#LB_ITEM_PROCESO_2').html('Nombre Motivo: ');	
	$('#HD_VALIDACION').val('agregarMotivo');	
	$('#TX_ITEM_PROCESO').val('');
	$('#MODAL_NUEVO_ITEM_PROCESO').modal('show');	  	
	$("#DV_CARGA_2").html('');
	$('#DV_ACTUACION_OPC').hide();
	$('#DV_PANEL_NAVEGACION').hide();
	$('#SL_ACTUACION_ACCION_FORM').attr('disabled', true);  														    		
});		

$('#BTN_DOCUMENTO').click(function()
{	  
	$('#LB_ITEM_PROCESO').html('Agregar documento.');	  	
	$('#LB_ITEM_PROCESO_2').html('Nombre Documento: ');	
	$('#HD_VALIDACION').val('agregarDocumento');	
	$('#TX_ITEM_PROCESO').val('');
	$('#MODAL_NUEVO_ITEM_PROCESO').modal('show');	  	
	$("#DV_CARGA_2").html('');
	$('#DV_ACTUACION_OPC').hide();
	$('#DV_PANEL_NAVEGACION').hide();
	$('#SL_ACTUACION_ACCION_FORM').attr('disabled', true);  														    		
});			


$('#BTN_ACTUACION').click(function()
{	  
	$('#LB_ITEM_PROCESO').html('Agregar Actuación.');	  	
	$('#LB_ITEM_PROCESO_2').html('Nombre Actuación: ');	
	$('#HD_VALIDACION').val('agregarActuación');	
	$('#TX_ITEM_PROCESO').val('');
	$('#MODAL_NUEVO_ITEM_PROCESO').modal('show');	  	
	$("#DV_CARGA_2").html('');
	$('#DV_ACTUACION_OPC').show();
	$('#DV_PANEL_NAVEGACION').hide();
	$('#SL_ACTUACION_ACCION_FORM').attr('disabled', false);  	
	$('#SL_ACTUACION_ACCION_FORM').val(null);	
});				

function cargarModalidad()
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'cargarModalidad'}, 
		   success: function(data)
		   {								   				
				$("#DV_CARGA").html('');
				$("#TAB_MODALIDAD_2").html(data);
		   }
		 });		
}

function cargarPanelNavegacion()
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'cargarPanelNavegacion'}, 
		   success: function(data)
		   {								   				
				$("#DV_CARGA").html('');
				$('#DV_ITEM_PANEL_NAVEGACION').html(data);
		   }
		 });		
}

function cargarSubdireccion()
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'cargarSubdireccion'}, 
		   success: function(data)
		   {								   				
				$("#DV_CARGA").html('');
				$("#TAB_SUBDIRECCION_SOL_2").html(data);
		   }
		 });		
}

function cargarActuacion()
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'cargarActuacion'}, 
		   success: function(data)
		   {								   				
				$("#DV_CARGA").html('');
				$("#TAB_ACTUACION_2").html(data);
		   }
		 });		
}

function cargarMotivo()
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'cargarMotivo'}, 
		   success: function(data)
		   {								   				
				$("#DV_CARGA").html('');
				$("#TAB_MOTIVO_2").html(data);
		   }
		 });		
}

function cargarDocumento()
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'cargarDocumento'}, 
		   success: function(data)
		   {								   				
				$("#DV_CARGA").html('');
				$("#TAB_DOCUMENTO_2").html(data);
		   }
		 });		
}

function cargarVariableSoporte()
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'cargarVariableSoporte'}, 
		   success: function(data)
		   {								   				
				
				$("#DV_CARGA").html('');
				$("#TAB_VARIABLE_SOPORTE_2").html(data);
		   }
		 });		
}


function editarModalidad(idModalidadTramite)
{			
	borrarListado();	
	$('#LB_ITEM_PROCESO').html('Editar modalidad de selección o trámite.');	  	
	$('#LB_ITEM_PROCESO_2').html('Modalidad de selección o trámite: ');	
	$('#HD_VALIDACION').val('editarModalidad');	
	$('#TX_ITEM_PROCESO').val('');
	$('#MODAL_NUEVO_ITEM_PROCESO').modal('show');	  	
	$("#DV_CARGA_2").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$('#DV_ACTUACION_OPC').hide();
	$('#DV_PANEL_NAVEGACION').show();
	$('#SL_ACTUACION_ACCION_FORM').attr('disabled', true);  														    			

	_idModalidadTramite = retornarCodigo(idModalidadTramite);
	$('#HD_MODALIDAD_TRAMITE').val(_idModalidadTramite);		
	//$('#EDIT' + _idModalidadTramite).attr('disabled', true);  														  
	//$('#TX_MODALIDAD_TRAMITE' + _idModalidadTramite).attr('disabled', false);  														  
	//$('#SAVE' + _idModalidadTramite).attr('disabled', false);  	

	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'obtenerTramiteId', idModalidadTramite : _idModalidadTramite}, 
		   success: function(data)
		   {								   												
				$("#TX_ITEM_PROCESO").val(data);							
				$("#DV_CARGA_2").html('');					
		   }
		 });	

	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'cargarPanelNavegacionPorId', idModalidadTramite : _idModalidadTramite}, 
		   success: function(data)
		   {								   																				
				var datos_panel_navegacion = $.parseJSON(data);
				for (i = 0; i < datos_panel_navegacion.length; i++)
				{ 										
					$("#CB_ITEM_PANEL_NAVEGACION" + datos_panel_navegacion[i]).prop("checked", true);
				}
		   }
		 });
}

function guardarModalidad(idModalidadTramite)
{	
	_idModalidadTramite = retornarCodigo(idModalidadTramite);	
	_nombreModalidadTramite = $('#TX_MODALIDAD_TRAMITE' + _idModalidadTramite).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'editarModalidad', idModalidadTramite : _idModalidadTramite, nombreModalidadTramite : _nombreModalidadTramite}, 
		   success: function(data)
		   {								   				
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#EDIT' + _idModalidadTramite).attr('disabled', false);  														  
					$('#TX_MODALIDAD_TRAMITE' + _idModalidadTramite).attr('disabled', true);  														  
					$('#SAVE' + _idModalidadTramite).attr('disabled', true);  														  					
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });			
}

function eliminarModalidad(idModalidadTramite)
{		
	_idModalidadTramite = retornarCodigo(idModalidadTramite);	
	_nombreModalidadTramite = $('#TX_MODALIDAD_TRAMITE' + _idModalidadTramite).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'eliminarModalidad', idModalidadTramite : _idModalidadTramite, nombreModalidadTramite : _nombreModalidadTramite}, 
		   success: function(data)
		   {								   				
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#ROW' + _idModalidadTramite).hide(1000);
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });				
}

function retornarCodigo(idModalidadTramite)
{
	var id = "";
	for(i = 0; i < idModalidadTramite.length; i = i + 1)
	{
		if(i >= 4)
		{
			id = id + idModalidadTramite[i];
		}
	}
	return id;
}


$( document ).ready(function() {

	$("#FR_NUEVO_ITEM_PROCESO").submit(function()
	{	
		$("#DV_CARGA_2").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/ItemProceso.php',
			   data: $("#FR_NUEVO_ITEM_PROCESO").serialize(),
			   success: function(data)
			   {								   					
					if(data == 1)
					{
						if($('#HD_VALIDACION').val() == 'agregarModalidadTramite' || $('#HD_VALIDACION').val() == 'editarModalidadTramite')
						{
							borrarListado();
							cargarModalidad();	
							$('#HD_MODALIDAD_TRAMITE').val('');
						}
						if($('#HD_VALIDACION').val() == 'agregarSubdireccion')
						{
							cargarSubdireccion();	
						}					
						if($('#HD_VALIDACION').val() == 'agregarActuación')
						{
							cargarActuacion();	
						}					
						if($('#HD_VALIDACION').val() == 'agregarMotivo')
						{
							cargarMotivo();	
						}											
						if($('#HD_VALIDACION').val() == 'agregarDocumento')
						{
							cargarDocumento();	
						}											


						$("#DV_CARGA_2").html('');
						$('#MODAL_NUEVO_ITEM_PROCESO').modal('hide');	  	
					}	
					else
					{
						$("#DV_CARGA_2").html(data);
					}				
			   }
			 });		
		return false;
	});
   
});

function borrarListado()
{
		$('input[name="CB_ITEM_PANEL_NAVEGACION[]"]:checked').each(function() {		
			$(this).prop( "checked", false );
		});								
}

function editarSubdireccion(idSubdireccion)
{
	_idSubdireccion = retornarCodigo(idSubdireccion);	
	$('#EDSB' + _idSubdireccion).attr('disabled', true);  														  
	$('#TX_SUBDIRECCION' + _idSubdireccion).attr('disabled', false);  														  
	$('#SASB' + _idSubdireccion).attr('disabled', false);  														  
}

function guardarSubdireccion(idSubdireccion)
{
	_idSubdireccion = retornarCodigo(idSubdireccion);	
	_nombreSubdireccion = $('#TX_SUBDIRECCION' + _idSubdireccion).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'editarSubdireccion', idSubdireccion : _idSubdireccion, nombreSubdireccion : _nombreSubdireccion}, 
		   success: function(data)
		   {								   				
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#EDSB' + _idSubdireccion).attr('disabled', false);  														  
					$('#TX_SUBDIRECCION' + _idSubdireccion).attr('disabled', true);  														  
					$('#SASB' + _idSubdireccion).attr('disabled', true);  														  					
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });				
}

function eliminarSubdireccion(idSubdireccion)
{
	_idSubdireccion = retornarCodigo(idSubdireccion);	
	_nombreSubdireccion = $('#TX_SUBDIRECCION' + _idSubdireccion).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'eliminarSubdireccion', idSubdireccion : _idSubdireccion, nombreSubdireccion : _nombreSubdireccion}, 
		   success: function(data)
		   {								   								
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#ROSB' + _idSubdireccion).hide(1000);
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });				
}

function editarActuacion(idActuacion)
{
	_idActuacion = retornarCodigo(idActuacion);	
	$('#EDAC' + _idActuacion).attr('disabled', true);  														  
	$('#TX_ACTUACION' + _idActuacion).attr('disabled', false);  														  
	$('#SL_ACTUACION_ACCION' + _idActuacion).attr('disabled', false);  														  
	$('#SAAC' + _idActuacion).attr('disabled', false);  														  
}

function guardarActuacion(idActuacion)
{
	_idActuacion = retornarCodigo(idActuacion);	
	_nombreActuacion = $('#TX_ACTUACION' + _idActuacion).val();
	_estadoActuacion = $('#SL_ACTUACION_ACCION' + _idActuacion).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'editarActuacion', idActuacion : _idActuacion, nombreActuacion : _nombreActuacion, estadoActuacion : _estadoActuacion}, 
		   success: function(data)
		   {								   				
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#EDAC' + _idActuacion).attr('disabled', false);  														  
					$('#TX_ACTUACION' + _idActuacion).attr('disabled', true);  
					$('#SL_ACTUACION_ACCION' + _idActuacion).attr('disabled', true);  														  														  
					$('#SAAC' + _idActuacion).attr('disabled', true);  														  					
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });				
}

function eliminarActuacion(idActuacion)
{
	_idActuacion = retornarCodigo(idActuacion);	
	_nombreActuacion = $('#TX_ACTUACION' + _idActuacion).val();
	_estadoActuacion = $('#SL_ACTUACION_ACCION' + _idActuacion).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'eliminarActuacion', idActuacion : _idActuacion, nombreActuacion : _nombreActuacion, estadoActuacion : _estadoActuacion}, 
		   success: function(data)
		   {								   								
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#ROAC' + _idActuacion).hide(1000);
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });					
}

function editarMotivo(idMotivo)
{
	_idMotivo = retornarCodigo(idMotivo);	
	$('#EDMT' + _idMotivo).attr('disabled', true);  														  
	$('#TX_MOTIVO' + _idMotivo).attr('disabled', false);  														  	
	$('#SAMT' + _idMotivo).attr('disabled', false);  														  
}

function guardarMotivo(idMotivo)
{
	_idMotivo = retornarCodigo(idMotivo);	
	_nombreMotivo = $('#TX_MOTIVO' + _idMotivo).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'editarMotivo', idMotivo : _idMotivo, nombreMotivo : _nombreMotivo}, 
		   success: function(data)
		   {								   				
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#EDMT' + _idMotivo).attr('disabled', false);  														  
					$('#TX_MOTIVO' + _idMotivo).attr('disabled', true);  														  
					$('#SAMT' + _idMotivo).attr('disabled', true);  														  					
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });					
}

function eliminarMotivo(idMotivo)
{
	_idMotivo = retornarCodigo(idMotivo);	
	_nombreMotivo = $('#TX_MOTIVO' + _idMotivo).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'eliminarMotivo', idMotivo : _idMotivo, nombreMotivo : _nombreMotivo}, 
		   success: function(data)
		   {								   								
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#ROMT' + _idMotivo).hide(1000);
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });					
}

function editarDocumento(idDocumento)
{
	_idDocumento = retornarCodigo(idDocumento);	
	$('#EDDC' + _idDocumento).attr('disabled', true);  														  
	$('#TX_DOCUMENTO' + _idDocumento).attr('disabled', false);  														  
	$('#SADC' + _idDocumento).attr('disabled', false);  														  
}

function guardarDocumento(idDocumento)
{
	_idDocumento = retornarCodigo(idDocumento);	
	_nombreDocumento = $('#TX_DOCUMENTO' + _idDocumento).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'editarDocumento', idDocumento : _idDocumento, nombreDocumento : _nombreDocumento}, 
		   success: function(data)
		   {								   				
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#EDDC' + _idDocumento).attr('disabled', false);  														  
					$('#TX_DOCUMENTO' + _idDocumento).attr('disabled', true);  														  
					$('#SADC' + _idDocumento).attr('disabled', true);  														  					
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });						
}

function eliminarDocumento(idDocumento)
{
	_idDocumento = retornarCodigo(idDocumento);	
	_nombreDocumento = $('#TX_DOCUMENTO' + _idDocumento).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'eliminarDocumento', idDocumento : _idDocumento, nombreDocumento : _nombreDocumento}, 
		   success: function(data)
		   {								   								
								
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#RODC' + _idDocumento).hide(1000);
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });						
}

function editarVariableSoporte(idVariableSoporte)
{
	_idVariableSoporte = retornarCodigo(idVariableSoporte);	
	$('#EDVS' + _idVariableSoporte).attr('disabled', true);  														  	
	$('#TX_VALOR_VARIABLE_SOPORTE' + _idVariableSoporte).attr('disabled', false);  														  	
	$('#SAVS' + _idVariableSoporte).attr('disabled', false);  
}

function guardarVariableSoporte(idVariableSoporte)
{
	_idVariableSoporte = retornarCodigo(idVariableSoporte);	
	_valorVariableSoporte = $('#TX_VALOR_VARIABLE_SOPORTE' + _idVariableSoporte).val();

	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/ItemProceso.php',
		   data: {HD_VALIDACION : 'editarVariableSoporte', idVariableSoporte : _idVariableSoporte, valorVariableSoporte : _valorVariableSoporte}, 
		   success: function(data)
		   {								   				
				if(data == 1)
				{
					$("#DV_CARGA").html('');				
					$('#EDVS' + _idVariableSoporte).attr('disabled', false);  														  	
					$('#TX_VALOR_VARIABLE_SOPORTE' + _idVariableSoporte).attr('disabled', true);  														  	
					$('#SAVS' + _idVariableSoporte).attr('disabled', true);  
				}
				else
				{
					$("#DV_CARGA").html(data);
				}
		   }
		 });	
}