<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="../stylesheet/main.css"/> <!-- Links to the external stylesheet -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Home</title>
    <script src="offers.js">
    </script>
    <script src="offersXML.js">

    </script>
  </head>
  <body>
    <nav>
  		<ul>
  			<li> <a href="../home/index.php">Home</a> </li>
  			<li> <a href="../admin/admin.php">Admin</a> </li>
  			<li> <a href="../orders/orderRecordsForm.php">Records</a> </li>
  			<li> <a href="../credits/credits.php">Credits</a> </li>
  			<?php
  			if (!isset($_SESSION['logged_in'])) {
  			echo"	<li style='float:right'> <a href='../login/login.php'>Login</a> </li>";		//displays if user is not logged in
  		} else {
  			echo "<li style='float:right'>";
  			echo "<a href='../login/logout.php'>";		//displays if user is logged in
  			echo $_SESSION['username'];
  			echo ":  Log out</a>";
  			echo "</li>";
  		}
  			 ?>
  		</ul>
  	</nav>
    <div id="wrapper">
      <div class="leftCol">
        <p>Offer non xml</p>
      </div>
      <aside id="offers" class="rightCol">
      </aside>
      <div class="leftCol">
        <p>Offer xml</p>
      </div>
      <aside id="XMLoffers" class="rightCol">
      </aside>
    </div>
  </body>
</html>
