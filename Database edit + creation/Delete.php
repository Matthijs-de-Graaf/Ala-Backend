<?php
    // Conects to the database, for more info  check database.php
    include_once 'database.php';
    // Tries to send the delete query. if it fails it still sends it back.
    try {
        // Sends a delete query to the databse.
        $result = mysqli_query($conn,"DELETE FROM questions WHERE id=".$_GET['id']);
        // Sends the user back so they cant mess around over here
        header("Location: Retrieve.php");
        // if there is an error it will still send the user back
    } catch (\Throwable $th) {
        //throw $th;
        // Sends the user back so they cant mess around over here
        header("Location: Retrieve.php");
    } 
?>