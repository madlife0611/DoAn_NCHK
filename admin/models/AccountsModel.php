<?php 
	trait AccountsModel{
		//lay ve danh sach cac ban ghi
		public function modelRead($recordPerPage){
			//lay bien page truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? ($_GET["p"] - 1) : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from accounts order by matk asc limit $from,$recordPerPage");
			//tra ve nhieu ban ghi
			return $query->fetchAll();
		}
		//tinh tong cac ban ghi
		public function modelTotalRecord(){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from accounts");
			//tra ve so luong ban ghi
			return $query->rowCount();
		}
		//lay mot ban ghi tuong ung voi matk truyen vao
		public function modelGetRecord(){
			$matk = isset($_GET["matk"]) && $_GET["matk"] > 0 ? $_GET["matk"] : 0;
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//chuan bi truy van
			$query = $db->prepare("select * from accounts where matk=:var_matk");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_matk"=>$matk]);
			//tra ve mot ban ghi
			return $query->fetch();
		}
		public function getDepartment($mapb){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from departments where mapb = $mapb");
			//tra ve tat ca cac ban ghi lay duoc tu cau truy van
			return $query->fetch();
		}
		// public function modelUpdate(){
		// 	$matk = isset($_GET["matk"]) && $_GET["matk"] > 0 ? $_GET["matk"] : 0;
		// 	$hoten = $_POST["hoten"];
		// 	$password = $_POST["password"];
		// 	$email = $_POST["email"];
		// 	$diachi = $_POST["diachi"];
		// 	$sdt = $_POST["sdt"];
		// 	//update cot tentk
		// 	//lay bien ket noi csdl
		// 	$db = Connection::getInstance();
		// 	//chuan bi truy van
		// 	$query = $db->prepare("update accounts set tentk = :var_tentk, email = :var_email, diachi = :var_diachi, sdt = :var_sdt where matk=:var_matk");
		// 	//thuc thi truy van, co truyen tham so vao cau lenh sql
		// 	$query->execute(["var_matk"=>$matk,"var_tentk"=>$tentk,"var_email"=>$email,"var_sdt"=>$sdt,"var_diachi"=>$diachi]);
		// 	//neu password khong rong thi update password
		// 	if($password != ""){
		// 		//ma hoa password
		// 		$password = md5($password);
		// 		//chuan bi truy van
		// 		$query = $db->prepare("update accounts set password = :var_password where matk=:var_matk");
		// 		//thuc thi truy van, co truyen tham so vao cau lenh sql
		// 		$query->execute(["var_matk"=>$matk,"var_password"=>$password]);
		// 	}
		// }
		// public function modelCreate(){
		// 	$tentk = $_POST["tentk"];
		// 	$password = $_POST["password"];
		// 	$email = $_POST["email"];
		// 	$diachi = $_POST["diachi"];
		// 	$sdt = $_POST["sdt"];
		// 	//ma hoa password
		// 	$password = md5($password);
		// 	//create
		// 	//lay bien ket noi csdl
		// 	$db = Connection::getInstance();
		// 	//chuan bi truy van
		// 	$query = $db->prepare("insert into accounts set tentk = :var_tentk, email = :var_email, password = :var_password, diachi = :var_diachi, sdt = :var_sdt");
		// 	//thuc thi truy van, co truyen tham so vao cau lenh sql
		// 	$query->execute(["var_tentk"=>$tentk,"var_email"=>$email,"var_password"=>$password,"var_sdt"=>$sdt,"var_diachi"=>$diachi]);
		// }
		// public function modelDelete(){
		// 	$matk = isset($_GET["matk"]) && $_GET["matk"] > 0 ? $_GET["matk"] : 0;
		// 	//lay bien ket noi csdl
		// 	$db = Connection::getInstance();
		// 	//chuan bi truy van
		// 	$query = $db->prepare("delete from accounts where matk=:var_matk");
		// 	//thuc thi truy van, co truyen tham so vao cau lenh sql
		// 	$query->execute(["var_matk"=>$matk]);
		// }
	}
 ?>