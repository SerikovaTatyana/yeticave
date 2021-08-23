<?php 

include_once('c/C_Base.php');

class C_Index extends C_Base {
	
	// Все категории
	public $all_category;
	// Все продукты
	//public $all_product;
	//Получение времени конца аукцеона
	public $end_time;
	// Все продукты
	public $all_product;
	// Расчет времени конца аукцеона
	public $how_much_time;
	// Данные одного пользователя по id
	//public $user;
	
	
	
	
	// Контент страницы
	function Content_page(){
		
		// Все категории
		$this->all_category = parent::all_category();
		// Все продукты
		//$this->all_product = parent::all_product();
		parent::all_product();
		//Получение времени конца аукцеона
		//$this->end_time = parent::end_time();
		// Расчет времени конца аукцеона
		$this->how_much_time = parent::how_much_time($this->all_product);
		// Проверка есть ли пользователь в сессии
		//$this->user = $this->user_session();
		$this->user_session();
		
	}
	
	
	// Внутренний шаблон.
	function get_inside(){
		
		$this->name_file = 'v/v_index.php';
		$this->content = $this->view_include($this->name_file, array('all_category' => $this->all_category, 'all_product' => $this->how_much_time));
		
	}
	
	
    // Внешний шаблон.
	function get_view_main(){
		
		$main_view = $this->view_include('v/v_main.php', array( 'all_category' => $this->all_category, 'content' => $this->content, 'user_data' => $this->user_data ));
		echo $main_view;
		
	}
	
	
	
}



?>