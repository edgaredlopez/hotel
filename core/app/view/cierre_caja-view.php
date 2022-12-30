<link rel="stylesheet" href="assets/js/vendor/datatables/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="assets/js/vendor/datatables/datatables.bootstrap.min.css">
<link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
<link rel="stylesheet" href="assets/js/vendor/datatables/extensions/Responsive/css/dataTables.responsive.css">
<link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColVis/css/dataTables.colVis.min.css">
<link rel="stylesheet" href="assets/js/vendor/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">

<?php 
     date_default_timezone_set('America/Guatemala');
     $hoy = date("Y-m-d");
     $u=null;
                $u = UserData::getById(Session::getUID());
                $usuario = $u->is_admin;
                $id_usuario = $u->id;

   $hora = date("H:i:s");
  $fecha_completo = date("Y-m-d H:i:s");   
             
?>
 
<?php $caja_abierta = CajaData::getCierreCaja(); ?>
<section class="tile tile-simple col-md-4 col-md-offset-4">
            <?php if(@count($caja_abierta)>0){  $id_caja=$caja_abierta->id;?>
            <div class="tile-widget dvd dvd-btm" style="text-align: center;">
              <h3 class="box-title">CIERRE DE CAJA</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <form method="post"  action="index.php?view=addcierre_caja">
              <div class="tile-body p-0" style="text-align: left;">

                <table>
                  <th style="width: 50%;"></th>
                  <th style="width: 45%;"></th>
                  <tr>
                      <td><h5>FECHA CIERRE:</h5></td>
                      <td><h5 class="control-label text-red"><?php echo $hoy.' '. $hora; ?></h5></td>
                  </tr>

                  

                   <!-- INGRESOS -->

                                            <?php $ingreso=0; $ingreso_efectivo=0;
                                            $tipos = TipoPagoData::getAll();
                                            if(@count($tipos)>0){
                                              foreach($tipos as $tipo):?>

                                            <?php $total_proceso=0; ?>
                                            <?php $tmps = PagoProcesoData::getAllCajaTipoDocumento($id_caja,$tipo->id); 
                                            foreach($tmps as $p):  ?>
                                            <?php $total_proceso=$total_proceso+$p->monto; ?>
                                            <?php endforeach; ?>


                                            <?php $total_venta=0; ?>
                                            <?php $ventas = ProcesoVentaData::getIngresoCajaTipoDocumento($id_caja,$tipo->id); 
                                            foreach($ventas as $venta):  ?>
                                            <?php $total_venta=$total_venta+($venta->precio*$venta->cantidad); ?>
                                            <?php endforeach; ?>

                                            
                                            <?php $ingreso=($total_venta+$total_proceso)+$ingreso; ?>
                                            
                                           
                                        <?php endforeach; ?>
                                      

                                        <?php }else{ $ingreso=0; $ingreso_efectivo=0; } ?>
    
                                
                                <?php $otros_ingresos = GastoData::getIngresoNuevoCaja($id_caja);
                                    $total_otros_ingresos=0;
                                    $total_otros_ingresos_tarjeta=0;
                                    if(@count($otros_ingresos)>0){
                                      foreach($otros_ingresos as $otros_ingreso):
                                         if($otros_ingreso->id_tipopago=='1'){
                                            $total_otros_ingresos=$otros_ingreso->precio+$total_otros_ingresos;
                                         }else
                                         {
                                            $total_otros_ingresos_tarjeta=$otros_ingreso->precio+$total_otros_ingresos_tarjeta; 
                                         }
                                        
                                      endforeach;
                                    } ?>
                                    
                                
                     

                    <!-- EGRESOS -->
                               
                    <?php $montos_sin_cerrar_egresos = GastoData::getEgresoCaja($id_caja);
                                    $total_sin_cerrar_egreso=0;
                                    if(@count($montos_sin_cerrar_egresos)>0){
                                      foreach($montos_sin_cerrar_egresos as $montos_sin_cerrar_egreso):
                                        $total_sin_cerrar_egreso=$montos_sin_cerrar_egreso->precio+$total_sin_cerrar_egreso;
                                      endforeach;
                                    } 
                    ?>


                              <?php  
                              
                              $reporproducts_es = ProcesoVentaData::getEgresoCaja($id_caja);
                              $subtotal4=0;
                              if(@count($reporproducts_es)>0){ ?>
                                  <?php foreach($reporproducts_es as $reporproduct_e):?>
                                      <?php $subtotal1=$reporproduct_e->cantidad*$reporproduct_e->precio; ?>
                                  <?php $subtotal4=$subtotal1+$subtotal4; ?>
                                  <?php endforeach; ?>
                              <?php }else{$subtotal4=0;} ?>
                              



                              <?php $egreso_comisions = ProcesoPagoComisionistaData::getEgresoCaja($id_caja);
                                    $total_comision=0;
                                    if(@count($egreso_comisions)>0){
                                      foreach($egreso_comisions as $egreso_comision):
                                        $total_comision=$egreso_comision->monto+$total_comision;
                                      endforeach;
                                    } 
                              ?>


                              <?php $egreso_trabajadores = ProcesoSueldoData::getSueldoCajaResumen($id_caja);
                                    $total_trabajador=0;
                                    if(@count($egreso_trabajadores)>0){
                                      foreach($egreso_trabajadores as $egreso_trabajador):
                                        $total_trabajador=$egreso_trabajador->monto+$total_trabajador;
                                      endforeach;
                                    } 
                              ?>

                            <?php $egreso=$total_trabajador+$total_comision+$subtotal4+$total_sin_cerrar_egreso; ?>
                  <tr>
                      <td><h5>MONTO CIERRE: Q    </h5></td>
                      <td>
                        <input type="text" name="monto_apertura" required class="form-control text-red" placeholder="Ingrese monto" style="border-color: #dd4b47;" onchange="this.value=this.value.replace(/\.$/, '')"  onKeyUp="if (isNaN(this.value)) this.value=this.value.replace(/[^0-9.]/g,'')" value="<?php echo number_format($total=($caja_abierta->monto_apertura+$ingreso+$total_otros_ingresos_tarjeta+$total_otros_ingresos)-$egreso,2,'.',','); ?>">
                      </td>
                  </tr>
                </table>
 
              </div>

            

              <!-- tile footer -->
              <div class="tile-footer dvd dvd-top">

                  <div class="input-group">
                      <input type="hidden" name="fecha_apertura" value="<?php echo $caja_abierta->fecha_apertura; ?>">
                      <input type="hidden" name="fecha_cierre" value="<?php echo $fecha_completo; ?>">
                      <input type="hidden" name="monto_apertura" value="<?php echo $caja_abierta->monto_apertura; ?>">
                      <input type="hidden" name="monto_cierre" value="<?php echo ($total_sin_cerrar+$subtotal3)-$total_sin_cerrar_egreso; ?>">
                      <input type="hidden" name="id_caja" value="<?php echo $caja_abierta->id; ?>">
                      <?php if($_SESSION['user_id']==$caja_abierta->id_usuario){ ?>
                      <input type="submit" class="btn btn-sm btn-warning btn-flat pull-right" value="Cerrar caja" >
                      <?php }else{ echo "<h2>No tienes acceso a cerra la caja</h2>";} ?>
                  </div>

              </div>
              <!-- /tile footer -->

          </form>
          <?php }else{ ?>
            <div class="box-header with-border" style="text-align: center;">
              <h3 class="box-title">NO HAY NINGÚN CAJA QUE CERRAR</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
          
              <div class="box-body" style="text-align: left;">

                
 
              </div> 
          <?php }; ?>


