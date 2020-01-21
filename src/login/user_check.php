<?php
session_start();
require '../PHP/connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['login'])) {
    //test username to protect agaisnt sql injections
    $username = test_input($_POST['username']);
    $sql = "SELECT * FROM nmc_users WHERE username=:user";
    $result = $dbconnect->prepare($sql);
    $result->execute([ ':user' => $username ]);
    if ($result->rowCount() == 0){ //user dosen't exist
      $_SESSION['message'] = "User dosen't exist";
      header("location: login.php");
    }
    else { //user exists
      $user = $result->fetch(PDO::FETCH_ASSOC);
      if (password_verify($_POST['password'], $user['passwordHash'])) {
        $_SESSION['username'] = $username;

        //This is how the server will know if the user is logged in
        $_SESSION['logged_in'] = true;
        header('Location:'.$_SESSION["backurl"]); //contains the url of the page that the user has came from and will be used in header when checks are done.
        unset($_SESSION["backurl"]);
      }
      else {
        $_SESSION['message'] = "Entered the wrong password, try again!";
        header("location: login.php");
      }
    }
  }
  else {
    //login was not set.
  }
} else {
 //method post was not used.
}
function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}





 ?>
