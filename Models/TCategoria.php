<?php 
require_once("Libraries/Core/Mysql.php");
trait TCategoria{
	private $con;

	public function getCategoriasT(string $categorias){
		$this->con = new Mysql();
		$sql = "SELECT idcategoria, nombre, ruta
				 FROM categoria WHERE status != 0 AND idcategoria IN ($categorias)";
		$request = $this->con->select_all($sql);
		if(count($request) > 0){
			
		}
		return $request;
	}
	public function getPortadasT(string $portadas){
		$this->con = new Mysql();
		$sql = "SELECT idportada, nombre, descripcion, portada, ruta
				 FROM portada WHERE status != 0 AND idportada IN ($portadas)";
		$request = $this->con->select_all($sql);
		if(count($request) > 0){
			for ($c=0; $c < count($request) ; $c++) { 
				$request[$c]['portada'] = BASE_URL.'/Assets/images/uploads/portada/'.$request[$c]['portada'];		
			}
		}
		return $request; 
	}

	public function getCategorias(){
		$this->con = new Mysql();
		$sql = "SELECT c.idcategoria, c.nombre, c.ruta, count(p.categoriaid) AS cantidad
				FROM producto p 
				INNER JOIN categoria c
				ON p.categoriaid = c.idcategoria
				WHERE c.status = 1
				GROUP BY p.categoriaid, c.idcategoria";
		$request = $this->con->select_all($sql);
		if(count($request) > 0){
			
		}
		return $request;
	}
	public function getCatColor(){
		$this->con = new Mysql();
		$sql = "SELECT idcategoria, nombre FROM catcolores WHERE status = 1;";
		
		$request = $this->con->select_all($sql);
		
		return $request;

	}
	public function getCatPresentacion(){
		$this->con = new Mysql();
		$sql = "SELECT idcategoria, nombre FROM catpresentacion WHERE status = 1;";
		$request = $this->con->select_all($sql);
		return $request;

	}
	public function getColores(){
		$this->con = new Mysql();
		$sql = "SELECT c.idcategoria, c.nombre, c.ruta, count(p.categoriaid) AS cantidad
				FROM producto p 
				INNER JOIN catcolores c
				ON p.colorid = c.idcategoria
				WHERE c.status = 1
				GROUP BY p.categoriaid, c.idcategoria";
		$request = $this->con->select_all($sql);

		return $request;
	}
	public function getPresentacion(){
		$this->con = new Mysql();
		$sql = "SELECT c.idcategoria, c.nombre, c.ruta, count(p.categoriaid) AS cantidad
				FROM producto p 
				INNER JOIN catpresentacion c
				ON p.categoriaid = c.idcategoria
				WHERE c.status = 1
				GROUP BY p.categoriaid, c.idcategoria";
		$request = $this->con->select_all($sql);
		if(count($request) > 0){
			
		}
		return $request;
	}
}

 ?>