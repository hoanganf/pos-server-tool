<?php
	//echo 'CashierPageBuilder: '.$_SERVER["PHP_SELF"];
	class ProductPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			$productAdapter=new ProductDAO();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				if($_POST['action'] === 'add'){
					$addProduct=$this->createProductArray();
					$insertedID=$productAdapter->create($addProduct,$resource->requester);
					//TODO change the version of table
					if($insertedID>0) $resource->message='Them mon thanh cong voi ma la: '.$insertedID;
					else $resource->errorMessage='Them mon that bai';
				}else{
					//do edit here
					$updateStatus=false;
					if(isset($_POST['id']) && is_numeric($_POST['id'])){
						$editProduct=$this->createProductArray();
						$editProduct['id']=$_POST['id'];
						$updateStatus=$productAdapter->edit($editProduct,$resource->requester);
						//TODO change the version of table
					}
					if($updateStatus) $resource->message='Sua mon thanh cong voi ma la: '.$_POST['id'];
					else $resource->errorMessage='Sua mon that bai';
				}
			}
			$adapter=new CategoryDAO();
			$resource->categories=$adapter->getCategories();
			$resource->products=$productAdapter->getAll();
			$adapter=new UnitDAO();
			$resource->units=$adapter->getUnits('P');
			include constant('VIEW_DIR').'page_product.php';
		}
		public function createProductArray(){
			if(!empty($_POST)){
				return array('name'=>$_POST['name'],'category_id'=>$_POST['category_id'],'unit_id'=>$_POST['unit_id'],'description'=>$_POST['description'],'image'=>$_POST['image'],'reference_price'=>$_POST['reference_price'],'quantity_on_single_order'=>$_POST['quantity_on_single_order']) ;
			}
		}
	}
?>
