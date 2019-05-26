<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
<h5> <a class="my-0 mr-md-auto font-weight-normal p-2  text-dark"  href="/index.php">MoriaTeam</a></h5>
<?php
ini_set('display_errors','Off');
if($_COOKIE['nickname'] == ""):
?>
<a class="btn btn-outline-primary ml-5 mr-2 mb-2" id="btnEnter" href="/enter.php">Войти</a>
<a class="btn btn-outline-primary  mb-2" id="btnReg" href="/reg.php"> Регистрация </a>
<?php
  else:
?>
<a class="btn btn-outline-primary ml-5  mr-2 mb-2" id="btnPersAcc" href="/enter.php">Кабинет пользователя</a>
<button type="button" id="exit_btn" class="btn btn-outline-danger  mr-2 mb-2">
Выйти</button>

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
        location.replace("../enter.php");
    }
  });
});

</script>
