<?php
	//echo 'CashierPageBuilder: '.$_SERVER["PHP_SELF"];
	class IngredientPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			$ingredientAdapter=new IngredientDAO();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if($_POST['action'] === 'add'){
					$add=$this->createIngredientArray();
					$insertedID=$ingredientAdapter->create($add,$resource->requester);
					//TODO change the version of table
					if($insertedID>0) $resource->message='Them nguyen lieu thanh cong voi ma la: '.$insertedID;
					else $resource->errorMessage='Them nguyen lieu that bai';
				}else{
					//do edit here
					$updateStatus=false;
					if(isset($_POST['id']) && is_numeric($_POST['id'])){
						$edit=$this->createIngredientArray();
						$edit['id']=$_POST['id'];
						$updateStatus=$ingredientAdapter->edit($edit,$resource->requester);
						//TODO change the version of table
					}
					if($updateStatus) $resource->message='Sua nguyen lieu thanh cong voi ma la: '.$_POST['id'];
					else $resource->errorMessage='Sua nguyen lieu that bai';
				}
			}
			$adapter=new CategoryDAO();
			$resource->categories=$adapter->getCategories('I');
			$resource->ingredients=$ingredientAdapter->getAll();
			$adapter=new UnitDAO();
			$resource->units=$adapter->getUnits('I');

			include constant('VIEW_DIR').'page_ingredient.php';
		}
		public function createIngredientArray(){
			if(!empty($_POST)){
				return array('name'=>$_POST['name'],'category_id'=>$_POST['category_id'],'unit_id'=>$_POST['unit_id'],'description'=>$_POST['description'],'image'=>$_POST['image'],'reference_price'=>$_POST['reference_price']) ;
			}
		}
	}
?>
