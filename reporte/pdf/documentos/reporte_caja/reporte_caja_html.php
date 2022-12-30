<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.pumpkin{
    background:#8BC34A;
    padding: 4px 4px 4px;
    color:white;
    font-weight:bold;
    font-size:12px;
}
.silver{
    background:#bdc3c7;
    padding: 3px 4px 3px;
    border-bottom: black 1px solid;
    border-left:black 1px solid;
}
.clouds{
    background:#ecf0f1;
    padding: 3px 4px 3px;
    border-bottom: black 1px solid;
    border-left:black 1px solid;
}
.border-top{
    border-top: solid 1px #bdc3c7;
    
}
.border-left{
    border-left: solid 1px #bdc3c7;
}
.border-right{
    border-right: solid 1px #bdc3c7;
}
.border-bottom{
    border-bottom: solid 1px #bdc3c7;
}

.tr{
    style="color: black; background-color: #d2d6de;"
}
.contenido{
    width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;
}

table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}

.contenido {    
    font-size: 12px;    margin: 0px;     width: 480px; text-align: left;    border-collapse: collapse; }

th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
    color: #669;    border-top: 1px solid transparent; }

tr:hover td { background: #d0dafd; color: #339; }
-->
</style>



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

                          $id=$configuracion->id;
                         

    }else{
                          $nombre='';
                          $direccion='';
                          $estado='';
                          $telefono='';
                          $fax='';
                          $rnc='';
                          $registro_empresarial='';
                          $ciudad='';
                          $id=0; 
    };
?>

<?php 
     date_default_timezone_set('America/Lima');
     $hoy = date("Y-m-d");
     $hora = date("H:i:s");
                    
?>
<?php $caja=CajaData::getById($_GET['id']); ?>
<page backtop="15mm" backbottom="28mm" backleft="5mm" backright="5mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer" style="padding-bottom:10px;">
            <tr>

                <td style="width: 80%; text-align: right; height:3px;" >
                   <?php echo $nombre; ?>
                </td>
                <td style="width: 20%; text-align: left; height:3px;" class="pumpkin">
                   
                </td>
                
            </tr>
             <tr>

                <td style="width: 80%; text-align: left">
                </td>
                <td style="width: 20%; text-align: right; font-size:12px;" >
                  <?php echo $direccion; ?><br />
                  Móvil <?php echo $telefono; ?> <br />RUC:<?php echo $rnc; ?><br />
                </td>
                
            </tr>
        </table>
    </page_footer>
   
    <table cellspacing="0" style="width: 100%; border: solid 0px #7f8c8d; text-align: center; font-size: 10pt;padding:1mm; padding-top: 0mm !important;">
        <tr >
            
            <th class="pumpkin" style="width: 40%; border: black 1px solid">INFORME DE CIERRE DE CAJA </th>
           
            
        </tr>
  
        <tr>
            
             <td  style="width: 40%; text-align: center;border:black 1px solid;"><br><b><?php echo $caja->fecha_apertura.' - '.$caja->fecha_cierre; ?></b></td>
           
        </tr>
   
    </table>


  










<?php 
     date_default_timezone_set('America/Lima');
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



<?php $caja_abierta=CajaData::getById($_GET['id']); ?>

<?php $id_caja=$caja_abierta->id; ?>


  <!-- col -->
  <div class="col-md-4">
   
      <div class="tile-header dvd dvd-btm">  
        <h2 class="custom-font"><strong>INGRESOS </strong> </h2>
      </div>
      <!-- tile body -->
      <div class="tile-body">
         <?php $ingreso=0; $ingreso_efectivo=0; ?> 
        <?php $tipos = TipoPagoData::getAllSC5();
          if(count($tipos)>0){
                  // si hay usuarios
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">

                  <tr style="color: white; background-color: #827e7e;">
                        <th>TIPO DOCUMENTO</th> 
                        <th>SUBTOTAL</th>
                  </tr>
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

      
      
   
  </div>  


<div class="col-md-4">
   
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
      
   
  </div>
    <!-- col -->


  <div class="col-md-4">
   
      <div class="tile-header dvd dvd-btm">  
        <h2 class="custom-font"><strong>EGRESOS </strong> </h2>
      </div>
      <!-- tile body -->
      <div class="tile-body">
        <table    class="footable table table-custom" style="font-size: 11px;">

          <tr style="color: white; background-color: #827e7e;">
              <th>CONCEPTO</th> 
              <th>SUBTOTAL</th>
          </tr>
           
          <?php $montos_sin_cerrar_egresos = GastoData::getEgresoCaja($id_caja);
                $total_sin_cerrar_egreso=0;
                if(count($montos_sin_cerrar_egresos)>0){
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
          if(count($reporproducts_es)>0){ ?>
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
                if(count($egreso_comisions)>0){
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
                if(count($egreso_trabajadores)>0){
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
      
   
  </div>
    <!-- col -->
  <div class="col-md-4">

      <div class="tile-header dvd dvd-btm">  
        <h2 class="custom-font"><strong>RESUMEN </strong> SALDO TOTAL</h2>
      </div>
      <!-- tile body -->
      <div class="tile-body">
        <?php $tipos1 = TipoPagoData::getAll();
          if(@count($tipos1)>0){
                  // si hay usuarios 
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">

                  <tr style="color: white; background-color: #827e7e;">
                        <th>TIPO DOCUMENTO</th> 
                        <th>SUBTOTAL</th>
                  </tr> 
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
                        <td><?php echo ($total_venta7+$total_proceso7)-$egreso+$caja_abierta->monto_apertura+$total_otros_ingresos; ?></td>
                        <?php } else{ ?>
                        <td><?php echo $total_venta7+$total_proceso7; ?></td>
                        <?php }; ?>
                      </tr>  
                    <?php endforeach; ?>
                  </table>

          <?php }else{  echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>"; } ?>
      </div>
      
  
  </div>    










</page>

