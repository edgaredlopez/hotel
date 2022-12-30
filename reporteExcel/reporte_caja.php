<?php
include "../core/autoload.php";
include "../core/app/model/ProcesoData.php";
include "../core/app/model/PersonaData.php";
include "../core/app/model/HabitacionData.php";
include "../core/app/model/PagoProcesoData.php";
include "../core/app/model/ProcesoVentaData.php";
include "../core/app/model/TipoPagoData.php";
include "../core/app/model/GastoData.php";
include "../core/app/model/ProcesoPagoComisionistaData.php";
include "../core/app/model/ProcesoSueldoData.php";
include "../core/app/model/CajaData.php";
include "../core/app/model/UserData.php";


set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
// PHPExcel
include 'Classes1/PHPExcel.php';
// PHPExcel_IOFactory
include 'Classes1/PHPExcel/IOFactory.php';
// Creamos un objeto PHPExcel
$objPHPExcel = new PHPExcel();
date_default_timezone_set('America/Guatemala');
$hoy = date("Y-m-d");
$hora = date("H:i:s");                   
$cajas = CajaData::getFiltroFechas($_GET['start'],$_GET['end']);
// Leemos un archivo Excel 2007
$objReader = PHPExcel_IOFactory::createReader('Excel2007');
 
$objPHPExcel = $objReader->load("reporte_caja.xlsx");

  

		$i = 9;
		foreach($cajas as $caja){ 
		    
		    $ingreso=0; $ingreso_efectivo=0; $ingreso_efectivo_prod=0;
                    
                    $tipos = TipoPagoData::getAll();
                    if(count($tipos)>0){
                        foreach($tipos as $tipo):
                                              
                                             $total_proceso=0; 
                                             $tmps = PagoProcesoData::getAllCajaTipoDocumento($caja->id,$tipo->id); 
                                            foreach($tmps as $p):
                                                $total_proceso=$total_proceso+$p->monto;
                                            endforeach; 
                                            
                                            
                                            $total_venta=0; 
                                            $ventas = ProcesoVentaData::getIngresoCajaTipoDocumento($caja->id,$tipo->id); 
                                            foreach($ventas as $venta):  
                                                $total_venta=$total_venta+($venta->precio*$venta->cantidad); 
                                            endforeach; 
                                            
                                            $ingreso=($total_venta+$total_proceso)+$ingreso; 
                                            if($tipo->id=='1'){ $ingreso_efectivo=($total_proceso)+$ingreso_efectivo;} 
                                            if($tipo->id=='1'){ $ingreso_efectivo_prod=($total_venta)+$ingreso_efectivo_prod;} 
                        endforeach; 
                                            
                                            
                        }else{ $ingreso=0; $ingreso_efectivo=0; } 
                        
                        
                        
                                            
                                            
                                    $otros_ingresos = GastoData::getIngresoNuevoCaja($caja->id);
                                    $total_otros_ingresos=0;
                                    if(count($otros_ingresos)>0){
                                      foreach($otros_ingresos as $otros_ingreso):
                                        $total_otros_ingresos=$otros_ingreso->precio+$total_otros_ingresos;
                                      endforeach;
                                    } 
                    
                    
                     $montos_sin_cerrar_egresos = GastoData::getEgresoCaja($caja->id);
                                    $total_sin_cerrar_egreso=0;
                                    if(count($montos_sin_cerrar_egresos)>0){
                                      foreach($montos_sin_cerrar_egresos as $montos_sin_cerrar_egreso):
                                        $total_sin_cerrar_egreso=$montos_sin_cerrar_egreso->precio+$total_sin_cerrar_egreso;
                                      endforeach;
                                    } 
                    
                     
                              
                              $reporproducts_es = ProcesoVentaData::getEgresoCaja($caja->id);
                              $subtotal4=0;
                              if(count($reporproducts_es)>0){ 
                                    foreach($reporproducts_es as $reporproduct_e):
                                        $subtotal1=$reporproduct_e->cantidad*$reporproduct_e->precio; 
                                        $subtotal4=$subtotal1+$subtotal4; 
                                    endforeach; 
                                    }else{$subtotal4=0;} 
                                    
                                    
                                    
                                    $egreso_comisions = ProcesoPagoComisionistaData::getEgresoCaja($caja->id);
                                    $total_comision=0;
                                    if(count($egreso_comisions)>0){
                                      foreach($egreso_comisions as $egreso_comision):
                                        $total_comision=$egreso_comision->monto+$total_comision;
                                      endforeach;
                                    } 
                              
                              
                              
                               $egreso_trabajadores = ProcesoSueldoData::getSueldoCajaResumen($caja->id);
                                    $total_trabajador=0;
                                    if(count($egreso_trabajadores)>0){
                                      foreach($egreso_trabajadores as $egreso_trabajador):
                                        $total_trabajador=$egreso_trabajador->monto+$total_trabajador;
                                      endforeach;
                                    } 
                              
                              
                               $egreso=$total_trabajador+$total_comision+$subtotal4+$total_sin_cerrar_egreso; 
                        
       
                        
		
			    
			 $total01= $ingreso_efectivo+$ingreso_efectivo_prod;
			 $total02= ($ingreso_efectivo+$ingreso_efectivo_prod)-$egreso+$total_otros_ingresos+$caja->monto_apertura;
			 $total03=$ingreso-($ingreso_efectivo+$ingreso_efectivo_prod);
			 $total04=($ingreso-$egreso)+$total_otros_ingresos+$caja->monto_apertura;
			 
			
			$objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(-1); 
			$objPHPExcel->setActiveSheetIndex(0)
	
				    ->setCellValue('B'.$i,  $caja->getUsuario()->name)
					->setCellValue('C'.$i,  $caja->fecha_apertura)
					->setCellValue('D'.$i,  $caja->monto_apertura)
					->setCellValue('E'.$i,  $egreso)
				    ->setCellValue('F'.$i,  $total_otros_ingresos)
				    ->setCellValue('G'.$i,  $ingreso_efectivo)
				    ->setCellValue('H'.$i,  $ingreso_efectivo_prod)
				    ->setCellValue('I'.$i,  $total01)
				    ->setCellValue('J'.$i,  $total02)
				    ->setCellValue('K'.$i,  $total03)
				    ->setCellValue('L'.$i,  $total04)
				    ->setCellValue('M'.$i,  $caja->fecha_cierre)
				    ->setCellValue('N'.$i,  "Cerrado");
				    
	

					$i++;
					
		}  
		
 

//Guardamos el archivo en formato Excel 2007
//Si queremos trabajar con Excel 2003, basta cambiar el 'Excel2007' por 'Excel5' y el nombre del archivo de salida cambiar su formato por '.xls'
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reporte_caja.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	