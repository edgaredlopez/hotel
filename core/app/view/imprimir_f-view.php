

 <?php $operacion = ProcesoData::getById($_GET['id']);
 $habitacion = ProcesoData::getById($_GET['id']);
     if(@count($operacion)>0 and $operacion->comprobante!='NULL'){
 ?>
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
           
                <div class="page page-shop-single-order">

                    <div class="pageheader">

                        <h2><?php if($operacion->comprobante!='' and $operacion->comprobante!='NULL'){ echo $operacion->getComprobante()->nombre;} ?> <span>Imprimir</span></h2>

                        <div class="page-bar">
 
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a>
                                </li>
                                <li> 
                                    <a href="#">Check out</a>
                                </li>
                                <li>
                                    <a href=""><?php echo $operacion->getComprobante()->nombre; ?></a>
                                </li>
                            </ul>
                            
                        </div>

                    </div>

                    <div class="pagecontent">

                        <?php 
                        $configuracion = ConfiguracionData::getAllConfiguracion(); 
                        if(@count($configuracion)>0){ 
                          $nombre=$configuracion->nombre;
                          $direccion=$configuracion->direccion;
                          $estado=$configuracion->estado;
                          $telefono=$configuracion->telefono;
                          $fax=$configuracion->fax;
                          $rnc=$configuracion->rnc;
                          $registro_empresarial=$configuracion->registro_empresarial;
                          $ciudad=$configuracion->ciudad;
                          $iva=$configuracion->iva;
                          $iva_sp=$iva/100;

                          $id=$configuracion->id; ?>
                         
                         

                        <?php }else{
                          $nombre='';
                          $direccion='';
                          $estado='';
                          $telefono='';
                          $fax='';
                          $rnc='';
                          $registro_empresarial='';
                          $ciudad='';
                          $iva=18;
                          $iva_sp=$iva/100;
                          $id=0; ?>
                           
                        <?php }
                        ?>
                        <div class="add-nav">
                            <div class="nav-heading">
                                <h3><?php echo $operacion->getComprobante()->nombre; ?> NRO : <strong class="text-greensea"><?php echo $operacion->nro_folio; ?></strong></h3>
                                <span class="controls pull-right">
                                  <a href="index.php?view=recepcion" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Recepción"><i class="fa fa-times"></i></a>
                                  <!--
                                  <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Send"><i class="fa fa-envelope"></i></a>
                                  -->
                                  <a href="reporte/ticket.php?id=<?php echo $_GET['id']; ?>" target="_blanck" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20" data-toggle="tooltip" title="Imprimir"><i class="fa fa-print"></i></a>
                                </span>
                            </div>

                            <div role="tabpanel">

                              

                                <div class="tab-content">
                                    <!-- tab in tabs -->
                                    <div role="tabpanel" class="tab-pane active" id="details">



                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-12">

                                             
                                                <!-- tile -->
                                                <section class="tile time-simple">


                                                    <!-- tile body -->
                                                    <div class="tile-body">


                                                        <!-- row -->
                                                        <div class="row">

                                                            <!-- col -->
                                                            <div class="col-md-9">
                                                                <p class="text-default lt">Creado: <?php echo $operacion->fecha_salida; ?></p>
                                                                
                                                            </div>
                                                            <!-- /col -->

                                                            <!-- col -->
                                                            <div class="col-md-3">
                                                                
                                                            </div>
                                                            <!-- /col -->

                                                        </div>
                                                        <!-- /row -->
 
                                                        <!-- row -->
                                                        <div class="row b-t pt-20">

                                                            <!-- col -->
                                                            <div class="col-md-3 b-r">
                                                                <p class="text-uppercase text-strong mb-10 custom-font">DETALLES</p>
                                                                <ul class="list-unstyled text-default lt mb-20">
                                                                    
                                                                    <li><b><?php echo $operacion->getComprobante()->nombre; ?> NRO: <?php echo $operacion->nro_folio; ?></b> </li>
                                                                    <li><?php echo $nombre; ?></li>
                                                                    <li><?php echo $rnc; ?></li>
                                                                </ul>
                                                            </div>
                                                            <!-- /col -->

                                                            <!-- col -->
                                                            <div class="col-md-4 b-r">
                                                                <p class="text-uppercase text-strong mb-10 custom-font">
                                                                    DATOS DE LA EMPRESA
                                                                   
                                                                </p>

                                                                
                                                                    <ul class="list-unstyled text-default lt mb-20">
                                                                        <li><?php echo $direccion; ?> </li>
                                                                        
                                                                        <li><?php echo $telefono; ?></li>
                                                                    </ul>
                                                                
                                                              

                                                            </div>
                                                            <!-- /col -->

                                                            <!-- col -->
                                                            <div class="col-md-5">
                                                                <p class="text-uppercase text-strong mb-10 custom-font">Cliente</p>
                                                               <ul class="list-unstyled text-default lt mb-20">
                                                                    <li><strong class="inline-block w-xs">Nombre:</strong> <?php echo $operacion->getCliente()->nombre; ?></li>
                                                                    <li><strong class="inline-block w-xs">Documento:</strong>  <?php echo $operacion->getCliente()->documento; ?></li>
                                                                    <li><strong class="inline-block w-xs">Dirección:</strong>  <?php echo $operacion->getCliente()->medio_transporte; ?></li>
                                                                   
                                                                </ul>
                                                            </div>
                                                            <!-- /col -->

                                                        </div>
                                                        <!-- /row -->


                                                    </div>
                                                    <!-- /tile body -->

                                                </section>
                                                <!-- /tile -->


                                                <!-- tile -->
                                                <section class="tile tile-simple">

                                                    <!-- tile body --> 
                                                    <div class="tile-body p-0">

                                                        <div class="table-responsive">

                            <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                            <h5 style="text-decoration: underline;">Detalle de estancia</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    
                                    <th>Fecha Ocup.</th>
                                    <th>Descripción</th>
                                    <th>Cant. Noches</th>
                                    <th>Nro Habi.</th>
                                    <th><b class="pull-right">Precio</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                 
                                <?php $sumatoria_s=0; ?>
                                  <?php $tmps = PagoProcesoData::getAllProceso($habitacion->id); 
                                  foreach($tmps as $p):  ?>
                                        <tr style="background-color: #f5f5f5;">
                                          
                                          
                                          <td><?php echo $habitacion->fecha_entrada; ?></td>
                                          <td><?php echo $habitacion->getTarifa()->nombre; ?></td>
                                          <td><?php echo $p->cantidad; ?></td>
                                          <td><?php echo $habitacion->getHabitacion()->nombre; ?></td>
                                          <td><b class="pull-right">Q    <?php echo number_format($p->monto,2,'.',','); ?></b></td>
                                        </tr> 
                                       
                                        <?php $sumatoria_s+=$p->monto*$p->cantidad; ?>
                                  <?php endforeach; ?>
                                </tbody> 
                            </table>
                            <h5>

                            <p class="pull-right">Sub-total
                                <?php $total_s=$sumatoria_s; ?>
                                <button class="btn btn-primary btn-rounded btn-xs">Q    <?php echo number_format($total_s,2,'.',','); ?></button>
                            </p>
                            </h5>
                            <!-- / FIN SERVICIO DE HABITACIÓN -->
                            <br>
                            <!-- VENTA DE PRODUCTOS-->
                            <h5 style="text-decoration: underline;">Consumo de productos</h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    
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
                                            
                                            <td><?php echo $producto->fecha_creada; ?></td>
                                            <td><?php echo $producto->cantidad; ?></td>
                                            <td><?php echo $producto->getProducto()->nombre; ?></td>
                                            
                                            <td><p class="text-green"><i class="fa fa-check"></i></p></td>
                                             
                                            <td><b class="pull-right">Q   <?php echo number_format($producto->precio,2,'.',','); ?></b></td>
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
                                    Q    <?php echo number_format($total,2,'.',',');?>
                                </button>
                            </p>
                            </h5>
                            <!-- / FIN VENTA PRODUCTOS -->
                            <br>
                            <!-- OTROS SERVICIOS-->
                            <h5 style="text-decoration: underline;">Otros </h5>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    
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
                                    
                                    <td><?php echo date("Y-m-d", strtotime($gasto->fecha_creacion)); ?></td>
                                    <td><?php echo $gasto->descripcion; ?></td>
                                    <td><b class="pull-right">Q     <?php echo number_format($gasto->precio,2,'.',',');?></b></td>
                                </tr>
                                

                                <?php 
                                $total_extra+=$gasto->precio;
                                endforeach; }
                                ?>

                                
                                </tbody> 
                            </table>
                            <h5>
                            <p class="pull-right">Sub-total
                                <button class="btn btn-primary btn-rounded btn-xs">Q     <?php echo number_format($total_extra,2,'.',',');?></button>
                            </p>
                            </h5>
                            
                            <!-- / OTROS SERVICIOS -->
                            
                        </div>
                    </div>
                       


                                                                


                                                        </div>

                                                    </div>
                                                    <!-- /tile body -->

                                                </section>
                                                <!-- /tile -->


                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-md-3 col-md-offset-9 price-total">

                                                <!-- tile -->
                                                <section class="tile tile-simple bg-tr-black lter">

                                                    <!-- tile body -->
                                                    <div class="tile-body">

                                                        <?php 
                                                                     $sumatoria_pagado=0; 
                                                                     $tmps_p = PagoProcesoData::getAllProceso($habitacion->id); 
                                                                        foreach($tmps_p as $p_p):  
                                                                         $sumatoria_pagado+=$p_p->monto; 
                                                                        endforeach; 
                                                        ?>

                                
                                                        <?php $total_total=$total_extra+$total+$total_s; ?>
                                    


                                                        <ul class="list-unstyled">
                                                           <?php $final= $total_total;?>
                                                           <?php $desc= ($total_total*$operacion->descuento)/100;?>
                                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">SUBTOTAL:</strong> Q    <?php echo number_format($final,2,'.',','); ?> </li>
                                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">IVA:</strong>  Q    <?php echo number_format($final*$iva_sp,2,'.',','); ?></li>

                                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5"> TOTAL:</strong>  Q    <?php echo number_format($final+($final*$iva_sp),2,'.',','); ?></li>
                                                           
                                                        </ul>


                                                    </div>
                                                    <!-- /tile body -->

                                                </section>
                                                <!-- /tile -->

                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->



                                    </div>

                                   

                              
                              

                               
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
                
        

  <?php }else{ 

    echo "<h1>Falta finalizar el proceso </h1>";
           
                };
                ?>

