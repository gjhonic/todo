<?php
session_start();
include 'config/db.php';

if(isset($_GET['id'])){
  if($db->exec('UPDATE  todo_list SET status=0 WHERE id='.$_GET['id'])){
    header('Location: me.php');
  }
}
