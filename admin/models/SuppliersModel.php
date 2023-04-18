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
		// public function saveLog($oldData, $newData) {
		// 	// Lấy ngày giờ hiện tại
		// 	$thoigian = date("Y-m-d H:i:s");
	
		// 	// Tạo chuỗi thông tin thay đổi
		// 	$change = '';
		// 	foreach ($oldData as $key => $value) {
		// 		if ($value != $newData[$key]) {
		// 			$change .= $key . ': ' . $value . ' -> ' . $newData[$key] . '; ';
		// 		}
		// 	}
		// 	$change = rtrim($change, '; ');
	
		// 	// Thêm thông tin thay đổi vào bảng changelog
		// 	$stmt = $this->db->prepare("INSERT INTO changelog (mancc, change_info, changed_at) VALUES (?, ?, ?)");
		// 	$stmt->execute([$oldData['mancc'], $change, $thoigian]);
		// }
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
			$thoigian = date('Y-m-d H:i:s');
			$tenbang = "suppliers";
			$dulieumoi = "mã ncc: $mancc,tên ncc: $tenncc,địa chỉ: $diachi,số đt $sdt,email: $email ";
			$matk = $_SESSION["matk"];
			$trangthaithaydoi = "update";
		
			// Lưu vào bảng changelog
			$query_change = $db->prepare("INSERT INTO changelog (thoigian, tenbang, dulieucu, dulieumoi, matk, trangthaithaydoi) VALUES (:var_thoigian, :var_tenbang, :var_dulieucu, :var_dulieumoi, :var_matk, :var_trangthaithaydoi)");
			$query_change->execute([
				"var_thoigian" => $thoigian,
				"var_tenbang" => $tenbang,
				"var_dulieucu" => json_encode($dulieucu, JSON_UNESCAPED_UNICODE),
				"var_dulieumoi" => $dulieumoi,
				"var_matk" => $matk,
				"var_trangthaithaydoi" => $trangthaithaydoi
			]);
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
		}
		public function modelDelete(){
			$mancc = isset($_GET["mancc"]) && $_GET["mancc"] > 0 ? $_GET["mancc"] : 0;
			//lay bien ket noi csdl
			$db = Connection::getInstance();
			//chuan bi truy van
			$query = $db->prepare("delete from suppliers where mancc=:var_mancc");
			//thuc thi truy van, co truyen tham so vao cau lenh sql
			$query->execute(["var_mancc"=>$mancc]);
		}
	}
 ?>