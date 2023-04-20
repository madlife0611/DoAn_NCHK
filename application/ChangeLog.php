<?php 
	class ChangeLog{

		//ham ket noi csdl, ket qua tra ve mot bien -> kieu bien nay la bien object
		public static function saveChangelog($tenbang, $dulieucu, $dulieumoi, $matk, $trangthaithaydoi){
			$db = new PDO("mysql:host=localhost;dbname=mvc_qlvattu","root","");
            //lay du lieu theo kieu unicode
			$db->exec("set names utf8");
			//lay ket qua tra ve theo kieu object
			$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            $thoigian = date('Y-m-d H:i:s');
			// Thực hiện truy vấn insert vào bảng changelog
			$query_change = $db->prepare("INSERT INTO changelog (thoigian, tenbang, dulieucu, dulieumoi, matk, trangthaithaydoi) VALUES (:var_thoigian, :var_tenbang, :var_dulieucu, :var_dulieumoi, :var_matk, :var_trangthaithaydoi)");
			$query_change->execute([
				"var_thoigian" => $thoigian,
				"var_tenbang" => $tenbang,
				"var_dulieucu" => json_encode($dulieucu, JSON_UNESCAPED_UNICODE),
				"var_dulieumoi" => json_encode($dulieumoi, JSON_UNESCAPED_UNICODE),
				"var_matk" => $matk,
				"var_trangthaithaydoi" => $trangthaithaydoi
			]);
		}
	}
 ?>