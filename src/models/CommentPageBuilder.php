<?php
	//echo 'CashierPageBuilder: '.$_SERVER["PHP_SELF"];
	class CommentPageBuilder implements PageBuilder{
		public function buildHtml($resource){
			$adapter=new CommentDAO();
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		    $available=isset($_POST['available']) ? $_POST['available'] : 0;
				if($_POST['action'] === 'add'){
					$add=$this->createCommentArray();
					$insertedID=$adapter->create($add,$resource->requester);
					//TODO change the version of table
					if($insertedID>0) $resource->message='Them ghi chu thanh cong voi ma la: '.$insertedID;
					else $resource->errorMessage='Them ghi chu that bai';
				}else{
					//do edit here
					$updateStatus=false;
					if(isset($_POST['id']) && is_numeric($_POST['id'])){
						$edit=$this->createCommentArray();
						$edit['id']=$_POST['id'];
						$updateStatus=$adapter->edit($edit,$resource->requester);
						//TODO change the version of table
					}
					if($updateStatus) $resource->message='Sua ghi chu thanh cong voi ma la: '.$_POST['id'];
					else $resource->errorMessage='Sua ghi chu that bai';
				}
			}
			$resource->comments=$adapter->getAll();
			include constant('VIEW_DIR').'page_comment.php';
		}
		public function createCommentArray(){
			if(!empty($_POST)){
				return array('name'=>$_POST['name'],'description'=>$_POST['description']);
			}
		}
	}
?>
