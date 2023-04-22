<?php 
	include "models/RequestsModel.php";
	class RequestsController extends Controller{
		use RequestsModel;
		//hien thi danh sach cac san pham 
		public function index(){
			$recordPerPage = 20;
			//tinh so trang
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("RequestsView.php",["data"=>$data,"numPage"=>$numPage]);
		}

		public function detail(){
			$request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : 0;
			$data = $this->modelRequestsDetail($request_id);
			//goi view, truyen du lieu ra view
			$this->loadView("RequestDetailView.php",["data"=>$data,"request_id"=>$request_id]);
		}
		//xac nhan da accept request
		public function delivery(){
			$request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : 0;
			$this->modelDelivery($request_id);
			header("location:index.php?controller=requests");
		}
		public function print_requestDetail(){
			$request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : 0;
			$data = $this->modelRequestsDetail($request_id);
			//goi view, truyen du lieu ra view
			$this->loadView("print-RequestDetail.php",["data"=>$data,"request_id"=>$request_id]);
		}
	}
 ?>