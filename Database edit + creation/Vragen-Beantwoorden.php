<?php

    // to anil in the future
    // you died inside so here is the current problem
    // You made the fetch if statement into a function named get question
    // you added an if statement into the fetch function 
    // ok enough beating around the bush the problem has something to do with the way you add ids in the bottom of the page and how it gets processed by the if statement in the fetch function
    session_start();

    if(isset($_SESSION['score'])){
        $score = $_SESSION['score'];
    } else {
        $_SESSION['score'] = 0;
        $score = $_SESSION['score'];
    }

    if(isset($_SESSION['id'])){
        $od = $_SESSION['id'];
    } else {
        $od = null;
    }

    function fetch($value, $b){
        include_once 'database.php';
        // makes the $result value global, making it useable outside the function
        global $result;

        if ($b != null) {
            $c = 'AND NOT ID = '.'('.$b.')';
        } else {
            $c = null;
        }
        // Changes $query to use the value given in the fetch statement later
        // why is $query = $query -Anil
        $query = 'WHERE score = -'.$value.' OR score = '.$value.$c;
        // Makes use of $query to costumize the search for questions. Also grabs a random one of the questions.
        $result = mysqli_query($conn,"SELECT * FROM questions ".$query." ORDER BY RAND() LIMIT 1");
    }


    function getQuestion($a, $b){
        if($a === 0){
            // fetches for a questions with a score of 3
            fetch(3, $b);
        } else if($a >= 0 || $a <= 0){
            if($a >= 5 || $a <= -5){
                // fetches for a questions with a score of 2
                fetch(2, $b);
            } else {
                // fetches for a question with thee score of 3
                fetch(3, $b);
            }
        }
    }
    // if ($score === 0){
    //     getQuestion($score);
    // }
    getQuestion($score, $od);

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
    <main id="main_id">
            <h1>
                Vragen Beantwoorden test
            </h1>

        <?php
        // Grabs question from DB   
        $question = mysqli_fetch_assoc($result);
        // Adds score value to ja and nee question
        $ja = $question['score'];
        $nee = $question['score'] * -1;
        // adds punten variable, as a session. (important)
        $_SESSION['punten'] = 0;
        ?>
    <form method="POST">
        <?php
        echo '<p>'.$question['question'].'</p>';
        ?>
        <input type="radio" name="answer" value=<?php
        echo '"'.$ja.'"';
        ?>>
        Ja<br>
        <input type="radio" name="answer" value=<?php
        echo '"'.$nee.'"'
        // not yet decided if needed. We are not sure yet if saaying no should give you the inverse of the yes points.
        ?>>
        Nee<br>
        <input type="radio" name="answer" value="0">
        Weet ik niet<br>
        <input type="Submit" name='MatthijsGae'>
    </form>
    <?php
    if(isset($_POST['MatthijsGae'])){
        $_SESSION['score'] =+ $_POST['answer'];
        if($id != null){
            $id =+ ','.$question['id'];
        } else {
            $id = $question['id'];
        }
        $_SESSION['id'] = $id;
        echo $_SESSION['score'];
    }
    ?>
    
    <form method="POST">
        <h1>
            SESSION abort button very epic gaymer moment
        </h1>
        <input type="submit" name='abort' value='abort'>
    </form>
    <?php
    if(isset($_POST['abort'])){
        session_abort();
    }
    ?>
    </main>

    </body>
<html>