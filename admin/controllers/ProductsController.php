<?php 
	include "models/ProductsModel.php";
	class ProductsController extends Controller{
		//ke thua class ProductsModel
		use ProductsModel;
		public function index(){
			//goi view
			$this->loadView("ProductsView.php");
		}
	}
 ?>