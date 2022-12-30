
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
        <span class="fa fa-file-text-o"></span> REPORTE POR RANGO DE FECHA DE LOS RESIDENTES
        <small>Avance</small>
      </h3> 
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Reportes</a></li>
        <li class="active">Reporte Por rango</li>
       
      </ol>
      
      <ol class="breadcrumb">
        
        <li><a href="javascript:print();"  class="text-muted"><i class="fa fa-print"></i> IMPRIMIR</a></li>

        
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
                                    <h1 class="custom-font"><strong>TABLA</strong> ALQUILER</h1>
                                    
                                </div>
                                <!-- /tile header -->
 
                                <!-- tile body -->
                                <div class="tile-body">
                                    <div class="table-responsive">
                <?php $reportediarios = ProcesoData::getResidentesRangoFechas($_POST['start'],$_POST['end']);
                if(@count($reportediarios)>0){ 
                  // si hay usuarios 
                  ?>
                  <table class="table table-custom" id="editable-usage">

                  <thead >
                        <th>HAB.</th> 
                        <th>HUESPED DOCUMENTO</th>
                        <th>HUESPED NOMBRES</th>
                        <th>FECHA ALQUILER</th>
                        <th>FECHA RENOVAR</th>
                        <th>PRECIO MENSUAL</th>
                        <th>TOTAL ACUMULADO</th>
                        <th>ESTADO</th>
                        
                  </thead> 
                  <tbody >
                   <?php $numero=0;?>
                   <?php $total_hab=0; $total_prod=0; ?>
                   <?php foreach($reportediarios as $proceso):?>
                   <?php $numero=$numero+1;?>
                   <tr>
                      <td><?php echo $proceso->getHabitacion()->nombre; ?></td>
                        <td><?php echo $proceso->getCliente()->documento; ?></td>
                        <td><?php echo $proceso->getCliente()->nombre; ?></td>
                        <td><?php echo date($proceso->fecha_entrada); ?></td>
                        <td><?php echo date($proceso->fecha_salida); ?></td>
                        <td>$  <?php  echo number_format($proceso->precio,2,'.',',');  ?></td>

                        <?php $subtotal=0; ?>
                        <?php $tmps = PagoProcesoData::getAllProceso($proceso->id); 
                        foreach($tmps as $p):  ?>
                        <?php $subtotal=$subtotal+$p->monto; ?>
                        <?php endforeach; ?>
                        
                        <?php $subtotal_prod=0; ?>
                        <?php $tmps_prods = ProcesoVentaData::getByAll($proceso->id); 
                        foreach($tmps_prods as $p_prod):  ?>
                        <?php $subtotal_prod=$subtotal_prod+($p_prod->precio*$p_prod->cantidad); ?>
                        <?php endforeach; ?>

                        <td>$  <?php echo number_format($subtotal+$subtotal_prod,2,'.',',');  ?></td>
                        <td><span class="label bg-greensea">Finalizado</span></td>
                        
                        </tr>
                    <?php endforeach; ?>
                    </tbody >

                     

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

