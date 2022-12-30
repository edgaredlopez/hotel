

 <?php $operacion = VentaData::getById($_GET['id']);
     if(@count($operacion)>0){
 ?>
            <!-- ====================================================
            ================= CONTENT ===============================
            ===================================================== -->
            <section id="content">
 
                <div class="page page-shop-single-order">

                    <div class="pageheader">

                        <h2><?php echo $operacion->getTipoComprobante()->nombre; ?> <span>Imprimir</span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a>
                                </li>
                                <li>
                                    <a href="#">Proceso servicios</a>
                                </li>
                                <li>
                                    <a href=""><?php echo $operacion->getTipoComprobante()->nombre; ?></a>
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
                          $id=0; ?>
                           
                        <?php }
                        ?>
                        <div class="add-nav">
                            <div class="nav-heading">
                                <h3><?php echo $operacion->getTipoComprobante()->nombre; ?> NRO : <strong class="text-greensea"><?php echo $operacion->id; ?></strong></h3>
                                <span class="controls pull-right">
                                  <a href="index.php?view=lista_servcioss" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Recepción"><i class="fa fa-times"></i></a>
                                  <!--
                                  <a href="javascript:;" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Send"><i class="fa fa-envelope"></i></a>
                                  -->
                                  <a href="reporte/ticket_servicio.php?id=<?php echo $_GET['id']; ?>" target="_blanck" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20" data-toggle="tooltip" title="Imprimir"><i class="fa fa-print"></i></a>
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
                                                                <p class="text-default lt">Creado: <?php echo $operacion->fecha_creada; ?></p>
                                                                
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
                                                                    
                                                                    <li><b><?php echo $operacion->getTipoComprobante()->nombre; ?> NRO: <?php echo $operacion->id; ?></b> </li>
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
                                                                    <?php if($operacion->id_proveedor!=0 and $operacion->id_proveedor!=NULL and $operacion->id_proveedor!=null and $operacion->id_proveedor!='NULL'){ ?>
                                                                    <li><strong class="inline-block w-xs">Nombre:</strong> <?php echo $operacion->getProveedor()->nombre; ?></li>
                                                                    <li><strong class="inline-block w-xs">Documento:</strong>  <?php echo $operacion->getProveedor()->documento; ?></li>
                                                                    <li><strong class="inline-block w-xs">Dirección:</strong>  <?php echo $operacion->getProveedor()->direccion; ?></li>

                                                                     <?php }; ?>

                                                                    
                                                                    <?php if($operacion->nro_casillero!=0){ ?> 
                                                                    <li><strong class="inline-block w-xs" style="color: blue; font-size: 14px;">NRO CASILLERO:</strong> <b style="color: blue; font-size: 24px;"><?php  echo $operacion->nro_casillero; ?></b></li>
                                                                <?php }; ?>
                                                                    
                                                                   
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
                                                             <table class="table table-hover table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>CANT.</th>
                                                                    <th>DESCRIPCIÓN</th>
                                                                    <th>PRECIO SERVICIO</th>
                                                                    
                                                                    <th>IMPORTE</th>
                                                                    
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                


                                                            <?php $total=0;?>
                                                            <?php $productos = ProcesoVentaData::getVenta($operacion->id);
                                                                  if(@count($productos)>0){ ?>
                                                               
                                                               <?php foreach($productos as $producto):?>

                                                                <tr>
                                                                  <td ><?php echo $producto->cantidad; ?></td>
                                                                  <td><?php echo $producto->getProducto()->nombre; ?></td>
                                                                  <td>$   <?php echo number_format($producto->precio,2,'.',','); ?></td>

                                                                  <?php $sub_total=$producto->precio*$producto->cantidad; ?>

                                                                  <td><b>$   <?php echo number_format($sub_total,2,'.',','); ?></b></td>

                                                                </tr>
                                                              <?php $total=$sub_total+$total; ?>
                                                                <?php endforeach; ?>
                                                        

                                                           <?php }else{ 
                                                       

                                                            };
                                                            ?>
                                                                
                                                                </tbody>
                                                            </table>
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

                                                        <ul class="list-unstyled">
                                                           <?php $final= $total;?>
                                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">Subtotal:</strong> $   <?php echo number_format(($final/1.18),2,'.',','); ?> </li>
                                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">IVA:</strong>  $   <?php echo number_format($final-($final/1.18),2,'.',','); ?></li>
                                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5"> Total:</strong>  $   <?php echo number_format($final,2,'.',','); ?></li>
                                                           
                                                        </ul>
                                                        <?php if($operacion->id_tipo_pago=='5'){ ?>
                                                        <ul class="list-unstyled" style="background-color: #493d55;color: white;">
                                                           
                                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">Efectivo:</strong> $   <?php echo number_format($operacion->efectivo,2,'.',','); ?> </li>
                                                            <li class="ng-binding"><strong class="inline-block w-sm mb-5">Tarjeta:</strong>  $   <?php echo number_format($operacion->tarjeta,2,'.',','); ?></li>
                                                      
                                                           
                                                        </ul>
                                                         <?php }; ?>

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
                
            </section>
            <!--/ CONTENT -->

  <?php }else{ 
           
                };
                ?>

