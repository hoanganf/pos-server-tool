<!DOCTYPE html>
<html>
<?php
  include 'header.php'; ?>
<body>
<?php include 'title.php'; ?>
	<div class="dragbar-container">
		<div class="dragbar-container__left">
  		<div class="scroll-menu">
        <!-- for all -->
        <a class="hover--gray active" data-id="-1" href="#" onclick="loadIngredients(-1);return false;">Tat ca</a>
      <?php
			foreach( $resource->categories as $category){ ?>
				<a class="hover--gray" data-id="<?php echo $category['id']; ?>" href="#" onclick="loadIngredients(<?php echo $category['id'] ?>);return false;"><?php echo $category['name']; ?></a>
    <?php }?>
      </div>
  		<table>
        <tr>
          <th>Ma</th>
          <th class="text-align--center">Anh</th>
          <th>Ten[<?php echo count($resource->products); ?>]</th>
          <th class="text-align--center">Gia tham khao</th>
          <th class="text-align--center">Tao ngay</th>
					<th class="text-align--center">Sua ngay</th>
        </tr>
        <?php
	      foreach($resource->ingredients as $ingredient){ ?>
        <tr data-id="<?php echo $ingredient['id']; ?>" data-name="<?php echo $ingredient['name']; ?>" data-category-id="<?php echo $ingredient['category_id']; ?>" data-unit-id="<?php echo $ingredient['unit_id']; ?>"
          data-reference-price="<?php echo $ingredient['reference_price']; ?>" data-description="<?php echo $ingredient['description']; ?>" data-image="<?php echo $ingredient['image']; ?>">
          <td class="text-align--center font-size--normal"><?php echo $ingredient['id'];?></td>
          <td class="text-align--center"><img width="64px" height="64px" src="../pos-upload/<?php echo !empty($ingredient['image']) ? $ingredient['image'] : "files/pos/ic_no_image.png";  ?>"/></td>
          <td class="display--flex flex-wrap--nowrap width--full flex-direction--row">
            <div><strong class="color--blue"><?php echo $ingredient['name'];?></strong><?php
            if(isset($ingredient['description']) && strlen($ingredient['description'])>0){ ?>
              <br/><font size="1em"><?php echo $ingredient['description']; ?></font>
            <?php } ?>
            </div>
          </td>
          <td class="white-space--nowrap text-align--right"><span class="rounded background-color--yellow padding"><?php echo number_format($ingredient['reference_price']);?></span></td>
          <td>
						<div class="rounded background-color--blue padding"><?php echo $ingredient['creator'];?><br/><?php echo $ingredient['created_date']; ?></div>
	        </td>
					<td>
						<div class="rounded background-color--blue padding"><?php echo $ingredient['updater'];?><br/><?php echo $ingredient['last_updated_date']; ?></div>
	        </td>
        </tr>
		<?php } ?>
  		</table>
  	</div>
		<div class="dragbar-container__dragbar"></div>
  	<div class="dragbar-container__right">
      <?php
      if(!empty($resource->errorMessage)){ ?>
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
  		<form id="form" class="row-divide padding background-color--lightgray border--gray rounded" action="index.php?pageId=ingredient" method="POST" enctype="multipart/form-data">
  			<div class="row-divide__col-50">
  	    <!--label for="name">Ma san pham</label-->
  	    <input type="hidden" name="id" placeholder="Ma nguyen lieu" readonly>

  	    <label for="name" class="display--block margin">Ten nguyen lieu</label>
  	    <input type="text" name="name" class="rounded border--gray" placeholder="Ten san pham" required>

        <label for="reference_price" class="display--block white-space--nowrap margin">Gia tham khao</label>
        <input type="text" name="reference_price" class="rounded border--gray" placeholder="Gia tham khao" required>

  			<label for="description" class="display--block margin">Mo ta</label>
  	    <textarea name="description" class="rounded border--gray width--full resize--vertical" placeholder="Mo ta ve san pham"></textarea>

        </div>
    		<div class="row-divide__col-50 padding--left-20">
          <div class="row-divide">
            <div class="row-divide__col-50">
              <label for="category" class="display--block margin">Danh muc</label>
        			<select name="category_id" required>
              <?php foreach( $resource->categories as $category){ ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
              <?php } ?>
        			</select>
            </div>
            <div class="row-divide__col-50">
              <label for="unit" class="display--block margin">Don vi</label>
        			<select name="unit_id" required>
              <?php foreach( $resource->units as $unit){ ?>
                <option value="<?php echo $unit['id']; ?>"><?php echo $unit['name']; ?></option>
              <?php } ?>
        			</select>
            </div>
          </div>
          <div class="display--block margin">
            <label for="imageToUpload" class="display--inline-block" id="label_image">Hinh anh</label><div class="loader color--blue display--inline-block"></div>
          </div>
    			<div class="padding display--inline-block">
    				<img class="width--full height--auto border--gray rounded" name="image_displayer" src="../pos-upload/files/pos/ic_no_image.png"/>
    		    <input type="file" data-folder="pos/ingredient" name="image_uploader" placeholder="Anh" onChange="uploadImageChange(this)" accept=".jpg, .jpeg, .png, .gif"/>
    				<input type="hidden" name="image" value=""/>
    			</div>

    		</div>
        <div class="row-divide width--full margin--top sticky--bottom">
          <button id="btn_edit" name="action" value="edit" class="row-divide__col-50 hover--blue rounded padding">Sua</button>
          <button id="btn_add" name="action" value="add" class="row-divide__col-50 hover--green rounded padding">Them</button>
        </div>
    	</form>
  	</div>
  </div>
</body>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="<?php echo constant('LIB_DIR'); ?>js/jquery.formChangeDetector.js"></script>
<script type="text/javascript" src="js/ingredient_script.js"></script>
</html>
