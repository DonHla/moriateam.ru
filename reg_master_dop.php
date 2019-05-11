<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Дополнение для мастера';
   require 'block/head.php'; ?>
</head>
<body>
<?php require 'block/header.php'; ?>

<main class="container mt-5">
  <div class="row">
    <div class="col-md-8 mb-5">
      <h4>Форма регисрации</h4>
<form>


        <label for="timedate"> Введите время в и числа в которых вам удобно собирать игроков </label>
        <input type="timedate" name="timedate" id="timedate" class="form-control">

        <label for="freeornot"> Берёте ли вы плату? </label>
        <select id="timedate" name="timedate" class="form-control">
                     <option value="yes">Да</option>
                     <option value="no">Нет</option>
        </select>

        <?php
        require_once 'mysql_connect.php';
        $sql = 'SELECT * FROM `list_of_type_games`';
        $query = $pdo -> query($sql);
        $val_typeofgame = 1;
       echo '<label for="typeofgame"> Какие игры хотите проводить? </label>
       <select id="typeofgame" name="typeofgame" class="form-control">';
        while ($row = $query -> fetch(PDO::FETCH_OBJ)) {

       echo '<option value="'.$val_typeofgame.'">'. $row->name_of_tg .'</option>';
         $val_typeofgame = ++$val_typeofgame;
        }
       echo '</select>';
        ?>

        <label for="email"> Предложить свой тип игры </label>
        <input type="email" name="email" id="email" class="form-control">

        <?php
          $sql = 'SELECT * FROM `list_universe`';
          $query = $pdo -> query($sql);
          $val_universe = 11;
         echo '<label for="universe"> Какие игры хотите проводить? </label>
         <select id="universe" name="universe" class="form-control">';
          while ($row = $query -> fetch(PDO::FETCH_OBJ)) {

         echo '<option value="'.$val_universe.'">'. $row->name_of_universe .'</option>';
           $val_universe = ++$val_universe;
         }
         echo '</select>';
          ?>

        <label for="email"> Предложить свою вселенную </label>
        <input type="email" name="email" id="email" class="form-control">

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
