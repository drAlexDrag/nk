<!DOCTYPE html>
  <html>
  <head>
    <title id="kross">ТАБЛИЦЫ</title>
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/icon/raphaelicons/raphaelicons.css" type="text/css">
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/mystyle.css" />
    <link rel="stylesheet" href="/css/datatables.min.css" />
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="/css/responsive.dataTables.min.css" />
    <!-- <link rel="stylesheet" href="/css/dataTables.searchPane.min.css" /> -->
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/datatables.min.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.responsive.min.js"></script>
    <!-- <script src="/js/dataTables.searchPane.min.js"></script> -->
    <!-- <script src="/js/dataTables.bootstrap4.min.js"></script> -->

  </head>
  <body>
    <!-- <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button> -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../index.php">KROSS
    
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
     <!--  <li class="nav-item active">
        <a class="nav-link" href="../index.php">Домой <span class="icon-wite">S</span><span class="sr-only">(current)</span></a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="editNumber()">Номера</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="editRaspred()">Распредедение</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="editType()">Типы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="editUnit()">Управления</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="editDepartment()">Отделы/Бюро</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="editSector()">Сектора</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="editFilial()">Филиалы</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="editArea()">Площадки</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="openWin()">Таблица кабелей</a>
      </li>
<!--       <li class="nav-item">
        <a class="nav-link" href="#" onclick="testnum()">testnum</a>
      </li> -->

    </ul>
  </div>
</nav>
<!-- <button onclick="openWin()">Open "myWindow"</button>
<button onclick="closeWin()">Close "myWindow"</button> -->
<!-- <iframe srcdoc="<p>edefef</p>" style="top:50px;height:50px;width:100%"></iframe> -->
<!-- <div class="container-fluid-xl images-tabl"><a href="#">Таблица кабелей<img src="../images/krjpg.jpg"></a></div>-->
<div id="alert_message"></div> 
 <!-- <div class="alert alert-warning alert-dismissible" id="alert_message">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    
  </div> -->
<div class="container-fluid" id="content">
   <h1>Необходимо выбрать таблицу для редактирования</h1>
  </div>
<div class="container-fluid" id="modalWindow"></div>
  <script src="/js/table.js"></script>
  <!-- <script src="/js/all.js"></script> -->
<!--    <script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script> -->
</body>
</html>
