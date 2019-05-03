<?php
	//echo 'CashierPageBuilder: '.$_SERVER["PHP_SELF"];
	class RestaurantPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			$restaurantDAO=new RestaurantDAO();
			$productDAO=new ProductDAO();
			//$ingredientDAO=new IngredientDAO();
			$restaurantProductDAO=new RestaurantProductDAO();
			//$restaurantIngredientDAO=new RestaurantIngredientDAO();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		    $available=isset($_POST['available']) ? $_POST['available'] : 0;
				if($_POST['action'] === 'add'){
					if($_POST['access_key']===$_POST['confirm_access_key']){
						$add=$this->createRestaurantArray();
						$add['access_key']=$_POST['access_key'];
						//begin tracsaction
						$restaurantDAO->connect();
						$restaurantDAO->setAutoCommit(FALSE);
						$insertedID=$restaurantDAO->create($add,$resource->requester);
						$hasProduct=false;
						$hasIngredient=false;
						//TODO add list product to restaurant_product
						if($insertedID>0){
							//add product
							$products=$productDAO->getAll();
							if(!empty($products)){
								$hasProduct=TRUE;
								$restaurantProductDAO->connect();
								$restaurantProductDAO->setAutoCommit(FALSE);
								foreach ($products as $product) {
									if(!$restaurantProductDAO->create($insertedID,$product,$resource->requester)){
										$insertedID=-1;
										break;
									}
								}
							}
							//add ingredient
							/*if($insertedID>0){
								$ingredients=$ingredientDAO->getAll();
								if(!empty($ingredients)){
									$hasIngredient=TRUE;
									$restaurantIngredientDAO->connect();
									$restaurantIngredientDAO->setAutoCommit(FALSE);
									foreach ($ingredients as $ingredient) {
										if(!$restaurantIngredientDAO->create($insertedID,$ingredient,$resource->requester)){
											$insertedID=-1;
											break;
										}
									}
								}
							}*/
						}
						//TODO change the version of table
						if($insertedID>0){
							if($hasProduct){
								$restaurantProductDAO->commit();
								$restaurantProductDAO->close();
							}
							/*if($hasIngredient){
								$restaurantIngredientDAO->commit();
								$restaurantIngredientDAO->close();
							}*/
							$restaurantDAO->commit();
							$restaurantDAO->close();
							$resource->message='Them nha hang thanh cong voi ma la: '.$insertedID;
						}else{
							if($hasProduct){
								$restaurantProductDAO->rollBack();
								$restaurantProductDAO->close();
							}
							/*if($hasIngredient){
								$restaurantIngredientDAO->rollBack();
								$restaurantIngredientDAO->close();
							}*/
							$restaurantDAO->rollBack();
							$restaurantDAO->close();
							$resource->errorMessage='Them nha hang that bai';
						}
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
						$updateStatus=$restaurantDAO->edit($edit,$resource->requester);
						//TODO change the version of table
					}
					if($updateStatus) $resource->message='Sua nha hang thanh cong voi ma la: '.$_POST['id'];
					else $resource->errorMessage='Sua nha hang that bai';
				}
			}
			$resource->restaurants=$restaurantDAO->getAll();
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
