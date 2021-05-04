<?php
  
  // Include database file
  include 'database.php';

  $taskObj = new Task();

  // Restore record from table
  if(isset($_GET['restore_Id']) && !empty($_GET['restore_Id'])) {
      $deleteId = $_GET['restore_Id'];
      $taskObj->restoreDeletedRecord($deleteId);
  }

  if(isset($_GET['deletePermId']) && !empty($_GET['deletePermId'])){
    $delete = $_GET['deletePermId'];
    $taskObj->deletePermanentRecord($delete);
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
</div><br><br> 

<div class="container">
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
  <h2>View Deleted Records
    <a href="index.php" class="btn btn-primary" style="float:right;">Back</a>
  </h2>
  <table class="table table-hover">
    <thead>
      <tr>
        
        <th>No.</th>
        <th>Task</th>
        <th>Description</th>
        <th>Created_At</th>
        <th>Deleted_At</th>

      </tr>
    </thead>

    <tbody>
        <?php 
          $newTask = $taskObj->displayTrashData(); 
          foreach ($newTask as $task) {
        ?>
        <tr>
          <td><input type="checkbox" value="1"/></td>
          <td><?php echo $task['task'] ?></td>
          <td><?php echo $task['description'] ?></td>
          <td><?php echo $task['created_at'] ?></td>
          <td><?php echo $task['deleted_at'] ?></td>
          <td>
            <a href="trash.php?restore_Id=<?php echo $task['trash_id'] ?>" style="color:green">Restore</a>&nbsp
            <a href="trash.php?deletePermId=<?php echo $task['trash_id'] ?>" style="color:red" onclick="confirm('Are you sure want to delete this record')">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>