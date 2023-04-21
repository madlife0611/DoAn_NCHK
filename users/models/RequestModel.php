<?php
	trait RequestModel{		
		public function requestAdd($masp){
		    if(isset($_SESSION['request'][$masp])){
		        //nếu đã có sp trong giỏ hàng thì số lượng lên 1
		        $_SESSION['request'][$masp]['number']++;
		    } else {
		        $conn = Connection::getInstance();
		        $query = $conn->prepare("select * from products where masp=:masp");
		        $query->execute(array("masp"=>$masp));
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
		public function requestAddWithNumber($masp,$soluong){
		    if(isset($_SESSION['request'][$masp])){
		        //nếu đã có sp trong giỏ hàng thì số lượng lên 1
		        $_SESSION['request'][$masp]['number'] += $soluong;
		    } else {
		        $conn = Connection::getInstance();
		        $query = $conn->prepare("select * from products where masp=:masp");
		        $query->execute(array("masp"=>$masp));
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
		public function requestUpdate($masp, $number){
		    if($number==0){
		        //xóa sp ra khỏi giỏ hàng
		        unset($_SESSION['request'][$masp]);
		    } else {
		        $_SESSION['request'][$masp]['number'] = $number;
		    }
		}
		/**
		 * @param int
		 */
		public function requestDelete($masp){
		    unset($_SESSION['request'][$masp]);
		}

		public function requestTotal(){
		    $total = 0;
		    foreach($_SESSION['request'] as $product){
		        $total += $product['gianhap'] * $product['number'];
		    }
		    return $total;
		}

		public function requestNumber(){
		    $number = 0;
		    foreach($_SESSION['request'] as $product){
		        $number += $product['number'];
		    }
		    return $number;
		}

		public function requestList(){
		    return $_SESSION['request'];
		}

		public function requestDestroy(){
		    $_SESSION['request'] = array();
		}
		//=============
		//checkout
		public function requestCheckOut(){
			$conn = Connection::getInstance();			
			//lay masp vua moi insert
			$matk = $_SESSION["matk"];
			//---
			//---
			//insert ban ghi vao requests, lay request_id vua moi insert
			//lay tong gia cua gio hang
			$tongtien = $this->requestTotal();
			$query = $conn->prepare("insert into requests set matk=:matk, ngaylap=now(),tongtien=:tongtien");
			$query->execute(array("matk"=>$matk,"tongtien"=>$tongtien));
			//lay masp vua moi insert
			$request_id = $conn->lastInsertId();
			//---
			//duyet cac ban ghi trong session array de insert vao requestdetails
			foreach($_SESSION["request"] as $product){
				$query = $conn->prepare("insert into requestdetails set request_id=:request_id, masp=:masp, gianhap=:gianhap, soluong=:soluong");
				$query->execute(array("request_id"=>$request_id,"masp"=>$product["masp"],"gianhap"=>$product["gianhap"],"soluong"=>$product["number"]));
			}
			//xoa gio hang
			unset($_SESSION["request"]);
		}
		//=============
		public function requestHistory($recordPerPage){

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
		public function modelTotalRecord(){
			$matk = $_SESSION["matk"];
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from requests where matk = $matk");
			//tra ve so luong ban ghi
			return $query->rowCount();
		}
		//chi tiet don hang
		public function modelRequestsDetail($request_id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from requestdetails where request_id=$request_id");
			//tra ve mot ban ghi
			return $query->fetchAll();
		}
		public function modelGetProduct($masp){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from products where masp=$masp");
			//tra ve nhieu ban ghi
			return $query->fetch();
		}
		public function modelGetRequestsDetail($request_id, $masp){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("select * from requestdetails where request_id=$request_id and masp=$masp");
			//tra ve nhieu ban ghi
			return $query->fetch();
		}
		//giao hang
		public function modelDelivery($request_id){
			//lay bien ket noi csdl
			$conn = Connection::getInstance();
			//thuc hien truy van
			$query = $conn->query("update requests set trangthai = 0 where request_id=$request_id");
		}
	}	
?>