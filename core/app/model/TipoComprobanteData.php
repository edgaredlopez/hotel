<?php
class TipoComprobanteData {
	public static $tablename = "tipo_comprobante";



	public function TipoComprobanteData(){
		$this->nombre = "";
	
	}

	public function add(){
		$sql = "insert into tipo_comprobante (nombre,estado) ";
		$sql .= "value (\"$this->nombre\",\"$this->estado\")";
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

// partiendo de que ya tenemos creado un objecto TipoDocumentoData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",estado=\"$this->estado\"  where id=$this->id";
		Executor::doit($sql);
	}

	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new TipoComprobanteData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." where estado=1 ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TipoComprobanteData());
	}

	public static function getAllTodo(){
		$sql = "select * from ".self::$tablename."  ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TipoComprobanteData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where nombre like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TipoComprobanteData());

	}


}

?>