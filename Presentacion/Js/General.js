function Solo_Numerico(variable)
{
        Numer=parseInt(variable);
        if (isNaN(Numer))
        {
            return "";
        }
        return Numer;
}

function ValNumero(Control)
{
        Control.value=Solo_Numerico(Control.value);
}
					   
function Cargar_Tipo_Documento()
{	 	  
	  $.ajax({
		  type: 'POST',
		  url: '../Logica/General.php',
		  data: {opcion : 5},
		  success: function(data)
		  {				  
				$('#DV_TIPO_DOCUMENTO').html(data);
		  }
			  });	  		  
}	
						   					   											   
					  
function Cargar_Ciudad()
{	
	  $.ajax({
		  type: 'POST',
		  url: '../Logica/General.php',
		 data: {opcion : 7},
		  success: function(data){				  
                      $('#DV_CIUDAD').html(data);
								 }
			  });	  		                 
}						   											   					  
					  
function Cargar_Genero()
{	
	  $.ajax({
		  type: 'POST',
		  url: '../Logica/General.php',
		 data: {opcion : 8},
		  success: function(data){				  
                      $('#DV_GENERO').html(data);
								 }
			  });	  		                 
}				
					  
function Cargar_Etnia()
{	
	  $.ajax({
		  type: 'POST',
		  url: '../Logica/General.php',
		 data: {opcion : 9},
		  success: function(data){				  
                      $('#DV_ETNIA').html(data);
								 }
			  });	  		                 
}		



