<form class="form container" action="index.php?c=registration" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
	
	<?php if($error):?>
	    
		<b style="color:red"><?php echo $error; ?></b><br>
		
	<?php endif; ?>
	
	
    <div class="form__item"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" required>
      <span class="form__error"></span>
    </div>
    <div class="form__item">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" required>
      <span class="form__error"></span>
    </div>
    <div class="form__item">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="name" placeholder="Введите имя" required>
      <span class="form__error"></span>
    </div>
    <div class="form__item">
      <label for="message">Контактные данные*</label>
      <textarea id="message" name="message" placeholder="Напишите как с вами связаться" required></textarea>
      <span class="form__error"></span>
    </div>
    <div class="form__item form__item--file form__item--last">
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="../img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" value="" name="avatar">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
  </form>