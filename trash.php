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
  <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">
  <div class="container w-50 mb-5">
    <h1 class="text-center glass-container text-white p-2">View Deleted Records</h1>
  </div>
    <button class="details float-right mb-4 mr-5">
      <a href="index.php" class="text-white p-3">Back</a>
    </button>
  </div>
<br>
<br>
<div class="container addForm align-items-center w-75">
  <table class="table table-striped table-borderless m-4">
    <thead class="h3">
      <tr>
        <th>Task</th>
        <th>Description</th>
        <th>Created_At</th>
        <th class="">Action</th>
      </tr>
    </thead>
    <tbody>
        <?php 
          $newTask = $taskObj->displayTrashData(); 
          foreach ($newTask as $task) {
        ?>
        <tr class="text-white">
          <td><?php echo $task['task'] ?></td>
          <td><?php echo $task['description'] ?></td>
          <td><?php echo $task['created_at'] ?></td>
          <td class="text-left">
            <a href="trash.php?restore_Id=<?php echo $task['trash_id'] ?>"><i class="fa fa-trash-restore text-warning" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Restore Task"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="trash.php?deletePermId=<?php echo $task['trash_id'] ?>">
              <i class="fa fa-trash text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Delete Task"></i>
            </a>
          </td>
        </tr>
      <?php }?>
    </tbody>
  </table>
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