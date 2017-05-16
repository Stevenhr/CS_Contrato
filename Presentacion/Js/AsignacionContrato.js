$("#TX_FECHA_INICIO").datepicker({
		format : "yyyy/mm/dd"
});	

$("#TX_FECHA_FINAL").datepicker({
		format : "yyyy/mm/dd"
});	

$("#TX_FECHA_INICIO_2").datepicker({
		format : "yyyy/mm/dd"
});	

$("#TX_FECHA_FINAL_2").datepicker({
		format : "yyyy/mm/dd"
});	


$('#BTN_CERRAR_VENTANA_INFORMACION').click(function()
{	  
	$('#MODAL_INFORMACION').modal('hide');
});	


$('#BTN_BUSCAR_CONTRATOS').click(function()
{	  
	var fechaInicio = $('#TX_FECHA_INICIO').val();
	var fechaFinal = $('#TX_FECHA_FINAL').val();

	if(fechaInicio == "" || fechaFinal == "")
	{	
		$('#DV_CARGA').html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> Debe ingresar una fecha inicio y una final para realizar la búsqueda.</div>');
	}
	else
	{
		if(fechaInicio < fechaFinal)
		{
			cargarSolicitudContratos(fechaInicio, fechaFinal);
		}
		else
		{
			$('#DV_CARGA').html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> La fecha de inicio debe ser menor a la fecha final para poder realizar la búsqueda.</div>');
		}
	}
});	

$('#BTN_BUSCAR_CONTRATOS_2').click(function()
{	  
	var fechaInicio = $('#TX_FECHA_INICIO_2').val();
	var fechaFinal = $('#TX_FECHA_FINAL_2').val();

	if(fechaInicio == "" || fechaFinal == "")
	{	
		$('#DV_CARGA').html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> Debe ingresar una fecha inicio y una final para realizar la búsqueda.</div>');
	}
	else
	{
		if(fechaInicio < fechaFinal)
		{
			cargarSolicitudContratosAsignados(fechaInicio, fechaFinal);
		}
		else
		{
			$('#DV_CARGA').html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> La fecha de inicio debe ser menor a la fecha final para poder realizar la búsqueda.</div>');
		}
	}
});	

function cargarSolicitudContratos(fechaInicio, fechaFinal)
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/AsignacionContrato.php',
		   data: {HD_VALIDACION : 'cargarSolicitudContratos', fechaInicio : fechaInicio, fechaFinal : fechaFinal}, 
		   success: function(data)
		   {								   								
				$("#DV_CARGA").html('');		
				$("#DV_SOLICITUD_CONTRATOS").html(data);		
		   }
		 });		
}

function cargarSolicitudContratosAsignados(fechaInicio, fechaFinal)
{
	$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
	$.ajax({
		   type: "POST",
		   url: '../Logica/AsignacionContrato.php',
		   data: {HD_VALIDACION : 'cargarSolicitudContratosAsignados', fechaInicio : fechaInicio, fechaFinal : fechaFinal}, 
		   success: function(data)
		   {								   								
				$("#DV_CARGA").html('');		
				$("#DV_SOLICITUD_CONTRATOS_2").html(data);		
		   }
		 });		
}


function asignarAbogdo(idRadicado,asunto,solicitante,fecha,idAbogado, area, subdireccion)
{
	if(idAbogado == '')
	{
		$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> Debe seleccionar un abogado para su asignación.</div>');
	}
	else
	{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/AsignacionContrato.php',
			   data: {HD_VALIDACION : 'asignarAbogado', idRadicado : idRadicado, asunto : asunto, solicitante : solicitante, fecha : fecha, idAbogado : idAbogado, area : area, subdireccion : subdireccion}, 
			   success: function(data)
			   {								   													
					if(data == 1)
					{
						$('#' + idRadicado).hide(600);
						$("#DV_CARGA").html('');
						$('#DIV_INFORMACION').html('<strong>!Se ha asignado correctamente la solicitud al abogado.</strong>');
						$('#MODAL_INFORMACION').modal('show');

					}
					else
					{
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No se pudo asignar el abogado, por favor comuníquese con el área de sistemas.</div>');	
					}
			   }
			 });	
	}
}

function reasignarAbogdo(idRadicado,idAbogado)
{
	if(idAbogado == '')
	{
		$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> Debe seleccionar un abogado para su reasignación.</div>');
	}
	else
	{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/AsignacionContrato.php',
			   data: {HD_VALIDACION : 'reasignarAbogado', idRadicado : idRadicado, idAbogado : idAbogado}, 
			   success: function(data)
			   {								   																							
					if(data == 1)
					{
						$("#DV_CARGA").html('');
						$('#DIV_INFORMACION').html('<strong>!Se ha reasignado correctamente la solicitud al abogado.</strong>');
						$('#MODAL_INFORMACION').modal('show');
					}
					else
					{
						$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong> No se pudo reasignar el abogado, por favor comuníquese con el área de sistemas.</div>');	
					}
			   }
			 });	
	}
}

