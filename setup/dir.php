
<?php
require ('../db_config.php');

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	
	$unpublished_tables = array();
	$index = 0;
	foreach (glob('../scripts/tables/*.php') as $filename) {
		$p = pathinfo($filename);
		$table_name = $p['filename'];
		if(exist_table($table_name) == 0)
		{
			//echo $table_name;
			$unpublished_tables[$index] = $table_name;		
			$index++;
		}		
		
	}
	$unpublished_triggers = array();
	$index = 0;
	foreach (glob('../scripts/triggers/*.php') as $filename) {
		$p = pathinfo($filename);
		$trigger_name = $p['filename'];
		if(check_exist_trigger($trigger_name) == 0)
		{
			$unpublished_triggers[$index] = $trigger_name;				
			$index++;
		}		
		
	}
	$jsonObject = new stdClass();	//create object
	$jsonObject->unpublished_table = $unpublished_tables;
	$jsonObject->unpublished_trigger = $unpublished_triggers;

	mysqli_close($conn);
	echo json_encode($jsonObject); 

	function exist_table($table_name)
	{
		//importing global variables
		$dbname = $GLOBALS['dbname'];
		$conn = $GLOBALS['conn'];
		
		$sql = "SELECT TABLE_NAME 
				FROM information_schema.TABLES 
				where TABLE_SCHEMA='$dbname' AND TABLE_NAME='$table_name' "; // get all tables from db 
		
	  	if ($result = mysqli_query($conn, $sql)) 	//run sql
	  	{
	  		$row = $result->fetch_assoc(); 	//return single table name
			if($row['TABLE_NAME'] == $table_name)
			{
				return 1;
			}			
			return 0;
	  	} 
		else
		{
	  		echo "No Records found";
	  		
		}	
		return 0;
	}   
	function check_exist_trigger($trigger_name)
	{
		//importing global variables
		$dbname = $GLOBALS['dbname'];
		$conn = $GLOBALS['conn'];
		
		//$sql = "SHOW TRIGGERS WHERE '$trigger_name'"; // return all triggers from db 
		$sql = "SELECT TRIGGER_NAME 
				FROM information_schema.TRIGGERS 
				WHERE TRIGGER_NAME = '$trigger_name' AND TRIGGER_SCHEMA = '$dbname'";

	  	if ($result = mysqli_query($conn, $sql)) 	//run sql
	  	{
	  		$row = $result->fetch_assoc(); 	//return single table name
			if($row['TRIGGER_NAME'] == $trigger_name)
			{
				return 1;
			}			
			return 0;
	  	} 
		else
		{
	  		echo "No Records found";
	  		
		}	
		return 0;
	}   

?>
