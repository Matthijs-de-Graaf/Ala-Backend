<?php
include_once "Database.php";
// Handle save and delete actions
if (isset($_POST['action']) && isset($_POST['id'])) {
  $id = $_POST['id'];
  if ($_POST['action'] == 'save') {
    $query = "UPDATE documents SET saved_at = CURRENT_TIMESTAMP WHERE id = $id";
    $result = $conn->query($query);
    if (!$result) {
      die('Failed to save document: ' . $conn->error);
    }
  } else if ($_POST['action'] == 'delete') {
    $query = "DELETE FROM documents WHERE id = $id";
    $result = $conn->query($query);
    if (!$result) {
      die('Failed to delete document: ' . $conn->error);
    }
  }
}

// Handle file upload
if (isset($_FILES['file'])) {
  $filename = $_FILES['file']['name'];
  $tmpname = $_FILES['file']['tmp_name'];
  $path = "uploads/$filename";
  if (move_uploaded_file($tmpname, $path)) {
    $query = "INSERT INTO documents (filename, path) VALUES ('$filename', '$path')";
    $result = $conn->query($query);
    if (!$result) {
      die('Failed to save document: ' . $conn->error);
    }
    echo "File uploaded successfully.";
  } else {
    echo "Failed to upload file.";
  }
}

// Retrieve a random document from the database
$query = "SELECT * FROM documents WHERE saved_at IS NULL ORDER BY RAND() LIMIT 1";
$result = $conn->query($query);
if (!$result) {
  die('Failed to retrieve document: ' . $conn->error);
}

// Display the document to the user
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $path = $row['path'];
  $filename = $row['filename'];
  echo "<img src='$path' alt='$filename'>";
  echo "<br>";
  echo "<button onclick='saveDocument({$row['id']})'>Yes</button>";
  echo "<button onclick='deleteDocument({$row['id']})'>No</button>";
} else {
  echo "No documents found.";
}

// Close the database connection
$conn->close();
?>

<form method="post" enctype="multipart/form-data">
  <input type="file" name="file">
  <button type="submit">Upload</button>
</form>
