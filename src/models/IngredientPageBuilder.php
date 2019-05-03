<?php
	//echo 'CashierPageBuilder: '.$_SERVER["PHP_SELF"];
	class IngredientPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			$ingredientDAO=new IngredientDAO();
			//$restaurantDAO=new RestaurantDAO();
			//$restaurantIngredientDAO=new RestaurantIngredientDAO();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if($_POST['action'] === 'add'){
					$add=$this->createIngredientArray();
					$insertedID=$ingredientDAO->create($add,$resource->requester);
					/*// BEGIN TRANSACTION
					$ingredientDAO->connect();
					// set autocommit to off
					$ingredientDAO->setAutoCommit(FALSE);
					$add=$this->createIngredientArray();
					$insertedID=$ingredientDAO->create($add,$resource->requester);
					$isHasRestaurant=false;
					if($insertedID>0){
						//have to transaction
						$restaurantIds=array();
						if(isset($_POST['checked_restaurant_ids'])){
							$restaurantIds=$_POST['checked_restaurant_ids'];
						}
						$restaurants=$restaurantDAO->getAll();
						if(!empty($restaurants)){
							$isHasRestaurant=true;
							$add['id']=$insertedID;
							$restaurantIngredientDAO->connect();
							// set autocommit to off
							$restaurantIngredientDAO->setAutoCommit(FALSE);
							foreach ($restaurants as $restaurant) {
								$add['available']=in_array($restaurant['id'],$restaurantIds)? 1 : 0;
								if(!$restaurantIngredientDAO->create($restaurant['id'],$add,$resource->requester)){
									$insertedID=-1;
									break;
								}
							}
						}
					}*/
					//result
					//TODO change the version of table
					if ($insertedID<1) {
						/*if($isHasRestaurant){
							$this->rollBack($restaurantIngredientDAO);
						}
						$this->rollBack($ingredientDAO);*/
						$resource->errorMessage='Them nguyen lieu that bai.';
					}else{
					/*	if($isHasRestaurant){
							$restaurantIngredientDAO->commit();
							$restaurantIngredientDAO->close();
						}
						$ingredientDAO->commit();
						$ingredientDAO->close();
						*/
						$resource->message='Them nguyen lieu thanh cong voi ma la: '.$insertedID;
					}
				}else{
					//do edit here
					$updateStatus=false;
					if(isset($_POST['id']) && is_numeric($_POST['id'])){
						$edit=$this->createIngredientArray();
						$edit['id']=$_POST['id'];
						$updateStatus=$ingredientDAO->edit($edit,$resource->requester);
						/*// BEGIN TRANSACTION
						$ingredientDAO->connect();
						// set autocommit to off
						$ingredientDAO->setAutoCommit(FALSE);
						$updateStatus=$ingredientDAO->edit($edit,$resource->requester);

						$isHasRestaurant=false;
						if($updateStatus){
							//have to transaction
							$restaurantIds=array();
							if(isset($_POST['checked_restaurant_ids'])){
								$restaurantIds=$_POST['checked_restaurant_ids'];
							}
							$restaurants=$restaurantDAO->getAll();
							if(!empty($restaurants)){
								$isHasRestaurant=true;
								$restaurantIngredientDAO->connect();
								// set autocommit to off
								$restaurantIngredientDAO->setAutoCommit(FALSE);
								foreach ($restaurants as $restaurant) {
									$edit['available']=in_array($restaurant['id'],$restaurantIds)? 1 : 0;
									$restaurantIngredientEditStatus=false;
									if($edit['available']===1){
										$restaurantIngredientEditStatus=$restaurantIngredientDAO->edit($restaurant['id'],$edit,$resource->requester);
									}else{
										$restaurantIngredientEditStatus=$restaurantIngredientDAO->editOnlyAvailable($restaurant['id'],$edit,$resource->requester);
									}
									if(!$restaurantIngredientEditStatus){
										$updateStatus=false;
										break;
									}
								}
							}
						}*/
					}
					//result
					//TODO change the version of table
					if (!$updateStatus) {
						/*if($isHasRestaurant){
							$this->rollBack($restaurantIngredientDAO);
						}
						$this->rollBack($ingredientDAO);*/
						$resource->errorMessage='Sua nguyen lieu that bai.';
					}else{
						/*if($isHasRestaurant){
							$restaurantIngredientDAO->commit();
							$restaurantIngredientDAO->close();
						}
						$ingredientDAO->commit();
						$ingredientDAO->close();*/
						$resource->message='Sua nguyen lieu thanh cong voi ma la: '.$_POST['id'];
					}
				}
			}
			//$adapter=new RestaurantDAO();
			//$resource->restaurants=$adapter->getAllAvailableRestaurant();
			$adapter=new CategoryDAO();
			$resource->categories=$adapter->getCategories('I');
			$resource->ingredients=$ingredientDAO->getAll();
			$adapter=new UnitDAO();
			$resource->units=$adapter->getUnits('I');

			include constant('VIEW_DIR').'page_ingredient.php';
		}
	/*	public function rollBack($dao){
			// Rollback transaction\n
			$dao->rollBack();
			// close connection 
			$dao->close();
		}*/
		public function createIngredientArray(){
			if(!empty($_POST)){
				return array('name'=>$_POST['name'],'category_id'=>$_POST['category_id'],'unit_id'=>$_POST['unit_id'],'description'=>$_POST['description'],'image'=>$_POST['image'],'reference_price'=>$_POST['reference_price']) ;
			}
		}

	}
?>
