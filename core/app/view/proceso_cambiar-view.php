  
<?php 
if(isset($_GET['id']) and $_GET['id']!=''){
date_default_timezone_set('America/Lima');
     $hoy = date("Y-m-d"); 
   $hora = date("H:i:s");
   $doce = date("12:00:00");

   $nuevafecha = strtotime ( '+1 day' , strtotime ( $hoy ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
?>


<?php $habitacion = ProcesoData::getById($_GET['id']); ?>

<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="javascript:;">Check in</a></li>
      <li class="active"><a href="#">Cambiar habitación</a></li>
    </ol>
</section> 

</div> 

    <div class="breadcrumb-line">
        
      <div class="row">
         <div class="breadcrumb col-lg-12">
                <div style="background-color: #16a085;color: white;padding: 2px;font-size: 20px;
                text-align: center; text-transform: uppercase;font-weight: bold;width: 100%;">
                    <span> Cambiar habitación</span>
                </div>
          </div>
      </div>
    </div>
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->



    <!-- tile -->            <section class="tile col-md-6">

                               
                                <!-- /tile header -->

                                <!-- tile body --> 
                            <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>HABITACIÓN  </strong><?php echo $habitacion->getHabitacion()->nombre; ?></h1>
                                    <ul class="controls">
                                       
                                        <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /tile header -->
                            <form method="post" action="index.php?view=reporte_fecha_barra" >
                                <div class="tile-body">

                                    <h4 class="custom-font"><strong>Tipo habitación: </strong><?php echo $habitacion->getHabitacion()->getCategoria()->nombre.' / Tarifa: '. $habitacion->getTarifa()->nombre; ?></h4>

                                    <h4 class="custom-font"><strong>Costo alojamiento: </strong> Q    <?php echo number_format($habitacion->precio,2,'.',','); ?></h4>
                                    

                                    <h4 class="custom-font"><strong>Cant. noches:</strong> <?php echo $habitacion->cant_noche; ?></h4>
                                    

                                    <h4 class="custom-font"><strong>Total: </strong> Q    <?php echo number_format($habitacion->precio*$habitacion->cant_noche,2,'.',','); ?></h4>
                                   
                                     

                                </div>
                              
                            </form>

                            </section> 
                            <!-- /tile -->
 
                            <section class="tile col-md-6 ">

                              
                               <!-- tile header -->
                                <div class="tile-header dvd dvd-btm">
                                    <h1 class="custom-font"><strong>HABITACIÓN  </strong>a cambiarse</h1>
                                    <ul class="controls">
                                       
                                        <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                                    </ul>
                                </div> 
                                <!-- /tile header -->
                            <form method="post" action="index.php?view=updateproceso" >
                                <div class="tile-body">

                                    <input type="hidden" name="cant" id="cant" value="<?php echo $habitacion->cant_noche; ?>">
                                    <input type="hidden" name="id_proceso"  value="<?php echo $habitacion->id; ?>">
                                    <input type="hidden" name="id_habitacion_pre"  value="<?php echo $habitacion->id_habitacion; ?>">

                                    <h4 class="custom-font"><strong>Selecciona</strong> </h4>
                                    <div class="form-group">
                                    <select class="form-control" name="id_habitacion"  required>
                                       <?php $habitaciones = HabitacionData::getLibres();?>
                                       <option value="">--- Seleccione ---</option>
                                      <?php foreach($habitaciones as $habitacion):?>
                                        <option value="<?php echo $habitacion->id;?>"><?php echo 'Habitacion:: '.$habitacion->nombre;?></option>
                                      <?php endforeach;?>
                                    </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="pr-subject">Selecciona tarifa: </label>
                                        <select class="form-control" onchange="CargarTarifa(this.value);" required name="id_tarifa">
                                        <?php $tarifas_ha = TarifaData::getAll();?>
                                          <option value="">--- Selecciona ---</option>
                                          <?php foreach($tarifas_ha as $tarifa_ha):?>
                                            <option value="<?php echo $tarifa_ha->id;?>" ><?php echo $tarifa_ha->nombre.' //  PRECIO POR NOCHE: '.$tarifa_ha->precio;?></option>
                                          <?php endforeach;?> 
                                         
                                      </select>
                                    </div>

                                    

                                                        
                                     

                                </div>
                                <!-- /tile body -->
                                <div class="tile-footer">
                                    <div class="form-group text-center">
                                        <a href="index.php?view=recepcion" class="btn btn-rounded btn-danger ripple">Cancelar</a>
                                        <button class="btn btn-rounded btn-success ripple" type="submit"><i class="fa fa-open-eye"></i> Cambiar habitación</button>
                                    </div>
                                </div>
                            </form>

                            </section>
                            <!-- /tile -->


<script type="text/javascript"> 

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


function CargarPrecio(val)
{ 
    $('#mostrar_precio').html("Por favor espera un momento");  
    var cant=document.getElementById("cant").value;
    var parametros={"id_tarifa":val,"cant":cant};
    $.ajax({
        type: "POST",
        url: 'index.php?action=mostrar_precio',
        data: parametros,
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

</script>

<?php }else{ ?>
<?php }; ?>