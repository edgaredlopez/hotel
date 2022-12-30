


<?php 
date_default_timezone_set('America/Lima');
  $hoy = date("Y-m-d"); 
  
  
  $hora = date("H:i:s");
  $doce = date("12:00:00");

  $nuevafecha = strtotime ( '-1 month' , strtotime ( $hoy ) ) ;
  $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
?>

<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      <li><a href="javascript:;">Pagos</a></li>
      <li class="active"><a href="#">Pagos a comisionistas</a></li>
    </ol>
</section> 

</div> 




<div id="reload-full-div">
	<div class="breadcrumb-line">
		
	  <div class="row">
		 <div class="breadcrumb col-lg-12">
				<div style="background-color: #16a085;color: white;padding: 2px;font-size: 20px;
				text-align: center; text-transform: uppercase;font-weight: bold;width: 100%;">
					<span>
					Pagos a comisionistas</span>
			    </div>
	   	  </div>
	  </div>
	</div>
	<br> 
	 <div class="row"> 
		 <div class="col-sm-12 col-md-12">
		 	<form role="form" autocomplete="off" class="form-validate-jquery" id="" method="get">
				<div class="form-group">
					<div class="row">
						<div class="col-sm-2">
							<label>AÑO</label>

              <input type="hidden" name="view" value="sueldo_comisionista">
 
							<div class="input-group">
  							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <!--
  							<input type="text" id="txtMes" name="txtMes" placeholder=""
  							 class="form-control input-sm" style=""> -->
                 <?php  
                    if(isset($_GET['anio']) and isset($_GET['mes']) and $_GET['anio']!=''){
                        $me= $_GET['mes'];
                        $anio= $_GET['anio'];
                    }else{
                        $me= date("m");
                        $anio= date("Y");
                    }
                            
                  ?>
                 <select class="form-control" name="anio">
                   <option value="2017" <?php if($anio=='2017'){ echo "selected";}; ?>>2017</option>
                   <option value="2018" <?php if($anio=='2018'){ echo "selected";}; ?>>2018</option>
                   <option value="2019" <?php if($anio=='2019'){ echo "selected";}; ?>>2019</option>
                   <option value="2020" <?php if($anio=='2020'){ echo "selected";}; ?>>2020</option>
                   <option value="2021" <?php if($anio=='2021'){ echo "selected";}; ?>>2021</option>
                   <option value="2022" <?php if($anio=='2022'){ echo "selected";}; ?>>2022</option>
                 </select>
	             </div>
						</div>
            <div class="col-sm-3">
              <label>MES PAGO</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <!--
                <input type="text" id="txtMes" name="txtMes" placeholder=""
                 class="form-control input-sm" style=""> -->
                 <select class="form-control" name="mes">
                   <option value="01" <?php if($me=='01'){ echo "selected";}; ?>>Enero</option>
                   <option value="02" <?php if($me=='02'){ echo "selected";}; ?>>Febrero</option>
                   <option value="03" <?php if($me=='03'){ echo "selected";}; ?>>Marzo</option>
                   <option value="04" <?php if($me=='04'){ echo "selected";}; ?>>Abril</option>
                   <option value="05" <?php if($me=='05'){ echo "selected";}; ?>>Mayo</option>
                   <option value="06" <?php if($me=='06'){ echo "selected";}; ?>>Junio</option>
                   <option value="07" <?php if($me=='07'){ echo "selected";}; ?>>Julio</option>
                   <option value="08" <?php if($me=='08'){ echo "selected";}; ?>>Agosto</option>
                   <option value="09" <?php if($me=='09'){ echo "selected";}; ?>>Setiembre</option>
                   <option value="10" <?php if($me=='10'){ echo "selected";}; ?>>Octubre</option>
                   <option value="11" <?php if($me=='11'){ echo "selected";}; ?>>Noviembre</option>
                   <option value="12" <?php if($me=='12'){ echo "selected";}; ?>>Diciembre</option>
                 </select>
               </div>
            </div>
						<div class="col-sm-4">
							<button style="margin-top: 27px;" id="btnGuardar" type="submit" class="btn btn-primary btn-sm"> 
							<i class="fa fa-search"></i> Consultar</button>
						</div>
					</div>
				</div>
			  </form>
	   	  </div>
	  </div>









