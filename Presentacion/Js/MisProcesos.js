$("#TX_FECHA_INICIO").datepicker({
		format : "yyyy/mm/dd"
});	

$("#TX_FECHA_FINAL").datepicker({
		format : "yyyy/mm/dd"
});


$( document ).ready(function() {

	$("#FR_BUSQUEDA_ABOGADO_PER").submit(function()
	{
		if($("#TX_FECHA_INICIO").val() == "" || $("#TX_FECHA_FINAL").val() == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> Debe ingresar la fecha inicial y la fecha final.</div>');			   	
		}
		else
		{
			if($("#TX_FECHA_FINAL").val() > $("#TX_FECHA_INICIO").val())
			{
				$("#DV_INFORMACION_BUSQUEDA").html('');
				$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
				$.ajax({
					   type: "POST",
					   url: '../Logica/MisProcesos.php',
					   data: $("#FR_BUSQUEDA_ABOGADO_PER").serialize(),
					   success: function(data)
					   {								   			   					   					   		
					   		if(data == 0)
					   		{
								$("#DV_INFORMACION_BUSQUEDA_CONTRATOS").html('');
					   			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> No existen procesos para esta fecha.</div>');			   	
					   		}
					   		else
					   		{
					   			$("#DV_INFORMACION_BUSQUEDA_CONTRATOS").html(data);
					   			$("#DV_CARGA").html('');
					   		}
					   }
					 });		
			}
			else
			{
				$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> La fecha final debe ser mayor a la fecha inicial.</div>');			   	
			}
		}

		return false;
	});	

});	

function ver_proceso_historial_2(idRadicado)
{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/VerHistorialProceso.php',
			   data: {HD_VALIDACION : 'busquedaNumeroRadicado', TX_RADICADO : idRadicado},
			   success: function(data)
			   {								   			   					   		
			   		if(data == 0)
			   		{
						$("#DV_INFORMACION_BUSQUEDA").html('');
			   			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> El número de radicado ingresado no se encuentra registrado en el módulo de control y seguimiento de contratos.</div>');			   	
			   		}
			   		else
			   		{
			   			$("#DV_INFORMACION_BUSQUEDA").html(data);
			   			$("#DV_CARGA").html('');
			   		}
			   }
			 });		


}