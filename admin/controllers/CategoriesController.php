<?php 
	//include file model vao day
	include "models/CategoriesModel.php";
	class CategoriesController extends Controller{
		//ke thua class CategoriesModel
		use CategoriesModel;
		public function index(){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 6;
			//tinh so trang
			//ham ceil(so) se lay gia tri lam tron tren cua so do. VD: ceil(3.1) = 4
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("CategoriesView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		public function view(){
			$madm =isset($_GET["madm"]) ? $_GET["madm"] : 0;
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 10;
			$numPage = ceil($this->modelTotalRecordCategory()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelReadCategory($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("CategoryProductsView.php",["data"=>$data,"numPage"=>$numPage, "madm"=>$madm]);
		}
		public function update(){
			$madm = isset($_GET["madm"]) && $_GET["madm"] > 0 ? $_GET["madm"] : 0;
			//lay mot ban ghi
			$record = $this->modelGetRecord();
			//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
			$action = "index.php?controller=categories&action=updatePost&madm=$madm";
			//goi view, truyen du lieu ra view
			$this->loadView("CategoriesFormView.php",["record"=>$record,"action"=>$action]);
		}
		public function updatePost(){
			$madm = isset($_GET["madm"]) && $_GET["madm"] > 0 ? $_GET["madm"] : 0;
			//goi ham modelUpdate de update ban ghi
			$this->modelUpdate();
			//quay tro lai trang categories
			header("location:index.php?controller=categories");
		}
		public function create(){
			//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
			$action = "index.php?controller=categories&action=createPost";
			//goi view, truyen du lieu ra view
			$this->loadView("CategoriesFormView.php",["action"=>$action]);
		}
		public function createPost(){
			//goi ham modelCreate de update ban ghi
			$this->modelCreate();
			//quay tro lai trang categories
			header("location:index.php?controller=categories");
		}
		public function delete(){
			$madm = isset($_GET["madm"]) && $_GET["madm"] > 0 ? $_GET["madm"] : 0;
			//goi ham modelDelete
			$this->modelDelete();
			//quay tro lai trang categories
			header("location:index.php?controller=categories");
		}
		
	}
 ?>