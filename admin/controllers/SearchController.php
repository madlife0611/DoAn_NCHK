<?php 
	//load model
	include "models/SearchModel.php";
	class SearchController extends Controller{
		//ke thua class SearchModel
		use SearchModel;
		public function ajaxSearch(){
			$data = $this->modelAjaxSearch();
			$strResult = "";
			foreach($data as $rows){
				$strResult = $strResult."<li><a href='index.php?controller=products&action=detail&masp={$rows->masp}'>{$rows->tensp}</a></li>";
			}
			echo $strResult;
		}
		public function name(){
			$key_search = isset($_GET["key_search"]) ? $_GET["key_search"] : "";
			//quy dinh so ban ghi tren mot trang
			$recordPerPage = 20;
			//tinh so trang
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->modelRead($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("SearchView.php",["data"=>$data,"numPage"=>$numPage,"key_search"=>$key_search]);
		}
	}
 ?>