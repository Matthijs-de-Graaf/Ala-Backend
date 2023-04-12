<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DocuCheck</title>
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
// Set the paths for the "Keep" and "Delete" directories
$keepDir = "uploads/keep/";
$deleteDir = "uploads/delete/";

// Create the "Keep" directory if it doesn't exist
if (!file_exists($keepDir)) {
  if (!mkdir($keepDir, 0777, true)) {
    die("Failed to create directory: $keepDir");
  }
}

// Create the "Delete" directory if it doesn't exist
if (!file_exists($deleteDir)) {
  if (!mkdir($deleteDir, 0777, true)) {
    die("Failed to create directory: $deleteDir");
  }
}

// Check if the "Keep" button was clicked
if(isset($_POST['keep'])) {
  // Get the uploaded file information
  $fileName = basename($_FILES["fileToUpload"]["name"]);
  $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];
  $fileType = $_FILES["fileToUpload"]["type"];

  // Set the file path and name for the "Keep" folder
  $keepPath = $keepDir . $fileName;

  // Move the uploaded file to the "Keep" folder
  if (move_uploaded_file($fileTmpName, $keepPath)) {
    echo "File uploaded and kept successfully.";
  } else {
    echo "Sorry, there was an error uploading and keeping your file.";
  }
}

// Check if the "Delete" button was clicked
if(isset($_POST['delete'])) {
  // Get the uploaded file information
  $fileName = basename($_FILES["fileToUpload"]["name"]);
  $fileTmpName = $_FILES["fileToUpload"]["tmp_name"];
  $fileType = $_FILES["fileToUpload"]["type"];

  // Set the file path and name for the "Delete" folder
  $deletePath = $deleteDir . $fileName;

  // Move the uploaded file to the "Delete" folder
  if (move_uploaded_file($fileTmpName, $deletePath)) {
    echo "File uploaded and marked for deletion successfully.";
  } else {
    echo "Sorry, there was an error uploading and marking for deletion your file.";
  }
}

// Display the uploaded photo from the "Keep" folder
$fileName = basename($_FILES["fileToUpload"]["name"]);
$keepPath = $keepDir . $fileName;
if(file_exists($keepPath)) {
  echo "<h2>Uploaded document:</h2>";
  echo "<p>Bestand naam:</p>";
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  <h2>Select a photo to upload:</h2>
  <input type="file" name="fileToUpload">
  <br><br>
  <input type="submit" name="keep" value="Keep">
  <input type="submit" name="delete" value="Delete">
</form>

    </main>
</body>
</html>