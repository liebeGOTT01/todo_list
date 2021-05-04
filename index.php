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
  input[type=checkbox]:checked + .strikethrough{
  text-decoration: line-through;
}
</style>


<body>

<div class="card text-center" style="padding:15px;">
  <h4>TO-DO LIST</h4>
</div>
<br><br> 

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
      <?php
        if (isset($_GET['msg1']) == "insert") {
          echo "<div class='alert alert-success alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert'>&times;</button>
                  Your Registration added successfully
                </div>";
          } 
        if (isset($_GET['msg2']) == "update") {
          echo "<div class='alert alert-success alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert'>&times;</button>
                  Your Registration updated successfully
                </div>";
        }
        if (isset($_GET['msg3']) == "delete") {
          echo "<div class='alert alert-success alert-dismissible'>
                  <button type='button' class='close' data-dismiss='alert'>&times;</button>
                  Record deleted successfully
                </div>";
        }
      ?>
      <h2>View Records
        <a href="add.php" class="btn btn-primary" style="float:right;">Add New Record</a>
      </h2>

      <a href="trash.php">Trash Bins</a>

      <table class="table table-hover">
        <thead>
          <tr>
            <th>Status</th>
            <th>Task</th>
            <th>Description</th>
            <th>created_At</th>
          </tr>
        </thead>
        <tbody>
            <?php 
              $newTask = $taskObj->displayData(); 
              foreach ($newTask as $task) {
            ?>
            <tr>
              <td><input type="checkbox" id="packers" value="1"/></td>
              <td><?php echo $task['task'] ?></td>
              <td><?php echo $task['description'] ?></td>
              <td><?php echo $task['created_at'] ?></td>
              <td>
                <a href="edit.php?editId=<?php echo $task['id'] ?>" style="color:green">
                  <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
                <a href="index.php?deleteId=<?php echo $task['id'] ?>" style="color:red" onclick="confirm('Are you sure want to delete this record')">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>