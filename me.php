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

  $st = $db->prepare("SELECT * FROM todo_list WHERE user_id=:id AND status=:status ORDER BY id DESC");
  $st->execute(array('id' => $_SESSION['user_id'], 'status'=>0));
  $active_list = $st->fetchAll();

  $st = $db->prepare("SELECT * FROM todo_list WHERE user_id=:id AND status=:status ORDER BY id DESC");
  $st->execute(array('id' => $_SESSION['user_id'], 'status'=>1));
  $complete_list = $st->fetchAll();

}else{
  header('Location: signin.php ');
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="generator" content="Jekyll v4.0.1">
    <link rel="shortcut icon" href="https://img.icons8.com/ios-filled/50/000000/todo-list.png" type="image/png">
    <title>Личный кабинет</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/cover/">

    <!-- Bootstrap core CSS -->
    <link href="src/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <link href="src/cover.css" rel="stylesheet">
  </head>
  <body class="text-center">
      <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
          <div class="inner">
            <h3 class="masthead-brand">
              <?php
                echo $user['name'];
              ?>
            </h3>
            <nav class="nav nav-masthead justify-content-center">
              <a class="nav-link" href="#">Главная</a>
              <a class="nav-link" href="signout.php">Выйти</a>
            </nav>
          </div>
        </header>

      <main role="main" class="inner cover">
        <h1 class="cover-heading">Мой список дел</h1>
        <?php if(isset($_SESSION['is_add_list'])){
          if($_SESSION['is_add_list']){ $_SESSION['is_add_list']=false; ?>
          <div class="alert alert-success" role="alert">
              Дело добавлено!</a>
          </div>
        <?php }} ?>
        <?php if(isset($_SESSION['is_complete_list'])){
          if($_SESSION['is_complete_list']){ $_SESSION['is_complete_list']=false; ?>
          <div class="alert alert-success" role="alert">
              Дело выполнено!</a>
          </div>
        <?php }} ?>
        <div class="todo-list">
          <div class="active-list">
            <p class="title-active-list">Текущий список</p>
            <?php
            if($active_list==null){ ?>
              <div class="row do-title">
                 <p>
                   Нет дел!
                 </p>
              </div>
            <?php }else{
              foreach ($active_list as $list) { ?>
                <div class="row do-title">
                  <a href="complete-do.php?id=<?=$list['id']?>" class="btn btn-success btn-sm">\/</a>
                   <p>
                     <?php echo $list['title']; ?>
                   </p>
                </div>
            <?php }} ?>
          </div>
          <div class="complete-list">
            <p class="title-complete-list">Выполненный список</p>
            <?php
            if($complete_list==null){ ?>
              <div class="row do-title">
                 <p>
                   Нет дел!
                 </p>
              </div>
            <?php }else{
              foreach ($complete_list as $list) { ?>
                <div class="row do-title">
                  <a href="active-do.php?id=<?=$list['id']?>" class="btn btn-danger btn-sm">Х</a>
                  <p>
                    <?php echo $list['title']; ?>
                  </p>
                </div>
            <?php }} ?>
          </div>

        </div>
        <form action="add-todo.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-9">
        			<input type="text" class="form-control" id="exampleInputUsername"  placeholder="Новое дело..." name='do_title'>
            </div>
            <div class="form-group col-md-3">
              <input type="submit" class="btn btn-success" style="width:100%" value="Добавить" name="submit_todo">
            </div>
          </div>
        </form>
      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Проект <a href="https://github.com/gjhonic/todo">GitHub</a>, by <a href="https://www.instagram.com/gjhonic/">@gjhonic</a>.</p>
        </div>
      </footer>
    </div>
</body>
</html>
