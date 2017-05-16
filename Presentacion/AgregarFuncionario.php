<html lang="es">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

      <link rel="icon" href="../../../Plantilla_Base/Presentacion/Img/idrd_icon.ico">    
      <link rel="stylesheet" href="../../../Plantilla_Base/Presentacion/Css/bootstrap.min.css" media="screen">    
      <link rel="styleseet" href="../../../Plantilla_Base/Presentacion/Css/sticky-footer.css" media="screen">    
      <link rel="stylesheet" href="Css/datepicker.css" media="screen">    

      <title>MÓDULO CONTROL Y SEGUIMIENTO DE CONTRATOS.</title>
  </head>

  <style type="text/css">
    div.scroll
    {        
        height: 462px;        
        overflow-y: scroll;
    }
  </style>

  <body>
      
      <?php include("Menu.php") ?>;  
      
      <!-- Contenedor información módulo -->
      </br></br>
      <div class="container">
          <div class="page-header" id="banner">
            <div class="row">
              <div class="col-lg-8 col-md-7 col-sm-6">
                <h2><strong>MÓDULO CONTROL Y SEGUIMIENTO DE CONTRATOS.</strong></h2>
                <p class="lead"><h4>Subdirección Administrativa y financiera.</h4></p>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-6">
                 <div align="right"> 
                     <img src="../../../Plantilla_Base/Presentacion/Img/IDRD.JPG" width="50%" heigth="40%"/>
                 </div>                    
              </div>
            </div>
          </div>        
      </div>
      <!-- FIN Contenedor información módulo -->

      <!-- Contenedor panel principal -->
      <div class="container">
          <div class="panel panel-default">
                <div class="panel-body">
                    <div id="DV_CARGA"></div>                    
                    <div id="DV_CONTENIDO" class="scroll"></div>                    
                    <br><br>
                    <?php 
                      if($_SESSION['Agregar Funcionario'] == 1)
                      {
                    ?>
                    <p align="right">
                      <button type="button" class="btn btn-primary" id="BTN_AGREGAR_FUNCIONARIO">
                          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Funcionario
                      </button>
                    </p>
                    <?php
                       }
                       else
                       {
                    ?>
                    <p align="right">
                      <button type="button" class="btn btn-primary"  disabled="disabled">
                          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar Funcionario
                      </button>
                    </p>
                    <?php
                        }
                    ?>
                </div>
          </div>
      </div>        
      <!-- FIN Contenedor panel principal -->

      <footer class="footer">          
          <div class="container">
              <p>&copy; IDRD 2015</p>                
          </div>
      </footer>          
   
  </body>


  <div class="modal fade" id="MODAL_NUEVO_FUNCIONARIO">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <form id="FR_NUEVO_FUNCIONARIO" name="FR_NUEVO_FUNCIONARIO" class="form-horizontal"  action="#" method="POST">
           
           <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION"  />
           <input type="hidden" name="HD_ID_PERSONA" id="HD_ID_PERSONA"  />
           
        <div class="modal-header">
       
          <button type="button" class="close"  id="BTN_CERRAR_VENTANA" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="LB_TITULO_FUNCIONARIO">Nuevo Funcionario</h4>
          <br><div id="DV_CARGA_2"></div>
       
        </div>
       
        <div class="modal-body">                

           <div class="form-group">
              <label class="col-sm-2 control-label">Identificación: </label>
              <div class="col-sm-4">
                  <input type="text" name="TX_IDENTIFICACION" class="form-control" id="TX_IDENTIFICACION" placeholder="Identificación" maxlength="11" required onkeyUp="return ValNumero(this);"/>
              </div>
              <label class="col-sm-2 control-label">Tipo Documento: </label>
              <div class="col-sm-4" id="DV_TIPO_DOCUMENTO">

              </div> 
          </div>       
          
           <div class="form-group">
              <label class="col-sm-2 control-label">Primer Apellido: </label>
              <div class="col-sm-4">
                  <input type="text" name="TX_PRIMER_APELLIDO" class="form-control" id="TX_PRIMER_APELLIDO" placeholder="Primer Apellido" maxlength="50" required/>
              </div>
              <label class="col-sm-2 control-label">Segundo Apellido: </label>
              <div class="col-sm-4" >
                  <input type="text" name="TX_SEGUNDO_APELLIDO" class="form-control" id="TX_SEGUNDO_APELLIDO" placeholder="Segundo Apellido"  maxlength="50"/>
              </div> 
          </div>       
          
           <div class="form-group">
              <label class="col-sm-2 control-label">Primer Nombre: </label>
              <div class="col-sm-4">
                  <input type="text" name="TX_PRIMER_NOMBRE" class="form-control" id="TX_PRIMER_NOMBRE" placeholder="Primer Nombre"  maxlength="50" required/>
              </div>
              <label class="col-sm-2 control-label">Segundo Nombre: </label>
              <div class="col-sm-4">
                  <input type="text" name="TX_SEGUNDO_NOMBRE" class="form-control" id="TX_SEGUNDO_NOMBRE" placeholder="Segundo Nombre"  maxlength="50" />
              </div> 
          </div>       


           <div class="form-group">
              <label class="col-sm-2 control-label">Fecha Nacimiento: </label>
              <div class="col-sm-4">
               <input type="text" name="TX_FECHA_NACIMIENTO" class="form-control" id="TX_FECHA_NACIMIENTO" placeholder="Fecha Nacimiento" readonly required>
              </div>
              <label class="col-sm-2 control-label">Ciudad: </label>
              <div class="col-sm-4" id="DV_CIUDAD">

              </div> 
              
          </div>       


           <div class="form-group">
              <label class="col-sm-2 control-label">Genero: </label>
              <div class="col-sm-4" id="DV_GENERO">

              </div>            
              <label class="col-sm-2 control-label">Etnia: </label>
              <div class="col-sm-4" id="DV_ETNIA">

              </div> 
              
          </div> 
          
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="BTN_GUARDAR_FUNCIONARIO" name="BTN_GUARDAR_FUNCIONARIO">Guardar</button>
          </form>
          <br><br>
          <h6>Presione en el botón guardar o cierre esta ventana emergente para cancelar.</h6>        
        </div>     
      </div>
    </div>
  </div>

  <div class="modal fade" id="MODAL_CONFIRMACION_NUEVO_FUNCIONARIO">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

          <div class="modal-header">
                <button type="button" class="close"  id="BTN_CERRAR_VENTANA_CONFIRMACION" aria-hidden="true">&times;</button>
                Información...
          </div>
         
          <div class="modal-body">                
                <br><div id="INFORMACION_CONFIRMACION_NUEVO_FUNCIONARIO"></div>
          </div>

          <div class="modal-footer">

          </div>          
       </div> 
    </div>
  </div>  

  <div class="modal fade" id="MODAL_MODIFICAR_ACTIVIDADES">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

          <div class="modal-header">
                <button type="button" class="close"  id="BTN_CERRAR_MODIFICAR_ACTIVIDADES" aria-hidden="true">&times;</button>
                Edición de actividades...                
                <input type="hidden" name="HD_ID_PERSONA_ACTIVIDADES" id="HD_ID_PERSONA_ACTIVIDADES"  />
                <br><div id="DV_CARGA_3"></div>
          </div>
         
          <div class="modal-body">                
                <br><div id="OPCIONES_MODIFICAR_ACTIVIDADES"></div>
          </div>

          <div class="modal-footer">

          </div>          
       </div> 
    </div>
  </div>    

  <script src="../../../Plantilla_Base/Presentacion/Js/jquery-1.10.2.min.js"></script>
  <script src="../../../Plantilla_Base/Presentacion/Js/bootstrap.min.js"></script>
  <script src="Js/bootstrap-datepicker.js"></script>
  <script src="Js/General.js"></script>
  <script src="Js/AgregarFuncionario.js"></script>

  <script>
         Cargar_Tipo_Documento();
         Cargar_Ciudad();
         Cargar_Genero();
         Cargar_Etnia();
         Cargar_Funcionarios();
  </script>


</html>
