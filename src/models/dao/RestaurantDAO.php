<?php
class RestaurantDAO extends BaseDAO{
  function __construct(){
     parent::__construct("restaurant");
  }

  function create($restaurant,$requester){
    $sql='INSERT INTO restaurant (name, phone, address, description,available, image, access_key, creator,updater) ';
    $sql.= 'VALUES (\''.$restaurant['name'].'\', ';
    $sql.= '\''.$restaurant['phone'].'\',\''.$restaurant['address'].'\', ';
    $sql.= '\''.$restaurant['description'].'\','.$restaurant['available'].',\'';
    $sql.= $restaurant['image'].'\', \''.$restaurant['access_key'].'\',';
    $sql.= '\''.$requester.'\',\''.$requester.'\')';
    return $this->insert($sql);
  }
  function edit($restaurant,$requester){
    $sql='UPDATE restaurant SET ';
    $sql.= 'name=\''.$restaurant['name'].'\', ';
    $sql.= 'phone=\''.$restaurant['phone'].'\', ';
    $sql.= 'address=\''.$restaurant['address'].'\', ';
    if(isset($restaurant['access_key'])) $sql.= 'access_key=\''.$restaurant['access_key'].'\', ';
    $sql.= 'description=\''.$restaurant['description'].'\', ';
    $sql.= 'available='.$restaurant['available'].', ';
    $sql.= 'image=\''.$restaurant['image'].'\', ';
    $sql.= 'updater=\''.$requester.'\',';
    $sql.= 'last_updated_date=now()';
    $sql.= ' WHERE id='.$restaurant['id'];
    return $this->query($sql);
  }
}
?>
