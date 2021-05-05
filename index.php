<?php
  
  // Include database file
  include 'database.php';

  $taskObj = new Task();

    // Insert Record in task table
    if(isset($_POST['submit'])) {
      $taskObj->insertData($_POST);
    }

  // Delete record from table
  if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
      $deleteId = $_GET['deleteId'];
      $taskObj->deleteRecord($deleteId);
  }

    // Edit task record
    if(isset($_POST['editId']) && !empty($_POST['editId'])) {
      $editId = $_POST['editId'];
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
</head>

<style>

</style>


<body>
<br>
<div class="container">
  <div class="row">


    <div class="container col-md-4 mr-5">
    <div class="card p-4">
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
    </div>

    <div class="container col-md-7">
      <h2>View To Do List</h2>

      <a href="trash.php">Trash Bins</a>

    
        <?php 
        $newTask = $taskObj->displayData(); 
          foreach ($newTask as $task) {
        ?>
      <div class="card mb-4">
        <h5 class="card-header"><?php echo $task['task'] ?></h5>
        <div class="card-body">
          <h5 class="card-title"><?php echo $task['description'] ?></h5>
          <div class="row float-right pr-4">
            <p class="card-text"><?php echo $task['created_at'] ?></p>&nbsp; &nbsp;
            <span style="color:green" data-toggle="modal" data-target="#editModal" name="editId"><i class="fa fa-pencil" aria-hidden="true"></i></span>&nbsp
            <a href="index.php?deleteId=<?php echo $task['id'] ?>" style="color:red"><i class="fa fa-trash" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
        <?php } ?>
    </div>
  </div>

<!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="" method="POST" class="p-4">
          <div class="form-group">
            <label for="task">Task:</label>
            <input type="text" class="form-control" name="utask" value="<?php echo $newTask['task']; ?>" required="">
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" name="udesc" value="<?php echo $newTask['description']; ?>" required="">
          </div>
          <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $newTask['id']; ?>">
            <button type="submit" name="update" class="btn btn-primary" style="float:right;">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>