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
                      if($_SESSION['Creación Check-List'] == 1)
                      {
                    ?>
                    <p align="right">
                      <button type="button" class="btn btn-primary" id="BTN_AGREGAR_CHECK_LIST">
                          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar CheckList
                      </button>
                    </p>                      
                    <?php
                       }
                       else
                       {
                    ?>
                    <p align="right">
                      <button type="button" class="btn btn-primary"  disabled="disabled">
                          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Agregar CheckList
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

<div class="modal fade" id="MODAL_NUEVO_CHECK_LIST">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <form id="FR_NUEVO_CHECK_LIST" name="FR_NUEVO_CHECK_LIST" class="form-horizontal"  action="#" method="POST">
           
           <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION"  />
           <input type="hidden" name="HD_ID_CHECK_LIST" id="HD_ID_CHECK_LIST"  />
           
        <div class="modal-header">
       
          <button type="button" class="close"  id="BTN_CERRAR_VENTANA" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="LB_TITULO_MODAL"></h4>
          <br><div id="DV_CARGA_2"></div>
       
        </div>
       
        <div class="modal-body">                

           <div class="form-group">
              <label class="col-sm-2 control-label">Nombre CheckList: </label>
              <div class="col-sm-10">
                  <input type="text" name="TX_CHECK_LIST" class="form-control" id="TX_CHECK_LIST" placeholder="Nombre CheckList" maxlength="200" required />
              </div>
          </div>   

          <div id= "DV_ITEM_CHECK_LIST"></div>    
          <p align="right">
              <button type="button" class="btn btn-primary" id="BTN_ANADIR_ITEM"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></button>
          </p>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="BTN_GUARDAR__CHECK_LIST" name="BTN_GUARDAR_CHECK_LIST">Guardar</button>
          </form>
          <br><br>
          <h6>Presione en el botón  o cierre esta ventana emergente para cancelar.</h6>        
        </div>  

      </div>
    </div>
  </div>

<div class="modal fade" id="MODAL_EDITAR_CHECK_LIST">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <form id="FR_EDITAR_CHECK_LIST" name="FR_EDITAR_CHECK_LIST" class="form-horizontal"  action="#" method="POST">
           
           <input type="hidden" name="HD_VALIDACION_2" id="HD_VALIDACION_2"  />
           <input type="hidden" name="HD_ID_CHECK_LIST_2" id="HD_ID_CHECK_LIST_2"  />
           
        <div class="modal-header">
       
          <button type="button" class="close"  id="BTN_CERRAR_VENTANA_MOD" aria-hidden="true">&times;</button>
          <h4>Modificar CheckList</h4>
          <br><div id="DV_CARGA_3"></div>
       
        </div>
       
        <div class="modal-body">                
          
          <div id= "DV_ITEM_CHECK_LIST_MOD"></div>   

        </div>

        <div class="modal-footer">
          
          </form>
          <br><br>
          <h6>Cierre esta ventana emergente para cancelar.</h6>        
        </div>  

      </div>
    </div>
  </div>  

<div class="modal fade" id="MODAL_NUEVO_ITEM_CHECK_LIST">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <form id="FR_MODAL_NUEVO_ITEM_CHECK_LIST" name="FR_MODAL_NUEVO_ITEM_CHECK_LIST" class="form-horizontal"  action="#" method="POST">
           
           <input type="hidden" name="HD_VALIDACION" id="HD_VALIDACION" value="agregarItemCheckList" />
           <input type="hidden" name="HD_ID_CHECK_LIST_3" id="HD_ID_CHECK_LIST_3"  />
           
        <div class="modal-header">
       
          <button type="button" class="close"  id="BTN_CERRAR_VENTANA_NUEVO_ITEM_CHECK_LIST" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Agregar Item Check List</h4>
          <br><div id="DV_CARGA_3"></div>
       
        </div>
       
        <div class="modal-body">                

          <div class="form-group">
              <label class="col-sm-2 control-label">Nombre Item: </label>
              <div class="col-sm-10">
                  <input type="text" name="TX_NUEVO_ITEM[]" id="TX_NUEVO_ITEM[]" class="form-control" placeholder="Item" maxlength="199" required  />
              </div>
          </div>

          <div id ="DV_ITEM_NUEVO_ITEM_CHECK_LIST"></div>    
          <p align="right">
              <button type="button" class="btn btn-primary" id="BTN_ANADIR_ITEM_NUEVO_CHECK_LIST"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></button>
          </p>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >Agregar</button>
          </form>
          <br><br>
          <h6>Presione en el botón  o cierre esta ventana emergente para cancelar.</h6>        
        </div>  

      </div>
    </div>
  </div>  

<div class="modal fade" id="MODAL_INFORMACION_CHECK_LIST">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close"  id="BTN_CERRAR_VENTANA_INFORMACION_CHECK_LIST" aria-hidden="true">&times;</button>
            <strong>Información.</strong>            
        </div>

        <div class="modal-body">
              <div id="INFORMACION_CHECK_LIST"></div>
              <div id="INFORMACION_CONFIRMACION_CHECK_LIST">
                  <div class="alert alert-danger" role="alert">
                      Esta seguro de eliminar el CheckList ?
                  </div>
                  <p align="right">                      
                      <button type="button" class="btn btn-default" id="BTN_CANCELAR_ELIMINAR_ITEM">Cancelar</button>
                      <button type="button" class="btn btn-primary" id="BTN_ELIMINAR_ITEM"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  Eliminar</button>
                  </p>
              </div>
        </div>
        
        <div class="modal-footer">

        </div>

      </div>
    </div>    
</div>

  <script src="../../../Plantilla_Base/Presentacion/Js/jquery-1.10.2.min.js"></script>
  <script src="../../../Plantilla_Base/Presentacion/Js/bootstrap.min.js"></script>
  <script src="Js/bootstrap-datepicker.js"></script>
  <script src="Js/CheckList.js"></script>

  <script>
      cargarCheckList();
  </script>


</html>
