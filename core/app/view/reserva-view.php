<!DOCTYPE html>
<html>
<head>

<meta charset='utf-8' />

<script src='lib/locale/es.js'></script>
<!-- jQuery 2.2.3 -->
<script src="js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>




<link href='lib/fullcalendar.min.css' rel='stylesheet' />
<link href='lib/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='lib/scheduler.min.css' rel='stylesheet' />
<script src='lib/moment.min.js'></script>
<script src='lib/fullcalendar.min.js'></script>
<script src='lib/scheduler.min.js'></script>

<style>

  body {
    margin: 0;
    padding: 0;
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    font-size: 14px;
  }

  p {
    text-align: center;
  }

  #calendar {
  
    max-width: 1200px !important;
    margin: 50px auto;

  }

  .fc-resource-area td {
    cursor: pointer;
  }
  .close{
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: 1;
  }
  .fc-timeline-event .fc-time {
    font-weight: 700;
    padding: 0 1px;
    display: none !important;
}
  

</style>
</head>
<body>


  <div id='calendar'></div>


  <!-- Modal add. update, delete-->
  <div class="modal fade" id="ModalEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content modal-success">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="titleEvent"> </h4>
              </div>
        <div class="modal-body" style="background-color: #f5eded !important;">
          <div class="row">
            <div class="col-md-offset-1 col-md-10">

              <div class="form-group"> 
                <div class="input-group">
                    <span class="input-group-addon"> Habitación &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                     <select name="id_habitacion" id="id_habitacion" class="form-control">
                      <?php $rooms = HabitacionData::getAll();?>
                      <?php foreach($rooms as $room):?>
                      <option value="<?php echo $room->id;?>"><?php echo $room->nombre;?></option>
                      <?php endforeach;?>
                    </select> 
                </div> 
              </div>

              <div class="form-group"> 
                <div class="input-group">
                    <span class="input-group-addon"> Check In  &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="date" class="form-control" name="txtDate" id="txtDate" required >
                    <span class="input-group-addon"> Hora</span>
                    <input type="time" class="form-control" name="txtHour" id="txtHour"  required >
                </div>
              </div>

              <div class="form-group"> 
                <div class="input-group">
                    <span class="input-group-addon"> Check Out &nbsp;&nbsp; &nbsp;</span>
                    <input type="date" class="form-control" name="txtDateEnd" id="txtDateEnd"  required >
                    <span class="input-group-addon"> Hora &nbsp;&nbsp;</span>
                    <input type="time" class="form-control" name="txtHourEnd" id="txtHourEnd" required >

                </div>
              </div>


              <div class="form-group">  
                <div class="input-group">
                  <span class="input-group-addon">Tipo  Documento </span>
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
                  <span class="input-group-addon"> Documento &nbsp;&nbsp; </span>
                  <input type="text" class="form-control" name="documento" id="documento" required placeholder="Ingrese documento">
                </div>
              </div>

              <div class="form-group"> 
                <div class="input-group">
                  <span class="input-group-addon"> Nombres &nbsp;&nbsp; &nbsp;&nbsp;</span>
                  <input type="text" class="form-control" name="nombre" id="nombre" required placeholder="Nombres completos">
                </div>
              </div>

              <div class="form-group"> 
                <div class="input-group">
                  <span class="input-group-addon"> Teléfono &nbsp;&nbsp; &nbsp;&nbsp;</span>
                  <input type="text" class="form-control" name="estado_civil" id="estado_civil" required placeholder="Teléfono">
                </div>
              </div>

              <div class="form-group"> 
                <div class="input-group">
                  <span class="input-group-addon"> Correo e. &nbsp;&nbsp; &nbsp;</span>
                  <input type="text" class="form-control" name="direccion" id="direccion" required placeholder="E-mail">
                </div>
              </div>

              

              <div class="form-group"> 
                <div class="input-group">
                    <span class="input-group-addon"> Estado &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                     <select name="estado" id="estado" class="form-control">
                      <option value="3">No confirmado</option>
                      <option value="4">Confirmado</option>
                    </select> 
                </div>
              </div>

              <div class="form-group"> 
                <div class="input-group">
                  <span class="input-group-addon"> Adelanto &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; </span>
                  <input type="text" class="form-control" name="dinero_dejado" id="dinero_dejado" required="" value="0" placeholder="adelanto">
                </div>
              </div>


 
              


            </div>
           </div>

          <input type="hidden" id="txtId" name="txtId"><br>
        
        </div>
        <div class="modal-footer" >

          <button type="button" class="btn btn-success"  id="btnAdd">Agregar</button>
          

          <button type="button" class="btn btn-primary"  id="btnCheckin">Pasar a check-in</button>

          <button type="button" class="btn btn-secondary" id="btnUpdate">Actualizar</button>

          <button type="button" class="btn btn-danger" id="btnDel">Cancelar reserva</button>
    
          
        </div>
      </div>
    </div>
  </div>




