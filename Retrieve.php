<?php
// Include database.php, check database.php for more info
include_once 'database.php';
// Saves everything from the table questions in $result
$stmt = $conn->query("SELECT * FROM questions ORDER BY score DESC");
$result = $stmt->fetchAll();
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
		<table>
			  <tr>
			    <td>Vraagnummer:</td>
				<td>Vragen</td>
				<td>Score</td>
			  </tr>
						<tr>
						<?php
		// This will keep executing untill result is equal to or lower then 0
		$i=1;
		foreach ($result as $row) {
		?>
							<!--echos $i to act as a fake id-->
							<td><?php echo $i?></td>
							<!--Echos the question and score that question has-->
							<td class="vragen"><?php echo $row["question"];?></td>
							<td><?php echo $row["score"]; ?></td>
							<!--Sends the user to update-process.php with the id in there as a GET, making it easier to work with-->
							<td><a class="btn" href="update-process.php?id=<?php echo $row["id"].'&question='.$i; ?>">Bewerken</a></td>
							<!--Sends the user to delete.php with a Get statement, same as above but also uses an ONCLICk to warn the user before deleting it-->
							<td><a class="btn" onclick="warning()" href="Delete.php?id=<?php echo $row["id"]; ?>">Verwijderen</a></td>
							<script> 
								function warning(){
									let text = "Are you sure you want to delete this question?";
		  								if (confirm(text) == false) {
											event.preventDefault();
		  								}
									}
							</script>
		    		    </tr>
						<?php
						// if you dont know what this is i am very concerned 
						// Anil doesnt know this line of code thats why he writes this ^
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