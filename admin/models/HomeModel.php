<?php
trait HomeModel
{
	public function getChartDataForStackedBarChart()
	{
		//lay bien ket noi csdl
		$db = Connection::getInstance();
		//thuc hien truy van
		$query = "SELECT categories.tendm AS category_name, 
                 COUNT(*) AS total_products, 
                 SUM(CASE WHEN products.trangthai = 0 THEN 1 ELSE 0 END) AS tudo, 
                 SUM(CASE WHEN products.trangthai = 1 THEN 1 ELSE 0 END) AS dangsudung, 
                 SUM(CASE WHEN products.trangthai = 2 THEN 1 ELSE 0 END) AS dangbaotri, 
                 SUM(CASE WHEN products.trangthai = 3 THEN 1 ELSE 0 END) AS hong
          FROM products 
          INNER JOIN categories ON products.madm = categories.madm 
          GROUP BY categories.tendm";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
}
?>