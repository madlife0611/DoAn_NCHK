<?php
trait ProductsModel
{
	public function modelReadCategory($recordPerPage)
	{
        $madm =isset($_GET["madm"]) ? $_GET["madm"] : 0;
		//lay bien page truyen tu url
		$page = isset($_GET["p"]) && $_GET["p"] > 0 ? ($_GET["p"] - 1) : 0;
		//lay tu ban ghi nao
		$from = $page * $recordPerPage;
		//---
		//---sap xep theo khau hao, gia nhap, ngay nhap---------------
		$sqlOrder = "";
		$order = isset($_GET["order"]) ? $_GET["order"] : "";
		switch ($order) {
			case 'idtang':
				$sqlOrder = "order by masp asc";
				break;
			case 'idgiam':
				$sqlOrder = "order by masp desc";
				break;
			case 'ngaynhapxa':
				$sqlOrder = "order by ngaynhap asc";
				break;
			case 'ngaynhapgan':
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
		$query = $db->query("select * from products where madm in (select madm from categories where madm=$madm) and trangthai = 0 $sqlOrder limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	public function modelTotalRecordCategory(){
		$madm =isset($_GET["madm"]) ? $_GET["madm"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from products where madm in (select madm from categories where madm=$madm) and trangthai = 0");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//lay 1 ban ghi category
	public function getCategory($madm)
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from categories where madm = $madm");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetch();
	}
	//lay 1 ban ghi category
	public function getSupplier($mancc)
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from suppliers where mancc = $mancc");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetch();
	}
	//lay mot ban ghi tuong ung voi masp truyen vao
	public function modelGetRecord()
	{
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//chuan bi truy van
		$query = $db->prepare("select * from products where masp=:var_masp");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_masp" => $masp]);
		//tra ve mot ban ghi
		return $query->fetch();
	}
	
}
?>