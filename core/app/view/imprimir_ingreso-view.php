
<div class="row">

 <section class="content-header">
     <div class="nav-heading">
                                
                                <span class="controls pull-right">
                                  <a href="index.php?view=otro_ingreso" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20 mr-5" data-toggle="tooltip" title="Egreso"><i class="fa fa-times"></i></a>
                                  <a href="javascript:print();" class="btn btn-ef btn-ef-1 btn-ef-1-default btn-ef-1a btn-rounded-20" data-toggle="tooltip" title="Imprimir"><i class="fa fa-print"></i></a>
                                </span>
                            </div>
      <h1 >
        DETALLES DE INGRESO

      </h1>

</section>
</div>

<div class="row">
<section class="content">


          <div class="box box box-danger">
            <div class="box-header">
              
               
            </div>

            <!-- /.box-header -->
            <div class="box-body">


              <?php $gasto = GastoData::getById($_GET['id']);
                if(@count($gasto)>0){
                  // si hay usuarios
                  ?>
                  <table class="table table-bordered table-hover">

                  <thead style="color: white; background-color: #dd4b39;">
                        <th colspan="2" style="text-align: center;">Nº DE TICKET - <?php echo 'INGRESO-'.$gasto->id; ?> -</th> 
                        <th></th> 
                  </thead>
                    
                    <tr>
                        <td>Código</td>
                        <td><?php echo 'INGRESO-'.$gasto->id; ?></td>
                        <td></td>
                      </tr> 

                      <tr>
                        <td>Detalles del gasto</td>
                        <td><?php echo $gasto->descripcion; ?></td>
                        <td></td>
                      </tr> 
 
                      <tr>
                        <td>Monto </td>
                        <td><b>$   <?php echo number_format($gasto->precio,2,'.',','); ?></b></td>
                        <td></td>
                      </tr> 
                      <tr>
                        <td>Responsable</td>
                        <td><?php echo $gasto->getUsuario()->name; ?></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Fecha y hora</td>
                        <td><?php echo $gasto->fecha_creacion; ?></td>
                        <td></td>
                      </tr>  


                   
                  </table>

               <?php }else{ 
           

                };
                ?>

           </div>
    </div>    


</section>

</div>

