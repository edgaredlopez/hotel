  
<?php 
date_default_timezone_set('America/Guatemala');
     $hoy = date("Y-m-d"); 
   $hora = date("H:i:s");
   $doce = date("12:00:00");

$nuevafecha = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
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





<?php if (isset($_GET['id_habitacion'])) { ?>
         <?php $habitacion = HabitacionData::getById($_GET['id_habitacion']);
                if(@count($habitacion)>0){
                  // si hay habitacion
                  ?>
            


<div class="page page-ui-tiles" style="padding: 5px 5px;">


                    <!-- row -->
                    <div class="row">
                        
                        <!-- col -->
                        <div class="col-md-2">
                            <!-- tile -->
                            <section class="tile bg-dutch">
                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm" style="padding: 5px;">
                                    <h1 class="custom-font"><strong>NOMBRE</strong></h1>
                                    
                                </div>
                                <!-- /tile header -->
                                
                                <!-- tile widget -->
                                <div class="tile-widget" style="padding: 5px;">
                                    <p><?php echo $habitacion->nombre; ?> / DISPONIBLE</p>
                                </div>
                                <!-- /tile widget -->
 
                            </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-md-3">
                            <!-- tile -->
                            <section class="tile bg-dutch">
                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm" style="padding: 5px;">
                                    <h1 class="custom-font"><strong>TIPO / CATEGORÍA</strong> </h1>
                                    
                                </div>
                                <!-- /tile header -->
                                
                                <!-- tile widget -->
                                <div class="tile-widget" style="padding: 5px;">
                                    <p><?php echo $habitacion->getCategoria()->nombre; ?></p>
                                </div>
                                <!-- /tile widget -->
 
                            </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-md-7">
                            <!-- tile -->
                            <section class="tile bg-dutch">
                                <!-- tile header -->
                                <div class="tile-header dvd dvd-btm" style="padding: 5px;">
                                    <h1 class="custom-font"><strong>DETALLES</strong> </h1>
                                    
                                </div>
                                <!-- /tile header -->
                                
                                <!-- tile widget -->
                                <div class="tile-widget" style="padding: 5px;">
                                    <p><?php echo $habitacion->descripcion; ?></p>
                                </div>
                                <!-- /tile widget -->
 
                            </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->
                        
                       
                    </div>
                    <!-- /row -->

</div>

  
    <!-- row -->
    <div class="row">
    <form  method="post" id="addproduct" action="index.php?view=addproceso" role="form">
       
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
                        <span class="input-group-addon"> Tipo huesped &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <select name="medio_transporte" required class="form-control">
                          <option value="Natural" >Natural</option>
                          <option value="Empresa">Empresarial</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Tipo Documento&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <?php $tipo_documentos = TipoDocumentoData::getAll();?>
                        <select name="tipo_documento" id="tipo_documento" required class="form-control">
                        <?php foreach($tipo_documentos as $tipo_documento):?>
                            <option value="<?php echo $tipo_documento->id;?>" ><?php echo $tipo_documento->nombre;?></option>
                            <?php endforeach;?>
                        </select> 
                    </div>
                  </div>

                  
                    
                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Documento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                      <input type="text" class="form-control" name="documento" id="documento" required="required" placeholder="Ingrese documento para buscar" value="<?php if(isset($_GET['id_p']) and $_GET['id_p']!=""){ echo ProcesoData::getById($_GET['id_p'])->getCliente()->documento;} ?>">
                        <input type="hidden" id="id"> 
                    </div>
                  </div>

                    

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombres &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control" name="nombre" id="nombre"  required placeholder="Ingrese nombres" value="<?php if(isset($_GET['id_p']) and $_GET['id_p']!=""){ echo ProcesoData::getById($_GET['id_p'])->getCliente()->nombre;} ?>"> 
                    </div>
                  </div>
                    
                   

                    <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Procedencia &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="giro" id="giro"  placeholder="Ingrese Procedencia (OPCIONAL)" value="<?php if(isset($_GET['id_p']) and $_GET['id_p']!=""){ echo ProcesoData::getById($_GET['id_p'])->getCliente()->giro;} ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Teléfono &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8"  name="estado_civil" id="estado_civil" placeholder="Ingrese Teléfono  (OPCIONAL)" value="<?php if(isset($_GET['id_p']) and $_GET['id_p']!=""){ echo ProcesoData::getById($_GET['id_p'])->getCliente()->estado_civil;} ?>">
                    </div>
                  </div> 

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> E-mail &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="direccion" id="direccion" placeholder="Ingrese E-mail (OPCIONAL)" value="<?php if(isset($_GET['id_p']) and $_GET['id_p']!=""){ echo ProcesoData::getById($_GET['id_p'])->getCliente()->direccion;} ?>">
                    </div>
                  </div>
 

                  

                  

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Observación &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                       <input type="text" class="form-control col-md-8" name="motivo" id="motivo"  placeholder="Ingrese observación (OPCIONAL)" value="<?php if(isset($_GET['id_p']) and $_GET['id_p']!=""){ echo ProcesoData::getById($_GET['id_p'])->getCliente()->motivo;} ?>">
                    </div>
                  </div>

                    
                    <input type="hidden" name="tipo_servicio" value="1" id="tipo_servicio">
                    
         
                    
                    <input type="hidden" name="nacionalidad" value="-" id="nacionalidad">
                    
                    
                    
                    
                    <input type="hidden" class="form-control" name="destino" id="destino" value="-" >
                    
                    
                    
         
                    
                    <input type="hidden" name="ocupacion" value="1" id="ocupacion" >
                    
                    

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
                    <label for="pr-subject">Selecciona tarifa: </label>
                    <select class="form-control" onchange="CargarTarifa(this.value);" required name="id_tarifa">
                    <?php $tarifas_ha = TarifaData::getAll();?>
                      <option value="">--- Selecciona ---</option>
                      <?php foreach($tarifas_ha as $tarifa_ha):?>
                        <option value="<?php echo $tarifa_ha->id;?>" ><?php echo $tarifa_ha->nombre.' // '.$tarifa_ha->precio;;?></option>
                      <?php endforeach;?> 
                     
                  </select>
                </div> 
                
                <div id="mostrar_precio">
                
                </div>
                
                
                <input type="hidden" name="cantidad" value="1">

                <input type="hidden" name="tarjeta_e" value="Entregada">

                <input type="hidden" name="observacion" value="Turismo">

              
                <input type="hidden" name="pagado" value="1">
                
                 
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                    <label for="pr-subject"><br>Adelanto: </label>
                    <input type="text" name="monto" id="monto"  required="" onchange="this.value=this.value.replace(/\.$/, '')"  onKeyUp="if (isNaN(this.value)) this.value=this.value.replace(/[^0-9.]/g,''); CargarEfectivo(this.value);"  class="form-control" style="border-color: red;" value="<?php if(isset($_GET['id_p']) and $_GET['id_p']!=""){ echo ProcesoData::getById($_GET['id_p'])->dinero_dejado;}else{echo "0";} ?>">
                    </div>
                  </div>
                </div>
                
                <div class="form-group" id="mostrar_efectivo">
                    
                </div>
                
                <div class="form-group" id="mostrar_mediopago">
                
                </div>
                <input type="hidden" value="0" name="id_comisionista">
                <!--
                 <div class="form-group">
            <div class="input-group">
                  <div class="input-group-addon">
                    Comisionista:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </div> 
                  <select class="form-control"  required name="id_comisionista">
                    
                      <option value="0">--- Sin comisionista ---</option>
                      <?php $comisionistas = ComisionistaData::getAll();
                      if(count($comisionistas)>0){ ?>
                  
                      <?php foreach($comisionistas as $comisionista):?>
                        <option value="<?php echo $comisionista->id; ?>" ><?php echo $comisionista->nombre; ?></option>
                      <?php endforeach; ?>
                      <?php }else{ };?>
                  </select> 
                </div>
              </div>
              -->
              
              
             
              <div class="form-group">
                    <label for="pr-subject">Fecha entrada: </label>
                     <input type="date" class="form-control" name="fecha_entrada" id="fecha_entrada"  data-inputmask='"mask": "(999) 999-9999"' value="<?php if(isset($_GET['id_p']) and $_GET['id_p']!=""){ echo date("Y-m-d", strtotime(ProcesoData::getById($_GET['id_p'])->fecha_entrada));}else{ echo $hoy; } ?>" >
                </div>
                
                <div class="form-group">
                    <label for="pr-subject">Hora entrada: </label>
                    <input type="time" class="form-control" name="hora_entrada" value="<?php echo $hora; ?>">
                </div>
              
              
                <input type="hidden" class="form-control" name="fecha_salida" id="fecha_salida" value="<?php echo $nuevafecha; ?>" data-inputmask='"mask": "(999) 999-9999"' data-mask>
               
                
                
                <input type="hidden" class="form-control" name="hora_salida" value="<?php echo $doce; ?>">
                
              
                
                
                 
 

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
                         
                <a href="index.php?view=recepcion" style="font-size: bold;" class="btn btn-danger">Cancelar</a>
                <input type="hidden" name="id_habitacion" value="<?php echo $habitacion->id; ?>">
                <input type="hidden" name="id_proceso" value="<?php if(isset($_GET['id_p']) and $_GET['id_p']!=""){ echo $_GET['id_p'];} ?>">
                 



                <button type="submit" class="btn btn-success pull-right">Registrar ingreso</button>
                <!--
                <a data-toggle="modal" data-target="#myModalVoucher" class="btn btn-primary pull-right" style="margin-right: 10px;"> Registrar Correlativo</a>
              -->
              </section>
              </div>
              </form>
         </div>
 
          <!-- /.box -->

        <?php }else{ 
            echo"<h4 class='alert alert-success'>NO EXISTE ESTA HABITACIÓN</h4>";

         }; ?>



    <?php }else{ 
      echo"<h4 class='alert alert-success'>NO SE SELECCIONÓ HABITACIÓN</h4>";
    };?>

         
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

  var fechamin = $("#fecha_entrada").val()
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



