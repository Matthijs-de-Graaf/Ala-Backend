<?php
// Includes the daatabase connection, very important no delete
include_once 'database.php';
// idk about this part matthijs added it here
// oh he deleted it
// idk about the part above this matthijs added it here
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update vragen</title>
    <link rel="stylesheet" href="Ala.css">
    </head
    <body>
    	<header>
        <img class="logo" src="Logo.png">
            <nav>
                <a class="white" href="Ala.php">Home</a>
                <a class="white" href="Toevoegen.php">Toevoegen</a>
                <a class="white" href="Retrieve.php">Vragenlijst</a>
            </nav>
        </header>
        <main>
            <form method="POST"><!--Joeri, een form is een sort van section EA:
                                    <section> 
                                        <article>
                                            <form>
                                                <input>
                                                Snap je?
                                                <input>
                                            </form>
                                        </article>
                                    </section>-->
               <sectio>Vraag:<br>
                    <input type="text" name="question" placeholder="Voeg hier een vraag toe" require><br></art
                <p>score:</p><br>
                    <input type="number" name="score" placeholder="Voeg hier een cijfer van -3 tot 3." min="-3" max="3" require><br>
                    <input type="submit" name="toevoegen" value="Beeschurgers">
            </form>
            <?php
            // checks if the submit button has been clicked
            if(isset($_POST['toevoegen'])){
                // checks if the value is indeed inbetween -3 and 3
                if($_POST['score'] < -3 OR $_POST['score'] > 3){
                    // gives  them meme if it isnt
                    echo 'An unkown error occurred. This usually happends when you dont fill give a value within the specified ranges.';
                } else {
                    // updates the database if it is
                    $result = mysqli_query($conn,"INSERT INTO questions (question, score) VALUES('".$_POST['question']."','".$_POST['score']."')");
                }
            }
            ?>
        </main>
    	<footer>
    		<p>Gemaakt door het team van MBO Rijnland</p>
    	</footer>
    </body>
</html>