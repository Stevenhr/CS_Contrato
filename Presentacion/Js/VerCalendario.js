$('#BTN_VER_CALENDARIO').click(function()
{	  
	if($("#SL_MES").val() == 0 || $("#SL_ANIO").val() == 0)
	{
		$("#DV_CARGA").html('<div class="alert alert-dismissible alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button> <strong>Información </strong>Debe seleccionar el mes y año que desea visualizar.</div>');
		$("#DV_CONTENIDO").html('');	
	}
	else
	{
		Cargar_Calendario($("#SL_MES").val(), $("#SL_ANIO").val());	
	}	
});														 


function Cargar_Calendario(mes, anio)
{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/VerCalendario.php',
			   data: {HD_VALIDACION : 'obtenerCalendarios', HD_MES : mes, HD_ANIO : anio}, 
			   success: function(data)
			   {							   					   						   		
				   		$("#DV_CARGA").html('');				   		
				   		$("#DV_CONTENIDO").html(data);				   	
			   }
			 });			
}