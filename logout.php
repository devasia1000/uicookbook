<?php
/**
 * Created by PhpStorm.
 * User: rayfa_000
 * Date: 10/30/2014
 * Time: 1:57 PM
 */
session_start();
unset($_SESSION["userEmail"]);
header("Location: index.php");