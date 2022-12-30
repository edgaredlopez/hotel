<?php

$cajas = CajaData::getAllAbierto(); 
if(@count($cajas)>0){ $id_caja=$cajas->id;
}else{$id_caja=0;} 

if($id_caja!=0){

$caja_abierta=CajaData::getById($id_caja); ?>


<?php $ingreso=0; $ingreso_efectivo=0;
$tipos = TipoPagoData::getAll();
if(@count($tipos)>0){
  foreach($tipos as $tipo):?>

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

                        
                        <?php $ingreso=($total_venta+$total_proceso)+$ingreso; ?>
                        <?php if($tipo->id=='1'){ $ingreso_efectivo=($total_venta+$total_proceso)+$ingreso_efectivo;} ?>
                       
                    <?php endforeach; ?>
                  

<?php }else{ $ingreso=0; $ingreso_efectivo=0; } ?>
 

<!-- EGRESOS -->
           
<?php $montos_sin_cerrar_egresos = GastoData::getEgresoCaja($id_caja);
                $total_sin_cerrar_egreso=0;
                if(@count($montos_sin_cerrar_egresos)>0){
                  foreach($montos_sin_cerrar_egresos as $montos_sin_cerrar_egreso):
                    $total_sin_cerrar_egreso=$montos_sin_cerrar_egreso->precio+$total_sin_cerrar_egreso;
                  endforeach;
                } 
?>


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



          <?php $egreso_comisions = ProcesoPagoComisionistaData::getEgresoCaja($id_caja);
                $total_comision=0;
                if(@count($egreso_comisions)>0){
                  foreach($egreso_comisions as $egreso_comision):
                    $total_comision=$egreso_comision->monto+$total_comision;
                  endforeach;
                } 
          ?>


          <?php $egreso_trabajadores = ProcesoSueldoData::getSueldoCajaResumen($id_caja);
                $total_trabajador=0;
                if(@count($egreso_trabajadores)>0){
                  foreach($egreso_trabajadores as $egreso_trabajador):
                    $total_trabajador=$egreso_trabajador->monto+$total_trabajador;
                  endforeach;
                } 
          ?>

        <?php $egreso=$total_trabajador+$total_comision+$subtotal4+$total_sin_cerrar_egreso; ?>

<!-- LO QUE QUEDA -->
    
        <?php $efectivo=0; $tipos1 = TipoPagoData::getAll();
          if(@count($tipos1)>0){ ?>

                   <?php foreach($tipos1 as $tipo7):?>

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
                        <?php $efectivo= ($total_venta7+$total_proceso7)-$egreso; ?>
                        <?php } else{ ?>
                        
                        <?php }; ?>
                      </tr>  
                    <?php endforeach; ?>
            

          <?php }else{ $efectivo=0; } 




date_default_timezone_set('America/Lima');
  $hoy = date("Y-m-d"); 
  $hora = date("H:i:s");





 $start = $_POST['start'];
 $end = $_POST['end'];
	

$id=$_POST["id_comisionista"];
if(@count($_POST)>0 and $_POST["monto"]<=$efectivo){
	
if(@count($_POST)>0 and ($_POST['pago']+$_POST['monto'])<=$_POST['corresponde']){

   
	$cajas = CajaData::getAllAbierto(); 
 	if(@count($cajas)>0){ $id_caja=$cajas->id;
 	}else{$id_caja='NULL';}

	$proceso = new ProcesoPagoComisionistaData();
	$proceso->id_comisionista = $_POST['id_comisionista'];
    $proceso->id_caja = $id_caja;
    $proceso->monto = $_POST['monto'];
    $proceso->fecha = $_POST['end'];
	$proceso->add();  
 


print "<script>window.location='index.php?view=proceso_sueldo_comision&id=$id&start=$start&end=$end';</script>";


}else{
print "<script>alert('Monto excedido. El pago tiene que ser menor de los acumulado');</script>";
print "<script>window.location='index.php?view=proceso_sueldo_comision&id=$id&start=$start&end=$end';</script>";	
}


}else{
print "<script>alert('No hay suficiennte dinero en caja para procesar el gasto');</script>"; 
print "<script>window.location='index.php?view=sueldo_comisionista';</script>";
};


}else{
  echo "<p class='danger'>No tiene ninguna caja abierta</p>";
  print "<script>window.location='index.php?view=sueldo_comisionista';</script>";
};
 
?>