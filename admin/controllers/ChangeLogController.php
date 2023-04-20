<?php 
	//include file model vao day
	include "models/ChangeLogModel.php";
	class ChangeLogController extends Controller{
		//ke thua class ChangeLogModel
		use ChangeLogModel;
		public function index(){
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 8;
			//tinh so trang
			//ham ceil(so) se lay gia tri lam tron tren cua so do. VD: ceil(3.1) = 4
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("ChangeLogView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		public function detail(){
			$macl = isset($_GET["macl"]) && $_GET["macl"] > 0 ? $_GET["macl"] : 0;
			$record = $this->modelGetRecord($macl);	
			//goi view, truyen du lieu ra view
			$this->loadView("ChangeLogDetailView.php",["record"=>$record,"macl"=>$macl]);
		}
	}
 ?>