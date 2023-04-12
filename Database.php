<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ALA_Questions_test";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::FETCH_ASSOC, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
        echo "Het werkt niet:<br>" . $e->getMessage();;
        }
?>