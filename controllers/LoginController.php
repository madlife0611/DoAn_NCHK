<?php 
	include "models/LoginModel.php";
	class LoginController extends Controller{
		use LoginModel;
		public function registerPost(){
			$this->modelRegister();
		}
		public function login(){
			$this->loadView("Login.php");
		}
		public function loginPost(){
			$this->modelLogin();
		}
		public function logout(){
			$this->modelLogout();
		}
	}
 ?>