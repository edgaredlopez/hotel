<?php
class VentaData {
	public static $tablename = "venta";


	public function VentaData(){
		$this->nro_comprobante = ""; 
 
		 
		$this->fecha_creada = "NOW()";
	} 

	public function getTipoComprobante(){ return TipoComprobanteData::getById($this->id_tipo_comprobante);}
	public function getUsuario(){ return UserData::getById($this->id_usuario);}
	public function getProveedor(){ return PersonaData::getById($this->id_proveedor);}


	public function addVenta(){
		$sql = "insert into venta (id_tipo_comprobante,id_tipo_pago,tipo_operacion,id_proveedor,total,id_usuario,id_caja,fecha_creada) ";
		$sql .= "value ($this->id_tipo_comprobante,$this->id_tipo_pago,1,$this->id_proveedor,\"$this->total\",$this->id_usuario,$this->id_caja,$this->fecha_creada)";
		return Executor::doit($sql);
	} 

	public function addVentaNatural(){
		$sql = "insert into venta (id_tipo_comprobante,id_tipo_pago,tipo_operacion,id_proveedor,total,id_usuario,id_caja,fecha_creada,nro_casillero,nombre_cliente,tipo,efectivo,tarjeta,credito) ";
		$sql .= "value ($this->id_tipo_comprobante,$this->id_tipo_pago,1,$this->id_proveedor,\"$this->total\",$this->id_usuario,$this->id_caja,\"$this->fecha_creada\",\"$this->nro_casillero\",\"$this->nombre_cliente\",$this->tipo,\"$this->efectivo\",\"$this->tarjeta\",$this->credito)";
		return Executor::doit($sql);
	} 

	public function addVentaHuesped(){
		$sql = "insert into venta (id_tipo_comprobante,id_tipo_pago,tipo_operacion,id_proveedor,total,id_usuario,id_caja,fecha_creada,nro_casillero,nombre_cliente,tipo,efectivo,tarjeta,credito) ";
		$sql .= "value ($this->id_tipo_comprobante,$this->id_tipo_pago,1,$this->id_proveedor,\"$this->total\",$this->id_usuario,$this->id_caja,\"$this->fecha_creada\",\"$this->nro_casillero\",\"$this->nombre_cliente\",$this->tipo,\"$this->efectivo\",\"$this->tarjeta\",$this->credito)";
		return Executor::doit($sql);
	} 

	public function addCompra(){
		$sql = "insert into venta (id_tipo_comprobante,nro_comprobante,id_proveedor,id_tipo_pago,tipo_operacion,total,id_usuario,id_caja,fecha_creada,nro_credito,credito) ";
		$sql .= "value ($this->id_tipo_comprobante,\"$this->nro_comprobante\",$this->id_proveedor,$this->id_tipo_pago,2,\"$this->total\",$this->id_usuario,$this->id_caja,$this->fecha_creada,$this->nro_credito,$this->credito)";
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
		$sql = "update ".self::$tablename." set nro_comprobante=\"$this->nro_comprobante\" where id=$this->id";
		Executor::doit($sql);
	}

	public function updateCredito(){
		$sql = "update ".self::$tablename." set credito=\"$this->credito\" where id=$this->id";
		Executor::doit($sql);
	}


	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new VentaData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where tipo=2  order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VentaData());
	}

	public static function getAllServicio(){
		$sql = "select * from ".self::$tablename." where tipo=1 order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VentaData());
	} 

	public static function getAllCredito(){
		$sql = "select * from ".self::$tablename." where id_tipo_pago=4  and tipo_operacion=2 order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VentaData());
	}

	public static function getAllCreditoVenta(){
		$sql = "select * from ".self::$tablename." where id_tipo_pago=4  and tipo_operacion=1 and tipo=2 order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VentaData());
	}

	public static function getAllCreditoServicio(){
		$sql = "select * from ".self::$tablename." where id_tipo_pago=4  and tipo_operacion=1 and tipo=1 order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VentaData());
	}

	public static function getFiltroFechas($start,$end){
 		$sql = "select * from ".self::$tablename." where date(fecha_creada) >= \"$start\" and date(fecha_creada) <= \"$end\" and tipo_operacion=2   order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VentaData());
	}

	public static function getFiltroFechasProveedor($start,$end,$proveedor){
 		$sql = "select * from ".self::$tablename." where date(fecha_creada) >= \"$start\" and date(fecha_creada) <= \"$end\" and tipo_operacion=2 and id_proveedor=$proveedor   order by id desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new VentaData());
	}


	
	



} 

?>