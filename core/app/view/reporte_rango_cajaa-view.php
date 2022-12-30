
  <link rel="stylesheet" href="assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/Responsive/css/dataTables.responsive.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColVis/css/dataTables.colVis.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">

        


<?php 
     date_default_timezone_set('America/Guatemala');
     $hoy = date("Y-m-d");
     $hora = date("H:i:s");
 if(isset($_POST['start'])){                   
?>

<style type="text/css">
  table.dataTable thead .sorting:after {
    opacity: 0.0;
    content: "\e150";
}

table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after {
    opacity: 0.0;
}
</style>
<div class="row">

 <section class="content-header">
      <h3>
        <span class="fa fa-file-text-o"></span> REPORTE POR RANGO DE FECHA  DE CAJA
        <small>Avance</small>
      </h3> 
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Reportes</a></li>
        <li class="active">Reporte Por rango de caja</li>
      </ol>
      
      <ol class="breadcrumb">
        
        <li><a href="javascript:print();"  class="text-muted"><i class="fa fa-print"></i> IMPRIMIR</a></li>

        <li><a href="reporteExcel/reporte_caja.php?start=<?php echo $_POST['start']; ?>&end=<?php echo $_POST['end']; ?>" class="text-muted"><i class="fa fa-print"></i> DESCARGAR EXCEL</a></li>
      </ol>
</section>
</div>




<style type="text/css">
  
  .hh:hover{
    background-color: white;
  }
  .small-box-footer {
    position: relative;
    text-align: center;
    padding: 0px 0;
    color: #fff;
    color: rgba(255,255,255,0.8);
    display: block;
    z-index: 10;
    background: rgba(0,0,0,0.1);
    text-decoration: none;
}
.nav-tabs-custom>.nav-tabs>li>a {
    color: #3c8dbc;
    font-weight: bold;
    border-radius: 0 !important;
}
.nav-tabs-custom>.nav-tabs>li.active {
    border-top-color: #00a65a;
}
.h5, h5 {
    margin-top: 0px;
    margin-bottom: 0px;
}
</style>



<br>





<!-- row --> 
<div class="row">
<div class="col-md-12">
  <?php  echo 'INICIO: '.$_POST['start']; ?><br>
<?php  echo 'FINAL: '.$_POST['end']; ?>
</div> 
  <!-- col -->
  <div class="col-md-12">
 
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>TABLA</strong> </h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body --> 
                                <div class="tile-body">
                                    <div class="table-responsive">
                <?php $cajas = CajaData::getFiltroFechas($_POST['start'],$_POST['end']);
                if(@count($cajas)>0){ 
                  // si hay usuarios 
                  ?>
                  <table class="table table-custom" id="editable-usage">

                  <thead >
                        <th>USUARIO RESPONSABLE</th> 
                        <th>FECHA APERTURA</th> 
                        <th >MONTO APERTURA</th> 
                        <th>EGRESOS</th>

                        <th >OTROS INGRESOS</th>
                         <th >EFECTIVO HAB.</th>
                        <th>EFECTIVO PROD.</th>
                        <th >VENTA EFEC.</th>  
                        <th>EFEC. CAJA</th>
                        <th>VENTA TARJETA</th>
                        <th>VENTA TOTAL</th>
                        <th>FECHA CIERRE</th>
                        <th>ESTADO</th>
                  </thead> 
                   <?php $numero=0;?>
                   <?php $total=0;?>
                   <?php foreach($cajas as $caja):?>
                   <?php $numero=$numero+1;?>

                    <?php $ingreso=0; $ingreso_efectivo=0; $ingreso_efectivo_prod=0;
                                            $tipos = TipoPagoData::getAll();
                                            if(@count($tipos)>0){
                                              foreach($tipos as $tipo):?>

                                            <?php $total_proceso=0; ?>
                                            <?php $tmps = PagoProcesoData::getAllCajaTipoDocumento($caja->id,$tipo->id); 
                                            foreach($tmps as $p):  ?>
                                            <?php $total_proceso=$total_proceso+$p->monto; ?>
                                            <?php endforeach; ?>


                                            <?php $total_venta=0; ?>
                                            <?php $ventas = ProcesoVentaData::getIngresoCajaTipoDocumento($caja->id,$tipo->id); 
                                            foreach($ventas as $venta):  ?>
                                            <?php $total_venta=$total_venta+($venta->precio*$venta->cantidad); ?>
                                            <?php endforeach; ?>

                                            
                                            <?php $ingreso=($total_venta+$total_proceso)+$ingreso; ?>
                                            <?php if($tipo->id=='1'){ $ingreso_efectivo=($total_proceso)+$ingreso_efectivo;} ?>
                                            <?php if($tipo->id=='1'){ $ingreso_efectivo_prod=($total_venta)+$ingreso_efectivo_prod;} ?>
                                            
                                           
                                        <?php endforeach; ?>
                                      

                                        <?php }else{ $ingreso=0; $ingreso_efectivo=0; } ?>


                                    <?php $otros_ingresos = GastoData::getIngresoNuevoCaja($caja->id);
                                    $total_otros_ingresos=0;
                                    if(@count($otros_ingresos)>0){
                                      foreach($otros_ingresos as $otros_ingreso):
                                        $total_otros_ingresos=$otros_ingreso->precio+$total_otros_ingresos;
                                      endforeach;
                                    } 
                    ?>
                     

                    <!-- EGRESOS -->
                               
                    <?php $montos_sin_cerrar_egresos = GastoData::getEgresoCaja($caja->id);
                                    $total_sin_cerrar_egreso=0;
                                    if(@count($montos_sin_cerrar_egresos)>0){
                                      foreach($montos_sin_cerrar_egresos as $montos_sin_cerrar_egreso):
                                        $total_sin_cerrar_egreso=$montos_sin_cerrar_egreso->precio+$total_sin_cerrar_egreso;
                                      endforeach;
                                    } 
                    ?>


                              <?php  
                              
                              $reporproducts_es = ProcesoVentaData::getEgresoCaja($caja->id);
                              $subtotal4=0;
                              if(@count($reporproducts_es)>0){ ?>
                                  <?php foreach($reporproducts_es as $reporproduct_e):?>
                                      <?php $subtotal1=$reporproduct_e->cantidad*$reporproduct_e->precio; ?>
                                  <?php $subtotal4=$subtotal1+$subtotal4; ?>
                                  <?php endforeach; ?>
                              <?php }else{$subtotal4=0;} ?>
                              



                              <?php $egreso_comisions = ProcesoPagoComisionistaData::getEgresoCaja($caja->id);
                                    $total_comision=0;
                                    if(@count($egreso_comisions)>0){
                                      foreach($egreso_comisions as $egreso_comision):
                                        $total_comision=$egreso_comision->monto+$total_comision;
                                      endforeach;
                                    } 
                              ?>


                              <?php $egreso_trabajadores = ProcesoSueldoData::getSueldoCajaResumen($caja->id);
                                    $total_trabajador=0;
                                    if(@count($egreso_trabajadores)>0){
                                      foreach($egreso_trabajadores as $egreso_trabajador):
                                        $total_trabajador=$egreso_trabajador->monto+$total_trabajador;
                                      endforeach;
                                    } 
                              ?>

                            <?php $egreso=$total_trabajador+$total_comision+$subtotal4+$total_sin_cerrar_egreso; ?>

                      <tr>
                        <td><?php if($caja->id_usuario!=null){echo $caja->getUsuario()->name;}else{ echo "<center>----</center>"; }  ?></td>
                        <td><?php echo $caja->fecha_apertura; ?></td>
                        
 
                        <td>Q    <?php echo number_format($caja->monto_apertura,2,'.',','); ?></td>
                       
                       
                        <td>Q    <?php echo number_format($egreso,2,'.',','); ?></td>
                        <td>Q    <?php echo number_format($total_otros_ingresos,2,'.',','); ?></td>
                        <td>Q    <?php echo number_format($ingreso_efectivo,2,'.',','); ?></td>
                        <td>Q    <?php echo number_format($ingreso_efectivo_prod,2,'.',','); ?></td>
                        <td>Q    <?php echo number_format($ingreso_efectivo+$ingreso_efectivo_prod,2,'.',','); ?></td>
                        <td>Q    <?php echo number_format(($ingreso_efectivo+$ingreso_efectivo_prod)-$egreso+$total_otros_ingresos+$caja->monto_apertura,2,'.',','); ?> </td>
                        <td>Q    <?php echo number_format($ingreso-($ingreso_efectivo+$ingreso_efectivo_prod),2,'.',','); ?> </td>
                        <td>Q    <?php echo number_format(($ingreso-$egreso)+$total_otros_ingresos+$caja->monto_apertura,2,'.',','); ?> </td>
                        <th><?php echo $caja->fecha_cierre; ?></th>
                        <th>Cerrado</th>
                      </tr> 
                            <?php $total=$subtotal+$total; ?>
                    <?php endforeach; ?>

                    

                  </table>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                };
                ?>
                                    </div>
                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

       

</div>
</div>





</section>


<?php } ?>

     
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>
        <script>
          
            var table = $('#editable-usage').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
               
            });

        </script>

        <!--/ Page Specific Scripts -->

