<?php

	class Category
	{
		private $servername = "localhost";
		private $username   = "root";
		private $password   = "";
		private $database   = "dash";
		public  $con;


		// Database Connection 
		public function __construct()
		{
		    $this->con = new mysqli($this->servername, $this->username,$this->password,$this->database);
		    if(mysqli_connect_error()) {
			 trigger_error("Failed to connect to MySQL: " . mysqli_connect_error());
		    }else{
			return $this->con;
		    }
		}

		// Insert category data into customer table
		public function insertData($post)
		{
			$categoryname = $this->con->real_escape_string($_POST['categoryname']);
			
			$query="INSERT INTO category(category_id,category_name) VALUES(null,'$categoryname')";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:index.php?msg1=insert");
			}else{
			    echo "Something Went Wrong. Please try again!";
			}
		}

        // Fetch category records for show listing
		public function displayData()
		{
		    $query = "SELECT * FROM category";
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
// Fetch single data for edit from customer table
		public function displyaRecordById($id)
		{
		    $query = "SELECT * FROM category WHERE category_id = '$id'";
		    $result = $this->con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row;
		    }else{
			echo "Record not found";
		    }
		}
        	// Update category data into category table
		public function updateRecord($postData)
		{
		    $categoryname = $this->con->real_escape_string($_POST['categoryname']);
		   
		    $id = $this->con->real_escape_string($_POST['id']);
		if (!empty($id) && !empty($postData)) {
			$query = "UPDATE category SET category_name = '$categoryname' WHERE category_id = '$id'";
			$sql = $this->con->query($query);
			if ($sql==true) {
			    header("Location:index.php?msg2=update");
			}else{
			    echo "Registration updated failed try again!";
			}
		    }
			
		}
        	// Delete category data from category table
		public function deleteRecord($id)
		{
		    $query = "DELETE FROM category WHERE category_id = '$id'";
		    $sql = $this->con->query($query);
		if ($sql==true) {
			header("Location:index.php?msg3=delete");
		}else{
			echo "Record does not delete try again";
		    }
		}

	}
      
  
?>