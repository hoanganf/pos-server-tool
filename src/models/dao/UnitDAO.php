<?php
class UnitDAO extends BaseDAO{
  function __construct(){
     parent::__construct("`unit`");
  }
  function getUnits($type='P'){
    return $this->getAllWhere('available=1 AND type=\''.$type.'\'');
  }
  //for tool
  function getAllWithoutAvailable($type='P'){
    return $this->getAllWhere('type=\''.$type.'\'');
  }

  function create($unit,$requester){
    $sql='INSERT INTO unit (name, type, description,available, creator,updater) ';
    $sql.= 'VALUES (\''.$unit['name'].'\', \''.$unit['type'].'\', ';
    $sql.= '\''.$unit['description'].'\','.$unit['available'].',\'';
    $sql.= $requester.'\',\''.$requester.'\')';
    return $this->insert($sql);
  }
  function edit($unit,$requester){
    $sql='UPDATE unit SET ';
    $sql.= 'name=\''.$unit['name'].'\', ';
    $sql.= 'type=\''.$unit['type'].'\', ';
    $sql.= 'description=\''.$unit['description'].'\', ';
    $sql.= 'available='.$unit['available'].', ';
    $sql.= 'updater=\''.$requester.'\',';
    $sql.= 'last_updated_date=now()';
    $sql.= ' WHERE id='.$unit['id'];
    return $this->query($sql);
  }
}
?>
