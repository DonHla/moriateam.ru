<html lang="ru">
<head>
  <?php
   $website_title = 'Вход в аккаунт';
   require 'block/head.php'; ?>
</head>
  <body>

<?php require 'block/header.php'; ?>

<?php
ini_set('display_errors','Off');// не показывать ошибку на этой странице
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

  <form class="my-form">
      <div class="form-group">
          <label for="password"> Пароль </label>
          <input type="password" name="password" id="password" class="form-control">
      </div>
      <div class="form-group">
          <a href="#" onclick="return false" id="s-h-pass">Показать пароль</a>
      </div>
  </form>

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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

  <script>
      $( document ).ready(function() {
          $('#s-h-pass').click(function(){
              var type = $('#password').attr('type') == "text" ? "password" : 'text',
               c = $(this).text() == "Скрыть пароль" ? "Показать пароль" : "Скрыть пароль";
              $(this).text(c);
              $('#password').prop('type', type);
          });
      });
  </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script>

$('#enter_user').click(function () {
  var nick = $('#username').val();
  var pass = $('#password').val();

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
