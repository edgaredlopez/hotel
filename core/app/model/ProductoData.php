<?php
class ProductoData {
	public static $tablename = "producto";


	public function ProductoData(){
		$this->codigo = ""; 
		$this->nombre = ""; 
		$this->marca = "";
		$this->descripcion = "";
		$this->precio_compra = "";
		$this->precio_venta = "";
		$this->fecha_creada = "NOW()";
	} 

	public function getProveedor(){ return PersonaData::getById($this->id_proveedor);}
	public function getCategoriaP(){ return CategoriaProData::getById($this->id_categoriap);}

	public function add(){
		$sql = "insert into producto (codigo,nombre,marca,presentacion,descripcion,precio_compra,precio_venta,stock,id_proveedor,fecha_creada,proveedor,id_categoriap) ";
		$sql .= "value (\"$this->codigo\",\"$this->nombre\",\"$this->marca\",\"$this->presentacion\",\"$this->descripcion\",\"$this->precio_compra\",\"$this->precio_venta\",\"$this->stock\",\"$this->id_proveedor\",$this->fecha_creada,\"$this->proveedor\",$this->id_categoriap)";
		return Executor::doit($sql);
	}

	public function addServicioSauna(){
		$sql = "insert into producto (codigo,nombre,descripcion,precio_venta,stock,fecha_creada,id_categoriap) ";
		$sql .= "value (\"$this->codigo\",\"$this->nombre\",\"$this->descripcion\",\"$this->precio_venta\",90000,$this->fecha_creada,$this->id_categoriap)";
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
		$sql = "update ".self::$tablename." set codigo=\"$this->codigo\",nombre=\"$this->nombre\",marca=\"$this->marca\",presentacion=\"$this->presentacion\",descripcion=\"$this->descripcion\",precio_compra=\"$this->precio_compra\",precio_venta=\"$this->precio_venta\",proveedor=\"$this->proveedor\",id_categoriap=$this->id_categoriap where id=$this->id";
		Executor::doit($sql);
	}

	public function updateSauna(){
		$sql = "update ".self::$tablename." set nombre=\"$this->nombre\",descripcion=\"$this->descripcion\",precio_venta=\"$this->precio_venta\" where id=$this->id";
		Executor::doit($sql);
	}

	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductoData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductoData());
	}

	public static function getAllServicio(){
		$sql = "select * from ".self::$tablename." where id_categoriap is not null";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductoData());
	}

	public static function getAllCategoria($id){
		$sql = "select * from ".self::$tablename." where id_categoriap=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductoData());
	}

	public static function getAllKiosko(){
		$sql = "select * from ".self::$tablename." where id_categoriap=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductoData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where nombre like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductoData());

	}

	public static function getUltimo(){
		$sql = "select * from ".self::$tablename." order by id desc ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductoData());

	}


}

?>