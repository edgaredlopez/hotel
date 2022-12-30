  <link rel="stylesheet" href="assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/Responsive/css/dataTables.responsive.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColVis/css/dataTables.colVis.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">

<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      
        <li class="active">Lista de facturas del <b style="color: blue;"><?php echo $_POST['start'].' al '.$_POST['end'] ?></b></li>
    </ol>
</section> 
</div> 


 <!-- row --> 
<div class="row">
  <!-- col -->
  <div class="col-md-12">
    <section class="tile">
      <div class="tile-header dvd dvd-btm">  
        <h1 class="custom-font"><strong>LIBRO DE</strong> FACTURAS</h1>
        <ul class="controls">
          
         
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

               
              <?php if(isset($_POST['start']) and $_POST['end']!=""){
                $procesos = ProcesoData::getIngresoRangoFechas($_POST['start'],$_POST['end']);
              }else{
                $procesos = ProcesoData::getAll();
              } ?>

              <?php 
                if(@count($procesos)>0){
                  // si hay procesos
                  ?>
                  <div class="table-responsive">
                  <table class="table table-custom" id="editable-usage" style="font-size: 11px;">

                  <thead >
                       <th>Cod.</th>
                       <th></th> 
                        <th>Cliente</th> 
                        <th>Cliente Nombres</th> 
                        <th>Habitación</th>

                        <th>Total</th> 
                         <th>Nro folio</th>
                        <th>Hora ingreso</th>
                        <th>Hora salida</th> 
                        <th>Usuario</th>
                        <th></th>
                  </thead>
                  
                  <tbody>
                   <?php $numero=0;?>
                   <?php $total=0;?>
                   <?php foreach($procesos as $reportediario):?>
                   <?php $numero=$numero+1;?>


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
                        
                        

                        <?php if($subtotal!='0'){ ?>
                        
                        
                      <tr>
                        <td><?php echo $reportediario->id; ?></td>
                        <td></td>
                        <td><?php echo $reportediario->getCliente()->documento; ?></td>
                        <td><?php echo $reportediario->getCliente()->nombre; ?></td>

                        


                        <td><?php echo $reportediario->getHabitacion()->nombre; ?></td>
                       
                       


                         <td>$    <?php echo number_format($subtotal+$subtotal_prod,2,'.',','); ?></td>
                        <td> <?php echo $reportediario->nro_folio; ?></td>
                        <td><?php echo date($reportediario->fecha_entrada); ?></td> 
                        <td><?php echo date($reportediario->fecha_salida); ?></td>
                        <td><?php echo $reportediario->getUsuario()->name;; ?></td>
                        <td><a href="index.php?view=imprimir_f&id=<?php echo $reportediario->id; ?>"><i class="fa fa-print"></i> Comprobante</a> </td>
                      </tr> 
                      <?php }; ?>
                            <?php $total=$subtotal+$total; ?>
                    <?php endforeach; ?>

                    </tbody>

                    
                    
                  </table>
                </div>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                };
                ?>

           </div>    


</section>

</div>
</div>

      

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



