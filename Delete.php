<?php
include_once 'database.php';
$id = $_GET['id'];
$result = mysqli_query($conn,"DELETE FROM questions WHERE id=".$id);
header("Location: Retrieve.php")
?>