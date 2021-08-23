<?php 

include_once('c/C_Base.php');

class C_Authorization extends C_Base {
	
	public $error = "";
	// Все категории
	public $all_category;
	
	// Контент страницы
	function Content_page(){
		
		// Все категории
		$this->all_category = parent::all_category();
       
        // Пользователь отправил форму 
	    if(!empty($_POST)){
		   // Авторизация пользователя
		   self::authorization();
		   
	    }
	
	}
	
	// Массив $_POST
	//protected $data_form;
	
	// Авторизация пользователя
	function authorization(){
		
		$data_form = $_POST;
		// Защита данных
		$this->protected_post_data($data_form);
		// Авторизация пользователя
		$result = $this->model->authorization($this->data_form);
		
		
		//var_dump($result);
		
		// Если пользователь ввел данные верно, сохраняем данные в сессию
		if($result){

			$_SESSION['login'] = $this->data_form['name'];
			$_SESSION['id'] = $result;
			
			// Перенаправляем пользователя на гланую страницу
			//header('Location: http://localhost/mysite/yeti_cave/index.php');
			header('Location: /index.php');
		
		} else {
			
			$this->error .= "Извините, введённый вами логин или пароль неверный.";
			
		}
		
	}
	

	
	// Внутренний шаблон.
	function get_inside() {
		
		$this->name_file = 'v/v_authorization.php';
		$this->content = $this->view_include($this->name_file, array('error' => $this->error, 'all_category' => $all_category));
		
	}
	
	
}



?>