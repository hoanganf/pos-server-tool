<!DOCTYPE html>
<html>
<?php
  include 'header.php'; ?>
<body>
<?php include 'title.php'; ?>
	<div class="dragbar-container">
		<div class="dragbar-container__left">
  		<div id="product_category" class="scroll-menu">
        <!-- for all -->
        <a class="hover--gray active" data-id="-1" href="#" onclick="loadProducts(-1);return false;">Tat ca</a>
      <?php
			foreach( $resource->productCategories as $category){ ?>
				<a class="hover--gray" data-id="<?php echo $category['id']; ?>" href="#" onclick="loadProducts(<?php echo $category['id'] ?>);return false;"><?php echo $category['name']; ?></a>
    <?php }?>
      </div>
  		<table>
        <tr>
          <th>Ma</th>
          <th class="text-align--center">Anh</th>
          <th class="width-full">Ten[<?php echo count($resource->products); ?>]</th>
        </tr>
        <?php
	      foreach($resource->products as $product){ ?>
        <tr data-id="<?php echo $product['id']; ?>" data-name="<?php echo $product['name']; ?>" data-ingredients='<?php echo json_encode($product['ingredients']);?>'>
          <td class="text-align--center font-size--normal"><?php echo $product['id'];?></td>
          <td class="text-align--center"><img width="64px" height="64px" src="../pos-upload/<?php echo !empty($product['image']) ? $product['image'] : "files/pos/ic_no_image.png";  ?>"/></td>
          <td valign="top" class="width--full">
            <div><strong class="color--blue"><?php echo $product['name'];?></strong><?php
            if(isset($product['ingredients']) && !empty($product['ingredients'])>0){ ?>
              <br/><font size="1em"><?php foreach($product['ingredients'] as $ingredient){
                echo $ingredient['name'].': '.$ingredient['count'].' '.$ingredient['unit_name'].'<br/>';
                }?>
              </font>
            <?php } ?>
            </div>
          </td>
        </tr>
		<?php } ?>
  		</table>
  	</div>
		<div class="dragbar-container__dragbar"></div>
  	<div class="dragbar-container__right">
      <div id="ingredient_category" class="scroll-menu margin--bottom">
        <!-- for all -->
        <a class="hover--gray active" data-id="-1" href="#" onclick="loadIngredients(-1);return false;">Tat ca</a>
      <?php
			foreach( $resource->ingredientCategories as $category){ ?>
				<a class="hover--gray" data-id="<?php echo $category['id']; ?>" href="#" onclick="loadIngredients(<?php echo $category['id'] ?>);return false;"><?php echo $category['name']; ?></a>
      <?php }?>
      </div>
      <div class="dragbar-container__right__bottom">
        <div id="ingredient_list" class="grid-container margin--bottom">
        <?php
        foreach($resource->ingredients as $ingredient){?>
          <div id="ingredient_<?php echo $ingredient['id']; ?>" onclick="onIngredientClick(<?php echo $ingredient['id']; ?>,'<?php echo $ingredient['name']; ?>','<?php echo $ingredient['unit_name']; ?>');return false;" class="hover--green"><?php echo $ingredient['name']; ?></div>
        <?php } ?>
        </div>
        <hr>
        <div id="message">
          <?php if(!empty($resource->errorMessage)){ ?>
          <div class="alert background-color--red rounded">
             <span class="alert__closebtn" onclick="onNotifiClose(this)">&times;</span>
             <strong>Loi!</strong> <?php echo $resource->errorMessage; ?>
          </div>
          <?php } else if(!empty($resource->message)){ ?>
          <div class="alert background-color--green rounded">
             <span class="alert__closebtn" onclick="onNotifiClose(this)">&times;</span>
             <?php echo $resource->message;?>
          </div>
          <?php }?>
        </div>
    		<div class="padding background-color--lightgray border--gray rounded" action="index.php?pageId=productIngredient" method="POST">
          <input type="hidden" name="id" placeholder="Ma san pham" readonly>
    	    <h2 for="name" name="name" class="display--block margin">Ten san pham</h2>
          <div id="choosed_ingredients"></div>
      	</div>
        <button id="btn_edit" class="margin--top width--full hover--green rounded padding sticky--bottom">Sua</button>
      </div>
  	</div>
  </div>
</body>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="js/product_ingredient_script.js"></script>
</html>
