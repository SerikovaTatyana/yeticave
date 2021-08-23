<div class="lot-item container">
	
	<section class="lots">
		<div class="lots__header">
		  <h2>Открытые лоты</h2>
		  <select class="lots__select">
		  
			<?php foreach($all_category as $key => $value): ?>
				
				<option value="<?php echo $value["id_category"]; ?>"><?php echo $value["name_category"]; ?></option>
			
			<?php endforeach; ?>
		  
		  </select>
		</div>
		<ul class="lots__list">
		
		  
			<?php foreach($product_once_category as $key => $value): ?>
			
			
			   
			
			
				<li class="lots__item lot">
					<div class="lot__image">
					  <img src="./<?php echo $value["img"]; ?>" width="350" height="260" alt="Маска">
					</div>
					<div class="lot__info">
						<span class="lot__category">

							<?php foreach($all_category as $key_category => $value_category): ?>
							   
								<?php if($value_category["id_category"] == $value["category"]): ?>
									<?php echo $value_category["name_category"]; ?>
								<?php endif; ?>
							
							<?php endforeach; ?>
					  
						</span>
						
						
						
					  <h3 class="lot__title"><a class="text-link" href="index.php?c=lot&id=<?php echo $value["id_product"]; ?>"><?php echo $value["name"]; ?></a></h3>
					  <div class="lot__state">
						<div class="lot__rate">
						  <span class="lot__amount">Стартовая цена</span>
						  <span class="lot__cost"><?php echo number_format($value["prise"], 0, '', ' '); ?><b class="kz">m</b></span>
						</div>
						
						
						<div class="lot__timer timer 
						
							<?php if($value['timer_finishing']): ?>
								timer--finishing
							<?php endif; ?>
						
						">
							<!-- 07:13:34 -->
							<?php //var_dump($value['countdown']->h = 0); ?>
							<?php //var_dump(settype($value['countdown']->h, "string")); ?>
							<?php //echo $value['countdown']->h . ":" . $value['countdown']->i . ":" . $value['countdown']->s; ?>
							<?php echo $value['countdown']; ?>
						   
						  
						</div>
					  </div>
					</div>
				 </li>
			
			
			
			<?php endforeach; ?>
			
		  
		</ul>
    </section>	
	
</div>
  