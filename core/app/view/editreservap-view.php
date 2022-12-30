<?php $reserva = ReservapData::getById($_GET["id"]);?>

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
          $('#id').val(ui.item.id);
           }
            });
    }); 
</script>




<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href=""><i class="fa fa-home"></i> Inicio</a></li>
      <li class="active"><a href="#">Editar Reserva</a></li>
    </ol>
</section> 
</div> 




  
    <!-- row -->
    <div class="row">
    <form  method="post" action="index.php?view=updatereservap" role="form">
       
        <div class="col-md-6">
             <!-- col -->
        
  
            <!-- tile -->
            <section class="tile">
                
               <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><strong>EDITAR DATOS DE </strong> RESERVA</h1>             
                </div>
                <!-- /tile header -->
                <div class="tile-body" >    
                    
                    <div class="form-group">
                    <label for="pr-subject">Fecha ingreso: </label>
                        <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso"  required value="<?php echo date('Y-m-d', strtotime($reserva->fecha_entrada)); ?>"  > 
                    </div>
                    
                    <div class="form-group">
                    <label for="pr-subject">Hora ingreso: </label>
                        <input type="time" class="form-control" name="hora_ingreso" id="fecha_ingreso"  required value="<?php echo date('H:i:s', strtotime($reserva->fecha_entrada)); ?>" > 
                    </div>
                    
                    <div class="form-group">
                    <label for="pr-subject">Habitación: </label>
                        <?php $habitaciones = SHreservaData::getAllHabitacion();?>
                        <select name="id_habitacion" id="id_habitacion" required class="form-control">
                            <option value="">-- Seleccione habitación --</option>
                        <?php foreach($habitaciones as $habitacion):?>
                            
                            <option value="<?php echo $habitacion->id;?>" <?php if($habitacion->id==$reserva->id_habitacion){ echo "selected";} ?> ><?php echo $habitacion->nombre;?></option>
                            <?php endforeach;?>
                        </select> 
                    </div>
                    
                    <input type="hidden" value="1" name="tipo_documento" />
                    
                    
                    <div class="form-group">
                    <label for="pr-subject">DNI: </label>
                        <input type="text" class="form-control" name="documento" id="documento" required="required" placeholder="Ingrese documento " value="<?php echo $reserva->getPersona()->documento; ?>" >
                       
                    </div>
                    
                    <div class="form-group">
                    <label for="pr-subject">Nombres: </label>
                        <input type="text" class="form-control" name="nombre" id="nombre"  required placeholder="Ingrese nombres" value="<?php echo $reserva->getPersona()->nombre; ?>" > 
                    </div>
                    
                    <div class="form-group">
                    <label for="pr-subject">Servicio: </label>
                        <?php $servicios = SHreservaData::getAll();?>
                        <select name="id_servicio" id="id_servicio" required class="form-control">
                            <option value="">-- Seleccione servicio --</option>
                        <?php foreach($servicios as $servicio):?>
                            
                            <option value="<?php echo $servicio->id;?>" <?php if($servicio->id==$reserva->id_servicio){ echo "selected";} ?> ><?php echo $servicio->nombre;?></option>
                            <?php endforeach;?>
                        </select> 
                    </div>
                    
                    <div class="form-group">
                    <label for="pr-subject">Total: </label>
                        <input type="number" class="form-control" name="total" id="total" onkeyup="sumar();" onchange="sumar();"  required placeholder="Ingrese total" value="<?php echo $reserva->total; ?>" > 
                    </div>
                    
                    <div class="form-group">
                    <label for="pr-subject">A cuenta: </label>
                        <input type="number" class="form-control" name="acuenta" id="acuenta" onkeyup="sumar();" onchange="sumar();" required placeholder="Ingrese a cuenta" value="<?php echo $reserva->acuenta; ?>" > 
                    </div>
                    
                    <div class="form-group">
                    <label for="pr-subject">Debe: </label>
                        <input type="number" class="form-control" name="debe" id="debe" disabled required placeholder="Ingrese a cuenta" value="<?php echo $reserva->total - $reserva->acuenta; ?>" > 
                    </div>
                    
                    <input type="hidden" value="NULL" name="giro" />
                    
                    <input type="hidden" value="S" name="direccion" />
                    
                    
                    
                    
                    
                    <div class="form-group">
                    <label for="pr-subject">Teléfono: </label>
                        <input type="text" class="form-control" placeholder="Ingrese teléfono (OPCIONAL)" name="estado_civil" id="estado_civil" value="<?php echo $reserva->getPersona()->estado_civil; ?>"   > 
                    </div>
                    
                    <input type="hidden" name="nacionalidad" value="-">
                    
                    <input type="hidden" value="-" name="medio_transporte" />
                   
                    
                    
                     <input type="hidden" class="form-control" name="destino" id="destino" value="-"  placeholder="E-mail " >
                    
                    
                    
                    <div class="form-group">
                    <label for="pr-subject">Nota: </label>
                        <input type="text" class="form-control" name="motivo" id="motivo"   placeholder="Ingrese Nota (OPCIONAL)" value="<?php echo $reserva->getPersona()->motivo; ?>" >
                    </div>
                    
                    <input type="hidden" name="ocupacion" value="1" required>
                    
                    <div class="form-group">
                        <input type="hidden" name="id_persona" value="<?php echo $reserva->id_cliente; ?>">
                         <input type="hidden" name="id_reservap" value="<?php echo $reserva->id; ?>"> 
                        <a href="index.php?view=reservasp" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-success pull-right">Actualizar reserva</button>
                    </div>
                    

                    </div>
                    
                     
                    
              </section>
              
              </div>
              
              
              
             
              </form>
         </div>
 
          <!-- /.box -->

       
<script>

        function sumar() {
            var n1 = document.getElementById('total').value;
            var n2 = document.getElementById('acuenta').value;
            var suma = n1 - n2;
             document.getElementById('debe').value = suma;
        }
</script>






