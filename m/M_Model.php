<?php 

class M_Model {
	
	public $include_db;
	
	//Подключение к бд
	function __construct(){
		
		$include_db = new DB_Db;
		$this->include_db = $include_db->db_include();
		
		
	}
	
	// Все категории
	function all_category(){
		
		$all_category = $this->include_db->prepare("SELECT * FROM category");
		$all_category->execute();
		$all_category = $all_category->fetchAll(PDO::FETCH_ASSOC);
		return $all_category;
		
	}
	
	// Продукты одной категории
	function product_once_category($id_category){
		
		$product_once_category = $this->include_db->prepare("SELECT * FROM product WHERE category = $id_category");
		$product_once_category->execute();
		$product_once_category = $product_once_category->fetchAll(PDO::FETCH_ASSOC);
		return $product_once_category;
		
	}
	
    // Все продукты
	function all_product(){
		
		$all_product = $this->include_db->prepare("SELECT * FROM product");
		$all_product->execute();
		$all_product = $all_product->fetchAll(PDO::FETCH_ASSOC);
		return $all_product;
		
	}
	
	//Получение времени конца аукцеона 
	function end_time(){
		
		$end_time = $this->include_db->prepare("SELECT id_product, date FROM product");
		$end_time->execute();
		$end_time = $end_time->fetchAll(PDO::FETCH_ASSOC);
		return $end_time;
		
	}
	
	// Один продукт 
	function once_product($id_product) {
		
		//var_dump($id_product);
		$once_product = $this->include_db->prepare("SELECT * FROM product WHERE id_product = $id_product");
		$once_product->execute();
		$once_product = $once_product->fetchAll(PDO::FETCH_ASSOC);
		return $once_product;
		
	}
	
	// Одна категория (Получение id по имени)
	function once_category($id_category){
		
		$once_category = $this->include_db->prepare("SELECT * FROM category WHERE  id_category = $id_category");
		$once_category->execute();
		$once_category = $once_category->fetchAll(PDO::FETCH_ASSOC);
		return $once_category;
		
	}
	
	// Имя Одной категории
	function name_category($id_category){
		
		$once_category = $this->include_db->prepare("SELECT name_category FROM category WHERE  id_category = $id_category");
		$once_category->execute();
		$once_category = $once_category->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_LAST);
	
