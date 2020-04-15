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
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body style="font-size: 0.8rem;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <!-- Links -->
      <a class="navbar-brand" onclick="loadData(1)">Справочник телефонов ОАО "Интеграл"</a>
      <!-- <div class="collapse navbar-collapse">
  <ul class="navbar-nav">
         <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="download" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="download">
          <a download class="dropdown-item" href="../catalogPdf.php" onclick="countDownloads()"><img border="0" src="/images/pdf.png" alt="W3Schools" width="32" height="32"> PDF</a>
          <a download class="dropdown-item" href="../catalogWord.php" onclick="countDownloads()"><img border="0" src="/images/docx.png" alt="W3Schools" width="32" height="32"> WORD</a>
          
        </div>
      </li>
  </ul></div>
  <div class="collapse navbar-collapse">
  <form class="form-inline ml-auto" action="/action_page.php">
    <input class="form-control mr-sm-2" style="min-width: 30vw" type="text" placeholder="Поиск абонента по номеру или имени...">
    <button class="btn btn-success" type="submit">Поиск</button>
  </form></div> -->
  </nav>

  <?php
$ip=$_SERVER["REMOTE_ADDR"];
$hostname = gethostbyaddr ($ip);
?>
      <noscript>
      <p class="alert alert-danger">Необходимо включить JAVASCRIPT в настройках браузера<br>
Необходимо наличие установленного браузера:<br>
Chrome  версии 49 и выше<br>
Opera   версии 43 и выше<br>
Firefox версии 46 и выше<br>
Internet explorer 11 и выше<br></p>
</noscript>
<hr>
<!-- <hr><div class="container-fluid">
<button type="button" class="btn btn-info" onclick="authorityStart()">Зафиксировать</button>
    <button type="button" class="btn btn-info" onclick="authorityConfirm()">Подтвердить</button></div>
<hr> -->
    <div class="container-fluid" id="content">
<!-- <img id="loadImg" src="/images/load.gif" /> -->
<!-- <?php //require_once 'catalog_phone.php';?> -->

  </div>

<hr>


<script src="/js/ecatalog.js"></script>
</body>
</html>