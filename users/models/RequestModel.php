<?php
trait RequestModel
{
	public function requestAdd($masp)
	{
		if (isset($_SESSION['request'][$masp])) {
			//nếu đã có sp trong giỏ hàng thì số lượng lên 1
			$_SESSION['request'][$masp]['number']++;
		} else {
			$conn = Connection::getInstance();
			$query = $conn->prepare("select * from products where masp=:masp");
			$query->execute(array("masp" => $masp));
			$query->setFetchMode(PDO::FETCH_OBJ);
			$product = $query->fetch();
			//---

			$_SESSION['request'][$masp] = array(
				'masp' => $masp,
				'tensp' => $product->tensp,
				'mota' => $product->mota,
				'soluongco' => $product->soluongco,
				'anhsp' => $product->anhsp,
				'number' => 1,
				'gianhap' => $product->gianhap
			);
		}
	}
	public function requestAddWithNumber($masp, $soluong)
	{
		if (isset($_SESSION['request'][$masp])) {
			//nếu đã có sp trong giỏ hàng thì số lượng lên 1
			$_SESSION['request'][$masp]['number'] += $soluong;
		} else {
			$conn = Connection::getInstance();
			$query = $conn->prepare("select * from products where masp=:masp");
			$query->execute(array("masp" => $masp));
			$query->setFetchMode(PDO::FETCH_OBJ);
			$product = $query->fetch();
			//---

			$_SESSION['request'][$masp] = array(
				'masp' => $masp,
				'tensp' => $product->tensp,
				'mota' => $product->mota,
				'soluongco' => $product->soluongco,
				'anhsp' => $product->anhsp,
				'number' => $soluong,
				'gianhap' => $product->gianhap
			);
		}
	}
	/**
	 * Cập nhật số lượng sản phẩm 
	 * @param int
	 * @param int
	 */
	public function requestUpdate($masp, $number)
	{
		if ($number == 0) {
			//xóa sp ra khỏi giỏ hàng
			unset($_SESSION['request'][$masp]);
		} else {
			$_SESSION['request'][$masp]['number'] = $number;
		}
	}
	/**
	 * @param int
	 */
	public function requestDelete($masp)
	{
		unset($_SESSION['request'][$masp]);
	}

	public function requestTotal()
	{
		$total = 0;
		foreach ($_SESSION['request'] as $product) {
			$total += $product['gianhap'] * $product['number'];
		}
		return $total;
	}

	public function requestNumber()
	{
		$number = 0;
		foreach ($_SESSION['request'] as $product) {
			$number += $product['number'];
		}
		return $number;
	}

	public function requestList()
	{
		return $_SESSION['request'];
	}

