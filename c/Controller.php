<?php 


class Controller {
	
	protected $model;
	
	function __construct(){
		
		$model = new M_Model;
		$this->model = $model;

	}
	
	function view_include($fileName, $vars = array()) {
		
		// Установка переменных для шаблона.
		foreach($vars as $a => $b){
			$$a = $b;
		}
		
		// Генерация HTML в строку.
		ob_start();
		include $fileName;
		return ob_get_clean();
		
	}
	
	function Two_view() {
		
	    // Контент страницы
		$this->Content_page();
		
		// Проверка сессии
		$this->user_session();
		
		// Внутренний шаблон
		$this->get_inside();
		// Внешний шаблон
		$this->get_view_main();
		
	}
	
	
}


?>