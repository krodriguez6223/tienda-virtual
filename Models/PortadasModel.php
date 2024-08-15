<?php 

	class PortadasModel extends Mysql
	{
		public $intIdportada;
		public $strPortada;
		public $strDescripcion;
		public $intStatus;
		public $strFotoPortada;
		public $strRuta;

		public function __construct()
		{
			parent::__construct();
		}

		public function inserPortada(string $nombre, string $descripcion, string $foto_portada, string $ruta, int $status){

			$return = 0;
			$this->strPortada = $nombre;
			$this->strDescripcion = $descripcion;
			$this->strFotoPortada = $foto_portada;
			$this->strRuta = $ruta;
			$this->intStatus = $status;

			$sql = "SELECT * FROM portada WHERE nombre = '{$this->strPortada}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO portada(nombre,descripcion,portada,ruta,status) VALUES(?,?,?,?,?)";
	        	$arrData = array($this->strPortada, 
								 $this->strDescripcion, 
								 $this->strFotoPortada,
								 $this->strRuta, 
								 $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

		public function selectPortadas()
		{
			$sql = "SELECT * FROM portada 
					WHERE status != 0 ";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectportada(int $idportada){
			$this->intIdportada = $idportada;
			$sql = "SELECT * FROM portada
					WHERE idportada = $this->intIdportada";
			$request = $this->select($sql);
			return $request;
		}

		public function updatePortada(int $idportada, string $portada, string $descripcion, string $foto_portada, string $ruta, int $status){
			$this->intIdportada = $idportada;
			$this->strPortada = $portada;
			$this->strDescripcion = $descripcion;
			$this->strFotoPortada = $foto_portada;
			$this->strRuta = $ruta;
			$this->intStatus = $status;

			$sql = "SELECT * FROM portada WHERE nombre = '{$this->strPortada}' AND idportada != $this->intIdportada";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE portada SET nombre = ?, descripcion = ?, portada = ?, ruta = ?, status = ? WHERE idportada = $this->intIdportada ";
				$arrData = array($this->strPortada, 
								 $this->strDescripcion, 
								 $this->strFotoPortada,
								 $this->strRuta, 
								 $this->intStatus);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deletePortada(int $idportada)
		{
			$this->intIdportada = $idportada;
			$sql = "SELECT * FROM portada WHERE idportada = $this->intIdportada";
			$request = $this->select_all($sql);
			if(!empty($request))
			  {
				$sql = "UPDATE portada SET status = ? WHERE idportada = $this->intIdportada ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);

				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}
			return $request;
		}	

	
	}//cierre de clase
