<!doctype html>
 <html class="no-js" lang="es"> 
 
<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>HOTEL </title>
        <link rel="icon" type="image/ico" href="assets/images/favicon.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor/animate.css">
        <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="assets/js/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="assets/js/vendor/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="assets/js/vendor/owl-carousel/owl.carousel.css">
        <link rel="stylesheet" href="assets/js/vendor/owl-carousel/owl.theme.css"> 
        <link rel="stylesheet" href="assets/js/vendor/chosen/chosen.css">
        <link rel="stylesheet" href="assets/js/vendor/summernote/summernote.css">
        <link rel="stylesheet" href="assets/css/vendor/weather-icons.min.css">

        <link rel="stylesheet" href="assets/css/main.css">

        <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
   





    </head>





    <body  id="minovate" class="<?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?> appWrapper sidebar-sm-forced <?php else:?>appWrapper<?php endif; ?>"  >




        <div id="wrap" class="animsition">


            <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
            <section id="header">
                <header class="clearfix">

                    <!-- Branding -->
                    <div class="branding">
                        <a class="brand" href="index.php?view=recepcion">
                            <span><strong>HOTEL </strong></span>
                        </a>
                        <a href="#" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
                    </div>
                    <!-- Branding end -->


                    <!-- Left-side navigation -->
                    <ul class="nav-left pull-left list-unstyled list-inline">
                        <li class="sidebar-collapse divided-right">
                            <a href="#" class="collapse-sidebar">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                        
                        <li class="dropdown divided-right settings">
                            <a href="index.php?view=pre_venta">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                            
                        </li>
                        
                        
                    </ul>
                    <!-- Left-side navigation end -->
                    
                   <!-- Right-side navigation -->
                    <ul class="nav-right pull-right list-inline">
                        
                        <li class="dropdown nav-profile">

                            <a href class="dropdown-toggle" data-toggle="dropdown">
                               
                                <span><?php if(isset($_SESSION["user_id"]) ){ echo UserData::getById($_SESSION["user_id"])->name; 

                  }?><i class="fa fa-angle-down"></i></span>
                            </a>

                            <ul class="dropdown-menu animated littleFadeInRight" role="menu">
                                <!--
                                <li>
                                    <a href="#">
                                        <span class="badge bg-greensea pull-right">86%</span>
                                        <i class="fa fa-user"></i>Perfil
                                    </a>
                                </li>
                            -->
                                <li>
                                    <a href="./logout.php">
                                        <i class="fa fa-sign-out"></i>Salir
                                    </a>
                                </li>
 
                            </ul>

                        </li>

                        
                    </ul>
                    <!-- Right-side navigation end -->
 
 
                    <!-- Search 
                    <div class="search" id="main-search">
                        <form action="index.php?view=cliente" method="get">
                            <input type="hidden" name="view" value="recepcion">
                            <input type="text" class="form-control underline-input" name="buscar" placeholder="Buscar Cliente...">
                        </form>
                    </div>
                    -->




                    



                </header>

            </section>
            <!--/ HEADER Content  -->





            <!-- =================================================
            ================= CONTROLS Content ===================
            ================================================== -->
            <div id="controls">





                <!-- ================================================
                ================= SIDEBAR Content ===================
                ================================================= -->
                <aside id="sidebar">


                    <div id="sidebar-wrap">

                        <div class="panel-group slim-scroll" role="tablist">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#sidebarNav">
                                            Navegación <i class="fa fa-angle-up"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
                                    <div class="panel-body">
                                <?php 
                                    $u=null; 
                                    $u = UserData::getById(Session::getUID());
                                ?>

                                        <!-- ===================================================
                                        ================= NAVIGATION Content ===================
                                        ==================================================== -->

                                        
                                        <ul id="navigation">
                                            <?php if($u->reserva):?>
                                            <li class="<?php if($_GET['view']=='reserva'){ echo 'active';} ?>"><a href="./?view=reserva"><i class="fa fa-calendar"></i> <span>Reserva</span></a></li>
                                            <?php endif;?>
                                            <?php if($u->recepcion):?>
                                            <li class="<?php if($_GET['view']=='recepcion'){ echo 'active';} ?>">
                                                <a href="index.php?view=recepcion"><i class="fa fa-sign-in"></i> <span>Recepción</span> <span class="badge bg-lightred">6</span></a>
                                               
                                            </li> 
                                            
                                            
                                            <?php endif;?>
                                            <!--
                                            <li class="<?php if($_GET['view']=='reservap' or $_GET['view']=='reservasp'){ echo 'active';} ?>">
                                                <a href="index.php?view=reservasp"><i class="fa fa-search"></i> <span>Reserva</span> </a>
                                               
                                            </li> 
                                            -->
                                            <?php if($u->factura):?>
                                            <li class="<?php if($_GET['view']=='libro' or $_GET['view']=='prelibro'){ echo 'active';} ?>">
                                                <a href="index.php?view=prelibro"><i class="fa fa-book"></i> <span>Lista de facturas</span> </a>
                                               
                                            </li>  
                                            <?php endif;?>

                                            <?php if($u->recepcion):?>
                                                <!--
                                            <li class="<?php if($_GET['view']=='tablero_mensual'){ echo 'active';} ?>">
                                                <a href="index.php?view=tablero_mensual"><i class="fa fa-table"></i> <span>Tablero mensual</span> </a>
                                               
                                            </li> 
                                             -->
                                            
                                            <?php endif;?>

                                            <?php if($u->credito):?>
                                            <!--
                                            <li class="<?php if($_GET['view']=='credito'){ echo 'active';} ?>">
                                                <a href="index.php?view=credito"><i class="fa fa-money"></i> <span>Histórico de crédito</span> </a>
                                               
                                            </li> 
                                        -->
                                            <?php endif;?>
                                            <?php if($u->punto_venta):?> 

                                            <li class="<?php if($_GET['view']=='productos' or $_GET['view']=='venta' ){ echo 'active';} ?>">
                                                <a role="button" tabindex="0"><i class="fa fa-arrow-circle-right"></i> <span>Punto de venta</span></a>
                                                <ul>
                                                    
                                                    <li><a href="./?view=venta"><i class="fa fa-caret-right"></i> Vender</a></li>
                                                    <li><a href="./?view=lista_venta_producto"><i class="fa fa-caret-right"></i> Lista de ventas</a></li>
                                                    <li><a href="./?view=venta_credito"><i class="fa fa-caret-right"></i> Venta a crédito</a></li>
                                                    <li><a href="./?view=pre_producto"><i class="fa fa-caret-right"></i> Productos</a></li>
                                                    <li><a href="./?view=pre_report_venta"><i class="fa fa-caret-right"></i> Reporte por producto</a></li>
                                                     <li><a href="./?view=pre_reporte_rango_producto"><i class="fa fa-caret-right"></i> Reporte por rango productos</a></li>
                                                     
                                                     <li><a href="./?view=categoriap"><i class="fa fa-caret-right"></i> Categoría pro.</a></li>
                                                    <!--
                                                    <li><a href="./?view=proveedores"><i class="fa fa-caret-right"></i> Proveedores</a></li>
                                                -->
                                                </ul>  
                                            </li>
                                            <?php endif;?>
                                            <?php if($u->servicio):?>
                                         
                                                <!--
                                            <li class="<?php if($_GET['view']=='proceso_servicio' or $_GET['view']=='venta_servicio' or $_GET['view']=='lista_servicios'  ){ echo 'active';} ?> ">
                                                <a role="button" tabindex="0"><i class="fa fa-edit"></i> <span>Servicios</span></a>
                                                <ul>
                                                    <li><a href="./?view=proceso_servicio"><i class="fa fa-caret-right"></i> Procesar</a></li>
                                                    <li><a href="./?view=lista_servcioss"><i class="fa fa-caret-right"></i> Venta servicios</a></li>
                                                    <li><a href="./?view=servicio_credito"><i class="fa fa-caret-right"></i> Servicios a crédito</a></li>
                                                    <li><a href="./?view=lista_servicios"><i class="fa fa-caret-right"></i> Lista servicios</a></li>

                                                    <li><a href="./?view=pre_reporte_servicio"><i class="fa fa-caret-right"></i> Reporte por servicio</a></li>
                                                     <li><a href="./?view=pre_reporte_rango_servicio"><i class="fa fa-caret-right"></i> Reporte por rango servicios</a></li>
                                                </ul>
                                            </li>
                                        -->
                                            <?php endif;?>
                                            <?php if($u->inventario):?>

                                            
                                            <li class="<?php if($_GET['view']=='kardex' or $_GET['view']=='compra' or $_GET['view']=='compra_credito' or $_GET['view']=='lista_compra'  ){ echo 'active';} ?> ">
                                                <a role="button" tabindex="0"><i class="fa fa-edit"></i> <span>Inventario</span></a>
                                                <ul>
                                                    <li><a href="./?view=kardex"><i class="fa fa-caret-right"></i> Kardex</a></li>
                                                    <li><a href="./?view=compra"><i class="fa fa-caret-right"></i> Reabastecer</a></li>

                                                    <li><a href="./?view=compra_credito"><i class="fa fa-caret-right"></i> Compras a crédito</a></li>

                                                    <li><a href="./?view=proveedores"><i class="fa fa-caret-right"></i> Proveedores</a></li>

                                                    <li><a href="./?view=lista_compra"><i class="fa fa-caret-right"></i> Consulta compra por fecha</a></li>
                                                    <li><a href="./?view=reporte_por_proveedor"><i class="fa fa-caret-right"></i> Reporte por proveedor</a></li>
                                                </ul>
                                            </li>
                                            <?php endif;?>
                                            <?php if($u->caja):?>
                                            
                                            <li class="<?php if($_GET['view']=='apertura_caja'){ echo 'active';} ?>">
                                                <a role="button" tabindex="0"><i class="fa fa-cube"></i> <span>Módulo caja</span></a>
                                                <ul>
                                                    <li><a href="./?view=apertura_caja"><i class="fa fa-caret-right"></i> Apertura caja</a></li>
                                                    <li><a href="./?view=cierre_caja"><i class="fa fa-caret-right"></i> Cierre caja</a></li>
                                                    <li><a href="./?view=resumen_caja"><i class="fa fa-caret-right"></i> Resumen liquidación</a></li>
                                                    <li><a href="./?view=reporte_diario"><i class="fa fa-caret-right"></i> Reporte diario</a></li>
                                                <li><a href="./?view=pre_reporte_user"><i class="fa fa-caret-right"></i> Reporte Recepcionista</a></li>
                                                </ul>
                                            </li>  
                                            <?php endif;?>

                                            <li class="<?php if($_GET['view']=='reporte_ingreso' or $_GET['view']=='otro_ingreso' or $_GET['view']=='lista_ingreso'){ echo 'active';} ?>">
                                              <a role="button" tabindex="0"><i class='fa fa-database'></i> <span>Otros ingresos</span> </a>
                                              <ul>

                                                <li><a href="./?view=otro_ingreso"> <i class="fa fa-caret-right"></i>  Registrar otro ingreso</a></li>
                                                <li><a href="./?view=lista_ingresos"> <i class="fa fa-caret-right"></i>  Lista otros ingresos</a></li>

                                                <li><a href="./?view=reporte_ingreso"> <i class="fa fa-caret-right"></i>  Reporte por fechas</a></li>

                                              </ul>
                                            </li>

                                            <?php if($u->egreso):?>


                                            <li class="<?php if($_GET['view']=='egreso' or $_GET['view']=='egresos' or $_GET['view']=='reporte_gasto'){ echo 'active';} ?>">
                                              <a role="button" tabindex="0"><i class="fa fa-table"></i> <span>Egresos</span> </a>
                                              <ul>
                                                <li><a href="index.php?view=egreso"><i class="fa fa-table"></i> <span>Nuevo egreso</span></a></li>
                                                <li><a href="./?view=egresos"> <i class="fa fa-caret-right"></i>  Lista egresos</a></li>
                                                <li><a href="./?view=reporte_gasto"> <i class="fa fa-caret-right"></i>  Reportes por fechas</a></li>
                                              </ul>
                                            </li>
                                            <?php endif;?>
                                            <?php if($u->pago_personal):?>

                                            
                                          <!--
                                            <li class="<?php if($_GET['view']=='sueldo'){ echo 'active';} ?>">
                                                <a role="button" tabindex="0"><i class="fa fa-money"></i> <span>Pagos</span></a>
                                                <ul>
                                                    <li><a href="./?view=sueldo"><i class="fa fa-caret-right"></i> Realizar pago a trabajador</a></li>

                                                    <li><a href="./?view=sueldo_comisionista"><i class="fa fa-caret-right"></i> Realizar pago a comisionistas</a></li>

                                                    <li><a href="./?view=comisionista"><i class="fa fa-caret-right"></i> Lista de comisionistas</a></li>
                                                    
                                                </ul>
                                            </li> 
                                        -->
                                            <?php endif;?>
                                            <?php if($u->configuracion):?>
                                        

                                           
                                         
                                            

                                            <li class="<?php if($_GET['view']=='habitacion' or $_GET['view']=='categoria' or $_GET['view']=='tarifa' or $_GET['view']=='esperado'){ echo 'active';} ?>">
                                              <a role="button" tabindex="0"><i class='fa fa-database'></i> <span>Configuración</span> </a>
                                              <ul>
                                                <li><a href="./?view=habitacion"> <i class="fa fa-caret-right"></i>  Habitaciones</a></li>
                                                <li><a href="./?view=categoria"> <i class="fa fa-caret-right"></i>  Categorías</a></li>
                                                <li><a href="./?view=tarifa"> <i class="fa fa-caret-right"></i>  Tarifas</a></li>
                                                <li><a href="./?view=nivel"> <i class="fa fa-caret-right"></i>  Nivel Habitación</a></li>

                                                <li><a href="./?view=esperado"> <i class="fa fa-caret-right"></i>  Reserva esperado</a></li>
                                                
                                                <li><a href="./?view=re_servicio"> <i class="fa fa-caret-right"></i>  Config. reservas servicio</a></li>
                                                <li><a href="./?view=re_habitacion"> <i class="fa fa-caret-right"></i>  Config reservas habitación</a></li>

                                              </ul>
                                            </li>
                                            <?php endif;?>
                                            <?php if($u->cliente):?>

                                             

                                            <li class="<?php if($_GET['view']=='cliente'){ echo 'active';} ?>">
                                                <a href="index.php?view=cliente"><i class="fa fa-users"></i> <span>Clientes corto estadía</span></a>   
                                            </li>
                                            <!--
                                            <li class="<?php if($_GET['view']=='cliente_residente'){ echo 'active';} ?>">
                                                <a href="index.php?view=cliente_residente"><i class="fa fa-users"></i> <span>Clientes residentes</span></a>   
                                            </li>
                                             -->
                                            <?php endif;?>
                                            <?php if($u->reporte):?>

                                            <li>
                                              <a  role="button" tabindex="0"><i class='fa fa-file-text-o'></i> <span>Reportes</span></a>
                                              <ul >

                                                <li><a href="./?view=pre_reporte_rango"><i class="fa fa-caret-right"></i> Reporte detallado cliente</a></li>

                                                <li><a href="./?view=pre_reporte_residente"><i class="fa fa-caret-right"></i> Reporte hueped residentes</a></li>
                                                <!--
                                                <li><a href="./?view=reserva_esperado"><i class="fa fa-caret-right"></i> Reporte Reserva esperado</a></li>
                                                
                                                <li><a href="./?view=reserva_confirmado"><i class="fa fa-caret-right"></i> Reporte Reserva confirmado</a></li>

                                                -->

                                                <li><a href="./?view=pre_reporte_ocupacion"><i class="fa fa-caret-right"></i> Reporte ocupación</a></li> 

                                                <li><a href="./?view=reporte_diario"><i class="fa fa-caret-right"></i> Reporte diario</a></li>
                                                <li><a href="./?view=pre_reporte_user"><i class="fa fa-caret-right"></i> Reporte Recepcionista</a></li>
                                                <li><a href="./?view=pre_reporte_caja"><i class="fa fa-caret-right"></i> Reporte de caja</a></li>
                                                <li><a href="./?view=reporte_estado"><i class="fa fa-caret-right"></i> Reporte estado habitación</a></li>
                                                
                                                <li><a href="./?view=pre_reporte_reserva"><i class="fa fa-caret-right"></i> Reporte de reserva</a></li>
                                                
                                                <!--<li><a href="./?view=reporte_mensual"><i class="fa fa-caret-right"></i> Reporte de mensual</a></li>-->
                                            
                                                <!--
                                                <li><a href="./?view=reporte_caja"><i class="fa fa-caret-right"></i> Reporte de mensual</a></li>
                                                -->
                                           

                                              </ul>
                                            </li> 
                                            <?php endif;?>
                                            
                                        <!--
                                             <li>
                                              <a  role="button" tabindex="0"><i class='fa fa-bar-chart-o'></i> <span>Gráficos</span></a>
                                              <ul >
                                                <li><a href="./?view=pre_reporte_fecha_barra"><i class="fa fa-caret-right"></i> Reporte por fecha</a></li>
                                                <li><a href="./?view=pre_reporte_fecha_circular"><i class="fa fa-caret-right"></i> Reporte Circular</a></li>
                                                <li><a href="./?view=pre_reporte_anio_barra"><i class="fa fa-caret-right"></i> Reporte Anual</a></li>
                                                
                                              </ul> 
                                            </li>
                                            -->
                                        

                                           
                                            <?php if($u->administracion):?>
                                                        <li class="<?php if($_GET['view']=='users'){ echo 'active';} ?>">
                                                        
                                                          <a href="#"><i class='fa fa-cog'></i> <span>Administracion</span> </a>
                                                          <ul>
                                                            <li><a href="./?view=users"><i class="fa fa-caret-right"></i> Usuarios</a></li>
                                                            <li><a href="./?view=trabajadores"><i class="fa fa-caret-right"></i> Trabajadores</a></li>


                                                            <li><a href="./?view=configuracion"><i class="fa fa-caret-right"></i> Configuración</a></li>
                                                            <li><a href="./?view=tipo_comprobante"><i class="fa fa-database"></i> Tipo de comprobantes</a></li>
                                                            <li><a href="./?view=tiraje_comprobantes"><i class="fa fa-database"></i> Tiraje de comprobantes</a></li>


                                                            <!--
                                                             <li><a href="./?view=configuracion"><i class="fa fa-caret-right"></i> Configurar</a></li>
                                                            -->
                                                          </ul>
                                                        </li>
                                            <?php endif;?>
                                            
                                            <li >
                                                        
                                                <a href="./logout.php"><i class='fa fa-sign-out'></i> <span>Salir</span> </a>
                                                          
                                            </li>

                                        </ul>
                                        <!--/ NAVIGATION Content -->
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            
                           
                        </div>

                    </div>


                </aside>
                <!--/ SIDEBAR Content -->


            </div>
            <!--/ CONTROLS Content -->

