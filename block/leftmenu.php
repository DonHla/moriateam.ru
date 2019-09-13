 <!-- <nav  class="col-md-2 mb-1" id="navpersacc" > -->
 <div class="col-md-4">

   <ul class="drop_vert_menu" id="navpersacc">


                 <li><a href="../enter.php" class="btn"> <h2><?=$_COOKIE['nickname']?>

                    <?php
                    if ($_COOKIE['position'] == 3) //значит игрок
                   echo '&#10086;';
                    else if ($_COOKIE['position'] == 5) //значит мастер
                   echo '&#9885;';
                    else echo 'Ошибка при выводе меню!';
                     ?>

                  </h2> </a></li>
                 <li><a href="../real_me.php" class="btn">Моё реальное я</a></li>
   			        <li><a href="#" class="btn">Мои игры</a>
   			            <ul>
   			                <li><a href="../games_next.php" class="btn">Грядущие</a></li>
   			                <li><a href="../games_now.php" class="btn">Длящиеся</a></li>
   			                <li><a href="../games_last.php" class="btn">Легенды сложены</a></li>
   			            </ul>
   			        </li>
   			        <li><a href="#" class="btn">Мои party</a>
                   <ul>
                       <li><a href="../my_party.php" class="btn">Составы команд</a></li>
                       <?php
                       if ($_COOKIE['position'] == 3) //значит игрок
                      echo ' <li><a href="../seatch.php" class="btn">Найти новые приключения</a></li>';
                       else if ($_COOKIE['position'] == 5) //значит мастер
                      echo '  <li><a href="../make_new_party_master.php" class="btn">Созвать новую команду авантюристов</a></li>';
                       else echo 'Ошибка при выводе меню!';
                        ?>
                   </ul>
                 </li>
                  <li><a href="../mail_for_admin.php" class="btn"> Внести свои предложения &#10001;</h2> </a></li>
   			    </ul>
             </div>
   			<!-- </nav> -->
