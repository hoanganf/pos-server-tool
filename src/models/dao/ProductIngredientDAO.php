<?php
class ProductIngredientDAO extends BaseDAO{
  function __construct(){
     parent::__construct("product_ingredient");
  }
  function getAllIngredientIdAndCountByProductId($productId){
    return $this->getAllQuery('SELECT i.id,i.name,pi.count,u.name as unit_name FROM product_ingredient pi LEFT JOIN ingredient i ON i.id=pi.ingredient_id LEFT JOIN unit u ON u.id=i.unit_id WHERE pi.available=1 AND product_id='.$productId);
  }
}
?>
