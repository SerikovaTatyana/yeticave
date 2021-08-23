<?php 

include_once('c/C_Base.php');

class C_Personal_Area extends C_Base {
	
	public $error = "";
	
	
	// Контент страницы
	function Content_page(){
		
		
	}
	
  
	
	// Внутренний шаблон.
	function get_inside() {
		
		$this->name_file = 'v/v_personal_area.php';
		$this->content = $this->view_include($this->name_file, array('error' => $this->error));
		
	}
	
	
}



?>