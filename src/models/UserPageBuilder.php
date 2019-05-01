<?php
	//echo 'CashierPageBuilder: '.$_SERVER["PHP_SELF"];
	class UserPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			$adapter=new UserDAO();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				$available=isset($_POST['available']) ? $_POST['available'] : 0;
				if($_POST['action'] === 'add'){
					if(isset($_POST['user_name']) && $_POST['password']===$_POST['confirm_password']){
						$add=$this->createUserArray();
						$add['password']=$_POST['password'];
						$add['available']=1;
						if(!$adapter->checkUserExists($_POST['user_name'])){
							$insertedID=$adapter->create($add,$resource->requester);
							//TODO change the version of table
							if($insertedID>0) $resource->message='Them nhan vien thanh cong voi ma la: '.$_POST['user_name'];
							else $resource->errorMessage='Them nhan vien that bai.';
						}else{
							$resource->errorMessage='Ten dang nhap da ton tai.';
						}
					}else{
						$resource->errorMessage='Xin vui long nhap ma truy cap';
					}
				}else{
					//do edit here
					$updateStatus=false;
					if(isset($_POST['user_name'])){
						$edit=$this->createUserArray();
						$edit['user_name']=$_POST['user_name'];
						if($_POST['password']===$_POST['confirm_password']){
							$edit['password']=$_POST['password'];
						}
						$updateStatus=$adapter->edit($edit,$resource->requester);
						//TODO change the version of table
					}
					if($updateStatus) $resource->message='Sua nhan vien thanh cong voi ma la: '.$_POST['user_name'];
					else $resource->errorMessage='Sua nhan vien that bai';
				}
			}
			$resource->users=$adapter->getAll();
			include constant('VIEW_DIR').'page_user.php';
		}
		public function createUserArray(){
			if(!empty($_POST)){
				$available=isset($_POST['available']) ? $_POST['available'] : 0;
				return array('user_name'=>$_POST['user_name'],'name'=>$_POST['name'],'role'=>$_POST['role'],'salary_type'=>$_POST['salary_type'],'available'=>$available) ;
			}
		}
	}
?>
