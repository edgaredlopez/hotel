              
<?php if(isset($_POST['id']) and $_POST['id']>0){ ?>
                <label for="pr-subject">Medio pago: </label>
                <select class="form-control" onchange="CargarMediopago(this.value);" required name="id_tipo_pago">
                    
                      <option value="">--- Selecciona ---</option>

                      <?php $medipagos = TipoPagoData::getAll();
                      if(count($medipagos)>0){ ?>
                  
                      <?php foreach($medipagos as $mediopago):?>
                        <option value="<?php echo $mediopago->id; ?>" <?php if($mediopago->id=='1'){ echo "selected";} ?>><?php echo $mediopago->nombre; ?></option>
                      <?php endforeach; ?>

                      <?php }else{ };?>
                </select> 

<?php }else if (isset($_POST['id']) and $_POST['id']<=0) { ?>

<input type="hidden" value="1" name="id_tipo_pago">
          
<?php }; ?>