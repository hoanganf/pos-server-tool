<?php
/* NOT USE
class RestaurantIngredientDAO extends BaseDAO{
  function __construct(){
     parent::__construct("restaurant_ingredient");
  }
  function editOnlyAvailable($restaurantId,$ingredient,$requester){
    $sql='UPDATE restaurant_ingredient SET ';
    if(isset($ingredient['available'])){
      $sql.='available='.$ingredient['available'].', ';
    }else{
      $sql.='available=1, ';//set available default 1
    }

    $sql.='updater=\''.$requester.'\', ';
    $sql.='last_updated_date=now() ';
    $sql.='WHERE ingredient_id='.$ingredient['id'].' AND restaurant_id='.$restaurantId;
    if(isset($this->connection)){
      return $this->queryNotAutoClose($sql);
    }else{
      return $this->query($sql);
    }
  }
  function edit($restaurantId,$ingredient,$requester){
    $sql='UPDATE restaurant_ingredient SET ';
    if(isset($ingredient['available'])){
      $sql.='available='.$ingredient['available'].', ';
    }else{
      $sql.='available=1, ';//set available default 1
    }
    $sql.='price='.$ingredient['reference_price'].', ';
    $sql.='updater=\''.$requester.'\', ';
    $sql.='last_updated_date=now() ';
    $sql.='WHERE ingredient_id='.$ingredient['id'].' AND restaurant_id='.$restaurantId;
    if(isset($this->connection)){
      return $this->queryNotAutoClose($sql);
    }else{
      return $this->query($sql);
    }
  }
  function create($restaurantId,$ingredient,$requester){
    $sql = 'INSERT INTO restaurant_ingredient (';
    $sql.='restaurant_id, ';
    $sql.='ingredient_id, ';
    $sql.='price, ';
    $sql.='available, ';
    $sql.='creator, ';
    $sql.='created_date, ';
    $sql.='updater, ';
    $sql.='last_updated_date';

    $sql.=') VALUES ( ';
    $sql.=$restaurantId.', ';
    $sql.=$ingredient['id'].', ';
    $sql.=$ingredient['reference_price'].', ';
    if(isset($ingredient['available'])){
      $sql.=$ingredient['available'].', ';
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
*/
?>
