<?php
session_start();
include 'config/db.php';

if(isset($_GET['id'])){
  if($db->exec('UPDATE  todo_list SET status=1 WHERE id='.$_GET['id'])){
    $_SESSION['is_complete_list'] = true;
    header('Location: me.php');
  }
}
