<?php
class InventaryBedData {
	public static $tablename = "inventary_bed";



	public function InventaryBedData(){
		$this->name = "";
		$this->create_date = "NOW()";
	}

	public function getUsuario(){ return UserData::getById($this->id_usuario);}
	public function getProveedor(){ return PersonaData::getById($this->id_proveedor);}

	public function add(){ 
		$sql = "insert into inventary_bed (name,quantity,bed_id,create_date) ";
		$sql .= "value (\"$this->name\",$this->quantity,$this->bed_id,$this->create_date)";
		Executor::doit($sql);
	}

	public function addInServicio(){ 
		$sql = "insert into inventary_bed (name,quantity,bed_id,create_date,descripcion,id_proveedor,precio,id_usuario,tipo) ";
		$sql .= "value (\"$this->name\",$this->quantity,$this->bed_id,$this->create_date,\"$this->descripcion\",$this->id_proveedor,\"$this->precio\",$this->id_usuario,2)";
		Executor::doit($sql);
	}

	public function addServicio(){
		$sql = "insert into inventary_bed (name,quantity,bed_id,create_date,tipo) ";
		$sql .= "value (\"$this->name\",$this->quantity,$this->bed_id,$this->create_date,2)";
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

// partiendo de que ya tenemos creado un objecto InventaryBedData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",quantity=$this->quantity where id=$this->id";
		Executor::doit($sql);
	}

	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new InventaryBedData());

	}

	public static function getAll($id){
		$sql = "select * from ".self::$tablename." where bed_id=$id and tipo=1 order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InventaryBedData());
	}

	public static function getAllServicios($id){
		$sql = "select * from ".self::$tablename." where bed_id=$id and tipo=2 order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new InventaryBedData());
	}


	


}

?>