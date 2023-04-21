<?php 
	//include file model vao day
	include "models/ProductsModel.php";
	class ProductsController extends Controller{
		//ke thua class ProductsModel
		use ProductsModel;
		public function category(){
			$madm =isset($_GET["madm"]) ? $_GET["madm"] : 0;
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 10;
			$numPage = ceil($this->modelTotalRecordCategory()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelReadCategory($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("CategoryProductsView.php",["data"=>$data,"numPage"=>$numPage, "madm"=>$madm]);
		}
		public function detail(){
			$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
			$record = $this->modelGetRecord($masp);	
			//goi view, truyen du lieu ra view
			$this->loadView("DetailProductsView.php",["record"=>$record,"masp"=>$masp]);
		}
	
	}
 ?>