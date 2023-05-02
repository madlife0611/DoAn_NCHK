<?php 
	//include file model vao day
	include "models/DepartmentsModel.php";
	class DepartmentsController extends Controller{
		//ke thua class DepartmentsModel
		use DepartmentsModel;
		public function index(){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 6;
			//tinh so trang
			//ham ceil(so) se lay gia tri lam tron tren cua so do. VD: ceil(3.1) = 4
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("DepartmentsView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		public function view(){
			$mapb =isset($_GET["mapb"]) ? $_GET["mapb"] : 0;
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 10;
			$numPage = ceil($this->modelTotalRecordDepartment()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelReadDepartments($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("DepartmentProductsView.php",["data"=>$data,"numPage"=>$numPage, "mapb"=>$mapb]);
		}
		public function update(){
			$mapb = isset($_GET["mapb"]) && $_GET["mapb"] > 0 ? $_GET["mapb"] : 0;
			//lay mot ban ghi
			$record = $this->modelGetRecord();
			//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
			$action = "index.php?controller=departments&action=updatePost&mapb=$mapb";
			//goi view, truyen du lieu ra view
			$this->loadView("DepartmentsFormView.php",["record"=>$record,"action"=>$action]);
		}
		public function updatePost(){
			$mapb = isset($_GET["mapb"]) && $_GET["mapb"] > 0 ? $_GET["mapb"] : 0;
			//goi ham modelUpdate de update ban ghi
			$this->modelUpdate();
			//quay tro lai trang categories
			header("location:index.php?controller=departments");
		}
		public function create(){
			//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
			$action = "index.php?controller=departments&action=createPost";
			//goi view, truyen du lieu ra view
			$this->loadView("DepartmentsFormView.php",["action"=>$action]);
		}
		public function createPost(){
			//goi ham modelCreate de update ban ghi
			$this->modelCreate();
			//quay tro lai trang categories
			header("location:index.php?controller=departments");
		}
		public function delete(){
			$mapb = isset($_GET["mapb"]) && $_GET["mapb"] > 0 ? $_GET["mapb"] : 0;
			//goi ham modelDelete
			$this->modelDelete();
			//quay tro lai trang categories
			header("location:index.php?controller=departments");
		}
		
	}
 ?>