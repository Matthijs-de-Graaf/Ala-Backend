<?php
    // Inclusief de database connectie, erg belangrijk om niet te verwijderen
    include_once 'database.php';
    $stmt = $conn->prepare("INSERT INTO vragen (vraag, score) VALUES(:vraag, :score)");
    $stmt->bindParam(':vraag', $_POST['vraag']);
    $stmt->bindParam(':score', $_POST['score']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vragen Toevoegen</title>
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
                        <input class="vragen1" type="text" name="vraag" placeholder="Voeg hier een vraag toe" require><br>
                        Score:<br>
                        <input class="vragen1" type="number" name="score" placeholder="Voeg hier een cijfer van -3 tot 3." min="-3" max="3" require><br>
                        <input class="btn" type="submit" name="toevoegen" value="Toevoegen">
                    </form>
                </article>
            </section>
            <?php
            // controleert of de toevoegen knop is geklikt
            if(isset($_POST['toevoegen'])){
                // controleert of de waarde tussen -3 en 3 ligt
                if($_POST['score'] < -3 OR $_POST['score'] > 3){
                    // geeft een melding als dit niet het geval is
                    echo 'Er is een onbekende fout opgetreden. Dit gebeurt meestal als je geen waarde binnen de opgegeven bereiken geeft.';
                } else {
                    // voegt de vraag toe aan de database als het wel het geval is
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
<h3>Volg ons</h3>
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