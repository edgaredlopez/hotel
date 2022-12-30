
  <link rel="stylesheet" href="assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/Responsive/css/dataTables.responsive.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColVis/css/dataTables.colVis.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">

        


<?php 
     date_default_timezone_set('America/Lima');
     $hoy = date("Y-m-d");
     $hora = date("H:i:s");
                  
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
        <span class="fa fa-file-text-o"></span> REPORTE DIARIO
        <small>Avance</small>
      </h3> 
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Reportes</a></li>
        <li class="active">Reporte diario</li>
      </ol>
      
      <ol class="breadcrumb">
        
        <li><a href="javascript:print();"  class="text-muted"><i class="fa fa-print"></i> IMPRIMIR</a></li>

        <li><a href="reporteExcel/reporte_diario.php" class="text-muted"><i class="fa fa-print"></i> DESCARGAR EXCEL</a></li>
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
   <!-- /.box-header -->
            <form method="post"  action="index.php?view=agregar_caja" id="addcaja">
              <div class="box-body" style="text-align: left;">

                <table>
                  <th style="width: 50%;"></th>
                  <th style="width: 45%;"></th>
                  <tr>
                      <td><h5>FECHA:</h5></td>
                      <td><h5 class="control-label text-red"><?php echo $hoy; ?></h5></td>
                  </tr>
    
                </table>
  
              </div>

             

          </form>
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
                <?php $reportediarios = ProcesoData::getReporteDiario($hoy);
                if(@count($reportediarios)>0){ 
                  // si hay usuarios 
                  ?>
                  <table class="table table-custom" id="editable-usage">

                  <thead >
                        <th>Nº</th> 
                        <th>Cliente</th> 
                        <th>Habitación</th>
                        <!--<th>Precio tarifa</th>
                        <th>Cantidad</th>-->
                        <th>Total Hab.</th>
                        <th>Total Prod.</th>
                        <th>Total</th>

                        <th>Tipo pago</th>
                        <th>Nro folio</th>
                        <th>Hora ingreso</th>
                        <th>Hora salida</th> 
                  </thead> 
                  <?php $numero=0;?>
                   <?php $total_hab=0; $total_prod=0;?>
                   <?php foreach($reportediarios as $reportediario):?>
                   <?php $numero=$numero+1;?>
                      <tr>
                        <td><?php echo $numero; ?></td>
                        <td><?php echo $reportediario->getCliente()->documento; ?></td>
                        <td><?php echo $reportediario->getHabitacion()->nombre; ?></td>
                        <!--<td><b>$  <?php echo number_format($reportediario->precio,2,'.',','); ?></b></td>
                        <td><b>$    <?php echo number_format($reportediario->cant_noche,2,'.',','); ?></b></td>-->
                        
                        <?php $subtotal=0; ?>
                        <?php $tmps = PagoProcesoData::getAllProceso($reportediario->id); 
                        foreach($tmps as $p):  ?>
                        <?php $subtotal=$subtotal+$p->monto; ?>
                        <?php endforeach; ?>
                        
                        <?php $subtotal_prod=0; ?>
                        <?php $tmps_prods = ProcesoVentaData::getByAll($reportediario->id); 
                        foreach($tmps_prods as $p_prod):  ?>
                        <?php $subtotal_prod=$subtotal_prod+($p_prod->precio*$p_prod->cantidad); ?>
                        <?php endforeach; ?>
                        
                        <td>$   <?php echo number_format($subtotal,2,'.',','); ?></td>
                        <td>$   <?php echo number_format($subtotal_prod,2,'.',','); ?></td>
                        <td>$   <?php echo number_format($subtotal_prod+$subtotal,2,'.',','); ?></td>
                        
                        
                        <td><?php if($reportediario->id_tipo_pago=='1'){ echo "EFECTIVO";}elseif ($reportediario->id_tipo_pago=='2') {
                         echo "TARJETA";
                        }elseif ($reportediario->id_tipo_pago=='3') {
                          echo "DEPÓSITO";
                        } ?></td>
                        
                        
                        <td> <?php echo $reportediario->nro_folio; ?></td>
                        <td><?php echo date($reportediario->fecha_entrada); ?></td>
                        <td><?php echo date($reportediario->fecha_salida); ?></td>
                      </tr> 
                            <?php $total_hab+=$subtotal; ?>
                            <?php $total_prod+=$subtotal_prod; ?>
                    <?php endforeach; ?>
                    
                 
                    <tfoot style="color: black; background-color: #e3e4e6;">
                        <th colspan="3"><p class="pull-right">Total</p></th>
                        <th><b>$   <?php echo number_format($total_hab,2,'.',','); ?> </b></th> 
                        <th><b>$   <?php echo number_format($total_prod,2,'.',','); ?> </b></th>
                        <th><b>$   <?php echo number_format($total_prod+$total_hab,2,'.',','); ?> </b></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>
                  
                           

                     

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










