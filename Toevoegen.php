<?php
    // Includes the daatabase connection, very important no delete
    include_once 'database.php';
    $stmt = $conn->prepare("INSERT INTO questions (question, score) VALUES(:question, :score)");
    $stmt->bindParam(':question', $_POST['question']);
    $stmt->bindParam(':score', $_POST['score']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update vragen</title>
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
        <main>
            <section>
                <article>
                    <form method="POST">
                       Vraag:<br>
                        <input class="vragen1" type="text" name="question" placeholder="Voeg hier een vraag toe" require><br>
                        Score:<br>
                        <input class="vragen1" type="number" name="score" placeholder="Voeg hier een cijfer van -3 tot 3." min="-3" max="3" require><br>
                        <input class="btn" type="submit" name="toevoegen" value="Toevoegen">
                    </form>
                </article>
            </section>
            <?php
            // checks if the submit button has been clicked
            if(isset($_POST['toevoegen'])){
                // checks if the value is indeed inbetween -3 and 3
                if($_POST['score'] < -3 OR $_POST['score'] > 3){
                    // gives  them meme if it isnt
                    echo 'An unkown error occurred. This usually happends when you dont fill give a value within the specified ranges.';
                } else {
                    // updates the database if it is
                    $stmt->execute();
                }
            }
            ?>
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