<?php
class PagoProcesoData {
	public static $tablename = "proceso_pago";

	public function PagoProcesoData(){

		$this->fecha_creada = "NOW()";
	 
	}

	public function getTipoPago(){ return TipoPagoData::getById($this->id_tipopago);}
	public function getProceso(){ return ProcesoData::getById($this->id_proceso);}

	public function add(){ 
		$sql = "insert into proceso_pago (monto,nro_operacion,id_tipopago,id_proceso,id_caja,fecha_creada) ";
		$sql .= "value (\"$this->monto\",\"$this->nro_operacion\",$this->id_tipopago,$this->id_proceso,\"$this->id_caja\",NOW())";
		return Executor::doit($sql);
	}

	public function addMensual(){ 
		$sql = "insert into proceso_pago (monto,nro_operacion,id_tipopago,id_proceso,id_caja,fecha_creada,pagado) ";
		$sql .= "value (\"$this->monto\",\"$this->nro_operacion\",$this->id_tipopago,$this->id_proceso,\"$this->id_caja\",NOW(),$this->pagado)";
		return Executor::doit($sql);
	}

	public function addEstadia(){ 
		$sql = "insert into proceso_pago (monto,id_proceso,id_caja,fecha_creada,cantidad,fecha_entrada,fecha_salida,pagado) ";
		$sql .= "value (\"$this->monto\",$this->id_proceso,\"$this->id_caja\",NOW(),$this->cantidad,\"$this->fecha_entrada\",\"$this->fecha_salida\",0)";
		return Executor::doit($sql);
	}

	public function addEstadiaMensual(){ 
		$sql = "insert into proceso_pago (monto,id_tipopago,id_proceso,id_caja,fecha_creada,cantidad,fecha_entrada,fecha_salida,pagado) ";
		$sql .= "value (\"$this->monto\",$this->id_tipopago,$this->id_proceso,\"$this->id_caja\",NOW(),$this->cantidad,\"$this->fecha_entrada\",\"$this->fecha_salida\",$this->pagado)";
		return Executor::doit($sql);
	}

	public function addPago(){ 
		$sql = "insert into proceso_pago (monto,nro_operacion,id_tipopago,id_proceso,id_caja,fecha_creada,aval) ";
		$sql .= "value (\"$this->monto\",\"$this->nro_operacion\",$this->id_tipopago,$this->id_proceso,\"$this->id_caja\",NOW(),\"$this->aval\")";
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

// partiendo de que ya tenemos creado un objecto CategoryData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set monto=\"$this->monto\",nro_operacion=\"$this->nro_operacion\",id_tipopago=$this->id_tipopago,id_proceso=$this->id_proceso where id=$this->id";
		Executor::doit($sql);
	}

	public function updateProceso(){
		$sql = "update ".self::$tablename." set id_proceso=$this->id_proceso where id=$this->id";
		Executor::doit($sql);
	}

	public function updateSalida(){
		$sql = "update ".self::$tablename." set pagado=1,id_tipopago=$this->id_tipopago where id=$this->id";
		Executor::doit($sql);
	}



	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PagoProcesoData());

	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename." where estado=1 and pagado=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PagoProcesoData());
	}


	public static function getAllProceso($id_proceso){
		$sql = "select * from ".self::$tablename." where id_proceso=$id_proceso and pagado=1  order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PagoProcesoData());
	}

	public static function getAllProcesoTodo($id_proceso){
		$sql = "select * from ".self::$tablename." where id_proceso=$id_proceso and pagado=0  order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PagoProcesoData());
	}

	public static function getAllProcesoExtender($id_proceso){
		$sql = "select * from ".self::$tablename." where id_proceso=$id_proceso and pagado=0  order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PagoProcesoData());
	}

	public static function getAllProcesoExtenderMensual($id_proceso){
		$sql = "select * from ".self::$tablename." where id_proceso=$id_proceso   order by id asc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PagoProcesoData());
	}

	public static function getAllCaja($id_caja){
		$sql = "select * from ".self::$tablename." where id_caja=$id_caja and pagado=1  order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PagoProcesoData());
	}

	public static function getAllCajaTipoDocumento($id_caja,$id_documento){
		$sql = "select * from ".self::$tablename." where id_caja=$id_caja and id_tipopago=$id_documento and pagado=1 order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PagoProcesoData());
	}

	public static function getAllCajaMedioPago($id_caja,$id_pago){
		$sql = "select * from ".self::$tablename." where id_caja=$id_caja and id_tipopago=$id_pago and pagado=1  order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PagoProcesoData());
	}

	

}

?>