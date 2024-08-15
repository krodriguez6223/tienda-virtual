<?php 

	class ProductosModel extends Mysql
	{
		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;
		private $intCodigo;
		private $intCategoriaId;
		private $intCategoriaColorId;
		private $intCategoriaPreId;
		private $intPrecio;
		private $intPorcentaje;
		private $intTamanio;
		private $intStatus;
		private $strRuta;
		private $strImagen;
		private $strPrecio;
		private $strPrecioDesc;
		private $strPorcentajeDesc;

		public function __construct()
		{
			parent::__construct(); 

		}
/*==========================================================
=  	SELECIONA LAS CATEGORIAS DE LOS PRODUCTOS     =
===========================================================*/
public function selectCategorias(){
				
	$sql = "SELECT nombre FROM categoria 
			WHERE status != 0 ";
	$request = $this->select_all($sql);
	return $request;
}
/*==========================================================
=  SELECIONA TODOS LOS PRODUCTOS QUE ESTEN ACTIVOS         =
===========================================================*/

  public function searchProducto($codigo){

	$this->$codigo = $codigo;

   $sql = "SELECT idproducto, codigo, nombre FROM producto WHERE codigo LIKE '$codigo' and status = 1";

   $request = $this->select($sql);

   return $request;
}

/*==========================================================
=  SELECIONA TODOS LOS PRODUCTOS QUE ESTEN ACTIVOS         =
===========================================================*/

		public function selectProductos(){

			$sql = "SELECT  
					p.idproducto,
					p.codigo,
					p.nombre,
					p.descripcion,
					p.categoriaid,
					p.colorid,
					c.nombre as categoria,
					co.nombre as catColor,
					p.precio,
					p.precio_desc,
					p.porcentaje_desc,
					p.tamanio,
					p.color,
					p.status 
			
					FROM producto p 
					INNER JOIN categoria c
					ON p.categoriaid = c.idcategoria
					INNER JOIN catcolores co
					ON p.colorid = co.idcategoria
					WHERE p.status != 0 ";

					$request = $this->select_all($sql);
			return $request;
		}	

/*==========================================================
=  				INSERTA UN NUEVO PRODUCTO         =
===========================================================*/

		public function insertProducto(?string $nombre, string $descripcion, ?string $codigo, int $categoriaid, string $precio, int $porcentaje, string $precioDesc,  string $tamanio, int $categoriaColorId, int $categoriaPreId, string $ruta, int $status){
		
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intPorcentaje = $porcentaje;
			$this->strPrecioDesc = $precioDesc;
			$this->intTamanio = $tamanio;
			$this->intCategoriaColorId = $categoriaColorId;
			$this->intCategoriaPreId = $categoriaPreId;
			$this->strRuta = $ruta;
			$this->intStatus = $status;

			$return = 0;
			$sql = "SELECT * FROM producto WHERE codigo = '{$this->intCodigo}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO producto(categoriaid,
														colorid,
														presentacionid,
														codigo,
														nombre,
														descripcion,
														precio,
														porcentaje_desc,
														precio_desc,
														tamanio,
														ruta,
														status) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";

											  
	        	$arrData = array($this->intCategoriaId,
								$this->intCategoriaColorId,
								$this->intCategoriaPreId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
								$this->intPorcentaje,
								$this->strPrecioDesc,
        						$this->intTamanio,
        						$this->strRuta,
        						$this->intStatus);

	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}
/*==========================================================
=  			ACTULIZA UN PRODUCTO         =
===========================================================*/

		public function updateProducto(int $idproducto,  $nombre,  string $descripcion, string $codigo, int $categoriaid, string $precio, int $porcentaje, string $precioDesc, string $tamanio, int $categoriaColorId, int $categoriaPreId, string $ruta, int $status){
			$this->intIdProducto = $idproducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intPorcentaje = $porcentaje;
			$this->strPrecioDesc = $precioDesc;
			$this->intTamanio = $tamanio;
			$this->intCategoriaColorId = $categoriaColorId;
			$this->intCategoriaPreId = $categoriaPreId;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE codigo = '{$this->intCodigo}' AND idproducto != $this->intIdProducto ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE producto 
						SET categoriaid=?,
							colorid=?,
							presentacionid=?,
							codigo=?,
							nombre=?,
							descripcion=?,
							precio=?,
							porcentaje_desc=?,
							precio_desc=?,
							tamanio=?,
							ruta=?,
							status=? 
						WHERE idproducto = $this->intIdProducto ";
				$arrData = array($this->intCategoriaId,
								$this->intCategoriaColorId,
								$this->intCategoriaPreId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
								$this->intPorcentaje,
								$this->strPrecioDesc,
        						$this->intTamanio,
        						$this->strRuta,
        						$this->intStatus);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
			}else{
				$return = "exist";
			}
	        return $return;
		}
/*==========================================================
=  			SEELCIONA UN PRODUCTO EN ESPECIFICO        =
===========================================================*/

		public function selectProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			
			$sql = "SELECT  
					p.idproducto,
					p.codigo,
					p.nombre,
					p.descripcion,
					p.categoriaid,
					p.colorid,
					p.presentacionid,
					c.nombre as categoria,
					co.nombre as catColor,
					pre.nombre as catPresentacion,
					p.precio,
					p.precio_desc,
					p.porcentaje_desc,
					p.tamanio,
					p.color,
					p.status 
			
					FROM producto p 
					INNER JOIN categoria c
					ON p.categoriaid = c.idcategoria
					INNER JOIN catcolores co
					ON p.colorid = co.idcategoria
					INNER JOIN catpresentacion pre
					ON p.presentacionid = pre.idcategoria
					WHERE idproducto = $this->intIdProducto";
			$request = $this->select($sql);
			return $request;

		}
/*==========================================================
=  			INSERTA IMAGENES DEL PRODUCTO       =
===========================================================*/

		public function insertImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
	        $arrData = array($this->intIdProducto,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}
/*==========================================================
=  			SELECIONA IMAGENES DEL PRODUCTO       =
===========================================================*/

		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT productoid,img
					FROM imagen
					WHERE productoid = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}

/*==========================================================
=  			ELIMINA IMAGENES DEL PRODUCTO       =
===========================================================*/

		public function deleteImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE productoid = $this->intIdProducto 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}
/*==========================================================
=  			ELIMINA UN  PRODUCTO EN ESPECIFICO      =
===========================================================*/
		public function deleteProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "UPDATE producto SET status = ? WHERE idproducto = $this->intIdProducto ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		/*==========================================================
			=  			DESCUENTO A TODO LOS PRODUCTOS      =
		===========================================================*/
		public function updateDescTodos($descuento){
			$this->strPorcentajeDesc = $descuento;
//dep($this->intIdProducto);
			
				$sql = "UPDATE producto 
						SET 
							porcentaje_desc = $this->strPorcentajeDesc,
						
						WHERE status != 0";

				$arrData = array(
								$this->strPorcentajeDesc,
								);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
		
	        return $return;
		}
		/*==========================================================
			=  			CONTAR TOTAL DE REGISTROS      =
		===========================================================*/

		/*public function totalRegistros(){

			$sql2 =" SELECT COUNT(*) AS  cantRegistros FROM producto WHERE status != 0";
			
			$request = $this->select_all($sql);
			return $request;
		}*/


}//cierre 