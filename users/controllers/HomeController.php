<?php 
	include "models/HomeModel.php";
	class HomeController extends Controller{
		//ke thua class HomeModel
		use HomeModel;
		public function index(){
			//goi view
			$this->loadView("HomeView.php");
		}
	}
 ?>