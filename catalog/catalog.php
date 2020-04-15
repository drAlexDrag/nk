<?php include 'count.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Справочник телефонов ОАО "Интеграл"</title>
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/icon/raphaelicons/raphaelicons.css" type="text/css">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
 
</head>
<body>
  <!-- <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button> -->

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <!-- Links -->
      <a class="navbar-brand" onclick="loadData(1)">Справочник телефонов ОАО "Интеграл"</a>
      <div class="collapse navbar-collapse">
  <ul class="navbar-nav">
    <!-- <li class="nav-item">
      <a class="nav-link" href="#">Link 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 3</a>
    </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="download" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Скачать
        </a>
        <div class="dropdown-menu" aria-labelledby="download">
          <a download class="dropdown-item" href="../catalogPdf.php" onclick=" countDownloads()"><img border="0" src="/images/pdf.png" alt="W3Schools" width="32" height="32"> PDF</a>
         <!--  <a download class="dropdown-item" href="../catalogWord.php" onclick="countDownloads()"><img border="0" src="/images/docx.png" alt="W3Schools" width="32" height="32"> WORD</a> -->
          
        </div>
      </li>
  </ul></div>
  <div class="collapse navbar-collapse">
  <form class="form-inline ml-auto" onsubmit="searchNumber(); return false;">
    <input class="form-control mr-sm-2" style="min-width: 30vw" type="text" placeholder="Поиск по номеру, имени, кабинету..." name="searchString" id="searchString">
    <button class="btn btn-success" type="submit">Поиск</button>
  </form></div>
  </nav>
  <?php
$ip=$_SERVER["REMOTE_ADDR"];
$hostname = gethostbyaddr ($ip);
?>

<div class="container-fluid">
  <div class="row">
<div class="col-sm-3 preclass">
<pre class="preclass">
Пожарная часть  1-01, 32-07
Медпункт «ЗПП» 57-13
Медпункт «Транзистор»  31-55
</pre>
</div>
<div class="col-sm-3 preclass">
<pre class="preclass">
Пульт ОПС «ЗПП» 33-22
Пульт ОПС «Транзистор» 25-00
Пульт ОПС «Мион» 58-08
</pre>
</div>
<div class="col-sm-3 preclass">
<pre class="preclass">
АТС «ЗПП» 58-11
АТС «Транзистор» 32-22
АТС «Мион» 51-33
</pre>
</div>
<div class="col-sm-3 preclass">
<pre class="preclass">
Дежурный ОАО «ИНТЕГРАЛ»  69-04
Дежурный «Транзистор»  25-25
Дежурный энергетик 61-00, 34-44, 22-00
</pre>
</div></div>
</div>

<hr>
 
      <noscript>
      <p class="alert alert-danger">Необходимо включить JAVASCRIPT в настройках браузера<br>
Необходимо наличие установленного браузера:<br>
Chrome  версии 49 и выше<br>
Opera   версии 43 и выше<br>
Firefox версии 46 и выше<br>
Internet explorer 11 и выше<br></p>
</noscript>
<!-- </div> -->
<!-- <hr> -->


    <div class="container-fluid" id="content">
<!-- <img id="loadImg" src="/images/load.gif" /> -->
<?php
require_once 'catalog_phone.php';?>

  </div>

</div>
<hr>
<footer class="container-fluid text-left well">
  <div class="row">
  <div class="col-md-4"><h3>Контакты</h3>
  Транзистор Кросс 3222<br>
  Мион Кросс 5133<br>
  Дзержинка Кросс 5811<br>
</div>
<div class="col-md-4"></div>
<div class="col-md-4"><h4>Для работы со справочником</h4>
Необходимо наличие установленного браузера:<br>
Chrome  версии 49 и выше<br>
Opera   версии 43 и выше<br>
Firefox версии 46 и выше<br>
Internet explorer 11 и выше<br></div>

</div>
<div class="col-md-12 text-right" id="copywriteblock">ADragunov</div>

</footer>

<!-- <?php
// require('catalog_modal.php');
// require('myAlert-modal.php');
?> -->
<div class="modal fade" id="myMessange" tabindex="-1" role="dialog" aria-labelledby="myAlertLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myMessangeLabel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="myMessangeBody">
      <div class="alert alert-danger">
Версия справочника является тестовой<br>
Возможно наличие ошибок по информации содержащейся в справочнике<br>
Возможно наличие ошибок в интефейсе пользователя<br>
Организационные структуры подразделений можно направлять по адресам:
ABelov@integral.by &nbsp; Белов, Александр<br>
ADragunov@integral.by &nbsp; Драгунов, Александр<br>
        <div class="alert alert-info">Запросы на изменение информации в справочнике обрабатываются по мере поступления</div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<script src="/js/catalog.js"></script>
<script src="/js/all.js"></script>
</body>
</html>