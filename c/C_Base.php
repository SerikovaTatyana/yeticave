<?php 
//2020-02-22 18:00:00
include_once('c/Controller.php');

class C_Base extends Controller {
	
	public $all_category;
	// Все категории
	function all_category(){
		
		$this->all_category = $this->model->all_category();
		// Все категории
		return $this->all_category;
		
	}
	
	
	//public $all_product;
	
	// Все продукты
	function all_product(){
		
		// Все продукты
		//return $this->model->all_product();
		$this->all_product = $this->model->all_product();
		
		
	}
	
	//Получение времени конца аукцеона
	function end_time(){
		
		//Получение времени конца аукцеона
		return $this->model->end_time();
		
	}
	
	
	public $arr_product_time;
	
	// Расчет времени конца аукцеона
	function how_much_time($product_arr){
		
		/*
		echo "<pre>";
		
		var_dump($product_arr);
		
		echo "</pre>";
		*/
		
		$this->arr_product_time = $product_arr;
		
		
		// Расчет оставшегося времени для каждого продукта
		//foreach( $this->all_product as $key => $value ){
		foreach( $product_arr as $key => $value ){
	        
			// Время конца аукцеона
			//$end_date = $this->all_product[$key]["date"];
			$end_date = $this->arr_product_time[$key]["date"];
			
			//var_dump($end_date);
			
			
			// Расчет оставшегося времени
			//$countdown = self::countdown($end_date, $key);
			$countdown = self::countdown($end_date, $key);
			/*
			echo "<pre>";
			var_dump($countdown);
			echo "<pre>";
			*/
			
			// Добавляем расчитанное время в массив с продуктами
			$this->arr_product_time[$key]["countdown"] = $countdown;
		    
			// Проверка, если времени мало, то добавляем класс для верстки
			//self::little_time($key, $countdown);
			
			
		}
		
		
		//var_dump($this->arr_product_time);
		
		return $this->arr_product_time;
		
		
	}
	
	// Обратный отсчет времени
	function countdown($time_end, $id_product){
		
		date_default_timezone_set('Asia/Almaty');

		// Время сервера
		$time_start = new DateTime(date('Y-m-d H:i:s'));
	
		// Время конца аукцеона
		$end_date = new DateTime(date($time_end));
		
		
		// Осталось лет
		//$yer_left = $time_start->diff($end_date)->y;
		
		// Осталось месяцев
		//$month_left = $time_start->diff($end_date)->m;
		
		/*
		echo "<pre>";
			//var_dump($end_date);
		echo "</pre>";
		*/
		
		// $example = date_diff(new DateTime(), new DateTime('2020-05-04 00:00:01'));
		// Годы и месяцы в днях
		$year_month = date_diff($time_start, $end_date)->days;
		
		// Осталось дней 
		//$day_left = $time_start->diff($end_date)->d;
		//var_dump($day_left);
		// Осталось часов
		$hour_left = $time_start->diff($end_date)->h;
		
		// Годы и месяцы в днях + дни
		//$all_day = $year_month + $day_left;
		$all_day = $year_month;
		
		
		
		if($time_start < $end_date){ // Если разница во времени положительная 
		    
			// Если времени осталось мало, нужно добавить класс для верстки
			self::little_time($id_product, $all_day, $hour_left);
			//var_dump($time_start->diff($end_date)->format("%yг. %mм. %d д. %H:%I:%S"));
			// Возврощяет объект с оставшимся временем
		    // return $time_start->diff($end_date)->format("%yг. %mм. %d д. %H:%I:%S");
			
			// Часы, минуты, секунды
			$hour_minutes_seconds = $time_start->diff($end_date)->format("%H:%I:%S");
			
			// Дни + Часы, минуты, секунды
			$all_time =  $all_day . "д. " . $hour_minutes_seconds;
			
			//return $time_start->diff($end_date)->format("%yг. %mм. %d д. %H:%I:%S");
		    return $all_time;
			
		}
		
		
		
	}
	
	
	// Если мало времени, добавляем класс для верстки
	function little_time($id_product, $day_left, $hour_left){

	    
		if($day_left < 0 || $day_left == 0){ // Сначала проверяем сколько осталось дней
			
			if ($hour_left < 3){ // Затем проверяем сколько осталось часов, если меньше 3, то добаляем класс
				
				// Добавляем в массив название класса
				//$this->all_product[$id_product]["timer_finishing"] = true;
				$this->arr_product_time[$id_product]["timer_finishing"] = true;
				
		    } else {// Если время есть
			
			    //$this->all_product[$id_product]["timer_finishing"] = false;
			   $this->arr_product_time[$id_product]["timer_finishing"] = false;
				
			}
			
				 
		} else { // Если время есть
				
			//$this->all_product[$id_product]["timer_finishing"] = false;
			$this->arr_product_time[$id_product]["timer_finishing"] = false;
				
		}
		
		
		
	}
	
	
	
