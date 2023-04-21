<?php 
	include "models/HomeModel.php";
	class HomeController extends Controller{
		//ke thua class HomeModel
		use HomeModel;
		public function index(){
			//goi view
			$this->loadView("HomeView.php");
		}
		public function getStackedBarChart() {
			$chartData = $this->getChartDataForStackedBarChart();
			header('Content-Type: application/json');
			echo json_encode($chartData);
		}
	}
 ?>