<?php 
	trait SuppliersModel{
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
			$query = $db->query("select * from suppliers order by mancc asc limit $from,$recordPerPage");
			//tra ve nhieu ban ghi
			return $query->fetchAll();
		}
		//tinh tong cac ban ghi
		public function modelTotalRecord(){
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//thuc hien truy van
			$query = $db->query("select * from suppliers");
			//tra ve so luong ban ghi
			return $query->rowCount();
		}
		//lay mot ban ghi tuong ung voi mancc truyen vao
		public function modelGetRecord(){
			$mancc = isset($_GET["mancc"]) && $_GET["mancc"] > 0 ? $_GET["mancc"] : 0;
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//chuan bi truy van
			$query = $db->prepare("select * from suppliers where mancc=:var_mancc");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_mancc"=>$mancc]);
			//tra ve mot ban ghi
			return $query->fetch();
		}
	}
 ?>