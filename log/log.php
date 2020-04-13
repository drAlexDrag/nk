<!DOCTYPE html>
  <html>
  <head>
    <title id="kross">ЛОГ КРОСС</title>
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/icon/raphaelicons/raphaelicons.css" type="text/css">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
    <link rel="stylesheet" href="/css/datatables.min.css" />
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/datatables.min.js"></script>

  </head>
  <body style="font-size: 0.7rem;">
  	 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">KROSS
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="../index.php">Домой <span class="icon-wite">S</span><span class="sr-only">(current)</span></a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="loadLogKross()">Лог кросса</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="loadLogTables()">Лог таблиц</a>
      </li>
<!--       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Лог таблиц
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#" onclick="loadLogTables('raspred', 'Распределения')">Распределения</a>
          <a class="dropdown-item" href="#" onclick="loadLogTables('type')">Типы</a>
          <a class="dropdown-item" href="#" onclick="loadLogTables('unit')">Управления</a>
          <a class="dropdown-item" href="#" onclick="loadLogTables('department')">Отделы/бюро</a>
          <a class="dropdown-item" href="#" onclick="loadLogTables('sector')" hidden>Сектора</a>
          <a class="dropdown-item" href="#" onclick="loadLogTables('filial')">Филиалы</a>
          <a class="dropdown-item" href="#" onclick="loadLogTables('area')">Площадка</a>
        </div>
      </li> -->

    </ul>
  </div>
</nav>
  	<div class="container-fluid-xl" id="content"></div>
  	<script src="/js/log.js"></script>
  </body>
  </html>
