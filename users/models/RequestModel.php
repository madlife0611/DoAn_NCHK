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
				'soluong' => $product->soluong,
				'anhsp' => $product->anhsp,
				'number' => 1,
				'gianhap' => $product->gianhap
			);
		}
	}
	public function requestAddWithNumber($masp, $soluong)
	{
		$conn = Connection::getInstance();
		$query = $conn->prepare("select * from products where masp=:masp");
		$query->execute(array("masp" => $masp));
		$query->setFetchMode(PDO::FETCH_OBJ);
		$product = $query->fetch();
		//---
		if (isset($_SESSION['request'][$masp])) {
			//nếu đã có sp trong giỏ hàng thì số lượng lên 1
			if (($soluong + $_SESSION['request'][$masp]['number']) > $product->soluong) {
				//Hiển thị thông báo
				echo '<script type="text/javascript">alert("Số lượng yêu cầu đang lớn hơn số lượng có. Vui lòng nhập lại.")</script>';
			} else {
				$_SESSION['request'][$masp]['number'] += $soluong;
			}
		} else {

			if ($soluong > $product->soluong) {
				//Hiển thị thông báo
				echo '<script type="text/javascript">alert("Số lượng yêu cầu đang lớn hơn số lượng có. Vui lòng nhập lại.")</script>';
			} else {
				$_SESSION['request'][$masp] = array(
					'masp' => $masp,
					'tensp' => $product->tensp,
					'mota' => $product->mota,
					'soluong' => $product->soluong,
					'anhsp' => $product->anhsp,
					'number' => $soluong,
					'gianhap' => $product->gianhap
				);
			}
		}
	}
	/**
	 * Cập nhật số lượng sản phẩm 
	 * @param int
	 * @param int
	 */
	public function requestUpdate($masp, $number)
	{
		$conn = Connection::getInstance();
		$query = $conn->prepare("select * from products where masp=:masp");
		$query->execute(array("masp" => $masp));
		$query->setFetchMode(PDO::FETCH_OBJ);
		$product = $query->fetch();
		if ($number == 0) {
			//xóa sp ra khỏi giỏ hàng
			unset($_SESSION['request'][$masp]);
		} else {
			if ($number > $product->soluong) {
				//Hiển thị thông báo
				echo '<script>alert("Số lượng yêu cầu đang lớn hơn số lượng có. Vui lòng nhập lại.")</script>';
			} else {
				$_SESSION['request'][$masp]['number'] = $number;
			}
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
		//insert ban ghi vao requests, lay request_id vua moi insert
		$query_acc = $conn->query("select mapb from accounts where matk = $matk");
		$mapb = $query_acc->fetchColumn();
	
		//lay tong gia cua gio hang
		$tongtien = $this->requestTotal();
		$query = $conn->prepare("insert into requests set matk=:matk, ngaylap=now(),tongtien=:tongtien,mapb=:mapb");
		$query->execute(array("matk" => $matk, "tongtien" => $tongtien, "mapb" => $mapb));
		//lay masp vua moi insert
		$request_id = $conn->lastInsertId();
		//---
		//duyet cac ban ghi trong session array de insert vao requestdetails
		foreach ($_SESSION["request"] as $product) {
			$query = $conn->prepare("insert into requestdetails set request_id=:request_id, masp=:masp, gianhap=:gianhap, soluongyc=:soluongyc, trangthaivattu = 0");
			$query->execute(array("request_id" => $request_id, "masp" => $product["masp"], "gianhap" => $product["gianhap"], "soluongyc" => $product["number"]));
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
		$query = $conn->prepare("update requests set trangthai = 2 where request_id=:var_request_id");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_request_id" => $request_id]);
	}
}
