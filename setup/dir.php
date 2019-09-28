
<?php
require ('../db_config.php');

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	
	$out = array();
	$index = 0;
	foreach (glob('../scripts/*.php') as $filename) {
		$p = pathinfo($filename);
		$table_name = $p['filename'];
		if(exist_table($conn,$table_name) == 0)
		{
			//echo $table_name;
			$out[$index] = $table_name;		
			$index++;
		}		
		
	}
	mysqli_close($conn);
	echo json_encode($out); 

	function exist_table($conn,$table_name)
	{
		$dbname = $GLOBALS['dbname'];
		$sql = "SELECT TABLE_NAME FROM information_schema.TABLES where TABLE_SCHEMA='$dbname' AND TABLE_NAME='$table_name' "; // get all tables from db 
		
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

?>