<?php endif;?>


         
              <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["client_id"])):?>
                <section id="content">
                <div class="page page-sidebar-xs-layout">

                    <?php View::load("reserva");?>

                </div>
                </section>
              <?php else:?>

                
<style type="text/css">

    html,body {
        height: 100%;
        background: #fff;
        overflow: hidden;
    }

</style>


<script type="text/javascript" src="css/wow/wow.js"></script>
<script type="text/javascript">
    /* WOW animations */

    wow = new WOW({
        animateClass: 'animated',
        offset: 100
    });
    wow.init();
</script>

<!--
<img src="assets/images/bg//blurred-bg-3.jpg" class="login-img wow fadeIn" alt="">

 <!-- col -->
                        <div class="page page-core page-login col-md-6">

                            <!-- tile -->
                            <section class="tile container w-420 p-15 mt-40 ">

                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <!--
                                   <center> <img src="img/logo.jpg" width="50%"></center>
                                    -->
                                    <?php 
                        $configuracion = ConfiguracionData::getAllConfiguracion(); 

                         

                        if(@count($configuracion)>0){ 
                          $nombre=$configuracion->nombre;
                          $logo=$configuracion->logo;
                         
                          ?>
                         
                         

                        <?php }else{
                          $nombre='';
                          $logo='';
                         ?>
                           
                        <?php }
                        ?>

                                    <center><h1><b>SISTEMA HOTEL</b></h1><br><?php if($logo!=''){ ?><img width="50%" src="img/<?php echo $logo; ?>"><?php }; ?></center>


                                </div>
                                <!-- /tile header -->
 
                                <!-- tile body -->
                                <div class="tile-body">

                                    <form role="form" action="./?action=processlogin" method="post"> 
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Usuario</label>
                                            <input type="text" class="form-control" required="" id="exampleInputEmail1" placeholder="Ingrese su usuario" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" name="password" required="" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                        </div>
                                        <label class="checkbox checkbox-custom">
                                            <input type="checkbox" checked disabled><i></i>
                                            Mantener abierto
                                        </label>
                                        <div class="form-group">
                                                <button type="submit" style="background-color: #2fcc71;color: white;" class="btn btn-rounded btn-primary btn form-control">Ingresar</button>
                                            
                                        </div>
                                    </form>
 
                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->


      <?php endif;?>

            
            <!--/ CONTENT -->






        </div>


       <?php if(isset($_GET['view'])){ ?>
        <?php if($_GET['view']!='reserva' and $_GET['view']!='proceso' and $_GET['view']!='proceso_venta' and $_GET['view']!='reporte_fecha_circular' and $_GET['view']!='cierre_caja' and $_GET['view']!='reporte_rango'){ ?>
        <script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>
        <?php }; ?>
        <?php }else if(!isset($_SESSION["user_id"])) { ?>
<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>

        <?php }?>

        
 
        <script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>

        <script src="assets/js/vendor/jRespond/jRespond.min.js"></script> 

        <script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>

        <script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>

        <script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>

        <script src="assets/js/vendor/screenfull/screenfull.min.js"></script>

        <script src="assets/js/vendor/owl-carousel/owl.carousel.min.js"></script>

        <script src="assets/js/vendor/daterangepicker/moment.min.js"></script>

        <script src="assets/js/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

       
        <script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>
       

        <script src="assets/js/vendor/summernote/summernote.min.js"></script>

        <script src="assets/js/vendor/coolclock/coolclock.js"></script>
        <script src="assets/js/vendor/coolclock/excanvas.js"></script>
        <script src="assets/js/vendor/footable/footable.all.min.js"></script>

        <script src="assets/js/main.js"></script>







       

    </body>


</html>
