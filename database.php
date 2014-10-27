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
	
		0 - Login query
			INPUTS: $username, $password
			OUTPUTS: 
				1 if username/password is valid
				0 if username/password is NOT valid
		1 - Search query: 
			INPUTS: $recipeId, $recipeName, $steps, $recipeURL, $userEmail
			OUTPUTS: Comma seperated list of search results
		2 - Add new recipe
			INPUTS: $recipeId, $recipeName, $steps, $recipeUrl, $userEmail
			OUTPUTS: returns 1 on success
		3 - Delete recipe
			INPUTS: $recipeId
			OUTPUTS: returns 1 on success
		4 - Update recipe
			INPUTS: $recipeId, $newRecipeName, $newSteps, $newRecipeUrl, $newUserEmail
			OUTPUTS: returns 1 on success
	*/
	
	
	$query_type = $_GET["query_type"];
	
	if ($query_type == '0') { // Perform login validation
	
		$username = $_GET["username"];
		$password = $_GET["password"];
		
		$query_string = "SELECT COUNT(*) FROM users WHERE username='$username' AND password='$password'";

		//execute the query
		$result = $link->query($query_string);

		while($row = mysqli_fetch_array($result)) {
			foreach ($row as $value){
				if ($value >= 1) {
					goto done;
				}
			}
		}
		
		echo('0');
		return;
		
		done: 
		echo('1');
		return;
		
	
	} else if ($query_type == '1') { // Perform a search
		
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
		
		$result_str = '';
		
		// TODO: fix bug where each field appears twice
		while($row = mysqli_fetch_array($result)) {
			echo($row['recipeid'] . ';;;');
			echo($row['recipeName'] . ';;;');
			echo($row['steps'] . ';;;');
			echo($row['recipeURL'] . ';;;');
			echo($row['userEmail'] . '///');		
		}
		
	} else if ($query_type == '2') { // Perform an insert
		
		$recipeName = $_GET["recipeName"];
		$steps = $_GET["steps"];
		$recipeUrl = $_GET["recipeUrl"];
		$userEmail = $_GET["userEmail"];
		
		//echo("recipeId $recipeId<br>recipeName $recipeName<br>steps $steps<br>recipeUrl $recipeUrl<br>userEmail $userEmail");
		
		$query_string = "INSERT INTO recipes(recipeName, steps, recipeURL, userEmail) VALUES ('$recipeName', '$steps', '$recipeUrl', '$userEmail')";
		
		//execute the query. 
		$result = $link->query($query_string);
		
		echo('1');

	} else if ($query_type == '3') { // Perform a delete
	
		$recipeId = $_GET["recipeId"];
		
		$query_string = "DELETE FROM recipes WHERE recipeId='$recipeId'";
		
		//execute the query. 
		$result = $link->query($query_string);
		
		echo('1');
		
	} else if ($query_type == '4') { // Do an update
	
		$recipeId = $_GET["recipeId"];
		$newRecipeName = $_GET["newRecipeName"];
		$newSteps = $_GET["newSteps"];
		$newRecipeUrl = $_GET["newRecipeUrl"];
		$newUserEmail = $_GET["newUserEmail"];
		
		$query_string = "UPDATE recipes SET recipeName='$newRecipeName', steps='$newSteps', recipeUrl='$newRecipeUrl', userEmail='$newUserEmail' WHERE recipeId='$recipeId'";
		
		//execute the query. 
		$result = $link->query($query_string);
		
		echo("1");
	
	} else {
	
		echo("InvalidRequest");
	
	}
	
	mysqli_close($link);
?>