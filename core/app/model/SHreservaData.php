<?php
class SHreservaData {
	public static $tablename = "sh_reserva";
	
	public function SHreservaData(){
		$this->nombre = "";
	}

	public function add(){
		$sql = "insert into sh_reserva (nombre,tipo) ";
		$sql .= "value (\"$this->nombre\",$this->tipo)";
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

// partiendo de que ya tenemos creado un objecto CategoriaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",tipo=$this->tipo where id=$this->id";
		Executor::doit($sql);
	}
	
	public function update_estado(){
		$sql = "update ".self::$tablename." set estado=0 where id=$this->id";
		Executor::doit($sql);
	}
	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SHreservaData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." where tipo=1 and estado=1 ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SHreservaData());
	}
	
	public static function getAllHabitacion(){
		$sql = "select * from ".self::$tablename." where tipo=2 and estado=1 ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SHreservaData());
	}



}

?>