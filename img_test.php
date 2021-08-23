<?php

/*
Оригинальная статья
// http://www.php.su/articles/?cat=graph&page=017
Код к ней с форума
// http://forum.php.su/topic.php?forum=71&topic=5422#

*/


if (!empty($_POST['img001'])) { //проверяем, отправил    ли пользователь изображение
        
		$fupload=$_POST['img001'];    $fupload = trim($fupload);
        
		if ($fupload =='' or empty($fupload)) {
            unset($fupload);// если переменная $fupload пуста, то удаляем ее
            echo "string";
        }
}
	
if (!isset($fupload) or empty($fupload) or $fupload =='') {
    //если переменной не существует (пользователь не отправил    изображение),то присваиваем ему заранее приготовленную картинку
    copy("../assets/img/net-foto.jpg", "../users/$login/waiting_area/img001.jpg");
} else {
    $blacklist = array(".php", ".phtml", ".php3", ".php4");
    
	foreach ($blacklist as $item) {
        
		if(preg_match("/$item\$/i", $_FILES['img001']['name'])) {
            echo "We do not allow uploading PHP files\n";
            exit;
        }
    }
	
if($_FILES['img001']['type'] != "image/gif" && $_FILES['img001']['type'] != "image/jpeg") {
    echo "Sorry, we only accept GIF and JPEG images\n";
    exit;
}

$imageinfo = getimagesize($_FILES['img001']['tmp_name']);

if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg') {
    echo "Sorry, we only accept GIF and JPEG images\n";
    exit;
}
     
    //(*1)   $uploaddir = ("../users/$login/waiting_area/");
    //(*1)   $uploadfile = $uploaddir . basename($_FILES['img001']['name']);
     
     
                                             
    // type - способ масштабирования
    // q - качество сжатия
    // fupload - исходное изображение
    // dest - результирующее изображение
    // w - ширниа изображения
    // ratio - коэффициент пропорциональности
     
    $fupload->save("../users/$login/waiting_area/", 'img011', 'jpg', false, 100);//загрузка оригинала в папку "waiting_area"
     
    // тип преобразования, если не указаны размеры
    if ($type == 0) $w = 70;  // квадратная 70x70
    if ($type == 1) $w = 90;  // квадратная 90x90
    if ($type == 2) $w = 268; // пропорциональная шириной 218
     
     
    // качество jpeg по умолчанию
    if (!isset($q)) $q = 100;
     
		// создаём исходное изображение на основе
		// исходного файла и опеределяем его размеры
		$fupload = imagecreatefromjpeg("001img");
		$w_src = imagesx($fupload);
		$h_src = imagesy($fupload);
		 
		// если размер исходного изображения
		// отличается от требуемого размера
		if ($w_src != $w){
		 
			// операции для получения прямоугольного файла
			if ($type==2){
			// вычисление пропорций
			$ratio = $w_src/$w;
			$w_dest = round($w_src/$ratio);
			$h_dest = round($h_src/$ratio);
			 
			// создаём пустую картинку
			// важно именно truecolor!, иначе будем иметь 8-битный результат
			$dest = imagecreatetruecolor($w_dest,$h_dest);
			imagecopyresized($dest, $fupload, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
			 
			// вывод картинки и очистка памяти
														   
			$dest->save("../users/$login/waiting_area/", 'img001', 'jpg', false, 100);
			imagedestroy($dest);
			imagedestroy($fupload);
			 
			//(*1)   if (move_uploaded_file($_FILES['img001']['tmp_name'], $uploadfile)) {
			//(*1)
			//(*1)     echo "File is valid, and was successfully uploaded.\n";
			//(*1)   } else {
			//(*1)     echo "File uploading failed.\n";
			//(*1)   }
			}
		}
    }
     








?>