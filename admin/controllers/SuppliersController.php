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
		
	}
 ?>