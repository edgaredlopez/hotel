
<style type="text/css">
.nuevo {
    margin-top: 20px !important;
    margin-bottom: 20px !important;
}
.b-r {
    border-right: 2px solid rgba(0, 0, 0, 0.11) !important;
}
.table-bordered{
    font-size: 11px !important;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 2px !important;
}
</style>


<?php 
$clientes = PersonaData::getAll();
date_default_timezone_set('America/Lima');
$hoy = date("Y-m-d"); 
$hora = date("H:i:s");

if(isset($_GET['id'])){
$habitacion = ProcesoData::getById($_GET['id']);
if(@count($habitacion)>0){ ?>
<div class="row" >
    <br>
    <div class="col-md-12">
    <!-- tile -->
        <section class="tile">

            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
                <h1 class="custom-font"><strong>Habitación # <?php echo $habitacion->getHabitacion()->nombre; ?></strong></h1>
                <ul class="controls">
                    <li><a role="button" tabindex="0" style="color:#f0ad4e;">
                        <i class="glyphicon glyphicon-arrow-down"></i> <b><?php echo $habitacion->fecha_entrada; ?></b></a></li>
                    <li><a role="button" tabindex="0" style="color:#f0ad4e;">
                        <i class="glyphicon glyphicon-arrow-up"></i> <b><?php echo $habitacion->fecha_salida; ?></b></a></li>
                    <li><a href="reporte/ticket.php?id=<?php echo $habitacion->id; ?>" target="_blanck" role="button" tabindex="0" style="color:#16a085;"><i class="fa fa-print"></i></a></li>
                    <li class="remove"><a role="button" tabindex="0" class="tile-close" style="color: #e05d6f;"><i class="fa fa-times"></i></a></li>
                </ul>
            </div>
            <!-- /tile header -->

            <!-- tile body -->
            <div class="tile-body p-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-7 b-r">
                            
                            <!-- SERVICIO DE HABITACIÓN -->
                            <div class="nuevo">
                                <div class="p-10 mb-10 event-control b-l b-2x b-greensea">
                                    Código: <b>00<?php echo $_GET['id']; ?></b>
                                    <a class="pull-right text-muted"><i class="fa fa-check"></i></a>
                                </div>
                                <div class="p-10 mb-10 event-control b-l b-2x b-greensea">
                                    Cliente: <b><a href="#"  data-toggle="modal" data-target="#mostrar_cliente" style="color: blue;"><?php echo $habitacion->getCliente()->nombre; ?></a></b>
                                    <a class="pull-right text-muted"><i class="fa fa-check"></i></a>
                                </div>
                            </div>

                            <h5 style="text-decoration: underline;">Detalle de estancia</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Acción</th>
                                    <th>Fecha Ocup.</th>
                                    <th>Descripción</th>
                                    <th>Cant. Noches</th>
                                    <th>Nro Habi.</th>
                                    <th><b class="pull-right">Precio</b></th>
                                    <th></th>
                                </tr>
                                </thead> 
                                <tbody>
                                
                                <?php $sumatoria_s=0; ?> 
                                  <?php $tmps = PagoProcesoData::getAllProcesoExtenderMensual($habitacion->id); 
                                  foreach($tmps as $p):  ?>
                                        <tr>
                                          
                                          <td><?php if($p->fecha_entrada!='NULL' and $p->fecha_entrada!=NULL){ ?><a href="#"  data-toggle="modal" data-target="#confirmare<?php echo $p->id; ?>" data-options="splash-2 splash-ef-11" class="tex-danger btn-xs b-0" style="color:#e05d6f;"><i class="glyphicon glyphicon-trash"></i></a>
                                          <?php }else{ ?>
                                          <?php }; ?>
                                          </td>
                                          <td><?php echo $p->fecha_entrada; ?></td>
                                          <td><?php echo $habitacion->getTarifa()->nombre; ?></td>
                                          <td><?php echo $p->cantidad; ?></td>
                                          <td><?php echo $habitacion->getHabitacion()->nombre; ?></td>
                                          <td><b class="pull-right">$   <?php echo number_format($p->monto,2,'.',','); ?></b></td>
                                          <td><?php if($p->pagado==1){ ?><span class="check-toggler checked toggle-class" data-toggle="checked"></span><?php }else{ ?>
                                            <span class="check-toggler toggle-class" data-toggle="checked"></span>
                                        <?php }; ?></td>
                                        </tr> 
                                        <!-- Modal -->
                                        <div class="modal fade bs-example-modal-lg" id="confirmare<?php echo $p->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog modal-sm" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header"> 
                                                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-alert"></i> ALERTA!!</h4>
                                                </div>
                                                 <div class="modal-body"> 
                                                    ¿Estás seguro de eliminar?
                                                 </div>
                                                 <div class="modal-footer">
                                                    <a href="index.php?view=delestadiap_mensual&id=<?php echo $p->id; ?>&id_p=<?php echo $_GET['id']; ?>" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Eliminar</a>
                                                    <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancelar</button>
                                                 </div>
                                              </div>
                                          </div>
                                        </div>
                                        <!-- /.Modal -->
                                        <?php $sumatoria_s+=$p->monto*$p->cantidad; ?>
                                  <?php endforeach; ?>
                                </tbody> 
                            </table>
                            <h5><a href="#"  data-toggle="modal" data-target="#extender_estadia<?php echo $habitacion->id; ?>"  class="btn btn-greensea btn-xs b-0"><i class="glyphicon glyphicon-plus"></i></a>  
                            Extender estadía?

                            <p class="pull-right">Sub-total
                                <?php $total_s=$sumatoria_s; ?>
                                <button class="btn btn-primary btn-rounded btn-xs">$   <?php echo number_format($total_s,2,'.',','); ?></button>
                            </p>
                            </h5>
                            <!-- / FIN SERVICIO DE HABITACIÓN -->
                            <br>
                            <!-- VENTA DE PRODUCTOS-->
                            <h5 style="text-decoration: underline;">Consumo de productos</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Acción</th>
                                    <th>Fecha</th>
                                    <th>Cant.</th>
                                    <th>Producto</th>
                                    <th>Estado</th>
                                    <th><b class="pull-right">Precio</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $total=0;
                                    $producto_pagado=0;
                                    $productos = ProcesoVentaData::getByAll($_GET['id']);
                                    if(count($productos)>0){ 
                                        foreach($productos as $producto):?>
                                        <tr style="background-color: #f5f5f5;">
                                            <td> </td>
                                            <td><?php echo $producto->fecha_creada; ?></td>
                                            <td><?php echo $producto->cantidad; ?></td>
                                            <td><?php echo $producto->getProducto()->nombre; ?></td>
                                            <?php if($producto->fecha_creada!=NULL and $producto->fecha_creada!="0000-00-00 00:00:00"){ ?>
                                            <td><p class="text-green">Pagado</p></td>
                                              <?php }else{ ?>
                                            <td><p class="text-red">Falta Pagar</p></td>
                                              <?php }; ?>
                                            <td><b class="pull-right">$  <?php echo number_format($producto->precio,2,'.',','); ?></b></td>
                                        </tr>
                                        <?php 
                                        if($producto->fecha_creada!=NULL and $producto->fecha_creada!='0000-00-00 00:00:00'){ 
                                             $producto_pagado+=$producto->precio*$producto->cantidad;
                                        }else{ $producto_pagado+=0; }
                                        ?>
                                       
                                        <?php $total=($producto->cantidad*$producto->precio)+$total; 
                                        endforeach; 
                                     }; 
                                ?>    
                                
                                </tbody> 
                            </table>
                            <h5>
                            <p class="pull-right">Sub-total
                                <button class="btn btn-primary btn-rounded btn-xs">
                                    $    <?php echo number_format($total,2,'.',',');?>
                                </button>
                            </p>
                            </h5>
                            <!-- / FIN VENTA PRODUCTOS -->
                            <br>
                            <!-- OTROS SERVICIOS-->
                            <h5 style="text-decoration: underline;">Otros <a href="#"  data-toggle="modal" data-target="#otropago"  > [AGREGAR] </a> </h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Acción</th>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th><b class="pull-right">Precio</b></th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php 
                                $total_extra=0;
                                $gastos = GastoData::getAllIngresoProceso($_GET['id']);  
                                if(@count($gastos)>0){
                                foreach($gastos as $gasto):?> 
                                <tr style="background-color: #f5f5f5;"> 
                                    <td><a href="#"  data-toggle="modal" data-target="#confirmarg<?php echo $gasto->id; ?>" data-options="splash-2 splash-ef-11" class="tex-danger btn-xs b-0" style="color:#e05d6f;"><i class="glyphicon glyphicon-trash"></i></a></td>
                                    <td><?php echo date("Y-m-d", strtotime($gasto->fecha_creacion)); ?></td>
                                    <td><?php echo $gasto->descripcion; ?></td>
                                    <td><b class="pull-right">$    <?php echo number_format($gasto->precio,2,'.',',');?></b></td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade bs-example-modal-lg" id="confirmarg<?php echo $gasto->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog modal-sm" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header"> 
                                            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-alert"></i> ALERTA!!</h4>
                                        </div>
                                         <div class="modal-body">
                                            ¿Estás seguro de eliminar?
                                         </div>
                                         <div class="modal-footer">
                                            <a href="index.php?view=delingresop&id=<?php echo $gasto->id; ?>&id_p=<?php echo $_GET['id']; ?>" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Eliminar</a>
                                            <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancelar</button>
                                         </div>
                                      </div>
                                  </div>
                                </div>
                                <!-- /.Modal -->

                                <?php 
                                $total_extra+=$gasto->precio;
                                endforeach; }
                                ?>

                                
                                </tbody> 
                            </table>
                            <h5>
                            <p class="pull-right">Sub-total
                                <button class="btn btn-primary btn-rounded btn-xs">$    <?php echo number_format($total_extra,2,'.',',');?></button>
                            </p>
                            </h5>
                            
                            <!-- / OTROS SERVICIOS -->
                            
                        </div>
                        <div class="col-md-5">
                            <h5 style="text-decoration: underline;">Finalizar check-ou?</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th><center>MONEDA</center></th>
                                    <th><center>TOTAL</center></th>
                                    <th><center>SALDO</center></th>
                                    
                                </tr>
                                </thead>
                                <tbody> 
                                 <?php 
                                 $sumatoria_pagado=0; 
                                 $tmps_p = PagoProcesoData::getAllProceso($habitacion->id); 
                                    foreach($tmps_p as $p_p):  
                                     $sumatoria_pagado+=$p_p->monto; 
                                    endforeach; 
                                ?>

                                <tr>
                                    <td><center><b style="font-size: 20px;"><?php echo $habitacion->moneda; ?></b></center></td>
                                    <?php $total_total=$total_extra+$total+$total_s; ?>
                                    <td><center><b style="font-size: 20px;color:#16a085;">$    
                                        <?php echo number_format($total_total,2,'.',',');?></b></center></td>
                                    <td><center><b style="font-size: 20px;color: #e05d6f;">$    
                                        <?php echo number_format($total_total-($sumatoria_pagado+$producto_pagado),2,'.',',');?></b></center></td>
                                     
                                </tr>
                                </tbody> 
                            </table>

                            <br> 
                            <form action="index.php?view=addsalida" method="post">
                            <h5 style="text-decoration: underline;">Descuento (%)</h5>
                            <h5>
                            <input type="hidden" name="total_total" id="total_total" value="<?php echo $total_total; ?>">
                            <input type="hidden" name="acuenta" id="acuenta" value="<?php echo $sumatoria_pagado+$producto_pagado; ?>">
                            <input type="number" name="descuento" value="0" id="descuento" onkeyup="sumar();" onchange="sumar();">
                            
                            </h5> 

                            <h5 style="text-decoration: underline;">Total con descuento</h5>
                            <h5>
                            <b style="font-size: 20px;color: #e05d6f;">$  <span id="TotalSinDesc">
                                <?php echo number_format($total_total-($sumatoria_pagado+$producto_pagado),2,'.',',');?>
                                    
                                </span> </b>
                            </h5> 


                            <br>
                            <h5 style="text-decoration: underline;">Medios de pago</h5>
                            
                            <h5>
                            <select class="form-control" onchange="CargarMediopago(this.value);" required name="id_tipo_pago">
                              <?php $medipagos = TipoPagoData::getAll();
                              if(@count($medipagos)>0){ ?>
                              <?php foreach($medipagos as $mediopago):?>
                                <option <?php if($mediopago->id==$habitacion->id_tipo_pago){echo "selected";} ?> value="<?php echo $mediopago->id; ?>" ><?php echo $mediopago->nombre; ?></option>
                              <?php endforeach; ?>
                          

                              <?php }else{ };?>
                            </select>
                            </h5> 
                            <h5>
                            
                                <div class="modal fade bs-example-modal-xm" id="myModalVoucher" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><span class="fa fa-spinner"></span> REGISTRAR CORRELATIVO</h4>
                                          </div>
                                         
                                          <div class="modal-body" style="background-color:#fff !important;">
                                            <div class="row"> 
                                            <div class="col-md-offset-1 col-md-10">
                                              
                                              <div class="form-group"> 
                                                <div class="input-group">
                                                  <span class="input-group-addon"> Tipo comprobante </span>
                                                  <select class="form-control select2" required  name="comprobante">  
                                                    <?php $tipocomprobantes = TipoComprobanteData::getAll();?>
                                                    <?php foreach($tipocomprobantes as $tipocomprobante):?>
                                                      <option value="<?php echo $tipocomprobante->id;?>"><?php echo $tipocomprobante->nombre;?></option>
                                                    <?php endforeach;?>
                                                  </select> 
                                                </div>
                                              </div>
                                            </div>
                                            </div>
 
                                          </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal -->
                                  </div>
                                <input type="hidden" name="total_resumen" value="<?php echo $total_total; ?>"> 
                                <input type="hidden" name="nro_operacion" value="-"> 
                                <input type="hidden" name="id_operacion" value="<?php echo $_GET['id']; ?>">
                                <input type="hidden" name="fecha_salida" value="<?php echo $hoy.' '.$hora; ?>">
                                <button type="submit" name="general" class="btn btn-success pull-right btn-rounded"><i class='fa fa-print'></i> Finalizar Check-Out</button>
                            
                            </h5>
                            </form>
                            <br><br><br><br>
                            <h5>
                            <a href="#"  data-toggle="modal" data-target="#verpagos<?php echo $habitacion->id; ?>"  > [VER PAGOS REALIZADOS] </a>  
                            </h5>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /tile body -->

        </section>
        <!-- /tile -->
        <hr><hr><hr><hr><hr>
    </div>



    <!-- LISTA DE MODAL SIN ID-->
    <!-- Modal -->
    <div class="modal fade bs-example-modal-lg" id="mostrar_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            <h4 class="modal-title" id="myModalLabel">Lista de huéspedes</h4>
            </div>
             <div class="modal-body">
              
              <table class="footable table table-custom" style="font-size: 11px;">
                <thead style="color: white; background-color: #827e7e;">
                    <tr>
                      <th>Tipo huesped</th>
                      <th>Tipo documento</th>
                      <th data-hide='phone, tablet'>Documento</th> 
                      <th data-hide='phone, tablet'>Nombres completos</th>  
                      <th data-hide='phone, tablet'>Teléfono</th> 
                      <th data-hide='phone, tablet'>E-mail</th> 
                      <th data-hide='phone, tablet'>Procedencia</th> 
                       
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php $tmps = ClienteProcesoData::getAllProceso($habitacion->id); 
                    foreach($tmps as $p):  ?>
                          <tr> 
                            <td><?php echo $p->getCliente()->medio_transporte; ?></td>
                            <td><b><?php echo $p->getCliente()->getTipoDocumento()->nombre; ?></b></td>
                          
                            <td><?php echo $p->getCliente()->documento; ?></td>
                            <td><?php echo $p->getCliente()->nombre; ?></td>
                            <td><?php if($p->getCliente()->estado_civil!="NULL"){ echo $p->getCliente()->estado_civil; }else{ echo "--------";} ?></td>
                            <td><?php if($p->getCliente()->direccion!="NULL"){ echo $p->getCliente()->direccion; }else{ echo "--------";} ?></td>
                            <td><?php if($p->getCliente()->giro!="NULL"){ echo $p->getCliente()->giro; }else{ echo "--------";} ?></td>
                          </tr> 
                    <?php endforeach; ?>
                       
                        
                </table> 
                  
              </div>
          </div>
      </div>
    </div>
    <!-- /.Modal -->



  <!-- Modal -->
  <div class="modal fade bs-example-modal-lg" id="verpagos<?php echo $habitacion->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h4 class="modal-title" id="myModalLabel">Lista de pagos realizados</h4>
      </div>
      <div class="modal-body">
        
        <form action="index.php?view=addpago" method="post">
        <div class="row"> 
        <div class="col-md-12" style="padding-top: 20px;">
            <table class="table table-bordered">
                <thead>
                
                <th>Código</th>
                <th data-hide="phone">Monto</th>
                <th data-hide='phone, tablet'>Tipo pago</th>
                <th data-hide='phone, tablet'>Nro operación</th>  
                <th data-hide='phone, tablet'>Fecha del pago</th> 
                </thead>
                <tbody> 
       
              <?php $sumatoria=0; ?>
              <?php $subtotal= ($habitacion->precio*$habitacion->cant_noche)+$habitacion->total+$habitacion->extra; ?>
              <?php $tmps = PagoProcesoData::getAllProceso($habitacion->id); 
              foreach($tmps as $p):  ?>
                    <tr>
                      
                      <td><b><?php echo $p->id; ?></b></td>
                      <td><?php echo $p->monto; ?></td>
                      <td><?php echo $p->getTipoPago()->nombre; ?></td>
                      <td><?php echo $p->nro_operacion; ?></td>
                      <td><?php echo $p->fecha_creada; ?></td>
                    </tr> 
                
                    <?php $sumatoria=$sumatoria+$p->monto; ?>
              <?php endforeach; ?>
               </tbody>  
            </table>
        </div>
        </div>
        </form>
    </div>
    </div>
    </div>
  </div>
  <!-- /.Modal -->



    <!-- Modal -->
    <div class="modal fade" id="otropago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title custom-font">Registrar ingreso extra</h3>
                </div>
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addingresop" role="form">
                <div class="modal-body">
                    <input type="hidden" name="fecha" value="<?php echo $hoy; ?>">
                    <input type="hidden" name="hora" value="<?php echo $hora; ?>">

                     <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label">FECHA*</label>
                        <div class="col-md-8">
                          <input type="date" name="vigencia_circulacion" disabled required class="form-control"  id="address1" placeholder="Ingrese vigencia de circulacion" value="<?php echo $hoy; ?>"  >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label">DESCRIPCIÓN*</label>
                        <div class="col-md-8">
                          <textarea class="form-control" name="descripcion" required="" placeholder="Ingrese una descripcion"></textarea>
                        </div>
                      </div>
                        
                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-3 control-label">MONTO*</label>
                        <div class="col-md-8">  
                           <input type="text" name="precio" required class="form-control validanumericos"  placeholder="Ingrese precio total" >   
                        </div>
                      </div>
                      
                      <input type="hidden" name="id_tipopago" value="1">

                </div> 
                <div class="modal-footer">
                    <input type="hidden" name="id_proceso" value="<?php echo $_GET['id']; ?>">
                    <button type="submit" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Guardar ingreso</button> 
                    <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancelar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Modal-->

    <!-- Modal -->
    <div class="modal fade" id="extender_estadia<?php echo $habitacion->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title custom-font"><b>EXTENDER ESTADÍA</b></h3>
                </div>
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addestadia_mensual" role="form">
                <div class="modal-body">

                    <div class="form-group"> 
                        <label for="inputEmail1" class="col-lg-4 control-label">-- SELECCIONE --</label>
                        <div class="col-md-7">
                            <select class="form-control" name="fecha_hora" id="fecha_hora" >
                                <option value="1">+ 1 Mes</option>
                               
                            </select>
                        </div>
                      </div>
 
                     
                      <input type="hidden" name="cant_noche" required value="1" placeholder="Ejem. 1 Noche" >


                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-4 control-label">PRECIO X 1 MES*</label>
                        <div class="col-md-7">  
                           <input type="number" name="precio" required class="form-control validanumericos"  placeholder="Ingrese precio x noche" >   
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-4 control-label">-- SELECCIONE --</label>
                        <div class="col-md-7">
                            <select class="form-control" name="pagado" id="pagado" onchange="this.value=this.value.replace(/\.$/, '')" >
                                <option value="1">Pago realizado</option>
                                <option value="0">Registrar sin pago</option>
                               
                            </select>
                        </div> 
                      </div>

                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-4 control-label">-- MEDIO PAGO --</label>
                        <div class="col-md-7">
                            <select class="form-control" onchange="CargarMediopago(this.value);" required name="id_tipo_pago">
                    
                                  <option value="">--- Selecciona ---</option>

                                  <?php $medipagos = TipoPagoData::getAll();
                                  if(count($medipagos)>0){ ?>
                              
                                  <?php foreach($medipagos as $mediopago):?>
                                    <option value="<?php echo $mediopago->id; ?>" <?php if($mediopago->id=='1'){ echo "selected";} ?>><?php echo $mediopago->nombre; ?></option>
                                  <?php endforeach; ?>

                                  <?php }else{ };?>
                            </select> 
                        </div> 
                      </div>

                      



                </div> 
                <div class="modal-footer">
                    <input type="hidden" name="id_proceso" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="fecha_salida" value="<?php echo $habitacion->fecha_salida; ?>">
                    <button type="submit" class="btn btn-success btn-ef btn-ef-3 btn-ef-3c"><i class="fa fa-arrow-right"></i> Extender ahora </button>
                    <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Cancelar</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- / FIN MODAL SIN ID --> 
</div>

<?php }else{
  echo "<h4 class='alert alert-success'>NECESITA SELECCIONAR UNA HABITACIÓN CON HUESPED</h4>";
}; ?>

<?php }; ?>


