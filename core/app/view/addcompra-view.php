<?php
$session_id= session_id();
$cajas = CajaData::getAllAbierto(); 
if(@count($cajas)>0){ $id_caja=$cajas->id;
}else{$id_caja=0;} 

if($id_caja!=0){ 


$cajas = CajaData::getAllAbierto();  

$id_caja=$cajas->id;?>
    
                                                 
                                            <?php $ingreso=0; $ingreso_efectivo=0; $ingreso_efectivo_prod=0;
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
                                            <?php if($tipo->id=='1'){ $ingreso_efectivo=($total_proceso)+$ingreso_efectivo;} ?>
                                            <?php if($tipo->id=='1'){ $ingreso_efectivo_prod=($total_venta)+$ingreso_efectivo_prod;} ?>
                                            
                                           
                                        <?php endforeach; ?>
                                      

                                        <?php }else{ $ingreso=0; $ingreso_efectivo=0; } ?>


                                    <?php $otros_ingresos = GastoData::getIngresoNuevoCaja($id_caja);
                                    $total_otros_ingresos=0;
                                    if(@count($otros_ingresos)>0){
                                      foreach($otros_ingresos as $otros_ingreso):
                                         if($otros_ingreso->id_tipopago=='1'){
                                            $total_otros_ingresos=$otros_ingreso->precio+$total_otros_ingresos;
                                         }else
                                         {
                                            $total_otros_ingresos_tarjeta=$otros_ingreso->precio+$total_otros_ingresos; 
                                         }
                                        
                                      endforeach;
                                    } ?>
                     

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
                              
                              $reporproducts_es = ProcesoVentaData::getEgresoCaja($id_caja);
                              $subtotal4=0;
                              if(@count($reporproducts_es)>0){ ?>
                                  <?php foreach($reporproducts_es as $reporproduct_e):?>
                                      <?php $subtotal1=$reporproduct_e->cantidad*$reporproduct_e->precio; ?>
                                  <?php $subtotal4=$subtotal1+$subtotal4; ?>
                                  <?php endforeach; ?>
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

                            <?php $egreso=$total_trabajador+$total_comision+$subtotal4+$total_sin_cerrar_egreso; 
                            





$totalll=0;
$comtotal=0;
$tmps = TmpData::getAllTemporalCompra($session_id);
foreach($tmps as $p1): 
    $totalll=($p1->precio_tmp*$p1->cantidad_tmp)+$totalll; 
endforeach; 

$total_efectivooo=($ingreso_efectivo+$ingreso_efectivo_prod)-$egreso+$total_otros_ingresos+$cajas->monto_apertura;

if($_POST["contado"]=='4'){ $comtotal=0; }else{ $comtotal=$totalll;  }
if(@count($tmps)>0 and $comtotal<=$total_efectivooo){

if(@count($tmps)>0){

 
 
  
  $cajas = CajaData::getAllAbierto(); 
  if(@count($cajas)>0){ $id_caja=$cajas->id;
  }else{$id_caja='NULL';}

  $total=0;
  $tmpes = TmpData::getAllTemporalCompra($session_id); 
  foreach($tmpes as $p): 
    $total=($p->precio_tmp*$p->cantidad_tmp)+$total;
  endforeach;
  
    $venta = new VentaData();  
    $venta->id_tipo_comprobante= $_POST['id_tipo_comprobante'];
    $nro_comprobante="NULL";
    if($_POST["nro_comprobante"]!=""){ $nro_comprobante=$_POST["nro_comprobante"];}
    $venta->nro_comprobante = $nro_comprobante;
    $venta->id_proveedor=$_POST["id_proveedor"];
    $venta->id_tipo_pago=$_POST["contado"];
    $venta->total= $total;
    $venta->id_usuario = $_SESSION["user_id"];
    $venta->id_caja = $id_caja;
    $nro_credito="0";
    if($_POST["nro_credito"]!=""){ $nro_credito=$_POST["nro_credito"];}
    $venta->nro_credito = $nro_credito;

    $credito="0";
    if($_POST["contado"]=='4'){ $credito=1;}
    $venta->credito = $credito;

    $v=$venta->addCompra();


  $tmps = TmpData::getAllTemporalCompra($session_id); 
  foreach($tmps as $p): 
     
    $procesoventa = new ProcesoVentaData();  
    $procesoventa->id_producto=$p->id_producto;
    $procesoventa->id_caja=$id_caja; 
    $procesoventa->id_usuario=$_SESSION["user_id"];
    $procesoventa->id_venta=$v[1];
    $procesoventa->cantidad=$p->cantidad_tmp;
    $procesoventa->precio=$p->precio_tmp; 
    $procesoventa->tipo_operacion=$p->tipo_operacion; 
    $procesoventa->id_tipopago=$_POST["contado"];


    $procesoventa->addCompra();
  endforeach;
   
  $dels = TmpData::getAllTemporalCompra($session_id);
  foreach($dels as $del):
    $eliminar = TmpData::getById($del->id_tmp);
    $eliminar->del();
  endforeach;


print "<script>window.location='index.php?view=kardex';</script>";




}else{ ?>
  <script type="text/javascript">
  alert("Alerta!! No se agregó ningún producto");
</script>
<?php 
print "<script>window.location='index.php?view=compra';</script>";

} } else{
print "<script>alert('No hay suficiente dinero en caja para procesar el gasto $total_efectivooo ');</script>"; 
print "<script>window.location='index.php?view=compra';</script>";
}


}else{
  echo "<p class='danger'>No tiene ninguna caja abierta</p>";
  print "<script>window.location='index.php?view=compra';</script>";
};
?>

