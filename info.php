<?php
/*
$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "dictionary_app";
//create con
$conn = new mysqli($servername, $username, $password, $dbname);
//if con secsesful
if ($conn->connect_error) {
    die("sorry Connection failed: " . $conn->connect_error);
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
*/
$host_ip = "192.168.88.12"; // عنوان IP الخاص بالنظام المضيف
$local_ip = "127.0.0.1";    // عنوان localhost
$username = "root";
$password = "password";
$dbname = "dictionary_app";

// وظيفة لإنشاء الاتصال
function connectToDatabase($servername, $username, $password, $dbname) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        return false; // فشل الاتصال
    }
    return $conn; // اتصال ناجح
}

// جرب الاتصال باستخدام IP المضيف
$conn = connectToDatabase($host_ip, $username, $password, $dbname);

// إذا فشل، جرب الاتصال بـ localhost
if (!$conn) {
    $conn = connectToDatabase($local_ip, $username, $password, $dbname);
}

// إذا فشل الاتصال في الحالتين، أوقف التنفيذ
if (!$conn) {
    die("Connection failed: Unable to connect to database using both host IP and localhost.");
}
?>