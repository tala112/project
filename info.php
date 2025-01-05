<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "dictionary_app";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['word'])) {
    $word = $conn->real_escape_string($_GET['word']);

    $sql = "SELECT machine_word FROM words WHERE input_word='$word'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['machine_word'];
    } else {
        echo "Word not found";
    }
}

$conn->close();
?>
