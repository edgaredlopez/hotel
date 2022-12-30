<?php
class EsperadoData {
	public static $tablename = "esperado";



	public function EsperadoData(){
		
		$this->fecha_creada = "NOW()";
	}

	public function add(){
		$sql = "insert into esperado (mes,anio,cantidad,fecha_creada) ";
		$sql .= "value (\"$this->mes\",$this->anio,$this->cantidad,NOW())";
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
		$sql = "update ".self::$tablename." set mes=\"$this->mes\",anio=$this->anio,cantidad=$this->cantidad where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EsperadoData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new EsperadoData());
	}


	public static function getAllMesAnio($mes,$anio){
		$sql = "select * from ".self::$tablename." where mes=\"$mes\" and anio=$anio";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EsperadoData());
	}

	


}

?>