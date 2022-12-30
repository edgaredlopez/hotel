  
<?php 
date_default_timezone_set('America/Lima');
     $hoy = date("Y-m-d"); 
   $hora = date("H:i:s");
   $doce = date("12:00:00");

$nuevafecha = strtotime ( '+1 month' , strtotime ( $hoy ) ) ;
$nuevafecha = date ( 'd/m/Y' , $nuevafecha );
?>
 
 
<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script> 
  
<script type="text/javascript">
$(function() { 
            $("#documento").autocomplete({
                source: "./?action=buscar_persona",
                minLength: 2,
                select: function(event, ui) {
          event.preventDefault();
         $('#documento').val(ui.item.documento); 
          $('#nombre').val(ui.item.nombre);
          $('#giro').val(ui.item.giro);
          $('#estado_civil').val(ui.item.estado_civil);
          $('#nacionalidad').val(ui.item.nacionalidad);
          $('#medio_transporte').val(ui.item.medio_transporte);
          $('#destino').val(ui.item.destino);
          $('#ocupacion').val(ui.item.ocupacion);
          $('#motivo').val(ui.item.motivo);
          $('#direccion').val(ui.item.direccion);
          $('#id').val(ui.item.id);
           }
            });
    }); 
</script>

<script type="text/javascript">
$(function() {
            $("#nombre").autocomplete({
                source: "./?action=buscar_persona_nombre",
                minLength: 2,
                select: function(event, ui) {
          event.preventDefault();
          $('#documento').val(ui.item.documento); 
          $('#nombre').val(ui.item.nombre);

          $('#giro').val(ui.item.giro);
          $('#estado_civil').val(ui.item.estado_civil);
          $('#nacionalidad').val(ui.item.nacionalidad);
          $('#medio_transporte').val(ui.item.medio_transporte);
          $('#destino').val(ui.item.destino);
          $('#ocupacion').val(ui.item.ocupacion);
          $('#motivo').val(ui.item.motivo);
          $('#direccion').val(ui.item.direccion);
          $('#id').val(ui.item.id);
           }
            });
    }); 
</script> 

<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      <li class="active"><a href="index.php?view=recepcion">recepción</a></li>
      <li class="active">Procesar</li>
    </ol>
