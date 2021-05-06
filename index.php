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
  <link rel="stylesheet" href="style.css">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
<br>
<div class="container w-50 mb-5">
  <h1 class="text-center header p-5 text-white position-static">Personalized To Do List</h1>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-5">
    <!-- TASK FORM -->
      <div class="p-4 addForm h-auto">
      <h2 class="details text-white text-center mb-5 p-3">ENTER TASK HERE</h2>
        <div class="overflow-hidden">
            <form action="add.php" method="POST">
              <div class="form-group">
                <label for="$post">Task:</label>
                <input type="text" class="form-control" name="task" placeholder="Enter task" required="">
              </div>
              <div class="form-group">
                <label for="description">Task Description:</label>
                <textarea type="text" class="form-control" name="description" placeholder="Enter description" required=""></textarea>
              </div>
              <button name="submit" class="details text-white float-right">Submit</button>
            </form>
        </div>
      </div>
      <br><br>
      <button class="trash float-right"><i class="fa fa-trash text-danger" aria-hidden="true"></i>&nbsp;<a href="trash.php" class="text-white"  data-toggle="tooltip" data-placement="left" title="Review and restore deleted tasks">Trash Bins</a></button>
    </div>


    <div class="container col-md-7 h-100">
      <div class="overflow-scroll">
          <?php 
          $newTask = $taskObj->displayData(); 
            foreach ($newTask as $task) {
          ?>
        <div class="container mb-4 p-4 glass-container">
        <div class="row ">
          <div class="col-md-1 p-3">
            <input type="checkbox" class="done" class="w-100">
          </div>
          <div class="col-md-10 rounded">
            <h2 class="text-white"><?php echo $task['task']?></h2>
            <hr>
            <span class="small">Task description:</span> <br>
            <em class="text-dark"><?php echo $task['description']?></em>
          </div>
        </div>
            <span class="row float-right pt-2 pl-2 pr-2 details">
              <p class="small text-white">Created at: <?php echo $task['created_at']?></p>&nbsp; &nbsp;
              <a href="edit.php?editId=<?php echo $task['id'] ?>"><i class="fa fa-pencil text-warning" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Edit Task"></i></a> &nbsp;
              <a href="index.php?deleteId=<?php echo $task['id'] ?>"><i class="fa fa-trash text-danger" aria-hidden="true"  data-toggle="tooltip" data-placement="left" title="Delete Task"></i></a>
            </span>
        </div>
          <?php } ?>
      </div>
    </div>
  </div>
  <div class="circle1"></div>
  <div class="circle2"></div>
  <div class="circle3"></div>
  <div class="circle4"></div>
  <div class="circle5"></div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$('.done').on('change', function(){
  if (this.checked){
    $(this).parent().parent().css("text-decoration","line-through");
    $(this).parent().parent().css("color","red");
  }else{
    $(this).parent().parent().css("text-decoration","none");
    $(this).parent().parent().css("color","black");
  }
})

</script>

</body>
</html>
