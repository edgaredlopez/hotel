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
   $doce = date("12:00:00");

  
?>
 
<?php
setlocale(LC_TIME, 'es_CO.UTF-8');
?>
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=recepcion"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="#">Reservas</a></li>
      <li>
            <a  href="index.php?view=reservap"  ><i class="fa fa-plus"></i> AGREGAR RESERVA</a>
    </li> 
    </ol>
</section> 
</div> 

 <!-- row -->  
<div class="row">
  <!-- col -->
  <div class="col-md-12">
    <section class="tile">
      <div class="tile-header dvd dvd-btm">  
        <h1 class="custom-font"><strong>LISTADO DE</strong> RESERVAS</h1>
        <ul class="controls">
          <li class="remove">
            <a  href="index.php?view=reservap"  ><i class="fa fa-user-plus"></i> AGREGAR RESERVA</a>
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
        
        <?php 
          $reservas = ReservapData::getAll($hoy);  
        ?>
        <?php   
        if(@count($reservas)>0){  ?>
        <div class="table-responsive">
        <table class="table table-custom" id="editable-usage" style="font-size: 11px;">
            <thead >
                <tr>
                  <th>Nº</th> 
                  <th>Habitación</th>
                  <th data-hide="phone">Fecha reserva</th>
                  <th data-hide='phone, tablet'>Hora reserva</th>
                  <th data-hide='phone, tablet'>Día</th>
                  <th data-hide='phone, tablet'>Servicio</th> 
                  <th data-hide='phone, tablet'>Recepcionista</th> 
                  
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                
                </tr>
              </thead>
              <tbody>
                <?php foreach($reservas as $reserva):?> 
                      <tr>
                        <td><?php echo $reserva->id; ?></td>
                        <td><b><?php echo $reserva->getHabitacion()->nombre; ?></b></td>
                        <td><?php echo date("d/m/Y", strtotime($reserva->fecha_entrada)); ?></td>
                        <td><?php echo date("H:i", strtotime($reserva->fecha_entrada)); ?></td>
                        <td><?php echo strftime("%A", strtotime($reserva->fecha_entrada)); ?></td>
                        <td><b><?php echo $reserva->getServicio()->nombre; ?></b></td>
                        <td><b><?php echo $reserva->getUsuario()->name; ?></b></td>
                        <td>
                        <a href=""  data-toggle="modal" data-target="#lista<?php echo $reserva->id; ?>" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-tasks"></i> </a>
                        </td>
                        <td>
                        <a href="index.php?view=editreservap&id=<?php echo $reserva->id;?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> </a>
                        </td>
                        <td>
                        <a href="index.php?view=imprimir_reserva&id=<?php echo $reserva->id;?>" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-print"></i> </a>
                        </td>
                        <td>
                        <a href="index.php?view=delreservap&id=<?php echo $reserva->id;?>"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> </a>
                        </td>
                        
                       
                      </tr> 
                      
                      
    <div class="modal fade bs-example-modal-xm" id="lista<?php echo $reserva->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="glyphicon glyphicon-tasks"></span> DETALLES DE RESERVA</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> CLIENTE: &nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-7" name="nombre" value="<?php echo $reserva->getPersona()->nombre; ?>" disabled >
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> PRECIO: &nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-7" name="nombre" value="$   <?php echo number_format($reserva->total,2,'.',','); ?> " disabled >
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> ACUENTA: </span>
                      <input type="text" class="form-control col-md-7" name="nombre" value="$   <?php echo number_format($reserva->acuenta,2,'.',','); ?>" disabled >
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> DEBE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-7" name="nombre" value="$   <?php echo number_format($reserva->total-$reserva->acuenta,2,'.',','); ?>" disabled >
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> TELÉFONO: </span>
                      <input type="text" class="form-control col-md-7" name="nombre" value="<?php echo $reserva->getPersona()->estado_civil; ?>" disabled >
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> NOTA: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <textarea class="form-control col-md-7" disabled ><?php echo $reserva->getPersona()->motivo; ?></textarea>
                    </div>
                  </div>


                  
                </div>
                </div>

              </div> 
              <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-danger pull-left" data-dismiss="modal">Cerrar </button>
                
              </div>
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
                  
 


                    <?php endforeach; ?>
                    </tbody>
                      
                  </table>
                </div>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                };
                ?>



                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->





       
       
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



