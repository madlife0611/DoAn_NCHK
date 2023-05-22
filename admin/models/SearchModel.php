<?php 
	trait SearchModel{
		public function modelAjaxSearch(){
			$key_search = isset($_GET["key_search"]) ? $_GET["key_search"] : "";
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from products where tensp like '%$key_search%'");
			//tra ve tat ca ket qua
			return $query->fetchAll();
		}
		//lay ve danh sach cac ban ghi
		public function modelRead($recordPerPage){
			//lay bien page truyen tu url
			$page = isset($_GET["p"]) && $_GET["p"] > 0 ? ($_GET["p"] - 1) : 0;
			$key_search = isset($_GET["key_search"]) ? $_GET["key_search"] : "";
			//lay tu ban ghi nao
			$from = $page * $recordPerPage;
			//---
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from products where tensp like '%$key_search%' limit $from,$recordPerPage");
			//tra ve nhieu ban ghi
			return $query->fetchAll();
		}
		//tinh tong cac ban ghi
		public function modelTotalRecord(){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			$key_search = isset($_GET["key_search"]) ? $_GET["key_search"] : "";
			//thuc hien truy van
			$query = $db->query("select * from products where tensp like '%$key_search%'");
			//tra ve so luong ban ghi
			return $query->rowCount();
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

	}
 ?>