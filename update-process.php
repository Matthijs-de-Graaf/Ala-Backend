<?php
// Include database.php, check database.php for more info
include_once 'database.php';

if(count($_POST)>0) {
    $stmt = $conn->prepare("UPDATE questions SET question=:question, score=:score WHERE id=:id");
    $stmt->bindParam(':question', $_POST['question']);
    $stmt->bindParam(':score', $_POST['score']);
    $stmt->bindParam(':id', $_POST['score']);
    $message = "Record succesvol gewijzigd";
    try{
        $stmt->execute();
    } catch(PDOException $e){
        $message = "Wijzigen van record mislukt:<br>".$e;
    }
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    $id = 0;
}

$result = $conn->prepare("SELECT * FROM questions WHERE id=:id");
$result->bindParam(':id', $id);
$result->execute();
$row = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vragen bewerken</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <header>
            <img class="logo" src="DocuCheck.png ">
            <nav>
                <a class="white" href="Ala.php">Home</a>
                <a class="white" href="Toevoegen.php">Toevoegen</a>
                <a class="white" href="Retrieve.php">Vragenlijst</a>
                <a class="white" href="DocumentenCheck.php">DocuCheck</a>
            </nav>
        </header>
        <?php
        foreach($row as $row){
        ?>
        <main>
            <form name="frmUser" method="POST">
                <div><?php if(isset($message)) { echo $message; } ?></div>
                <div>
                <a href="retrieve.php">Terug naar de vragenlijst</a>
                </div>
                Vraagnummer:<br>
                <?php echo $_GET['question']; ?>
                <br>
                Vraag:<br>
                <input type="text" name="question" class="txtField" value="<?php echo $row['question']; }?>">
                <br>
                Score:<br>
                <input type="number" name="score" placeholder="Voeg hier een waarde in, van -3 tot 3" min="-3" max="3" value="<?php echo $row['score']; ?>"><br>
                <br>
                <input type="submit" name="submit" value="Verzenden" class="buttom">
            </form>
        </main>
        <footer>
		<article>
			<h3>Contact ons:</h3>
			<p>Betaplein 18, 2321 KS Leiden</p>
			<p>Telefoonnummer: 31621092975</p>
			<p>Email: 6028832@mborijnland.nl</p>
		</article>
<article>
<h3>Follow Us</h3>
        <ul class="social-media">
          <li><a href="#"><i class="fa fa-facebook">Facebook</i></a></li>
          <li><a href="#"><i class="fa fa-twitter">Twitter</i></a></li>
          <li><a href="#"><i class="fa fa-linkedin">LinkedIn</i></a></li>
          <li><a href="#"><i class="fa fa-instagram">Instagram</i></a></li>
        </ul>
</article>
	</footer>
    </body>
</html>