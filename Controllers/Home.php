<?php 
	session_start();

	require_once("Models/TCategoria.php");
	require_once("Models/TProducto.php");
	require_once("Models/PortadasModel.php");

	class Home extends Controllers{
		use TCategoria, TProducto;
		public function __construct()
		{
			parent::__construct();
		}

		public function home()
		{
			$pageContent = getPageRout('inicio');
			$data['page_tag'] = NOMBRE_EMPESA;
			$data['page_title'] = NOMBRE_EMPESA;
			$data['page_name'] = "tienda_virtual"; 
			$data['page'] = $pageContent;
			$data['slider'] = $this->getPortadasT(CAT_SLIDER);
			$data['banner'] = $this->getPortadasT(CAT_BANNER);
			$data['categorias'] = $this->getCategoriasT(CAT_SLIDER);
			$data['productos'] = $this->getProductosT();
			$this->views->getView($this,"home",$data); 
		}

	}
 ?>