	public function requestDestroy()
	{
		$_SESSION['request'] = array();
	}
	//=============
	//checkout
	public function requestCheckOut()
	{
		$conn = Connection::getInstance();
		//lay masp vua moi insert
		$matk = $_SESSION["matk"];
		//---
		//---
		//insert ban ghi vao requests, lay request_id vua moi insert
		//lay tong gia cua gio hang
		$tongtien = $this->requestTotal();
		$query = $conn->prepare("insert into requests set matk=:matk, ngaylap=now(),tongtien=:tongtien");
		$query->execute(array("matk" => $matk, "tongtien" => $tongtien));
		//lay masp vua moi insert
		$request_id = $conn->lastInsertId();
		//---
		//duyet cac ban ghi trong session array de insert vao requestdetails
		foreach ($_SESSION["request"] as $product) {
			$query = $conn->prepare("insert into requestdetails set request_id=:request_id, masp=:masp, gianhap=:gianhap, soluong=:soluong");
			$query->execute(array("request_id" => $request_id, "masp" => $product["masp"], "gianhap" => $product["gianhap"], "soluong" => $product["number"]));
		}
		//xoa gio hang
		unset($_SESSION["request"]);
	}
	//=============
	public function requestHistory($recordPerPage)
	{

		$matk = $_SESSION["matk"];
		//lay bien page truyen tu url
		$page = isset($_GET["p"]) && $_GET["p"] > 0 ? ($_GET["p"] - 1) : 0;
		//lay tu ban ghi nao
		$from = $page * $recordPerPage;
		//---
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from requests where matk = $matk order by request_id desc limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	public function modelTotalRecord()
	{
		$matk = $_SESSION["matk"];
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from requests where matk = $matk");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//chi tiet don hang
	public function modelRequestsDetail($request_id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from requestdetails where request_id=$request_id");
		//tra ve mot ban ghi
		return $query->fetchAll();
	}
	public function modelGetAccount($request_id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from accounts where matk=(select matk from requests where request_id = $request_id limit 0,1)");
		//tra ve nhieu ban ghi
		return $query->fetch();
	}
	public function modelGetAccountAdmin($request_id)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from accounts where matk=(select matk_admin from requests where request_id = $request_id limit 0,1)");
		//tra ve nhieu ban ghi
		return $query->fetch();
	}
	public function modelGetProduct($masp)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from products where masp=$masp");
		//tra ve nhieu ban ghi
		return $query->fetch();
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
	public function modelGetDepartment($mapb)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from departments where mapb=$mapb");
		//tra ve nhieu ban ghi
		return $query->fetch();
	}
	public function modelGetRequestsDetail($request_id, $masp)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from requestdetails where request_id=$request_id and masp=$masp");
		//tra ve nhieu ban ghi
		return $query->fetch();
	}
	//Xóa yêu cầu
	public function modelDeleteRequest()
	{
		$request_id = isset($_GET["request_id"]) && $_GET["request_id"] > 0 ? $_GET["request_id"] : 0;
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//chuan bi truy van
		$query = $conn->prepare("delete from request where request_id=:var_request_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_request_id" => $request_id]);
	}
	//xác nhận đang sử dụng
	public function modelUsing()
	{
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		// Lấy thông tin sản phẩm
		$query_prod = $conn->prepare("SELECT loaisp, ngaynhap FROM products WHERE masp = :var_masp");
		$query_prod->execute(["var_masp" => $masp]);
		$prod_info = $query_prod->fetch(PDO::FETCH_ASSOC);
		$loaisp = $prod_info["loaisp"];
		//thuc hien truy van
		//với loại sản phẩm bằng 1 thì trạng thái sẽ không đổi
		if ($loaisp == 2) {
			$query = $conn->query("update products set trangthai = 1 where masp=$masp");
		} else {
			$query = $conn->query("update products set trangthai = 1, time_start = now() where masp=$masp");
		}
		
	}

	//xác nhận đã dùng xong 
	public function modelFinishedUsing()
	{
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
		$soluongyeucau = isset($_GET["soluong"]) && $_GET["soluong"] > 0 ? $_GET["soluong"] : 0;
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		// Lấy thông tin sản phẩm
		$query_prod = $conn->prepare("SELECT loaisp, ngaynhap FROM products WHERE masp = :var_masp");
		$query_prod->execute(["var_masp" => $masp]);
		$prod_info = $query_prod->fetch(PDO::FETCH_ASSOC);
		$loaisp = $prod_info["loaisp"];
		$ngaynhap = $prod_info["ngaynhap"];
		//thuc hien truy van
		//Với loại sản phẩm 1 và 2 thì người ta không quan tâm tần suất sử dụng mà chỉ quan tâm số lần sử dụng
		if ($loaisp == 1) {
			//loai san pham = 1; soluongco = soluongco - soluongyeucau
			$query = $conn->query("update products set soluong = soluong - $soluongyeucau, solansudung = solansudung + 1 where masp=$masp");
		} else if ($loaisp == 2) {
			$query = $conn->query("update products set trangthai = 0, soluong = soluong + $soluongyeucau, solansudung = solansudung + 1 where masp=$masp");
		} else {
			$query = $conn->query("UPDATE products 
			SET tongthoigiansudung = tongthoigiansudung + TIMESTAMPDIFF(SECOND, time_start, NOW()),
				tansuatsudung = (tongthoigiansudung / 3600) / DATEDIFF(NOW(), ngaynhap),
				time_start = '',
				trangthai = '0',
				solansudung = solansudung + 1
			WHERE masp = $masp");
		}
	}
	//xác nhận đã hỏng hoặc lỗi
	public function modelBroken()
	{
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("update products set trangthai = 3 where masp=$masp");
	}
}
