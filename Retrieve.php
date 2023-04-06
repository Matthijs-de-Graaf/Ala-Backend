<?php
// Include database.php, check database.php for more info
include_once 'database.php';
// Saves everything from the table questions in $result
$result = mysqli_query($conn,"SELECT * FROM questions");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update vragen</title>
	<link rel="stylesheet" href="Ala.css">
</head>
<body>
	<header>
	<img class="logo" src="DocuCheck.png ">
        <nav>
            <a class="white" href="Ala.php">Home</a>
            <a class="white" href="Toevoegen.php">Toevoegen</a>
            <a class="white" href="Retrieve.php">Vragenlijst</a>
			<a class="white" href="Vragen-Beantwoorden.php">Beantwoorden</a>
			<a class="white" href="DocumentenCheck.php">DocuCheck</a>
        </nav>
    </header>
	<main>
			
		<?php
		// This will keep executing untill result is equal to or lower then 0
		if (mysqli_num_rows($result) > 0) {
		?>
		<table>
			  <tr>
			    <td>Vraagnummer:</td>
				<td>Vragen</td>
				<td>Score</td>
			  </tr>
					<?php
					// Establishes $i. as in index makes it easier to do a while loop, the i itself is also used as a fake question id. Since the real id's tend to get messy and out of order.
					$i=1;
					// Starts the while loop to display all questions
					while($row = mysqli_fetch_array($result)) {
					?>
						<tr>
							<!--echos $i to act as a fake id-->
							<td><?php echo $i?></td>
							<!--Echos the question and score that question has-->
							<td><?php echo $row["question"]; ?></td>
							<td><?php echo $row["score"]; ?></td>
							<!--Sends the user to update-process.php with the id in there as a GET, making it easier to work with-->
							<td>
							<a href="update-process.php?id=<?php echo $row["id"].'&question='.$i; ?>">Bewerken</a>
							</td>
							<!--Sends the user to delete.php with a Get statement, same as above but also uses an ONCLICk to warn the user before deleting it-->
							<td><a onclick="warning()" href="Delete.php?id=<?php echo $row["id"]; ?>">Verwijderen</a></td>
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
		 <?php
		}else{
			//roasts the user.
		    echo "No result found";
		}
		?>	
	</main>
	<footer>
		<p>Gemaakt door het team van MBO Rijnland</p>
	</footer>
	</body>
</html>