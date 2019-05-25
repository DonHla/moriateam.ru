<!-- Сделать переход на других игроков. Сделать отправку комментария-->
<?php session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Информация о игроке';
   require 'block/head.php'; ?>
</head>
<body>

<?php require 'block/header.php'; ?>

  <div class="row">
<?php require 'block/leftmenu.php'; ?>
    <div class="col-md-6 mb-5">
    <h4>Информация этом игроке</h4>
<form>

  <?php
   require_once 'mysql_connect.php';
   $username = $_SESSION['playerInfName'];
  require 'block/select_inf_player.php';
  require 'block/select_comment.php';
  ?>
<!-- Сделать в этой кнопке ссылку на форму отправки писем -->
          <a class="btn btn-warning mt-3 mr-2" href="/mail_for_admin.php">  Пожаловаться на игрока</a>

    </div>
</form>
<?php require 'block/aside.php'; ?>

<?php require 'block/footer.php'; ?>
    </div>

</body>
</html>