<!-- row --> 
<div class="row">
  <!-- col --> 
  <div class="col-md-12">
    <section class="tile">

             <div class="tile-header dvd dvd-btm">  
                <h1 class="custom-font"><strong>PAGOS DEL MES </strong>   </h1>



                <!--
                <ul class="controls">  
                  
                  <li class="dropdown">
                    <a  role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                    <i class="fa fa-print"></i><i class="fa fa-print"></i> Imprimir Reporte
                    </a>
                    <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                       
						<li><a id="print_entradas" href="reporte/pdf/documentos/reporte_pago.php?mes=<?php echo $me; ?>&anio=<?php echo $anio; ?>" target="_blanck">
						<i class="icon-file-pdf"></i> Pagos del Mes</a></li>
						<li class="divider"></li>
						
                    </ul>
                  </li>
                  <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                </ul>
              -->
              </div>

            

           <div class="tile-body">
            <div class="form-group">
              <label for="filter" style="padding-top: 5px">Buscar:</label>
              <input id="filter" type="text" class="form-control input-sm w-sm mb-12 inline-block"/>
            </div>

 
              <?php $sueldos = ComisionistaData::getAll();
                if(@count($sueldos)>0){
                  // si hay usuarios
                  ?>
                  <table id="searchTextResults" data-filter="#filter" data-page-size="7" class="footable table table-custom" style="font-size: 11px;">

                  <thead style="color: white; background-color: #827e7e;">
                        <th>DESDE</th> 
                        <th>HASTA</th> 
                        <th>COMISIONISTA</th>
                        <th>MONTO</th>
                        <th>PORCENTAJE</th>
                        <th>CORRESPONDE</th>
                        
                        <th>MONTO PAGADO</th>
                        <th>RESTA</th>
                        <th>ESTADO</th>
                        <th>REMUNERAR</th>
                       
                  </thead>
                   <?php foreach($sueldos as $sueldo):?>
                      <tr>

                        <?php  
                            if(isset($_GET['anio']) and isset($_GET['mes']) and $_GET['anio']!=''){

                              $dia= date("d", strtotime($sueldo->fecha_creada));
                              $anio=$_GET['anio'];
                              $mes=$_GET['mes'];
                              $mes_1=$_GET['mes']-1;

                              $start = date("$anio-0$mes_1-$dia");
                              $end= date("$anio-$mes-$dia");
                            }else{

                              $dia= date("d", strtotime($sueldo->fecha_creada));
                              $start= date("Y-m-$dia", strtotime($nuevafecha));
                              $end=  date("Y-m-$dia", strtotime($hoy));
                            }
                            
                        ?>
                        
                        <?php $debe=0; ?> 
                        <?php $codebes = ProcesoData::getByComisionista($sueldo->id,$start,$end);
                        if(@count($codebes)>0){ ?>
                        <?php foreach($codebes as $codebe): $debe=($codebe->precio*$codebe->cant_noche)+$debe;  endforeach; ?>
                        <?php }else{ $debe=0; }; ?>
                       
                        <td><?php echo $start; ?></td>
                        <td><?php echo $end; ?></td>
                        <td><?php echo $sueldo->nombre; ?></td> 
                        <td>$    <?php echo number_format($debe,2,'.',','); ?></td> 
                        <td><?php echo $sueldo->porcentaje.' %'; ?></td> 

                        <?php $corresponde=($sueldo->porcentaje*$debe)/100; ?> 
                        
                        <td>$    <?php echo number_format($corresponde,2,'.',','); ?></td>  
                        

                        

                        <?php $acumulado=0; ?> 
                        <?php $acumulados = ProcesoPagoComisionistaData::getAllSueldos($sueldo->id,$start,$end);
                    		if(@count($acumulados)>0){ ?>
                       			<?php foreach($acumulados as $acumula): $acumulado=$acumula->monto+$acumulado;  endforeach; ?>
                   			<?php }else{ $acumulado=0; }; ?>
 
                        
 
                        <td><?php echo $acumulado; ?></td>

                      

 

                       
                        
                        <?php $resta = ($corresponde)-($acumulado); ?>
                        <td>
                          <?php if($resta=='0' or $resta<0){ ?>
                          <p style="color: green;"><b>Completado</b></p>
                          <?php }else{ ?>
                          <?php echo ($corresponde)-($acumulado); ?>
                          <?php }; ?>

                          </td>
                        
                        <td>
                          <?php if($resta=='0' or $resta<0){ ?>
                          <p style="color: green;"><b>Completado</b></p>
                          <?php }else{ ?>
                          <p style="color: orange;"><b>En proceso</b></p>
                          <?php }; ?>
                          
                        </td>
                        <td>
                        <a href="index.php?view=proceso_sueldo_comision&id=<?php echo $sueldo->id; ?>&start=<?php echo $start; ?>&end=<?php echo $end; ?>"  class="btn btn-warning btn-xs"><i class="fa fa-money"></i> Realizar pago </a>
                        </td>
                        
                        

     
                        
                        
                      </tr> 
                    



                      

<?php endforeach; ?>
                      <tfoot class="hide-if-no-paging">
                        <tr>
                          <td colspan="7" class="text-center">
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
