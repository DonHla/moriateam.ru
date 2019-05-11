<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
<h5 class="my-0 mr-md-auto font-weight-normal">MoriaTeam</h5>
<nav class="my-2 my-md-0 mr-md-3">
  <a class="p-2 text-dark" href="/test.php">Главная</a>
  <a class="p-2 text-dark" href="#">Что такое D&D?</a>
  <a class="p-2 text-dark" href="#">Кто мы такие? </a>
  <a class="p-2 text-dark" href="#">Кто что это за ресурс? </a>
  <a class="p-2 text-dark" href="#">Что мы делаем?</a>
</nav>
<?php
ini_set('display_errors','Off');
if($_COOKIE['nickname'] == ""):
?>
<a class="btn btn-outline-primary mr-2 mb-2" href="/enter.php">Войти</a>
<a class="btn btn-outline-primary mb-2" href="/reg.php"> Регистрация </a>
<?php
  else:
?>
<a class="btn btn-outline-primary mr-2 mb-2" href="/enter.php">Кабинет пользователя</a>
<button type="button" id="exit_btn" class="btn btn-outline-danger mr-2 mb-2">
Выйти</button>

<?php
  endif;
?>
</div>
