<?php require_once '../connect.php';?>
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
<style>
	.fly {
  position: absolute;
  background-color: blue;
  width: 100%;
  height: 200px;
  /*left: 1%;*/
  /*top: 1%;*/
  z-index: 100;
}
</style>
<body style="font-size: 0.8rem;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

      <!-- <a class="navbar-brand" onclick="loadData(1)">Test</a> -->

  </nav>

<hr>

   <div class="container-fluid row"> <div class="col-sm-4" id="content">
    <!-- <iframe height="500px" width="100%" src="test_div.php" name="iframe_a"></iframe> -->
 <!-- <?php //require_once 'test_div.php';?> -->

  </div>
  <div class="col-sm-8" id="unitload">
    <!-- <iframe height="100%" width="50%" src="test_div.php" name="iframe_a"></iframe> -->
  </div>
</div>
<hr>


<script src="/js/test.js"></script>
</body>
</html>