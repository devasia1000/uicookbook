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
			OUTPUTS: Comma separated list of search results
		2 - Add new recipe
			INPUTS: $recipeId, $recipeName, $steps, $recipeUrl, $userEmail
			OUTPUTS: returns 1 on success
		3 - Delete recipe
			INPUTS: $recipeId
			OUTPUTS: returns 1 on success
		4 - Update recipe
			INPUTS: $recipeId, $newRecipeName, $newSteps, $newRecipeUrl, $newUserEmail
			OUTPUTS: returns 1 on success
	    5 - Register New User
	        INPUTS: $username, $userEmail, $password
	        OUTPUTS: returns 1 on success and an error message on fail
	*/
	
	
	$query_type = $_GET["query_type"];
	
	if ($query_type == '0') { // Perform login validation
        // Sanitize incoming username and password
        $identity = filter_var($_GET['identityToken'], FILTER_SANITIZE_STRING);
        $password = filter_var($_GET['password'], FILTER_SANITIZE_STRING);
        $password = hash('sha256', $password);

        // Determine whether an account exists matching this username and password
        $statement = $link->prepare("SELECT email FROM users WHERE ( username = ? OR email = ?) and password = ?");

        // Bind the input parameters to the prepared statement
        $statement->bind_param('sss', $identity, $identity, $password);

        // Execute the query
        $statement->execute();

        // Store the result so we can determine how many rows have been returned
        $statement->store_result();

        if ($statement->num_rows == 1) {
            $statement->bind_result($value);
            $result = $statement->fetch();

            echo '1';
            $statement->free_result();
            $statement->close();
            return;
        }
		echo '0';
        $statement->free_result();
        $statement->close();
	} else if ($query_type == '1') { // Perform a search
		
		$recipeId = sanitize($_GET["recipeId"]);
		$recipeName = sanitize($_GET["recipeName"]);
		$steps = sanitize($_GET["steps"]);
		$userEmail = sanitize($_GET["userEmail"]);
		
		//echo("recipeId $recipeId<br>recipeName $recipeName<br>steps $steps<br>recipeUrl $recipeUrl<br>userEmail $userEmail");
		
		$query_string = "SELECT * FROM recipes WHERE recipeId LIKE '$recipeId' AND recipeName LIKE '$recipeName' AND steps LIKE '$steps' AND userEmail LIKE '$userEmail'";
		
		//echo("$query_string");
		
		//execute the query. 
		$result = $link->query($query_string);
		
		$result_str = '';
		
		// TODO: fix bug where each field appears twice
		while($row = mysqli_fetch_array($result)) {
			echo($row['recipeid'] . ';;;');
			echo($row['recipeName'] . ';;;');
			echo($row['steps'] . ';;;');
			echo($row['userEmail'] . '///');		
		}
		
	} else if ($query_type == '2') { // Perform an insert
		
		$recipeName = $_GET["recipeName"];
		$steps = $_GET["steps"];
		$userEmail = $_GET["userEmail"];
		
		$query_string = "INSERT INTO recipes(recipeName, steps, userEmail) VALUES ('$recipeName', '$steps', '$userEmail')";
		
		//execute the query. 
		$result = $link->query($query_string);
		
		echo($steps);
	} else if ($query_type == '3') { // Perform a delete
	
		$recipeId = $_GET["recipeId"];
		
		$query_string = "DELETE FROM recipes WHERE recipeId='$recipeId'";
		
		//execute the query. 
		$result = $link->query($query_string);

        $query_string = "DELETE FROM ingredients WHERE recipeId='$recipeId'";

        $result = $link->query($query_string);

		echo('1');
		
	} else if ($query_type == '4') { // Do an update
	
		$recipeId = $_GET["recipeId"];
		$newRecipeName = $_GET["newRecipeName"];
		$newSteps = $_GET["newSteps"];
		$newUserEmail = $_GET["newUserEmail"];
		
		$query_string = "UPDATE recipes SET recipeName='$newRecipeName', steps='$newSteps', userEmail='$newUserEmail' WHERE recipeId='$recipeId'";
		
		//execute the query. 
		$result = $link->query($query_string);
		
		echo("1");
	
	} else if ($query_type == '5') {
        $username = $_GET["username"];
        $userEmail = $_GET["userEmail"];
        $password = $_GET["password"];
        $password = hash('sha256', $password);
        // echo $password . "\n";

        $query_string = "INSERT INTO users(username, email, password) VALUES('$username', '$userEmail', '$password')";

        //execute the query
        $result = $link->query($query_string);

        if($result) {
            echo 1;
        }
        else {
            $error = mysqli_error($link);
            if (strpos($error,'user') !== false) {
                echo "Username is taken\n";
            }
            else if (strpos($error,'PRIMARY') !== false) {
                echo "Email already in use.\n";
            }
            else {
                echo "Something went terribly wrong.\n";
            }

        }
    } else if ($query_type == '6') {
        $recipeId = $_GET["recipeId"];
        $ingredientName = $_GET["ingredientName"];
        $amount = $_GET["amount"];

        $query_string = "INSERT INTO ingredients(recipeID, ingredientName, amount) VALUES ('$recipeId', '$ingredientName', '$amount')";

        //execute the query.
        $result = $link->query($query_string);

        echo('1');
    } else if ($query_type == '7') {
        $recipeId = $_GET["recipeId"];

        $query_string = "SELECT ingredientName, amount FROM ingredients WHERE recipeId = '$recipeId'";

        //execute the query.
        $result = $link->query($query_string);

        // TODO: fix bug where each field appears twice
        while($row = mysqli_fetch_array($result)) {
            echo($row['ingredientName'] . ';;;');
            echo($row['amount'] . '///');
        }
    } else if ($query_type == '8') {
        $recipeId = $_GET["recipeId"];
        $ingredientName = $_GET["ingredientName"];
        $amount = $_GET["amount"];

        $query_string = "INSERT INTO ingredients(recipeID, ingredientName, amount) VALUES ('$recipeId', '$ingredientName', '$amount') ON DUPLICATE KEY UPDATE ingredientName=VALUES(ingredientName), amount=VALUES(amount)";

        //execute the query.
        $result = $link->query($query_string);

        echo('1');
    } else if ($query_type == '9') {
        $recipeId = $_GET["recipeId"];
        $ingredientName = $_GET["ingredientName"];

        $query_string = "DELETE FROM ingredients WHERE recipeId='$recipeId' AND ingredientName = '$ingredientName'";

        //execute the query.
        $result = $link->query($query_string);
    } else {
		echo("InvalidRequest");
	}
	
	mysqli_close($link);
?>