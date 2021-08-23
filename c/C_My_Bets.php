<?php 

include_once('c/C_Base.php');

class C_My_Bets extends C_Base {
	
	public $error = "";
	
	// Получаем данные пользователя
	public $user_data;
	// Весь массив Мои ставки
	public $array_bets;
	public $all_category;
	
	// Контент страницы
	function Content_page(){
		
		// Проверка есть ли пользователь в сессии, получаем данные пользователя
		$this->user_data = $this->user_session();
		// Id пользователя
		$id_user = $this->user_data[0]['id_user'];
		// Ставки одного пользователя
        $this->array_bets = $this->user_bets($id_user);		
		// Данные о продуктах для таблицы Мои ставки 
		//self::Date_base($this->array_bets);
		
		// Все категории
		$this->all_category = parent::all_category();
		
		// Расчет времени конца аукцеона
		//$this->how_much_time = parent::how_much_time($this->all_product);
		$this->array_bets = parent::how_much_time($this->array_bets);
		// Время в красивом формате для вывода
		$this->array_bets = self::time_beautiful($this->array_bets);
		// Добавляем категорию к каждому продукту
		$this->array_bets = self::once_category($this->array_bets);
	
	}
	
	// Время в красивом формате для вывода
	function time_beautiful($array_bets){
		
		for($i = 0; $i <= count($array_bets) - 1; $i++){
			
			// Время в красивом формате для вывода
			$array_bets[$i]["time_beautiful"] = parent::time_beautiful($array_bets[$i]["time"]);
			//$test = parent::time_beautiful($array_bets[$i]["time"]);

		
		}

		return $array_bets;
		
	}
	
	// Добавляем категорию к каждому продукту
	function once_category($array_bets){
		
		for($i = 0; $i <= count($array_bets) - 1; $i++){
			
			// Время в красивом формате для вывода
			$array_bets[$i]["name_category"] = parent::name_category($array_bets[$i]["category"]);
			//$test = parent::once_category($array_bets[$i]["name_category"]);

		
		}
		
		return $array_bets;
		
	}
	
	
	/*
	// Данные о продуктах для таблицы Мои ставки 
	function Date_base($array_bets){
	
		foreach($array_bets as $value) {
			
			//echo $value;
			
		}
		
	}
	*/
	
	// Объединяем данные ставки-продукты с категориями 
	//function rates_category
	
	// Внутренний шаблон.
	function get_inside() {
		
		$this->name_file = 'v/v_my_bets.php';
		$this->content = $this->view_include($this->name_file, array('error' => $this->error, 'array_bets' =>  $this->array_bets, 'all_category' => $this->all_category));
		
	}
	
	
}



?>