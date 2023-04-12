<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DocuCheck</title>
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
    <?php
// Set de paden voor de "Keep" en "Delete" mappen
$keepDir = "uploads/keep/";
$deleteDir = "uploads/delete/";

// Maak de "Keep" map aan als deze niet bestaat
if (!file_exists($keepDir)) {
  if (!mkdir($keepDir, 0777, true)) {
    die("Kon map niet aanmaken: $keepDir");
  }
}

// Maak de "Delete" map aan als deze niet bestaat
if (!file_exists($deleteDir)) {
  if (!mkdir($deleteDir, 0777, true)) {
    die("Kon map niet aanmaken: $deleteDir");
  }
}

// Controleer of de "Keep" knop is ingedrukt
if(isset($_POST['keep'])) {
  // Haal de geüploade bestandsinformatie op
  $fileName = basename($_FILES["fileToUpload"]["name"]);
  $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];
  $fileType = $_FILES["fileToUpload"]["type"];


  // Stel het bestandspad en de naam in voor de "Keep" map
  $keepPath = $keepDir . $fileName;

  // Verplaats het geüploade bestand naar de "Keep" map
  if (move_uploaded_file($fileTmpName, $keepPath)) {
    echo "Bestand succesvol geüpload en bewaard.";
  } else {
    echo "Sorry, er is een fout opgetreden bij het uploaden en bewaren van uw bestand.";
  }
}

// Controleer of de "Delete" knop is ingedrukt
if(isset($_POST['delete'])) {
  // Haal de geüploade bestandsinformatie op
  $fileName = basename($_FILES["fileToUpload"]["name"]);
  $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];
  $fileType = $_FILES["fileToUpload"]["type"];


  // Stel het bestandspad en de naam in voor de "Delete" map
  $deletePath = $deleteDir . $fileName;

  // Verplaats het geüploade bestand naar de "Delete" map
  if (move_uploaded_file($fileTmpName, $deletePath)) {
    echo "Bestand succesvol geüpload en gemarkeerd voor verwijdering.";
  } else {
    echo "Sorry, er is een fout opgetreden bij het uploaden en markeren voor verwijdering van uw bestand.";
  }
}

// Laat de geüploade foto zien uit de "Keep" map
if(isset($_FILES['fileToUpload'])){
  $fileName = basename($_FILES["fileToUpload"]["name"]);
}
if(isset($fileName)){
  $keepPath = $keepDir . $fileName;
}
if(isset($keepPath)){
  if(file_exists($keepPath)) {
  echo "<h2>Geüpload bestand:</h2>";
  echo "<p>Bestandsnaam: $fileName";
}
}
?>

<script>
function smollWindow(){
  window.open('Vragen-Beantwoorden.php','targetWindow','fullscreen=no,width=500,height=380');
  return false;
}
</script>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  <h2>Selecteer een bestand om te uploaden:</h2><br>
  <input  type="file" name="fileToUpload"><br><br>
  <input class="btn" type="submit" name="keep" value="Bewaren">
  <input class="btn" type="submit" name="delete" value="Verwijderen"><br>
  <br>
  <input class="btn" type="button" name='advies' value='Ontvang advies' onclick="smollWindow()">
</form>
    </main>
    
<?php
$keepCount = count(glob($keepDir . "*"));

// Haal het aantal bestanden op in de "Delete" map
$deleteCount = count(glob($deleteDir . "*"));

// Laat de aantallen zien op de website
echo "<p id=id2>Aantal bestanden in de map <a href=uploads/keep/>Keep:</a> $keepCount <br> Aantal bestanden in de map <a href=uploads/delete/>Delete:</a> $deleteCount</p>";

if(isset($_POST['unset'])){
session_unset();
}
?>
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