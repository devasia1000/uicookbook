<?php
/**
 * Created by PhpStorm.
 * User: rayfa_000
 * Date: 11/14/2014
 * Time: 6:59 PM
 */

require "database_interface.php";

updateRecipe($_POST["recipeID"], $_POST["recipeName"], $_POST["steps"], $_SESSION["userEmail"]);

foreach($_POST["ingredients"] as $ingredient) {
    if ($ingredient["name"] !== "") {
        if ($ingredient["amount"] == 0) {
            deleteIngredient($_POST["recipeID"], $ingredient["name"]);
        } else {
            insertIngredient($_POST["recipeID"], $ingredient["name"], $ingredient["amount"]);
        }
    }
}

header("Location: home.php");