</section>


 

<?php $cajas = CajaData::getAll(); ?>



<!-- row --> 
<div class="row">
  <!-- col -->
  <div class="col-md-12">
 
                            <section class="tile">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>LISTA DE CAJAS </strong> (ABIERTAS Y CERRADAS)</h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <?php if(@count($cajas)>0){?>
                                          <table  class="table table-custom" id="editable-usage" style="font-size: 12px;">
                                            <thead >
                                              <th>USUARIO APERTURA</th>
                                              <th>FECHA APERTURA</th>
                                              <th>MONTO APERTURA</th>
                                              <th>FECHA CIERRE</th>
                                              <th>MONTO CIERRE</th>
                                              <th>ESTADO CAJA</th>
                                              <th>VOLVER A IMPRIMIR</th>
                                            </thead>
                                            
                                           <?php foreach($cajas as $caja):?>
                                          <tr>
                                            <td><?php if($caja->id_usuario!=null){echo $caja->getUsuario()->name;}else{ echo "<center>----</center>"; }  ?></td>
                                            <td><?php echo $caja->fecha_apertura; ?></td>
                                            <td>     <?php echo number_format($caja->monto_apertura,2,'.',','); ?></td>


                                            <td><?php echo $caja->fecha_cierre; ?></td>



                                            <?php $ingreso=0; $ingreso_efectivo=0;
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
                                                                        
                                                                       
                                                                    <?php endforeach; ?>
                                                                  

                                                                    <?php }else{ $ingreso=0; $ingreso_efectivo=0; } ?>




                                                    <?php $otros_ingresos01 = GastoData::getIngresoNuevoCaja($caja->id);
                                                    $total_otros_ingresos01=0;
                                                    $total_otros_ingresos_tarjeta=0;
                                                    if(@count($otros_ingresos01)>0){
                                                      foreach($otros_ingresos01 as $otros_ingreso0):
                                                         if($otros_ingreso0->id_tipopago=='1'){
                                                            $total_otros_ingresos01=$otros_ingreso0->precio+$total_otros_ingresos01;
                                                         }else
                                                         {
                                                            $total_otros_ingresos_tarjeta=$otros_ingreso0->precio+$total_otros_ingresos_tarjeta; 
                                                         }
                                                        
                                                      endforeach;
                                                    } ?>
                                    
                                    
                                                   

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

                                                <!-- LO QUE QUEDA -->


                                            <td><?php if($caja->estado==1){ echo '     '.number_format($caja->monto_apertura+$ingreso-$egreso+$total_otros_ingresos01,2,'.',',');} 
                                              else {echo '    '.number_format($caja->monto_apertura+$ingreso-$egreso+$total_otros_ingresos01+$total_otros_ingresos_tarjeta,2,'.',',');} ?>
                                            </td>

                                            <td><?php if($caja->estado==1){ echo "<label class='text-danger'>ABIERTO</label>"; }
                                            else {echo "<label class='text-success'>CERRADO</label>";} ?></td>
                                            <?php if($caja->estado==1){ ?>
                                            <td><label class="form-label text-danger">[RE-IMPRIMIR]</label></td>
                                            <?php } else{?>
                                            <td><a href="reporte/pdf/documentos/reporte_caja.php?id=<?php echo $caja->id; ?>" target="_blank"><label class="form-label text-success">[RE-IMPRIMIR]</label></a></td>
                                            <?php }; ?>
                                          </tr>
                                  
                                           <?php endforeach;?>

                                       </table>

                                       <?php }else{ ?>
                                          <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-ban"></i> No hay ningún apertura de caja!</h4>
                                            
                                          </div>
                                       <?php }; ?>
                                    </div>
                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

       

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



