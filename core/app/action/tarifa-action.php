              
<?php if(isset($_POST['id']) and $_POST['id']!=""){ ?>

<?php $tarifa = TarifaData::getById($_POST['id']); ?>          
                
                
                <div class="form-group col-md-4 mb-0">
                    <label for="pr-subject">Precio: </label>
                    <input type="number" class="form-control monto" name="precio" placeholder="Ingrese precio" value="<?php echo $tarifa->precio; ?>" onkeyup="sumar();" onchange="sumar();" id="precio">
                </div>
                
                <div class="form-group col-md-4 mb-0">
                    <label for="pr-subject"> Cant. noches: </label>
                    <input type="number" class="form-control monto" name="cant_noche" id="cant_noche" min="1" value="1" onkeyup="sumar();" onchange="sumar();" >
                </div>
                    
                

                <!--
                <div class="input-group"> 
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i> Persona extra&nbsp;&nbsp;&nbsp;
                  </div>
                -->
                  <input type="hidden" class="form-control monto" style="border-color: red;" name="extra" placeholder="Ingrese precio" value="0" onkeyup="sumar();" onchange="sumar();" id="extra">

                <!--  
                </div>
              -->
                <!-- /.input group -->
                <div class="input-group"> 
               
                  <h2 style="font-size: 18px;font-weight: bold;color: #51445f;"><span>Total a pagar: </span> <span id="spTotal" ><?php echo $tarifa->precio*1; ?></span></h2>
                
                
                </div>


<?php }; ?>