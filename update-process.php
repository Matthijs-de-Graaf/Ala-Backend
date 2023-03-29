<?php
var_dump($_POST); // Debug statement to display contents of $_POST array

include_once 'database.php';

if(count($_POST)>0) {
    mysqli_query($conn,"UPDATE questions SET 
        question='" . $_POST['question'] ."',
        score='" . $_POST['score'] ."'
        WHERE id='" . $_POST['id'] ."'");  
    $message = "Record Modified Successfully";
}

$result = mysqli_query($conn,"SELECT * FROM questions");
$row= mysqli_fetch_array($result);
?>
<html>
<head>
<title>Update questions Data</title>
</head>
<body>
<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="retrieve.php">questions List</a>
</div>
Id: <br>
<input type="hidden" name="id" class="txtField" value="<?php echo $row['id']; ?>">
<input type="text" name="id"  value="<?php echo $row['id']; ?>">
<br>
Question: <br>
<input type="text" name="question" class="txtField" value="<?php echo $row['question']; ?>">
<br>
Score :<br>
<input type="text" name="score" class="txtField" value="<?php echo $row['score']; ?>">
<br>
<input type="submit" name="submit" value="Submit" class="buttom">
</form>
</body>
</html>
