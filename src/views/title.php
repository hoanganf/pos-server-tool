<div id="navbar" class="navbar">
  <a href="?pageId=product" <?php if($resource->isProduct){ ?>class="active" <?php }?> >San pham</a>
  <a href="?pageId=ingredient" <?php if($resource->isIngredient){ ?>class="active" <?php }?>>Nguyen lieu</a>
  <a href="?pageId=category" <?php if($resource->isCategory){ ?>class="active" <?php }?>>Danh muc</a>
  <a href="?pageId=unit" <?php if($resource->isUnit){ ?>class="active" <?php }?>>Don vi</a>
</div>
