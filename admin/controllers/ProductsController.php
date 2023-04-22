<?php 
	//include file model vao day
	include "models/ProductsModel.php";
	class ProductsController extends Controller{
		//ke thua class ProductsModel
		use ProductsModel;
		public function index(){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 20;

			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);

			$this->loadView("ProductsView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		public function detail(){
			$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
			$record = $this->modelGetRecord($masp);	
			//goi view, truyen du lieu ra view
			$this->loadView("ProductDetailView.php",["record"=>$record,"masp"=>$masp]);
		}
		public function print_ProductsDetail(){
			$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
			$record = $this->modelGetRecord($masp);	
			//goi view, truyen du lieu ra view
			$this->loadView("print-ProductDetail.php",["record"=>$record,"masp"=>$masp]);
		}
		public function update(){
			$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
			//lay mot ban ghi
			$record = $this->modelGetRecord();
			//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
			$action = "index.php?controller=products&action=updatePost&masp=$masp";
			//goi view, truyen du lieu ra view
			$this->loadView("ProductsFormView.php",["record"=>$record,"action"=>$action]);
		}
		public function updatePost(){
			$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
			//goi ham modelUpdate de update ban ghi
			$this->modelUpdate();
			//quay tro lai trang products
			header("location:index.php?controller=products");
		}
		public function create(){
			//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
			$action = "index.php?controller=products&action=createPost";
			//goi view, truyen du lieu ra view
			$this->loadView("ProductsFormView.php",["action"=>$action]);
		}
		public function createPost(){
			//goi ham modelCreate de update ban ghi
			$this->modelCreate();
			//quay tro lai trang products
			header("location:index.php?controller=products");
		}
		public function delete(){
			$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
			//goi ham modelDelete
			$this->modelDelete();
			//quay tro lai trang products
			header("location:index.php?controller=products");
		}
	}
 ?>