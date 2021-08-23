<?php 
session_start();


function __autoload($class_name) {
	
	$type = explode('_', $class_name);
	
	switch($type[0]){
		case 'C':
        include_once('c/' . $class_name . '.php');
		break;
		
		case 'M':
		include_once('m/' . $class_name . '.php');
		break;
		
		case 'DB':
		include_once('db/' . $class_name . '.php');
		
	}
	
}

switch(@$_GET['c']){
	
	case 'lot':
	$new_class = new C_Lot;
	break;
	
	case 'registration':
	$new_class = new C_Registration;
	break;
	
	case 'authorization':
	$new_class = new C_Authorization;
	break;
	
	case 'add_lot':
	$new_class = new C_Add_Lot;
	break;
	
	case 'exit':
	$new_class = new C_Exit;
	break;
	
	case 'personal_area':
	$new_class = new C_Personal_Area;
	break;
	
	case 'my_lots':
	$new_class = new C_My_Lots;
	break;


	case 'my_bets':
	$new_class = new C_My_Bets;
	break;
	
	case 'category':
	$new_class = new C_Category;
	break;

	default:
	$new_class = new C_Index;
	
}

/*
$_SESSION['login'] = '';
$_SESSION['id'] = '';
*/


$new_class->Two_view();



// https://ruseller.com/lessons.php?rub=37&id=347





?>