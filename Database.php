<?php
// // Establishes conection to the databse, using variables to make it easier.
//    $servername='localhost';
//    $username='root';
//    $password='';
//    $dbname = "ALA_Questions_test";
//    // the part that connects to the databse itself
//    $conn = mysqli_connect($servername,$username,$password,"$dbname");
//    if(!$conn){
//       die('Could not Connect My Sql:' .mysql_error());
//    }
?>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ALA_Questions_test";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::FETCH_ASSOC, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
        echo "The jews are at it again:<br>" . $e->getMessage();;
        }
    ?>