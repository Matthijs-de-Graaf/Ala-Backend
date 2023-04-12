<?php
    session_start();
    if(!isset($_SESSION['id'])){
        $_SESSION['id'] = [];
    }
    $score = 0;
    function fetch($value){
        include 'database.php';
        // makes the $result value global, making it useable outside the function
        global $result;
        // Changes $query to use the value given in the fetch statement later
        // why is $query = $query -Anil
        $query = 'WHERE score = -'.$value.' OR score = '.$value.'';

        if(count($_SESSION['id']) != 0){
            $query .= ' AND ID NOT IN (';
            $first = true;
            foreach($_SESSION['id'] as $id){
                if (!$first) {
                    $query .= ', ';
                } else {
                    $first = false;
                }
                $query .= '\'' . $id . '\'';
            }
            $query .= ')';
        }

        // Makes use of $query to costumize the search for questions. Also grabs a random one of the questions.
        $stmt = $conn->prepare("SELECT * FROM questions $query ORDER BY RAND() LIMIT 1");
        $stmt->execute();

        global $question;

        $question = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    function getQuestion($a){
        if($a === 0){
            // fetches for a questions with a score of 3
            fetch(3);
        } else if($a >= 0 || $a <= 0){
            if($a >= 6 || $a <= -6){
                // fetches for a questions with a score of 2
                fetch(1);
            } elseif($a >= 3 || $a <= -3){
                fetch(2);
            } else{
                fetch(3);
            }
        }
    }

    if(isset($_SESSION['score'])){
        getQuestion($_SESSION['score']);
    } else{
        getQuestion($score);
    }

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
    </header>
    <main>
            <h1>
                Advies Page
            </h1>

        <?php
        // Adds score value to ja and nee question
        foreach($question as $question){
            $ja = $question['score'];
            $nee = $question['score'] * -1;
        }
        
        // adds punten variable, as a session. (important)
        $_SESSION['punten'] = 0;
        ?>
    <form method="POST">
        <?php
        echo '<p>'.$question['question'].'</p>';
        ?>
        <input type="radio" name="answer" value=<?php
        echo '"'.$ja.'"';
        ?> required>
        Ja<br>
        <input type="radio" name="answer" value=<?php
        echo '"'.$nee.'"'
        // not yet decided if needed. We are not sure yet if saaying no should give you the inverse of the yes points.
        ?> required>
        Nee<br>
        <input type="radio" name="answer" value="0" require>
        Weet ik niet<br>
        <input type="Submit" name='MatthijsGae'>
    </form>
    <?php
if (isset($_POST['MatthijsGae'])) {
    if ($_POST['answer'] < 3 || $_POST['answer'] > -3) {
        if (isset($_SESSION['score'])) {
            $_SESSION['score'] += $_POST['answer'];
        } else {
            $_SESSION['score'] = 0;
            $_SESSION['score'] += $_POST['answer'];
        }

        if (!in_array($question['id'], $_SESSION['id'])) {
            array_push($_SESSION['id'], $question['id']);
        }
        unset($_POST['MatthijsGae']);
        unset($_POST['answer']);
        echo $_SESSION['score'];
    }
}
echo '<br>';
echo '<br>';
if(isset($_SESSION['score'])){
    if($_SESSION['score'] >= 10 || $_SESSION['score'] <= -10){
        if($_SESSION['score'] >= 10){
            echo 'We recommend to keep the file.';
        } elseif($_SESSION['score'] <= -10){
            echo 'We recommend to delte the file.';
        }
        session_unset();
    }
}
    ?>
    </main>
        	<footer id='footer_id'>
    		<p>Gemaakt door het team van MBO Rijnland</p>
    	</footer>
    </body>
<html>