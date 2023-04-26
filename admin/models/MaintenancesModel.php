<?php
trait MaintenanceModel
{
	public function maintenanceAdd($masp)
	{
		if (isset($_SESSION['maintenance'][$masp])) {
			//Nếu đã có sản phẩm đó trong ds bảo trì rồi thì hiển thị thông báo sản phẩm này đẫ có trong danh sách
            echo "<script>alert('Sản phẩm này đã có trong danh sách bảo trì!');</script>";
		} else {
			$conn = Connection::getInstance();
			$query = $conn->prepare("select * from products where masp=:masp");
			$query->execute(array("masp" => $masp));
			$query->setFetchMode(PDO::FETCH_OBJ);
			$product = $query->fetch();
			//---

			$_SESSION['maintenance'][$masp] = array(
				'masp' => $masp,
				'tensp' => $product->tensp,
				'mota' => $product->mota,
				'soluong' => $product->soluong,
				'anhsp' => $product->anhsp,
                'trangthai' => $product->trangthai,
                'ngaynhap' => $product->ngaynhap,
                'hanbaotri' => $product->hanbaotri,
				'gianhap' => $product->gianhap
			);
		}
	}
    public function maintenanceNumber()
	{
		$number = 0;
		foreach ($_SESSION['maintenance'] as $product) {
			$number += $product['number'];
		}
		return $number;
	}
	public function maintenanceDelete($masp)
	{
		unset($_SESSION['maintenance'][$masp]);
	}

	public function maintenanceList()
	{
		return $_SESSION['maintenance'];
	}

	public function maintenanceDestroy()
	{
		$_SESSION['maintenance'] = array();
	}
	//=============
	//checkout
	public function maintenanceCheckOut()
	{
		$conn = Connection::getInstance();
		//lay masp vua moi insert
		$matk = $_SESSION["matk_admin"];
		//---
		//---
		//insert ban ghi vao maintenances, lay mabt vua moi insert
		$query = $conn->prepare("insert into maintenances set matk=:matk, ngaybaotri=now(), trangthai = 0");
		$query->execute(array("matk" => $matk));
		//lay masp vua moi insert
		$mabt = $conn->lastInsertId();
		//---
		//duyet cac ban ghi trong session array de insert vao maintenance_details
		foreach ($_SESSION["maintenance"] as $product) {
			$query = $conn->prepare("insert into maintenance_details set mabt=:mabt, masp=:masp");
			$query->execute(array("mabt" => $mabt, "masp" => $product["masp"]));
		}

        //duyet cac ban ghi trong session array de update products
		foreach ($_SESSION["maintenance"] as $product) {
			$query = $conn->prepare("update products set trangthai = 2 where masp=:masp");
			$query->execute(array("masp" => $product["masp"]));
		}

		//xoa danh sach
		unset($_SESSION["maintenance"]);
	}
	//=============
	public function maintenanceHistory($recordPerPage)
	{

		$matk = $_SESSION["matk_admin"];
		//lay bien page truyen tu url
		$page = isset($_GET["p"]) && $_GET["p"] > 0 ? ($_GET["p"] - 1) : 0;
		//lay tu ban ghi nao
		$from = $page * $recordPerPage;
		//---
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = $db->query("select * from maintenances where matk = $matk order by mabt desc limit $from,$recordPerPage");
		//tra ve nhieu ban ghi
		return $query->fetchAll();
	}
	public function modelTotalRecord()
	{
		$matk = $_SESSION["matk"];
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from maintenances where matk = $matk");
		//tra ve so luong ban ghi
		return $query->rowCount();
	}
	//chi tiet don hang
	public function modelMaintenancesDetail($mabt)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from maintenancedetails where mabt=$mabt");
		//tra ve mot ban ghi
		return $query->fetchAll();
	}
	public function modelGetAccountAdmin($mabt)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from accounts where matk=(select matk_admin from maintenances where mabt = $mabt limit 0,1)");
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
	public function modelGetMaintenancesDetail($mabt, $masp)
	{
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//thuc hien truy van
		$query = $conn->query("select * from maintenancedetails where mabt=$mabt and masp=$masp");
		//tra ve nhieu ban ghi
		return $query->fetch();
	}
	//Xóa yêu cầu
	public function modelDeleteMaintenance()
	{
		$mabt = isset($_GET["mabt"]) && $_GET["mabt"] > 0 ? $_GET["mabt"] : 0;
		//lay bien ket noi csdl
		$conn = Connection::getInstance();
		//chuan bi truy van
		$query = $conn->prepare("delete from maintenance where mabt=:var_mabt");
		//thuc thi truy van, co truyen tham so vao cau lenh sql
		$query->execute(["var_mabt" => $mabt]);
	}
	
}
