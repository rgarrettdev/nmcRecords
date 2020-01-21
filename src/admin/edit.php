<?php session_start();
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
  <title>Edit</title>
</head>
<body>
  <div id="wrapper">
    <div class="container">
      <div class="logged-in">
        <a href="admin.php">Go back</a>
      </div>
      <div class="logged-in">
        <h1>Edit a Record</h1>
      </div>
      <div class="logged-in">
        <?php
          echo "<p>";
          echo "Logged in: ";
          echo $_SESSION['username'];
          echo " ";
          echo "<a href='../login/logout.php'>Log out</a>";
          echo "</p>";
         ?>
      </div>
    </div>
    <?php if (isset($_SESSION['error'])): ?>
   <div class="errormsg">
     <?php
       echo $_SESSION['error'];
       unset($_SESSION['error']);
     ?>
   </div>
   <?php endif ?>
   <?php
    require '../PHP/connect.php';
    $id = $_GET['id'];
    $sql = "SELECT recordID, cat.catID, pub.pubID, recordTitle, recordYear, pub.pubName, pub.location, cat.catDesc, recordPrice FROM nmc_records AS rec
     INNER JOIN nmc_category as cat ON rec.catID = cat.catID INNER JOIN nmc_publisher as pub ON rec.pubID = pub.pubID
     WHERE recordID=:id";
     //This gets the values for the form, the WHERE allows the query to filter to a specfic record via ID.
     $fetch_info = $dbconnect->prepare($sql);
     $fetch_info->execute([':id' => $id ]);
     $record = $fetch_info->fetch(PDO::FETCH_OBJ); //This fetches the information and stores it in record.
    ?>
      <div class="">
        <form id="update" action="update.php" method="post">
          <div class="input-group">
            <label for="recordID">Record ID</label>
            <input value="<?php echo $record->recordID; ?>" type="number" name="recordID" readonly>
          </div>
          <div class="input-group">
            <label for="recordTitle">Record Title</label>
            <input value="<?php echo $record->recordTitle; ?>" type="text" name="recordTitle" maxlength="75">
          </div>
          <div class="input-group">
            <label for="recordYear">Record Year</label>
            <input value="<?php echo $record->recordYear; ?>" type="number"  name="recordYear" min="1900" max="2019">
          </div>
          <div class="input-group">
            <label for="recordPublisher">Record Publisher</label>
            <select form="update" name="recordPublisher">
              <option value="<?php echo $record->pubID; ?>"><?php echo $record->pubName; ?></option>
              <?php
                        //this selects publisher of record
                $selectcat = "SELECT * from nmc_publisher";
                  try{
                    $category = $dbconnect->prepare($selectcat);
                    $category->execute();
                    $resultpub = $category->fetchAll();
                  }
                catch(Exception $ex){
                  $ex -> getMessage();
                }
                ?>
                <?php foreach ($resultpub as $output) {?>
                  <option value="<?php echo $output['pubID']; ?>"><?php echo $output["pubName"]; ?></option>
                <?php } ?>

            </select>
          </div>
          <div class="input-group">
            <label for="recordCategory">Record Category</label>
            <select form="update" name="recordCategory">
              <option value="<?php echo $record->catID; ?>"><?php echo $record->catDesc; ?></option>
              <?php
                        //this selects category of record.
                $selectcat = "SELECT * from nmc_category";
                  try{
                    $category = $dbconnect->prepare($selectcat);
                    $category->execute();
                    $resultcat = $category->fetchAll();
                  }
                catch(Exception $ex){
                  $ex -> getMessage();
                }
                ?>
                <?php foreach ($resultcat as $output) {?>
                  <option value="<?php echo $output["catID"]; ?>"><?php echo $output["catDesc"]; ?></option>
                <?php } ?>
            </select>
          </div>
          <div class="input-group">
            <label for="recordPrice">Record Price</label>
            <input value="<?php echo $record->recordPrice; ?>" type="number" name="recordPrice" step=".01" min="0.99" max="100">
          </div>
          <div class="input-group">
            <button type="submit" name="save">Update</button>
          </div>

        </form>

      </div>
  </div>




</body>
</html>
