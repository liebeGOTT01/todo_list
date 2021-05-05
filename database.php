<?php

	class Task{
		private $servername = "localhost";
		private $username   = "root";
		private $password   = "";
		private $database   = "torres_phpdb";
		public  $con;


		// Database Connection 
		public function __construct(){
		    $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
		    if(mysqli_connect_error()) {
				trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
		    }else{
				return $this->con;
		    }
		}

		// Insert task data into todo_list table
		public function insertData($post){
			$task = $this->con->real_escape_string($_POST['task']);
			$desc = $this->con->real_escape_string($_POST['description']);
			$query="INSERT INTO todo_list(task,description) VALUES('$task','$desc')";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:index.php?msg1=insert");
			}else{
			    echo "Registration failed try again!";
			}
		}

		// Fetch task records for show listing
		public function displayData(){
		    $query = "SELECT * FROM todo_list";
		    $result = $this->con->query($query);
			if ($result->num_rows > 0) {
				$data = array();
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			}else{
				echo "No found records";
			}
		}
			
		// Fetch single data for edit from todo_list table
		public function displayRecordById($id)
		{
		    $query = "SELECT * FROM todo_list WHERE id = '$id'";
		    $result = $this->con->query($query);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			}else{
				echo "Record not found";
			}
		}
		

		// Update todo_list data into todo_list table
			public function updateRecord($postData)
			{
			$id =  $this->con->real_escape_string($_POST['id']);
		    $updateTask = $this->con->real_escape_string($_POST['utask']);
		    $updateDesc = $this->con->real_escape_string($_POST['udesc']);

			

			if (!empty($id) && !empty($postData)) {
				
				$query = "UPDATE todo_list SET task = '$updateTask', description = '$updateDesc' WHERE id = '$id'";
				$sql = $this->con->query($query);
				if ($sql==true) {
					header("Location:index.php?msg2=update");
				}else{
					echo "Registration updated failed try again!";
				}
		    }
		}


		// Delete to-do_list data from to-do_list table
		public function deleteRecord($id){
            
			$query = mysqli_query($this->con, "SELECT * FROM `todo_list` WHERE `id` = '$id'") or die(mysqli_error());
			$fetch = mysqli_fetch_array($query);
			mysqli_query($this->con , "INSERT INTO `trash` VALUES( '','$fetch[task]','$fetch[description]', '$fetch[created_at]')") or die(mysqli_error());
			mysqli_query($this->con, "DELETE FROM `todo_list` WHERE `id` = '$id'") or die(mysqli_error());
			header('location:index.php');
		}

		// Fetch trash records for show listing
		public function displayTrashData(){
		    $query = "SELECT * FROM trash";
		    $result = $this->con->query($query);
			if ($result->num_rows > 0) {
				$data = array();
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			}else{
				echo "No found records";
			}
		}

		public function restoreDeletedRecord($id){
			echo $id;
			$query = mysqli_query($this->con, "SELECT * FROM `trash` WHERE `trash_id` = '$id'") or die(mysqli_error());
			$fetch = mysqli_fetch_array($query);
			mysqli_query($this->con, "INSERT INTO `todo_list` VALUES('', '$fetch[task]',  '$fetch[description]', '$fetch[created_at]')") or die(mysqli_error());
			mysqli_query($this->con, "DELETE FROM `trash` WHERE `trash_id` = '$id'") or die(mysqli_error());
			header('location:trash.php');
		
			
		}

		public function deletePermanentRecord($trash_id){
			$query = mysqli_query($this->con, "DELETE FROM `trash` WHERE `trash_id` = '$trash_id'") or die(mysqli_error());
		}

	}
?>