              
<?php if(isset($_POST['id_mostrar_cliente']) and $_POST['id_mostrar_cliente']=='1'){ ?>




              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12"> 
                    <label>Cargar a una Habitación</label>
                    <select class="form-control select2" required  name="id_operacion">  
                        <option value="">---- Selecciona Habitación ----</option> 
                                  <?php $habitaciones = ProcesoData::getProceso();?>
                                  <?php foreach($habitaciones as $habitacion):?>
                                    <option value="<?php echo $habitacion->id;?>"><?php echo 'Habitacion:: '.$habitacion->getHabitacion()->nombre.' &nbsp;&nbsp;&nbsp; Huesped:: '. $habitacion->getCliente()->nombre;?></option>
                                  <?php endforeach;?>
                    </select>  
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12"> 
                    <label>Proceso</label>
                    <select class="form-control select2" required  name="pagado" >
                        <option value="1">Cancelado</option>  
                        <option value="2">Cargar a habitación</option> 
                    </select>  
                  </div>
                </div>
              </div>

<?php }else if (isset($_POST['id_mostrar_cliente']) and $_POST['id_mostrar_cliente']=='2') { ?>

            

            <div class="form-group">
                <div class="row">
                  <div class="col-sm-12"> 
                    <label>Cliente</label>
                    <select  data-placeholder="..."  name="id_clienteee"
                      class="form-control" style="text-transform:uppercase;" required="" >
                        <?php $clientes = PersonaData::getAll();?>
                        <option value="">---- Selecciona Cliente ----</option>
                        <?php foreach($clientes as $cliente):?>
                          <option value="<?php echo $cliente->id;?>"><?php echo $cliente->documento.' | '.$cliente->nombre;?></option>
                        <?php endforeach;?>
                                      
                    </select>
                  </div>
                </div>
              </div>  
              <!--
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12"> 
                    <label>Documento del cliente</label>
                    <input type="text" name="documento_cliente" class="form-control" required=""  placeholder="Ingrese documento (RUC y/o DNI) ">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12"> 
                    <label>Nombres o Razón social</label>
                    <input type="text" name="nombre_cliente" class="form-control" required=""  placeholder="Ingrese nombre ">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12"> 
                    <label>Dirección del cliente</label>
                    <input type="text" name="direccion_cliente" class="form-control" required=""  placeholder="Ingrese Dirección">
                  </div>
                </div>
              </div>
 
               <div class="form-group">
                <div class="row">
                  <div class="col-sm-12"> 
                    <label>Proceso</label>
                    <select class="form-control select2" required  name="pagado" >
                        <option value="1">Cancelado</option>  
                 
                    </select>  
                  </div>
                </div>
              </div>
            -->
<?php }; ?>