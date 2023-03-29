<?php
include_once 'database.php';
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
	<img class="logo" src="Logo.png">
        <nav>
            <a class="white" href="Ala.php">Home</a>
            <a class="white" href="Toevoegen.php">Toevoegen</a>
            <a class="white" href="Retrieve.php">Vragenlijst</a>
        </nav>
    </header>
<?php
if (mysqli_num_rows($result) > 0) {
?>
<table>
	  <tr>
	    <td>Vraagnummer:</td>
		<td>Vragen</td>
		<td>Score</td>
	  </tr>
			<?php
			$i=1;
			while($row = mysqli_fetch_array($result)) {
			?>
	  <tr>
	    <td><?php echo $i?></td>
		<td><?php echo $row["question"]; ?></td>
		<td><?php echo $row["score"]; ?></td>
		<td><a href="update-process.php?id=<?php echo $row["id"].'&question='.$i; ?>">Bewerken</a></td>
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
			$i++;
			}
			?>
</table>
 <?php
}
else
{
    echo "No result found";
}
?>	
	<footer>
		<p>Gemaakt door het team van MBO Rijnland</p>
	</footer>
 </body>
</html>