<script>

  $(function() { // document ready

    $('#calendar').fullCalendar({
      now: new Date(),
      editable: true,
      selectable: true,
      aspectRatio: 1.8,
      scrollTime: '00:00',
      header: {
        left: 'promptResource today prev,next',
        center: 'title',
        right: 'timelineMonth,timelineDay,timelineThreeDays'
      },
      defaultView: 'timelineMonth',
      views: {
        timelineThreeDays: {
          type: 'timeline',
          duration: { days: 5 } 
        }
      },
      resourceAreaWidth: '15%',   
      resourceColumns: [
        {
          labelText: 'Habitaciones',  
          field: 'title'
        },
        {
          labelText: 'Categoría',
          field: 'nom'
        }
      ],
      
      select: function(startDate, endDate,mjsEvent, view, resource) {
        limpiar();
        var fechaHora=startDate.format().split("T");
        var fechaHoraEnd=endDate.format().split("T");

        var check = moment(startDate).format('YYYY-MM-DD');
        var today = moment(new Date()).format('YYYY-MM-DD');

        $('#txtDate').val(fechaHora[0]);
        $('#txtHour').val(fechaHora[1]);

        $('#txtDateEnd').val(fechaHoraEnd[0]);
        $('#txtHourEnd').val(fechaHoraEnd[1]);
        $('#id_habitacion').val(resource.id);
        $('#titleEvent').html(resource.title);
        if (check >= today) { 
        $("#ModalEvent").modal();
        document.getElementById('btnCheckin').style.display = 'none';
        document.getElementById('btnUpdate').style.display = 'none';
        document.getElementById('btnDel').style.display = 'none';
        document.getElementById('btnAdd').style.display = 'inline';
        }
        else {
          alert("No se pueden crear reserva en el pasado!");
        }
        
    },
      eventClick:function(calEvent){
            // H2
            if (calEvent.estado == "3") {
            $('#titleEvent').html(calEvent.title);
            // Information events
            $('#id_habitacion').val(calEvent.resourceId);
            $('#documento').val(calEvent.documento);
            $('#txtId').val(calEvent.id);
            $('#nombre').val(calEvent.title);
            $('#direccion').val(calEvent.direccion);
            $('#estado_civil').val(calEvent.estado_civil);
            $('#dinero_dejado').val(calEvent.dinero_dejado);
            $('#estado').val(calEvent.estado);
            $('#tipo_documento').val(calEvent.tipo_documento);
            

            datehhour= calEvent.start._i.split(" ");
            datehhourEnd= calEvent.end._i.split(" ");
            $('#txtDate').val(datehhour[0]);
            $('#txtHour').val(datehhour[1]);
            $('#txtDateEnd').val(datehhourEnd[0]);
            $('#txtHourEnd').val(datehhourEnd[1]);

            document.getElementById('btnCheckin').style.display = 'inline';
            document.getElementById('btnUpdate').style.display = 'inline';
            document.getElementById('btnDel').style.display = 'inline';
            document.getElementById('btnAdd').style.display = 'none';
            $("#ModalEvent").modal();

          }else if(calEvent.estado == "4"){

            $('#titleEvent').html(calEvent.title);
            // Information events
            $('#id_habitacion').val(calEvent.resourceId);
            $('#documento').val(calEvent.documento);
            $('#txtId').val(calEvent.id);
            $('#nombre').val(calEvent.title);
            $('#direccion').val(calEvent.direccion);
            $('#estado_civil').val(calEvent.estado_civil);
            $('#dinero_dejado').val(calEvent.dinero_dejado);
            $('#estado').val(calEvent.estado);
            $('#tipo_documento').val(calEvent.tipo_documento);
            

            datehhour= calEvent.start._i.split(" ");
            datehhourEnd= calEvent.end._i.split(" ");
            $('#txtDate').val(datehhour[0]);
            $('#txtHour').val(datehhour[1]);
            $('#txtDateEnd').val(datehhourEnd[0]);
            $('#txtHourEnd').val(datehhourEnd[1]);

            document.getElementById('btnCheckin').style.display = 'inline';
            document.getElementById('btnUpdate').style.display = 'inline';
            document.getElementById('btnDel').style.display = 'none';
            document.getElementById('btnAdd').style.display = 'none';
            $("#ModalEvent").modal();

          }

            


      },
      eventResize:function(calEvent, delta, revertFunc){
        if (calEvent.estado == "3"  || calEvent.estado == "4") {
        $('#txtId').val(calEvent.id);
          $('#nombre').val(calEvent.title);
          $('#documento').val(calEvent.documento);
          $('#direccion').val(calEvent.direccion);
          $('#id_habitacion').val(calEvent.resourceId);
          $('#estado_civil').val(calEvent.estado_civil);
          $('#dinero_dejado').val(calEvent.dinero_dejado);
          $('#estado').val(calEvent.estado);
          $('#tipo_documento').val(calEvent.tipo_documento);

          var fechaHora= calEvent.start.format().split("T");
          var fechaHoraEnd= calEvent.end.format().split("T");
          $('#txtDate').val(fechaHora[0]);
          $('#txtHour').val(fechaHora[1]);

          $('#txtDateEnd').val(fechaHoraEnd[0]);
          $('#txtHourEnd').val(fechaHoraEnd[1]);

          DataGUI();
          DataSendUI('actualizar',NewEvent,true);
        }



      }, 
      eventDrop:function(calEvent){
           if (calEvent.estado == "3" || calEvent.estado == "4" ) {
            
        
          $('#id_habitacion').val(calEvent.resourceId);
          $('#documento').val(calEvent.documento);
          $('#txtId').val(calEvent.id);
          $('#nombre').val(calEvent.title);
          $('#estado_civil').val(calEvent.estado_civil);
          $('#dinero_dejado').val(calEvent.dinero_dejado);
          $('#estado').val(calEvent.estado);
          $('#tipo_documento').val(calEvent.tipo_documento);

          var fechaHora= calEvent.start.format().split("T");
          var fechaHoraEnd= calEvent.end.format().split("T");
          $('#txtDate').val(fechaHora[0]);
          $('#txtHour').val(fechaHora[1]);

          $('#txtDateEnd').val(fechaHoraEnd[0]);
          $('#txtHourEnd').val(fechaHoraEnd[1]);

           DataGUI();
           DataSendUI('actualizar',NewEvent,true);
           }
 
      }, 
                          
      

      resources: "index.php?action=reserva",
      events: "index.php?action=reservas",
      
 
 
     eventRender: function(calEvent, element) {

        limpiar();
        var hoy = Date();
        
        if (calEvent.estado == '0') {
            element.css({
                'background-color': '#33ad85',
                'border-color': '#333333',
                'color': 'white'
            });
        }
        if (calEvent.estado == '3') {
            element.css({
                'background-color': '#f0ad4e',
                'border-color': '#333333',
                'color': 'white'
            });
        }
        if (calEvent.estado == '4') {
            element.css({
                'background-color': '#3B83BD',
                'border-color': '#3B83BD',
                'color': 'white'
            });
        }if (calEvent.estado == '1') {
            element.css({
                'background-color': '#16a01f',
                'border-color': '#16a01f',
                'color': 'white'
            });
        }
    }

    });
  
  }); 


   $('#bagregar').click(function(){

       
        DataGUI();
        DataSendUI('addroom',NewEvent);
        $('#ModalRoom').modal('toggle');
        limpiar();
        $('#calendar').fullCalendar('refetchResources');
     
      
    });
 
   $('#btnAdd').click(function(){
      documento = $("#documento").val();
      nombre = $("#nombre").val();
      direccion = $("#direccion").val();
      estado_civil = $("#estado_civil").val();
      if(documento!="" && nombre!="" && direccion!="" && estado_civil!=""){
      DataGUI();
      DataSendUI('agregar',NewEvent);
      $('#ModalEvent').modal('toggle');
      limpiar();
       }else{
        alert('Ingresa datos');
      }
    });

    $('#btnDel').click(function(){
      
      DataGUI();
      DataSendUI('eliminar',NewEvent);
      $('#ModalEvent').modal('toggle');
      limpiar();
    });

    $('#btnUpdate').click(function(){
      
      DataGUI();
      DataSendUI('actualizar',NewEvent);
      $('#ModalEvent').modal('toggle');
      limpiar();
    });

    $('#btnCheckin').click(function(){
      var id_proceso=document.getElementById("txtId").value;
      var id_habitacion=document.getElementById("id_habitacion").value;
      location.href ="index.php?view=proceso&id_habitacion="+id_habitacion+"&id_p="+id_proceso;
    });

    $('#btnClose').click(function(){

      $('#ModalEvent').modal('toggle'),
      limpiar();
    });

    $('#btnClose1').click(function(){ 
      $('#ModalEvent').modal('toggle'),
      limpiar();
    });

  function limpiar() {
        document.getElementById("txtId").value = "";
        document.getElementById("id_habitacion").value = "";
        document.getElementById("documento").value = "";
        document.getElementById("nombre").value = "";
        document.getElementById("direccion").value = "";
        document.getElementById("txtDate").value = "";
        document.getElementById("txtDateEnd").value = "";
        document.getElementById("estado_civil").value = "";
        document.getElementById("dinero_dejado").value = "";
        $("#titleEvent").empty();

    }

    function DataGUI(){

        NewEvent={ 
        // TABLE EVENTO 
        id:$('#txtId').val(),
        id_habitacion:$('#id_habitacion').val(),
        documento:$('#documento').val(),
        nombre:$('#nombre').val(),
        direccion:$('#direccion').val(),
        estado_civil:$('#estado_civil').val(),
        dinero_dejado:$('#dinero_dejado').val(),
        estado:$('#estado').val(),
        tipo_documento:$('#tipo_documento').val(),
        start:$('#txtDate').val()+" "+$('#txtHour').val(),
        end:$('#txtDateEnd').val()+" "+$('#txtHourEnd').val()
      };
 
    }       

    function DataSendUI(accion,objEvento){ 
        $.ajax({
          type:'POST',
          url:'index.php?action=reserva&accion='+accion,
          data:objEvento, 
          success:function(msg){
            if (msg){
              $('#calendar').fullCalendar('refetchEvents');
              if(!modal){
              $('#ModalEvent').modal('toggle');
              $('#ModalRoom').modal('toggle');
              }
            }
          },
          error:function(){
            alert("Hay un error");
          }
        });

    }





</script>
<script src='lib/locale/es.js'></script>

</body>
</html>
