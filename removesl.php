<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 16.11.2014
 * Time: 18:52
 */
session_start();
unset($_SESSION["shopping_list"][$_GET["id"]]);
header("Location: home.php");
return;