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
		      <th>Ten[<?php echo count($resource->units); ?>]</th>
					<th class="text-align--center">Tao ngay</th>
					<th class="text-align--center">Sua ngay</th>
		    </tr>
				<?php
		 		foreach( $resource->comments as $comment){ ?>
	      <tr data-id="<?php echo $comment['id']; ?>" data-name="<?php echo $comment['name']; ?>" data-description="<?php echo $comment['description']; ?>">
					<td class="text-align--center font-size--normal"><?php echo $comment['id'];?></td>
	        <td valign="top">
	          <div><strong class="color--blue"><?php echo $comment['name'];?></strong><?php
            if(isset($comment['description']) && strlen($comment['description'])>0){ ?>
              <br/><font size="1em"><?php echo $comment['description']; ?></font>
            <?php } ?>
						</div>
	        </td>
					<td>
						<div class="rounded background-color--blue padding"><?php echo $comment['creator'];?><br/><?php echo $comment['created_date']; ?></div>
	        </td>
					<td>
						<div class="rounded background-color--blue padding"><?php echo $comment['updater'];?><br/><?php echo $comment['last_updated_date']; ?></div>
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
  		<form class="padding background-color--lightgray border--gray rounded" action="index.php?pageId=comment" method="POST">
  	    <input type="hidden" name="id" readonly>

  	    <label for="name" class="display--block margin">Ten ghi chu</label>
  	    <input type="text" name="name" class="rounded border--gray" placeholder="Ten don vi" required>

  			<label for="description" class="display--block margin">Mo ta</label>
  	    <textarea name="description" class="rounded border--gray width--full resize--vertical" placeholder="Mo ta ve ghi chu"></textarea>

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
<script type="text/javascript" src="js/comment_script.js"></script>
</html>
