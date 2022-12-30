<?php
class HistorialMantenimientoData {
	public static $tablename = "historial_mantenimiento";

	public function HistorialMantenimientoData(){
		$this->detalle = "";
	}

	public function getHabitacion(){ return HabitacionData::getById($this->id_habitacion);}

	public function add(){
		$sql = "insert into historial_mantenimiento(id_habitacion,detalle,costo,fecha) ";
		$sql .= "value ($this->id_habitacion,\"$this->detalle\",\"$this->costo\",\"$this->fecha\")";
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
		$sql = "update ".self::$tablename." set detalle=\"$this->detalle\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_fecha(){
		$sql = "update ".self::$tablename." set fecha_fin=NOW() where id=$this->id";
		Executor::doit($sql);
	}
	
	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new HistorialMantenimientoData());

	}

	public static function getByIdHab($id){
		$sql = "select * from ".self::$tablename." where id_habitacion=$id and fecha_fin is null ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new HistorialMantenimientoData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new HistorialMantenimientoData());
	}

	public static function getAllHabitacion($id){
		$sql = "select * from ".self::$tablename." where id_habitacion=$id ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new HistorialMantenimientoData());
	}



}

?>