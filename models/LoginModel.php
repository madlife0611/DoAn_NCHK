<?php 
	trait LoginModel{
		public function modelLogin(){
			$email = $_POST["email"];
			$password = $_POST["password"];
			//ma hoa password
			$password = md5($password);
			//---
			$conn = Connection::getInstance();
			$query = $conn->prepare("select matk,email,password,isAdmin from accounts where email=:var_email");
			$query->execute(["var_email"=>$email]);
			if($query->rowCount() > 0){
				//lay mot ban ghi
				$result = $query->fetch();
				if($password == $result->password && $result->isAdmin == 1){
					//dang nhap thanh cong
					$_SESSION['matk'] = $result->matk;
					$_SESSION['email'] = $result->email;
					header("location:index.php");
				}else if($password == $result->password && $result->isAdmin == 0){
                    //dang nhap thanh cong
					$_SESSION['matk'] = $result->matk;
					$_SESSION['email'] = $result->email;
					header("location:index.php");
				}else{
                    header("location:index.php?controller=account&action=login");
                }
			}
		}
	}
 ?>