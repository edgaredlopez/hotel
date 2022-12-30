<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="#">Configuración</a></li>
      <li class="active">Esperado</li>
    </ol>
</section> 
</div> 


<!-- row --> 
<div class="row">
  <!-- col -->
  <div class="col-md-12">
    <section class="tile">
      <div class="tile-header dvd dvd-btm">  
        <h1 class="custom-font"><strong>REGISTRO DE</strong> RESERVAS ESPERADAS</h1>
        <ul class="controls">
          <li class="remove">
            <a  data-toggle="modal" data-target="#myModal"  ><i class="fa fa-user-plus"></i> REGISTRAR NUEVA FECHA</a>
          </li>
          <li class="dropdown">
            <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
            <i class="fa fa-cog"></i><i class="fa fa-spinner fa-spin"></i>
            </a>
            <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                <li>
                  <a role="button" tabindex="0" class="tile-toggle">
                  <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                  <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                  </a>
                </li>
                <li>
                  <a role="button" tabindex="0" class="tile-refresh">
                    <i class="fa fa-refresh"></i> Refresh
                  </a>
                </li>
                <li>
                  <a role="button" tabindex="0" class="tile-fullscreen">
                  <i class="fa fa-expand"></i> Fullscreen
                  </a>
                </li>
            </ul>
          </li>
          <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
        </ul>
      </div>
      <!-- tile body -->
      <div class="tile-body">
        <div class="form-group">
          <label for="filter" style="padding-top: 5px">Buscar:</label>
          <input id="filter" type="text" class="form-control input-sm w-sm mb-12 inline-block"/>
        </div>


              <?php $esperados = EsperadoData::getAll();
                if(@count($esperados)>0){
                  // si hay usuarios
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">

                  <thead style="color: white; background-color: #827e7e;">
                        <th>Nº</th> 
                        <th>FECHA</th>
                        <th>CANTIDAD</th>
                        <th></th> 
                        <th></th>
                  </thead>
                   <?php foreach($esperados as $esperado):?> 
                      <tr>
                        <td><?php echo $esperado->id; ?></td>
                        
                        <?php
                          $mes=$esperado->mes;

                              if($mes=='01'){ $mes= 'Enero';}
                              else if($mes=='02'){ $mes= 'Febrero';}
                              else if($mes=='03'){ $mes= 'Marzo';}
                              else if($mes=='04'){ $mes= 'Abril';}
                              else if($mes=='05'){ $mes= 'Mayo';}
                              else if($mes=='06'){ $mes= 'Junio';}
                              else if($mes=='07'){ $mes= 'Julio';}
                              else if($mes=='08'){ $mes= 'Agosto';}
                              else if($mes=='09'){ $mes= 'Setiembre';}
                              else if($mes=='10'){ $mes= 'Octubre';}
                              else if($mes=='11'){ $mes= 'Noviembre';} 
                              else if($mes=='12'){ $mes= 'Diciebre';}

                          ?>

                        <td><?php echo $mes.' - '.$esperado->anio; ?></td>
                        <td><?php echo $esperado->cantidad; ?></td>
                        <td>
                        <a href=""  data-toggle="modal" data-target="#myModal<?php echo $esperado->id; ?>"  class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        </td>
                        <td>
                          <a href="index.php?view=delesperado&id=<?php echo $esperado->id; ?>"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
                        </td>
                      </tr>  


    <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $esperado->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct"  enctype="multipart/form-data" action="#" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-sitemap"></span> EDITAR ESPERADO DE RESERVA</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-12">


                   <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> MES </span>
                      <select class="form-control" name="mes">
                        <option value="00" >--- Selecciona ---</option>
                         <option value="01" >Enero</option>
                         <option value="02" >Febrero</option>
                         <option value="03" >Marzo</option>
                         <option value="04" >Abril</option>
                         <option value="05" >Mayo</option>
                         <option value="06" >Junio</option>
                         <option value="07" >Julio</option>
                         <option value="08" >Agosto</option>
                         <option value="09" >Setiembre</option>
                         <option value="10" >Octubre</option>
                         <option value="11" >Noviembre</option>
                         <option value="12" >Diciembre</option>
                       </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> AÑO </span>
                      <select class="form-control" name="anio">
                        <option value="2018">2018</option>
                        <option value="2019" selected>2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> CANTIDAD </span>
                      <input type="text" name="cantidad" class="form-control" placeholder="Ejem. 4">
                    </div>
                  </div>


                 
                    
                  
                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <input type="hidden" class="form-control" name="id_esperado" value="<?php echo $esperado->id; ?>">
                <button type="submit" class="btn btn-outline">Actualizar Datos</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

                    <?php endforeach; ?>
                  </table>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                };
                ?>

           </div>
     
</section>

</div>
 </div>  

      <div class="modal fade bs-example-modal-xm" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addesperado" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-sitemap"></span> INGRESAR NUEVA FECHA</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-12">


                   <div class="form-group"> 
                    <div class="input-group">
                      <span class="input-group-addon"> MES </span>
                      <select class="form-control" name="mes" required="">
                        <option value="" >--- Selecciona ---</option>
                         <option value="01" >Enero</option>
                         <option value="02" >Febrero</option>
                         <option value="03" >Marzo</option>
                         <option value="04" >Abril</option>
                         <option value="05" >Mayo</option>
                         <option value="06" >Junio</option>
                         <option value="07" >Julio</option>
                         <option value="08" >Agosto</option>
                         <option value="09" >Setiembre</option>
                         <option value="10" >Octubre</option>
                         <option value="11" >Noviembre</option>
                         <option value="12" >Diciembre</option>
                       </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> AÑO </span>
                      <select class="form-control" name="anio">
                        <option value="2018">2018</option>
                        <option value="2019" selected>2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                      </select>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> CANTIDAD </span>
                      <input type="text" name="cantidad" class="form-control" placeholder="Ejem. 4">
                    </div>
                  </div>

                   
                    
                   
                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-outline">Agregar Datos</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

      
        <script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>
        <script src="assets/js/vendor/jRespond/jRespond.min.js"></script>
        <script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
        <script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
        <script src="assets/js/vendor/screenfull/screenfull.min.js"></script>
        <script src="assets/js/vendor/footable/footable.all.min.js"></script>
        <script src="assets/js/main.js"></script>
         <script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>
 <script>
            $(window).load(function(){

                $('.footable').footable();

            });
</script>