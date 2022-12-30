

<link rel="stylesheet" href="assets/js/vendor/footable/css/footable.core.min.css">
<body id="minovate" class="appWrapper sidebar-sm-forced">
<div class="row">
<section class="content-header">
    <ol class="breadcrumb">
      <li><a href="index.php?view=reserva"><i class="fa fa-home"></i> Inicio</a></li>
      <li class="active"><a href="#">Reporte confirmada</a></li>
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
					RESERVAS POR MES CONFIRMADA</span>
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

              <input type="hidden" name="view" value="reserva_confirmado">
 
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
                        $me= '00';
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
              <label>MES </label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <!--
                <input type="text" id="txtMes" name="txtMes" placeholder=""
                 class="form-control input-sm" style=""> -->
                 <select class="form-control" name="mes" required="">
                  <option value="" >--- Selecciona ---</option>
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
                <h1 class="custom-font"><strong>CANTIDAD DE RESERVAS</strong>  </h1>




                <ul class="controls">
                 
                  <li class="dropdown">
                    <a href="javascript:print();"  >
                    <i class="fa fa-print"></i> Imprimir Reporte
                    </a>
                    <!--
                    <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                        <li><a id="print_saldos" href="reporte/pdf/documentos/reporte_kardex_todo.php?anio=<?php echo $anio; ?>&mes=<?php echo $me; ?>" target="_blanck"
								><i class="icon-file-pdf"></i> Saldos y Movimientos</a></li>
						<li class="divider"></li>
						<li><a id="print_entradas" href="reporte/pdf/documentos/reporte_kardex_entrada.php?anio=<?php echo $anio; ?>&mes=<?php echo $me; ?>" target="_blanck">
						<i class="icon-file-pdf"></i> Entradas del Mes</a></li>
						<li class="divider"></li>
						<li><a id="print_salidas" href="reporte/pdf/documentos/reporte_kardex_salida.php?anio=<?php echo $anio; ?>&mes=<?php echo $me; ?>" target="_blanck">
						<i class="icon-file-pdf"></i> Salidas del Mes</a></li>
                    </ul>
                  -->
                  </li>
                  <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                </ul>
              </div>


           <div class="tile-body">
            <div class="form-group">
              <label for="filter" style="padding-top: 5px">Buscar:</label>
              <input id="filter" type="text" class="form-control input-sm w-sm mb-12 inline-block"/>
            </div>




<?php
if(isset($_GET['mes'])){

$mess=$_GET['mes'];

    if($mess=='01'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
}
    else if($mess=='02'){

    $array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28");
 }
    else if($mess=='03'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
}
    else if($mess=='04'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30");
}
    else if($mess=='05'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
}
    else if($mess=='06'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30");
}
    else if($mess=='07'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
}
    else if($mess=='08'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
}
    else if($mess=='09'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30");
}
    else if($mess=='10'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
}
    else if($mess=='11'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30");
} 
    else if($mess=='12'){ 
$array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
}




           

$numero1=0;
?>

<table id="searchTextResults" data-filter="#filter" data-page-size="32" class="footable table table-custom" style="font-size: 11px;">
            <tr class="tr" style="width: 100%; ">
              
                
                <th>FECHA </th>
                <th>RESERVA RECIBIDAS</th>
                <th>RESERVA CONFIRMADAS</th>
                <th>ÉXITO EN CONFIRMACIONES DE RESERVA</th>
            </tr>
<?php
$egreso=0;
foreach ($array as $valor) { 

$numero1=$numero1+1;
?>
    <tr class="tr" >
                
                <td >
                    <?php
$mess=$_GET['mes'];
$fecha = "2019-$mess-$numero1";  
$fechats = strtotime($fecha); 

$mes=date("m", strtotime($fecha)); 

    if($mes=='01'){ $mes= 'Enero';}
    else if($mes=='02'){ $mes= 'Febrero';}
    else if($mes=='03'){ $mes= 'Marzo';}
    else if($mes=='04'){ $mes= 'Abril';}
    else if($mes=='05'){ $mes= 'Mayo';}
    else if($mes=='06'){ $mes= 'Junio';}
    else if($mes=='07'){ $mes= 'Julio';}
    else if($mes=='08'){ $mes= 'Agosto';}
    else if($mes=='09'){ $mes= 'Setiembre';}
    else if($mes=='10'){ $mes= 'Octubre';}
    else if($mes=='11'){ $mes= 'Noviembre';} 
    else if($mes=='12'){ $mes= 'Diciebre';}

?>

 
            <?php
                    switch (date('w', $fechats)){ 
    case 0: echo "Domingo".', '.$numero1.' de '.$mes; break; 
    case 1: echo "Lunes".', '.$numero1.' de '.$mes; break; 
    case 2: echo "Martes".', '.$numero1.' de '.$mes; break; 
    case 3: echo "Miercoles".', '.$numero1.' de '.$mes; break; 
    case 4: echo "Jueves".', '.$numero1.' de '.$mes; break; 
    case 5: echo "Viernes".', '.$numero1.' de '.$mes; break; 
    case 6: echo "Sabado".', '.$numero1.' de '.$mes; break;
}; ?>
                </td>
                <td >

                <?php $recibida = ProcesoData::getProcesoReservaReporte($_GET["anio"].'-'.$_GET["mes"].'-'.$numero1);
                if(count($recibida)>0){

                  $recibida01=count($recibida);

                echo $recibida01;

                }else{

                  $recibida01='0';

                  echo $recibida01;

                }; ?>

                </td>
                




                <td >

              <?php $confirmada = ProcesoData::getProcesoReservaReporteConfirmado($_GET["anio"].'-'.$_GET["mes"].'-'.$numero1);
                if(count($confirmada)>0){

                  $confirmada01=count($confirmada);

                echo $confirmada01;

                }else{

                  $confirmada01='0';

                  echo $confirmada01;

                }; ?>


                </td>

                <td ><?php if($confirmada01!='0' and $recibida01!='0'){ echo number_format((100*$confirmada01)/$recibida01,0,'.',',').' %';}else{echo "0%";} ?></td>
</tr>
<?php
};

};
?> 

</table>


 

              

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
