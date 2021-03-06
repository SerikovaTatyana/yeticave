  <form class="form form--add-lot container" action="/mysite/yeti_cave/index.php?c=add_lot" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" required>
        <span class="form__error"></span>
      </div>
      <div class="form__item">
        <label for="category">Категория</label>
  
		
		<select id="category" name="category" required>
		
		    <?php foreach($all_category as $kay => $value): ?>

		        <option value="<?php echo $value["id_category"]; ?>"><?php echo $value["name_category"]; ?></option>
		  
		    <?php endforeach; ?>
		  
        </select>
        
		<span class="form__error"></span>
      </div>
    </div>
    <div class="form__item form__item--wide">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" required></textarea>
      <span class="form__error"></span>
    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="../img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" value="" name="lot_photo">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" placeholder="0" required>
        <span class="form__error"></span>
      </div>
      <div class="form__item form__item--small">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" required>
        <span class="form__error"></span>
      </div>
      <div class="form__item">
        <label for="lot-date">Дата заверщения</label>
        <!-- <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017" required> -->
        <input class="form__input-date" id="lot-date" type="datetime-local" name="lot-date" placeholder="2020-06-30 09:20:00" required>
        <span class="form__error"></span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>