<?php 

include_once('c/C_Base.php');

class C_Lot extends C_Base {
	
	// Один продукт 
	public $once_product;
	// Одна категория
	public $once_category;
	// Все продукты
	//public $all_product;
	// Расчет времени конца аукцеона
	public $how_much_time;
	public $history_rate;
	// Цена последней ставки
	public $max_rate;
	// Минимальная ставка которую может поставить пользователь
	public $min_rate;
	// Стартовая цена
	public $price_start;
	
	
    // Контент страницы
	function Content_page(){
		
		 
		if(!empty($_GET['id'])){
			
			$id_product = $_GET['id'];
			// Один продукт
			$this->once_product = parent::once_product($id_product);
			// Одна категория
			$this->once_category = parent::once_category($this->once_product[0]['category']);
			// Расчет времени конца аукцеона
		    $this->how_much_time = parent::how_much_time($this->once_product);
			// История ставок
			$this->history_rate = parent::history_rate($id_product);
			// Все категории
			parent::all_category();
			
			// Если ставки были
			if($this->history_rate){
				
				// Цена последней ставки
				$this->max_rate = self::max_rate();
			
			} else { // Если ставок вообще не было возвращяем саму первоначальную стоимость
				
				// return $this->once_product
				$this->max_rate = $this->once_product[0]["prise"];
				
			}
			
			// Минимальный шаг цены
			$min_step = $this->once_product[0]["min_step"];
			// Минимальная ставка которую может поставить пользователь
			$this->min_rate = $this->max_rate + $min_step; 
		    
			// Красивое число
			number_format(10000, 0, '', ' ');
		}
		
		
		
	}
	
	// Цена последней ставки / Если ее нет то стартовая цена
	function max_rate(){
		
		$all_rate_prace = [];
		
		foreach($this->history_rate as $key => $arr_prace) {
			
			// Формируем новый массив только со ставками
			if($arr_prace['rate']) {
				
				$all_rate_prace[] = (int) $arr_prace['rate'];

			}
			
		}
		
		// Получаем максимальное значение
		$max_rate = max($all_rate_prace);

		return $max_rate;
			
	}
	
	
	/*
	// Внутренний шаблон.
	function get_inside(){
		
		$this->name_file = 'v/v_index.php';
		$this->content = $this->view_include($this->name_file, array('all_category' => $this->all_category, 'all_product' => $this->all_product));
		
	}
	
	*/
	
	
	// Внутренний шаблон.
	function get_inside() {
		
		$this->name_file = 'v/v_lot.php';
		$this->content = $this->view_include($this->name_file, array('once_product' => $this->how_much_time, 'once_category' => $this->once_category, 'history_rate' => $this->history_rate, 'min_rate' => $this->min_rate, 'max_rate' => $this->max_rate));
		
	}
	
	
	
}


?>