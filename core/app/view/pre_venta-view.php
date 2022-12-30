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


<?php 
$u=null; 
$u = UserData::getById(Session::getUID());
?>

 <!-- row --> 
<div class="row"> 
  <!-- col -->
  <div class="col-md-12">


    <section class="tile">
      <div class="tile-header dvd dvd-btm">
        <h1 class="custom-font"><strong> CATEGORÍAS</strong> </h1>
        
      </div>
      <div class="tile-body">
          <div class="row">

           
                                        

                  <?php $categorias = CategoriaProData::getAll();
                  if(@count($categorias)>0){ ?> 
                   <?php foreach($categorias as $categoria): ?>
                    <?php if($categoria->id=='1' and $u->kiosko){?>
                   <a href="index.php?view=venta&id=<?php echo $categoria->id; ?>">
                  <div class="col-lg-3 col-xs-12">
                    <section class="tile bg-danger widget-appointments">
                                <div class="tile-body" style="padding: 1px;">
                                   <h4 style="text-align: center; "><?php echo $categoria->nombre; ?></h4>
                                </div>
                     </section>
                    </div>
                    </a>
                    <?php }else if($categoria->id=='2' and $u->cocina){ ?>
                    <a href="index.php?view=venta&id=<?php echo $categoria->id; ?>">
                    <div class="col-lg-3 col-xs-12">
                      <section class="tile bg-danger widget-appointments">
                                  <div class="tile-body" style="padding: 1px;">
                                     <h4 style="text-align: center; "><?php echo $categoria->nombre; ?></h4>
                                  </div>
                       </section>
                      </div>
                      </a>
                      <?php }else if($categoria->id=='3' and $u->lavadero){ ?>
                      <a href="index.php?view=venta&id=<?php echo $categoria->id; ?>">
                    <div class="col-lg-3 col-xs-12">
                      <section class="tile bg-danger widget-appointments">
                                  <div class="tile-body" style="padding: 1px;">
                                     <h4 style="text-align: center; "><?php echo $categoria->nombre; ?></h4>
                                  </div>
                       </section>
                      </div>
                      </a>
                      <?php }else{}; ?>
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


