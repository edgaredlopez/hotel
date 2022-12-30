<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">

<?php 
     date_default_timezone_set('America/Guatemala');
     $hoy = date("Y-m-d");
     $hora = date("H:i:s");
                    
?>

<style type="text/css">
  table.dataTable thead .sorting:after {
    opacity: 0.0;
    content: "\e150";
}

table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after {
    opacity: 0.0;
}
</style>
 

<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="#">Reportes</a></li>
      <li class="active">Reporte de caja</li>
    </ol>
</section> 
</div> 






<style type="text/css">
  
  .hh:hover{
    background-color: white;
  }
  .small-box-footer {
    position: relative;
    text-align: center;
    padding: 0px 0;
    color: #fff;
    color: rgba(255,255,255,0.8);
    display: block;
    z-index: 10;
    background: rgba(0,0,0,0.1);
    text-decoration: none;
}
.nav-tabs-custom>.nav-tabs>li>a {
    color: #3c8dbc;
    font-weight: bold;
    border-radius: 0 !important;
}
.nav-tabs-custom>.nav-tabs>li.active {
    border-top-color: #00a65a;
}
.h5, h5 {
    margin-top: 0px;
    margin-bottom: 0px;
}
</style>

 

<br>

<?php $cajas = CajaData::getAllAbierto(); 
      if(@count($cajas)>0){ $id_caja=$cajas->id;
      }else{$id_caja=0;} 


