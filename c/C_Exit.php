<?php 

include_once('c/C_Base.php');

class C_Exit extends C_Base {
	
	public $error = "";
	
	// Контент страницы
	function Content_page(){
		
		// Выход пользователя из учетной записи
		self::exit_user();
		// Выкидываем пользователя на главную страницу
		//header('Location: /mysite/yeti_cave/index.php');
		header('Location: /index.php');
		
	}
	
	// Выход пользователя из учетной записи
    function exit_user(){

		// Удаляем из сессии Логин
		unset($_SESSION['login']);
		// Удаляем из сессии пароль
		unset($_SESSION['id']);
		

	}
	
	// Внутренний шаблон.
	function get_inside() {
		
		$this->name_file = 'v/v_add_lot.php';
		$this->content = $this->view_include($this->name_file, array('error' => $this->error));
		
	}
	
	
}



?>