<?php 
date_default_timezone_set('America/Lima');
$hoy = date("Y-m-d"); 
$hora = date("H:i:s");
?>        
<?php if(isset($_POST['id']) and $_POST['id']!="" and $_POST['id']=='1'){ ?>

					<div class="form-group">
                        <label for="inputEmail1" class="col-lg-4 control-label">CANT NOCHES*</label>
                        <div class="col-md-7">   
                           <input type="number" name="cant_noche" required class="form-control validanumericos" placeholder="Ejem. 6 horas" >   
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-4 control-label">PRECIO X NOCHE*</label>
                        <div class="col-md-7">  
                           <input type="number" name="precio" required class="form-control validanumericos"  placeholder="Ingrese precio x noche" >   
                        </div>
                      </div>


<?php }else{ ?> 
					<div class="form-group">
                        <label for="inputEmail1" class="col-lg-4 control-label">CANT HORAS*</label>
                        <div class="col-md-7">  
                           <input type="number" name="cant_noche" required class="form-control validanumericos" placeholder="Ejem. 6 horas" >   
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail1" class="col-lg-4 control-label">PRECIO X HORA*</label>
                        <div class="col-md-7">  
                           <input type="number" name="precio" required class="form-control validanumericos"  placeholder="Ingrese precio x noche" >   
                        </div>
                      </div>


<?php }; ?>