	// Один продукт 
	function once_product($id_product){
		
		// return $this->model->all_category();
		return $this->model->once_product($id_product);

	}
	
	// Одна категория
	function once_category($id_category){
		
		return $this->model->once_category($id_category);
		
	}
	
	// Имя Одной категории
	function name_category($id_category){
		
		return $this->model->name_category($id_category);
	
	}
	
	
	
	// Один пользователь по id(имя)
	function name_user($id_user){
		
		//return $this->model->name_user($id_user);
		//return $name_user = $this->model->name_user($id_user);
		$name_user = $this->model->name_user($id_user);
		return $name_user;
	}
	
	
	// История ставок для одного продукта
	function history_rate($id_product){

		// История ставок для одного продукта
		$history_rate = $this->model->history_rate($id_product);
		
		// Имя пользователя (массив)
		$name_user_arr = $this->model->name_user_arr($history_rate);
		
	
		for($i = 0; $i <= count($history_rate) - 1; $i++){
			
			// https://www.kobzarev.com/programming/php-proper-merging-arrays/
			$key_id = $history_rate[$i]["id_user"];
			
			// Имя одного пользователя по id сделавшего ставку
			$name = self::name_arr($name_user_arr, $key_id);
			
			$history_rate[$i]["name"] = $name;
			
			// Время в красивом формате для вывода
			$history_rate[$i]["time_beautiful"] = self::time_beautiful($history_rate[$i]["time"]);
			
			/*
			echo "<pre>";
			var_dump($history_rate[$i]["time"]);
			echo "</pre>";
			*/
			
		}
		
		return $history_rate;
		
	}
	
	// Имя одного пользователя по id сделавшего ставку. Вытаскиваем имя
	function name_arr($name_user_arr, $id_user){ // Массив с именами, id имени
		
		$name = "";
		
		for($i = 0; $i < count($name_user_arr); $i++){
			
			$key_name = array_search($id_user, $name_user_arr[$i]); 
		
			if($key_name){
	
				$name = $name_user_arr[$i]["name"];
			    return $name;
				
			}

		}
	
	}
	
