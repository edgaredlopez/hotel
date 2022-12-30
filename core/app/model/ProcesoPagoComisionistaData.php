<?php
class ProcesoPagoComisionistaData {
	public static $tablename = "proceso_pago_comision";


	public function ComisionistaData(){

		$this->fecha_creada = "NOW()";
	} 

	public function add(){
		$sql = "insert into proceso_pago_comision (id_comisionista,monto,fecha,fecha_creada,id_caja) ";
		$sql .= "value ($this->id_comisionista,\"$this->monto\",\"$this->fecha\",NOW(),\"$this->id_caja\")";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ProcesoPagoComisionistaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set monto=\"$this->monto\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProcesoPagoComisionistaData());

	}
 

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoPagoComisionistaData());
	}

	public static function getAllSueldos($id,$start,$end){
		$sql = "select * from ".self::$tablename." where id_comisionista=$id and date(fecha) >= \"$start\" and date(fecha) <= \"$end\" ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoPagoComisionistaData());
	}

	public static function getEgresoCaja($id_caja){
		$sql = "select * from ".self::$tablename." where id_caja=$id_caja ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProcesoPagoComisionistaData());
	}

	
	


}

?>