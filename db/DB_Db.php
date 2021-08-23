<?php 

class DB_Db {
	
	function db_include(){
		
		$db = new PDO('mysql:host=localhost;dbname=yeti_cave', 'root', '');
		$db->exec("SET NAMES UTF8");
		return $db;
		
	}
	
}

?>