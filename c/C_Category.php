<?php 

include_once('c/C_Base.php');

class C_Category extends C_Base {
	
	// Все категории
	public $all_category;
	public $product_once_category;
	
	// Все продукты
	public $all_product;
	
	// Расчет времени конца аукцеона
	public $how_much_time;
	
    // Контент страницы
	function Content_page(){

		// Все категории
		$this->all_category = parent::all_category();
		
		$id_category = $_GET['id_category'];
		
		// Одна категория по id
		$once_category = parent::once_category($id_category);

		
		// Продукты одной категории
		$this->product_once_category = self::product_once_category($id_category);
		//var_dump($this->how_much_time);
		
		// Расчет времени конца аукцеона
		$this->how_much_time = parent::how_much_time($this->product_once_category);
		
		//var_dump($this->how_much_time);
		
	}
	
	// Продукты одной категории
	function product_once_category($id_category){
	
		return $this->model->product_once_category($id_category);
		
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
		
		$this->name_file = 'v/v_category.php';
		//$this->content = $this->view_include($this->name_file, array('all_category' => $this->all_category));
		//$this->content = $this->view_include($this->name_file, array('product_once_category' => $this->product_once_category, 'all_category' => $this->all_category, 'all_product' => $this->how_much_time));
		$this->content = $this->view_include($this->name_file, array('all_category' => $this->all_category, 'product_once_category' => $this->how_much_time));
		
	}
	
	
	
}


?>