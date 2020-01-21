<?php
session_start();
session_destroy();  //Logs out the user
if (!empty($_SERVER['HTTP_REFERER'])){
  unset($_SESSION["backurl"]);
  header("Location: ".$_SERVER['HTTP_REFERER']); //Redirects user to the page they pressed log out
  exit;
}

else{
  header("location: login.php"); //Redirects user to login page
  exit;
}

 ?>
