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
		      <th class="white-space--nowrap">Ten dang nhap[<?php echo count($resource->users); ?>]</th>
					<th class="text-align--center">Ten</th>
          <th class="text-align--center">Quyen truy cap</th>
          <th class="text-align--center">Luong</th>
		      <th class="text-align--center">An/hien</th>
					<th class="text-align--center">Tham gia</th>
					<th class="text-align--center">Nghi</th>
		    </tr>
				<?php
		 		foreach( $resource->users as $user){ ?>
	      <tr data-user-name="<?php echo $user['user_name']; ?>" data-name="<?php echo $user['name']; ?>" data-password="<?php echo $user['password']; ?>"
          data-available="<?php echo $user['available']; ?>" data-role="<?php echo $user['role']; ?>" data-salary-type="<?php echo $user['salary_type']; ?>">
					<td class="text-align--left font-size--normal"><?php echo $user['user_name'];?></td>
	        <td class="text-align--left"><strong class="color--blue"><?php echo $user['name'];?></strong></td>
					<td class="white-space--nowrap text-align--center"><span class="rounded background-color--yellow padding"><?php echo $user['role'];?></span></td>
          <td class="white-space--nowrap text-align--center"><span class="rounded background-color--yellow padding"><?php echo $user['salary_type'] === 'DATE' ? 'Ngay' : 'Gio';?></span></td>
	        <td class="text-align--center"><span class="circle background-color--<?php echo $user['available']==0 ? 'red':'green';?>"></td>
					<td>
						<div class="rounded background-color--blue padding"><?php echo $user['joined_date']; ?></div>
	        </td>
					<td>
            <?php if(isset($user['left_date']) && !empty($user['left_date'])){ ?>
						<div class="rounded background-color--blue padding"><?php echo $user['left_date']; ?></div>
          <?php }?>
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
  		<form class="padding background-color--lightgray border--gray rounded" action="index.php?pageId=user" method="POST" enctype="multipart/form-data">
        <label for="user_name" class="display--block margin">Ten dang nhap</label>
  	    <input type="text" name="user_name" class="rounded border--gray" placeholder="Ten dang nhap" required>

        <label for="password" class="display--block margin">Mat khau (Khong bat buoc khi sua)</label>
  	    <input type="password" name="password" class="rounded border--gray" placeholder="Mat khau">

        <label for="confirm_password" class="display--block margin">Xac nhan mat khau (Khong bat buoc khi sua)</label>
        <input type="password" name="confirm_password" class="rounded border--gray" placeholder="Xac nhan mat khau">

  	    <label for="name" class="display--block margin">Ten nguoi dung</label>
  	    <input type="text" name="name" class="rounded border--gray" placeholder="Ten nguoi dung" required>

				<div class="row-divide">
          <div class="row-divide__col-50">
						<label for="role" class="display--block margin">Quyen truy cap</label>
						<select name="role" required>
							<option value="A">Chu</option>
							<option value="B">Quan ly nha hang</option>
              <option value="C">Nhan vien</option>
						</select>
          </div>
          <div class="row-divide__col-50">
            <label for="salary_type" class="display--block margin">Luong</label>
						<select name="salary_type" required>
							<option value="DATE">Ngay</option>
							<option value="TIME">Gio</option>
						</select>
          </div>
        </div>
        <label class="display--block margin white-space--nowrap" for="available">An/Hien</label>
        <label class="toggle-switch">
          <input type="checkbox" name="available" value="1">
          <span class="toggle-switch__slider"></span>
        </label>
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
<script type="text/javascript" src="js/user_script.js"></script>
</html>
