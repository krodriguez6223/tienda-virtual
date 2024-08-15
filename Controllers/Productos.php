<?php 
		session_start();
	class Productos extends Controllers{
		public function __construct()
		{
			parent::__construct(); 
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MPRODUCTOS);
		}

		public function Productos()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Productos";
			$data['page_title'] = "Productos";
			$data['page_name'] = "productos";
			$data['page_functions_js'] = "functions_productos.js";

			$data['categorias'] = $this->model->selectCategorias();
			//$data['totalRegistros'] = $this->model->totalRegistros();
			

			$this->views->getView($this,"productos",$data);
		}
	/*==========================================================
	=  		BUSCAR PRODUCTON POR EL CODIGO     =
	===========================================================*/

	public function buscarProducto($codigo){
		


		if (!empty($_POST['CodigoDesc'])) {

			$codigo = $_POST['CodigoDesc'];
    
			$arrData = $this->model->searchProducto($codigo);

			if (empty($arrData))
			 {
				$arrResponse  = array('status' => false, 'msg' => 'Datos no encontrados.');
			}else{
				$arrResponse  = array('status' => true, 'data' => $arrData);

			}

			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

		}


	}
/*==========================================================
	=  		APLICAR DESCUENTOS A PRODUCTOS    =
===========================================================*/
public function setProductoDesc(){

	if($_POST){
		if(empty($_POST['descuento']))
		{
			$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
		}else{

			$intDescuento = intval($_POST['descuento']);
			//$intTipoDescuento = intval($_POST['tipoDescuento']);

			//$strCategoriaDesc = !empty($_POST['categoriaDesc']) ? ($_POST['categoriaDesc']) : null; 
			//$strCodigoDesc = strClean(!empty($_POST['CodigoDesc'])) ? strClean(($_POST['CodigoDesc'])) : null; 
			//$intIdProductoDesc = intval(!empty($_POST['idproducto'])) ? intval(($_POST['idproducto'])) : null; 

			$request_producto = "";
			
				if($_SESSION['permisosMod']['w']){

			
					$request_producto = $this->model->updateDescTodos($intDescuento
																	  //$intTipoDescuento,
																	 // $strCategoriaDesc,
																	  //$strCodigoDesc,
																	  //$intIdProductoDesc
																		 );

							//dep($request_producto);
							exit;									
					if($request_producto != ''){

						$arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');

					}else{

						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');

					}	
			}
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	}
	die();
}


/*==========================================================
=  			INSERTA UN NUEVO PRODUCTO     =
===========================================================*/

		public function setProducto(){


			if($_POST){
				if(empty($_POST['txtNombre']) || empty($_POST['txtCodigo']) || empty($_POST['listCategoria']) || empty($_POST['listCategoriacolor']) || empty($_POST['txtPrecio']) || empty($_POST['listStatus']) )
				
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					
					$idProducto = intval($_POST['idProducto']);
					$strNombre = strClean($_POST['txtNombre']);
					$strDescripcion = strClean($_POST['txtDescripcion']);
					$strCodigo = strClean($_POST['txtCodigo']);
					$intCategoriaId = intval($_POST['listCategoria']);
					$intCategoriaColorId = intval($_POST['listCategoriacolor']);
					$intCategoriaPreId = intval($_POST['listCategoriaPre']);
					$strPrecio = strClean($_POST['txtPrecio']);
					$intPorDescuento = strClean(isset($_POST['txtDescuento'])) ? strClean(($_POST['txtDescuento'])) : 0; 
					$intTamanio = strClean($_POST['txtTamanio']);
					$intStatus = intval($_POST['listStatus']);
					$request_producto = "";

					$Descuento = ($intPorDescuento * $strPrecio )/100;

					if($Descuento != 0){

						$precioDescuento = ($strPrecio - $Descuento);

					}else{
						$precioDescuento = 0;	
					}

					$ruta = strtolower(clear_cadena($strCodigo));
					$ruta = str_replace(" ","-",$ruta);

					//dep($precioDescuento);
				//	exit;


					if($idProducto == 0)
					{
					
						if($_SESSION['permisosMod']['w']){
							$request_producto = $this->model->insertProducto($strNombre, 
																		$strDescripcion, 
																		$strCodigo, 
																		$intCategoriaId,
																		$strPrecio,
																		$intPorDescuento,
																		$precioDescuento, 
																		$intTamanio,
																		$intCategoriaColorId, 
																		$intCategoriaPreId, 
																		$ruta,
																		$intStatus );

																		
							if($request_producto != 'exist'){

								$arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');

							}else if($request_producto == 'exist'){

								$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el Código Ingresado.');

							}else{

								$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');

							}
						}
					}else{
						
						/*==========================================================
						=  			ACTULIzarAR UN  PRODUCTO     =
						===========================================================*/
						
						if($_SESSION['permisosMod']['u']){

							$Descuento = ($intPorDescuento * $strPrecio )/100;

							if($Descuento != 0){

								$precioDescuento = ($strPrecio - $Descuento);

							}else{
								$precioDescuento = 0;	
							}

						
							$request_producto = $this->model->updateProducto($idProducto,
																			$strNombre, 
																			$strDescripcion, 
																			$strCodigo, 
																			$intCategoriaId,
																			$strPrecio,
																			$intPorDescuento,
																			$precioDescuento, 
																			$intTamanio,
																			$intCategoriaColorId, 
																			$intCategoriaPreId, 
																			$ruta,
																			$intStatus);
						if($request_producto > 0 )
							{
								$arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
																				
							}											
						}
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

/*==========================================================
=  			OBTIENE TODOS LOS PRODUCTO       =
===========================================================*/
	
		public function getProductos()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectProductos();
			  //dep($arrData);
			/*	$cantidadRegistros = $arrData[0]['cantidad'];
             
         		for($i=0; $i < $cantidadRegistros; $i++ ){

				$totlaRegistro = $i+1;

				}*/

				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					$arrData[$i]['precio'] = SMONEY.' '.formatMoney($arrData[$i]['precio']);

					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idproducto'].')" title="Ver producto"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idproducto'].')" title="Editar producto"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idproducto'].')" title="Eliminar producto"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
/*==========================================================
=  			OBTIENE TUN PRODUCTO EN ESPECIFICO       =
===========================================================*/

		public function getProducto($idproducto){
			if($_SESSION['permisosMod']['r']){
				$idproducto = intval($idproducto);
				if($idproducto > 0){
					$arrData = $this->model->selectProducto($idproducto);
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrImg = $this->model->selectImages($idproducto);
						if(count($arrImg) > 0){
							for ($i=0; $i < count($arrImg); $i++) { 
								$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
							}
						}
						$arrData['images'] = $arrImg;
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
/*==========================================================
=  			INSERETA LAS IMAGENES DE LOS PRODUCTO       =
===========================================================*/

		public function setImage(){
			if($_POST){
				if(empty($_POST['idproducto'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de dato.');
				}else{
					$idProducto = intval($_POST['idproducto']);
					$foto      = $_FILES['foto'];
					$imgNombre = 'pro_'.md5(date('d-m-Y H:i:s')).'.jpg';
					$request_image = $this->model->insertImage($idProducto,$imgNombre);
					if($request_image){
						$uploadImage = uploadImage($foto,$imgNombre);
						$arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error de carga.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
/*==========================================================
=  			ELIMINA ARCHIVO DE UN PRODUCTO     =
===========================================================*/

		public function delFile(){
			if($_POST){
				if(empty($_POST['idproducto']) || empty($_POST['file'])){
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					//Eliminar de la DB
					$idProducto = intval($_POST['idproducto']);
					$imgNombre  = strClean($_POST['file']);
					$request_image = $this->model->deleteImage($idProducto,$imgNombre);

					if($request_image){
						$deleteFile =  deleteFile($imgNombre);
						$arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

/*==========================================================
=  			ELIMINA  UN PRODUCTO EN ESPECIFICO     =
===========================================================*/

		public function delProducto(){
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdproducto = intval($_POST['idProducto']);
					$requestDelete = $this->model->deleteProducto($intIdproducto);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
	}

 ?>