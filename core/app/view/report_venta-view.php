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
        <span class="fa fa-file-text-o"></span> REPORTE RANGO DE FECHAS: PRODUCTOS 
        <small>Avance</small>
      </h3> 
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Reportes</a></li>
        <li class="active">Reporte productos</li>
      </ol>
</section>
</div>







<br>
<div class="row">

      <div  class="col-md-4">
          <div class="box box-success box-solid">
            
            <!-- /.box-header -->
           
              <div class="box-body" style="text-align: left;">

                <table>
                  <th style="width: 50%;"></th>
                  <th style="width: 45%;"></th>
                  <tr>
                      <td><h5>FECHA INICIO:</h5></td>
                      <td><h5 class="control-label text-red"><?php echo $_POST['start']; ?></h5></td>
                  </tr>
                  <tr>
                      <td><h5>FECHA FIN:</h5></td>
                      <td><h5 class="control-label text-red"><?php echo $_POST['end']; ?></h5></td>
                  </tr>
                  <?php $producto = ProductoData::getById($_POST["id_producto"]); ?>
                  <tr>
                      <td><h5>PRODUCTO:</h5></td>
                      <td><h5 class="control-label text-red"><?php echo $producto->nombre.' '.$producto->marca; ?></h5></td>
                  </tr>
    
                </table>
  
              </div>

             

      

          </div>
          <!-- /.box -->
      </div>

</div>

<section>
<div class="row">

  <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
<section class="tile">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" style="background-color: #d2d6de;">
            
              <li class="active"><a href="#tab_2" data-toggle="tab">Venta de productos</a></li>
              
            </ul>
            <div class="tab-content ">
              
              <!-- /.tab-pane --> 
              <div class="tile-body">
                <?php $reporproducts = ProcesoVentaData::getFiltroFechasVentaProduct($_POST['start'],$_POST['end'],$_POST['id_producto']);
                if(@count($reporproducts)>0){
                  // si hay usuarios
                  ?> 
                  <div class="table-responsive">
                  <table class="table table-custom" id="editable-usage">


                  <thead >
                        <th>Nº</th> 
                        <th>Habitación</th>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Total</th>
                        <th>Hora </th> 
                        <th>Responsable </th> 
                  </thead> 
                   <?php $numero=0;?>
                   <?php $subtotal2=0;?>
                   <?php foreach($reporproducts as $reporproduct):?>
                   <?php $numero=$numero+1;?>
                   <?php if($reporproduct->fecha_creada!=NULL ){ ?>
                      <tr>
                        <td><?php echo $numero; ?></td>
                        <td><?php if($reporproduct->id_operacion!=NULL){ echo $reporproduct->getProceso()->getHabitacion()->nombre;}else{echo "Venta libre";} ?></td>
                        <td><?php echo $reporproduct->getProducto()->nombre.' '. $reporproduct->getProducto()->marca.' '. $reporproduct->getProducto()->descripcion; ?></td>
                        <td><b><?php echo $reporproduct->cantidad; ?></b></td>
                        <td><b>$    <?php echo number_format($reporproduct->precio,2,'.',','); ?></b></td>
                        <?php $subtotal1=$reporproduct->cantidad*$reporproduct->precio; ?>
                        <td><b>$    <?php echo number_format($subtotal1,2,'.',','); ?></b></td>
                        <td><?php echo date($reporproduct->fecha_creada); ?></td>
                        <td><?php echo $reporproduct->getUsuario()->name; ?></td>

                      </tr> 
                    <?php $subtotal2=$subtotal1+$subtotal2; ?>
                    <?php }; ?>
                    <?php endforeach; ?>

                    <tfoot style="color: black; background-color: #e3e4e6;">
                        <th colspan="5"><p class="pull-right">Total</p></th>
                        <th><b>$  <?php echo number_format($subtotal2,2,'.',','); ?></b> </th> 
                        <th></th>
                        <th></th>
                    </tfoot>

                  </table>
                </div>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY NINGUNA VENTA HOY </h4>";

                };
                ?>
              </div>
              <!-- /.tab-pane -->
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

    </div>
  </section>
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