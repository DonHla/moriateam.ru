<div>
 <main >
  <div class="row">

<?php  require 'block/leftmenu.php'; ?>
<!-- <div class="col-md-3 mb-1">
</div> -->
  <!-- <img class="col-md-3" src="/img/madam.png" alt="" width="300" height="625"> -->
    <div class="col-md-3 mb-1">
      <h4>Личный кабинет</h4>

      <?php
       require_once 'mysql_connect.php';
       $username = $_COOKIE['nickname'];
      require 'block/select_inf_player.php';
      require 'block/select_comment.php';
      ?>


    </div>
    <?php require 'block/aside.php'; ?>

    <?php require 'block/footer.php'; ?>
    </div>
   </main>
 </div>