if($id_caja!=0){
?>

<?php $caja_abierta=CajaData::getById($id_caja); ?>



<!-- row --> 
<div class="row">
  <!-- col -->
  <div class="col-md-4">
    <section class="tile">
      <div class="tile-header dvd dvd-btm">  
        <h1 class="custom-font"><strong>INGRESOS </strong> </h1>
      </div>
      <!-- tile body -->
      <div class="tile-body">
         <?php $ingreso=0; $ingreso_efectivo=0; ?> 
        <?php $tipos = TipoPagoData::getAllSC5();
          if(@count($tipos)>0){
                  // si hay usuarios
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">

                  <thead style="color: white; background-color: #827e7e;">
                        <th>TIPO DOCUMENTO</th> 
                        <th>SUBTOTAL</th>
                  </thead>
                  <tr>
                    <td>MONTO APERTURA</td>
                    <td><?php echo $caja_abierta->monto_apertura; ?></td>
                  </tr>


                   <?php foreach($tipos as $tipo):?>
                      <tr> 
                        <td><?php echo $tipo->nombre; ?></td>

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

                        <td><?php echo $total_venta+$total_proceso; ?></td>
                        <?php $ingreso=($total_venta+$total_proceso)+$ingreso; ?>
                        <?php if($tipo->id=='1'){ $ingreso_efectivo=($total_venta+$total_proceso)+$ingreso_efectivo;} ?>
                      </tr>  
                    <?php endforeach; ?>
                  </table>

          <?php }else{  echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>"; } ?>
      </div>

      
      
    </section>
  </div>  


  <div class="col-md-4">
   <section class="tile">
      <div class="tile-header dvd dvd-btm">  
        <h2 class="custom-font"><strong>OTROS INGRESOS </strong> </h2>
      </div>
      <!-- tile body -->
      <div class="tile-body">
        <table    class="footable table table-custom" style="font-size: 11px;">

          <tr style="color: white; background-color: #827e7e;">
              <th>CONCEPTO</th> 
              <th>SUBTOTAL</th>
          </tr>
            
          <?php $otros_ingresos = GastoData::getIngresoNuevoCaja($id_caja);
                                    $total_otros_ingresos=0;
                                    if(@count($otros_ingresos)>0){
                                      foreach($otros_ingresos as $otros_ingreso):
                                        $total_otros_ingresos=$otros_ingreso->precio+$total_otros_ingresos;
                                      endforeach;
                                    } ?>

         
          
          


          <tr>
            <td>TOTAL</td>
            <td><?php echo $total_otros_ingresos; ?></td>
          </tr> 
          
        </table>
        <?php $otro_ingreso=$total_otros_ingresos; ?>
      </div>
      </section>
   
  </div>
    <!-- col -->

  <div class="col-md-4">
    <section class="tile">
      <div class="tile-header dvd dvd-btm">  
        <h1 class="custom-font"><strong>EGRESOS </strong> </h1>
      </div>
      <!-- tile body -->
      <div class="tile-body">
        <table    class="footable table table-custom" style="font-size: 11px;">

          <thead style="color: white; background-color: #827e7e;">
              <th>CONCEPTO</th> 
              <th>SUBTOTAL</th>
          </thead>
           
          <?php $montos_sin_cerrar_egresos = GastoData::getEgresoCaja($id_caja);
                $total_sin_cerrar_egreso=0;
                if(@count($montos_sin_cerrar_egresos)>0){
                  foreach($montos_sin_cerrar_egresos as $montos_sin_cerrar_egreso):
                    $total_sin_cerrar_egreso=$montos_sin_cerrar_egreso->precio+$total_sin_cerrar_egreso;
                  endforeach;
                } 
          ?>

          <tr>
            <td>GASTOS O PAGOS PROVEEDOR</td>
            <td><?php echo $total_sin_cerrar_egreso; ?></td>
          </tr> 

          <?php  
          if($id_caja!=0){ 
          $reporproducts_es = ProcesoVentaData::getEgresoCaja($id_caja);
          $subtotal4=0;
          if(@count($reporproducts_es)>0){ ?>
              <?php foreach($reporproducts_es as $reporproduct_e):?>
                  <?php $subtotal1=$reporproduct_e->cantidad*$reporproduct_e->precio; ?>
              <?php $subtotal4=$subtotal1+$subtotal4; ?>
              <?php endforeach; ?>
          <?php }else{$subtotal4=0;} ?>
          <?php }else{$subtotal4=0;} ?>

          <tr>
            <td>COMPRA DE PRODUCTOS</td>
            <td><?php echo $subtotal4; ?></td>
          </tr>

          <?php $egreso_comisions = ProcesoPagoComisionistaData::getEgresoCaja($id_caja);
                $total_comision=0;
                if(@count($egreso_comisions)>0){
                  foreach($egreso_comisions as $egreso_comision):
                    $total_comision=$egreso_comision->monto+$total_comision;
                  endforeach;
                } 
          ?>

          <tr>
            <td>PAGOS A COMISIONISTAS</td>
            <td><?php echo $total_comision; ?></td>
          </tr> 

          <?php $egreso_trabajadores = ProcesoSueldoData::getSueldoCajaResumen($id_caja);
                $total_trabajador=0;
                if(@count($egreso_trabajadores)>0){
                  foreach($egreso_trabajadores as $egreso_trabajador):
                    $total_trabajador=$egreso_trabajador->monto+$total_trabajador;
                  endforeach;
                } 
          ?>


          <tr>
            <td>SUELDO AL TRABAJADOR</td>
            <td><?php echo $total_trabajador; ?></td>
          </tr> 
          
        </table>
        <?php $egreso=$total_trabajador+$total_comision+$subtotal4+$total_sin_cerrar_egreso; ?>
      </div>
      
    </section>
  </div>
    <!-- col -->
  <div class="col-md-4">
    <section class="tile">
      <div class="tile-header dvd dvd-btm">  
        <h1 class="custom-font"><strong>RESUMEN </strong> SALDO TOTAL</h1>
      </div>
      <!-- tile body -->
      <div class="tile-body">
        <?php $tipos1 = TipoPagoData::getAll();
          if(@count($tipos1)>0){
                  // si hay usuarios 
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">

                  <thead style="color: white; background-color: #827e7e;">
                        <th>TIPO DOCUMENTO</th> 
                        <th>SUBTOTAL</th>
                  </thead> 
                   <?php foreach($tipos1 as $tipo7):?>
                      <tr> 
                        <td><?php echo $tipo7->nombre; ?></td>

                        <?php $total_proceso7=0; ?>
                        <?php $tmps7 = PagoProcesoData::getAllCajaTipoDocumento($id_caja,$tipo7->id); 
                        foreach($tmps7 as $p7):  ?>
                        <?php $total_proceso7=$total_proceso7+$p7->monto; ?>
                        <?php endforeach; ?>


                        <?php $total_venta7=0; ?>
                        <?php $ventas7 = ProcesoVentaData::getIngresoCajaTipoDocumento($id_caja,$tipo7->id); 
                        foreach($ventas7 as $venta7):  ?>
                        <?php $total_venta7=$total_venta7+($venta7->precio*$venta7->cantidad); ?>
                        <?php endforeach; ?>

                         <?php if($tipo7->id=='1'){ ?>
                        <td><?php echo ($total_venta7+$total_proceso7)-$egreso+$caja_abierta->monto_apertura+$otro_ingreso; ?></td>
                        <?php } else{ ?>
                        <td><?php echo $total_venta7+$total_proceso7; ?></td>
                        <?php }; ?>
                      </tr>  
                    <?php endforeach; ?>
                  </table>

          <?php }else{  echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>"; } ?>
      </div>
      
    </section>
  </div>    
</div>







<?php }else{
  echo "<p class='danger'>No tiene ninguna caja abierta</p>";
} ?>


       <script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>
        <script src="assets/js/vendor/jRespond/jRespond.min.js"></script>
        <script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
        <script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
        <script src="assets/js/vendor/screenfull/screenfull.min.js"></script>
        <script src="assets/js/vendor/footable/footable.all.min.js"></script>
        <script src="assets/js/main.js"></script>
         <script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>
 <script>
            $(window).load(function(){

                $('.footable').footable();

            });
</script>  
