<?php
$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "dictionary_app";
//create con
$conn = new mysqli($servername, $username, $password, $dbname);
//if con secsesful
if ($conn->connect_error) {
    $servername ="172.17.0.2";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error)
    {die("sorry Connection failed: " . $conn->connect_error);}
}

if (isset($_GET['word'])) {
    $word = $conn->real_escape_string($_GET['word']);
//serch word
    $sql = "SELECT machine_word FROM words WHERE input_word='$word'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['machine_word'];
    } else {
        echo "Sorry Word not found";
    }
}

$conn->close();
?>
