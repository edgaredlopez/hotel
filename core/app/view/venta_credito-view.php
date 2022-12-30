<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      
        <li class="active">Histórico de ventas a crédito</li>
    </ol>
</section> 
</div> 


 <!-- row --> 
<div class="row">
  <!-- col -->
  <div class="col-md-12">
    <section class="tile">
      <div class="tile-header dvd dvd-btm">  
        <h1 class="custom-font"><strong>HISTÓRICO DE VENTAS</strong> A CRÉDITO</h1>
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

               
 
              <?php $procesos = VentaData::getAllCreditoVenta();
                if(@count($procesos)>0){ 
                  // si hay procesos 
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="25" class="footable table table-custom" style="font-size: 11px;">

                  <thead style="color: white; background-color: #d6bd1e;">
                       <th>Cod.</th> 
                        <th>Cliente</th> 
                        <th>Nombres Cliente</th> 
                        

                        <th>Total</th> 
                        <th>Fecha y hora venta</th>
                        <th>Responsable</th>
                        <th></th>
                  </thead>
                  <tbody>
                   <?php $numero=0;?>
                   <?php $total=0;?>
                   <?php foreach($procesos as $reportediario):?>
                   <?php $numero=$numero+1;?>
                      <tr>
                        <td><?php echo $reportediario->id; ?></td>
                        <td><?php echo $reportediario->getProveedor()->documento; ?></td>
                        <td><?php echo $reportediario->getProveedor()->nombre; ?></td>
                       
                        <?php $subtotal= $reportediario->total; ?>
                        <td>Q  <?php echo number_format($subtotal,2,'.',','); ?></td>
                        <td><?php echo date($reportediario->fecha_creada); ?></td> 
                        <td><?php echo $reportediario->getUsuario()->name;; ?></td>

                        <td><?php if($reportediario->credito=='1'){ ?><a href="#"  data-toggle="modal" data-target="#myModal<?php echo $reportediario->id; ?>" class="btn btn-sm btn-danger"> Realizar pago</a><?php }else{ ?>
                          <a href="#"   class="btn btn-sm btn-success"><i class="fa fa-check"></i> Pago realizado</a>
                          <?php }; ?> </td>




                 <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $reportediario->id; ?>" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-warning">
                      <div class="modal-dialog">
                        <div class="modal-content">  
                            <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addventacredito" role="form">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><span class="fa fa-money"></span> REALIZAR PAGO</h4>
                          </div>
                          <div class="modal-body" style="background-color:#fff !important;"> 
                            
                            <div class="row">
                            <div class="col-md-offset-1 col-md-10">

                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon"> Monto &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                  <input type="text" class="form-control col-md-8"  value="<?php echo $subtotal; ?>" disabled placeholder="Ingrese monto">
                                  <input type="hidden" class="form-control col-md-8" name="monto" value="<?php echo $subtotal; ?>" required >
                                </div>
                              </div>


                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon"> Tipo pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                  <select class="form-control"  required name="id_tipo_pago">
                                        <option value="">--- Selecciona ---</option>
                                        <?php $medipagos = TipoPagoData::getAllSC();
                                        if(count($medipagos)>0){ ?>
                                        <?php foreach($medipagos as $mediopago):?>
                                          <option value="<?php echo $mediopago->id; ?>" ><?php echo $mediopago->nombre; ?></option>
                                        <?php endforeach; ?>
                                        <?php }else{ };?> 
                                    </select>  
                                </div>
                              </div>


                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon"> Aval &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                  <input type="text" class="form-control" name="aval"  required placeholder="Ingrese Aval">
                                </div>
                              </div>

                              
                            </div>
                            </div>

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                            <input type="hidden" class="form-control" name="id_venta" value="<?php echo $reportediario->id; ?>" >
                            <button type="submit" class="btn btn-outline">Realizar pago</button>
                          </div>
                        </form>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                  </div>


                      </tr> 
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