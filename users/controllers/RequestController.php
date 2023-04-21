<?php 
	include "models/RequestModel.php";
	class RequestController extends Controller{
		use RequestModel;
		public function __construct(){
			//kiem tra neu request chua ton tai thi khoi tao no
			if(isset($_SESSION['request']) == false)
				$_SESSION['request'] = array();
		}
		//hien thi danh sach cac san pham 
		public function index(){
			$recordPerPage = 20;
			//tinh so trang
			$numPage = ceil($this->modelTotalRecord()/$recordPerPage);
			//lay du lieu tu model
			$data = $this->requestHistory($recordPerPage);
			//goi view, truyen du lieu ra view
			$this->loadView("RequestView.php",["data"=>$data,"numPage"=>$numPage]);
		}
		//them san pham vao request
		public function create(){
			$masp = isset($_GET["masp"]) ? $_GET['masp'] : 0;
			//goi ham trong model
			$this->requestAdd($masp);
			header("location:index.php?controller=request");
		}
		//xoa san pham khoi request
		public function delete(){
			$masp = isset($_GET["masp"]) ? $_GET["masp"] : 0;
			//goi ham trong model
			$this->requestDelete($masp);
			header("location:index.php?controller=request");
		}
		//xoa toan bo san pha khoi request
		public function destroy(){
			//goi ham trong model
			$this->requestDestroy();
			header("location:index.php?controller=request");
		}
		//sap nhat so luong san pham
		public function update(){
			foreach($_SESSION['request'] as $product){
				$name = "product_".$product["masp"];
				$number = $_POST[$name];
				$this->requestUpdate($product["masp"],$number);
			}
			header("location:index.php?controller=request");
		}
		//thanh toan request
		public function checkout(){
			//kiem tra neu user chua dang nhap thi yeu cau dang nhap
			if(isset($_SESSION["email_tk"]) == false)
				header("location:index.php?controller=account&action=login");
			else{
				//goi ham requestCheckOut trong model
				$this->requestCheckOut();
				header("location:index.php?controller=request");
			}
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
			header("location:index.php?controller=request");
		}
	}
 ?>