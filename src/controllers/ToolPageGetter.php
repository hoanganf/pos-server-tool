<?php
	class ToolPageGetter extends PageGetter{
		public function buildHtml($pageId,$pageResource){
			switch ($pageId) {
				case 'product':
					$pageBuilder=new ProductPageBuilder();
					$pageResource->isProduct=TRUE;
					break;
				case 'category':
					$pageBuilder=new CategoryPageBuilder();
					$pageResource->isCategory=TRUE;
					break;
				case 'unit':
					$pageBuilder=new UnitPageBuilder();
					$pageResource->isUnit=TRUE;
					break;
        default:
          $pageBuilder=new ProductPageBuilder();
					//TODO have to set value to another page
					$pageResource->isCashier=TRUE;
      }
      $pageBuilder->buildHtml($pageResource);
		}
	}
?>
