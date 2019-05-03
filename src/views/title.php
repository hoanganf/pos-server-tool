<div id="navbar" class="navbar">
  <?php if($resource->role=='A'){?>
  <a href="?pageId=restaurant" <?php if($resource->isRestaurant){ ?>class="active" <?php }?> >Nha hang</a>
  <a href="?pageId=user" <?php if($resource->isUser){ ?>class="active" <?php }?> >Nhan vien</a>
  <?php }?>
  <a href="?pageId=product" <?php if($resource->isProduct){ ?>class="active" <?php }?> >San pham</a>
  <a href="?pageId=ingredient" <?php if($resource->isIngredient){ ?>class="active" <?php }?>>Nguyen lieu</a>
  <a href="?pageId=category" <?php if($resource->isCategory){ ?>class="active" <?php }?>>Danh muc</a>
  <a href="?pageId=unit" <?php if($resource->isUnit){ ?>class="active" <?php }?>>Don vi</a>
  <div class="dropdown">
    <button class="dropbtn<?php if($resource->isComment || $resource->isProductIngredient) echo ' active' ?>">Khac</button>
    <div class="dropdown-content">
      <a href="?pageId=comment" <?php if($resource->isComment){ ?>class="active" <?php }?>>Ghi chu</a>
      <a href="?pageId=productIngredient" <?php if($resource->isProductIngredient){ ?>class="active" <?php }?>>Cong thuc mon an</a>
      <a href="?pageId=none" <?php if($resource->none){ ?>class="active" <?php }?>>...</a>
      <a href="#">Link 3</a>
    </div>
  </div>
</div>
