<form class="form container" action="index.php?c=authorization" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Вход в аккаунт</h2>
	
	<?php if($error):?>
	    
		<b style="color:red"><?php echo $error; ?></b><br>
		
	<?php endif; ?>
	
	
    
    <div class="form__item">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="name" placeholder="Введите имя" required>
      <span class="form__error"></span>
    </div>
	
	<div class="form__item">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" required>
      <span class="form__error"></span>
    </div>
	
    
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Отправить</button>

  </form>