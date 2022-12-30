<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="index.php?view=comisionista">Pagos a comisionista</a></li>
      <li class="active">Realizar proceso</li>
    </ol>
</section> 
</div> 


<!-- row -->  
<div class="row">

  <!-- col -->
  <div class="col-md-12">
    <?php if(isset($_GET['id']) and $_GET['id']!=""){ ?>
    <section class="tile">
      <div class="tile-header dvd dvd-btm">    
        <?php $sueldo = ComisionistaData::getById($_GET["id"]); ?>
        <h1 class="custom-font"><strong>PAGOS PARA</strong> <?php echo $sueldo->nombre; ?></h1>
        <ul class="controls">
          <li class="remove">
            <a  data-toggle="modal" data-target="#myModal"  ><i class="fa fa-plus"></i> Agregar proceso</a>
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

              <?php $debe=0; ?> 
              <?php $codebes = ProcesoData::getByComisionista($_GET['id'],$_GET['start'],$_GET['end']);
              if(@count($codebes)>0){ ?>
              <?php foreach($codebes as $codebe): $debe=($codebe->precio*$codebe->cant_noche)+$debe;  endforeach; ?>
              <?php }else{ $debe=0; }; 

              $corresponde=($sueldo->porcentaje*$debe)/100; 
              ?>



              <?php $procesos = ProcesoPagoComisionistaData::getAllSueldos($_GET['id'],$_GET['start'],$_GET['end']); 

                if(@count($procesos)>0){
                  // si hay usuarios
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">

                  <thead style="color: white; background-color: #827e7e;">
                        
                        <th>FECHA</th> 
                        <th>MONTO</th>
                        <th>TIPO DE PROCESO</th>
                        <th></th>
                  </thead>

                  <?php 
                    $pago=0;
                    
                  ?>

                   <?php foreach($procesos as $proceso):?>
                      <tr>
                        
                        <td><?php echo $proceso->fecha; ?></td>
                        <td><?php echo number_format($proceso->monto,2,'.',','); ?></td>
                        <td>PAGO </td>
                        <td>  
                         
                            <a href="index.php?view=delsueldo_comisionista&id=<?php echo $proceso->id; ?>&id_su=<?php echo $proceso->id_comisionista; ?>&start=<?php echo $_GET['start']; ?>&end=<?php echo $_GET['end']; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-trash"></i> Anular
                        </td>
                      </tr>  

                      <?php  $pago=$proceso->monto+$pago; ?>

                    <?php endforeach; ?>
                  </table>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";
                  
                    $pago=0;
                  
                 

                };
                ?>

           </div>
     
</section>
<?php }else{echo "<h2>error al cargar</h2>";} ?>
</div>
 </div>  

      <div class="modal fade bs-example-modal-xm" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addprocesosueldocomi" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-sitemap"></span> AGREGAR PAGO A COMISIONISTA</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                 
                <div class="row">
                <div class="col-md-offset-1 col-md-10">
                     

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Monto</span>
                      <input type="text" class="form-control" name="monto" onchange="this.value=this.value.replace(/\.$/, '')"  onKeyUp="if (isNaN(this.value)) this.value=this.value.replace(/[^0-9.]/g,'')" required placeholder="Ejem. 180" value="<?php echo $corresponde-($pago); ?>">
                    </div>
                  </div>

                  <input type="hidden" name="id_comisionista" value="<?php echo $_GET['id']; ?>">
                  <input type="hidden" name="pago" value="<?php echo $pago; ?>">
                  <input type="hidden" name="corresponde" value="<?php echo $corresponde; ?>">

                  <input type="hidden" name="start" value="<?php echo $_GET['start']; ?>">
                  <input type="hidden" name="end" value="<?php echo $_GET['end']; ?>">

                    
                    
                  
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