	// Время в красивом формате для вывода
	function time_beautiful($date_time){
		
		
		date_default_timezone_set('Asia/Almaty');
		
		
		// Время ставки. Преобразуем дату из строки в объект
		$date_time = new DateTime(date($date_time));
		
		

		// Время сервера
		$time_start = new DateTime(date('Y-m-d H:i:s'));
		
		// $year_month = date_diff($time_start, $end_date)->days;
		
		// Переведем месяцы и годы в дни 
		$days = date_diff($time_start, $date_time)->days;
		// Часы 
		$hour = date_diff($time_start, $date_time)->h;
		// Минуты
		$minutes = date_diff($time_start, $date_time)->i;
		
		$time_string = '';
		
		// $hour_minutes_seconds = $time_start->diff($date_time)->format("%H:%I:%S");
		
		    /*
			echo "<pre>";
				var_dump($date_time->format('d.m.y в %h:%i'));
				//echo date('l jS \of F Y h:i:s A')
			echo "</pre>";
		    */
		
		
		    if($days == 0) {
				
				/*
				echo "<pre>";
					var_dump($days);
				echo "</pre>";
				*/
				switch($hour){
					
					case 0: 
					    // $time_string = $minutes . " минут назад";
					    $time_string = self::suffix($minutes);
					
					break;
					
					case 1: 
					    $time_string = 'Час назад';
					break;
					
					default:
					    $time_string = $date_time->format('d.m.y в h:i');
					    
					
					
				}
				
				
				
				
			} else {
				
				$time_string = $date_time->format('d.m.y в h:i');
				
			}
			
			//echo $text;
		    // $hour_minutes_seconds = $time_start->diff($end_date)->format("%H:%I:%S");
		    
			return $time_string;
		
	}
	
	
	// Правильное окончание для минут
	function suffix($number){
		
		
		
		//$number = 0;
		
		$text = '';
		
		// Минута 1 21 
		// Минуты 2 3 4 
		// Минут 0 5 6 7 8 9 10   11 12 13 14  20
		
		// Десятки
		$dozens = (int) ($number / 10); 
		
		// Единицы
		$number_remainder = $number % 10; // % вернет остаток от деления
		
		
		if( $dozens == 0 ){ // Если число однозначное
			
			
			if($number == 0) {
				
				$text = 'Только что';
				$number = '';
				
			} else if($number == 1) {
				
				$text = ' минутa';
				
			} else if( $number <= 4 && $number !== 0) {
				
				$text = ' минуты';
				
			} else {
				
				$text = ' минут';
				
			}
			
			
		} else if( $dozens == 1) { // Ecли двухзначное. От 10 до 19
			
			$text = ' минут';
			
			
		} else if($number_remainder == 1) { // Если остаток от числа 1
			
			$text = ' минутa';
			
		} else if($number_remainder <= 4) { // Если остаток от числа от 2 до 4
		
		    $text = ' минуты';
		
		} else {
			
			$text = ' минут';
			
		}
	    
		
		/*
		
		echo "<pre>";
			var_dump($number . $text);
		echo "</pre>";
		*/
		
        
		return $number . $text;
		
	}
	
	
	// Массив $_POST
	public $data_form;
	// Переборка массива $_POST с данными от пользователя
	function protected_post_data($data){
		
		
		$this->data_form = $data;
		
		// Защита данных	
		foreach($this->data_form as $key => $value){
			
			// Если значение в массиве строка
			if(is_string($value)){
				
				// Пересохраняем проверенные данные
				$this->data_form[$key] = $this->control_data($value);

			}
			
			
		}
		
		return $this->data_form;
		
	}
	
	
	// Проверка текстовых, внешних данных от пользователя
	function control_data($data){

		$data = strip_tags($data);
		$data = htmlspecialchars($data);
		$data = trim($data);
		
		return $data;
	}

	
	// Проверка изображения
	function control_img($arr_img){
	    
		$result_img = true;
		
		// Проверка изображения полученного от пользователя по сигнатуре
		$signature = self::img_signature_control($arr_img);
		
		// Если сигнатура не верна
		
		if(!$signature){

			$result_img = false;

		} 
		
		
		
		// Проверка по формату
		
		$format = self::img_type_control($arr_img);
		
        // Если формат не верный
        if(!$format){
			
			$result_img = false;
			return "format type error";
			
		}		 
	
		return $result_img; 
		
	}
	
	
	/* Проверка изображения полученного от пользователя по сигнатуре
	// Хороший пример защиты
	// https://php.ru/forum/threads/proverka-fajla-izobrazhenija-pri-zagruzke.10853/
	https://ru.wikipedia.org/wiki/%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA_%D1%81%D0%B8%D0%B3%D0%BD%D0%B0%D1%82%D1%83%D1%80_%D1%84%D0%B0%D0%B9%D0%BB%D0%BE%D0%B2
	*/
	function img_signature_control($arr_img){
		
		$result_signature;
		
		// Открывает файл из временной директории параметр. Параметр r - читает файл. Флаг b - принудительно включает бинарный режим
		// https://www.php.net/manual/ru/function.fopen.php
		$open_file = fopen($arr_img["tmp_name"], "rb"); 
		// Читает файл
		$read_file = fread($open_file, 8); // 8 - длина в байтах
		fclose($open_file);
		
		// Сигнанура шестнадцатиричная 16
		$signature_16 = unpack('H16', $read_file);
		// Сигнанура 4
		$signature_4 = unpack('H4', $read_file);
	
		
		// Проверка 16 битной сигнатуры
		if($signature_16[1] == "89504e470d0a1a0a"){
			      
			echo "89504e470d0a1a0a";
			$result_signature = true;
			
		} else if ($signature_16[1] == "ffd8ffe000104a46"){
			
			echo "ffd8ffe000104a46";
			$result_signature = true;
		
        // Проверка 4 битной сигнатуры		
		} else if ($signature_4[1] == "ffd8"){
			
			echo "ffd8";
			$result_signature = true;
			
		} else {
			
			$result_signature = false;
			
		}
		
	
		
		return $result_signature;
		
	}
	
	
	// Проверка изображения полученного от пользователя по расширению
	function img_type_control($arr_img){
		
		$type = $arr_img['type'];
		
		
		
		switch($type){
			
			case 'image/png':
			return true;
			break;
			
			case 'image/jpg':
			return true;
			break;
			
			case 'image/jpeg':
			return true;
			break;
			
			default:
			return false;
			
		}
		
		
	}
	
	
	// Данные одного пользователя по id
	public $user_data;

