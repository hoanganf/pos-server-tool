<?php
class ProductDAO extends BaseDAO{
  function __construct(){
     parent::__construct("product");
  }
  // for tool
  function create($product,$requester){
    $sql='INSERT INTO product (name, category_id, unit_id, reference_price,default_status, description, image, quantity_on_single_order,creator,updater) ';
    $sql.= 'VALUES (\''.$product['name'].'\', '.$product['category_id'].', '.$product['unit_id'].', ';
    $sql.= $product['reference_price'].','.$product['default_status'].', \''.$product['description'].'\',\''.$product['image'].'\', ';
    $sql.= $product['quantity_on_single_order'].',\''.$requester.'\',\''.$requester.'\')';
    if(isset($this->connection)){// has transaction
      if($this->queryNotAutoClose($sql)){
        return $this->getLastInsertId();
      }else{
        return -1;
      }
    }else{
      return $this->insert($sql);
    }
  }
  function edit($product,$requester){
    $sql='UPDATE product SET ';
    $sql.= 'name=\''.$product['name'].'\', ';
    $sql.= 'category_id='.$product['category_id'].', ';
    $sql.= 'unit_id='.$product['unit_id'].', ';
    $sql.= 'reference_price='.$product['reference_price'].', ';
    $sql.= 'default_status='.$product['default_status'].', ';
    $sql.= 'description=\''.$product['description'].'\', ';
    $sql.= 'image=\''.$product['image'].'\', ';
    $sql.= 'quantity_on_single_order='.$product['quantity_on_single_order'].',';
    $sql.= 'updater=\''.$requester.'\',';
    $sql.= 'last_updated_date=now()';
    $sql.= ' WHERE id='.$product['id'];

    if(isset($this->connection)){// has transaction
      return $this->queryNotAutoClose($sql);
    }else{
      return $this->query($sql);
    }
  }
  function getProduct($productId){
    return $this->getOnceWhere('id='.$productId);
  }

  function getProductsByCategoryId($cateId){
    return $this->getAllWhere('category_id='.$cateId);
  }
}
?>
