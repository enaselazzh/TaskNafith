<?php 
session_start();
if(isset($_SESSION['username'])){
  header('location:index.php');
  exit();
}
require_once 'tamplate/header.php';
require_once 'config.php';
require_once 'include/function/function.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $username = $_POST['uasrname'];
    $pass     = $_POST['pass'];
    $hash_pass = sha1($pass);//It encrypts the password to be stored
    if(!empty($username) && !empty($pass)){
      if(fetch_data_condation($username,$hash_pass,1)){ //1 indicates that Admin
        $_SESSION['username'] = $username;// session recording
        header('location:index.php');
        exit();
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

?>
<div class="container">
<div class="login d-flex justify-content-center align-items-center">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method ="POST" >
<h2 class="text-center">Login</h2>
  <div class="form-group">
    <label for="uasrname">Username</label>
    <input type="text" class="form-control" id="uasrname" name="uasrname">
  </div>
  <div class="form-group">
    <label for="Password">Password</label>
    <input type="password" class="form-control" id="Password" name="pass" >
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
<?php 
require_once 'tamplate/footer.php';

?>