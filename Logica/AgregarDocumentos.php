<?php

$opcion = $_POST["HD_VALIDACION"];

if($opcion == 'cargarListadoDocumento')
{	
	include("../Datos/ManejadorListaDocumento.php");
	$manejadorListaDocumento = new ManejadorListaDocumento();
	$manejadorListaDocumento->cargarListadoDocumento();
	$listadoDocumentos = $manejadorListaDocumento->getListadoDocumento();

	if($listadoDocumentos != null)
	{
		$tablaFuncionario = "<div class='table-responsive'><table class='table table-bordered table-responsive'>
	    					<tr>
	    		 				<th class='col-md-8'>Nombre Documento</th>  <th class='col-md-4'>Operaciones</th>
	  						</tr>";				   
		
		foreach ($listadoDocumentos as $listadoDocumento)
		{				 
			 $tablaFuncionario .= "<tr id='". $listadoDocumento->getIdListadoDocumento() ."'>";	
			 $tablaFuncionario .= "<td><h5>" . $listadoDocumento->getNombreListadoDocumento() . "</h5></td>";	

			$tablaFuncionarioOpciones = "<div class='table-responsive'><table class='table table-bordered table-responsive'><tr>";
			//$tablaFuncionarioOpciones .= "<td><button type='button' class='editar_lista_doc btn btn-link' id='". $listadoDocumento->getIdListadoDocumento() ."' title='Editar Lista Documento' ><span class='glyphicon glyphicon-pencil'></span></button></td>";
			$tablaFuncionarioOpciones .= "<td><button type='button' class='btn btn-link'  title='Editar Lista Documento' onclick='Editar_Lista_Documento(" . $listadoDocumento->getIdListadoDocumento() . ",\"" . $listadoDocumento->getNombreListadoDocumento() . "\");'><span class='glyphicon glyphicon-pencil'></span></button></td>";
			//$tablaFuncionarioOpciones .= "<td><button type='button' class='eliminar_lista_doc btn-link' id='". $listadoDocumento->getIdListadoDocumento() ."' title='Eliminar Lista Documento'><span class='glyphicon glyphicon-remove'></span></button></td>";		
			$tablaFuncionarioOpciones .= "<td><button type='button' class='btn btn-link'  title='Eliminar Lista Documento' onclick='Eliminar_Lista_Documento(" . $listadoDocumento->getIdListadoDocumento() . ",\"" . $listadoDocumento->getRutaListadoDocumento() . "\");'><span class='glyphicon glyphicon-remove'></span></button></td>";
			$tablaFuncionarioOpciones .= "</tr></table><div>";	
			$tablaFuncionario .=  "<td>" . $tablaFuncionarioOpciones ."</td>";									 									 
			$tablaFuncionario .= "</tr>";											
		}	

		    $tablaFuncionario .= "</table></div>";

		/*	$tablaFuncionario .= "
					<script>
						$('.editar_lista_doc').click(function(){
							  var _Id_Lista_Doc = $(this).attr('id');
							  Editar_Lista_Documento(_Id_Lista_Doc);
							
												          });		 
												  
						$('.eliminar_lista_doc').click(function(){
							   var _Id_Lista_Doc = $(this).attr('id');
							   Eliminar_Lista_Documento(_Id_Lista_Doc);
												  });
						</script>
						";*/

		    echo $tablaFuncionario;	
	}
	else
	{
		echo 0;
	}
}

if($opcion == 'guardarListadoDocumento')
{	
	include("../Datos/ManejadorListaDocumento.php");	

    $_Archivo = $_FILES["TX_ARCHIVO"]['name'];
	$_Final= explode(".", $_Archivo); 
	$_Extension= end($_Final);	
	$_Destino =  "..//Presentacion/Archivo/". $_Archivo;
		
	if (copy($_FILES['TX_ARCHIVO']['tmp_name'],$_Destino))
	{			
	    $manejadorListaDocumento = new ManejadorListaDocumento();
	    if($manejadorListaDocumento->guardarListadoDocumento($_POST["TX_NOMBRE_LISTA_DOCUMENTO"], $_Destino))
	    {
	    	echo 1;
	    }
	    else
	    {
			echo 0;
	    }
	}
	else
	{
		echo "NC";
	}									  	
}

if($opcion == 'modificarListadoDocumento')
{	
	include("../Datos/ManejadorListaDocumento.php");	

	$manejadorListaDocumento = new ManejadorListaDocumento();
    if($manejadorListaDocumento->modificarListadoDocumento($_POST["HD_ID_LISTA_DOCUMENTO"], $_POST["TX_NOMBRE_LISTA_DOCUMENTO"], null))
    {
    	echo 1;
    }
    else
    {
		echo 0;
    }
}

if($opcion == 'eliminarListadoDocumento')
{	
	include("../Datos/ManejadorListaDocumento.php");	

	$manejadorListaDocumento = new ManejadorListaDocumento();
    if($manejadorListaDocumento->eliminarListadoDocumento($_POST["HD_ID_LISTA_DOCUMENTO"]))
    {
    	unlink($_POST["HD_RUTA_DOCUMENTO"]);
    	echo 1;
    }
    else
    {
		echo 0;
    }
}

if($opcion == 'cargarListadoDocumentoDescarga')
{	
	include("../Datos/ManejadorListaDocumento.php");
	$manejadorListaDocumento = new ManejadorListaDocumento();
	$manejadorListaDocumento->cargarListadoDocumento();
	$listadoDocumentos = $manejadorListaDocumento->getListadoDocumento();

	if($listadoDocumentos != null)
	{
		$tablaFuncionario = "<div class='table-responsive'><table class='table table-bordered table-responsive'>
	    					<tr>
	    		 				<th class='col-md-8'>Nombre Documento</th>  <th class='col-md-4'>Descargar</th>
	  						</tr>";				   
		
		foreach ($listadoDocumentos as $listadoDocumento)
		{				 
			 $tablaFuncionario .= "<tr id='". $listadoDocumento->getIdListadoDocumento() ."'>";	
			 $tablaFuncionario .= "<td><h5>" . $listadoDocumento->getNombreListadoDocumento() . "</h5></td>";	

			$tablaFuncionarioOpciones = "<div class='table-responsive'><table class='table table-bordered table-responsive'><tr>";
			$tablaFuncionarioOpciones .= "<td><button type='button' class='btn btn-link'  title='Editar Lista Documento' onclick='Descarga_Documento(\"" . $listadoDocumento->getRutaListadoDocumento() . "\");'><span class='glyphicon glyphicon-download-alt'></span></button></td>";
			$tablaFuncionarioOpciones .= "</tr></table><div>";	
			$tablaFuncionario .=  "<td>" . $tablaFuncionarioOpciones ."</td>";									 									 
			$tablaFuncionario .= "</tr>";											
		}	

		    $tablaFuncionario .= "</table></div>";		
		    echo $tablaFuncionario;	
	}
	else
	{
		echo 0;
	}
}

?>