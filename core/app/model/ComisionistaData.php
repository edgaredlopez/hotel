<?php
class ComisionistaData {
	public static $tablename = "comisionista";


	public function ComisionistaData(){
		$this->nombre = ""; 
		$this->detalle = "";
		$this->fecha_creada = "NOW()";
	} 

	public function add(){
		$sql = "insert into comisionista (nombre,detalle,porcentaje,fecha_creada) ";
		$sql .= "value (\"$this->nombre\",\"$this->detalle\",\"$this->porcentaje\",$this->fecha_creada)";
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

// partiendo de que ya tenemos creado un objecto ComisionistaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",detalle=\"$this->detalle\",porcentaje=\"$this->porcentaje\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ComisionistaData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ComisionistaData());
	}

	
	


}

?>