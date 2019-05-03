<?php
	//echo 'CashierPageBuilder: '.$_SERVER["PHP_SELF"];
	class ProductIngredientPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			$productDAO=new ProductDAO();
			//$restaurantDAO=new RestaurantDAO();
			//$restaurantProductDAO=new RestaurantProductDAO();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if($_POST['action'] === 'add'){
					/** //BEGIN TRANSACTION
					$productDAO->connect();
					// set autocommit to off
					$productDAO->setAutoCommit(FALSE);
					$add=$this->createProductArray();
					$insertedID=$productDAO->create($add,$resource->requester);
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
							$restaurantProductDAO->connect();
							// set autocommit to off
							$restaurantProductDAO->setAutoCommit(FALSE);
							foreach ($restaurants as $restaurant) {
								$add['available']=in_array($restaurant['id'],$restaurantIds)? 1 : 0;
								if(!$restaurantProductDAO->create($restaurant['id'],$add,$resource->requester)){
									$insertedID=-1;
									break;
								}
							}
						}
					}
					//result
					//TODO change the version of table
					if ($insertedID<1) {
						if($isHasRestaurant){
							$this->rollBack($restaurantProductDAO);
						}
						$this->rollBack($productDAO);
						$resource->errorMessage='Them mon that bai.';
					}else{
						if($isHasRestaurant){
							$restaurantProductDAO->commit();
							$restaurantProductDAO->close();
						}
						$productDAO->commit();
						$productDAO->close();
						$resource->message='Them mon thanh cong voi ma la: '.$insertedID;
					}
				}else{
					//do edit here
					$updateStatus=false;
					if(isset($_POST['id']) && is_numeric($_POST['id'])){
						$editProduct=$this->createProductArray();
						$editProduct['id']=$_POST['id'];
						// BEGIN TRANSACTION
						$productDAO->connect();
						// set autocommit to off
						$productDAO->setAutoCommit(FALSE);
						$updateStatus=$productDAO->edit($editProduct,$resource->requester);

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
								$restaurantProductDAO->connect();
								// set autocommit to off
								$restaurantProductDAO->setAutoCommit(FALSE);
								foreach ($restaurants as $restaurant) {
									$editProduct['available']=in_array($restaurant['id'],$restaurantIds)? 1 : 0;
									$restaurantProductEditStatus=false;
									if($editProduct['available']===1){
										$restaurantProductEditStatus=$restaurantProductDAO->edit($restaurant['id'],$editProduct,$resource->requester);
									}else{
										$restaurantProductEditStatus=$restaurantProductDAO->editOnlyAvailable($restaurant['id'],$editProduct,$resource->requester);
									}
									if(!$restaurantProductEditStatus){
										$updateStatus=false;
										break;
									}
								}
							}
						}
					}
					//result
					//TODO change the version of table
					if (!$updateStatus) {
						if($isHasRestaurant){
							$this->rollBack($restaurantProductDAO);
						}
						$this->rollBack($productDAO);
						$resource->errorMessage='Sua mon that bai.';
					}else{
						if($isHasRestaurant){
							$restaurantProductDAO->commit();
							$restaurantProductDAO->close();
						}
						$productDAO->commit();
						$productDAO->close();
						$resource->message='Sua mon thanh cong voi ma la: '.$_POST['id'];
					}*/
				}
			}
			$adapter=new CategoryDAO();
			$resource->productCategories=$adapter->getCategories('P');
			$resource->ingredientCategories=$adapter->getCategories('I');
			$adapter=new IngredientDAO();
			$resource->ingredients=$adapter->getAllIngredientDetail();
			$products=$productDAO->getAll();
			$productIngredientDAO=new ProductIngredientDAO();
			//get ingredients
			foreach($products as &$product){
				$product['ingredients']=$productIngredientDAO->getAllIngredientIdAndCountByProductId($product['id']);
			}
			$resource->products=$products;
			include constant('VIEW_DIR').'page_product_ingredient.php';
		}
		public function createProductArray(){
			if(!empty($_POST)){
				$default_status=isset($_POST['default_status']) ? $_POST['default_status'] : 0;
				return array('name'=>$_POST['name'],'category_id'=>$_POST['category_id'],'unit_id'=>$_POST['unit_id'],'description'=>$_POST['description'],'image'=>$_POST['image'],'reference_price'=>$_POST['reference_price'],'quantity_on_single_order'=>$_POST['quantity_on_single_order'],'default_status'=>$default_status) ;
			}
		}
		public function rollBack($dao){
			// Rollback transaction\n
			$dao->rollBack();
			/* close connection */
			$dao->close();
		}
	}
?>
