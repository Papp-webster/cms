<?php

function imagePlaceholder($image = ''){
 if (!$image) {
   return 'img';
 } else {
   return $image;
 }
}


//secure
function escape($string) {
 global $connect;

 return mysqli_real_escape_string($connect, trim($string));
}


//users online
function users_online(){

  if(isset($_GET['onlineusers'])) {

  global $connect;
 if (!$connect) {

   session_start();
   include("../includes/db.php");
   $session = session_id();
   $time = time();
   $time_out_sec = 10;
   $time_out = $time - $time_out_sec;

   $query = "SELECT * FROM users_online WHERE session = '$session'";
   $send_query = mysqli_query($connect, $query);
   $count = mysqli_num_rows($send_query);

   if ($count == NULL) {
     mysqli_query($connect, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
   } else {
     mysqli_query($connect, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
   }

   $users_online_query = mysqli_query($connect, "SELECT * FROM users_online WHERE time > '$time_out' ");
   echo $count_user = mysqli_num_rows($users_online_query);

 }


  } // get request
}

function get_user_name(){
return isset($_SESSION['username']) ? $_SESSION['username'] : null;
 


}

users_online();

function query($query){
    global $connect;
    $result = mysqli_query($connect, $query);
    conFirm($result);
    return $result;
}

function is_admin($username) {
 
    if(isLoggedIn()){
    $result = query("SELECT user_role FROM users WHERE user_name = '$username'");
    conFirm($result);
    $row = mysqli_fetch_array($result);
    
   
     if ($row['user_role'] == 'admin') {
   
       return true;
   
     }else {
       return false;
     }
 }
 
}

function userName_exists($username) {
  global $connect;
  $query ="SELECT user_name FROM users WHERE user_name = '$username'";
  $result = mysqli_query($connect, $query);
   conFirm($result);

   if (mysqli_num_rows($result) > 0) {
     return true;

   } else {

     return false;
   }

}

function email_exists($email) {
  global $connect;
  $query ="SELECT user_email FROM users WHERE user_email = '$email'";
  $result = mysqli_query($connect, $query);
   conFirm($result);

   if (mysqli_num_rows($result) > 0) {
     return true;

   } else {

     return false;
   }

  }

   function register_user($username, $email, $password) {
    global $connect;

   /*if (empty($_POST["username"])) {
       $nameErr = "Name is required";
   } else {
     $username = test_input($_POST["username"]);
     // check if name only contains letters and whitespace
       if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
       $nameErr = "Only letters and white space allowed";
       }
   }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
     } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
  }
     }*/



      $username = mysqli_real_escape_string($connect, $username);
      $email = mysqli_real_escape_string($connect, $email);
      $password = mysqli_real_escape_string($connect, $password);


      $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

         $query = "INSERT INTO users(user_name, user_email, user_password, user_role) ";
         $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";
         $register_user_query = mysqli_query($connect, $query);
         conFirm($register_user_query);

      }

 //login
function login_user($username, $password) {

  global $connect;
  $username = trim($username);
  $password = trim($password);
  $username = mysqli_real_escape_string($connect, $username);
  $password = mysqli_real_escape_string($connect, $password);

  $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
  $select_user_query = mysqli_query($connect, $query);
  conFirm($select_user_query);

  while($row = mysqli_fetch_array($select_user_query )) {
     $db_id = $row['user_id'];
     $db_name = $row['user_name'];
     $db_pass = $row['user_password'];
     $db_firstname = $row['user_firstname'];
     $db_lastname = $row['user_lastname'];
     $db_role = $row['user_role'];
     $db_image = $row['user_image'];

     if (password_verify($password, $db_pass)) {
       $_SESSION['user_id'] = $db_id;
       $_SESSION['username'] = $db_name;
       $_SESSION['firstname'] = $db_firstname;
       $_SESSION['lastname'] = $db_lastname;
       $_SESSION['user_role'] = $db_role;
       $_SESSION['user_image'] = $db_image;

       redirect("/cms");

     } else {
       redirect("/cms");
     }

  }

 return true;

}

//helper

function conFirm($result) {

  global $connect;
  if (!$result) {
    die('Az adatbázis kapcsolat hibás! <br>' . mysqli_error($connect));
}




}
//kategóriák
function insert_categories(){

  global $connect;

  if(isset($_POST['submit'])) {
    $cat_cim = $_POST['cat_cim'];

    if($cat_cim == "" || empty($cat_cim)) {
      echo "Ez nem lehet üres!";
    } else {
        $stmt = mysqli_prepare($connect, "INSERT INTO kategoriak(cat_cim) VALUES(?) ");
        mysqli_stmt_bind_param($stmt, 's', $cat_cim);
        mysqli_stmt_execute($stmt);

        conFirm($stmt);
    }
 mysqli_stmt_close($stmt);
  }

}

function findAllcategories() {
global $connect;

$result = query("SELECT * FROM kategoriak");

while ($row = mysqli_fetch_assoc($result)) {
  $cat_id = $row['cat_id'];
  $cat_cim = $row['cat_cim'];

  echo "<tr>";
  echo "<th>{$cat_id}</th>";
  echo "<td>{$cat_cim}</td>";
  echo "<td><a href='categories.php?delete={$cat_id}'>Törlés</a></td>";
  echo "<td><a href='categories.php?update={$cat_id}'>Változtat</a></td>";
  echo "</tr>";
}
}

function deleteCategories() {
 global $connect;

   if(isset($_GET['delete'])){
    $d_cat_id = $_GET['delete'];
    query("DELETE from kategoriak WHERE cat_id = {$d_cat_id}");
    header("Location: categories.php");

  }
}
//kommentek
function UnApprove() {
global $connect;
$d_comment_id = escape($_GET['elutasítva']);
query("UPDATE comments SET comment_status = 'elutasítva' WHERE comment_id = $d_comment_id");
header("Location: comments.php");
}

function Approve() {
global $connect;
$d_comment_id = escape($_GET['elfogadva']);
query("UPDATE comments SET comment_status = 'elfogadva' WHERE comment_id = $d_comment_id");
header("Location: comments.php");
}

// admin panel értékek
function recordCount($table){
  $result=query("SELECT * FROM " . $table);
  return  mysqli_num_rows($result);

}

function checkStatus($table,$column,$status) {
  $result=query("SELECT * FROM $table WHERE $column = '$status'");
  return mysqli_num_rows($result);
}

function checkUserRole($table, $column, $role) {
  $result=query("SELECT * FROM $table WHERE $column = '$role'");
  return mysqli_num_rows($result);
}
// ===== DATABASE HELPER FUNCTIONS ====

function redirect($location){
  header("Location:" . $location);
  exit;
}

function ifItIsMethod($method=null){
  if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

    return true;

  }
  return false;
}

function isLoggedIn(){
  if(isset($_SESSION['user_role'])){
    return true;
  }
  return false;
}

function loggedInUserId(){
    if(isLoggedIn()){
      $result = query("SELECT * FROM users WHERE user_name='" . $_SESSION['username'] ."'");
      $user = mysqli_fetch_array($result);
      conFirm($result);
      return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;
     
    }
    return false;
}

function userLiked($post_id){
$result = query("SELECT * FROM likes WHERE user_id=" .loggedInUserId() . " AND post_id={$post_id}");
return mysqli_num_rows($result) >= 1 ? true : false;

}

function getLiked($post_id){
  $result= query("SELECT * FROM likes WHERE post_id=$post_id");
  conFirm($result);
  echo mysqli_num_rows($result);
}


function checkIfuserLoggedIn($redirectLocation=null){
  if(isLoggedIn()){

    redirect($redirectLocation);

  }
}

?>
