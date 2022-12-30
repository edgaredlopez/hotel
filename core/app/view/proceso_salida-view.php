<script type="text/javascript" language="javascript" src="js/ajax.js"></script>  
<?php 
$clientes = PersonaData::getAll();

date_default_timezone_set('America/Guatemala');
$hoy = date("Y-m-d"); 
$hora = date("H:i:s");

?>

  <link rel="stylesheet" href="plugins/select2/select2.min.css">


<style type="text/css">
  
  .list-group-item {
    position: relative;
    display: block;
    padding: 10px 15px;
    margin-bottom: -1px;
    background-color: #ecf0f5;
    border: 1px solid #ddd;
}
 
</style>
<body onload="document.getElementById('numero2').focus();">
<div class="row">

 <section class="content-header">
      <h3 >
       <i class='fa fa-sign-out'></i> PROCESO CHECK OUT 
        <small>Avance</small>
      </h3>
      <ol class="breadcrumb">
        <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="#">Check out</a></li>
        <li class="active">Proceso check out</li>
      </ol>
</section>
</div>

<?php 
if(isset($_GET['id'])){
$habitacion = ProcesoData::getById($_GET['id']);
if(@count($habitacion)>0){ ?>
<div class="row"> 
 

 <?php 
$cliente = PersonaData::getById($habitacion->id_cliente);

 ?>

  <input type="hidden" name="id_operacion" value="<?php echo $habitacion->id; ?>">
  <section>
    <div class="row">
    <div class="col-md-3">
      <br>
 
            <div class="box-body box-profile">

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item" style="border-top: 2px solid black;">
                  <b>Nombre habitación</b> <a class="pull-right"><?php echo $habitacion->getHabitacion()->nombre; ?></a>
                </li>
                <li class="list-group-item"> 
                  <b>Tipo </b> <a class="pull-right"><?php echo $habitacion->getTarifa()->nombre; ?></a>
                </li>
                
                
              </ul>
            </div>
            <!-- /.box-body -->
   
         </div>
         <div class="col-md-5">
    <br>

            <div class="box-body box-profile">

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item" style="border-top: 2px solid black;">
                  <b>Nombre </b> <a href="#"  data-toggle="modal" data-target="#mostrar_cliente"  class="pull-right"><?php echo $habitacion->getCliente()->nombre; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Documento</b> <a class="pull-right"><?php echo $habitacion->getCliente()->documento; ?></a>
                </li>
                
                <!-- Modal -->
                <div class="modal fade bs-example-modal-lg" id="mostrar_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header"> 
                     
                
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                    <h4 class="modal-title" id="myModalLabel">Lista de huéspedes</h4>
                    </div>
                     <div class="modal-body">
                      
                      <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">
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



              </ul>
            </div>
            <!-- /.box-body -->
  
         </div>

         <div class="col-md-4">
    <br>
<?php 
$fecha1 = new DateTime($habitacion->fecha_entrada);//fecha inicial
  $fecha2 = new DateTime($hoy.' '.$hora);//fecha de cierre

  $horaf = $fecha1->diff($fecha2);
  $minutos = $fecha1->diff($fecha2);

  $contar_dias=$horaf->format('%d');
  $contar_hora=$horaf->format('%H');
  $contar_minutos=$horaf->format('%i'); 
  $contar_horas=$contar_hora+($contar_dias*24);
?>

            <div class="box-body box-profile">

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item" style="border-top: 2px solid black;">
                  <b>Fecha y Hora entrada</b> <b class="pull-right"><?php echo $habitacion->fecha_entrada; ?>&nbsp;        <a style="color:green;"><i class="fa fa-check"></i></a></b>
                </li>
                <li class="list-group-item">
                  <b>Fecha y Hora salida</b> <b class="pull-right"><?php echo $hoy.' '.$hora; ?>&nbsp;  <a href="" data-toggle="modal" data-target="#fecha_entrada01" style="color:red;"><i class="fa fa-edit"></i></a></b>
                </li>

                <li class="list-group-item">
                  <b>Calcular tiempo</b> <b class="pull-right" style="color: blue;"><?php echo $contar_horas.' Horas   '. $contar_minutos.' Min.'; ?>&nbsp;  </b>
                </li>
                
<div class="modal fade bs-example-modal-xm" id="fecha_entrada01" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog">
          
            <div class="modal-content">
            <form class="form-horizontal" method="post" action="index.php?view=updatefechaentrada" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-sitemap"></span> FECHA Y HORA DE ENTRADA</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
              <div class="row">
                
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Fecha &nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="fecha_entrada" value="<?php echo $habitacion->fecha_entrada; ?>" required placeholder="Ingrese fecha">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Fecha &nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="fecha_entrada" value="<?php echo $habitacion->fecha_entrada; ?>" required placeholder="Ingrese fecha">
                    </div>
                  </div>

                </div>
              </div>
                

              </div> 
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <input type="hidden" class="form-control" name="id_habitacion" value="<?php echo $habitacion->id; ?>" >
                <button type="submit"  class="btn btn-outline btn-success pull-left">Actualizar</button>
       
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        
      </div>
      
                
              </ul>
            </div>
            <!-- /.box-body -->
  
         </div>


        </div>


<?php 

      $total_alojamiento=0; 
      if($contar_horas<=24 and $contar_dias==0 ){

        $total_alojamiento=$habitacion->getHabitacion()->precio * 1;

      }else if($contar_dias!=0 and $contar_hora<=12){

       $total_alojamiento=$habitacion->getHabitacion()->precio * $contar_dias;


      }else if($contar_dias!=0 and $contar_hora>12 ){

        $total_alojamiento=$habitacion->getHabitacion()->precio * ($contar_dias + 1);

      };
  

  ?>





<div class="modal fade bs-example-modal-xm" id="myModalTarjeta" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-spinner"></span> TARJETA DE ESTACIONAMIENTO</h4>
              </div>
              <form action="index.php?view=updateestacionamiento" method="post">
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row"> 
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group"> 
                    <div class="input-group">
                      <span class="input-group-addon"> ESTADO </span>
                      <select class="form-control" name="tarjeta_e" required="">
                        <option value="">--- Selecciona ---</option>
                        <option value="Entregada">Etregada</option>
                        <option value="No entregada">No entregada</option>
                      </select>
                    </div>
                  </div>

                  
                </div>
                </div>

              </div>
              <input type="hidden" name="id_proceso" value="<?php echo $habitacion->id; ?>">
              <div class="modal-footer"> 
                <button type="submit" class="btn btn-outline btn-primary pull-left">Cambiar </button>

               
              </div>
              </form>
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>


      <div class="col-md-12">
          <div class="box box-default" >
            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr style="background-color: #dcd6d6;"> 
                  <th style="width: 10px;border-right: 1px solid #a09e9e;"></th>

                  <?php $subtotal= ($habitacion->precio*$habitacion->cant_noche)+$habitacion->total+$habitacion->extra; ?>

                  <th colspan="5" style="border-right:1px solid #a09e9e;">Costo del alojamiento </th>
                  <th style="width: 100px"><b style="color: blue;"><a href="#"  data-toggle="modal" data-target="#mostrar_cliente<?php echo $habitacion->id; ?>" >
                          <i class="fa fa-plus"></i> Ver pagos
                        </a></b>

                         <!-- Modal -->
                          <div class="modal fade bs-example-modal-lg" id="mostrar_cliente<?php echo $habitacion->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header"> 
                               
                          
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                              <h4 class="modal-title" id="myModalLabel">Lista de pagos realizados</h4>
                              </div>
                               <div class="modal-body">
                                
                                <form action="index.php?view=addpago" method="post">

                                <div class="row"> 
                                  
                                

                                <div class="col-md-12" style="padding-top: 20px;">
                                <table  class="footable table table-custom" style="font-size: 11px;">
                                  <thead style="color: white; background-color: #827e7e;">
                                      <tr>
                                      
                                        <th>Código</th>
                                        <th data-hide="phone">Monto</th>
                                        <th data-hide='phone, tablet'>Tipo pago</th>
                                        <th data-hide='phone, tablet'>Nro operación</th>  
                                        <th data-hide='phone, tablet'>Fecha del pago</th> 
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php $sumatoria=0; ?>
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
                                       <tfoot style="background-color: #8dc8fb;">
                                        <th><b style="font-size: 16px;">Total</b></th>
                                        <th><b style="font-size: 16px;"><?php echo $sumatoria; ?></b></th>
                                        <th><b style="font-size: 16px;">Resta</b></th>
                                        <th><b style="font-size: 16px;"><?php echo $subtotal-$sumatoria; ?></b></th>
                                        <th></th>
                                        </th>
                                         
                                       </tfoot>
                                          
                                        </table>

                                      </div>

                                                               
                             
                              </div>
                                        
                                </div>
                                </form>
                          
                            
                            </div>
                            </div>
                          </div>
                          <!-- /.Modal -->
                  </th>


                 


                </tr> 
                <tr>
                  <th style="width: 10px;border-right: 1px solid #a09e9e;">#</th>
                  
                  <th>Costo por tarifa </th>
                  <th>Adelanto</th>
                  <th></th>
                  <th style="border-right:1px solid #a09e9e;" colspan="2">Carga por salir tarde</th>
                  
                  <th style="width: 40px"><span class="badge"><b>Resta: $    <?php echo number_format($subtotal-$sumatoria,2,'.',','); ?></b></span></th>
                </tr> 
             <form action="index.php?view=addsalida" method="post" name="sumar">
                <tr>
                  <td style="border-right: 1px solid #a09e9e;">1.</td>
            
                  <td >$   <?php echo number_format($habitacion->precio,2,'.',','); ?></td>
                  <td >$   <?php echo number_format($sumatoria,2,'.',','); ?></td>
                  <!--
                  <td ><b> <?php echo $habitacion->cant_noche; ?></b></td>-->
                  <script>
                  function fncSumar(){ 
                  caja=document.forms["sumar"].elements;
                  var numero = Number(caja["numero"].value);
                  var numero1 = Number(caja["numero1"].value);
                  var numero2 = Number(caja["numero2"].value);
                  var subtotal = Number(caja["subtotal"].value);
                  var extra = Number(caja["extra"].value);
                  var sumatoria = Number(caja["descuento"].value);
                  
                  resultado=numero2;
                  total=resultado+subtotal;
                  if(!isNaN(resultado)){
                  caja["resultado"].value=(numero*numero1)+numero2;
                  }
                  if(!isNaN(total)){
                  caja["total"].value=(numero*numero1)+numero2+extra-sumatoria+subtotal;
                  caja["stotal"].value=(numero*numero1)+numero2+extra-sumatoria;
                  }
                  }
                  </script>

                 
                  <input type="hidden" name="numero" size="2" value="<?php echo $habitacion->precio; ?>" onKeyUp="fncSumar()">

                  <input type="hidden" name="extra" size="2" value="<?php echo $habitacion->extra; ?>" onKeyUp="fncSumar()">
                  
                  <input type="hidden" name="numero1" size="2" value="<?php echo $habitacion->cant_noche; ?>" onKeyUp="fncSumar()" >
                  <input type="hidden" name="descuento" value="<?php echo $sumatoria; ?>" onKeyUp="fncSumar()">
                  <td ></td>

                  <td style="border-right: 1px solid #a09e9e;" colspan="2"><input type="number" value="0" id="numero2" name="numero2" size="2" onKeyUp="fncSumar()" onchange="fncSumar()" min="0" style="width: 100px;"></td>

                  <td><input type="text" value="<?php echo $habitacion->precio*$habitacion->cant_noche; ?>" style="border-color: red;" readonly="readonly" name="resultado"/></td>
                
                </tr>

                <tr style="background-color: #dcd6d6;">
                  <th style="width: 10px;border-right: 1px solid #a09e9e;"></th>
                  <th colspan="5" style="border-right: 1px solid #a09e9e;">Servicio al cuarto</th>
                  <th style="width: 100px"></th>
                </tr>

                 <tr>
                  <th style="width: 10px;border-right: 1px solid #a09e9e;">#</th>
                  <th>Descripción</th>
                  <th>Precio unitario</th>
                  <th style="border-right:1px solid #a09e9e;">Cantidad</th>
                  <th style="border-right:1px solid #a09e9e;" colspan="2">Estado</th>

                  <th style="width: 40px">    

                  CHECK-OUT

                  </th>
                </tr>

                <?php $total=0;?>
                <?php $productos = ProcesoVentaData::getByAll($_GET['id']);
                      if(count($productos)>0){ ?>
                  
                   <?php foreach($productos as $producto):?>

                    <tr>
                      <td style="border-right: 1px solid #a09e9e;">1.</td>

                      <td><?php echo $producto->getProducto()->nombre; ?></td>
                      <td><b>$  <?php echo number_format($producto->precio,2,'.',','); ?></b></td>
                      <td ><?php echo $producto->cantidad; ?></td>
                      <?php if($producto->fecha_creada!=NULL and $producto->fecha_creada!="0000-00-00 00:00:00"){ ?>
                      <td style="border-right: 1px solid #a09e9e;" colspan="2"><p class="text-green">Pagado</p></td>
                      <?php }else{ ?>
                      <td style="border-right: 1px solid #a09e9e;" colspan="2"><p class="text-red">Falta Pagar</p></td>
                      <?php }; ?>

                      <?php if($producto->fecha_creada!=NULL and $producto->fecha_creada!='0000-00-00 00:00:00'){ ?>
                      <?php $sub_total=0; ?>
                      <?php }else{ ?>
                      <?php $sub_total=$producto->precio*$producto->cantidad; ?>
                      <?php }; ?>
                      <td><span class="badge"><b>$    <?php echo number_format($sub_total,2,'.',','); ?></b></span></td>
                    </tr>
                  <?php $total=$sub_total+$total; ?>
                    <?php endforeach; ?>
            

               <?php }else{ 
           

                };
                ?>


                <tr style="background-color: #dcd6d6;">
                  <th style="width: 10px;border-right: 1px solid #a09e9e;"></th>
                  <th colspan="5" style="border-right: 1px solid #a09e9e;"><p style="float: right;font-size: 18px;">
                      <?php if($habitacion->id_tipo_pago!=4){ 
                      if(($subtotal-$sumatoria+$total)<0){ echo "<b style='color:red;'>Vuelto</b>"; } 
                      else{ echo "<b style='color:green;'>Debe</b>";} 
                    }else{ echo "Debe"; }
                      ?> $   
                    </p></th>
                  <input type="hidden" name="subtotal" value="<?php echo $total; ?>" id="subtotal" onKeyUp="fncSumar()">

                  <?php if($habitacion->pagado=='1'){ $sumarrr=0;}else{ $sumarrr= ($habitacion->precio*$habitacion->cant_noche)+$habitacion->extra; } ?>

                  

                  <th style="width: 100px;"><b><input type="text" style="border-color: green;"  name="total" value="<?php if($habitacion->id_tipo_pago!=4){ echo $subtotal-$sumatoria+$total; }else{ echo '0';} ?>"></b></th>
                  
                  <input type="hidden"  name="stotal" value="<?php if($habitacion->id_tipo_pago!=4){ echo $subtotal-$sumatoria; }else{ echo '0';} ?>">
                  
                </tr>


                
                <tr style="background-color: #dcd6d6;">
                  <th style="width: 10px;border-right: 1px solid #a09e9e;"></th>
                  <th colspan="5" style="border-right: 1px solid #a09e9e;"><p style="float: right;font-size: 14px;">Tipo de pago</p></th>
                 
                  <th style="width: 100px;"><b>
                    <select class="form-control" onchange="CargarMediopago(this.value);" required name="id_tipo_pago">
                    
                      
                      <?php $medipagos = TipoPagoData::getAll();
                      if(@count($medipagos)>0){ ?>
                  
                      <?php foreach($medipagos as $mediopago):?>
                        <option <?php if($mediopago->id==$habitacion->id_tipo_pago){echo "selected";} ?> value="<?php echo $mediopago->id; ?>" ><?php echo $mediopago->nombre; ?></option>
                      <?php endforeach; ?>
                  

                      <?php }else{ };?>
                       
                    
                    </select> </b> 
                  </th>
                </tr>


                <tr style="background-color: #dcd6d6;">
                  <th style="width: 10px;border-right: 1px solid #a09e9e;"></th>
                  <th colspan="5" style="border-right: 1px solid #a09e9e;"><p style="float: right;font-size: 14px;">Nro operación</p></th> 
                 
                  <th style="width: 100px;" id="mostrar_mediopago" >
                    
                  </th>
                </tr>
                
 
               


                
              </table>
            </div>




 <div class="modal fade bs-example-modal-xm" id="myModalVoucher" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-info">
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
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>


           
             <div class="box-footer clearfix">
              
                 <a href="index.php?view=recepcion" class="btn btn-danger"><i class='fa fa-sign-out'></i> Cancelar</a>
              
                  <input type="hidden" name="id_operacion" value="<?php echo $habitacion->id; ?>">
                  <input type="hidden" name="fecha_salida" value="<?php echo $hoy.' '.$hora; ?>">
                  <input type="hidden" name="id_habitacion" value="<?php echo $habitacion->getHabitacion()->id; ?>">
                 


   


                 
                  <button type="submit" name="general" class="btn btn-success pull-right"><i class='fa fa-print'></i> Finalizar Check-Out</button>
                 
                  
                  <a data-toggle="modal" data-target="#myModalVoucher" class="btn btn-primary pull-right" style="margin-right: 10px;"><i class='fa fa-print'></i> Registrar Correlativo</a>

                  <!--

                  <a data-toggle="modal" data-target="#myModal" class="btn btn-success pull-right" style="margin-right: 10px;"><i class='fa fa-print'></i> Finalizar Check-Out</a>
                -->


                  
              
        
            </div>
        </form>
           
          </div>
         </div>





  <div class="modal fade bs-example-modal-xm" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-warning"></span> NO SE ENTREGÓ TARJETA DE ESTACIONAMIENTO</h4>
              </div>
              
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  
                  
                </div>
                </div>

              </div>
              
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>      

  </section>

</div>
<?php }else{
  echo "<h4 class='alert alert-success'>NECESITA SELECCIONAR UNA HABITACIÓN CON HUESPED</h4>";
}; ?>

<?php }; ?>
   


    <!-- Carga los datos ajax -->
  
      <!-- Modal -->
      <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
           
      
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">ACEPTAR</span></button>
          <h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
          </div>
           <div class="modal-body">
            
             
          <div id="loader" style="position: absolute; text-align: center; top: 55px;  width: 100%;display:none;"></div><!-- Carga gif animado -->
          <div class="outer_div" ></div><!-- Datos ajax Final -->
                    
                   </div>
      
        
        </div>
        </div>
      </div>
            
            


  
    
  
    
  

<script src="plugins/select2/select2.full.min.js"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();


  });


  function CargarMediopago(val)
{
    $('#mostrar_mediopago').html("Por favor espera un momento");    
    $.ajax({
        type: "POST",
        url: 'index.php?action=salida_mediopago',
        data: 'id='+val,
        success: function(resp){
            $('#mostrar_mediopago').html(resp);
        }
    });
};


function MostrarSelectMedioPago(val)
{
    $('#mostrar_selectmediopago').html("Por favor espera un momento");    
    $.ajax({
        type: "POST",
        url: 'index.php?action=select_mediopago',
        data: 'id='+val,
        success: function(resp){
            $('#mostrar_selectmediopago').html(resp);
        }
    });
};
</script>





