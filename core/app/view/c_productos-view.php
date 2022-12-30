<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=cliebte"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="#">Servicios</a></li>
      <li class="active">Servicios</li>
    </ol>
</section> 
</div> 




            
          




<!-- row --> 
<div class="row">
  <!-- col --> 
  <div class="col-md-12">
    <section class="tile">

             <div class="tile-header dvd dvd-btm">  
                <h1 class="custom-font"><strong>MANTENIMIENTO DE  </strong> SERVICIOS  </h1>
                <ul class="controls">
                  <li class="remove">
                    <a  href="#"  data-toggle="modal" data-target="#myModal" > <span class="fa fa-cutlery"></span> REGISTRAR NUEVO SERVICIO</a>
                  </li>
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


              <?php $productos = ProductoData::getAllCategoria($_GET["id"]);
                if(@count($productos)>0){ 
                  // si hay usuarios
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">

                  <thead style="color: white; background-color: #827e7e;">
                        <th>CÓDIGO</th> 
                        <th>NOMBRE</th>
                        
                        <th>DETALLES</th>
                        
                        <th>PRECIO VENTA</th>
                        
                        <th></th>  
                        <th></th>
                  </thead>
                   <?php foreach($productos as $producto):?>
                      <tr>
                        <td><?php echo $producto->codigo; ?></td>
                        <td><?php echo $producto->nombre; ?></td>
                        
                        <td><?php if($producto->descripcion!="NULL"){ echo $producto->descripcion; }else{ echo "------";} ?></td>
                        
                        <td><b>$   <?php echo number_format($producto->precio_venta,2,'.',','); ?></b></td>
                        
                        
                        <td>
                        <a href="#"  data-toggle="modal" data-target="#myModal<?php echo $producto->id; ?>"  class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        </td>
                        <td> <a href="index.php?view=delproductoc&id=<?php echo $producto->id; ?>&id_c=<?php echo $_GET['id']; ?>"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Eliminar</a></td>
                      </tr> 
                    



     <div class="modal fade bs-example-modal-xm" id="myModal<?php echo $producto->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=updateprosauna" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-cutlery"></span> EDITAR SERVICIO</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Código&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                      <input type="hidden" name="codigo" value="<?php echo $producto->codigo; ?>">
                      <input type="text" class="form-control col-md-8" disabled name="codigo" value="<?php echo $producto->codigo; ?>" required placeholder="Ingrese Código">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control" name="nombre" value="<?php echo $producto->nombre; ?>" required placeholder="Ingrese Nombre">
                    </div>
                  </div>

                

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Detalles &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control" name="descripcion" value="<?php if($producto->descripcion!='NULL'){echo $producto->descripcion; }else{ echo "";}?>" placeholder="Ingrese detalles (OPCIONAL)">
                    </div>
                  </div>

                  

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Precio Venta&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="number" style="border-color: red;" class="form-control" step="any" value="<?php echo $producto->precio_venta; ?>" name="precio_venta" required placeholder="Ingrese Precio">
                    </div>
                  </div>

                  

                 

                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <input type="hidden" class="form-control" value="<?php echo $producto->id; ?>" name="id_producto" >
                <input type="hidden" class="form-control" name="id_categoriap" value="<?php echo $_GET['id']; ?>">
                <button type="submit" class="btn btn-outline">Actualizar producto</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

                      

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

      <div class="modal fade bs-example-modal-xm" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" method="post" id="addproduct" action="index.php?view=addprosauna" role="form">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-cutlery"></span> INGRESAR NUEVO PRODUCTO</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">

                  <?php 

                  $productocod = ProductoData::getUltimo();

                  $codigo=0;

                  if(@count($productocod)>0){

                    if($productocod->id<10){
                      $codigo='PRO-00'.($productocod->id+1);
                    }else if($productocod->id<100){
                      $codigo='PRO-0'.($productocod->id+1);
                    }else if($productocod->id<1000){
                      $codigo='PRO-'.($productocod->id+1);
                    }

                  }else{$codigo='PRO-001';}


                  ?>
  
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Código&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                      <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
                      <input type="text" class="form-control col-md-8"  name="codigo" value="<?php echo $codigo; ?>" disabled placeholder="Ingrese Código">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control" name="nombre" required placeholder="Ingrese Nombre">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Detalles  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control" name="descripcion" placeholder="Ingrese detalles (OPCIONAL)">
                    </div>
                  </div> 


                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Precio Venta&nbsp;&nbsp;&nbsp;&nbsp; </span>
                      <input type="number" style="border-color: red;" class="form-control" step="any" name="precio_venta" required placeholder="Ingrese Precio">
                    </div>
                  </div>

                  

                  

                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <input type="hidden" class="form-control" name="id_categoriap" value="<?php echo $_GET['id']; ?>">
                <button type="submit" class="btn btn-outline">Registrar servicio</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>

       <script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>
        
        <script src="assets/js/vendor/footable/footable.all.min.js"></script>
      
        
 <script>
            $(window).load(function(){

                $('.footable').footable();

            });
</script>