		//return $once_category;
		return $once_category["name_category"];
	
	}
	
	// История ставок для одного продукта
	function history_rate($id_product){
		 
		$history_rate = $this->include_db->prepare("SELECT * FROM rate WHERE id_product = $id_product ORDER BY time DESC");
		$history_rate->execute();
		$history_rate = $history_rate->fetchAll(PDO::FETCH_ASSOC);
		return $history_rate;
		
	}
	
	// Один пользователь по id (только имя)
	function name_user($id_user){
		
		$name_user = $this->include_db->prepare("SELECT name FROM user WHERE id_user = $id_user");
		$name_user->execute();
		$name_user = $name_user->fetchAll(PDO::FETCH_ASSOC);
		return $name_user;
		
	}
	
	// Массив с именами пользователей по id
	function name_user_arr($name_user_arr){
		
		$str_inquiry = "";
		
		
		for($i = 0; $i < count($name_user_arr); $i++){
			
			if($i != 0) {
				
				$str_inquiry .= " OR id_user = " . $name_user_arr[$i]['id_user'];
				
			} else {
				
				$str_inquiry .= "id_user = " . $name_user_arr[$i]['id_user'];
				
			}
			
		}
		
		
		$name_user = $this->include_db->prepare("SELECT id_user, name FROM user WHERE $str_inquiry");
		$name_user->execute();
		$name_user = $name_user->fetchAll(PDO::FETCH_ASSOC);
		
		return $name_user;
	 
		
	}
	
	
	// Проверка на существование пользователя с таким же логином
	function control_user($name){
		
		$result;
	
		$name_result = $this->include_db->prepare("SELECT * FROM user WHERE name = '$name'");
		
		$name_result->execute();
		$name_result = $name_result->fetchAll(PDO::FETCH_ASSOC);

		// Если пользователя с таким именем нет
		if(count($name_result) == 0){
			
			
			$result = true;
			
		} else { // Если пользователь уже есть
			
			
			$result = false;
			
		}

		
		return $result;
		
	}
	
	
	// Сохранение нового пользователя
	function save_user($data_user){
		
		$name = $data_user['name'];
		$password = $data_user['password'];
		$email = $data_user['email'];
		$message = $data_user['message'];
		$avatar = $data_user['avatar'];
		
		$save_user = $this->include_db->prepare("INSERT INTO user SET name=:name, pass=:pass, email=:email, avatar=:avatar, message=:message");
		$params = ['name' => $name, 'pass' => $password, 'email' => $email, 'avatar' => $avatar, 'message' => $message];
		
		$save_user->execute($params);
		
	}
	
	
	// Авторизация пользователя
	function authorization($data_form){
		
		$result;
		
		// Имя пользователя 
		$name = $data_form['name'];
		// Пароль
		$password = $data_form['password'];
	

		$auth_result = $this->include_db->prepare("SELECT id_user, name, pass FROM user WHERE name = '$name' AND pass='$password'");
		//$auth_result = $this->include_db->prepare("SELECT * FROM user WHERE name = '$name' AND pass='$password'");
		$auth_result->execute();
		
		$auth_result = $auth_result->fetchAll(PDO::FETCH_ASSOC);

		
		
		
		// Если пользователь ввкл логин и пароль правильно
		if(count($auth_result) != 0 ){
			
			$result = $auth_result[0]['id_user'];
			
		} else {
			
			$result = false;
			
		}
		
		return $result;
		
		
	}
	
	
	// Данные одного пользователя по id
	function user($id){
		
		$name_user = $this->include_db->prepare("SELECT * FROM user WHERE id_user = '$id'");
		$name_user->execute();
		$name_user = $name_user->fetchAll(PDO::FETCH_ASSOC);
		return $name_user;
		
	}
	
	/*
	// Сохранение нового пользователя
	function save_user($data_user){
		
		$name = $data_user['name'];
		$password = $data_user['password'];
		$email = $data_user['email'];
		$message = $data_user['message'];
		$avatar = $data_user['avatar'];
		
		$save_user = $this->include_db->prepare("INSERT INTO user SET name=:name, pass=:pass, email=:email, avatar=:avatar, message=:message");
		$params = ['name' => $name, 'pass' => $password, 'email' => $email, 'avatar' => $avatar, 'message' => $message];
		
		$save_user->execute($params);
		
	}
	*/
	
	// Получение id категории по имени
	
    // Сохранение лота
	function save_lot($data_form){
		
		echo "<pre>";
		    var_dump($data_form);
		echo "</pre>";
		
		$id_user = $data_form["id_user"];
		$lot_name = $data_form["lot-name"];
		$category = $data_form["category"];
		$message = $data_form["message"];
		$lot_rate = $data_form["lot-rate"];
		$lot_step = $data_form["lot-step"];
		$lot_date = $data_form["lot-date"];
		$lot_photo = $data_form["lot_photo"];
		
		$save_lot = $this->include_db->prepare("INSERT INTO product SET id_user=:id_user, name=:name, img=:img, description=:description, prise=:prise, category=:category, date=:date, min_step=:min_step");
		
		$params = ['id_user' => $id_user, 'name' => $lot_name, 'img' => $lot_photo, 'description' => $message, 'prise' => $lot_rate, 'category' => $category, 'date' => $lot_date, 'min_step' => $lot_step];
		
		$save_lot->execute($params);
		
	}
	
	
	// Получаем все ставки одного пользователя
	function bets_user($id_user){
		
		$data_user = $this->include_db->prepare("SELECT * FROM rate WHERE id_user = '$id_user'");
		$data_user->execute();
		$data_user = $data_user->fetchAll(PDO::FETCH_ASSOC);
		return $data_user;
		
	}
	
	
	
	
	
	
	/*
	// Массив с именами пользователей по id
	function name_user_arr($name_user_arr){
		
		$str_inquiry = "";
		
		
		for($i = 0; $i < count($name_user_arr); $i++){
			
			if($i != 0) {
				
				$str_inquiry .= " OR id_user = " . $name_user_arr[$i]['id_user'];
				
			} else {
				
				$str_inquiry .= "id_user = " . $name_user_arr[$i]['id_user'];
				
			}
			
		}
		
		
		$name_user = $this->include_db->prepare("SELECT id_user, name FROM user WHERE $str_inquiry");
		$name_user->execute();
		$name_user = $name_user->fetchAll(PDO::FETCH_ASSOC);
		
		return $name_user;
	 
		
	}
	*/
	
	
	
	
	// Массив с информацией о продуктах одного пользователя в разделе Мои ставки
	function product_id($array_bets){
		
		//var_dump($array_bets);
		$str_inquiry = "";
		// Только id
		$only_id = array();
		
		
		// Перебираем массив, доставем только id продуктов, из Мои ставки
		foreach( $array_bets as $key => $product_arr ){

			foreach( $product_arr as $id_product => $value_id ) {
				
				if($id_product == "id_product"){
					//var_dump($value_id);
					
					$only_id[] = $value_id;
					
				}

				
			}

		}
		
		// Готовим запрос для выборки продуктов по id
		for($i = 0; $i < count($only_id); $i++){
			
			if($i == 0){
				
				$str_inquiry .= "id_product = " . $only_id[$i];
				
			} else {
				
				$str_inquiry .= " OR id_product = " . $only_id[$i];
			
			}
			
		}
		
		
		
		$product = $this->include_db->prepare("SELECT * FROM product WHERE $str_inquiry");
		$product->execute();
		$product = $product->fetchAll(PDO::FETCH_ASSOC);
		
		return $product;
		
		
	}
	
	
	// Мои ставки, связанные таблицы product и rate
	function all_date($id_user){
		
		//echo $id_user;
		
	    //$all_date = $this->include_db->prepare("SELECT * FROM rate JOIN product ON rate.id_product = product.id_product WHERE rate.id_user = $id_user");
		$all_date = $this->include_db->prepare("SELECT * FROM product JOIN rate ON product.id_product = rate.id_product WHERE rate.id_user = $id_user");
		
		//$all_date = $this->include_db->prepare("(SELECT * FROM product JOIN rate ON product.id_product = rate.id_product WHERE rate.id_user = $id_user) 
		//UNION SELECT * FROM product JOIN rate ON product.id_product = rate.id_product");
		
		$all_date->execute();
		$all_date = $all_date->fetchAll(PDO::FETCH_ASSOC);
		/*
		echo "<pre>";
			
			var_dump($all_date);
			
		echo "</pre>";
		*/
	
		return $all_date;
		
	}
	
	
}


?>