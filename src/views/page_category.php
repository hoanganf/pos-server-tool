<!DOCTYPE html>
<html>
<?php
  include 'header.php'; ?>
<body>
<?php include 'title.php'; ?>
	<div class="dragbar-container">
		<div class="dragbar-container__left">
  		<table id="category_table">
				<tr>
		      <th>Ma</th>
					<th class="text-align--center">Anh</th>
		      <th>Ten[<?php echo count($resource->categories); ?>]</th>
					<th class="text-align--center">Ap dung</th>
		      <th class="text-align--center">An/hien</th>
					<th class="text-align--center">Tao ngay</th>
					<th class="text-align--center">Sua ngay</th>
		    </tr>
				<?php
		 		foreach( $resource->categories as $category){ ?>
	      <tr data-id="<?php echo $category['id']; ?>" data-name="<?php echo $category['name']; ?>" data-available="<?php echo $category['available']; ?>" data-image="<?php echo $category['image']; ?>"
					data-type="<?php echo $category['type']; ?>">
					<td class="text-align--center font-size--normal"><?php echo $category['id'];?></td>
          <td class="text-align--center"><img width="64px" height="64px" src="../pos-upload/<?php echo !empty($category['image']) ? $category['image'] : "files/pos/ic_no_image.png";  ?>"/></td>
	        <td class="display--flex flex-wrap--nowrap width--full flex-direction--row">
	          <div><strong class="color--blue"><?php echo $category['name'];?></strong><?php
            if(isset($category['description']) && strlen($category['description'])>0){ ?>
              <br/><font size="1em"><?php echo $category['description']; ?></font>
            <?php } ?>
						</div>
	        </td>
					<td class="white-space--nowrap text-align--center"><span class="rounded background-color--yellow padding"><?php echo $category['type']=='P' ? 'San pham' : 'Nguyen lieu';?></span></td>
	        <td class="text-align--center"><span class="circle background-color--<?php echo $category['available']==0 ? 'red':'green';?>"></td>
					<td>
						<div class="rounded background-color--blue padding"><?php echo $category['creator'];?><br/><?php echo $category['created_date']; ?></div>
	        </td>
					<td>
						<div class="rounded background-color--blue padding"><?php echo $category['updater'];?><br/><?php echo $category['last_updated_date']; ?></div>
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
  		<form id="category_form" class="row-divide padding background-color--lightgray border--gray rounded" action="index.php?pageId=category" method="POST" enctype="multipart/form-data">
  			<div class="row-divide__col-50">
	  	    <!--label for="name">Ma danh muc</label-->
	  	    <input type="hidden" name="id" placeholder="Ma danh muc" readonly>

	  	    <label for="name" class="display--block margin">Ten danh muc</label>
	  	    <input type="text" name="name" class="rounded border--gray" placeholder="Ten danh muc" required>

	  			<label for="description" class="display--block margin">Mo ta</label>
	  	    <textarea name="description" class="rounded border--gray width--full resize--vertical" placeholder="Mo ta ve danh muc"></textarea>

					<div class="row-divide">
            <div class="row-divide__col-50">
							<label for="type" class="display--block margin">Ap dung cho</label>
							<select name="type" required>
								<option value="P">San pham</option>
								<option value="I">Nguyen lieu</option>
							</select>
            </div>
            <div class="row-divide__col-50">
							<label class="display--block margin white-space--nowrap" for="available">An/Hien</label>
							<label class="toggle-switch">
								<input type="checkbox" name="available" value="1">
								<span class="toggle-switch__slider"></span>
							</label>
            </div>
          </div>
        </div>
    		<div class="row-divide__col-50 padding--left-20">
          <div class="display--block margin">
            <label for="imageToUpload" class="display--inline-block" id="label_image">Hinh anh</label><div class="loader color--blue display--inline-block"></div>
          </div>
    			<div class="padding display--inline-block">
    				<img class="width--full height--auto border--gray rounded" name="image_displayer" src="../pos-upload/files/pos/ic_no_image.png"/>
    		    <input data-folder="pos/category" type="file" name="image_uploader" placeholder="Anh" onChange="uploadImageChange(this)" accept=".jpg, .jpeg, .png, .gif"/>
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
<script type="text/javascript" src="js/category_script.js"></script>
</html>
