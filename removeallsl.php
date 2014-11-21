<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 16.11.2014
 * Time: 19:31
 */
session_start();
unset($_SESSION["shopping_list"]);
header("Location: home.php");
return;