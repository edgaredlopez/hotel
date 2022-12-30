<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
<?php 
date_default_timezone_set('America/Guatemala');
     $hoy = date("Y-m-d"); 
   $hora = date("H:i:s");
   $doce = date("12:00:00");
?>
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      <li class="active"><a href="#">recepción</a></li>
     
    </ol>
    
</section>  
</div> 



 <!-- row --> 
<div class="row"> 
  <!-- col -->
  <div class="col-md-12">


            

    <section class="tile">
      <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong> VISTA GENERAL</strong> RECEPCIÓN DE SERVICIOS</h1>
        <ul class="controls">


         

          <li class="remove">
            <a style="color: blue;"><i class="fa fa-arrow-circle-right" style="color: blue;"></i> Actualizar</a>
          </li>
       
          
        </ul>
      </div>
      <div class="tile-body">
          <div class="row">
           
 
                  <?php $procesos =  CategoriaProData::getAll();
                  if(@@count($procesos)>0){ ?> 
                   <?php foreach($procesos as $proceso):?>
                  <div class="col-lg-2 col-xs-6">
                    <section class="tile bg-primary widget-appointments">
                       <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font" style="font-size: 12px;">Servicio</h1>
                                    <ul class="controls"> 
                                      <li ><a  href="index.php?view=venta_servicio&id=<?php echo $proceso->id; ?>">
                                            <i class="fa fa-arrow-circle-right"></i>  </a>
                                      </li>
                                    </ul>
                                </div>
                                <!-- /tile header -->

                                <!-- tile body -->
                                <div class="tile-body" style="padding: 1px;">
                                   <h4 style="text-align: center; "><?php echo $proceso->nombre; ?></h4>
                                </div>
                                <!-- /tile body -->
                     </section>
                    </div>
                     <?php endforeach; ?> 
            

               <?php }else{ echo"<h4 class='alert alert-success'>No se encontró Huesped en ninguna habitación</h4>";};
                ?>

        </div>
               
        </div>

    
</section>
</div>
</div>


