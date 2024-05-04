<?php
// اتصال بقاعدة البيانات
include_once '../myBack/coon/coon.php';

try { 
    // إنشاء اتصال PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // تعيين وضع الاستثناء PDO للحصول على الأخطاء كاستثناءات
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // تحديد الجدول المناسب بناءً على لغة المستخدم
    $sql = "SELECT * FROM myfatoraangls";

    // تنفيذ الاستعلام والحصول على النتائج
    $stmt = $conn->query($sql);

    // التحقق من وجود نتائج
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='nameFatora2'>" . $row["name"] . ". </div>";
        }
    } else {
    
    }
} catch(PDOException $e) {
    // في حالة وجود خطأ، يمكنك معالجته هنا أو عرض رسالة خطأ
    echo "Error: " . $e->getMessage();
}

// إغلاق اتصال قاعدة البيانات
$conn = null;
?>