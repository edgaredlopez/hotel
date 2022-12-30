
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
      <li class="active"><a href="#">Tablero mensual</a></li>
    </ol>
</section> 

</div> 
<?php 

date_default_timezone_set('America/Guatemala');
     $hoy = date("Y-m-d"); 
   $hora = date("H:i:s");
   $doce = date("12:00:00");
   $fecha_completa= date("Y-m-d H:i:s");

?>



<div id="reload-full-div">
	<div class="breadcrumb-line">
		
	  <div class="row">
		 <div class="breadcrumb col-lg-12">
				<div style="background-color: #16a085;color: white;padding: 2px;font-size: 20px;
				text-align: center; text-transform: uppercase;font-weight: bold;width: 100%;">
					<span>
					Tablero mensual</span>
			    </div>
	   	  </div>
	  </div>
	</div>
	<br> 


<!-- row --> 
<div class="row">
  <!-- col --> 
  <div class="col-md-12">
    <section class="tile">

             <div class="tile-header dvd dvd-btm">  
                <h1 class="custom-font"><strong>TABLERO MENSUAL</strong>  </h1>
                <ul class="controls">
                  <li class="remove">
                    <a  href="?view=proceso_mensual" style="color:blue;" ><i class="fa fa-user-plus"></i> AGREGAR NUEVO ALQUILER</a>
                  </li> 
                  
                  <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                </ul>
              </div>


           <div class="tile-body">
         


              <?php $procesos = ProcesoData::getAllMensual();
                if(@count($procesos)>0){ 
                  // si hay usuarios
                  ?>
                  <div class="table-responsive">
                  <table class="table table-custom" id="editable-usage" style="font-size: 11px;">

                  <thead >
                        <th>HAB.</th> 
                        <th>HUESPED DOCUMENTO</th>
                        <th>HUESPED NOMBRES</th>
                        <th>FECHA ALQUILER</th>
                        <th>FECHA RENOVAR</th>
                        <th>PRECIO MENSUAL</th>
                        <th>ACUENTA</th>
                        <th>ESTADO</th>
                        <th></th>
                        
                  </thead>
                   <?php foreach($procesos as $proceso):?>
                      <tr>
 
                        <td><?php echo $proceso->getHabitacion()->nombre; ?></td>
                        <td><?php echo $proceso->getCliente()->documento; ?></td>
                        <td><?php echo $proceso->getCliente()->nombre; ?></td>
                        <td><?php echo date($proceso->fecha_entrada); ?></td>
                        <td><?php echo date($proceso->fecha_salida); ?></td>
                        <td>Q  <?php  echo number_format($proceso->precio,2,'.',',');  ?></td>
                        <td>Q  <?php echo number_format($proceso->dinero_dejado,2,'.',',');  ?></td>
                        <td><span class="label bg-red">Pendiente</span></td>
                        <td><a href=""  data-toggle="modal" data-target="#myModal<?php echo $proceso->id; ?>"  class="btn btn-dutch btn-xs"><i class="glyphicon glyphicon-edit"></i> Renovar</a></td>
                      </tr> 

                      <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $proceso->id; ?>" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-info">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                                
                                      <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title" style="color: black;"><span class="fa fa-hotel"></span> Habitación <?php echo $proceso->getHabitacion()->nombre; ?>
                                                
                                      <?php 
                                      
                                        $fecha1 = new DateTime($proceso->fecha_entrada);//fecha inicial
                                        $fecha2 = new DateTime($fecha_completa);//fecha de cierre

                                          $horaf = $fecha1->diff($fecha2);
                                          $minutos = $fecha1->diff($fecha2);

                                          $contar_dias=$horaf->format('%d');
                                          $contar_hora=$horaf->format('%H');
                                          $contar_minutos=$horaf->format('%i');
                                          $contar_horas=$contar_hora+($contar_dias*24);
                                        ?>
                       
                                        <b style="color:red;"><?php echo '<b>Hace '.$contar_dias .'</b>Días '; ?></b>
                                        </h4>
                                                
                                      </div>
                                               
                                              <div class="modal-footer"> 
                                                <center>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                          <a  href="index.php?view=delproceso&id=<?php echo $proceso->id; ?>&id_habitacion=<?php echo $proceso->getHabitacion()->id; ?>" class="btn btn-outline btn-danger pull-left">ANULAR REGISTRO</a>
                                                          
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                          <a href="index.php?view=checkout_mensual&id=<?php echo $proceso->id; ?>" class="btn btn-outline btn-primary pull-left">RENOVAR</a>
                                                        </div>
                                                    </div>
                                                  
                                                  
                                                

                                                
                                                </center>
                                               
                                              </div>
                                           
                                            </div>
                                            <!-- /.modal-content -->
                                          </div>
                                          <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                      </div>
                    



                       

<?php endforeach; ?>
                      
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