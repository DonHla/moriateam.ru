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

<br>
        <form class="my-form">
            <div class="form-group">
                <label for="pass"> Пароль </label>
                <input type="password" name="pass" id="password" class="form-control">
            </div>
            <div class="form-group">
                <a href="#" onclick="return false" id="s-h-pass">Показать пароль</a>
            </div>
        </form>

        <form class="my-form">
            <div class="form-group">
              <label for="passrepeat"> Повторите пароль </label>
              <input type="password" name="passrepeat" id="passrepeat" class="form-control">
            </div>
            <div class="form-group">
                <a href="#" onclick="return false" id="s-h-pass-repeat">Показать повтор пароля</a>
            </div>
        </form>


        <div class="alert alert-danger mt-2" id="errorBlock"> </div>

        <button type="button" id="reg_user" class="btn btn-success mt-3">
          Зарегистрироваться
        </button>
</form>
    </div>

    <?php require 'block/aside.php'; ?>

    <?php require 'block/footer.php'; ?>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script>
        $( document ).ready(function() {
            $('#s-h-pass').click(function(){
                var type = $('#password').attr('type') == "text" ? "password" : 'text',
                 c = $(this).text() == "Скрыть пароль" ? "Показать пароль" : "Скрыть пароль";
                $(this).text(c);
                $('#password').prop('type', type);
            });

            $('#s-h-pass-repeat').click(function(){
                var type = $('#passrepeat').attr('type') == "text" ? "password" : 'text',
                 c = $(this).text() == "Скрыть повтор пароля" ? "Показать повтор пароля" : "Скрыть повтор пароля";
                $(this).text(c);
                $('#passrepeat').prop('type', type);
            });
        });


    </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script>


    $('#reg_user').click(function () {
      var nick = $('#username').val();
      var email = $('#email').val();
      var masterplayer = $('#masterplayer').val();
      var character = $('#character').val();
      var contact = $('#contact').val();
      var pass = $('#pass').val();
  var passrepeat = $('#passrepeat').val();

      $.ajax({
        url:'ajax/reg.php',
        type: 'POST',
        cache:false,
        data:{'username' : nick, 'email' : email, 'masterplayer' : masterplayer, 'character' : character, 'contact' : contact, 'pass': pass,  'passrepeat': passrepeat },
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