</section> 
</div> 
 

    <!-- row -->
    <div class="row">
    <form  method="post" id="addproduct" action="index.php?view=addproceso_mensual" role="form">
       
        <div class="col-md-6">
             <!-- col -->
        
  
            <!-- tile -->
            <section class="tile">
                
               <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><strong>DATOS DEL </strong> CLIENTE</h1>             
                </div>
                <!-- /tile header -->
                <div class="tile-body" >   


                  <div class="form-group"> 
                    <div class="input-group">
                      <span class="input-group-addon"> Cliente&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <?php $clientes = PersonaData::getResidente();?>
                        <select name="id_cliente" id="id_cliente" required class="form-control">
                        <?php foreach($clientes as $cliente):?>
                            <option value="<?php echo $cliente->id;?>" ><?php echo $cliente->documento.' / '.$cliente->nombre;?></option>
                            <?php endforeach;?>
                        </select> 
                    </div>
                  </div>

                  <div class="form-group"> 
                    <div class="input-group"> 
                      <span class="input-group-addon"> Habitación&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <?php $habitaciones = HabitacionData::getLibres();?>
                        <select name="id_habitacion" id="id_habitacion" required class="form-control">
                        <?php foreach($habitaciones as $habitacione):?>
                            <option value="<?php echo $habitacione->id;?>" ><?php echo $habitacione->nombre;?></option>
                          <?php endforeach;?>
                        </select> 
                    </div> 
                  </div>
 
                  <div class="form-group"> 
                    <div class="input-group">
                      <span class="input-group-addon"> Fecha entrada</span>
                      <input type="date" class="form-control" name="fecha_entrada" id="fecha_entrada" value="<?php echo $hoy; ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                    </div>
                  </div>

                  <div class="form-group"> 
                    <div class="input-group">
                      <span class="input-group-addon"> Fecha salida&nbsp;&nbsp;</span>
                      <input type="text" class="form-control" name="fecha_salida" id="fecha_salida" value="<?php echo $nuevafecha; ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask disabled>
                    </div>
                  </div>

                  
              
                

                  
                    

                </div>
                    
              </section>
              
              </div>
              
              
              
              <div class="col-md-6">
                  
                  <section class="tile">
                   <div class="tile-header dvd dvd-btm">
                        <h1 class="custom-font"><strong>DATOS DEL ALOJAMIENTO </strong> CLIENTE</h1>             
                    </div> 
                    <!-- /tile header -->
                    <div class="tile-body"> 
                
                
                  <div class="form-group"> 
                    <div class="input-group">
                      <span class="input-group-addon"> Precio mensual</span>
                      <input type="number" class="form-control monto" name="precio" placeholder="Ingrese precio" value="<?php echo $tarifa->precio; ?>" onkeyup="sumar();" onchange="sumar();" id="precio" required >
                    </div>
                  </div>

                
                
                
                
                
                <input type="hidden" name="tipo_servicio" value="1" id="tipo_servicio">
                <input type="hidden" name="id_tarifa" value="4" id="id_tarifa">
                <input type="hidden" name="cantidad" value="1">

                <input type="hidden" name="tarjeta_e" value="Entregada">

                <input type="hidden" name="observacion" value="Turismo">

                <div class="form-group"> 
                    <div class="input-group">
                      <span class="input-group-addon"> -- SELECCIONE --</span>
                      <select class="form-control" name="pagado" id="pagado" onchange="this.value=this.value.replace(/\.$/, '')" >
                            <option value="1">Pago realizado</option>
                            <option value="0">Registrar sin pago</option>
                               
                        </select>
                    </div>
                  </div>

                   <div class="form-group"> 
                    <div class="input-group">
                      <span class="input-group-addon"> -- MEDIO PAGO --</span>
                      <select class="form-control" onchange="CargarMediopago(this.value);" required name="id_tipo_pago">
                    
                                  <option value="">--- Selecciona ---</option>

                                  <?php $medipagos = TipoPagoData::getAll();
                                  if(count($medipagos)>0){ ?>
                              
                                  <?php foreach($medipagos as $mediopago):?>
                                    <option value="<?php echo $mediopago->id; ?>" <?php if($mediopago->id=='1'){ echo "selected";} ?>><?php echo $mediopago->nombre; ?></option>
                                  <?php endforeach; ?>

                                  <?php }else{ };?>
                            </select> 
                    </div>
                  </div>

              

               

                
                
                <div class="form-group" id="mostrar_efectivo">
                    
                </div>
                
                <div class="form-group" id="mostrar_mediopago">
                
                </div>
                <input type="hidden" value="0" name="id_comisionista">
                
              
               
                
                
              
                
                
                 
 

    <div class="modal fade bs-example-modal-xm" id="myModalVoucher" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
                
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-spinner"></span> REGISTRAR CORRELATIVO</h4>
              </div>
              
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row"> 
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group"> 
                    <div class="input-group">
                      <span class="input-group-addon"> Tipo comprobante </span>
                      <select class="form-control" name="comprobante" >
                        <option value="NULL">--- Selecciona ---</option>
                        <option value="Voucher"  >Voucher</option>
                        <option value="Boleta" >Boleta</option>
                        <option value="Factura" >Factura</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group"> 
                    <div class="input-group">
                      <span class="input-group-addon"> Nro Comprobante </span>
                      <input type="text" class="form-control" name="nro_folio" value="NULL"  placeholder="Ejem. T-0001">
                    </div>
                  </div>

                  
                </div>
                </div>

              </div>
              
              <div class="modal-footer"> 
                <button  class="btn btn-outline btn-primary pull-left close" data-dismiss="modal">Aceptar </button>

               
              </div>
           
           
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
    

                </div>
             
                 <div class="tile-footer">
                     <div class="form-group ">
                         
                <a href="index.php?view=recepcion" class="btn btn-danger">Cancelar</a>
                

                <button type="submit" class="btn btn-success pull-right">Registrar ingreso</button>
                <!--
                <a data-toggle="modal" data-target="#myModalVoucher" class="btn btn-primary pull-right" style="margin-right: 10px;"> Registrar Correlativo</a>
              -->
              </section>
              </div>
              </form>
         </div>
 
        

         
