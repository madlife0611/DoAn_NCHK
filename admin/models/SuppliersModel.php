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
		//xem sản phẩm theo danh mục
	public function modelReadSupplier($recordPerPage)
	{
		$mancc = isset($_GET["mancc"]) ? $_GET["mancc"] : 0;
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
			case 'thoigiandenhanbaotritang':
				$sqlOrder = "order by DATEDIFF(hanbaotri, NOW()) asc";
				break;
			case 'thoigiandenhanbaotrigiam':
				$sqlOrder = "order by DATEDIFF(hanbaotri, NOW()) desc";
				break;
			case 'ngaynhapxa':
				$sqlOrder = "order by ngaynhap asc";
				break;
			case 'ngaynhapgan':
				$sqlOrder = "order by ngaynhap desc";
				break;
			case 'trangthai_tudo':
				$sqlOrder = "and trangthai = 0 order by masp desc";
				break;
			case 'trangthai_dangsudung':
				$sqlOrder = "and trangthai = 1 order by masp desc";
				break;
			case 'trangthai_dangbaotri':
				$sqlOrder = "and trangthai = 2 order by masp desc";
				break;
			case 'trangthai_hong':
				$sqlOrder = "and trangthai = 3 order by masp desc";
				break;
			default:
				$sqlOrder = "order by masp desc";
				break;
		}
		
		//---
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from products where mancc in (select mancc from suppliers where mancc=$mancc) $sqlOrder limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	public function modelTotalRecordSupplier(){
		$mancc =isset($_GET["mancc"]) ? $_GET["mancc"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from products where mancc in (select mancc from suppliers where mancc=$mancc)");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
		public function modelUpdate(){
			$mancc = isset($_GET["mancc"]) && $_GET["mancc"] > 0 ? $_GET["mancc"] : 0;
			$tenncc = $_POST["tenncc"];
			$diachi = $_POST["diachi"];
			$sdt = $_POST["sdt"];
			$email = $_POST["email"];
			//lay bien ket noi csdl
			$db = Connection::getInstance();

			// Lưu thông tin cũ
			$query_change = $db->prepare("SELECT * FROM suppliers WHERE mancc = :var_mancc");
			$query_change->execute(["var_mancc" => $mancc]);
			$dulieucu = $query_change->fetch();
			// Lấy dữ liệu cập nhật vào bảng changelog
			$tenbang = "suppliers";
			$dulieumoi = array(
				'mancc' => $mancc,
				'tenncc' => $tenncc,
				'diachi' => $diachi,
				'sdt' => $sdt,
				'email' => $email
			);
			$matk_admin = $_SESSION['matk_admin'];
			$trangthaithaydoi = "update";	
			ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);	
			//chuan bi truy van
			$query = $db->prepare("UPDATE suppliers SET tenncc = :tenncc, diachi=:diachi, sdt=:sdt, email=:email WHERE mancc=:mancc");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute([
				"mancc" => $mancc,
				"tenncc" => $tenncc,
				"diachi" => $diachi,
				"sdt" => $sdt,
				"email" => $email
			]);
		}
		public function modelCreate(){
			$tenncc = $_POST["tenncc"];
			$diachi = $_POST["diachi"];
			$sdt = $_POST["sdt"];
			$email = $_POST["email"];
			//create
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//chuan bi truy van
			$query = $db->prepare("insert into suppliers set tenncc = :var_tenncc, diachi = :var_diachi, sdt = :var_sdt, email = :var_email");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_tenncc"=>$tenncc,"var_diachi"=>$diachi,"var_sdt"=>$sdt,"var_email"=>$email]);

			// Ghi vào bảng changelog
			$tenbang = "suppliers";
			$dulieucu = array();
			$dulieumoi = array(
				'tenncc' => $tenncc,
				'diachi' => $diachi,
				'sdt' => $sdt,
				'email' => $email
			);
			$matk_admin = $_SESSION['matk_admin'];
			$trangthaithaydoi = "create";
    		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
		}
		public function modelDelete(){
			$mancc = isset($_GET["mancc"]) && $_GET["mancc"] > 0 ? $_GET["mancc"] : 0;
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			// Lưu thông tin cũ
			$query_change = $db->prepare("SELECT * FROM suppliers WHERE mancc = :var_mancc");
			$query_change->execute(["var_mancc" => $mancc]);
			$dulieucu = $query_change->fetch();
			// Lấy dữ liệu cập nhật vào bảng changelog
			$tenbang = "suppliers";
			$dulieumoi = array();
			$matk_admin = $_SESSION['matk_admin'];
			$trangthaithaydoi = "delete";	
			ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
			//chuan bi truy van
			$query = $db->prepare("delete from suppliers where mancc=:var_mancc");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_mancc"=>$mancc]);
		}
	}
 ?>