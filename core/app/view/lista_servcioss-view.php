<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      
        <li class="active">Lista de ventas de servicios</li>
    </ol>
</section> 
</div> 


 <!-- row --> 
<div class="row">
  <!-- col -->
  <div class="col-md-12">
    <section class="tile">
      <div class="tile-header dvd dvd-btm">  
        <h1 class="custom-font"><strong>LIBRO DE</strong> VENTAS DE SERVICIOS</h1>
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
      <!-- tile body -->
      <div class="tile-body">
        <div class="form-group">
          <label for="filter" style="padding-top: 5px">Buscar:</label>
          <input id="filter" type="text" class="form-control input-sm w-sm mb-12 inline-block"/>
        </div>

               

              <?php $procesos = VentaData::getAllServicio();
                if(@count($procesos)>0){
                  // si hay procesos
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="25" class="footable table table-custom" style="font-size: 11px;">

                  <thead style="color: white; background-color: #827e7e;">
                       <th>Cod. venta</th> 
                        <th>Cliente</th> 
                 
                        <th>Tipo comprobante</th>
                        <th>Responsable</th>

                        <th>Total</th> 
                         
                        <th>Fecha servicio</th>
                        <th></th>
                  </thead>
                  <tbody>
                   <?php $numero=0;?>
                   <?php $total=0;?>
                   <?php foreach($procesos as $reportediario):?>
                   <?php $numero=$numero+1;?>

                   <?php $subtotal=0; ?> 
                        <?php $tmps = ProcesoVentaData::getVenta($reportediario->id); 
                        foreach($tmps as $p):  ?>
                        <?php $subtotal=$subtotal+$p->precio; ?>
                        <?php endforeach; ?>

                        <?php if($subtotal!='0'){ ?>
                      <tr>
                        <td><?php echo $reportediario->id; ?></td>
                        <td><?php echo $reportediario->nombre_cliente;; ?></td>
                        <td><?php echo $reportediario->getTipoComprobante()->nombre; ?></td>

                        


                        <td><?php echo $reportediario->getUsuario()->name; ?></td>
                       
                       


                        <td>Q    <?php echo number_format($subtotal,2,'.',','); ?></td>
                     
                        <td><?php echo date($reportediario->fecha_creada); ?></td> 
                       
                        <td><a href="index.php?view=imprimir_servicio&id=<?php echo $reportediario->id; ?>"><i class="fa fa-print"></i> Comprobante</a> </td>
                      </tr> 
                      <?php }; ?>
                            <?php $total=$subtotal+$total; ?>
                    <?php endforeach; ?>
                    </tbody>

                     <tfoot style="color: black; background-color: #e3e4e6;">
                        <tr>
                          <td colspan="10" class="text-center">
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