</section>

</div>
</div>






  <script>
  $( function() {
    $( "#fechamin" ).datepicker();
  } );
  </script>
  <script>
  $( function() {
    $( "#fechamax" ).datepicker();
  } );
  </script>
</head>
<body>
 


<script>
sumaFecha = function(d, fecha)
{
  var Fecha = new Date();
  var sFecha = fecha || (Fecha.getFullYear() + "-" + (Fecha.getMonth() +1) + "-" + Fecha.getDate());
  var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
  var aFecha = sFecha.split(sep);
  var fecha = aFecha[0]+'/'+aFecha[1]+'/'+aFecha[2];
  fecha= new Date(fecha);
  fecha.setDate(fecha.getDate()+parseInt(d));
  var anno=fecha.getFullYear();
  var mes= fecha.getMonth()+1;
  var dia= fecha.getDate();
  mes = (mes < 10) ? ("0" + mes) : mes;
  dia = (dia < 10) ? ("0" + dia) : dia;
  var fechaFinal = anno+sep+mes+sep+dia;
  return (fechaFinal);
}




function sumar() {

  m1 = document.getElementById("precio").value;
  m2 = document.getElementById("cant_noche").value;
  extra = document.getElementById("extra").value;
  r = (m1*m2)+parseInt(extra);

  //alert(total);
  document.getElementById('spTotal').innerHTML = r;

  var fechamin = $("#fecha1").val()
  var fechaSumada = sumaFecha(m2,fechamin); /* Le sumas un dia */
  document.getElementById('fecha_salida').value = fechaSumada;

}


function CargarTarifa(val)
{
    $('#mostrar_precio').html("Por favor espera un momento");    
    $.ajax({
        type: "POST",
        url: 'index.php?action=tarifa',
        data: 'id='+val,
        success: function(resp){
            $('#mostrar_precio').html(resp);
        }
    });
};


function CargarEfectivo(val)
{   

    $('#mostrar_efectivo').html("Por favor espera un momento");    
    $.ajax({
        type: "POST",
        url: 'index.php?action=mostrar_efectivo',
        data: 'id='+val,
        success: function(resp){
            $('#mostrar_efectivo').html(resp);
        }
    });
};

function CargarMediopago(val)
{
    
    $('#mostrar_mediopago').html("Por favor espera un momento");    
    $.ajax({
        type: "POST",
        url: 'index.php?action=mediopago',
        data: 'id='+val,
        success: function(resp){
            $('#mostrar_mediopago').html(resp);
        }
    });
};

function MostrarDocumento(val)
{
    $('#mostrar_documento').html("Por favor espera un momento");    
    $.ajax({
        type: "POST",
        url: 'index.php?action=documento',
        data: 'id='+val,
        success: function(resp){
            $('#mostrar_documento').html(resp);
        }
    }); 
}; 

function MostrarSelectMedioPago(val)
{
    $('#mostrar_selectmediopago').html("Por favor espera un momento");    
    $.ajax({
        type: "POST",
        url: 'index.php?action=select_mediopago',
        data: 'id='+val,
        success: function(resp){
            $('#mostrar_selectmediopago').html(resp);
        }
    });
};


  
    
      
    
  

    
  </script>



