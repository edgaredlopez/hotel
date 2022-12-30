<?php
class NivelData {
	public static $tablename = "nivel";



	public function NivelData(){
		$this->nombre = ""; 
		$this->fecha_creada = "NOW()";
	} 

	public function add(){
		$sql = "insert into nivel (nombre,fecha_creada) ";
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

// partiendo de que ya tenemos creado un objecto NivelData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\" where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new NivelData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new NivelData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where nombre like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new NivelData());

	}

	public static function getOcupados(){
		$sql = "select * from ".self::$tablename." where estado=2 ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new HabitacionData());

	}


}

?>