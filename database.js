/*
Deletes a recipe from the table
INPUTS: recipeId
OUTPUTS: returns a 1 if delete is successful
	 returns a 0 if delete is NOT successful
*/
function deleteRecipe (recipeId) {

	if (recipeId.indexOf("%") > -1 || recipeId.indexOf("-") > -1) {
		return 0;
	}
	var query_string = 'query_type=3' + '&recipeId=' + recipeId;

	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET", "database.php?" + query_string, false);
	xmlHttp.send(null);
	return xmlHttp.responseText;
}

/*
 Registers a new user into the database
 newXXX are new values for each of the recipe attributes
 INPUTS: username, password, email
 OUTPUTS: returns a true else alerts an error message and returns false;
*/
function registerUser(username, email, password, confirm) {
    if (username === '' || email === '' || password === '') {
        alert("You left a field blank");
        return 0;
    }
    // TODO(rfarias2): more password restraints
    if (password.length < 8) {
        alert("Password needs to be more than 8 characters long.");
        return;
    }
    if (password !== confirm) {
        alert("Password and Confirm Password do not match.");
        return;
    }

    var query_string = 'query_type=5'
        + '&username=' + username
        + '&userEmail=' + email
        + '&password=' + password;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "database.php?" + query_string, false);
    xmlHttp.send(null);
    if (xmlHttp.responseText === '1') {
        return true;
    }
    else {
        alert(xmlHttp.responseText);
    }
    return false;
}

function favoriteRecipe(recipeId, userEmail) {
    var query_string = 'query_type=10'
        + '&recipeId=' + recipeId
        + '&userEmail=' + userEmail;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "database.php?" + query_string, false);
    xmlHttp.send(null);

    return xmlHttp.responseText;
}

function unfavoriteRecipe(recipeId, userEmail) {
    var query_string = 'query_type=11'
        + '&recipeId=' + recipeId
        + '&userEmail=' + userEmail;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "database.php?" + query_string, false);
    xmlHttp.send(null);

    return xmlHttp.responseText;
}

function rateRecipe(recipeID, userEmail, rating) {
    var query_string = 'query_type=12'
        + '&recipeId=' + recipeID
        + '&userEmail=' + userEmail
        + '&rating=' + rating;

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "database.php?" + query_string, false);
    xmlHttp.send(null);

    return xmlHttp.responseText;
}