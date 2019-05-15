<html lang="ru">
<head>
  <?php
   $website_title = 'Вход в аккаунт';
   require 'block/head.php'; ?>
</head>
  <body>

<?php require 'block/header.php'; ?>

<?php
ini_set('display_errors','Off');
if($_COOKIE['nickname'] == ""):
?>

<main class="container mt-5">
  <div class="row">
 <img class="col-md-4" src="/img/madam.png" alt="" width="300" height="625">
    <div class="col-md-4 mb-5">

  <h4>Вход</h4>
<form >
<p>
  <label for="username"> Введите ваш Ник </label>
  <input type="text" name="username" id="username" class="form-control">

  <label for="pass"> Пароль </label>
  <input type="password" name="pass" id="pass" class="form-control">

  <div class="alert alert-danger mt-2" id="errorBlock2"> </div>

  <button type="button" id="enter_user"  class="btn btn-success mt-2">
    Войти
  </button>
</p>
</form>

</div>

<?php require 'block/aside.php'; ?>

<?php require 'block/footer.php'; ?>

<?php
else:
?>

<?php require 'pers_account.php';?>

<?php
endif;
?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script>

$('#exit_btn').click(function () {
  $.ajax({
    url:'ajax/exit.php',
    type:'POST',
    cache:false,
    data:{},
    dataType: 'html',
    success: function(data){
        document.location.reload(true);
    }
  });
});

$('#enter_user').click(function () {
  var nick = $('#username').val();
  var pass = $('#pass').val();

  $.ajax({
    url:'ajax/enter.php',
    type:'POST',
    cache:false,
    data:{'username' : nick, 'pass': pass },
    dataType: 'html',
    success: function(data){
    if(data == 'готово'){
      $('#enter_user').text('Всё готово');
      $('#errorBlock2').hide();
        document.location.reload(true);
      }
    else {
        $('#errorBlock2').show();
        $('#errorBlock2').text(data);
      }
    }
  });
});
</script>

</body>
</html>
