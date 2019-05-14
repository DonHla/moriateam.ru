<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Регистрация на сайте';
   require 'block/head.php'; ?>
</head>
<body>
<?php require 'block/header.php'; ?>

<main class="container mt-5">
  <div class="row">
    <div class="col-md-8 mb-5">
      <h4>Форма регисрации</h4>
<form>
        <label for="username"> Введите ваш Ник </label>
        <input type="text" name="username" id="username" class="form-control">

        <label for="email"> Почту </label>
        <input type="email" name="email" id="email" class="form-control">

        <label for="masterplayer"> Кем хотите быть? </label>
        <select id="masterplayer" name="masterplayer" class="form-control">
                     <option value="master">Мастер</option>
                     <option value="player">Игрок</option>
        </select>

        <label for="character"> Охарактерезуйте себя </label>
        <input type="text" name="character" id="character" class="form-control">

        <label for="contact"> Контакты (ВК, Discord) </label>
        <input type="text" name="contact" id="contact" class="form-control">

        <label for="pass"> Пароль </label>
        <input type="password" name="pass" id="pass" class="form-control">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

        <div class="alert alert-danger mt-2" id="errorBlock"> </div>

        <button type="button" id="reg_user" class="btn btn-success mt-3">
          Зарегестрироваться
        </button>
</form>
    </div>

    <?php require 'block/aside.php'; ?>

    <?php require 'block/footer.php'; ?>

    <script>
    $('#reg_user').click(function () {
      var nick = $('#username').val();
      var email = $('#email').val();
      var masterplayer = $('#masterplayer').val();
      var character = $('#character').val();
      var contact = $('#contact').val();
      var pass = $('#pass').val();

      $.ajax({
        url:'ajax/reg.php',
        type: 'POST',
        cache:false,
        data:{'username' : nick, 'email' : email, 'masterplayer' : masterplayer, 'character' : character, 'contact' : contact, 'pass': pass },
        dataType: 'html',
        success: function(data){
        if(data == 'готово'){
          $('#reg_user').text('Всё готово');
          $('#errorBlock').hide();
          if (masterplayer=="master")
          location.replace("reg_master_dop.php");
          else
          location.replace("enter.php");
          }
        else {
            $('#errorBlock').show();
            $('#errorBlock').text(data);
          }
        }
      });
    });
    </script>

</body>
</html>
