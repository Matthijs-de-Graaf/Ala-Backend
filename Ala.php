    <?php
    // Starting a session
    session_start();

    // Database connection startup
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ALA_Questions_test";
    
    try {
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Making main db grab, Yes Matthijs you can actually just use one of these
        $data = $db->prepare("SELECT * FROM questions");
        $data->execute();

    } catch (PDOException $e) {
        echo '<p class="white">Connection failed:</p><br>' . $e->getMessage();
        exit();
    }
    // Ending the before the header code.
    ?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vragenlijst</title>
    <link rel="stylesheet" href="Ala.css">
</head>
<body>
    <header>
        <img src="Rijksoverheid_logo.png">
        <nav>
            <a class="white" href="">Bewerken</a>
            <a class="white" href="">Home</a>
            <a class="white" href="">Vragenlijst</a>
        </nav>
    </header>
    <main>

        <!--Question display-->
        <section>
            <article>
                <!--Display Questions-->
                <?php
                // Grabs $data and makes it into an array
                
                foreach($data as $data){
                    echo '<div>
                            <h1 class="white">' . $data['question'] . ' <br>
                            Points = '.$data['score'].'</h1>
                            <form method="POST">
                            <button name="editBtn" value='.$data['id'].'>Edit Question</button>
                            </form>
                          </div>';
                }
                ?>
            </article>
        </section>
        <!--Question Editor -->
        <section>
            <!-- Question Grabber-->
                <?php
                // Checks if edit has been clicked
                if(isset($_POST['editBtn'])){
                // Makes temp value
                    $tempValue = $_POST['editBtn'];
                    if(!isset($_SESSION['id'])){
                        // Makes temp value into a session value
                        $_SESSION['id'] = $tempValue;
                    }
                }

                if(isset($_SESSION['id'])){
                    // Makes temp value a thing
                    $tempValue = $_SESSION['id'];  
                }
                ?>
            <article>
                <!--Voor Renzo en Joeri

                1. Een vraag kunnen toevoegen
                2. Een vraag kunnen bewerken
                3. Een vraag kunnen verwijderen

                side nodes/extra uitleg:
                De question editor moet dus altijd kunnen gebruikt worden, met 3 modus verwijderen, vragen toevoegen en bewerken in dezelfde <form>
                    Je moet natuurlijk kunnnen kiezen wat je doet, het id van de vragen is al makkelijk gegeven namelijke door $tempValue.

                    Jullie hebben volle vrijheid hiermee, alleen moet het wel moeten werken met het systeem.

                    PS alsl jullie de question editor helemaal willen veranderen; De id wordt gestuurd naar $_POST['editBtn']
            -->
                <form>
                    <?php
                    $editValue = "";
                    echo "<h1>Edit vraag<h1> <br> <input type='text' name='editing' value=$editValue> <br>"
                    echo "<h1>Nieuwe vraag<h1> <br> <button name='nieuw'> <br>"
                    echo "<h1>Delete vraag<h1> <br> <button name='delete'>"
                    
                    ?>
                </form>

<!--$sql = "UPDATE questions SET question= $editValue WHERE id=$tempValue";-->
            </article>
        </section>
    </main>

<footer>
<!--Session Abort button-->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<form method="POST">
    <h1>Abort session</h1>
    <input type="submit" name="abort" value="abort">
        <?php
            if(isset($_POST['abort'])){
            $_SESSION['abort'] = TRUE;
        }
        if(isset($_SESSION['abort'])){
            session_abort();
            }
        ?>
    </form>
</footer>
</body>
</html>