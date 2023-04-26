<?php
include "models/RequestModel.php";
class RequestController extends Controller
{
	use RequestModel;
	public function __construct()
	{
		//kiem tra neu request chua ton tai thi khoi tao no
		if (isset($_SESSION['request']) == false)
			$_SESSION['request'] = array();
	}
	//hien thi danh sach cac san pham 
	public function index()
	{
		$recordPerPage = 20;
		//tinh so trang
		$numPage = ceil($this->modelTotalRecord() / $recordPerPage);
		//lay du lieu tu model
		$data = $this->requestHistory($recordPerPage);
		//goi view, truyen du lieu ra view
		$this->loadView("RequestView.php", ["data" => $data, "numPage" => $numPage]);
	}
	//them san pham vao request
	public function create()
	{
		$masp = isset($_GET["masp"]) ? $_GET['masp'] : 0;
		$db = Connection::getInstance();
		$query_change = $db->prepare("SELECT madm FROM products WHERE masp = :var_masp");
		$query_change->execute(["var_masp" => $masp]);
		$madm = $query_change->fetchColumn();
		//goi ham trong model
		$this->requestAdd($masp);
		header("location:index.php?controller=products&action=category&madm=$madm");
	}
	//xoa san pham khoi request
	public function delete()
	{
		$masp = isset($_GET["masp"]) ? $_GET["masp"] : 0;
		//goi ham trong model
		$this->requestDelete($masp);
		header("location:index.php?controller=request");
	}
	//xoa toan bo san pha khoi request
	public function destroy()
	{
		//goi ham trong model
		$this->requestDestroy();
		header("location:index.php?controller=request");
	}
	//sap nhat so luong san pham
	public function update()
	{
		foreach ($_SESSION['request'] as $product) {
			$name = "product_" . $product["masp"];
			$number = $_POST[$name];
			$this->requestUpdate($product["masp"], $number);
		}
		header("location:index.php?controller=request");
	}
	//thanh toan request
	public function checkout()
	{
		//kiem tra neu user chua dang nhap thi yeu cau dang nhap
		if (isset($_SESSION["email_tk"]) == false)
			header("location:index.php?controller=account&action=login");
		else {
			//goi ham requestCheckOut trong model
			$this->requestCheckOut();
			header("location:index.php?controller=request");
		}
	}
	public function detail()
	{
		$request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : 0;
		$data = $this->modelRequestsDetail($request_id);
		//goi view, truyen du lieu ra view
		$this->loadView("RequestDetailView.php", ["data" => $data, "request_id" => $request_id]);
	}
	//xac nhan da accept request

	//Hủy request
	public function delete_request()
	{
		$request_id = isset($_GET["request_id"]) && $_GET["request_id"] > 0 ? $_GET["request_id"] : 0;
		//goi ham modelDelete
		$this->modelDeleteRequest();
		//quay tro lai trang products
		header("location:index.php?controller=request");
	}
	//using
	public function using()
	{
		$request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : 0;
		$masp = isset($_GET["masp"]) ? $_GET["masp"] : 0;
		//goi ham modelDelete
		$this->modelUsing();
		//quay tro lai trang products
		header("location:index.php?controller=request&action=detail&request_id=$request_id");
	}
	//broken
	public function broken()
	{
		$request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : 0;
		$masp = isset($_GET["masp"]) ? $_GET["masp"] : 0;
		//goi ham modelDelete
		$this->modelBroken();
		//quay tro lai trang products
		header("location:index.php?controller=request&action=detail&request_id=$request_id");
	}
	//finished using
	public function finished_using()
	{
		$request_id = isset($_GET["request_id"]) ? $_GET["request_id"] : 0;
		$masp = isset($_GET["masp"]) ? $_GET["masp"] : 0;
		$soluongyeucau = isset($_GET["soluong"]) ? $_GET["soluong"] : 0;
		//goi ham modelDelete
		$this->modelFinishedUsing();
		//quay tro lai trang products
		header("location:index.php?controller=request&action=detail&request_id=$request_id");
	}
}
