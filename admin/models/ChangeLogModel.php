<?php 
	trait ChangeLogModel{
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
			$query = $db->query("select * from changelog order by macl desc limit $from,$recordPerPage");
			//tra ve nhieu ban ghi
			return $query->fetchAll();
		}
		//tinh tong cac ban ghi
		public function modelTotalRecord(){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from changelog");
			//tra ve so luong ban ghi
			return $query->rowCount();
		}
		//lay mot ban ghi tuong ung voi macl truyen vao
		public function modelGetRecord(){
			$macl = isset($_GET["macl"]) && $_GET["macl"] > 0 ? $_GET["macl"] : 0;
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//chuan bi truy van
			$query = $db->prepare("select * from changelog where macl=:var_macl");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_macl"=>$macl]);
			//tra ve mot ban ghi
			return $query->fetch();
		}
		public function getAccount($matk){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from accounts where matk = $matk");
			//tra ve tat ca cac ban ghi lay duoc tu cau truy van
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
		
	}
 ?>