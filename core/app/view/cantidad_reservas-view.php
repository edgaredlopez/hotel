<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=cliebte"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="#">Reservas</a></li>
      <li class="active">Cantidad de reservas</li>
    </ol>
</section> 
</div> 


<!-- row --> 
<div class="row">
  <!-- col --> 
  <div class="col-md-12">
    <section class="tile">

             <div class="tile-header dvd dvd-btm">  
                <h1 class="custom-font"><strong>RESERVAS </strong>  </h1>
                <ul class="controls">
                  
                  <li class="dropdown">
                    <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                    <i class="fa fa-cog"></i><i class="fa fa-spinner fa-spin"></i>
                    </a>
                    <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                        <li>
                          <a role="button" tabindex="0" class="tile-toggle">
                          <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                          <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                          </a>
                        </li>
                        <li>
                          <a role="button" tabindex="0" class="tile-refresh">
                            <i class="fa fa-refresh"></i> Refresh
                          </a>
                        </li>
                        <li>
                          <a role="button" tabindex="0" class="tile-fullscreen">
                          <i class="fa fa-expand"></i> Fullscreen
                          </a>
                        </li>
                    </ul>
                  </li>
                  <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                </ul>
              </div>


           <div class="tile-body">
            <div class="form-group">
              <label for="filter" style="padding-top: 5px">Buscar:</label>
              <input id="filter" type="text" class="form-control input-sm w-sm mb-12 inline-block"/>
            </div>


              <?php $reservass = ProcesoData::getProcesoReserva();
                if(@count($reservass)>0){
                  // si hay usuarios
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">

                  <thead style="color: white; background-color: #827e7e;">
                        <th>CÓDIGO</th> 
                        <th>Cliente</th> 
                        <th>Habitación</th>
                        
                        <th>Hora ingreso</th>
                        <th>Hora salida</th> 
                         <th>Estado</th> 

                  </thead>
                   <?php foreach($reservass as $reserva):?>
                      <tr>
                        <td><?php echo $reserva->id; ?></td>
                        <td><?php echo $reserva->getCliente()->documento; ?></td>
                        <td><?php echo $reserva->getHabitacion()->nombre; ?></td>
                        
                        <td><?php echo date($reserva->fecha_entrada); ?></td>
                        <td><?php echo date($reserva->fecha_salida); ?></td>
                        <td><?php if($reserva->estado=="5"){  ?><a href="#" class="btn btn-danger btn-xs"> Cancelado</a>
                        <?php  }else if($reserva->estado=="3"){?> <a href="#" class="btn btn-warning btn-xs">NO Confirmado</a>
                        <?php  }else {?> <a href="#" class="btn btn-primary btn-xs">Confirmado</a>
                        <?php  }; ?>
                        </td>

                      </tr> 
                    




<?php endforeach; ?>
                      <tfoot class="hide-if-no-paging">
                        <tr>
                          <td colspan="8" class="text-center">
                            <ul class="pagination"></ul>
                          </td>
                        </tr>
                      </tfoot>
                  </table>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                };
                ?>

           </div>
</section>

</div>
</div>

   

       <script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>
        
        <script src="assets/js/vendor/footable/footable.all.min.js"></script>
      
        
 <script>
            $(window).load(function(){

                $('.footable').footable();

            });
</script>