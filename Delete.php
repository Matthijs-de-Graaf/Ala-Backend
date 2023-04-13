<?php
    // Maakt verbinding met de database, voor meer informatie check database.php
    include_once 'database.php';
    // Probeert de delete-query te versturen. Als het niet lukt, stuurt het nog steeds terug.
    try {
        // Verstuurt een delete-query naar de database.
        $stmt = $conn->prepare("DELETE FROM questions WHERE id= :id");
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        // Stuurt de gebruiker terug zodat ze hier niet kunnen knoeien.
        header("Location: Retrieve.php");
        // Als er een fout optreedt, stuurt het nog steeds de gebruiker terug.
    } catch (\Throwable $th) {
        //throw $th;
        // Stuurt de gebruiker terug zodat ze hier niet kunnen knoeien.
        header("Location: Retrieve.php");
    } 
?>