<?php
class TarifaData {
	public static $tablename = "tarifa";

	public function TarifaData(){
		$this->nombre = "";
		$this->fecha_creada = "NOW()";
	}

	public function add(){
		$sql = "insert into tarifa (nombre,precio) ";
		$sql .= "value (\"$this->nombre\",$this->precio)";
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

// partiendo de que ya tenemos creado un objecto TarifaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",precio=$this->precio where id=$this->id";
		Executor::doit($sql);
	}
	
	public function update_estado(){
		$sql = "update ".self::$tablename." set estado=0 where id=$this->id";
		Executor::doit($sql);
	}

	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new TarifaData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." where estado=1 ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TarifaData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where nombre like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TarifaData());

	}


}

?>