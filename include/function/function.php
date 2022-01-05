<?php
// Page Function: can use this page for implementation Query MYsql
/*
-function fetch_data :Returns data from Database based on admin_or_employee
--receive function parmeter : admin_or_employee (1,0)
*/
 function fetch_data($condtion){
     global $conn;
     $sql    = "SELECT * FROM employee WHERE admin_or_employee=$condtion";
     $result = mysqli_query($conn, $sql);
     $rows  = mysqli_fetch_all($result,MYSQLI_ASSOC);
     if(mysqli_num_rows($result)>0){
            return $rows;

     }else{
         echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
         <strong>0 results!</strong> 
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>';
     }
 }

 /*
-function fetch_data_condation :Returns data from Database based on condation 
-receive function parmeter : username,password,admin_or_employee
*/
 function fetch_data_condation($username,$password,$admin_or_employee){
    global $conn;
    $sql    = "SELECT username, password FROM employee WHERE username = '$username' AND password = '$password' AND admin_or_employee = $admin_or_employee ";
    $result = mysqli_query($conn, $sql);
    echo mysqli_num_rows($result);
    if(mysqli_num_rows($result)>0){
      return true;
    }else{
      echo '<div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
      <strong>0 results!</strong> 
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
      return false;
      
    }
}
/*
-function insert_data :This function adds a new employee 
-receive function parmeter : username,password,admin_or_employee
*/
function insert_data($username,$password,$admin_or_employee){
  global $conn;
  $sql = "INSERT INTO employee (username, password,admin_or_employee)
VALUES ('$username', '$password', '$admin_or_employee')";

if (mysqli_query($conn, $sql)) {
  echo '<div class="alert alert-success alert-dismissible fade show  mt-5" role="alert">
  <strong>successfully</strong> New record created successfully
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
} else {
  echo '<div class="alert alert-danger alert-dismissible fade show  mt-5" role="alert">
  <strong>Error:</strong>The username cannot be repeated because it is unique
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> ' ;
}

}
/*
-function update_data :This function is to modify the data of an employee stored in Database based on id employee
-receive function parmeter : username,password,id
*/
function update_data($username,$password,$id){
  global $conn;
  $sql= "UPDATE employee set username = '$username', password ='$password' WHERE id =$id ";
  if (mysqli_query($conn, $sql)) {
  echo '<div class="alert alert-success alert-dismissible fade show  mt-5" role="alert">
  <strong>successfully</strong> Update record successfully
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> ';
} else {
  echo '<div class="alert alert-danger alert-dismissible fade show  mt-5" role="alert">
  <strong>Error:</strong>The username cannot be repeated because it is unique
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> ' ;}


}

/*
-function delete_data :This function is to delete the data of an employee stored in Database based on id employee
-receive function parmeter : id
*/
function delete_data($id){
  global $conn;
  $sql= "DELETE FROM employee WHERE id =$id ";
  if (mysqli_query($conn, $sql)) {
  echo '<div class="alert alert-success alert-dismissible fade show  mt-5" role="alert">
  <strong>successfully</strong> Update record successfully
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> ';
}
}
