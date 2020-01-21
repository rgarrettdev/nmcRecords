<?php
session_start();
require '../PHP/connect.php';

// initialize variables
  $id="";
  $title = "";
  $Year = "";
  $publisher = "";
  $publisher_location = "";
  $category = "";
  $price = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['save'])) {
        if(!empty($_POST['recordID']) && !empty($_POST['recordTitle']) && !empty($_POST['recordYear']) && !empty($_POST['recordPublisher']) && !empty($_POST['recordCategory'])
        && !empty($_POST['recordPrice'])
          ){
            $id = test_input($_POST['recordID']);
            $title = test_input($_POST['recordTitle']);
            $year = test_input($_POST['recordYear']);
            $publisher = test_input($_POST['recordPublisher']);
            $category = test_input($_POST['recordCategory']);
            $price = test_input($_POST['recordPrice']);

            $sql = "UPDATE nmc_records SET recordTitle=:title, recordYear=:year,
             pubID=:publisher ,catID=:category ,recordPrice=:price WHERE recordID=:id ";

             $statement_insert = $dbconnect->prepare($sql);
             $statement_insert->execute(['title' => $title, 'year' => $year,
              'publisher' => $publisher, 'category' => $category, 'price' => $price,
              'id' => $id]);

             $_SESSION['message'] = "$title successfuly edited";
             header('location: admin.php');
          } else {
            $id = test_input($_POST['recordID']);
            $_SESSION['error'] = "All fields are required!";  //alerts user to fill in all fields
            header("location: edit.php?id=$id");
          }
        } else {

          }
        } else {

          }


          function test_input($data) {
          $data = trim($data);    
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }



 ?>
