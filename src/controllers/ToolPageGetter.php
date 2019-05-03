<?php
	class ToolPageGetter extends PageGetter{
		public function buildHtml($pageId,$pageResource){
			switch ($pageId) {
				case 'restaurant':
					if($pageResource->role=='A'){
						$pageBuilder=new RestaurantPageBuilder();
						$pageResource->isRestaurant=TRUE;
						break;
					}else{
						trigger_error('AccessDenied');
					}
				case 'product':
					$pageBuilder=new ProductPageBuilder();
					$pageResource->isProduct=TRUE;
					break;
				case 'productIngredient':
					$pageBuilder=new ProductIngredientPageBuilder();
					$pageResource->isProductIngredient=TRUE;
					break;
				case 'ingredient':
					$pageBuilder=new IngredientPageBuilder();
					$pageResource->isIngredient=TRUE;
					break;
				case 'category':
					$pageBuilder=new CategoryPageBuilder();
					$pageResource->isCategory=TRUE;
					break;
				case 'unit':
					$pageBuilder=new UnitPageBuilder();
					$pageResource->isUnit=TRUE;
					break;
				case 'comment':
					$pageBuilder=new CommentPageBuilder();
					$pageResource->isComment=TRUE;
					break;
				case 'user':
					if($pageResource->role=='A'){
						$pageBuilder=new UserPageBuilder();
						$pageResource->isUser=TRUE;
						break;
					}else{
						trigger_error('AccessDenied');
					}
        default:
          $pageBuilder=new ProductPageBuilder();
					//TODO have to set value to another page
					$pageResource->isProduct=TRUE;
      }
      $pageBuilder->buildHtml($pageResource);
		}
	}
?>
