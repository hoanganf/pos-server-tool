<?php
class IngredientDAO extends BaseDAO{
  function __construct(){
     parent::__construct("ingredient");
  }
  // for tool
  function create($ingredient,$requester){
    $sql='INSERT INTO ingredient (name, category_id, unit_id, reference_price, description, image,creator,updater) ';
    $sql.= 'VALUES (\''.$ingredient['name'].'\', '.$ingredient['category_id'].', '.$ingredient['unit_id'].', ';
    $sql.= $ingredient['reference_price'].', \''.$ingredient['description'].'\',\''.$ingredient['image'].'\', ';
    $sql.= '\''.$requester.'\',\''.$requester.'\')';
    return $this->insert($sql);
  }
  function edit($ingredient,$requester){
    $sql='UPDATE ingredient SET ';
    $sql.= 'name=\''.$ingredient['name'].'\', ';
    $sql.= 'category_id='.$ingredient['category_id'].', ';
    $sql.= 'unit_id='.$ingredient['unit_id'].', ';
    $sql.= 'reference_price='.$ingredient['reference_price'].', ';
    $sql.= 'description=\''.$ingredient['description'].'\', ';
    $sql.= 'image=\''.$ingredient['image'].'\', ';
    $sql.= 'updater=\''.$requester.'\',';
    $sql.= 'last_updated_date=now()';
    $sql.= ' WHERE id='.$ingredient['id'];
    return $this->query($sql);
  }
  function getIngredient($ingredientId){
    return $this->getOnceWhere('id='.$ingredientId);
  }

  function getIngredientByCategoryId($cateId){
    return $this->getAllWhere('category_id='.$cateId);
  }
}
?>
