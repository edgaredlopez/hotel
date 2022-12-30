<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">

<?php

$cajas = CajaData::getAllAbierto(); 
if(@count($cajas)>0){ $id_caja=$cajas->id;
}else{$id_caja=0;} 

if($id_caja!=0){


date_default_timezone_set('America/Lima');
     $hoy = date("Y-m-d"); 
   $hora = date("H:i:s");
   $doce = date("12:00:00");
   $fecha_completa= date("Y-m-d H:i:s");
?>

<style>
    @media only screen and (max-width: 768px)
.appWrapper.header-fixed.aside-fixed #content {
    top: 45px !important;
}
</style>
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
 
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      <li class="active"><a href="#">recepción</a></li>
      <li class="remove">
            <a style="color: #f0ad4e;" href="index.php?view=recepcion&id=4"><i class="fa fa-arrow-circle-left" style="color: #f0ad4e;"></i> Mantenimiento</a> 
      </li>
      <li class="remove">
            <a style="color: #16a085;" href="index.php?view=recepcion&id=1"><i class="fa fa-arrow-circle-left" style="color: #16a085;"></i> Disponible</a> 
          </li>
          <li class="remove">
            <a style="color: #5bc0de;" href="index.php?view=recepcion&id=3"><i class="fa fa-spinner" style="color: #5bc0de;"></i> Limpieza</a> 
          </li>
          <li class="remove">
            <a style="color: #d9534f;" href="index.php?view=recepcion&id=2"><i class="fa fa-arrow-circle-right" style="color: #d9534f;"></i> Ocupado </a>
          </li>
    </ol>
    
</section>  
</div> 



 <!-- row --> 
