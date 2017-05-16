<?php
	include("../Logica/Menu.php");  
?>
       <!-- Menu Módulo -->
       <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <a href="#" class="navbar-brand">SIM</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
              <?php
                  if($_SESSION['Agregar Funcionario'] == 1 || $_SESSION['Editar Funcionario'] == 1 || $_SESSION['Eliminar Funcionario'] == 1 || $_SESSION['Editar Actividades'] == 1)
                  {
              ?>
              <li class="dropdown">
                <a href="AgregarFuncionario.php" id="themes">Funcionario</a>
              </li>
              <?php
                  }
              ?>              

              <?php
                  if($_SESSION['Creación Check-List'] == 1 || $_SESSION['Modificar Check-List'] == 1 || $_SESSION['Eliminar Check-List'] == 1 || $_SESSION['Asignar Contrato'] == 1 || $_SESSION['Modificar Asignación Contrato'] == 1 || $_SESSION['Crear Opciones De Proceso'] == 1 || $_SESSION['Modificar Opciones De Proceso'] == 1 || $_SESSION['Iniciar Proceso'] == 1 || $_SESSION['Agregar Documentos'] == 1)
                  {
              ?>                           
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Operaciones<span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="download">                  
                  <?php
                      if($_SESSION['Creación Check-List'] == 1 || $_SESSION['Modificar Check-List'] == 1 || $_SESSION['Eliminar Check-List'] == 1)
                      {
                  ?>              
                    <li><a href="CheckList.php">Check-List</a></li>
                  <?php                      
                      }
                  ?>                                  
                  
                  <li class="divider"></li>
                  
                  <?php
                      if($_SESSION['Asignar Contrato'] == 1 || $_SESSION['Modificar Asignación Contrato'] == 1)
                      {
                  ?>              
                    <li><a href="AsignacionContrato.php">Asignación de contratos</a></li>
                  <?php                      
                      }
                  ?>                                                    

                  <?php
                      if($_SESSION['Crear Opciones De Proceso'] == 1 || $_SESSION['Modificar Opciones De Proceso'] == 1)
                      {
                  ?>              
                    <li><a href="ItemProceso.php">Item's de Proceso</a></li>
                  <?php                      
                      }
                  ?>                                                                      

                  <?php
                      if($_SESSION['Agregar Documentos'] == 1)
                      {
                  ?>              
                    <li><a href="AgregarDocumentos.php">Agregar Documentos</a></li>
                  <?php                      
                      }
                  ?>                                                                                        

                  <?php
                      if($_SESSION['Iniciar Proceso'] == 1)
                      {
                  ?>              
                    <li><a href="IniciarProceso.php">Iniciar Proceso</a></li>
                  <?php                      
                      }
                  ?>        

             

                </ul>
              </li>            
              <?php
                  }
              ?>              

            <?php
                  if($_SESSION['Ver Solicitudes'] == 1 || $_SESSION['Reporte Histoial Proceso'] == 1)
                  {
              ?>
              
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Proceso <span class="caret"></span></a>
                <ul class="dropdown-menu" aria-labelledby="download">
                  
                  <?php
                      if($_SESSION['Ver Solicitudes'] == 1)
                      {
                  ?>
                      <li><a href="VerProceso.php">Ver Proceso</a></li>
                      <li class="divider"></li>
                  <?php
                      }
                  ?>                                  

                  <?php
                      if($_SESSION['Ver Solicitudes'] == 1)
                      {
                  ?>
                      <li><a href="MisProcesos.php">Mis Procesos</a></li>
                  <?php
                      }
                  ?>

                  <?php
                      if($_SESSION['Ver Solicitudes'] == 1)
                      {
                  ?>              
                    <li><a href="ListadoDocumentos.php">Listado Documentos</a></li>
                  <?php                      
                      }
                  ?>                                                                                                      

                  <?php
                      if($_SESSION['Ver Solicitudes'] == 1)
                      {
                  ?>              
                    <li><a href="VerCalendario.php">Ver Calendario</a></li>
                  <?php                      
                      }
                  ?>                                                                                                      


                  <?php
                      if($_SESSION['Reporte Histoial Proceso'] == 1)
                      {
                  ?>
                      <li><a href="VerHistorialProceso.php">Reporte Historial De Un Proceso</a></li>
                  <?php
                      }
                  ?>



                </ul>
              </li>

            <?php
                  }
              ?>

            </ul>



            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Buscar">
                </div>                
                <button type="submit" class="btn btn-default">Ir</button>
            </form>

            <ul class="nav navbar-nav navbar-right">
              <li><a href="http://www.idrd.gov.co/sitio/idrd/" target="_blank">I.D.R.D</a></li>
              <li><a href="CerrarSesion.php">Cerrar Sesión</a></li>
            </ul>

          </div>
        </div>
      </div>
      <!-- FIN Menu Módulo -->      
