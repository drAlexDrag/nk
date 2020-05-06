$(document).ready(function(){
numberlive();
  });
function not_found(argument) {
  $.ajax({
    url:"not_found.php",
    method:"POST",
    data:{},
    dataType:"html",
    success:function(data)
    {
      $('#contentnf').html(data);
    },
    error:function(data)
    {

    }
  });
}
function numberlive() {
  var x = document.getElementById("numberli");
  var searchStrings=x.options[x.selectedIndex].text;
  // console.log(x.options[x.selectedIndex].text+" : "+x.options[x.selectedIndex].index);
  var paramPoisk="number";
var parameterSearch = "number";
  var searchString = searchStrings;
  $.ajax({
    url:"../search.php",
    method:"POST",
    data:{parameterSearch:parameterSearch, searchString:searchString},
    dataType:"html",
    success:function(data)
    {
      $('#contentn').html(data);
    },
    error:function(data)
    {

    }
  });
  $.ajax({
    url:"../poisk_select.php",
    method:"POST",
    data:{searchString:searchString, paramPoisk:paramPoisk},
    dataType:"html",
    success:function(data){
     $('#contentno').html(data);
   }
 });

}
//////Добавить отсутствующий номер ИМЯ берем и старой базы таблица sub
function add_number() {
  var x = document.getElementById("numberli");
  var number=x.options[x.selectedIndex].text;
  $.ajax({
    url:"add_number.php",
    method:"POST",
    data:{number:number},
    dataType:"html",
    success:function(data){
     $('#contentn').html(data);
   }
 });
}