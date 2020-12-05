<?php
session_start();
include 'config/db.php';

if(isset($_POST['submit_sign'])){
    $name = $_POST['name'];
    $st = $db->prepare("SELECT * FROM user WHERE name=:name");
    $st->execute(array('name' => $name));
    $result = $st->fetchAll();
    if($result!=null){
      $_SESSION['user_id'] = $result[0]['id'];
      header('Location: me.php ');
    }
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
    <title>Вход</title>

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
            <h3 class="masthead-brand">Todo</h3>
            <nav class="nav nav-masthead justify-content-center">
              <a class="nav-link" href="index.php">Главная</a>
              <a class="nav-link active" href="#">Войти</a>
            </nav>
          </div>
        </header>

      <main role="main" class="inner cover">
        <h1 align="center">Вход</h1>
      		<form method="POST" action="signin.php" style="margin: 20px 10%;">
      			<div class="form-group">
      				<input type="text" class="form-control" id="exampleInputUsername"  placeholder="Ваше имя" name='name'>
      			</div>
      			<input type="submit" class="btn btn-primary btn-block" value="Войти" name="submit_sign">
      			<h1 align="center"><a class="btn btn-outline-info btn-sm" href="register.php" role="button">Нет аккаунта?</a></h1>
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
