<?php
	session_start();
	
	class Presentacion extends Controllers{
		public function __construct()
		{
			parent::__construct();
			//session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MCATEGORIAS);
		}

		public function Presentacion()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Categorias";
			$data['page_title'] = "CATEGORIAS <small>Tienda Virtual</small>";
			$data['page_name'] = "categorias";
			$data['page_functions_js'] = "functions_cat_presentacion.js";

			$this->views->getView($this,"presentacion",$data);

		}

		public function setCategoria(){
			if($_POST){
				if(empty($_POST['txtNombre'])  || empty($_POST['listStatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					
					$intIdcategoria = intval($_POST['idCategoria']);
					$strCategoria =  strClean($_POST['txtNombre']);
					$intStatus = intval($_POST['listStatus']);

					$ruta = strtolower(clear_cadena($strCategoria));
					$ruta = str_replace(" ","-",$ruta);

					if($intIdcategoria == 0)
					{
						//Crear
						if($_SESSION['permisosMod']['w']){
							$request_cateria = $this->model->inserCategoria($strCategoria,$ruta,$intStatus);
							
							if($intIdcategoria == 0){
								
								if($request_cateria != 'exist'){
	
									$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
	
								}else if ($request_cateria == 'exist'){
									
									$arrResponse = array('status' => false, 'msg' => '¡Atención! La categoría ya existe.');
								
								}else{
	
									$arrResponse = array('status' => false, 'msg' => 'Se produjo un error al guardar los datos.');
	
								}
						}
						}

					}else{
						//Actualizar
						if($_SESSION['permisosMod']['u']){
			
							$request_cateria = $this->model->updateCategoria($intIdcategoria,$strCategoria,$ruta,$intStatus);
							
							if($intIdcategoria > 0){

							$arrResponse = array('status' => true, 'msg' => 'Datos actulizados correctamente.');
						   
						   }else{

							$arrResponse = array('status' => true, 'msg' => 'Ocurrió un error al actulizar.');
						   }
						}
				     	}
	
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCategorias()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectCategorias();

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

					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idcategoria'].')" title="Ver categoría"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idcategoria'].')" title="Editar categoría"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idcategoria'].')" title="Eliminar categoría"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCategoria($idcategoria)
		{
			if($_SESSION['permisosMod']['r']){
				$intIdcategoria = intval($idcategoria);
				if($intIdcategoria > 0)
				{
					$arrData = $this->model->selectCategoria($intIdcategoria);
					if(empty($arrData))
					{
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function delCategoria()
		{
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdcategoria = intval($_POST['idCategoria']);
					$requestDelete = $this->model->deleteCategoria($intIdcategoria);
					if($requestDelete == 'ok')
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoría');
					}else if($requestDelete == 'exist'){
						$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoría con productos asociados.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function getSelectCategorias(){
			$htmlOptions = "";
			$arrData = $this->model->selectCategorias();
	
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['status'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['idcategoria'].'">'.$arrData[$i]['nombre'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();	
		}

	}


 