<div class="row"> 
  <!-- col -->
  <div class="col-md-12">


              <?php $reportediarios = ProcesoData::getReporteDiario($hoy);
                if(@@count($reportediarios)>0){ ?>
                  
                   <?php $numero=0;?>
                   <?php $total=0;?>
                   <?php foreach($reportediarios as $reportediario):?>
                   <?php $numero=$numero+1;?>
                     
                        
                        <?php $subtotal= ($reportediario->precio*$reportediario->cant_noche)+$reportediario->total+$reportediario->extra; ?>
                        
                            <?php $total=$subtotal+$total; ?>
                    <?php endforeach; ?>

                     

               <?php }else{ $total=0;};?>


    <section class="tile">
      <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong> VISTA GENERAL</strong> RECEPCIÓN</h1>
        <ul class="controls">


           <?php $niveles = NivelData::getAll();?>

              <?php foreach($niveles as $nivel):?>

                <li class="remove">
                  <a <?php if(isset($_GET['nivel']) and $nivel->id==$_GET['nivel']){ ?> style="color: red;" <?php }else{ ?> style="color: #f0ad4e;" <?php  }; ?> href="index.php?view=recepcion&nivel=<?php echo $nivel->id; ?>"><i class="fa fa-arrow-circle-left" <?php if(isset($_GET['nivel']) and $nivel->id==$_GET['nivel']){ ?> style="color: red;" <?php }else{ ?> style="color: #f0ad4e;" <?php  }; ?> ></i> <?php echo $nivel->nombre; ?></a>
                </li>

                
              <?php endforeach;?> 


          <!--

          <li class="remove">
            <a style="color: blue;"><i class="fa fa-arrow-circle-right" style="color: blue;"></i> $  <?php echo number_format($total,2,'.',','); ?> </a>
          </li>
        -->
          
        </ul>
      </div>
      <div class="tile-body">
          <div class="row">
            <?php if(isset($_GET['buscar']) and $_GET['buscar']!=""){ ?>
                  <?php $cliente=PersonaData::getLike($_GET['buscar']); ?>

                  <?php $procesos = ProcesoData::getProcesoCliente($cliente->id);
                  if(@@count($procesos)>0){ ?> 
                   <?php foreach($procesos as $proceso):?>
                  <div class="col-lg-2 col-xs-6">
                    <section class="tile bg-danger widget-appointments">
                       <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font" style="font-size: 12px;">Ocupado</h1>
                                    <ul class="controls"> 
                                      <li ><a  href="index.php?view=proceso_salida&id=<?php echo $proceso->id; ?>">
                                            <i class="fa fa-arrow-circle-right"></i>  </a>
                                      </li>
                                    </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body" style="padding: 1px;">
                                   <h4 style="text-align: center; "><?php echo $proceso->getHabitacion()->nombre; ?></h4>
                                </div>
                                <!-- /tile body -->
                     </section>
                    </div>
                     <?php endforeach; ?> 
            

               <?php }else{ echo"<h4 class='alert alert-success'>No se encontró Huesped en ninguna habitación</h4>";};
                ?>

            <?php }else{ ?> 

            <?php 
            if(isset($_GET['id']) and $_GET['id']=='1'){ $habitaciones = HabitacionData::getLibres(); }
            else if(isset($_GET['id']) and $_GET['id']=='2'){ $habitaciones = HabitacionData::getOcupados(); }
            else if(isset($_GET['id']) and $_GET['id']=='3'){ $habitaciones = HabitacionData::getLimpieza(); }
            else if(isset($_GET['id']) and $_GET['id']=='4'){ $habitaciones = HabitacionData::getMantenimiento(); }
            else if(isset($_GET['nivel']) and $_GET['nivel']!=''){ $habitaciones = HabitacionData::getAllNivel($_GET['nivel']);}
            else{ $habitaciones = HabitacionData::getAll(); }                   
                          if(@@count($habitaciones)>0){ 
                            // si hay usuarios 
                            ?>
                   <?php foreach($habitaciones as $habitacion):?>
                
                    <div class="col-lg-2 col-xs-6">
                      <!-- small box -->
                      <?php if($habitacion->estado==1){?> 
                      <?php $procesoLimpio = ProcesoData::getByRecepcionReserva($habitacion->id,$hoy);?>
                      <section class="tile bg-greensea widget-appointments">
                          
                          <?php $tarifas_hab = TarifaHabitacionData::getAllHabitacion($habitacion->id);?>
                                        
                                          <a href="index.php?view=proceso&id_habitacion=<?php echo $habitacion->id; ?>">
                                            

                                        
                       
                      <?php } else if($habitacion->estado==2){?>
                      <?php $proceso = ProcesoData::getByRecepcion($habitacion->id);?>
                      <section class="tile bg-danger widget-appointments">
                          <?php if($proceso->mensual=='1')
                          { ?>
                            <a  href="index.php?view=tablero_mensual">
                          <?php }
                          else
                          { ?>
                            <a  data-toggle="modal" data-target="#myModalCheckOut<?php echo $habitacion->id; ?>">
                          <?php } ?>
                          
                      
                      <?php } else if($habitacion->estado==3){?>
                      <section class="tile bg-info widget-appointments">
                          <a   data-toggle="modal" data-target="#myModal<?php echo $habitacion->id; ?>">
                     
                      <?php  } else if($habitacion->estado==4){?>
                      <section class="tile bg-warning widget-appointments">
                          
                          <a  >
                     
                      <?php  }; ?>
 
                             

                            <?php if($habitacion->estado==1){?>
                               <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font" style="font-size: 12px;"><?php if(@@count($procesoLimpio)>0){ echo "<b style='color:#eeff0b;'>RESERVADA</b>";}else{echo "Disponible";} ?><br></h1>
                                    <ul class="controls"> 
                                    <!--
                                      <li><a  data-toggle="modal" data-target="#myModalEstado<?php echo $habitacion->id; ?>">
                                            <i class="fa fa-home"></i>  </a>
                                      </li>
                                    -->
                                     
                                    </ul> 
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body" style="padding: 1px;">
                                   <h4 style="text-align: center; font-size: 12px;"><i class="fa fa-bed"></i> <?php echo $habitacion->nombre; ?></h4>
                                </div> 
                                <!-- /tile body -->
                            <?php } else if($habitacion->estado==2){?>
                            
                            
                            <?php $proceso = ProcesoData::getByRecepcion($habitacion->id);?>

                               <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font" style="font-size: 12px;"><?php if($proceso->mensual=='1'){echo "<b style='color:yellow;'>Residente</b>";}else{echo "Corta estadía";} ?>: <?php echo $habitacion->nombre; ?><br></h1>
                                    
                                </div>  
                                <!-- /tile header --> 

                                <!-- tile body -->
                                <div class="tile-body" style="padding: 1px;">
                                   <h4 style="text-align: center; font-size: 12px;"><?php echo substr($proceso->getCliente()->nombre, 0,20); ?></h4>
                                </div>
                                <!-- /tile body -->


                                
                                
                                

      
      
                                <div class="modal fade bs-example-modal-xm" id="myModalCheckOut<?php echo $habitacion->id; ?>" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog modal-info">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                                
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" style="color: black;"><span class="fa fa-hotel"></span> Habitación <?php echo $habitacion->nombre; ?>
                                                
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
                       
                        <b style="color:red;">
                        <?php echo '<b>Hace '.$contar_horas.'</b>H <b>'. $contar_minutos.'</b> M'; ?></b>
                                                </h4>
                                                
                                                
                                                
                       
                        
                        
                                              </div>
                                               
                                              <div class="modal-footer"> 
                                                <center>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                          <a  data-toggle="modal" data-target="#myModalAnular<?php echo $habitacion->id; ?>"  class="btn btn-outline btn-danger pull-left">ANULAR REGISTRO</a>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                          <a href="index.php?view=proceso_cambiar&id=<?php echo $proceso->id; ?>" class="btn btn-outline btn-warning pull-left"> CAMBIAR HABITACIÓN?</a>
                                                        </div>
                                                    </div>
                                                  
                                                     
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                          <a href="index.php?view=addprocesoprueba&id=<?php echo $proceso->id; ?>" class="btn btn-outline btn-primary pull-left">IR A PRE-CUENTA</a>
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
                                      
<div class="modal fade bs-example-modal-xm" id="myModalAnular<?php echo $habitacion->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                
              </div>
              
              <div class="modal-body" style="background-color:#fff !important;">
                
                <center><h3 style="color:red;"><b>¿ESTAS SEGURO?</b></h3></center>

              </div>
      
              <div class="modal-footer"> 
              <a  data-dismiss="modal"  class="close btn btn-outline btn-danger pull-left">NO</a>
              
              <a  href="index.php?view=delproceso&id=<?php echo $proceso->id; ?>&id_habitacion=<?php echo $habitacion->id; ?>" class="btn btn-outline btn-success pull-right">SÍ</a>

               
              </div>
              
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>


                            <?php } else if($habitacion->estado==3){?>
                               <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font" style="font-size: 12px;">Limpieza<br></h1>
                                    <ul class="controls"> 

                                    </ul> 
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body" style="padding: 1px;">
                                   <h4 style="text-align: center;font-size: 12px;"><?php echo $habitacion->nombre; ?></h4>
                                </div>
                                <!-- /tile body -->
                            <?php  } else if($habitacion->estado==4){?>
                               <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font" style="font-size: 12px;">Mantenimiento<br></h1>
                                    
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body" style="padding: 1px;">
                                   <h4 style="text-align: center;font-size: 12px;"><?php echo $habitacion->nombre; ?></h4>
                                </div>
                                <!-- /tile body -->
                            <?php  }; ?>
                     </a>
                      </section>

                    </div>
               

<div class="modal fade bs-example-modal-xm" id="myModalEstado<?php echo $habitacion->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-spinner"></span> CAMBIAR ESTADO DE HABITACIÓN</h4>
              </div>
              <form action="index.php?view=updateestado001" method="post">
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> ESTADO </span>
                      <select class="form-control" name="estado" required="">
                        <option value="">--- Selecciona ---</option>
                        <option value="1">Inmediata</option>
                        <option value="3">Disponible</option>
                        <option value="4">Mantenimiento</option>
                      </select>
                    </div>
                  </div>

                  
                </div>
                </div>

              </div>
              <input type="hidden" name="id_habitacion" value="<?php echo $habitacion->id; ?>">
              <div class="modal-footer"> 
                <button type="submit" class="btn btn-outline btn-primary pull-left">Cambiar estado de habitación</button>

               
              </div>
              </form>
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

                

<div class="modal fade bs-example-modal-xm" id="myModalTarifa<?php echo $habitacion->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-spinner"></span> NECESITA CONFIGURAR TARIFAS PARA ESTA HABITACIÓN</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> HABITACIÓN </span>
                      <input type="text" class="form-control col-md-8" name="nombre" disabled value="<?php echo $habitacion->nombre; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                 

                </div>
                </div>

              </div>
              <div class="modal-footer"> 
                <a href="index.php?view=ha_tarifas&id=<?php echo $habitacion->id; ?>" class="btn btn-outline btn-primary pull-left"> Agregar tarifa a la habitación</a>

               
              </div>
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>




  <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $habitacion->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-spinner"></span> ESTÁ A PUNTO DE TERMINAR LA LIMPIEZA</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> HABITACIÓN </span>
                      <input type="text" class="form-control col-md-8" name="nombre" disabled value="<?php echo $habitacion->nombre; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> TIPO </span>
                      <input type="text" class="form-control col-md-8" name="nombre" disabled value="<?php echo $habitacion->getCategoria()->nombre; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> DETALLES </span>
                      <input type="text" class="form-control col-md-8" name="nombre" disabled value="<?php echo $habitacion->descripcion; ?>" required placeholder="Ingrese nombre">
                    </div>
                  </div>

                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <a href="index.php?view=limpieza&id=<?php echo $habitacion->id; ?>" class="btn btn-outline">Finalizar limpieza</a>
              </div>
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>










                    <?php endforeach; ?>
            

               <?php }else{ 
            echo"<h4 class='alert alert-success'>Necesita agregar habitaciones en CONFIGURACIÓN</h4>";

                };
                ?>

                <?php }; ?>
          </div>

        </div>
      </div>
    
</section>
</div>
</div>
<?php
}else{
  echo "<p class='danger'>No tiene ninguna caja abierta <a href='index.php?view=apertura_caja'>ABRIR AQUÍ</a></p>";
 
};
 
?>


