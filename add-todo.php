<?php
session_start();
include 'config/db.php';

if(isset($_SESSION['user_id'])){
  $st = $db->prepare("SELECT * FROM user WHERE id=:id");
  $st->execute(array('id' => $_SESSION['user_id']));
  $result = $st->fetchAll();

  if($result!=null){
    $user = $result[0];
  }else{
    header('Location: signin.php ');
  }

  if(isset($_POST['submit_todo'])){
    $do_title = $_POST['do_title'];
    if($db->exec('INSERT INTO  todo_list (user_id, title, status) VALUES ('.$_SESSION["user_id"].', "'.$do_title.'", 0)')){
      $_SESSION['is_add_list'] = true;
      header('Location: me.php');
    }
    echo "123";
  }


}else{
  header('Location: signin.php ');
}
