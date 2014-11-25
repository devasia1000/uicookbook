<?php
/**
 * Created by PhpStorm.
 * User: rayfa_000
 * Date: 11/14/2014
 * Time: 6:59 PM
 */
session_start();

require "database_interface.php";

insertRecipe($_POST["recipeName"], $_POST["steps"], $_SESSION["userEmail"]);

$recipeID = recipeSearch ('', $_POST["recipeName"], $_POST["steps"],
    $_SESSION["userEmail"])[0]["recipeid"];

echo $recipeID;
foreach($_POST["ingredients"] as $ingredient) {
    if ($ingredient["name"] !== "" && $ingredient["amount"] !== "") {
        echo "inserting";
        insertIngredient($recipeID, $ingredient["name"], $ingredient["amount"]);
    }
}

header("Location: home.php");