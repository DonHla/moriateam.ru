<div>
 <main >
  <div class="row">
<div class="col-md-2" id="div_under_lm">
<?php  require 'block/HacLeftmenu.php'; ?>
</div>

    <div class="col-md-8">
      <h4>Личный кабинет</h4>

      <?php
       // require_once 'mysql_connect.php';
      ?>
      <form>
        <div class="form-group row">
          <label for="inputQuestion" class="col-sm-2 col-form-label">Введите вопрос</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputQuestion" placeholder="Вопрос">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-danger">Отправить на обсуждение</button>
          </div>
        </div>
        <div class="form-group row">
        <label for="custom-select" class="col-sm-2 col-form-label">Выберете людей</label>
          <div class="col-sm-10">
            <select class="custom-select">
            <option selected>Список людей</option>
<!-- Выгрузка из бд списка людей -->
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-danger">Подтвердить выбор</button>
          </div>
        </div>
      </form>



</div>
    <div id="div_under_lm" class="col-md-2">
<?php  require 'block/HacTime.php'; ?>
    </div>

    <?php require 'block/HacFooter.php'; ?>
    </div>
   </main>
 </div>
