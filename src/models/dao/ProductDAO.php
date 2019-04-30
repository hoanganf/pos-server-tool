<?php
class ProductDAO extends BaseDAO{
  function __construct(){
     parent::__construct("product");
  }
  // for tool
  function create($product,$requester){
    $sql='INSERT INTO product (name, category_id, unit_id, reference_price, description, image, quantity_on_single_order,creator,updater) ';
    $sql.= 'VALUES (\''.$product['name'].'\', '.$product['category_id'].', '.$product['unit_id'].', ';
    $sql.= $product['reference_price'].', \''.$product['description'].'\',\''.$product['image'].'\', ';
    $sql.= $product['quantity_on_single_order'].',\''.$requester.'\',\''.$requester.'\')';
    return $this->insert($sql);
  }
  function edit($product,$requester){
    $sql='UPDATE product SET ';
    $sql.= 'name=\''.$product['name'].'\', ';
    $sql.= 'category_id='.$product['category_id'].', ';
    $sql.= 'unit_id='.$product['unit_id'].', ';
    $sql.= 'reference_price='.$product['reference_price'].', ';
    $sql.= 'description=\''.$product['description'].'\', ';
    $sql.= 'image=\''.$product['image'].'\', ';
    $sql.= 'quantity_on_single_order='.$product['quantity_on_single_order'].',';
    $sql.= 'updater=\''.$requester.'\',';
    $sql.= 'last_updated_date=now()';
    $sql.= ' WHERE id='.$product['id'];
    return $this->query($sql);
  }
  function getProduct($productId){
    return $this->getOnceWhere('id='.$productId);
  }

  function getProductsByCategoryId($cateId){
    return $this->getAllWhere('category_id='.$cateId);
  }
}
?>
