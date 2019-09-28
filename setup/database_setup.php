<?php
 require ('../db_config.php');

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	else
	// echo 'DB connection OK'."<br>";
  
  //sql call requests 
	if($_GET['function'] == 'createDB')
	{
		createDB($dbname);
	}
	
	// Table sql call requests
	if($_GET['function'] == 'createTable')
	{
		$table_script_name = '../scripts/'.$_GET['script_name'];		//get file directory
		require ($table_script_name);
		$TableSetup = new TableSetup();
		$TableSetup->createTable($sqlQuery,$table_name);	//use variables from the file 
	}
	if($_GET['function'] == 'deleteTable')
	{   $table_name = $_GET['name'];
		$TableSetup = new TableSetup();
		$TableSetup->deleteTable($table_name);
	}
	if($_GET['function'] == 'getTableList')
	{
		$TableSetup = new TableSetup();
		$TableSetup->getTableList();
	}
	
	// trigger sql call requests
	if($_GET['function'] == 'createTrigger')
	{
		$trigger_script_name = '../scripts/'.$_GET['script_name'];		//get file directory
		require ($trigger_script_name);		//include file and open
		$TriggerSetup = new TriggerSetup();
		$TriggerSetup->createTrigger($sqlQuery,$trigger_name);	//use variables from the file 
	}
	
	if($_GET['function'] == 'deleteTrigger')
	{
		$trigger_name = $_GET['name'];
		$TriggerSetup = new TriggerSetup();
		$TriggerSetup->deleteTrigger($trigger_name);
	}
	if($_GET['function'] == 'getTriggersList')
	{
		$TriggerSetup = new TriggerSetup();
		$TriggerSetup->getTriggersList();
	}
	
	function createDB($dbname)
	{
		$sql = "SHOW DATABASES LIKE '$dbname' ";
		if (empty (mysqli_fetch_array(mysqli_query($conn,"SHOW DATABASES LIKE '$dbname'")))) 
		{
				echo " '$dbname' database not exist<br>"; 
			$sql = "CREATE Database '$dbname'"; // Create database 
		  	if (mysqli_query($conn, $sql)) 	//run sql
		  	{
		    	echo " '$dbname' database is created successfully"."<br>";
		  	} 
			else
			{
		  		echo "Error creating database: " . mysqli_error($conn);
		  		mysqli_close($conn);
			}
		}
		else
		{
			echo " '$dbname' database is exist!";
			mysqli_close($conn);
		}
	}   
	
Class TableSetup
{
	public function __construct()
	{
		// echo 'test';
		// if(function_exists($_GET['function']))
		// {
   			
		// }
	}
	
	function createTable($sqlQuery,$table_name)
	{
		// Create connection
		$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		// Check connection
		if ($conn->connect_error) {
		   // die("Connection failed: " . mysqli_error($conn);
		}
		if ($result = mysqli_query($conn, $sqlQuery) === TRUE) {
		    echo "<br>Table ".$table_name. " is created successfully";
		} 
		else
		{
		    echo "<br>Error creating table: <br>" . mysqli_error($conn);
		}

		$conn->close();
	}

	function deleteTable($table_name)
	{
		// Create connection
		$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		// Check connection
		if ($conn->connect_error) {
		   // die("Connection failed: " . mysqli_error($conn);
		} 
		$sql_delete = "DROP TABLE ".$table_name;
		if (mysqli_query($conn, $sql_delete) === TRUE) 
		{
		    echo "<br>Table ".$table_name." is deleted successfully";
		} 
		else
		{
		    echo "<br>Error deleting table: " . mysqli_error($conn);
		}
		$conn->close();
	}	
	public function getTableList()
	{
		$conn=new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$dbname =$GLOBALS['dbname'];
		$sql = "SELECT TABLE_NAME,TABLE_ROWS FROM information_schema.TABLES where TABLE_SCHEMA='$dbname'"; // get all tables from db 
	  	if ($result = mysqli_query($conn, $sql)) 	//run sql
	  	{
	  		$jsonObject= array();
	  		for($index =0; $row = $result->fetch_assoc(); $index++){	//return all table list 
	  			$jsonObject[$index] =$row;
	  		}
	  		echo json_encode($jsonObject);
	  		mysqli_close($conn);
	  	} 
		else
		{
	  		echo "No Records found";
	  		mysqli_close($conn);
		}
	}
}

Class TriggerSetup
{
	public function __construct()
	{		
	}

	function createTrigger($sqlQuery,$trigger_name)
	{
		// Create connection
		$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		// Check connection
		if ($conn->connect_error) {
		   // die("Connection failed: " . mysqli_error($conn);
		}
		if ($result = mysqli_query($conn, $sqlQuery) === TRUE) {
		    echo "<br>Trigger ".$trigger_name. " is created successfully";
		} 
		else
		{
		    echo "<br>Error creating trigger: <br>" . mysqli_error($conn);
		}

		$conn->close();
	}

	function deleteTrigger($trigger_name)
	{
		// Create connection
		$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		// Check connection
		if ($conn->connect_error) {
		   // die("Connection failed: " . mysqli_error($conn);
		} 
		$sql_delete = "DROP TRIGGER IF EXISTS ".$trigger_name;
		if (mysqli_query($conn, $sql_delete) === TRUE) 
		{
		    echo "<br>Trigger ".$trigger_name." is deleted successfully";
		} 
		else
		{
		    echo "<br>Error deleting trigger: " . mysqli_error($conn);
		}
		$conn->close();
	}
	public function getTriggersList()
	{
		$conn=new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		$dbname =$GLOBALS['dbname'];
		$sql = "SHOW TRIGGERS"; // get all triggers list from db 
	  	if ($result = mysqli_query($conn, $sql)) 	//run sql
	  	{
	  		$jsonObject= array();
	  		for($index =0; $row = $result->fetch_assoc(); $index++){	//return all table list 
	  			$jsonObject[$index] =$row;
	  		}
	  		echo json_encode($jsonObject);
	  		mysqli_close($conn);
	  	} 
		else
		{
	  		echo "No Records found";
	  		mysqli_close($conn);
		}
	}	
}	
	
?>