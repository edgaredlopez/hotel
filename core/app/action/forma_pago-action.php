              
<?php if(isset($_POST['id_forma_pago']) and $_POST['id_forma_pago']=='1'){ ?>
                <div class="col-sm-12">
                    <label>Forma de Pago</label>
                    <select  data-placeholder="..."  name="contado"
                      class="form-control" style="text-transform:uppercase;" onChange="pagoOnChange(this)">
                        <?php $medipagos = TipoPagoData::getAllSC5();
                      if(count($medipagos)>0){ ?>
                  
                      <?php foreach($medipagos as $mediopago):?>
                        <option value="<?php echo $mediopago->id; ?>" ><?php echo $mediopago->nombre; ?></option>
                      <?php endforeach; ?>
                  

                      <?php }else{ };?>  
                                      
                    </select>
                  </div>

<?php }else if (isset($_POST['id_forma_pago']) and $_POST['id_forma_pago']=='2') { ?>

            
            <input type="hidden" value="1" name="contado">
            
             
<?php }; ?>