<!DOCTYPE html>
<html>
<?php
  include 'header.php'; ?>
<body>
<?php include 'title.php'; ?>
	<div class="dragbar-container">
		<div class="dragbar-container__left">
  		<table id="unit_table">
				<tr>
		      <th>Ma</th>
		      <th>Ten[<?php echo count($resource->units); ?>]</th>
					<th>Ap dung</th>
		      <th>An/hien</th>
					<th>Tao ngay</th>
					<th>Sua ngay</th>
		    </tr>
				<?php
		 		foreach( $resource->units as $unit){ ?>
	      <tr data-id="<?php echo $unit['id']; ?>" data-name="<?php echo $unit['name']; ?>" data-description="<?php echo $unit['description']; ?>" data-available="<?php echo $unit['available']; ?>" data-type="<?php echo $unit['type']; ?>">
					<td class="text-align--center font-size--normal"><?php echo $unit['id'];?></td>
	        <td class="display--flex flex-wrap--nowrap width--full flex-direction--row">
	          <div><strong class="color--blue"><?php echo $unit['name'];?></strong><?php
            if(isset($unit['description']) && strlen($unit['description'])>0){ ?>
              <br/><font size="1em"><?php echo $unit['description']; ?></font>
            <?php } ?>
						</div>
	        </td>
					<td class="white-space--nowrap text-align--right"><span class="rounded background-color--yellow padding"><?php echo $unit['type']=='P' ? 'San pham' : 'Nguyen lieu';?></span></td>
	        <td class="text-align--center"><span class="circle background-color--<?php echo $unit['available']==0 ? 'red':'green';?>"></td>
					<td>
						<div class="rounded background-color--blue padding"><?php echo $unit['creator'];?><br/><?php echo $unit['created_date']; ?></div>
	        </td>
					<td>
						<div class="rounded background-color--blue padding"><?php echo $unit['updater'];?><br/><?php echo $unit['last_updated_date']; ?></div>
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
  		<form id="unit_form" class="padding background-color--lightgray border--gray rounded" action="index.php?pageId=unit" method="POST" enctype="multipart/form-data">
  	    <!--label for="name">Ma don vi</label-->
  	    <input type="hidden" name="id" placeholder="Ma don vi" readonly>

  	    <label for="name" class="display--block margin">Ten don vi</label>
  	    <input type="text" name="name" class="rounded border--gray" placeholder="Ten don vi" required>

  			<label for="description" class="display--block margin">Mo ta</label>
  	    <textarea name="description" class="rounded border--gray width--full resize--vertical" placeholder="Mo ta ve don vi"></textarea>

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
<script type="text/javascript" src="js/unit_script.js"></script>
</html>
