<?php
	//echo 'CashierPageBuilder: '.$_SERVER["PHP_SELF"];
	class UnitPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			$adapter=new UnitDAO();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		    $available=isset($_POST['available']) ? $_POST['available'] : 0;
				if($_POST['action'] === 'add'){
					$add=array('name'=>$_POST['name'],'type'=>$_POST['type'],'description'=>$_POST['description'],'available'=>$available) ;
					$insertedID=$adapter->create($add,$resource->requester);
					//TODO change the version of table
					if($insertedID>0) $resource->message='Them don vi thanh cong voi ma la: '.$insertedID;
					else $resource->errorMessage='Them don vi that bai';
				}else{
					//do edit here
					$updateStatus=false;
					if(isset($_POST['id']) && is_numeric($_POST['id'])){
						$edit=array('id'=>$_POST['id'],'name'=>$_POST['name'],'type'=>$_POST['type'],'description'=>$_POST['description'],'available'=>$available) ;
						$updateStatus=$adapter->edit($edit,$resource->requester);
						//TODO change the version of table
					}
					if($updateStatus) $resource->message='Sua don vi thanh cong voi ma la: '.$_POST['id'];
					else $resource->errorMessage='Sua don vi that bai';
				}
			}
			$resource->units=$adapter->getAll();
			include constant('VIEW_DIR').'page_unit.php';
		}
	}
?>
