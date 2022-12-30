<?php
class TipoPagoData {
	public static $tablename = "tipo_pago";



	public function TipoPagoData(){
		$this->nombre = "";
		$this->fecha_creada = "NOW()";
	}

	public function add(){
		$sql = "insert into tipo_documento (nombre,fecha_creada) ";
		$sql .= "value (\"$this->nombre\",$this->fecha_creada)";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto TipoPagoData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\" where id=$this->id";
		Executor::doit($sql);
	}

	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new TipoPagoData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." where  id!=5 and estado=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TipoPagoData());
	}

	public static function getAllSC(){
		$sql = "select * from ".self::$tablename." where id!=4 and id!=5 and estado=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TipoPagoData());
	}

	public static function getAllSC5(){
		$sql = "select * from ".self::$tablename." where estado=1 ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TipoPagoData());
	}


	


}

?>