	// Проверка есть ли пользователь в сессии
	function user_session(){
		
		$array_user = array();
		
		// Если сессия не пуста, отдаем массив с данными пользователя
		if(!empty($_SESSION['login']) && !empty($_SESSION['id'])){
			
			$id = $_SESSION['id'];
			$array_user = $this->model->user($id);
			
		}
		
		// var_dump($array_user);
		// Данные одного пользователя
		$this->user_data = $array_user;
		
		return $this->user_data;
		
	}
	
	// Информация о продуктах по id
	
	
	public $product;
	// История ставок для одного пользователя
	public $array_bets;
	
	// История ставок для одного пользователя
	function user_bets($id_user) {
		
		//var_dump($id_user);
	
		// История ставок для одного пользователя
		$this->array_bets = $this->model->bets_user($id_user);
		//var_dump($array_bets);
		// Информация о продуктах по id
		$this->product = $this->model->product_id($this->array_bets);
		
		//self::union_array($this->array_bets, $this->product);
		
		// Все категории
		//return $this->model->all_category();
		
		$all_date = $this->model->all_date($id_user);
		
		/*
		echo "<pre>";
		
		var_dump($all_date);
		
		echo "</pre>";
		*/
	
		//return $this->array_bets;
		return $all_date;
		
	}
	
	

    // Объединяем массив со ставками и массив с продуктами
    //function union_array($id_array, $id_product){
    function union_array($arr_bets, $arr_product){
		
		
		
		for($i = 0; $i <= count($arr_bets) - 1; $i++){
			
			
			//$history_rate[$i]["name"] = $name;
			
			//$arr_bets
			
			//$result = $arr_bets + $arr_product;
			
			$id_product = $arr_bets[$i]["id_product"];
			
			//echo $id_product;
			
			// array_search('blue', array_column($people, 'fav_color'));
			
			$product = array_search($id_product, array_column($arr_product, 'id_product'));
			//$product = array_column($arr_product, 'id_product');
			
			echo "<pre>";
			    var_dump($product);
			echo "</pre>";
			
		}
		
		
		
		/*
		
		echo "<pre>";
		
		var_dump($arr_bets);
		
		echo "</pre>";
		
		echo "/////////////////////////////////";
		
		echo "<pre>";
		
		var_dump($arr_product);
		
		echo "</pre>";
		
		echo "/////////////////////////////////";
		
		
		echo "<pre>";
		
			var_dump($result);
		
		echo "</pre>";
		
		*/
		
	
	/*
		foreach($this->product as $key => $value){
			
			//var_dump($id_array);
			
			//var_dump($value["name"]);
			
            
			$this->array_bets[$id_array]["name"] = $value["name"];
			$this->array_bets[$id_array]["img"] = $value["img"];
			$this->array_bets[$id_array]["date_end"] = $value["date"];
			
			
			
		}
	*/
		/*
		for($i = 0; $i <= count($history_rate) - 1; $i++){
			
			// https://www.kobzarev.com/programming/php-proper-merging-arrays/
			$key_id = $history_rate[$i]["id_user"];
			
			// Имя одного пользователя по id сделавшего ставку
			$name = self::name_arr($name_user_arr, $key_id);
			
			$history_rate[$i]["name"] = $name;
			
			// Время в красивом формате для вывода
			$history_rate[$i]["time_beautiful"] = self::time_beautiful($history_rate[$i]["time"]);
			
			
			//echo "<pre>";
			//var_dump($history_rate[$i]["time"]);
			//echo "</pre>";
			
			
		}
		
		*/
		
		
		
		
		
		
		
		
	}	
	
	
	
	
	// Внешний шаблон.
	function get_view_main(){
		
		$main_view = $this->view_include('v/v_main_pages.php', array( 'all_category' => $this->all_category, 'content' => $this->content, 'user_data' => $this->user_data ));
		echo $main_view;
		
	}
	
}


?>