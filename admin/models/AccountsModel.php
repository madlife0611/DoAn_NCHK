<?php
trait AccountsModel
{
	//lay ve danh sach cac ban ghi
	public function modelRead($recordPerPage)
	{
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
	public function modelTotalRecord()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from accounts");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//lay mot ban ghi tuong ung voi matk truyen vao
	public function modelGetRecord()
	{
		$matk = isset($_GET["matk"]) && $_GET["matk"] > 0 ? $_GET["matk"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//chuan bi truy van
		$query = $db->prepare("select * from accounts where matk=:var_matk");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_matk" => $matk]);
		//tra ve mot ban ghi
		return $query->fetch();
	}
	public function modelDepartment()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from departments");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetchAll();
	}
	public function getDepartment($mapb)
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from departments where mapb = $mapb");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetch();
	}
	public function modelUpdate()
	{
		$matk = isset($_GET["matk"]) && $_GET["matk"] > 0 ? $_GET["matk"] : 0;
		$hoten = $_POST["hoten"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		$diachi = $_POST["diachi"];
		$sdt = $_POST["sdt"];
		$isAdmin = isset($_POST["isAdmin"]) ? 1 : 0;
		$mapb = $_POST["mapb"];
		//update cot hoten
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		// Lưu thông tin cũ
		$query_change = $db->prepare("SELECT * FROM accounts WHERE matk = :var_matk");
		$query_change->execute(["var_matk" => $matk]);
		$dulieucu = $query_change->fetch();
		//neu password khong rong thi update password
		if ($password != "") {
			//ma hoa password
			$password = md5($password);
			//chuan bi truy van
			$query = $db->prepare("update accounts set password = :var_password where matk=:var_matk");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_matk" => $matk, "var_password" => $password]);
		}
		$photo = "";
			if($_FILES['photo']['name'] != ""){
				//---
				//lay anh de xoa
				$oldphoto = $db->query("select photo from accounts where matk=$matk");
				if($oldphoto->rowCount() > 0){
					$record = $oldphoto->fetch();
					//xoa anh
					if($record->photo != "" && file_exists("../assets/image/upload/accounts/".$record->photo))
						unlink("../assets/image/upload/accounts/".$record->photo);
				}
				//---
				$photo = time()."_".$_FILES['photo']['name'];
				move_uploaded_file($_FILES['photo']['tmp_name'], "../assets/image/upload/accounts/$photo");
				$query = $db->prepare("update accounts set photo=:var_photo where matk=$matk");
				$query->execute(['var_photo'=>$photo]);
			}
			//---
		// Lấy dữ liệu cập nhật vào bảng changelog
		$tenbang = "accounts";
		$dulieumoi = array(
			'matk' => $matk,
			'hoten' => $hoten,
			'email' => $email,
			'sdt' => $sdt,
			'diachi' => $diachi,
			'mapb' => $mapb,
			'photo' => $photo,
			'password' => $password,
			'isAdmin' => $isAdmin
		);
		$matk_admin = $_SESSION["matk"];
		$trangthaithaydoi = "update";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
		//chuan bi truy van
		$query = $db->prepare("update accounts set hoten = :var_hoten, email = :var_email, diachi = :var_diachi, sdt = :var_sdt, isAdmin = :var_isAdmin, mapb = :var_mapb where matk=:var_matk");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_matk" => $matk, "var_hoten" => $hoten, "var_email" => $email, "var_sdt" => $sdt, "var_diachi" => $diachi, "var_isAdmin" => $isAdmin, "var_mapb" => $mapb]);

	}
	public function modelCreate()
	{
		$hoten = $_POST["hoten"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		$diachi = $_POST["diachi"];
		$sdt = $_POST["sdt"];
		$isAdmin = isset($_POST["isAdmin"]) ? 1 : 0;
		$mapb = $_POST["mapb"];
		//ma hoa password
		$password = md5($password);
		//create
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//Upload anh photo
		$photo = "";
		if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
			$photo = $_FILES['photo']['name'];
			move_uploaded_file($_FILES['photo']['tmp_name'], "../assets/image/upload/accounts/$photo");
		}
		//chuan bi truy van
		$query = $db->prepare("insert into accounts set hoten = :var_hoten, email = :var_email, password = :var_password, diachi = :var_diachi, sdt = :var_sdt, isAdmin = :var_isAdmin, mapb = :var_mapb, photo = :var_photo");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_hoten" => $hoten, "var_email" => $email, "var_password" => $password, "var_sdt" => $sdt, "var_diachi" => $diachi, "var_isAdmin" => $isAdmin, "var_mapb" => $mapb, "var_photo" => $photo]);
		// Ghi vào bảng changelog
		$tenbang = "accounts";
		$dulieucu = array();
		$dulieumoi = array(
			'hoten' => $hoten,
			'email' => $email,
			'sdt' => $sdt,
			'diachi' => $diachi,
			'mapb' => $mapb,
			'photo' => $photo,
			'password' => $password,
			'isAdmin' => $isAdmin
		);
		$matk_admin = $_SESSION["matk"];
		$trangthaithaydoi = "create";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
	}
	public function modelDelete()
	{
		$matk = isset($_GET["matk"]) && $_GET["matk"] > 0 ? $_GET["matk"] : 0;
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		// Lưu thông tin cũ
		$query_change = $db->prepare("SELECT * FROM accounts WHERE matk = :var_matk");
		$query_change->execute(["var_matk" => $matk]);
		$dulieucu = $query_change->fetch();
		// Ghi vào bảng changelog
		$tenbang = "accounts";
		$dulieumoi = array();
		$matk_admin = $_SESSION["matk"];
		$trangthaithaydoi = "delete";
		ChangeLog::saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk_admin, $trangthaithaydoi);
		//Lay anh de xoa
		$anhcu = $db->query("select photo from accounts where matk=$matk");
		if ($anhcu->rowCount() > 0) {
			$record = $anhcu->fetch();
			//Xoa photo
			if ($record->photo != "" && file_exists("../assets/image/upload/accounts/".$record->photo))
				unlink("../assets/image/upload/accounts/". $record->photo);
		}
		//chuan bi truy van
		$query = $db->prepare("delete from accounts where matk=:var_matk");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_matk" => $matk]);
	}
}
?>