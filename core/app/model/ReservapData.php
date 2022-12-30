<?php
class ReservapData {
	public static $tablename = "reserva";
	
	public function ReservapData(){

	} 

	public function getHabitacion(){ return SHreservaData::getById($this->id_habitacion);}
	public function getServicio(){ return SHreservaData::getById($this->id_servicio);}
	public function getPersona(){ return PersonaData::getById($this->id_cliente);}
	public function getUsuario(){ return UserData::getById($this->id_usuario);}

	public function add(){
		$sql = "insert into reserva (fecha_entrada,fecha_salida,id_habitacion,id_servicio,id_cliente,total,acuenta,id_caja,id_usuario,fecha_creada) ";
		$sql .= "value (\"$this->fecha_entrada\",\"$this->fecha_salida\",$this->id_habitacion,$this->id_servicio,$this->id_cliente,$this->total,$this->acuenta,$this->id_caja,$this->id_usuario,NOW())";
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

// partiendo de que ya tenemos creado un objecto HabitacionData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set fecha_entrada=\"$this->fecha_entrada\",fecha_salida=\"$this->fecha_salida\",id_habitacion=$this->id_habitacion,id_servicio=$this->id_servicio,id_cliente=$this->id_cliente,total=$this->total,acuenta=$this->acuenta,id_caja=$this->id_caja,id_usuario=$this->id_usuario where id=$this->id";
		Executor::doit($sql);
	}



	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservapData());

	}


	public static function getAll($hoy){
		$sql = "select * from ".self::$tablename." where  date(fecha_entrada) >= \"$hoy\"  order by id asc  ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservapData());
	}
	
	public static function getIngresoRangoFechas($start,$end){
		$sql = "select * from ".self::$tablename." where  date(fecha_entrada) >= \"$start\" and date(fecha_entrada) <= \"$end\"  order by id desc  ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ReservapData());
	}

	


}

?>