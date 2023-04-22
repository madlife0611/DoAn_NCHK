<?php
	trait RequestsModel{		
		public function modelRead($recordPerPage){
			//lay bien page truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? ($_GET["p"] - 1) : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from requests order by request_id desc limit $from,$recordPerPage");
			//tra ve nhieu ban ghi
			return $query->fetchAll();
		}
		public function modelTotalRecord(){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from requests");
			//tra ve so luong ban ghi
			return $query->rowCount();
		}
		//chi tiet don hang
		public function modelRequestsDetail($request_id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from requestdetails where request_id=$request_id");
			//tra ve mot ban ghi
			return $query->fetchAll();
		}
		//chi tiet don hang
		public function modelGetRequests($request_id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from requests where request_id=$request_id");
			//tra ve mot ban ghi
			return $query->fetchAll();
		}
		//lay 1 ban ghi category
		public function getCategory($madm){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from categories where madm = $madm");
			//tra ve tat ca cac ban ghi lay duoc tu cau truy van
			return $query->fetch();
		}
		//lay 1 ban ghi category
		public function getSupplier($mancc){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from suppliers where mancc = $mancc");
			//tra ve tat ca cac ban ghi lay duoc tu cau truy van
			return $query->fetch();
		}
		public function modelGetAccount($request_id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from accounts where matk=(select matk from requests where request_id = $request_id limit 0,1)");
			//tra ve nhieu ban ghi
			return $query->fetch();
		}
		public function modelGetAccountAdmin($request_id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from accounts where matk=(select matk_admin from requests where request_id = $request_id limit 0,1)");
			//tra ve nhieu ban ghi
			return $query->fetch();
		}
		public function modelGetProduct($masp){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from products where masp=$masp");
			//tra ve nhieu ban ghi
			return $query->fetch();
		}
		public function modelGetDepartment($mapb){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from departments where mapb=$mapb");
			//tra ve nhieu ban ghi
			return $query->fetch();
		}
		public function modelGetRequestsDetail($request_id, $masp){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from requestdetails where request_id=$request_id and masp=$masp");
			//tra ve nhieu ban ghi
			return $query->fetch();
		}
		//giao hang
		public function modelDelivery($request_id){
            $matk = $_SESSION['matk_admin'];
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("update requests set trangthai = 1, matk_admin = $matk, ngayxacnhan=now() where request_id=$request_id");
		}
	}	
?>