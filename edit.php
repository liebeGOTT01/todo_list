<?php
  
  // Include database file
  include 'database.php';

  $taskObj = new Task();

  // Edit task record
  if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $newTask = $taskObj->displayRecordById($editId);
  }

  // Update Record in task table
  if(isset($_POST['update'])) {
    $taskObj->updateRecord($_POST);
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
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container w-50 p-5 mb-4">
  <h1 class="text-center glass-container text-white p-2 mt-5">Update Task</h1>
</div>
<div class="container addForm w-50 p-5">
  <form action="edit.php" method="post">
    <div class="form-group">
      <label for="task">Task:</label>
      <input type="text" class="form-control" name="utask" value="<?php echo $newTask['task']; ?>" required="">
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea type="text" class="form-control" name="udesc" value="<?php echo $newTask['description']; ?>" required=""></textarea>
    </div>
    <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $newTask['id']; ?>">
      <button type="submit" name="update" class="btn btn-primary float-right details">Update</button>
    </div>
  </form>
</div>
<div class="circle1"></div>
  <div class="circle2"></div>
  <div class="circle3"></div>
  <div class="circle4"></div>
  <div class="circle5"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>