<?php 
	include "models/ProductsModel.php";
	class ProductsController extends Controller{
		//ke thua class ProductsModel
		use ProductsModel;
		public function index(){
			//goi view
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 20;

			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);

			$this->loadView("ProductsView.php",["data"=>$data,"numPage"=>$numPage]);
		}
	}
 ?>