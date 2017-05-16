function Cargar_Documentos_Descarga()
{
		$("#DV_CARGA").html('<img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" />');
		$.ajax({
			   type: "POST",
			   url: '../Logica/AgregarDocumentos.php',
			   data: {HD_VALIDACION : 'cargarListadoDocumentoDescarga'}, 
			   success: function(data)
			   {							   		
			   		if(data != 0)
			   		{
				   		$("#DV_CARGA").html('');
				   		$("#DV_CONTENIDO").show();
				   		$("#DV_CONTENIDO").html(data);
				   	}
				   	else
				   	{
				   		$("#DV_CARGA").html('<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Atención! </strong>No hay documentos registrados en el sistema.</div>');
				   		$("#DV_CONTENIDO").hide();
				   	}
			   }
			 });			
}

function Descarga_Documento(_Ruta_Documento)
{

	$("#HD_DESCARGA_DOCUMENTO").val(_Ruta_Documento);
	$("#FR_DESCARGA_DOCUMENTO").submit();
}