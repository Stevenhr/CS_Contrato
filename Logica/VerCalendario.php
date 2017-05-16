<?php

$opcion = $_POST["HD_VALIDACION"];

if($opcion == 'obtenerCalendarios')
{	
	include("../Datos/ManejadorCalendario.php");
	$manejadorCalendario = new ManejadorCalendario();
	$manejadorCalendario->obtenerCalendarios();
	$calendarios = $manejadorCalendario->getCalendario();	
	$month = $_POST["HD_MES"];
	$year = $_POST["HD_ANIO"];
	
	$diaSemana = date("w", mktime(0,0,0,$month,1,$year))+7;
	$ultimoDiaMes = date("d", (mktime(0,0,0,$month+1,1,$year)-1)); 
	$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");


	$last_cell = $diaSemana + $ultimoDiaMes;
	$celdas = "";

    for($i = 1;$i <= 42; $i++)
    {
      if($i == $diaSemana)
      {
        $day=1;
      }

      if($i < $diaSemana || $i >= $last_cell)
      {       
        $celdas .= "<td>&nbsp;</td>";
      }
      else
      {  
      	 $celdas .= validarFecha($calendarios, $year, $month, $day);
         $day++;
      }

      if($i % 7 ==0)
      {
        $celdas .= "</tr><tr>\n";
      }
    }	

    $celdas .= "<script>
    				$(function () {
  						$('[data-toggle=\"tooltip\"]').tooltip()
							  })
				</script>";

	$imprimirCalendario ='<div class="table-responsive">
							<table  class="table table-hover">
								<caption>' . $meses[$month] . " " . $year . '</caption>';
	
	$imprimirCalendario .= '<tr>
    							<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
    							<th>Vie</th><th>Sab</th><th>Dom</th>
  							</tr>
								<tr bgcolor="silver">
									' . $celdas . '
								</tr>
							</table>
							</div>';	

	echo $imprimirCalendario;							
}

if($opcion == 'proximosEventosPorAbogado')
{
	session_start();
	include("../Datos/ManejadorCalendario.php");
	$manejadorCalendario = new ManejadorCalendario();
	$manejadorCalendario->proximosEventosPorAbogado($_SESSION['idPersona']);
	$calendarios = $manejadorCalendario->getCalendario();
	

}

function validarFecha($calendarios, $year, $month, $day)
{   			
      	if($day < 10)
      	{
      	  $day = "0" . $day;
      	}
	$fecha = $year. "-" . $month. "-" . $day;		
	if($calendarios != null)
	{				
		$mañana = null;
		$tarde = null;
		$fechaCierreProceso = null;		
		foreach ($calendarios as $calendario)
		{	
			
			if($fecha == $calendario->getFechaAudienciaRiesgo())
			{
		          if($calendario->getJornadaAudienciaRiesgo() == "Mañana")
		          {	          
		          	$mañana =  "<tr><td class='danger' data-toggle='tooltip' data-placement='right' title='" .  $calendario->getNombreAbogado() .  "'>Fecha de Audiencia de Riesgo - Jornada Mañana</td></tr>"; 	
		          }
		          else
		          {
		          	$tarde =  "<tr><td class='danger' data-toggle='tooltip' data-placement='right' title='" .  $calendario->getNombreAbogado() .  "'>Fecha de Audiencia de Riesgo - Jornada Tarde</td></tr>";
		          }	
		          echo "entro 1";          
		        }
			if($fecha == $calendario->getFechaAudienciaAdjudicacion())
			{
			          if($calendario->getJornadaAudienciaAdjudicacion() == "Mañana")
			          {
			          	$mañana =  "<tr><td class='danger' data-toggle='tooltip' data-placement='right' title='" .  $calendario->getNombreAbogado() .  "'>Fecha de Audiencia de Adjudicación - Jornada Mañana</td></tr>";          	
			          }
			          else
			          {
			          	$tarde =  "<tr><td class='danger' data-toggle='tooltip' data-placement='right' title='" .  $calendario->getNombreAbogado() .  "'>Fecha de Audiencia de Adjudicación - Jornada Tarde</td></tr>";          	
			          }	
			          		                           
					}
			if($fecha == $calendario->getFechaCierreProcesos())
			{				
				$fechaCierreProceso =  "<tr><td class='success' data-toggle='tooltip' data-placement='right' title='" .  $calendario->getNombreAbogado() .  "'>Fecha de Cierre de proceso</td></tr>"; 			
						                 														
			}			
			
		}	
	}
	
	if($mañana ==  null && $tarde == null)
	{		
		return "<td>$day<br><table class='table table-hover'>" . $fechaCierreProceso ."</table></td>"; 	
	}
	elseif($mañana !=  null && $tarde != null)
	{
		return "<td>$day<br><table class='table table-hover'>" . $mañana . $tarde . $fechaCierreProceso ."</table></td>";
	}
	elseif($mañana !=  null)
	{
		return "<td>$day<br><table class='table table-hover'>" . $mañana . "<tr><td class='info' data-toggle='tooltip' data-placement='right' title=''>--</td></tr>" . $fechaCierreProceso . "</table></td>";
	}
	else
	{
		return "<td>$day<br><table class='table table-hover'><tr><td class='info' data-toggle='tooltip' data-placement='right' title=''>--</td></tr>" . $tarde . $fechaCierreProceso . "</table></td>";
	}
	    
}

?>

