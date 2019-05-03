<?php
class RestaurantProductDAO extends BaseDAO{
  function __construct(){
     parent::__construct("restaurant_product");
  }
  function editOnlyAvailable($restaurantId,$product,$requester){
    $sql='UPDATE restaurant_product SET ';
    if(isset($product['available'])){
      $sql.='available='.$product['available'].', ';
    }else{
      $sql.='available=1, ';//set available default 1
    }

    $sql.='updater=\''.$requester.'\', ';
    $sql.='last_updated_date=now() ';
    $sql.='WHERE product_id='.$product['id'].' AND restaurant_id='.$restaurantId;
    if(isset($this->connection)){
      return $this->queryNotAutoClose($sql);
    }else{
      return $this->query($sql);
    }
  }
  function edit($restaurantId,$product,$requester){
    $sql='UPDATE restaurant_product SET ';
    $sql.='price='.$product['reference_price'].', ';
    $sql.='default_status='.$product['default_status'].', ';
    $sql.='quantity_on_single_order='.$product['quantity_on_single_order'].', ';
    if(isset($product['available'])){
      $sql.='available='.$product['available'].', ';
    }else{
      $sql.='available=1, ';//set available default 1
    }

    $sql.='updater=\''.$requester.'\', ';
    $sql.='last_updated_date=now() ';
    $sql.='WHERE product_id='.$product['id'].' AND restaurant_id='.$restaurantId;
    if(isset($this->connection)){
      return $this->queryNotAutoClose($sql);
    }else{
      return $this->query($sql);
    }
  }
  function create($restaurantId,$product,$requester){
    $sql = 'INSERT INTO restaurant_product (';
    $sql.='restaurant_id, ';
    $sql.='product_id, ';
    $sql.='price, ';
    $sql.='default_status, ';
    $sql.='quantity_on_single_order, ';
    $sql.='available, ';
    $sql.='creator, ';
    $sql.='created_date, ';
    $sql.='updater, ';
    $sql.='last_updated_date';

    $sql.=') VALUES ( ';
    $sql.=$restaurantId.', ';
    $sql.=$product['id'].', ';
    $sql.=$product['reference_price'].', ';
    $sql.=$product['default_status'].', ';
    $sql.=$product['quantity_on_single_order'].', ';
    if(isset($product['available'])){
      $sql.=$product['available'].', ';
    }else{
      $sql.='1, ';//set available default 1
    }
    $sql.='\''.$requester.'\', ';
    $sql.='now(), ';
    $sql.='\''.$requester.'\', ';
    $sql.='now() )';

    if(isset($this->connection)){
      return $this->queryNotAutoClose($sql);
    }else{
      return $this->query($sql);
    }
  }
}
?>
