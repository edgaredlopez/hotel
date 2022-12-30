
<?php 
     date_default_timezone_set('America/Lima');
     $hoy = date("Y-m-d");
     $hora = date("H:i:s");
                    
?>



<div class="row">

 <section class="content-header">
      
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Reportes</a></li>
        <li class="active">Reporte ingresos</li>
      </ol>
</section>
</div>


<h3 >
        <span class="fa fa-file-text-o"></span> REPORTE MENSUAL
        <small>Avance</small>
      </h3>



<br>
<div class="row">

      <div  class="col-md-12">
          <div class="box box-success box-solid">
            
            <!-- /.box-header -->
            <form method="get"  action="" >
              <div class="box-body">

                <input type="hidden" name="view" value="reporte_ingreso">

              <div class="col-md-3">
                <div class="row">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon text-green"><i class="fa fa-calendar"></i> Fecha inicio</span>
                      <input type="date" name="start" class="form-control" value="<?php if(isset($_GET['start'])){ echo $_GET['start']; } ?>">
                    </div>
                  </div>
                 </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon text-green" ><i class="fa fa-calendar"></i> Fecha fin</span>
                      <input type="date" name="end" class="form-control" value="<?php if(isset($_GET['end'])){ echo $_GET['end']; } ?>">  
                    </div>
                  </div>  
              </div>

              

              <div class="col-md-2">
                  <div class="form-group">
                    <div class="input-group">
                      <button  type="submit" class="btn btn-success pull-right" ><i class='fa fa-file-pdf-o'></i> Buscar</button> 
                    </div>
                  </div> 
              </div>
                
 
              </div>

             

          </form>

          </div>
          <!-- /.box -->
      </div>

</div>


<?php if(isset($_GET['start']) and $_GET['start']!="" and isset($_GET['end']) and $_GET['end']!=""){ ?>
<section>
<div class="row">

  <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" style="background-color: #d2d6de;">
              <li class="active"><a href="#tab_1" data-toggle="tab">Lista de ingresos</a></li>
             
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <?php if(isset($_GET['start']) and $_GET['start']!="" and isset($_GET['end']) and $_GET['end']!=""){
                  $gastos = GastoData::getFiltroFechasIngreso($_GET['start'],$_GET['end']);
                }else{
                  $gastos = GastoData::getAllIngreso(); 
                } ?> 
                <?php  
                if(@count($gastos)>0){  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">

                  <thead style="color: black; background-color: #d2d6de;">
                        <th>Nº</th> 
                        <th>Descripción</th>
                        <th data-hide="phone">Precio</th>
                        <th data-hide='phone, tablet'>Fecha</th>
                        <th data-hide='phone, tablet'>Responsable</th> 

                       
                        <th></th>
                  </thead> 
                   <?php foreach($gastos as $gasto):?> 
                      <tr>
                        <td><?php echo $gasto->id; ?></td>
                        <td><b><?php echo $gasto->descripcion; ?></b></td>
                        <td><?php echo $gasto->precio; ?></td>
                        <td><?php echo $gasto->fecha; ?></td>
                        <td><?php if($gasto->id_usuario!=NULL){ echo $gasto->getUsuario()->name;}else{ echo "--------";} ?></td>
                        
                        
                        <td>
                        <a href="index.php?view=imprimir_gasto&id=<?php echo $gasto->id;?>"  class="btn btn-success btn-xs"><i class="glyphicon glyphicon-print"></i> Imprimir</a>
                        </td>
                      </tr> 
                  

                    <?php endforeach; ?>
                    </tbody>
                      <tfoot class="hide-if-no-paging">
                        <tr>
                          <td colspan="7" class="text-center">
                            <ul class="pagination"></ul>
                          </td>
                        </tr>
                      </tfoot>
                  </table>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                };
                ?>
              </div>
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

    </div>
</div>

</section>


<?php }; ?>





       
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
    
