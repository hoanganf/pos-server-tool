<!DOCTYPE html>
<html>
<?php
  include 'header.php'; ?>
<body>
<?php include 'title.php'; ?>
	<div class="dragbar-container">
		<div class="dragbar-container__left">
  		<table>
				<tr>
		      <th>Ma</th>
					<th class="text-align--center">Anh</th>
		      <th>Ten[<?php echo count($resource->restaurants); ?>]</th>
          <th class="text-align--center">So DT</th>
          <th class="text-align--center">Dia chi</th>
		      <th class="text-align--center">An/hien</th>
					<th class="text-align--center">Tao ngay</th>
					<th class="text-align--center">Sua ngay</th>
		    </tr>
				<?php
		 		foreach( $resource->restaurants as $restaurant){ ?>
	      <tr data-id="<?php echo $restaurant['id']; ?>" data-name="<?php echo $restaurant['name']; ?>" data-available="<?php echo $restaurant['available']; ?>" data-image="<?php echo $restaurant['image']; ?>"
          data-phone="<?php echo $restaurant['phone']; ?>" data-address="<?php echo $restaurant['address']; ?>" data-description="<?php echo $restaurant['description']; ?>" data-access-key="<?php echo $restaurant['access_key']; ?>">
					<td class="text-align--center font-size--normal"><?php echo $restaurant['id'];?></td>
          <td class="text-align--center"><img width="64px" height="64px" src="../pos-upload/<?php echo !empty($restaurant['image']) ? $restaurant['image'] : "files/pos/ic_no_image.png";  ?>"/></td>
	        <td class="display--flex flex-wrap--nowrap width--full flex-direction--row">
	          <div><strong class="color--blue"><?php echo $restaurant['name'];?></strong><?php
            if(isset($restaurant['description']) && strlen($restaurant['description'])>0){ ?>
              <br/><font size="1em"><?php echo $restaurant['description']; ?></font>
            <?php } ?>
						</div>
	        </td>
          <td class="text-align--center font-size--normal"><?php echo $restaurant['phone'];?></td>
          <td class="text-align--center font-size--normal"><?php echo $restaurant['address'];?></td>
	        <td class="text-align--center"><span class="circle background-color--<?php echo $restaurant['available']==0 ? 'red':'green';?>"></td>
					<td>
						<div class="rounded background-color--blue padding"><?php echo $restaurant['creator'];?><br/><?php echo $restaurant['created_date']; ?></div>
	        </td>
					<td>
						<div class="rounded background-color--blue padding"><?php echo $restaurant['updater'];?><br/><?php echo $restaurant['last_updated_date']; ?></div>
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
  		<form class="row-divide padding background-color--lightgray border--gray rounded" action="index.php?pageId=restaurant" method="POST" enctype="multipart/form-data">
  			<div class="row-divide__col-50">
	  	    <!--label for="name">Ma nha hang</label-->
	  	    <input type="hidden" name="id" placeholder="Ma nha hang" readonly>

	  	    <label for="name" class="display--block margin">Ten nha hang</label>
	  	    <input type="text" name="name" class="rounded border--gray" placeholder="Ten nha hang" required>

          <label for="phone" class="display--block margin">So dien thoai</label>
	  	    <input type="text" name="phone" class="rounded border--gray" placeholder="So dien thoai" required>

          <label for="address" class="display--block margin">Dia chi</label>
	  	    <input type="text" name="address" class="rounded border--gray" placeholder="Dia chi" required>

          <label for="access_key" class="display--block margin">Ma truy cap (Khong bat buoc khi sua)</label>
	  	    <input type="password" name="access_key" class="rounded border--gray" placeholder="Ma truy cap">

          <label for="confirm_access_key" class="display--block margin">Xac nhan ma truy cap (Khong bat buoc khi sua)</label>
	  	    <input type="password" name="confirm_access_key" class="rounded border--gray" placeholder="Xac nhan ma truy cap">

	  			<label for="description" class="display--block margin">Mo ta</label>
	  	    <textarea name="description" class="rounded border--gray width--full resize--vertical" placeholder="Mo ta ve nha hang"></textarea>

          <label class="display--block margin white-space--nowrap" for="available">An/Hien</label>
          <label class="toggle-switch">
            <input type="checkbox" name="available" value="1">
            <span class="toggle-switch__slider"></span>
          </label>
        </div>
    		<div class="row-divide__col-50 padding--left-20">
          <div class="display--block margin">
            <label for="imageToUpload" class="display--inline-block" id="label_image">Hinh anh</label><div class="loader color--blue display--inline-block"></div>
          </div>
    			<div class="padding display--inline-block">
    				<img class="width--full height--auto border--gray rounded" name="image_displayer" src="../pos-upload/files/pos/ic_no_image.png"/>
    		    <input type="file" data-folder="pos/restaurant" name="image_uploader" placeholder="Anh" onChange="uploadImageChange(this)" accept=".jpg, .jpeg, .png, .gif"/>
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
<script type="text/javascript" src="js/restaurant_script.js"></script>
</html>
