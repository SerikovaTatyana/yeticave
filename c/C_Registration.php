<?php 

include_once('c/C_Base.php');

class C_Registration extends C_Base {
	
	public $error = "";
	
	// Контент страницы
	function Content_page(){
		
		// Если пришли данные для регистрации
		if(!empty($_POST)){
			
			self::registration();
			
		} 
		
		/*
		echo "<pre>";
		
		    var_dump($_FILES['avatar']);
		
		echo "</pre>";
		*/
		
		
		

	}
	
    /*
	// Массив $_POST
	public $data_form;
	*/
	//Массив $_FILES с картинкой
	public $img_data;
	// Путь и имя картинки
	public $img_avatar;
	
	// Запрос на регистрацию пользователя
    function registration(){
		
		$data_form = $_POST;
		// Защита данных
		$this->protected_post_data($data_form);
		
		/*
		// Защита данных	
		foreach($this->data_form as $key => $value){
			
			// Если значение в массиве строка
			if(is_string($value)){
				
				// Пересохраняем проверенные данные
				$this->data_form[$key] = $this->control_data($value);

			}
			
			
		}
		
		*/
		
		
		// Проверка на существование пользователя с таким же логином
		$result_name = $this->model->control_user($this->data_form['name']);
		
		// Если пользователя с таким именем нет
		if($result_name){

			// Проверка есть ли у пользователя картинка
			self::img_have();
			// Схраняем его базе
			$this->model->save_user($this->data_form);
			
		
			
		} else { // Если пользователь уже есть
			
			$this->error .= "Извините, введённый вами логин уже зарегистрирован. Введите другой логин. ";
			
		}
		
		
		
	}
	
	// Проверка есть ли у пользователя картинка
	function img_have(){
		
		
		
		// Пользователь прислал картинку
		if($_FILES['avatar']['error'] == 0){
			
			
			
			$this->img_data = $_FILES['avatar'];
			self::save_img();
			
		} else { // Если пользователь не прислал картинку, ставим значение по умолчанию
			
			$this->data_form['avatar'] = "img_avatar/no-photo.png";
			
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
 
		//move_uploaded_file($place, 'img_avatar/' . $name);
		// Обрезка изображения 
		self::img_mini($name, $place);
		// Добавляем картинку в итоговый массив
		$this->data_form['avatar'] = 'img_avatar/' . $this->generation_img_name . '.' . $this->type_img;
		
	}
	
	public $generation_img_name;
	public $type_img;
	
	// Обрезка изображения 
	// http://www.php.su/articles/?cat=graph&page=017
	function img_mini($name, $place){
		
		/* Работает сохраняет маленький квадрат
		
	    $realImages = imagecreatefromjpeg($_FILES['avatar']['tmp_name']);
		
		
		$place = imagecrop($realImages, ['x' => 0, 'y' => 0, 'width' => 40, 'height' => 40]);
		
		
	    //$test = imagepng($place, 'example-cropped.png');
	    $test = imagepng($place, 'img_avatar/test.png');
		
		*/
		
		// Получаем расширение файла
		$type = new SplFileInfo($name);
		$this->type_img = $type->getExtension();
		
		
		// Генерируем имя
		$this->generation_img_name = md5(microtime() . rand(0, 9999));
		// http://www.php.su/articles/?cat=graph&page=017
			
		// Получаем изображение пользователя 
		//$img_original = $_FILES['avatar']['tmp_name'];
		$img_original = $place;
		// Создаем новое изображение из зображения пользователя, вернет ресурс
		$img_resurs = imagecreatefromjpeg($img_original);
		// Размеры изображения
		$img_weight = imagesx($img_resurs);
		$img_height = imagesy($img_resurs);
			
		// Пропорция 
		$w = 40;
			
		// Вычисление пропорций 
		$ratio = $img_weight/$w;
		$w_dest = round($img_weight/$ratio);
		$h_dest = round($img_height/$ratio);
			
		// Создаем картинку
		$dest = imagecreatetruecolor($w_dest, $h_dest);
			
		// Копирование и изменение размера части изображения	
		$save = imagecopyresized($dest, $img_resurs, 0, 0, 0, 0, $w_dest, $h_dest, $img_weight, $img_height);
		// Сохраняет результат
		imagepng($dest, 'img_avatar/' . $this->generation_img_name . '.' . $this->type_img);
		
			
			
	}
	
	
			

	
	
	
	// Внутренний шаблон.
	function get_inside() {
		
		$this->name_file = 'v/v_registration.php';
		$this->content = $this->view_include($this->name_file, array('error' => $this->error));
		
	}
	
	
}



?>