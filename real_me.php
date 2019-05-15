<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
   $website_title = 'Личный кабинет';
   require 'block/head.php'; ?>
</head>
<body>
<?php
 require_once 'mysql_connect.php';
 $username = $_COOKIE['nickname'];
 $sql = 'SELECT p.*, l.name_of_level_player FROM `player` p  INNER JOIN `level` l
ON p.id_level = l.id_level WHERE `nick` = :nick';
 $query = $pdo->prepare($sql);
 $query->execute(['nick'=> $username]);
 $row = $query -> fetch(PDO::FETCH_OBJ);

?>

<?php require 'block/header.php'; ?>

  <div class="row">
<?php require 'block/leftmenu.php'; ?>
    <div class="col-md-6 mb-5">

      <h4>Личная информация</h4>
<form>

        <label for="username"> Ваш Ник </label>
        <input type="text" value="<?=$row->nick?>"  name="username" id="username" class="form-control">

        <label for="level"> Уровень </label>
        <input type="text" value="<?=$row->name_of_level_player?>"  name="level" id="level" class="form-control">

        <label for="email"> Почта </label>
        <input type="email" value="<?=$row->e_mail?>" name="email" id="email" class="form-control">

<label for="masterplayer"> Роль в игре </label>
<?php
if ($row->id_position=="5"){
  echo '<select id="masterplayer" name="masterplayer" class="form-control">
               <option value="master">Мастер</option>';
}
elseif ($row->id_position=="3") {
echo '<select id="masterplayer" name="masterplayer" class="form-control">
               <option value="player">Игрок</option>';
}
?>

        </select>

        <label for="character"> Ваша характеристика </label>
        <input type="text" value="<?=$row->about_yourself?>"  name="character" id="character" class="form-control">

        <label for="contact"> Контакты (ВК, Discord) </label>
        <input type="text"  value="<?=$row->contact?>" name="contact" id="contact" class="form-control">

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

        <div class="alert alert-danger mt-2" id="errorBlock3"> </div>

        <button type="button" id="change_me" class="btn btn-success mt-3 mb-3 mr-2">
          Изменить
        </button>

        <button type="button" id="" class="btn btn-warning mt-3 mr-2 mb-3">
          Изменить пароль
        </button>

    <div>
        <label for="comment" > Отзывы о вас </label>
        <textarea  value= "" name="comment" id="comment" class="form-control"> </textarea>

        <button type="button" id="" class="btn btn-success mt-3 mr-2">
          Перейти на профиль автора
        </button>

        <button type="button" id="" class="btn btn-warning mt-3 mr-2">
          Пожаловаться
        </button>

    </div>
</form>
    </div>

    <?php require 'block/aside.php'; ?>

    <?php require 'block/footer.php'; ?>

    <script>
    $('#change_me').click(function () {
      var nick = $('#username').val();
      var email = $('#email').val();
      var character = $('#character').val();
      var contact = $('#contact').val();

      $.ajax({
        url:'ajax/real_me.php',
        type: 'POST',
        cache:false,
        data:{'username' : nick, 'email' : email,'character' : character, 'contact' : contact},
        dataType: 'html',
        success: function(data){
        if(data == 'готово'){
          $('#change_me').text('Всё готово');
          $('#errorBlock3').hide();
          }
        else {
            $('#errorBlock3').show();
            $('#errorBlock3').text(data);
          }
        }
      });
    });
    </script>

</body>
</html>
