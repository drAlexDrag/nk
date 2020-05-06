<?php
require "../connect.php";
if(isset($_SESSION['loginUser'])):?>
  <!DOCTYPE html>
  <html>
  <head>
    <title id="kross">Сверка</title>
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
<h1>Сверка по номерам</h1>
<div class="container-fluid-xl">
<form class="navbar-form navbar-left numberphone">
<!--   <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#container_k">Показать карточку абонента</button> -->
  <div class="form-group">
<?php
// //$phonetype=$_POST["phonetype"];
// $output = '';
// $number=R::getCol('SELECT ncatalog_number FROM ncatalog ORDER BY id');
// $numOfnumber = R::count( 'ncatalog' );
// $output = '<select class="form-control" style="min-width: 20vw" name="numberli" id="numberli" onchange="numberlive()">';
//  foreach ($number as $row => $number ){
//   // $output .= '<option value="'.$row.'" >'.$number.'</option><br>';
//   $output .= '<option value="'.$row.'" >'.$number.'</option><br>';
//  }
// $output .= '</select>';
// echo $output;
// echo('<p id="numOfnumber" hidden>'.$numOfnumber.'</p>');

/////////////Выводим отсутствующие в справочнике номера///////////////////////
$out='';
$out= '<select class="form-control" style="min-width: 20vw" name="numberli" id="numberli" onchange="numberlive()">';
$number_c=R::getAll('SELECT DISTINCT number, id FROM krossdata WHERE number<>""  ORDER BY id');
$i=0;
foreach ($number_c as $row) {
  // $out.= ($row["number"].'--id--'.$row["id"].'<br>');
  $ppp=R::getAll('SELECT ncatalog_number FROM ncatalog WHERE ncatalog_number=?', [$row["number"]]);
  if($ppp!=null){}
    else{
      $i++;
      // $out.= ($row["number"].'--id--'.($row["id"]).'<br>');
      $out .= '<option value="'.$i.'" >'.$row["number"].'</option><br>';
    }
}
$out .= '</select>';
echo $out;

    ?>
  </div>
<div class="form-group">
  <button style="width: 100px; text-align: left;" class="btn btn-default" type="button"><span class="icon" id="numcountdown">:</span></button>
  <button style="width: 100px; text-align: left;" class="btn btn-default" type="button"><span class="icon" id="numcountup">9</span></button>
      <!-- <span style="width: 100px; text-align: center;" class="glyphicon glyphicon-more" id="more"></span> -->
      
</div>
<!-- <span class="badge" id="numcount"></span> -->

  </form>
</div>



<script type="text/javascript">
  (function ($) {
  $('.numberphone .btn:first-of-type').on('click', function() {
    $('#numberli').val( parseInt($('#numberli').val(), 10) + 1);
    if (($('#numberli').val())===null){$('#numberli').val("0");}
    // $('#numcountdown').text($('#numberli').val());
    // $('#numcountup').text($('#numberli').val());
    // $('#more').text($('#numberli').val());
    numberlive();
  });
  $('.numberphone .btn:last-of-type').on('click', function() {
    $('#numberli').val( parseInt($('#numberli').val(), 10) - 1);
    // alert($('#numOfnumber').text()-1);
    if (($('#numberli').val())===null){$('#numberli').val(($('#numOfnumber').text())-1);}
    // $('#numcountdown').text($('#numberli').val());
    // $('#numcountup').text($('#numberli').val());
    // $('#more').text($('#numberli').val());
    numberlive();
  });
})(jQuery);
</script>
<!-- <script type="text/javascript">
  
</script> -->
  <div class="container-fluid-xl" id="contentnew" style="font-size: 1rem; background-color: #FFFFE0; border-style: double; padding: 5px;"><h2>Новая</h2>
    <button type="button" class="btn btn-info" onclick="add_number()">Добавить номер</button><hr>
    <div class="container-fluid-xl" id="contentn"></div></div>
  <div class="container-fluid-xl" id="contentold" style="font-size: 1rem; background-color: #E0FFFF; border-style: double; padding: 5px;"><h2>Старая</h2><div class="container-fluid-xl" id="contentno"></div></div>
  <div class="container-fluid-xl" id="contentnotfound" style="font-size: 1rem; background-color: #E0FFFF; border-style: double; padding: 5px;"><h2>Отсутствуют в справочнике</h2><button type="button" class="btn btn-info" onclick="not_found()">Start Script</button><div class="container-fluid-xl" id="contentnf"></div></div>


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
      




<script src="/js/sv.js"></script>

</body>
</html>
<?php else:?>
  <script>window.location="login.php";</script>

<?php endif;?>
