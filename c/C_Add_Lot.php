<?php 

include_once('c/C_Base.php');

class C_Add_Lot extends C_Base {
	
	public $error = "";
	
	// Контент страницы
	function Content_page(){
		
		// Все категории
		$this->all_category = parent::all_category();
		// Если пользователь отправил данные 
		if(!empty($_POST)){
			
			self::new_lot();
			
		}
		
		
	}
	
	public $data_form;

	
	// Новый лот
	function new_lot(){
		
		$data_form = $_POST;
		// Защита данных
		$this->data_form = $this->protected_post_data($data_form);
		// Проверка есть ли пользователь в сессии
		self::id_user();
		// Сохранение картинки 
		self::save_image();
		// Сохранение лота
		self::save_lot();
        // Перенаправление пользователя 
		header('Location: /mysite/yeti_cave/index.php');
	}
	
	// Сохранение лота
	function save_lot(){
		
		// Сохранение лота
		$this->model->save_lot($this->data_form);
		//var_dump($this->data_form);
		
	}
	
	//public $id_user;
	// Проверка есть ли пользователь в сессии
	function id_user(){
	
		// Проверка есть ли пользователь в сессии
		$this->user_session();
		// Получаем массив со всеми данными пользователя
		$id_user = $this->user_data[0]["id_user"];
        // Добавляем id в текущий массив с продуктом
		$this->data_form['id_user'] = $id_user;
		
	}
	
	//Массив $_FILES с картинкой
	public $img_data;
	// Путь и имя картинки
	public $img_avatar;
    
	// Сохранение картинки
	function save_image(){
		
		// Пользователь прислал картинку
		if($_FILES['lot_photo']['error'] == 0){
			
			$this->img_data = $_FILES['lot_photo'];
			self::save_img();
			
		} else { // Если пользователь не прислал картинку, ставим значение по умолчанию
			
			$this->data_form['lot_photo'] = "img_lot/no_photo.png";
			
		}
		
	}
	
	
	// Сохранить картинку 
	// https://php.ru/forum/threads/proverka-fajla-izobrazhenija-pri-zagruzke.10853/
	// https://denisyuk.by/all/polnoe-rukovodstvo-po-zagruzke-izobrazheniy-na-php/
	function save_img(){

		$result_control_img = $this->control_img($this->img_data);
		//"Выберете другой формат изображения: png, jpg или jpeg"
		if(!$result_control_img) { // Если формат не верный
			
			$this->error .= "Выберете другой формат изображения: png, jpg или jpeg. ";
			
			//var_dump($result_control_img);
			
		} else { // Если формат верный, сохраняем картинку
			
			
			self::save_catalog();
			
			
		}
		
	}
	
	
	// Сохранение картинки в папку
    function save_catalog(){
		
		$this->img_data;
		$place = $this->img_data['tmp_name'];
		$name = $this->img_data['name'];
		
		// Получаем расширение файла
		$type = new SplFileInfo($name);
		$type_img = $type->getExtension();
		
		// Генерируем имя
		$generation_img_name = md5(microtime() . rand(0, 9999));
 
		// Добавляем картинку в итоговый массив
		$this->data_form['lot_photo'] = 'img_lot/' . $generation_img_name . '.' . $type_img;
		// Сохраняем изображение в папку
		move_uploaded_file($place, 'img_lot/' . $generation_img_name . '.' . $type_img);
		
	}
	
	
	// Внутренний шаблон.
	function get_inside() {
		
		$this->name_file = 'v/v_add_lot.php';
		$this->content = $this->view_include($this->name_file, array('error' => $this->error, 'all_category' => $this->all_category));
		
	}
	
	
}



?>