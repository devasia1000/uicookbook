<?php

function sanitize ($str) {
	if (empty($str)) {
		return "%";
	} else {
		return "%$str%";
	}
}

/*
Checks if a give username/passowrd combination is valid
INPUTS: username - username of user
	password - password of user
OUTPUTS: returns 1 if username/password is valid
	 returns 0 if username/password is not valid
*/
function checkLogin ($username, $password) {
	// Create connection
	$link = mysqli_connect("engr-cpanel-mysql.engr.illinois.edu","uicookbo_develop","password","uicookbo_main");

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$query_string = "SELECT COUNT(*) FROM users WHERE username='$username' AND password='$password'";

	//execute the query
	$result = $link->query($query_string);

	while($row = mysqli_fetch_array($result)) {
		foreach ($row as $value){
			if ($value >= 1) {
				return 1;
			}
		}
	}
		
	return 0;
}

function getUserRecipes ($email) {
	// Create connection
	$link = mysqli_connect("engr-cpanel-mysql.engr.illinois.edu","uicookbo_develop","password","uicookbo_main");

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$query_string = "SELECT recipeName, steps, recipeid FROM recipes JOIN users ON recipes.userEmail=users.email WHERE users.email = '$email'";
	
	//execute the query
	$result = $link->query($query_string);
	
	$result_arr = array();
	
	while($row = mysqli_fetch_array($result)) {
		array_push($result_arr, $row);	
	}
	
	return $result_arr;
}

/*
Returns a list of matching recipes according to search terms.
If you want to ignore a field while search, please assign it to empty string.
Eg: recipeUrl = '' means that you don't care about recipeUrl field when searching
INPUTS: recipeId
	recipeName
	steps
	recipeUrl
	userEmail
OUTPUTS: returns an array of dicts
*/
function recipeSearch ($recipeId, $recipeName, $steps, $userEmail) {
	// Create connection
	$link = mysqli_connect("engr-cpanel-mysql.engr.illinois.edu","uicookbo_develop","password","uicookbo_main");

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$recipeId = sanitize($recipeId);
	$recipeName = sanitize($recipeName);
	$steps = sanitize($steps);
	$userEmail = sanitize($userEmail);

	$query_string = "SELECT * FROM recipes WHERE recipeId LIKE '$recipeId' AND recipeName LIKE '$recipeName' AND steps LIKE '$steps' AND userEmail LIKE '$userEmail'";

	//execute the query.
	$result = $link->query($query_string);

	$result_arr = array();
	
	while($row = mysqli_fetch_array($result)) {
		array_push($result_arr, $row);
	}

	return $result_arr;
}

/*
Inserts a new recipe into the table. None of the recipe attributes can be empty.
A recipeId is automatiicaly generated by the database for each new recipe
INPUTS: recipeName
	steps
	recipeUrl
	userEmail
OUTPUTS: returns a 1 if insert is successful
	 returns a 0 if insert is NOT successful
*/
function insertRecipe ($recipeName, $steps, $recipeUrl, $userEmail) {
	// Create connection
	$link = mysqli_connect("engr-cpanel-mysql.engr.illinois.edu","uicookbo_develop","password","uicookbo_main");

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$query_string = "INSERT INTO recipes(recipeName, steps, recipeURL, userEmail) VALUES ('$recipeName', '$steps', '$recipeUrl', '$userEmail')";
	
	//execute the query. 
	$result = $link->query($query_string);
		
	return 1;
}

/*
Deletes a recipe from the table
INPUTS: recipeId
OUTPUTS: returns a 1 if delete is successful
	 returns a 0 if delete is NOT successful
*/
function deleteRecipe ($recipeId) {
	// Create connection
	$link = mysqli_connect("engr-cpanel-mysql.engr.illinois.edu","uicookbo_develop","password","uicookbo_main");

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$query_string = "DELETE FROM recipes WHERE recipeId='$recipeId'";
	
	//execute the query. 
	$result = $link->query($query_string);
		
	return 1;
}

/*
Updates a recipe in the table. recipeId is the id of the recipe to be updated. 
newXXX are new values for each of the recipe attributes
INPUTS: recipeId
	newRecipeName
	newSteps
	newRecipeUrl
	newUserEmail
OUTPUTS: returns a 1 if insert is successful
	 returns a 0 if insert is NOT successful
*/
function updateRecipe ($recipeId, $newRecipeName, $newSteps, $newRecipeUrl, $newUserEmail) {
	// Create connection
	$link = mysqli_connect("engr-cpanel-mysql.engr.illinois.edu","uicookbo_develop","password","uicookbo_main");

	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$query_string = "UPDATE recipes SET recipeName='$newRecipeName', steps='$newSteps', recipeUrl='$newRecipeUrl', userEmail='$newUserEmail' WHERE recipeId='$recipeId'";
	
	//execute the query. 
	$result = $link->query($query_string);
		
	return 1;
}

function getRecipeIngredients($recipeId) {
    // Create connection
    $link = mysqli_connect("engr-cpanel-mysql.engr.illinois.edu","uicookbo_develop","password","uicookbo_main");

    $query_string = "SELECT ingredientName, amount FROM ingredients WHERE recipeId = '$recipeId'";

    //execute the query.
    $result = $link->query($query_string);

    $result_arr = array();

    // TODO: fix bug where each field appears twice
    while($row = mysqli_fetch_array($result)) {
        array_push($result_arr, $row);
    }

    return $result_arr;
}
