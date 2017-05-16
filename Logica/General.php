<?php

include("../Datos/Query.php");
$opcion = $_POST["opcion"];

if($opcion == 5)
{
	Cargar_Tipo_Documento();
}
if($opcion == 7)
{
	Cargar_Ciudad();
}
if($opcion == 8)
{
	Cargar_Genero();
}
if($opcion == 9)
{
	Cargar_Etnia();
}

function Cargar_Tipo_Documento()
{	
	$db = new Query('Apoyo');	
	$Restuldao = $db->RunSP('SP_Obtener_Tipo_Documento', SELECT, array()); 		
	$_Localidad = "<select name='SL_TIPO_DOCUMENTO' id='SL_TIPO_DOCUMENTO' class='form-control' required>";	   		
   	for($i = 0; $i < count($Restuldao); $i++)
   	{
	    $_Localidad .= "<option value=" . $Restuldao[$i]["Id_TipoDocumento"] . ">" . $Restuldao[$i]["Nombre_TipoDocumento"]. "</optiopn>";
	}	
	$_Localidad .= "</select>";
	echo $_Localidad;												
}							 			   						 

function Cargar_Ciudad()
{	
	$db = new Query('Apoyo');	
	$Restuldao = $db->RunSP('SP_Obtener_Ciudad', SELECT, array(41)); 		
	$_Localidad = "<select name='SL_CIUDAD' id='SL_CIUDAD' class='form-control' required>";	   	
   	for($i = 0; $i < count($Restuldao); $i++)
   	{
	    $_Localidad .= "<option>" . $Restuldao[$i]["Nombre_Ciudad"] . "</optiopn>";
	}	
	$_Localidad .= "</select>";
	echo $_Localidad;												
}	

function Cargar_Genero()
{
	$db = new Query('Apoyo');		
	$Restuldao = $db->RunSP('SP_Obtener_Genero', SELECT, array()); 	
	$_Localidad = "<select name='SL_GENERO' id='SL_GENERO' class='form-control' required>";	   		
   	for($i = 0; $i < count($Restuldao); $i++)
   	{
	    $_Localidad .= "<option value=" . $Restuldao[$i]["Id_Genero"] . ">" . $Restuldao[$i]["Nombre_Genero"] . "</optiopn>";
	}	
	$_Localidad .= "</select>";
	echo $_Localidad;												 
}

function Cargar_Etnia()
{
	$db = new Query('Apoyo');			
	$Restuldao = $db->RunSP('SP_Obtener_Etnia', SELECT, array()); 	
	$_Localidad = "<select name='SL_ETNIA' id='SL_ETNIA' class='form-control' required>";	   		
   	for($i = 0; $i < count($Restuldao); $i++)
   	{
	    $_Localidad .= "<option value=" . $Restuldao[$i]["Id_Etnia"] . ">" . $Restuldao[$i]["Nombre_Etnia"] . "</optiopn>";
	}	
	$_Localidad .= "</select>";
	echo $_Localidad;												 
}	


?>