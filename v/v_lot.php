<?php  



//var_dump($once_product);
//var_dump($once_category);


?>

<section class="lot-item container">

    <?php foreach($once_product as $product): ?>
	
		<h2><?php echo $product['name'] ?></h2>
	   



	   <div class="lot-item__content">
		  <div class="lot-item__left">
			<div class="lot-item__image">
			  <img src="./<?php echo $product["img"]; ?>" alt="Сноуборд" width="730" height="548">
			</div>
			<p class="lot-item__category">Категория: <span><?php echo $once_category[0]["name_category"]; ?></span></p>
			<p class="lot-item__description"><?php echo $product["description"]; ?></p>
		  </div>
		  <div class="lot-item__right">
			<div class="lot-item__state">
			  <div class="lot-item__timer timer">
				<?php echo $product["countdown"]; ?>
				
			  </div>
			  
			  <div class="lot-item__cost-state">
				<div class="lot-item__rate">
				  <span class="lot-item__amount">Текущая цена</span>
				  <span class="lot-item__cost"><?php echo number_format($max_rate, 0, '', ' '); ?></span>
				</div>
				<div class="lot-item__min-cost">
				  Мин. ставка <span><?php echo $min_rate; ?> т</span>
				 
				</div>
			  </div>
			  
			  <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post">

				<?php if(!empty($_SESSION['login']) && !empty($_SESSION['id'])): ?>

				    <p class="lot-item__form-item">
					    <label for="cost">Ваша ставка</label>
					    <input id="cost" type="number" name="cost" placeholder="<?php echo $min_rate; ?>" step="<?php  echo $product["min_step"]; ?>" min="<?php echo $min_rate; ?>">
					</p>
				
					<button type="submit" class="button">Сделать ставку</button>
				<?php endif; ?>
				
			  </form>
			</div>
			<!--
			<div class="history">
			  <h3>История ставок (<span>10</span>)</h3>
			  <table class="history__list">
				<tbody><tr class="history__item">
				  <td class="history__name">Иван</td>
				  <td class="history__price">10 999 р</td>
				  <td class="history__time">5 минут назад</td>
				</tr>
				<tr class="history__item">
				  <td class="history__name">Константин</td>
				  <td class="history__price">10 999 р</td>
				  <td class="history__time">20 минут назад</td>
				</tr>
				<tr class="history__item">
				  <td class="history__name">Евгений</td>
				  <td class="history__price">10 999 р</td>
				  <td class="history__time">Час назад</td>
				</tr>
				<tr class="history__item">
				  <td class="history__name">Игорь</td>
				  <td class="history__price">10 999 р</td>
				  <td class="history__time">19.03.17 в 08:21</td>
				</tr>
				<tr class="history__item">
				  <td class="history__name">Енакентий</td>
				  <td class="history__price">10 999 р</td>
				  <td class="history__time">19.03.17 в 13:20</td>
				</tr>
				<tr class="history__item">
				  <td class="history__name">Семён</td>
				  <td class="history__price">10 999 р</td>
				  <td class="history__time">19.03.17 в 12:20</td>
				</tr>
				<tr class="history__item">
				  <td class="history__name">Илья</td>
				  <td class="history__price">10 999 р</td>
				  <td class="history__time">19.03.17 в 10:20</td>
				</tr>
				<tr class="history__item">
				  <td class="history__name">Енакентий</td>
				  <td class="history__price">10 999 р</td>
				  <td class="history__time">19.03.17 в 13:20</td>
				</tr>
				<tr class="history__item">
				  <td class="history__name">Семён</td>
				  <td class="history__price">10 999 р</td>
				  <td class="history__time">19.03.17 в 12:20</td>
				</tr>
				<tr class="history__item">
				  <td class="history__name">Илья</td>
				  <td class="history__price">10 999 р</td>
				  <td class="history__time">19.03.17 в 10:20</td>
				</tr>
			  </tbody></table>
			</div>
			-->
			<?php 
                /*
				echo '<pre>';
                var_dump($history_rate);
                echo '</pre>';
                */
			?>
			
			
			<div class="history">
			  <h3>История ставок (<span><?php echo count($history_rate); ?></span>)</h3>
			  <table class="history__list">
				<tbody>
				    
					<?php foreach($history_rate as $key => $value): ?>
				
						<tr class="history__item">
						  <td class="history__name"><?php echo $value["name"]; ?></td>
						  <td class="history__price"><?php echo number_format($value["rate"], 0, '', ' '); ?></td>
						  <td class="history__time"><?php echo $value["time_beautiful"]; ?></td>
						</tr>
				
				    <?php endforeach; ?>
				
			  </tbody></table>
			</div>
			
			
			
			
		  </div>
		</div>
	
	<?php endforeach; ?>
	
  </section>