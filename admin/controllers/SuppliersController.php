<?php 
	//include file model vao day
	include "models/SuppliersModel.php";
	class SuppliersController extends Controller{
		//ke thua class SuppliersModel
		use SuppliersModel;
		public function index(){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 6;
			//tinh so trang
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("SuppliersView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		public function update(){
			$mancc = isset($_GET["mancc"]) && $_GET["mancc"] > 0 ? $_GET["mancc"] : 0;
			//lay mot ban ghi
			$record = $this->modelGetRecord();
			//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
			$action = "index.php?controller=suppliers&action=updatePost&mancc=$mancc";
			//goi view, truyen du lieu ra view
			$this->loadView("SuppliersFormView.php",["record"=>$record,"action"=>$action]);
		}
		public function updatePost(){
			$mancc = isset($_GET["mancc"]) && $_GET["mancc"] > 0 ? $_GET["mancc"] : 0;
			//goi ham modelUpdate de update ban ghi
			$this->modelUpdate();
			//quay tro lai trang suppliers
			header("location:index.php?controller=suppliers");
		}
		public function create(){
			//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
			$action = "index.php?controller=suppliers&action=createPost";
			//goi view, truyen du lieu ra view
			$this->loadView("SuppliersFormView.php",["action"=>$action]);
		}
		public function createPost(){
			//goi ham modelCreate de update ban ghi
			$this->modelCreate();
			//quay tro lai trang suppliers
			header("location:index.php?controller=suppliers");
		}
		public function delete(){
			$mancc = isset($_GET["mancc"]) && $_GET["mancc"] > 0 ? $_GET["mancc"] : 0;
			//goi ham modelDelete
			$this->modelDelete();
			//quay tro lai trang categories
			header("location:index.php?controller=suppliers");
		}
		
	}
 ?>