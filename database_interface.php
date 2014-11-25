<?php
// TODO(rfarias2) if any function fail to prepare statements there is terrible undefined behaviors.

/**
 * Wraps strings in SQL wild card tags to be used in WHERE-LIKE statements.
 * @param string $str the string to turn into a wild card.
 * @return string the string wrapped in wildcard symbols
 */
function wildCard($str) {
	if (empty($str)) {
		return "%";
	}
    return "%$str%";
}

/**
 * Connects to the database for the website.
 * @return mysqli the connection to the database.
 */
function connect() {
    $host = "engr-cpanel-mysql.engr.illinois.edu";
    $user = "uicookbo_develop";
    $password = "password";
    $database = "uicookbo_main";

    $mysqli = new mysqli($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        // exit?
    }

    return $mysqli;
}

/**
 * @param $email
 * @return array
 */
function getUserRecipes ($email) {
	$db = connect();

	$query = "SELECT recipeName, steps, recipeid";
    $query .= " FROM recipes JOIN users ON recipes.userEmail=users.email WHERE users.email = ?";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $result_arr = array();

        while($row = mysqli_fetch_assoc($result)) {
            array_push($result_arr, $row);
        }

        $stmt->close();
        $db->close();
        return $result_arr;
    }

	return null;
}


/**
 * Returns a list of matching recipes according to search terms using wild cards for parameters
 * set to an empty string.
 * @param $recipeId
 * @param $recipeName
 * @param $steps
 * @param $userEmail
 * @return array
 */
function recipeSearch ($recipeId, $recipeName, $steps, $userEmail) {
    $db = connect();
    $recipeId = wildCard($recipeId);
    $recipeName = wildCard($recipeName);
    $steps = wildCard($steps);
    $userEmail = wildCard($userEmail);


    $query = "SELECT * FROM recipes";
    $query .= " WHERE recipeId LIKE ? AND recipeName LIKE ? AND steps LIKE ? AND userEmail LIKE ?";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("ssss", $recipeId, $recipeName, $steps, $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        $result_arr = array();

        while($row = mysqli_fetch_assoc($result)) {
            array_push($result_arr, $row);
        }

        $stmt->close();
        $db->close();
        return $result_arr;
    }

    return null;
}


/**
 * Inserts a new recipe into the table.
 * @param $recipeName
 * @param $steps
 * @param $userEmail
 */
function insertRecipe ($recipeName, $steps, $userEmail) {
    $db = connect();

    $query = "INSERT INTO recipes(recipeName, steps, userEmail) VALUES (?, ?, ?)";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("sss", $recipeName, $steps, $userEmail);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }
}


/**
 * Deletes a recipe.
 * @param $recipeId
 * @return int
 */
function deleteRecipe ($recipeId) {
    $db = connect();

    $query = "DELETE FROM recipes WHERE recipeId=?";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("sss", $recipeId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }
}


/**
 * Updates a recipe.
 * @param $recipeId
 * @param $recipeName
 * @param $steps
 * @return int
 */
function updateRecipe ($recipeId, $recipeName, $steps) {
    $db = connect();

    $query = "UPDATE recipes SET recipeName=?, steps=? WHERE recipeId=?";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("ssi", $recipeName, $steps, $recipeId);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }
}

/**
 * Gets a recipe's ingredients.
 * @param $recipeId
 * @return array
 */
function getRecipeIngredients($recipeId) {
    $db = connect();

    $query = "SELECT ingredientName, amount FROM ingredients WHERE recipeId = ?";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();

        $result_arr = array();

        while($row = mysqli_fetch_array($result)) {
            array_push($result_arr, $row);
        }

        $stmt->close();
        $db->close();
        return $result_arr;
    }
    return null;
}

/**
 * @param $recipeId
 * @return mixed
 */
function getRecipeRating($recipeId) {
    $db = connect();

    $query = "SELECT AVG(rating) FROM ratings WHERE recipeId = ?";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = mysqli_fetch_array($stmt->get_result());
        $stmt->close();
        $db->close();
        return substr($result[0], 0, 4);
    }
    return null;
}

/**
 * @param $userEmail
 * @param $recipeId
 * @return bool
 */
function hasUserFavorited($userEmail, $recipeId) {
    $db = connect();

    $query = "SELECT * FROM favorites WHERE recipeId = ? AND userEmail = ?";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("is", $recipeId, $userEmail);
        $stmt->execute();
        $result = mysqli_num_rows($stmt->get_result());
        $stmt->close();
        $db->close();
        if ($result == 1) {
            return true;
        }
        return false;
    }
    return "blarg";
}

/**
 * @param $userEmail
 * @return array
 */
function getUserFavorites($userEmail) {
    $db = connect();

    $query = "SELECT favorites.recipeID, recipes.recipeName FROM favorites, recipes";
    $query .= " WHERE recipes.recipeid = favorites.recipeID AND favorites.userEmail = ?";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        $result_arr = array();

        while($row = mysqli_fetch_assoc($result)) {
            array_push($result_arr, $row);
        }

        $stmt->close();
        $db->close();
        return $result_arr;
    }
    return null;
}


/**
 * @param $userEmail
 * @param $recipeId
 * @return mixed
 */
function getUserRating($userEmail, $recipeId) {
    $db = connect();

    $query = "SELECT rating FROM ratings WHERE recipeId = ? AND userEmail = ?";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("is", $recipeId, $userEmail);
        $stmt->execute();
        $result = mysqli_fetch_array($stmt->get_result());
        $stmt->close();
        $db->close();
        return $result[0];
    }
    return null;
}


/**
 * @param $recipeId
 * @param $ingredientName
 */
function deleteIngredient($recipeId, $ingredientName) {
    $db = connect();

    $query = "DELETE FROM ingredients WHERE recipeId = ? AND ingredientName = ?";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("is", $recipeId, $ingredientName);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }
}


/**
 * @param $recipeId
 * @param $ingredientName
 * @param $amount
 */
function insertIngredient($recipeId, $ingredientName, $amount) {
    $db = connect();

    $query = "INSERT INTO ingredients(recipeID, ingredientName, amount) VALUES (?, ?, ?) ON";
    $query .= " DUPLICATE KEY UPDATE ingredientName=VALUES(ingredientName), amount=VALUES(amount)";
    $stmt = $db->stmt_init();

    if($stmt->prepare($query)) {
        $stmt->bind_param("iss", $recipeId, $ingredientName, $amount);
        $stmt->execute();
        $stmt->close();
        $db->close();
    }
}


/**
 * TODO(rfarias2): this shit needs cleanup. Referencing in statements is weird.
 * @param $SL
 * @return array|bool|mysqli_result
 */
function listIngredients($SL) {
    $db = connect();

    $query = "SELECT * FROM ingredients WHERE";

    $types = "";
    $user_terms = array();
    foreach($SL as $id => $name) {
        $types .= "i";
        $query = $query . " recipeID = ? OR";
        array_push($user_terms, $id);
    }
    $query = substr($query, 0, -3);

    $temp_terms = array_merge(array($types), $user_terms);
    $terms = array();
    for($i =0; $i < count($temp_terms); $i++) {
        $terms[$i] = &$temp_terms[$i];
    }

    $stmt = $db->stmt_init();
    if($stmt->prepare($query)) {
        call_user_func_array(array($stmt, 'bind_param'), $terms);
        $stmt->execute();
        $result = $stmt->get_result();

        $result_arr = array();

        while($row = mysqli_fetch_array($result)) {
            array_push($result_arr, $row);
        }

        $stmt->close();
        $db->close();
        return $result_arr;
    }
    return null;
}