<?php
$host = getenv('DB_HOST') ?: '127.0.0.1'; // عنوان MySQL
$db   = 'dictionary_app';                 // اسم قاعدة البيانات
$user = 'root';                          // اسم المستخدم
$pass = 'password';                      // كلمة المرور
$port = '3306';                          // المنفذ الافتراضي

// إنشاء اتصال
$conn = new mysqli($host, $user, $pass, $db, $port);

// فحص الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>