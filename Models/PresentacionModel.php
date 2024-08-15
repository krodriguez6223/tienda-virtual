<?php 

	class PresentacionModel extends Mysql
	{
		public $intIdcategoria;
		public $strCategoria;
		public $intStatus;
		public $strRuta;

		public function __construct()
		{
			parent::__construct();
		}

		public function inserCategoria(string $nombre, string $ruta, int $status){

			$return = 0;
			$this->strCategoria = $nombre;
			$this->strRuta = $ruta;
			$this->intStatus = $status;

			$sql = "SELECT * FROM catpresentacion WHERE nombre = '{$this->strCategoria}' AND status != 0";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO catpresentacion(nombre,ruta,status) VALUES(?,?,?)";
	        	
				$arrData = array($this->strCategoria, 
								 $this->strRuta, 
								 $this->intStatus);

	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

		public function selectCategorias() 
		{
			$sql = "SELECT * FROM catpresentacion 
					WHERE status != 0 ";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCategoria(int $idcategoria){
			
			$this->intIdcategoria = $idcategoria;
			$sql = "SELECT * FROM catpresentacion
					WHERE idcategoria = $this->intIdcategoria";
			$request = $this->select($sql);
			return $request;
		}

		public function updateCategoria(int $idcategoria, string $categoria, string $ruta, int $status){
			$this->intIdcategoria = $idcategoria;
			$this->strCategoria = $categoria;
			$this->strRuta = $ruta;
			$this->intStatus = $status;

			$sql = "SELECT * FROM catpresentacion WHERE nombre = '{$this->strCategoria}' AND idcategoria != $this->intIdcategoria";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE catpresentacion SET nombre = ?, ruta = ?, status = ? WHERE idcategoria = $this->intIdcategoria ";
				$arrData = array($this->strCategoria, 
								 $this->strRuta, 
								 $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteCategoria(int $idcategoria)
		{
			$this->intIdcategoria = $idcategoria;
			$sql = "SELECT * FROM producto WHERE colorid = $this->intIdcategoria";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE catpresentacion SET status = ? WHERE idcategoria = $this->intIdcategoria ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}	

		public function getCategoriasFooter(){
			$sql = "SELECT idcategoria, nombre,  ruta
					FROM catpresentacion WHERE  status = 1 AND idcategoria IN (".CAT_FOOTER.")";
			$request = $this->select_all($sql);
			if(count($request) > 0){
				
			}
			return $request;
		}


	}
