<?php
class UserDAO extends BaseDAO{
  function __construct(){
     parent::__construct("`user`");
  }

  function checkUserExists($userName){
    $user=$this->getOnceWhere('user_name=\''.$userName.'\'');
    return $user!==null;
  }

  function create($user,$requester){
    $sql='INSERT INTO `user` (`user_name`, `role`, `password`, `name`, `salary_type`, `available`, `joined_date`) VALUES (';
    $sql.= '\''.$user['user_name'].'\', \''.$user['role'].'\', ';
    $sql.= '\''.$user['password'].'\', \''.$user['name'].'\', ';
    $sql.= '\''.$user['salary_type'].'\', ';
    $sql.= $user['available'].',now())';
    return $this->query($sql);
  }
  function edit($user,$requester){
    $sql='UPDATE user SET ';
    $sql.= 'role=\''.$user['role'].'\', ';
    if(isset($user['password'])) $sql.= 'password=\''.$user['password'].'\', ';
    $sql.= 'name=\''.$user['name'].'\', ';
    $sql.= 'salary_type=\''.$user['salary_type'].'\', ';
    $sql.= 'available='.$user['available'];
    if($user['available']=='0') $sql.= ',left_date=now()';
    else $sql.= ',left_date=NULL';
    $sql.= ' WHERE user_name=\''.$user['user_name'].'\'';
    return $this->query($sql);
  }
}
?>
