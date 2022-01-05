<?php
require_once 'config.php';
require_once 'include/function/function.php';
// This page is deleting employee based on id
$id = $_GET['num'];
delete_data($id);
header("location:index.php");
?>