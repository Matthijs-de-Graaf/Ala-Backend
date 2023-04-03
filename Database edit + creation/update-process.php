<?php
// Include database.php, check database.php for more info
    include_once 'database.php';

    if(count($_POST)>0) {
        mysqli_query($conn,"UPDATE questions SET 
            question='" . $_POST['question'] ."',
            score='" . $_POST['score'] ."'
            WHERE id='" . $_GET['id'] ."'");  
        $message = "Record Modified Successfully";
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    } else {
        $id = 1;
    }
    $result = mysqli_query($conn,"SELECT * FROM questions WHERE id=".$id);
    $row= mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit vragen</title>
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
            <form name="frmUser" method="POST" action="">
                <div><?php if(isset($message)) { echo $message; } ?></div>
                <div style="padding-bottom:5px;">
                <a href="retrieve.php">Terug naar de vragenlijst</a>
                </div>
                Vraagnummer:<br>
                <?php echo $_GET['question']; ?>
                <br>
                Question:<br>
                <input type="text" name="question" class="txtField" value="<?php echo $row['question']; ?>">
                <br>
                Score:<br>
                <input type="number" name="score" placeholder="Insert Value here, from -3 to 3" min="-3" max="3" value="<?php echo $row['score']; ?>"><br>
                <br>
                <input type="submit" name="submit" value="Submit" class="buttom">
            </form>
        </main>
        <footer>
		    <p>Gemaakt door het team van MBO Rijnland</p>
	    </footer>
    </body>
</html>