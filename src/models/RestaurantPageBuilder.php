<?php
	//echo 'CashierPageBuilder: '.$_SERVER["PHP_SELF"];
	class RestaurantPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			$adapter=new RestaurantDAO();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		    $available=isset($_POST['available']) ? $_POST['available'] : 0;
				if($_POST['action'] === 'add'){
					if($_POST['access_key']===$_POST['confirm_access_key']){
						$add=$this->createRestaurantArray();
						$add['access_key']=$_POST['access_key'];
						$insertedID=$adapter->create($add,$resource->requester);
						//TODO change the version of table
						if($insertedID>0) $resource->message='Them nha hang thanh cong voi ma la: '.$insertedID;
						else $resource->errorMessage='Them nha hang that bai';
					}else{
						$resource->errorMessage='Xin vui long nhap ma truy cap';
					}
				}else{
					//do edit here
					$updateStatus=false;
					if(isset($_POST['id']) && is_numeric($_POST['id'])){
						$edit=$this->createRestaurantArray();
						$edit['id']=$_POST['id'];
						if($_POST['access_key']===$_POST['confirm_access_key']){
							$edit['access_key']=$_POST['access_key'];
						}
						$updateStatus=$adapter->edit($edit,$resource->requester);
						//TODO change the version of table
					}
					if($updateStatus) $resource->message='Sua nha hang thanh cong voi ma la: '.$_POST['id'];
					else $resource->errorMessage='Sua nha hang that bai';
				}
			}
			$resource->restaurants=$adapter->getAll();
			include constant('VIEW_DIR').'page_restaurant.php';
		}
		public function createRestaurantArray(){
			if(!empty($_POST)){
				$available=isset($_POST['available']) ? $_POST['available'] : 0;
				return array('name'=>$_POST['name'],'description'=>$_POST['description'],'image'=>$_POST['image'],'address'=>$_POST['address'],'phone'=>$_POST['phone'],'available'=>$available) ;
			}
		}
	}
?>
