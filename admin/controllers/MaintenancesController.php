<?php
include "models/MaintenancesModel.php";
class MaintenancesController extends Controller
{
	use MaintenancesModel;
	public function __construct()
	{
		//kiem tra neu maintenance chua ton tai thi khoi tao no
		if (isset($_SESSION['maintenance']) == false)
			$_SESSION['maintenance'] = array();
	}
	//hien thi danh sach cac san pham 
	public function index()
	{
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->maintenanceHistory($recordPerPage);
		//goi view, truyen du lieu ra view
		$this->loadView("MaintenancesView.php", ["data" => $data, "numPage" => $numPage]);
	}
	//them san pham vao maintenance
	public function create()
	{
		$masp = isset($_GET["masp"]) ? $_GET['masp'] : 0;
		$db = Connection::getInstance();
		//goi ham trong model
		$this->maintenanceAdd($masp);
		header("location:index.php?controller=maintenances");
	}
	//xoa san pham khoi maintenance
	public function delete()
	{
		$masp = isset($_GET["masp"]) ? $_GET["masp"] : 0;
		//goi ham trong model
		$this->maintenanceDelete($masp);
		header("location:index.php?controller=maintenances");
	}
	//xoa toan bo san pha khoi maintenance
	public function destroy()
	{
		//goi ham trong model
		$this->maintenanceDestroy();
		header("location:index.php?controller=maintenances");
	}

	//thanh toan maintenance
	public function checkout()
	{
		//kiem tra neu user chua dang nhap thi yeu cau dang nhap
		if (isset($_SESSION["email_admin"]) == false)
			header("location:index.php?controller=account&action=login");
		else {
			//goi ham maintenanceCheckOut trong model
			$this->maintenanceCheckOut();
			header("location:index.php?controller=maintenances");
		}
	}
	public function detail()
	{
		$mabt = isset($_GET["mabt"]) ? $_GET["mabt"] : 0;
		$data = $this->modelMaintenancesDetail($mabt);
		//goi view, truyen du lieu ra view
		$this->loadView("MaintenanceDetailView.php", ["data" => $data, "mabt" => $mabt]);
	}
	public function update_detail(){
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
		$mabt = isset($_GET["mabt"]) && $_GET["mabt"] > 0 ? $_GET["mabt"] : 0;
		//lay bthi
		$record = $this->modelGetMaintenanceDetailRecord();
		//tao bien $action de biet duoc khi an nut submit thi trang se submit den dau
		$action = "index.php?controller=maintenances&action=updatePost&masp=$masp&mabt=$mabt";
		//goi view, truyen du lieu ra view
		$this->loadView("MaintenancesUpdateView.php",["record"=>$record,"action"=>$action]);
	}
	public function updatePost(){
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
		$mabt = isset($_GET["mabt"]) && $_GET["mabt"] > 0 ? $_GET["mabt"] : 0;
		//goi ham modelUpdate de update ban ghi
		$this->modelUpdateDetail();
		//quay tro lai trang products
		header("location:index.php?controller=maintenances&action=detail&mabt=$mabt");
	}

	//hoàn thành maintenance
	public function finish_maintenance()
	{
		$mabt = isset($_GET["mabt"]) && $_GET["mabt"] > 0 ? $_GET["mabt"] : 0;
		//goi ham modelDelete
		$this->modelFinishMaintenance();
		//quay tro lai trang products
		header("location:index.php?controller=maintenances");
	}
	public function print_MaintenanceDetail(){
		$mabt = isset($_GET["mabt"]) ? $_GET["mabt"] : 0;
		$data = $this->modelMaintenancesDetail($mabt);
		//goi view, truyen du lieu ra view
		$this->loadView("print-MaintenanceDetail.php", ["data" => $data, "mabt" => $mabt]);
	}
}
