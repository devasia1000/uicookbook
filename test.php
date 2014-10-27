<?php
	
	function sanitize ($str) {
		if (empty($str)) {
			return "%";
		} else {
			return "%$str%";
		}
	}
	
	// Create connection
	$link = mysqli_connect("engr-cpanel-mysql.engr.illinois.edu","uicookbo_develop","password","uicookbo_main");

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	
	/*
	List of query types:
	
		0 - 
		1 - Search query: 
			INPUTS: $search_string
			OUTPUTS: Comma seperated list of search results
		2 - Add new recipe
			INPUTS: $recipeId, $recipeName, $steps, $recipeUrl, $userEmail
			OUTPUTS: returns 1 on success
		3 - Delete recipe
			INPUTS: $recipeId
			OUTPUTS: returns 1 on success
		4 - 
	*/
	
	
	$query_type = $_GET["query_type"];
	
	if ($query_type == '1') { // Perform a search
		
		$recipeId = sanitize($_GET["recipeId"]);
		$recipeName = sanitize($_GET["recipeName"]);
		$steps = sanitize($_GET["steps"]);
		$recipeUrl = sanitize($_GET["recipeUrl"]);
		$userEmail = sanitize($_GET["userEmail"]);
		
		//echo("recipeId $recipeId<br>recipeName $recipeName<br>steps $steps<br>recipeUrl $recipeUrl<br>userEmail $userEmail");
		
		$query_string = "SELECT * FROM recipes WHERE recipeId LIKE '$recipeId' AND recipeName LIKE '$recipeName' AND steps LIKE '$steps' AND recipeUrl LIKE '$recipeUrl' AND userEmail LIKE '$userEmail'";
		
		//echo("$query_string");
		
		//execute the query. 
		$result = $link->query($query_string);
		
		$result_str = "";
		
		// TODO: fix bug where each field appears twice
		while($row = mysqli_fetch_array($result)) {
			$result_str = $result_str . "<br>";
			foreach ($row as $value){
				$result_str = $result_str . $value . ";;;";
			}
		}
		
		echo($result_str);
		
	} else if ($query_type == '2') { // Perform an insert
		
		$recipeId = $_GET["recipeId"];
		$recipeName = $_GET["recipeName"];
		$steps = $_GET["steps"];
		$recipeUrl = $_GET["recipeUrl"];
		$userEmail = $_GET["userEmail"];
		
		//echo("recipeId $recipeId<br>recipeName $recipeName<br>steps $steps<br>recipeUrl $recipeUrl<br>userEmail $userEmail");
		
		$query_string = "INSERT INTO recipes VALUES ('$recipeId', '$recipeName', '$steps', '$recipleUrl', '$userEmail')";
		
		//execute the query. 
		$result = $link->query($query_string);
		
		echo('1');

	} else if ($query_type == '3') { // Perform a delete
	
		$recipeId = $_GET["recipeId"];
		
		$query_string = "DELETE FROM recipes WHERE recipeId='$recipeId'";
		
		//echo($query_string);
		
		//execute the query. 
		$result = $link->query($query_string);
		
		echo('1');
		
	} else if ($query_type == '4') {
	
		// Do an update
	
	} else {
	
		echo("Invalid request");
	
	}
	
	mysqli_close($link);
?>