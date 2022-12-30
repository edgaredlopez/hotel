
<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
 
<?php $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';?>

<?php 
if(isset($_GET['id']) and $_GET['id']!=''){
$productos = ProductoData::getAllCategoria($_GET['id']);   
}else{
$productos = ProductoData::getAll(); 
}

                if(@count($productos)>0){ 
                  // si hay usuarios 
                  ?> 
                  

                   <table class="table table-custom" id="editable-usage" style="font-size: 10px;">

                  <thead >
                        <th>CÓDIGO</th> 
                        <th>NOMBRE</th>
                        <th>MARCA</th>
                        <th>DETALLES</th>
                        <th>EN STOCK</th>
                        <th>CANTIDAD</th>
                        <th>PRECIO VENTA</th>
                        <th></th>  
                  </thead>
                   <?php foreach($productos as $producto):?>  
                      <tr>
                        <td><?php echo $producto->codigo; ?></td>
                        <td><?php echo $producto->nombre; ?></td>
                        
                        <td><?php echo $producto->marca; ?></td>
                       
                        <td><?php echo $producto->descripcion; ?></td>

                        <?php $entrada_producto=0; ?>
                        <?php $entradas = ProcesoVentaData::getAllEntradas($producto->id);
                        if(@count($entradas)>0){ ?>
                            <?php foreach($entradas as $entrada): $entrada_producto=$entrada->cantidad+$entrada_producto;  endforeach; ?>
                        <?php }else{ $entrada_producto=0; }; ?>

                        
 
                        

                        <?php $salida_producto=0; ?>
                        <?php $salidas = ProcesoVentaData::getAllSalidas($producto->id);
                        if(@count($salidas)>0){ ?>
                            <?php foreach($salidas as $salida): $salida_producto=$salida->cantidad+$salida_producto;  endforeach; ?>
                        <?php }else{ $salida_producto=0; }; ?>

                   
                       
                        <?php $stock= ($producto->stock + $entrada_producto) - $salida_producto; ?>

                        
                        <td><?php echo $stock; ?></td> 
                       
                        <td class='col-xs-1'>
              						<div class="pull-right">
              						    <input type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $producto->id; ?>"  value="1" min="1"  onkeypress="return valida(event)">
              						</div>
                        </td>         
                        <td class='col-xs-2'>
                          <div class="pull-right">
                            <input type="text" class="form-control" style="text-align:right" disabled value="<?php echo $producto->precio_venta;?>" >

              						  <input type="hidden" class="form-control" style="text-align:right" id="precio_venta_<?php echo $producto->id; ?>"  value="<?php echo $producto->precio_venta;?>" >
              						</div>
              					</td> 
                         
                        <?php if($stock<=0 and $producto->id_categoriap=='5'){ ?>
                         <td><span class="pull-right"><a href="#" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-warning"></i> Sin stock</a></span></td>
                        <?php }else{ ?>
                        <td><span class="pull-right"><a href="#" onclick="agregar('<?php echo $producto->id; ?>')" class="btn btn-success" data-dismiss="modal"><i class="glyphicon glyphicon-plus-sign"></i> </a></span></td>
                        <?php }; ?>
                      </tr>  
                    <?php endforeach; ?> 
                    <tfoot>
                        <tr>
                          <td <?php if(isset($_GET['id']) and $_GET['id']=='1'){ ?> colspan="8" <?php }else{  ?> colspan="8" <?php }; ?> class="text-center">
                            <ul class="pagination"></ul>
                          </td>
                        </tr> 
                      </tfoot>
                  </table>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                }; 
                ?>





 
 

        
<script>
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
</script>

<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>
        <script>
          
            var table = $('#editable-usage').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
               
            });

        </script>


       
