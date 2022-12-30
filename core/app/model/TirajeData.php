<?php
class TirajeData {
	public static $tablename = "tiraje";


	public function TirajeData(){
		$this->fecha = ""; 
		$this->nro_res_f = "";
		$this->nro_res = "";
		$this->serie = ""; 
		$this->fecha_creada = "NOW()";
	} 

	public function TipoComprobante(){ return TipoComprobanteData::getById($this->id_comprobante);}

	public function add(){
		$sql = "insert into tiraje (id_comprobante,fecha,nro_res_f,nro_res,serie,del,al,fecha_creada) ";
		$sql .= "value ($this->id_comprobante,\"$this->fecha\",\"$this->nro_res_f\",\"$this->nro_res\",\"$this->serie\",$this->del,$this->al,$this->fecha_creada)";
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

// partiendo de que ya tenemos creado un objecto PersonaData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set fecha=\"$this->fecha\",nro_res_f=\"$this->nro_res_f\",nro_res=\"$this->nro_res\",serie=\"$this->serie\",del=$this->del,al=$this->al where id=$this->id";
		Executor::doit($sql); 
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new TirajeData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename."  ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new TirajeData());
	}
 
	

}

?>