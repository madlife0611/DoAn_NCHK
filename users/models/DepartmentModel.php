<?php
trait DepartmentModel
{
	//lay ve danh sach cac ban ghi
	public function modelRead($recordPerPage)
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
		$query = $db->query("SELECT * FROM requestdetails 
        INNER JOIN requests ON requests.request_id = requestdetails.request_id
        WHERE requests.matk = $matk
        limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	//tinh tong cac ban ghi
	public function modelTotalRecord()
	{
		$matk = $_SESSION["matk"];
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("SELECT * FROM requestdetails 
        INNER JOIN requests ON requests.request_id = requestdetails.request_id
        WHERE requests.matk = $matk");
		//tra ve so luong ban ghi
		return $query->rowCount();
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
	public function getDepartment($matk)
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from departments where mapb = (select mapb from accounts where matk = $matk)");
		//tra ve tat ca cac ban ghi lay duoc tu cau truy van
		return $query->fetch();
	}
    //lấy chi tiết yêu cầu với mapb và masp truyền vào
    public function modelGetRequestsDetail($request_id, $masp)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from requestdetails where request_id=$request_id and masp=$masp");
		//tra ve nhieu ban ghi
		return $query->fetch();
	}
	//xác nhận đang sử dụng
	public function modelUsing()
	{
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
        $request_id = isset($_GET["request_id"]) && $_GET["request_id"] > 0 ? $_GET["request_id"] : 0;
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		// Lấy thông tin sản phẩm
		$query_prod = $conn->prepare("SELECT loaisp, ngaynhap FROM products WHERE masp = :var_masp");
		$query_prod->execute(["var_masp" => $masp]);
		$prod_info = $query_prod->fetch(PDO::FETCH_ASSOC);
		$loaisp = $prod_info["loaisp"];
		//thuc hien truy van
		if($loaisp == 1){
            $query_r = $conn->query("update requestdetails set trangthai = 1 where masp=$masp and request_id = $request_id");
        }elseif ($loaisp == 2) {
			$query_r = $conn->query("update requestdetails set trangthai = 1 where masp=$masp and request_id = $request_id");
		} else {
			//loai sp 3 thi can cap nhat ca bang products
			$query_r = $conn->query("update requestdetails set trangthai = 1 where masp=$masp and request_id = $request_id");
            $query = $conn->query("update products set trangthai = 1, time_start = now() where masp=$masp ");
		}
		
	}
	//xác nhận đã dùng xong 
	public function modelFinishedUsing()
	{
		$masp = isset($_GET["masp"]) && $_GET["masp"] > 0 ? $_GET["masp"] : 0;
        $request_id = isset($_GET["request_id"]) && $_GET["request_id"] > 0 ? $_GET["request_id"] : 0;
		$soluongyeucau = isset($_GET["soluong"]) && $_GET["soluong"] > 0 ? $_GET["soluong"] : 0;
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		// Lấy thông tin sản phẩm
		$query_prod = $conn->prepare("SELECT loaisp, ngaynhap FROM products WHERE masp = :var_masp");
		$query_prod->execute(["var_masp" => $masp]);
		$prod_info = $query_prod->fetch(PDO::FETCH_ASSOC);
		$loaisp = $prod_info["loaisp"];
		//thuc hien truy van
		//Với loại sản phẩm 1 và 2 thì người ta không quan tâm tần suất sử dụng mà chỉ quan tâm số lần sử dụng
		if ($loaisp == 1) {
			//loai san pham = 1 dung xong bo; soluongco = soluongco - soluongyeucau
			$query = $conn->query("update products set soluong = soluong - $soluongyeucau, solansudung = solansudung + 1 where masp=$masp");
            $query_r = $conn->query("update requestdetails set trangthai = 4 where masp=$masp and request_id = $request_id");
		} else if ($loaisp == 2) {
			// dung xong tra lai nen so luong co khong doi
			$query = $conn->query("update products set solansudung = solansudung + 1 where masp=$masp");
            $query_r = $conn->query("update requestdetails set trangthai = 4 where masp=$masp and request_id = $request_id");
		} else {
			//loai sp 3 thi khong tang giam so luong
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
        $request_id = isset($_GET["request_id"]) && $_GET["request_id"] > 0 ? $_GET["request_id"] : 0;
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("update requestdetails set trangthai = 3 where masp=$masp and request_id = $request_id");
	}
}
?>