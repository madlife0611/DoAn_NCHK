<?php 
	trait ProductsModel{
		public function modelRead($recordPerPage){
			//lay bien page truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? ($_GET["p"] - 1) : 0;
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			//---sap xep theo khau hao, gia nhap, ngay nhap---------------
			$realTime = time();
			$sqlOrder = "";
			$order = isset($_GET["order"]) ? $_GET["order"] : "";
			switch ($order) {
				case 'khauhaotang':
					$sqlOrder = "order by (ceil(($realTime-ngaynhap)/60/60/24)*khauhaoperday+solansudung*khauhaoperused) asc";
					break;
				case 'khauhaogiam':
					$sqlOrder = "order by (ceil(($realTime-ngaynhap)/60/60/24)*khauhaoperday+solansudung*khauhaoperused) desc";
					break;
				case 'giatang':
					$sqlOrder = "order by gianhap asc";
					break;
				case 'giagiam':
					$sqlOrder = "order by gianhap desc";
					break;
				case 'ngaynhaptang':
					$sqlOrder = "order by ngaynhap asc";
					break;
				case 'ngaynhapgiam':
					$sqlOrder = "order by ngaynhap desc";
					break;
				default:
					$sqlOrder = "order by masp desc";
					break;
			}
			//---
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from products $sqlOrder limit $from,$recordPerPage");
			//tra ve nhieu ban ghi
			return $query->fetchAll();
		}
		//tinh tong cac ban ghi
		public function modelTotalRecord(){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from products");
			//tra ve so luong ban ghi
			return $query->rowCount();
		}
		//hien thi cac danh muc cap con
		public function modelCategoriesSub($madm){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from categories where danhmuccha = $madm");
			//tra ve tat ca cac ban ghi lay duoc tu cau truy van
			return $query->fetchAll();
		}
		//hien thi cac danh muc cap 0
		public function modelCategories(){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from categories where danhmuccha = 0");
			//tra ve tat ca cac ban ghi lay duoc tu cau truy van
			return $query->fetchAll();
		}
		public function modelSuppliers(){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from suppliers");
			//tra ve tat ca cac ban ghi lay duoc tu cau truy van
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
		public function getCompany($macty){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from companies where macty = $macty");
			//tra ve tat ca cac ban ghi lay duoc tu cau truy van
			return $query->fetch();
		}
		//lay mot ban ghi tuong ung voi masp truyen vao
		public function modelGetRecord(){
			$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//chuan bi truy van
			$query = $db->prepare("select * from products where masp=:var_masp");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_masp"=>$masp]);
			//tra ve mot ban ghi
			return $query->fetch();
		}
	}
 ?>