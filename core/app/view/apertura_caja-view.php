

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





<section class="tile tile-simple col-md-4 col-md-offset-4">
      
            <div class="tile-widget dvd dvd-btm" style="text-align: center;">
              <h3 class="box-title">APERTURA INICIAL DE CAJA</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <form method="post"  action="index.php?view=agregar_caja" id="addcaja">
              <div class="tile-body p-0" style="text-align: left;">

                <table>
                  <th style="width: 50%;"></th>
                  <th style="width: 45%;"></th>
                  <tr>
                      <td><h5>FECHA APERTURA:</h5></td>
                      <td><h5 class="control-label text-red"><?php echo $hoy.' '. $hora; ?></h5></td>
                  </tr>
    
                  <tr>
                      <td><h5>MONTO APERTURA:</h5></td>
                      <td><input type="text" name="monto_apertura" onchange="this.value=this.value.replace(/\.$/, '')"  onKeyUp="if (isNaN(this.value)) this.value=this.value.replace(/[^0-9.]/g,'')" required class="form-control text-red" placeholder="Ingrese monto" style="border-color: #dd4b47;"></td>

                  </tr>
                </table>
 
              </div>

            
 
              <!-- tile footer -->
              <div class="tile-footer dvd dvd-top">

                  <div class="input-group"> 
                      <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-left">Refrescar</a>
                      <input type="hidden" name="fecha_apertura" value="<?php echo $fecha_completo; ?>">
                      <input type="hidden" name="hora" value="<?php echo $hora; ?>">
                      <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                      <?php $cajas_abiertas = CajaData::getAllAbierto(); 
                       if(@count($cajas_abiertas)>0){$caja_abierta='1';}else{$caja_abierta='0';}
                      ?>
                      <input type="hidden" name="" value="<?php echo $caja_abierta; ?>" id="caja_abierta">
                      <?php if($caja_abierta=='0'){ ?>
                      <input type="submit" class="btn btn-sm btn-success btn-flat pull-right" value="Dar apertura" >
                      <?php }; ?>
                  </div>

              </div>
              <!-- /tile footer -->

          </form>


</section>
<script>
  $("#addcaja").submit(function(e){
    caja = $("#caja_abierta").val();
     
    if(caja=="1"){
      alert("HAY UNA CAJA ABIERTA, NO PUEDES ABRIR OTRA CAJA, NECESITAS CERRARLA");
      e.preventDefault();
    }
  });
</script>




<?php $cajas = CajaData::getAllAbierto();  ?>

<!-- tile -->
                            <section class="tile  col-md-12">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>CAJAS ABIERTAS EN FECHAS DE  </strong>HOY</h1>
                                </div>
                                <!-- /tile header -->
 
                                <!-- tile body -->
                                <div class="tile-body p-0">
                                    <?php if(@count($cajas)>0){  $id_caja=$cajas->id;?>
                                     
                                    <div class="col-lg-12 col-md-12" style="padding:12px;">

                                            <ul class="list-group">
                                                <li class="list-group-item"><span class="badge bg-greensea"><?php echo $cajas->fecha_apertura; ?></span>FECHA DE APERTURA</li>
                                                <li class="list-group-item"><span class="badge bg-greensea">Q    <?php echo number_format($cajas->monto_apertura,2,'.',','); ?></span> MONTO APERTURA</li>
                                                
                                                 
                                            <?php $ingreso=0; $ingreso_efectivo=0; $ingreso_efectivo_prod=0;
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
                                            <?php if($tipo->id=='1'){ $ingreso_efectivo=($total_proceso)+$ingreso_efectivo;} ?>
                                            <?php if($tipo->id=='1'){ $ingreso_efectivo_prod=($total_venta)+$ingreso_efectivo_prod;} ?>
                                            
                                           
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
                            
                                                <li class="list-group-item"><span class="badge bg-greensea">Q     <?php echo number_format($egreso,2,'.',','); ?></span> EGRESOS</li>

                                                <li class="list-group-item"><span class="badge bg-greensea">Q     <?php echo number_format($total_otros_ingresos,2,'.',','); ?></span> OTROS INGRESOS</li>

                                                <li class="list-group-item"><span class="badge bg-greensea">$    <?php echo number_format($ingreso_efectivo,2,'.',','); ?></span> EFEC. HAB.</li>

                                                <li class="list-group-item"><span class="badge bg-greensea">Q     <?php echo number_format($ingreso_efectivo_prod,2,'.',','); ?></span> EFEC. PROD.</li>

                                                <li class="list-group-item"><span class="badge bg-greensea">Q     <?php echo number_format($ingreso_efectivo+$ingreso_efectivo_prod,2,'.',','); ?></span> VENTA EFEC.</li>

                                                <li class="list-group-item"><span class="badge bg-greensea">Q     <?php echo number_format(($ingreso_efectivo+$ingreso_efectivo_prod)-$egreso+$total_otros_ingresos+$cajas->monto_apertura,2,'.',','); ?></span> EFEC. CAJA</li>

                                                <li class="list-group-item"><span class="badge bg-greensea">Q     <?php echo number_format($ingreso-($ingreso_efectivo+$ingreso_efectivo_prod)+$total_otros_ingresos_tarjeta,2,'.',','); ?></span> VENTA TARJ.</li>

                                                <li class="list-group-item"><span class="badge bg-greensea">Q     <?php echo number_format(($ingreso-$egreso)+$total_otros_ingresos+$cajas->monto_apertura+$total_otros_ingresos_tarjeta,2,'.',','); ?></span> VENTA TOTAL</li>

                                               

                                                <li class="list-group-item"><span class="badge bg-greensea"><?php if($cajas->id_usuario!=null){echo $cajas->getUsuario()->name;}else{ echo "<center>----</center>"; }  ?></span> USUARIO RES.</li>
                                            </ul>

                                    </div>
                                        
                                   

                                    <?php }else{ ?>
                                        <div class="alert alert-danger alert-dismissible">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                          <h4><i class="icon fa fa-ban"></i> No hay ningún apertura de caja!</h4>
                                          
                                        </div>
                                     <?php }; ?>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

