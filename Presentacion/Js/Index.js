$(function()
{	


});	

function validarUsuario(idPersona)
{		
	$("#Contenido").html('<center><img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" /></center>')
	$.ajax({
			   type: "POST",
			   url: "../Logica/Index.php",
			   data: {opcion : 1, idPersona : idPersona},
			   success: function(data)
			   {					
					if(data == 0)
					{						 
						 alert("Se debe cerrar la ventana.");
					}
					else
					{
						var datoPersona = $.parseJSON(data);
						$("#Contenido").html('<center><h3>BIENVENIDO(A) ' + datoPersona.Primer_Nombre + ' ' + datoPersona.Primer_Apellido  +  '</h3></center>');						
					}										
			   }
			});
}

function proximosEventosPorAbogado(idPersona)
{		
	$("#Noticia").html('<center><img src="../../../Plantilla_Base/Presentacion/Img/loading.gif" /></center>')
	$.ajax({
			   type: "POST",
			   url: "../Logica/Index.php",
			   data: {opcion : 'proximosEventosPorAbogado', idPersona : idPersona},
			   success: function(data)
			   {					
					$("#Noticia").html(data);									   
			   }
			});
}
