<?php
include "models/MaintenanceModel.php";
class MaintenanceController extends Controller
{
	use MaintenanceModel;
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
		$this->loadView("MaintenanceView.php", ["data" => $data, "numPage" => $numPage]);
	}
	//them san pham vao maintenance
	public function create()
	{
		$masp = isset($_GET["masp"]) ? $_GET['masp'] : 0;
		$db = Connection::getInstance();
		//goi ham trong model
		$this->maintenanceAdd($masp);
		header("location:index.php?controller=products");
	}
	//xoa san pham khoi maintenance
	public function delete()
	{
		$masp = isset($_GET["masp"]) ? $_GET["masp"] : 0;
		//goi ham trong model
		$this->maintenanceDelete($masp);
		header("location:index.php?controller=maintenance");
	}
	//xoa toan bo san pha khoi maintenance
	public function destroy()
	{
		//goi ham trong model
		$this->maintenanceDestroy();
		header("location:index.php?controller=maintenance");
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
			header("location:index.php?controller=maintenance");
		}
	}
	public function detail()
	{
		$mabt = isset($_GET["mabt"]) ? $_GET["mabt"] : 0;
		$data = $this->modelMaintenancesDetail($mabt);
		//goi view, truyen du lieu ra view
		$this->loadView("MaintenanceDetailView.php", ["data" => $data, "mabt" => $mabt]);
	}
	//xac nhan da accept maintenance

	//Hủy maintenance
	public function delete_maintenance()
	{
		$mabt = isset($_GET["mabt"]) && $_GET["mabt"] > 0 ? $_GET["mabt"] : 0;
		//goi ham modelDelete
		$this->modelDeleteMaintenance();
		//quay tro lai trang products
		header("location:index.php?controller=maintenance");
	}
}
