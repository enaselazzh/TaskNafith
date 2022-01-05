<?php 
session_start();
if(isset($_SESSION['username'])){
require_once 'tamplate/header.php';
require_once 'config.php';
require_once 'include/function/function.php';
// If you click on add an employee, this code will be executed
if(isset($_POST['new_employee'])){
if($_SERVER['REQUEST_METHOD']=="POST"){
  $username = $_POST['username'];
  $pass     = $_POST['password'];
  $admin_or_employee = $_POST['admin_or_employee'];
  $hash_pass = sha1($pass);// It encrypts the password to be stored
  if(!empty($username) && !empty($pass)){
      if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%*&]{8,}$/', $pass)) {
        echo '<div class="alert alert-danger alert-dismissible fade show  mt-5" role="alert">
        <strong>Password:</strong> <br>
        -May contain letter and numbers<br>
        -Must contain at least 1 number and 1 letter<br>
       - May contain any of these characters: !@#$%<br>
       - Must be 8 characters
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }else{
       insert_data($username,$hash_pass,$admin_or_employee);
    }
  }else{
    echo '<div class="alert alert-danger alert-dismissible fade show  mt-5" role="alert">
    <strong>Fields!</strong> cannot be left blank.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
}
}

// If you click on update an employee, this code will be executed
if(isset($_POST['update'])){
if($_SERVER['REQUEST_METHOD']=="POST"){
  $id = $_POST['id'];
  $username = $_POST['username'];
  $pass     = $_POST['password'];
  $Old_pass = $_POST['Old_pass'];//If the password is not changed, the old password will remain
  $hash_pass = sha1($pass);//It encrypts the password to be stored
  if(empty($pass)){
    update_data($username,$Old_pass,$id);
    }else{
        if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%*]{8,}$/', $pass)) {
            echo '<div class="alert alert-danger alert-dismissible fade show  mt-5" role="alert">
            <strong>Password:</strong> <br>
            -May contain letter and numbers<br>
            -Must contain at least 1 number and 1 letter<br>
           - May contain any of these characters: !@#$%<br>
           - Must be 8 characters
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
           
        }else {
            update_data($username,$hash_pass,$id);
        }
      
    }
  }
}

?>
<div class="container">
<div class="card mt-5">
  <div class="card-header">
     Table Employees
</div>
  <div class="card-body">
  <div class="card-title">
<button type="button" class="btn btn-primary mt-5" data-toggle="modal" data-target="#new_user" data-whatever="@getbootstrap"><i class="fas fa-user-plus"></i>New Employee</button>
<div class="modal fade" id="new_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <div class="form-group">
            <label for="name" class="col-form-label">Username:</label>
            <input type="text" class="form-control" id="name" name="username">
          
           </div>
           <div class="form-group">
            <label for="pass" class="col-form-label">Password:</label>
            <input type="password" class="form-control" id="pass" name="password">
          </div>
          <div class="form-group">
          <label for="" class="col-form-label">Admin_Or_Employee:</label>
              <select name="admin_or_employee" class="form-control">
                <option value="1">Admin</option>
                <option value="0">Employee</option>
              </select>
          </div>
          </div>
          <span id="valid"> </span>
         <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="new_employee">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
    <div class="card-text">
      
    <table class="table mt-5">
    <thead class="thead-dark">
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">User Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
<?php

$data =fetch_data(0);
if(isset($data))
{ 
  // Since the database has no data, nothing appears
foreach(fetch_data(0) as $val){ //Returns data from Database
  echo' 
  <tbody>
    <tr>
      <th scope="row">1'.$val['id'].'</th>
      <td>'.$val['username'].'</td>
      <td>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#update_user'.$val['id'].'" data-whatever="@getbootstrap"><i class="fas fa-user-edit"></i>Update</button>
<div class="modal fade" id="update_user'.$val['id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update info Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="'. $_SERVER['PHP_SELF'].'" method="POST">
          <div class="form-group">
          <input type="hidden" value ="'.$val['id'].'" name="id">
            <label for="name" class="col-form-label">Username:</label>
            <input type="text" class="form-control" id="name" name="username" value ="'.$val['username'].'">
          </div>
          <div class="form-group">
            <label for="pass" class="col-form-label">Password:</label>
            <input type="hidden" value ="'.$val['password'].'" name ="Old_pass">
            <input type="password" class="form-control" id="pass" name="password">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="update">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<a href="delete.php?num='.$val['id'].'" class="btn btn-danger"><i class="fas fa-user-times"></i>Delete</a>
</td>
</tr>
</tbody>';
} }?>
</div>
</table>
</div>
</div>
</div>
<?php 
}else {
  header("location:login.php");
}
require_once 'tamplate/footer.php';

?>