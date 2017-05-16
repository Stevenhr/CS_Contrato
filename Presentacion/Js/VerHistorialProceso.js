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

$( document ).ready(function() {

	$("#FR_BUSQUEDA_RADICADO").submit(function()
	{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/VerHistorialProceso.php',
			   data: $("#FR_BUSQUEDA_RADICADO").serialize(),
			   success: function(data)
			   {								   			   					   		
			   		if(data == 0)
			   		{
						$("#DV_INFORMACION_BUSQUEDA").html('');
			   			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> El número de radicado ingresado no se encuentra registrado en el módulo de control y seguimiento de contratos.</div>');			   	
			   		}
			   		else
			   		{
			   			$("#DV_INFORMACION_BUSQUEDA_CONTRATOS").html('');
			   			$("#DV_INFORMACION_BUSQUEDA").html(data);
			   			$("#DV_CARGA").html('');
			   		}
			   }
			 });		
		return false;
	});

	$("#FR_BUSQUEDA_ABOGADO").submit(function()
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
					   url: '../Logica/VerHistorialProceso.php',
					   data: $("#FR_BUSQUEDA_ABOGADO").serialize(),
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

	$("#FR_BUSQUEDA_SUBDIRECCION").submit(function()
	{
		if($("#TX_FECHA_INICIO_2").val() == "" || $("#TX_FECHA_FINAL_2").val() == "")
		{
			$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información Alerta</strong> Debe ingresar la fecha inicial y la fecha final.</div>');			   	
		}
		else
		{
			if($("#TX_FECHA_FINAL_2").val() > $("#TX_FECHA_INICIO_2").val())
			{
				$("#DV_INFORMACION_BUSQUEDA").html('');
				$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
				$.ajax({
					   type: "POST",
					   url: '../Logica/VerHistorialProceso.php',
					   data: $("#FR_BUSQUEDA_SUBDIRECCION").serialize(),
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

function Cargar_Funcionarios()
{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/VerHistorialProceso.php',
			   data: {HD_VALIDACION : 'cargarFuncionarios'}, 
			   success: function(data)
			   {							   		
			   		$("#DV_CARGA").html('');
			   		if(data != 0)
			   		{
						var vectorAbogado = $.parseJSON(data);
						for (var i = 0; i < vectorAbogado.length; i++)
						{ 
							 $('#SL_ABOGADO').append($('<option>', { 
							        value: vectorAbogado[i]["idPersona"],
							        text : vectorAbogado[i]["nombrePersona"] 
							    }));							
						}
			   		}			   		
			   }
			 });			
}

function Cargar_Subdireccion_Proceso()
{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/VerHistorialProceso.php',
			   data: {HD_VALIDACION : 'cargarSubdireccionesProceso'}, 
			   success: function(data)
			   {							   					   		
			   		$("#DV_CARGA").html('');
			   		if(data != 0)
			   		{
						var vectorSubdireccion = $.parseJSON(data);
						for (var i = 0; i < vectorSubdireccion.length; i++)
						{ 
							 $('#SL_SUBDIRECCION').append($('<option>', { 							       
							        text : vectorSubdireccion[i]["nombreSubdireccion"] 
							    }));							
						}
			   		}			   		
			   }
			 });			
}

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