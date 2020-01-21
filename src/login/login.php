<?php
session_start();
if(!isset($_SESSION['backurl']) && isset($_SERVER['HTTP_REFERER'])){
$_SESSION['backurl'] = $_SERVER['HTTP_REFERER']; //this allows the login page to redirect the user after the checks have been made.
} else {
  $_SESSION['backurl'] = "http://unn-w17019458.newnumyspace.co.uk/year2/admin/admin.php"; //if user accesses restricted page from an external url.
}
 ?>
 <!DOCTYPE html>
 <html lang="en" xmlns="http://www.w3.org/1999/xhtml">
   <head>
     <link rel="stylesheet" href="../stylesheet/main.css"/> <!-- Links to the external stylesheet -->
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
     <meta charset="utf-8">
     <title>Login</title>
   </head>
   <body>
     <nav>
      <ul>
        <li> <a href="../home/index.php">Home</a> </li>
        <li> <a href="../admin/admin.php">Admin</a> </li>
        <li> <a href="../orders/orderRecordsForm.php">Records</a> </li>
        <li> <a href="../credits/credits.php">Credits</a> </li>
      </ul>
    </nav>
     <div id="wrapper">
       <h1>Login</h1>
       <?php if (isset($_SESSION['message'])): ?>
         <div class="msg">
        <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
         ?>
      </div>
       <?php endif ?>
       <form id="login" action="user_check.php" method="post">
         <div class="input-group">
           <label for="username">Username</label>
           <input type="text" name="username" value="">
         </div>
         <div class="input-group">
           <label for="password">Password</label>
           <input type="password" name="password" value="">
         </div>
         <div class="input-group">
           <button type="submit" name="login">Login</button>
         </div>
       </form>

     </div>

   </body>
 </html>
