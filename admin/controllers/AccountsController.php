<?php 
	//include file model vao day
	include "models/AccountsModel.php";
	class AccountsController extends Controller{
		//ke thua class AccountsModel
		use AccountsModel;
		public function index(){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 6;
			//tinh so trang
			//ham ceil(so) se lay gia tri lam tron tren cua so do. VD: ceil(3.1) = 4
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("AccountsView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		// public function update(){
		// 	$matk = isset($_GET["matk"]) && $_GET["matk"] > 0 ? $_GET["matk"] : 0;
		// 	//lay mot ban ghi
		// 	$record = $this->modelGetRecord();
		// 	//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
		// 	$action = "index.php?controller=accounts&action=updatePost&matk=$matk";
		// 	//goi view, truyen du lieu ra view
		// 	$this->loadView("AccountsFormView.php",["record"=>$record,"action"=>$action]);
		// }
		// public function updatePost(){
		// 	$matk = isset($_GET["matk"]) && $_GET["matk"] > 0 ? $_GET["matk"] : 0;
		// 	//goi ham modelUpdate de update ban ghi
		// 	$this->modelUpdate();
		// 	//quay tro lai trang Accounts
		// 	header("location:index.php?controller=accounts");
		// }
		// public function create(){
		// 	//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
		// 	$action = "index.php?controller=accounts&action=createPost";
		// 	//goi view, truyen du lieu ra view
		// 	$this->loadView("AccountsFormView.php",["action"=>$action]);
		// }
		// public function createPost(){
		// 	//goi ham modelCreate de update ban ghi
		// 	$this->modelCreate();
		// 	//quay tro lai trang Accounts
		// 	header("location:index.php?controller=accounts");
		// }
		// public function delete(){
		// 	$matk = isset($_GET["matk"]) && $_GET["matk"] > 0 ? $_GET["matk"] : 0;
		// 	//goi ham modelDelete
		// 	$this->modelDelete();
		// 	//quay tro lai trang Accounts
		// 	header("location:index.php?controller=accounts");
		// }
	}
 ?>