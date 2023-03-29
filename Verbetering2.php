
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<!--
    <body>
    <h1>
        <?php 
            echo $question['question']; 
        ?>
    </h1>
    <form method="post">
        <input type="radio" name="answer" value="<?php// echo $question['option_a']; ?>"> <?php // echo $question['option_a']; ?><br>
        <input type="radio" name="answer" value="<?php// echo $question['option_b']; ?>"> <?php // echo $question['option_b']; ?><br>
        <input type="submit" value="Submit">
    </form>
</body>
-->
</html>
<?php
session_start();

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ALA_Questions_test";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '<p>Connection made successfully. Welcome to the question editor/creator!</p>';

} catch (PDOException $e) {
    echo "<p>Connection failed:</p><br>" . $e->getMessage();
}

// Retrieve the current question
if (isset($_SESSION['question_id'])) {
    $stmt = $db->prepare("SELECT question, option_a, option_b, next_question_a, next_question_b FROM questions");
    $stmt->execute();
} else {
    $stmt = $db->prepare("SELECT question, option_a, option_b, next_question_a, next_question_b FROM questions");
    $stmt->execute();
}

$query = $db->query("SELECT question, option_a, option_b FROM questions");
$question = $query->fetchall();

// Store the IDs of the next questions in session variables
if($_SESSION['next_question_a'] = array()){
    $_SESSION['next_question_a'] = $question['next_question_a'];
}
if($_SESSION['next_question_b'] = array()){
    $_SESSION['next_question_b'] = $question['next_question_b'];
}

// Display the question and its options
foreach($question as $data){
    echo "<h1>" . $data['question'] . "</h1>";
    echo "<form method='post'>";
    echo "<input type='submit' name='answer' value='" . $data['option_a'] . "'>";
    echo "<input type='submit' name='answer' value='" . $data['option_b'] . "'>";
    echo "</form>";

// If an answer is submitted, display the next question based on the ID stored in the session variable
    if (isset($_POST['answer'])) {
        if ($_POST['answer'] == $data['option_a']) {
        $_SESSION['question_id'] = $_SESSION['next_question_a'];
        } elseif ($_POST['answer'] == $data['option_b']) {
        $_SESSION['question_id'] = $_SESSION['next_question_b'];
        }
    }
}   

// Insert a new question
if (isset($_POST['add_question'])) {
    $stmt = $db->prepare("INSERT INTO questions (question, option_a, option_b, next_question_a, next_question_b) VALUES (?,?,?,?,?)");
    $stmt->execute(array($_POST['question'], $_POST['option_a'], $_POST['option_b'], $_POST['next_question_a'], $_POST['next_question_b']));
}

// Update a question
if (isset($_POST['update_question'])) {
    $stmt = $db->prepare("UPDATE questions SET question = ?, option_a = ?, option_b = ?, next_question_a = ?, next_question_b = ? ");
    $stmt->execute(array($_POST['question'], $_POST['option_a'], $_POST['option_b'], $_POST['next_question_a'], $_POST['next_question_b'], $_POST['id']));
}

// Delete a question
if (isset($_GET['delete_question'])) {
    $stmt = $db->prepare("DELETE FROM questions WHERE id = .idtemp");
    $stmt->execute(array($_GET['delete_question']));
}

// Display a list of questions
$stmt = $db->prepare("SELECT * FROM questions");
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<h1>Questions</h1>";
echo "<ul>";
foreach ($questions as $question) {
    echo "<li>" . $question['question'] . "</li>";
}

// Display the form to add a new question
echo "<h2>Add Question</h2>";
echo "<form method='post'>";
echo "Question: <input type='text' name='question'><br>";
echo "Option A: <input type='text' name='option_a'><br>";
echo "Option B: <input type='text' name='option_b'><br>";
echo "Next Question A: <input type='text' name='next_question_a'><br>";
echo "Next Question B: <input type='text' name='next_question_b'><br>";
echo "<input type='submit' name='add_question' value='Add'>";
echo "</form>";
// Display the form to edit a question
echo "<h2>Edit Question</h2>";
echo "<form method='post'>";
echo "<input type='hidden' name='id' value='" . $question['question'] . "'>";
echo "Question: <input type='text' name='question' value='" . $question['question'] . "'><br>";
echo "Option A: <input type='text' name='option_a' value='" . $question['option_a'] . "'><br>";
echo "Option B: <input type='text' name='option_b' value='" . $question['option_b'] . "'><br>";
echo "Next Question A: <input type='text' name='next_question_a' value='" . $question['next_question_a'] . "'><br>";
echo "Next Question B: <input type='text' name='next_question_b' value='" . $question['next_question_b'] . "'><br>";
echo "<input type='submit' name='update_question' value='Update'>";
echo "</form>";
// Display the form to delete a question

if(isset($_POST['delete'])){
    $delete = "DELETE FROM Questions WHERE id =.$idtemp";

    if ($db->query($delete) === TRUE) {
        echo "Record deleted successfully + ur gay";
      } else {
        echo "Error deleting record: " . $db->error;
      }
      
}


echo "<h2>Delete Question</h2>";
echo "<form method='post'>";
echo "<input type='hidden' name='id' value='" . $question['question'] . "'>";
echo "Question: <input type='text' name='question' value='" . $question['question'] . "'><br>";
echo "Option A: <input type='text' name='option_a' value='" . $question['option_a'] . "'><br>";
echo "Option B: <input type='text' name='option_b' value='" . $question['option_b'] . "'><br>";
echo "Next Question A: <input type='text' name='next_question_a' value='" . $question['next_question_a'] . "'><br>";
echo "Next Question B: <input type='text' name='next_question_b' value='" . $question['next_question_b'] . "'><br>";
echo "<input type='submit' name='delete' value='Delete'>";
echo "</form>";




// If the session variable for the current question is not set, set it to the first question in the database
if (!isset($_SESSION['question_id'])) {
    $stmt = $db->prepare("SELECT MIN(id) AS id FROM questions");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['question_id'] = $result['id'];

    // Get the current question from the database based on the session variable
    $stmt = $db->prepare("SELECT * FROM questions WHERE id =".$_SESSION['question_id']);
    $stmt->execute(array($_SESSION['question_id']));
    $question = $stmt->fetch(PDO::FETCH_ASSOC);
    //expirimental, might fail /\/\/\/\/\/\/\
}

// If an answer is submitted, display the next question based on the ID stored in the session variable
if (isset($_POST['answer'])) {
    if ($_POST['answer'] == $question['option_a']) {
        $_SESSION['question_id'] = $_SESSION['next_question_a'];
    } elseif ($_POST['answer'] == $question['option_b']) {
        $_SESSION['question_id'] = $_SESSION['next_question_b'];
    }
    exit();
}
?>