<script type="text/javascript">

function sumar() {

  m1 = document.getElementById("descuento").value;
  m2 = document.getElementById("total_total").value;
  m3 = document.getElementById("acuenta").value;

  if (isNaN(m1)) 
  {
      alert('Esto no es un numero');
      document.getElementById('descuento').focus();
      return false;
  }
  if (m1=='') 
  {
      alert('Esto no es un numero');
      document.getElementById('descuento').focus();
      return false;
  }
  if (m1>100) 
  {
      alert('No puede superar a 100%');
      document.getElementById('descuento').focus();
      return false;
  }

  
  descuento = (parseFloat(m1)*parseFloat(m2))/100;
  r = (parseFloat(m2)-parseFloat(descuento))-m3;
  

  document.getElementById('TotalSinDesc').innerHTML = r;

 

}
 

  $(function(){

    $('.validanumericos').keypress(function(e) {
    if(isNaN(this.value + String.fromCharCode(e.charCode))) 
       return false;
    })
    .on("cut copy paste",function(e){
    e.preventDefault();
    });

  });

  function MostrarHoraFecha(val)
    {
        $('#hora_fecha').html("Por favor espera un momento");    
        $.ajax({
            type: "POST",
            url: 'index.php?action=hora_fecha',
            data: 'id='+val,
            success: function(resp){
                $('#hora_fecha').html(resp);
            }
        });
    };

function CargarEfectivo(val)
{   

    $('#mostrar_efectivo').html("Por favor espera un momento");    
    $.ajax({
        type: "POST",
        url: 'index.php?action=mostrar_efectivo',
        data: 'id='+val,
        success: function(resp){
            $('#mostrar_efectivo').html(resp);
        }
    });
};
</script>






