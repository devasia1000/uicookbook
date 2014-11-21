<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 16.11.2014
 * Time: 16:47
 */
session_start();
if(!isset($_SESSION["shopping_list"])) {
    $_SESSION["shopping_list"] = array();
}
$_SESSION["shopping_list"][$_GET["id"]] = $_GET["recipeName"];
header("Location: home.php");
return;