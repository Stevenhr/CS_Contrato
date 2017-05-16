$('#BTN_CERRAR_VENTANA_INFORMACION').click(function()
{	  
	$('#MODAL_INFORMACION').modal('hide');
});	

$('#BTN_CERRAR_MODAL_CONFIRMACION').click(function()
{	  
	$('#MODAL_CONFIRMACION').modal('hide');
	$("#HD_ID_PROCESO").val(0);
});	

$('#BTN_CANCELAR_PROCESO').click(function()
{	  
	$('#MODAL_CONFIRMACION').modal('hide');
	$("#HD_ID_PROCESO").val(0);
});	

$('#BTN_ACTIVAR_PROCESO').click(function()
{	  
	var idSolicitud = $("#HD_ID_PROCESO").val();
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/AsignacionContrato.php',
		   data: {HD_VALIDACION : 'activarProceso', idSolicitud : idSolicitud}, 
		   success: function(data)
		   {								   								
				if(data == 1)
				{
					$("#DV_CARGA").html('');	
					$('#MODAL_CONFIRMACION').modal('hide');
					$("#HD_ID_PROCESO").val(0);
					$('#DIV_INFORMACION').html('<strong>Se ha inciado correctamente el proceso</strong>');
					$('#MODAL_INFORMACION').modal('show');					
					$('#' + idSolicitud).hide(600);
				}
				else
				{
					$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No se puede iniciar el proceso, por favor comuniquese con el área de sistemas.</div>');	
				}				
		   }
		 });		
});	


function cargarContratosAsignadosInactivos()
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/AsignacionContrato.php',
		   data: {HD_VALIDACION : 'cargarContratosAsignadosInactivos'}, 
		   success: function(data)
		   {								   								
				$("#DV_CARGA").html('');		
				$("#DV_ACTIVACION_CONTRATOS").html(data);		
		   }
		 });		
}

function iniciarProceso(idSolicitud)
{
	$("#HD_ID_PROCESO").val(idSolicitud);
	$('#MODAL_CONFIRMACION').modal('show');
}