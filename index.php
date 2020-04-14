<?php
require "connect.php";
if(isset($_SESSION['loginUser'])):?>
<!DOCTYPE html>
  <html>
  <head>
    <title id="kross">АРМ КРОСС</title>
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/icon/raphaelicons/raphaelicons.css" type="text/css">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
   <!--  <link rel="stylesheet" href="/css/freenum.css" /> -->
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- <script src="/js/myjs.js"></script> -->
    <!-- <script src="/js/livereload.js"></script> -->

  </head>
  <body style="font-size: 0.8rem;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">KROSS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavList">
   <ul class="nav navbar-nav navbar-left"><li class="place navbar-form" id="area">
              <?php require_once 'list_area.php'; ?>
            </li></ul>
  </div>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#" onclick="fetchData(1)">Домой <span class="icon-wite">S</span><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./table/table.php" target="_blank">Таблицы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./log/log.php" target="_blank">Логи</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="openWin()">Таблица кабелей</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Справочник
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#" onclick="catalogOpen()"><span>Справочник телефонов</span></a>
          <a class="dropdown-item" href="#" onclick="edit_catalog()">Порядок отображения абонентов</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
           <li class="nav-item dropdown admin">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdminLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Admin
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownAdminLink">
          <a class="dropdown-item" href="#" onclick="usersConfig()">Настройка пользователей</a>

        </div>
      </li>
      

       <li class="nav-item">
        <a class="nav-link" href="#" onclick="exitKross()">Выход</a>
      </li>
    </ul>
  </div>
</nav>
<noscript>
      <p class="alert alert-danger">Необходимо включить JAVASCRIPT в настройках браузера</p>
</noscript>
<!-- <div class="container-fluid-xl images-tabl"><a href="#">Таблица кабелей<img src="./images/krjpg.jpg" alt="Flowers in Chania" ></a></div> -->
<!-- <a href="#"><img src="./images/krjpg.jpg" alt="Flowers in Chania" <img src="./images/krjpg.jpg" alt="Flowers in Chania" ></a> -->
<div class="container-fluid-xl p-1" id="search">

</div>
<!-- <button type="button" class="btn btn-info" onclick="gogo()">Start Script</button> -->
<div class="container-fluid-xl" id="content"></div>
<!--   <a href="#" title="Header" data-toggle="popover" data-placement="bottom" data-content="Content">Bottom</a>
  <a href="#" title="Header" data-toggle="popover" data-placement="left" data-content="Content">Left</a>
  <a href="#" title="Header" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Content">Right</a> -->


<div class="container-fluid" id="modalWindow"></div>
<div class="container-fluid" id="modalWindowCat"></div>

        <footer class="container-fluid text-left well">
          <div class="row">
          <div class="col-md-4"><h3>Контакты</h3><hr>
            Транзистор Кросс 3222<br />
            Мион Кросс 5133<br/>
            Дзержинка Кросс 5811<br/><br/>
          </div>
          <!-- <div class="col-md-4"><h3>Просмотры справочника</h3><hr>
           <?php include 'show_stats.php';?>
         </div> -->
         <div class="col-md-4 ml-auto"><h3>Работает</h3><hr><p id="login"><?php echo $_SESSION["login"];?></p>
          <p>IP: <?php echo $_SERVER["REMOTE_ADDR"]; ?></p></div>
          <div id="adm" hidden><?php echo $_SESSION["admin"];?></div><?php echo $hostname; ?>
</div>
          <div class="col-md-12 text-right" id="copywriteblock">ADragunov</div>
        </footer>
        

<!--         <script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
</script> -->
<div id="overlay" class="overlay">
          <!-- Button to close the overlay navigation -->
          <!-- <a href="javascript:void(0)" class="closebtn" onclick="off()">Закрыть подсказку</a> -->
          <button type="button" class="btn closebtn" id="closeAlertoverlay" onclick="off()">Закрыть подсказку</button>
          <div id="alertoverlay"></div>
        </div>




<script src="/js/myjs.js"></script>
 <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
      </body>
      </html>
     <!--  <?php
      //require('modal.php');
      ?> -->
    <?php else:?>
      <script>window.location="login.php";</script>

    <?php endif;?>
