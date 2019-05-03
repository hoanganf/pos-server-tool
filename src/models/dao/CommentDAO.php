<?php
class CommentDAO extends BaseDAO{
  function __construct(){
     parent::__construct("`comment`");
  }
  function create($comment,$requester){
    $sql='INSERT INTO comment (name, description,creator,updater) ';
    $sql.= 'VALUES (\''.$comment['name'].'\', ';
    $sql.= '\''.$comment['description'].'\',\'';
    $sql.= $requester.'\',\''.$requester.'\')';
    return $this->insert($sql);
  }
  function edit($comment,$requester){
    $sql='UPDATE comment SET ';
    $sql.= 'name=\''.$comment['name'].'\', ';
    $sql.= 'description=\''.$comment['description'].'\', ';
    $sql.= 'updater=\''.$requester.'\',';
    $sql.= 'last_updated_date=now()';
    $sql.= ' WHERE id='.$comment['id'];
    return $this->query($sql);
  }
}
?>
