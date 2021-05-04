<?php

  // Include database file
  include 'database.php';

  $taskObj = new Task();

  // Insert Record in task table
  if(isset($_POST['submit'])) {
    $taskObj->insertData($_POST);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>TO-DO LIST</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<body>

<div class="card text-center" style="padding:15px;">
  <h4>TO-DO LIST</h4>
</div><br> 

<div class="container">
  <form action="add.php" method="POST">
    <div class="form-group">
      <label for="$post">Task:</label>
      <input type="text" class="form-control" name="task" placeholder="Enter task" required="">
    </div>

    <div class="form-group">
      <label for="description">Description:</label>
      <input type="text" class="form-control" name="description" placeholder="Enter description" required="">
    </div>
    
    <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>