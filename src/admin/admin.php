<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
  header("location: ../login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" href="../stylesheet/main.css"/> <!-- Links to the external stylesheet -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta charset="utf-8"/>
  <title>Admin</title>
</head>
<body>
    <?php
    require '../PHP/connect.php';
    $sql = "SELECT recordID, recordTitle, recordYear, cat.catDesc, recordPrice FROM nmc_records AS rec INNER JOIN nmc_category as cat ON rec.catID = cat.catID ORDER BY recordTitle";
    $statement = $dbconnect->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_OBJ);
     ?>
         <nav>
       		<ul>
       			<li> <a href="../home/index.php">Home</a> </li>
       			<li> <a href="admin.php">Admin</a> </li>
            <li> <a href="../orders/orderRecordsForm.php">Records</a> </li>
       			<li> <a href="../credits/credits.php">Credits</a> </li>
           <?php
             echo "<li style='float:right'>";
             echo "<a href='../login/logout.php'>";
             echo $_SESSION['username'];
             echo ":  Log out</a>";
             echo "</li>";
            ?>
          </ul>
        </nav>
        <div id="wrapper">
         <?php if (isset($_SESSION['message'])): ?>
       <div class="msg">
         <?php
           echo $_SESSION['message'];
           unset($_SESSION['message']);
         ?>
       </div>
         <?php endif ?>
         <div class="responsiveTable">
           <table>
             <tr>
               <th>id</th>
               <th>Title</th>
               <th>Year</th>
               <th>Category</th>
               <th>Price</th>
             </tr>
             <?php foreach ($records as $record): ?>
             <tr>
               <td><?php echo $record->recordID; ?></td>
               <td>
                 <a href="edit.php?id=<?= $record->recordID ?>"><?php echo $record->recordTitle;  ?></a></td>
               <td><?php echo $record->recordYear;  ?></td>
               <td><?php echo $record->catDesc; ?></td>
               <td><?php echo $record->recordPrice;  ?></td>
             </tr>
           <?php endforeach; ?>

           </table>

         </div>
     </div>
   </body>
</html>
