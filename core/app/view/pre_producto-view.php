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



<div class="row">
     <div class="breadcrumb col-lg-12">
        <div style="background-color: #16a085;color: white;padding: 2px;font-size: 20px;
        text-align: center; text-transform: uppercase;font-weight: bold;width: 100%;">
          <span>
          LISTA DE ENTRADAS </span>
          </div>
        </div>
    </div>

 <!-- row --> 
<div class="row"> 
  <!-- col -->
  <div class="col-md-12">


    <section class="tile">
      <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong> SELECCIONA UNA ENTRADA</strong> </h1>
        
      </div>
      <div class="tile-body"> 
          <div class="row">
           

                  <?php $categorias = CategoriaProData::getAll();
                  if(@count($categorias)>0){ ?> 
                   <?php foreach($categorias as $categoria):?>
                   <a href="index.php?view=productos&id=<?php echo $categoria->id; ?>">
                  <div class="col-lg-3 col-xs-12">
                    <section class="tile bg-primary widget-appointments">
                                <div class="tile-body" style="padding: 1px;">
                                   <h4 style="text-align: center; "><?php echo $categoria->nombre; ?></h4>
                                </div>
                     </section>
                    </div>
                    </a>
                     <?php endforeach; ?> 
            

               <?php }else{ "";} ?>

        </div>
      </div>
    
</section>
</div>

<?php
}else{
  echo "<p class='danger'>No tiene ninguna caja abierta</p>";
 
};
 
?>


