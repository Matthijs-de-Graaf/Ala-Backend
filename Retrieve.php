<?php
// Inclusief database.php, controleer database.php voor meer informatie
include_once 'database.php';
// Sla alles op van de tabel vragen in $resultaat
$stmt = $conn->query("SELECT * FROM questions ORDER BY score DESC");
$resultaat = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Vragen bijwerken</title>
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
	<main id="main_id">
		<table>
			  <tr>
			    <td>Vraagnummer:</td>
				<td>Vragen</td>
				<td>Score</td>
			  </tr>
						<tr>
						<?php
		// Dit zal blijven uitvoeren totdat resultaat gelijk is aan of lager dan 0
		$i=1;
		foreach ($resultaat as $rij) {
		?>
							<!--echos $i om te dienen als een nep-id-->
							<td><?php echo $i?></td>
							<!--Echos de vraag en score die bij die vraag horen-->
							<td class="vragen"><?php echo $rij["question"];?></td>
							<td><?php echo $rij["score"]; ?></td>
							<!--Stuurt de gebruiker naar update-process.php met het id als GET, waardoor het gemakkelijker wordt om mee te werken-->
							<td><a class="btn" href="update-process.php?id=<?php echo $rij["id"].'&question='.$i; ?>">Bewerken</a></td>
							<!--Stuurt de gebruiker naar delete.php met een Get statement, hetzelfde als hierboven, maar gebruikt ook een ONCLICk om de gebruiker te waarschuwen voordat deze wordt verwijderd-->
							<td><a class="btn" onclick="waarschuwing()" href="Delete.php?id=<?php echo $rij["id"]; ?>">Verwijderen</a></td>
							<script> 
								function waarschuwing(){
									let tekst = "Weet u zeker dat u deze vraag wilt verwijderen?";
		  								if (confirm(tekst) == false) {
											event.preventDefault();
		  								}
									}
							</script>
		    		    </tr>
						<?php
						// als je niet weet wat dit is, maak ik me ernstig zorgen
						// Anil kent deze regel code niet daarom schrijft hij dit ^
						$i++;
								}
						?>
		</table>
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