  <link rel="stylesheet" href="assets/js/vendor/datatables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/datatables.bootstrap.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/Responsive/css/dataTables.responsive.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/ColVis/css/dataTables.colVis.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datatables/extensions/TableTools/css/dataTables.tableTools.min.css">



<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      <li class="active"><a href="#">Clientes</a></li>
    </ol>
</section> 
</div> 

 <!-- row -->  
<div class="row">
  <!-- col -->
  <div class="col-md-12">
    <section class="tile">
      <div class="tile-header dvd dvd-btm">  
        <h1 class="custom-font"><strong>DIRECTORIO DEL</strong> CLIENTES RESIDENTES</h1>
        <ul class="controls">
          <li class="remove">
            <a  data-toggle="modal" data-target="#myModal"  ><i class="fa fa-user-plus"></i> NUEVO CLIENTE</a>
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
      <!-- tile body -->
      <div class="tile-body">
        
        <?php 
          $clientes = PersonaData::getResidente();  
        ?> 
        <?php   
        if(@count($clientes)>0){  ?>
        <div class="table-responsive">
        <table class="table table-custom" id="editable-usage" style="font-size: 11px;">
            <thead >
                <tr>
                  <th>N??</th> 
                  <th>Tipo huesped</th> 
                  <th>Tipo documento</th>
                  <th data-hide="phone">Documento</th>
                  <th data-hide='phone, tablet'>Nombres completos</th>
                  <th data-hide='phone, tablet'>Tel??fono</th>
                  <th data-hide='phone, tablet'>E-mail</th> 
                  <th data-hide='phone, tablet'>Procedencia</th> 
                  
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($clientes as $cliente):?> 
                      <tr>
                        <td><?php echo $cliente->id; ?></td>
                        <td><?php echo $cliente->medio_transporte; ?></td>
                        <td><b><?php echo $cliente->getTipoDocumento()->nombre; ?></b></td>
                        <td><?php echo $cliente->documento; ?></td>
                        <td><?php echo $cliente->nombre; ?></td>
                        <td><?php if($cliente->estado_civil!=NULL){ echo $cliente->estado_civil;}else{ echo "--------";} ?></td>
                        <td><?php if($cliente->direccion!="NULL"){ echo $cliente->direccion; }else{ echo "--------";} ?></td>

                        <td><?php if($cliente->giro!="NULL"){ echo $cliente->giro; }else{ echo "--------";} ?></td>

                        
                        
                        <td>
                        <a href=""  data-toggle="modal" data-target="#myModal<?php echo $cliente->id; ?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                        </td>
                        <td>
                        <a href="index.php?view=delclienter&id=<?php echo $cliente->id;?>"  class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>
                        </td>
                      </tr> 
                  
 





 <div class="modal fade in" id="myModal<?php echo $cliente->id; ?>" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <form class="form-horizontal" method="post" action="index.php?view=updatecliente_residente" role="form">
              <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-users"></span> EDITAR  CLIENTE </h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">
  
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Tipo huesped &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <select name="medio_transporte" required class="form-control">
                        <option value="Empresa" <?php if($cliente->medio_transporte=="Empresa"){ echo "selected";}?>>Empresa</option>
                        <option value="Natural" <?php if($cliente->medio_transporte=="Natural"){ echo "selected";}?>>Natural</option>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Tipo de documento </span>
                      <?php $tipo_documentos = TipoDocumentoData::getAll();?>
                      <select name="tipo_documento" required class="form-control">
                      <?php foreach($tipo_documentos as $tipo_documento):?>
                        <option value="<?php echo $tipo_documento->id;?>" <?php if($cliente->tipo_documento!=null&& $cliente->tipo_documento==$tipo_documento->id){ echo "selected";}?>><?php echo $tipo_documento->nombre;?></option>
                      <?php endforeach;?>
                      </select>
                    </div>
                  </div>

                  
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Documento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->documento; ?>" name="documento" required placeholder="Ingrese documento">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombres &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->nombre; ?>" name="nombre" required placeholder="Ingrese nombres">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Procedencia &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->giro; ?>" name="giro"  placeholder="Ingrese Procedencia  (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Tel??fono &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->estado_civil; ?>" name="estado_civil"  placeholder="Ingrese Tel??fono  (OPCIONAL)">
                    </div>
                  </div> 

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> E-mail &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" value="<?php echo $cliente->direccion; ?>" name="direccion"  placeholder="Ingrese Direcci??n (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <h3>Datos adicionales<hr></h3>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Persona contacto </span>
                      <input type="text" class="form-control col-md-8" name="razon_social"  placeholder="Ingrese Persona contacto (OPCIONAL)" value="<?php echo $cliente->razon_social; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Parentesco &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="nacionalidad"  placeholder="Ingrese Parentesco (OPCIONAL)" value="<?php echo $cliente->nacionalidad; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> TE Contacto &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="ocupacion"  placeholder="Ingrese TE contacto (OPCIONAL)" value="<?php echo $cliente->ocupacion; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Obra social &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="destino"  placeholder="Ingrese Obra social (OPCIONAL)" value="<?php echo $cliente->destino; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> N??mero &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="telefono"  placeholder="Ingrese N??mero (OPCIONAL)" value="<?php echo $cliente->telefono; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Grupo sangu??neo</span>
                      <input type="text" class="form-control col-md-8" name="celular"  placeholder="Ingrese  grupo sangu??neo (OPCIONAL)" value="<?php echo $cliente->celular; ?>" >
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Al??rgico &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="alergia"  placeholder="Ingrese Alergia (OPCIONAL)" value="<?php echo $cliente->alergia; ?>" >
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Observaci??n &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                       <input type="text" class="form-control col-md-8" name="motivo"  placeholder="Ingrese observaci??n (OPCIONAL)" value="<?php echo $cliente->motivo; ?>">
                    </div>
                  </div>




                    
                 
                  
                </div>
                </div>

              </div>
              <div class="modal-footer">
                <input type="hidden" name="id_cliente" value="<?php echo $cliente->id; ?>">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-outline btn-success">Actualizar Datos</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal -->
      </div>

                    <?php endforeach; ?>
                    </tbody>
                      
                  </table>
                </div>

               <?php }else{ 
            echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";

                };
                ?>



                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->

                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->






   <div class="modal fade in" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form class="form-horizontal" method="post" action="index.php?view=addclientresidente" role="form">
              <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-users"></span> INGRESAR NUEVO CLIENTE RESIDENTE</h4>
              </div>
              <div class="modal-body" style="background-color:#fff !important;">
                
                <div class="row">
                <div class="col-md-offset-1 col-md-10">
                  
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Tipo huesped &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <select name="medio_transporte" required class="form-control">
                        <option value="Empresa" >Empresa</option>
                        <option value="Natural">Natural</option>
                      </select>
                    </div>
                  </div>

                  
                  <div class="form-group">
                    <div class="input-group"> 
                      <span class="input-group-addon"> Tipo de documento </span>
                      <?php $tipo_documentos = TipoDocumentoData::getAll();?>
                      <select name="tipo_documento" required class="form-control">
                      <?php foreach($tipo_documentos as $tipo_documento):?> 
                        <option value="<?php echo $tipo_documento->id;?>" ><?php echo $tipo_documento->nombre;?></option>
                      <?php endforeach;?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Documento &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="documento" required placeholder="Ingrese documento">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Nombres &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                      <input type="text" class="form-control col-md-8" name="nombre" required placeholder="Ingrese nombres">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Procedencia &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="giro"  placeholder="Ingrese Procedencia (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Tel??fono &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8"  name="estado_civil"  placeholder="Ingrese Tel??fono  (OPCIONAL)">
                    </div>
                  </div> 

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> E-mail &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="direccion"  placeholder="Ingrese E-mail (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <h3>Datos adicionales<hr></h3>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Persona contacto </span>
                      <input type="text" class="form-control col-md-8" name="razon_social"  placeholder="Ingrese Persona contacto (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Parentesco &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="nacionalidad"  placeholder="Ingrese Parentesco (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> TE Contacto &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="ocupacion"  placeholder="Ingrese TE contacto (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Obra social &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="destino"  placeholder="Ingrese Obra social (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> N??mero &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="telefono"  placeholder="Ingrese N??mero (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Grupo sangu??neo</span>
                      <input type="text" class="form-control col-md-8" name="celular"  placeholder="Ingrese  grupo sangu??neo (OPCIONAL)">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Al??rgico &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                      <input type="text" class="form-control col-md-8" name="alergia"  placeholder="Ingrese Alergia (OPCIONAL)">
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"> Observaci??n &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                       <input type="text" class="form-control col-md-8" name="motivo"  placeholder="Ingrese observaci??n (OPCIONAL)">
                    </div>
                  </div>

                  

                 
                  
                </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-outline btn-success">Agregar Datos</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal -->
      </div>

       
       
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>
        <script>
          
            var table = $('#editable-usage').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay informaci??n",
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

        <!--/ Page Specific Scripts -->



