<div class="container box">
   <h1 align="center">Настройка пользователей</h1>
   <br />
   <div align="right">
    <button type="button" id="modal_button" class="btn btn-info">Добавить пользователя</button>
    <!-- It will show Modal for Create new Records !-->
   </div>
   <br />
   <div id="result" class="table-responsive"> <!-- Data will load under this tag!-->

   </div>
  </div>
  <script>
$(document).ready(function(){
 fetchUser(); //This function will load all data on web page when page load
 function fetchUser() // This function will fetch data from table and display under <div id="result">
 {
  var action = "Load";
  $.ajax({
   url : "/usersconfig/users_config.php", //Request send to "/usersconfig/users_config.php page"
   method:"POST", //Using of Post method for send data
   data:{action:action}, //action variable data has been send to server
   success:function(data){
    $('#result').html(data); //It will display data under div tag with id result
   }
  });
 }

 //This JQuery code will Reset value of Modal item when modal will load for create new records
 $('#modal_button').click(function(){
  $('#usersModal').modal('show'); //It will load modal on web page
  $('#login').val(''); //This will clear Modal first name textbox
  $('#password').val(''); //This will clear Modal last name textbox
  $('.modal-title').text("Добавить пользователя"); //It will change Modal title to Create new Records
  $('#action').text('Добавить пользователя');//Text button
  $('#action').val('Create'); //This will reset Button value ot Create
 });

 //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal
 $('#action').click(function(){
  var login = $('#login').val(); //Get the value of first name textbox.
  var password = $('#password').val(); //Get the value of last name textbox
  var id = $('#customer_id').val();  //Get the value of hidden field customer id
  var action = $('#action').val();  //Get the value of Modal Action button and stored into action variable
  var useradmin = $('select[name=useradmin]').val();
  if(login != '' && password != '') //This condition will check both variable has some value
  {
   $.ajax({
    url : "/usersconfig/users_config.php",    //Request send to "/usersconfig/users_config.php page"
    method:"POST",     //Using of Post method for send data
    data:{login:login, password:password, id:id, action:action, useradmin:useradmin}, //Send data to server
    success:function(data){
     alert(data);    //It will pop up which data it was received from server side
     $('#usersModal').modal('hide'); //It will hide Customer Modal from webpage.
     fetchUser();    // Fetch User function has been called and it will load data under divison tag with id result
    }
   });
  }
  else
  {
   alert("Both Fields are Required"); //If both or any one of the variable has no value them it will display this message
  }
 });

 //This JQuery code is for Update customer data. If we have click on any customer row update button then this code will execute
 $(document).on('click', '.update', function(){
  var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  var action = "Select";
  $('#action').val("Update");   //We have define action variable value is equal to select
  $.ajax({
   url:"/usersconfig/users_config.php",   //Request send to "/usersconfig/users_config.php page"
   method:"POST",    //Using of Post method for send data
   data:{id:id, action:action},//Send data to server
   dataType:"json",   //Here we have define json data type, so server will send data in json format.
   success:function(data){
    $('#usersModal').modal('show');   //It will display modal on webpage
    $('.modal-title').text("Изменить запись"); //This code will change this class text to Update records
    $('#action').text("Изменить запись");     //Text button
    $('#customer_id').val(id);     //It will define value of id variable to this customer id hidden field
    $('#login').val(data.login);  //It will assign value to modal first name texbox
    $('#password').val(data.password);  //It will assign value of modal last name textbox
   }
  });
 });

 //This JQuery code is for Delete customer data. If we have click on any customer row delete button then this code will execute
 $(document).on('click', '.delete', function(){
  var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  if(confirm("Вы точно хотите удалить этого пользователя?")) //Confim Box if OK then
  {
   var action = "Delete"; //Define action variable value Delete
   $.ajax({
    url:"/usersconfig/users_config.php",    //Request send to "/usersconfig/users_config.php page"
    method:"POST",     //Using of Post method for send data
    data:{id:id, action:action}, //Data send to server from ajax method
    success:function(data)
    {
     fetchUser();    // fetchUser() function has been called and it will load data under divison tag with id result
     alert(data);    //It will pop up which data it was received from server side
    }
   })
  }
  else  //Confim Box if cancel then 
  {
   return false; //No action will perform
  }
 });
});
</script>
<div id="usersModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Создаем нового пользователя</h4>
   </div>
   <div class="modal-body">
    <label>Имя пользователя</label>
    <input type="text" name="login" id="login" class="form-control" />
    <br />
    <label>Пароль</label>
    <input type="text" name="password" id="password" class="form-control" />
    <br />
    <div>
      <label>Права доступа</label><br />
  <select name="useradmin">
  <option value="0">Пользователь</option>
  <option value="1">Администратор</option>
</select>

</div>

   </div>
   <div class="modal-footer">
    <input type="hidden" name="customer_id" id="customer_id" />
    <!-- <input type="submit" name="action" id="action" class="btn btn-success" /> -->
    <button type="button" name="action" id="action" class="btn btn-success" data-dismiss="modal" value=""></button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
   </div>
  </div>
 </div>
</div>