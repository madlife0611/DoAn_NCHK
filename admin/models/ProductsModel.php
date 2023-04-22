<?php
trait ProductsModel
{
	public function modelRead($recordPerPage)
	{
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
				$sqlOrder = "where trangthai = 0 order by masp desc";
				break;
			case 'trangthai_dangsudung':
				$sqlOrder = "where trangthai = 1 order by masp desc";
				break;
			case 'trangthai_dangbaotri':
				$sqlOrder = "where trangthai = 2 order by masp desc";
				break;
			case 'trangthai_hong':
				$sqlOrder = "where trangthai = 3 order by masp desc";
				break;
			default:
				$sqlOrder = "order by masp desc";
				break;
		}
		//---
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select *, DATEDIFF(hanbaotri, NOW()) AS thoigiandenhanbaotri from products $sqlOrder limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	//tinh tong cac ban ghi
	public function modelTotalRecord()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from products");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//hien thi cac danhsp muc cap 0
	public function modelCategories()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from categories");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetchAll();
	}
	public function modelSuppliers()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from suppliers");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetchAll();
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
	public function modelUpdate()
	{
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
		$tensp = $_POST["tensp"];
		$mota = $_POST["mota"];
		$soluong = $_POST["soluong"];
		$gianhap = $_POST["gianhap"];
		$ngaynhap = $_POST["ngaynhap"];
		$hanbaotri = $_POST["hanbaotri"];
		$madm = $_POST["madm"];
		$mancc = $_POST["mancc"];
		// trạng thái có 4 giá trị, nếu nhập ngoài giá trị này thì mặc định là trạng thái 0
		$trangthai_arr = array(0, 1, 2, 3);
		$trangthai = in_array($_POST["trangthai"], $trangthai_arr) ? $_POST["trangthai"] : 0;

		$loaisp_arr = array(1, 2, 3);
		$loaisp = in_array($_POST["loaisp"], $loaisp_arr) ? $_POST["loaisp"] : 0;

		$anhsp = isset($_FILES['anhsp']['name']) ? $_FILES['anhsp']['name'] : "";
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		// Lưu thông tin cũ
		$query_change = $db->prepare("SELECT * FROM products WHERE masp = :var_masp");
		$query_change->execute(["var_masp" => $masp]);
		$dulieucu = $query_change->fetch();
		//----------
		//neu user upload anhsp thi thuc hien upload
		$photo = "";
		if ($_FILES['anhsp']['name'] != "") {
			//---
			//lay anhsp de xoa
			$oldanhsp = $db->query("select anhsp from products where masp = $masp");
			if ($oldanhsp->rowCount() > 0) {
				$record = $oldanhsp->fetch();
				//xoa anhsp
				if ($record->anhsp != "" && file_exists("../assets/image/upload/products/" . $record->anhsp))
					unlink("../assets/image/upload/products/" . $record->anhsp);
			}
			//---
			$anhsp = $_FILES['anhsp']['name'];
			move_uploaded_file($_FILES['anhsp']['tmp_name'], "../assets/image/upload/products/$anhsp");
			$query = $db->prepare("update products set anhsp=:var_anhsp where masp=$masp");
			$query->execute(['var_anhsp' => $anhsp]);
		}
		//chuan bi truy van
		$query = $db->prepare("update products set 
                            tensp = :var_tensp, 
                            mota = :var_mota,
                            soluong = :var_soluong,
                            gianhap = :var_gianhap,
                            ngaynhap = :var_ngaynhap,
                            hanbaotri = :var_hanbaotri,
                            trangthai = :var_trangthai,
							loaisp = :var_loaisp,
                            madm = :var_madm, 
                            mancc = :var_mancc
                            where masp = :var_masp");

		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute([
			"var_masp" => $masp,
			"var_tensp" => $tensp,
			"var_mota" => $mota,
			"var_soluong" => $soluong,
			"var_gianhap" => $gianhap,
			"var_ngaynhap" => $ngaynhap,
			"var_hanbaotri" => $hanbaotri,
			"var_trangthai" => $trangthai,
			"var_loaisp" => $loaisp,
			"var_madm" => $madm,
			"var_mancc" => $mancc,
		]);
		//---
		// Lấy dữ liệu cập nhật vào bảng changelog
		$tenbang = "products";
		$dulieumoi = array(
			"masp" => $masp,
			"tensp" => $tensp,
			"anhsp" => $anhsp,
			"mota" => $mota,
			"soluong" => $soluong,
			"gianhap" => $gianhap,
			"ngaynhap" => $ngaynhap,
			"hanbaotri" => $hanbaotri,
			"tansuatsudung" => null,
			"solansudung" => null,
			"trangthai" => $trangthai,
			"loaisp" => $loaisp,
			"madm" => $madm,
			"mancc" => $mancc,
		);
		$matk_admin = $_SESSION['matk_admin'];
		$trangthaithaydoi = "update";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
	}
	public function modelCreate()
	{
		$tensp = $_POST["tensp"];
		$mota = $_POST["mota"];
		$soluong = $_POST["soluong"];
		$gianhap = $_POST["gianhap"];
		$ngaynhap = $_POST["ngaynhap"];
		$hanbaotri = $_POST["hanbaotri"];
		$madm = $_POST["madm"];
		$mancc = $_POST["mancc"];
		$solansudung = 0;
		$tansuatsudung = 0;
		// trạng thái có 4 giá trị, nếu nhập ngoài giá trị này thì mặc định là trạng thái 0
		$trangthai_arr = array(0, 1, 2, 3);
		$trangthai = in_array($_POST["trangthai"], $trangthai_arr) ? $_POST["trangthai"] : 0;

		$loaisp_arr = array(1, 2, 3);
		$loaisp = in_array($_POST["loaisp"], $loaisp_arr) ? $_POST["loaisp"] : 0;

		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//neu user upload anhsp thi thuc hien upload
		$anhsp = "";
		if ($_FILES['anhsp']['name'] != "") {
			$anhsp = $_FILES['anhsp']['name'];
			move_uploaded_file($_FILES['anhsp']['tmp_name'], "../assets/image/upload/products/$anhsp");
		}
		//chuan bi truy van
		$query = $db->prepare("INSERT INTO products SET 
                            tensp = :tensp,
							anhsp = :anhsp, 
                            mota = :mota,
                            soluong = :soluong,
                            gianhap = :gianhap,
                            ngaynhap = :ngaynhap,
                            hanbaotri = :hanbaotri,
							solansudung = :solansudung,
							tansuatsudung = :tansuatsudung,
                            trangthai = :trangthai,
							loaisp = :loaisp,
                            madm = :madm, 
                            mancc = :mancc 
                           ");

		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute([
			"tensp" => $tensp,
			"anhsp" => $anhsp,
			"mota" => $mota,
			"soluong" => $soluong,
			"gianhap" => $gianhap,
			"ngaynhap" => $ngaynhap,
			"hanbaotri" => $hanbaotri,
			"solansudung" => $solansudung,
			"tansuatsudung" => $tansuatsudung,
			"trangthai" => $trangthai,
			"loaisp" => $loaisp,
			"madm" => $madm,
			"mancc" => $mancc
		]);
		if (!$query) {
			print_r($db->errorInfo());
		}
		// Ghi vào bảng changelog
		$tenbang = "products";
		$dulieucu = array();
		$dulieumoi = array(
			"tensp" => $tensp,
			"anhsp" => $anhsp,
			"mota" => $mota,
			"soluong" => $soluong,
			"gianhap" => $gianhap,
			"ngaynhap" => $ngaynhap,
			"hanbaotri" => $hanbaotri,
			"solansudung" => $solansudung,
			"tansuatsudung" => $tansuatsudung,
			"trangthai" => $trangthai,
			"loaisp" => $loaisp,
			"madm" => $madm,
			"mancc" => $mancc
		);
		$matk_admin = $_SESSION['matk_admin'];
		$trangthaithaydoi = "create";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
	}
	public function modelDelete()
	{
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//---
		// Lưu thông tin cũ
		$query_change = $db->prepare("SELECT * FROM products WHERE masp = :var_masp");
		$query_change->execute(["var_masp" => $masp]);
		$dulieucu = $query_change->fetch();
		// Ghi vào bảng changelog
		$tenbang = "products";
		$dulieumoi = array();
		$matk_admin = $_SESSION['matk_admin'];
		$trangthaithaydoi = "delete";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
		//lay anhsp de xoa
		$oldanhsp = $db->query("select anhsp from products where masp=$masp");
		if ($oldanhsp->rowCount() > 0) {
			$record = $oldanhsp->fetch();
			//xoa anhsp
			if ($record->anhsp != "" && file_exists("../assets/image/upload/products/" . $record->anhsp))
				unlink("../assets/image/upload/products/" . $record->anhsp);
		}
		//---
		//chuan bi truy van
		$query = $db->prepare("delete from products where masp=:var_masp");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_masp" => $masp]);
	}
}
?>