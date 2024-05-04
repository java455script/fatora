<?php
// اتصال بقاعدة البيانات
include_once '../myBack/coon/coon.php';

try {
    // إنشاء اتصال PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // تعيين وضع الاستثناء PDO للحصول على الأخطاء كاستثناءات
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // التحقق مما إذا كانت هناك بيانات مُرسلة بواسطة النموذج
    if(isset($_POST['record_id'])) {
        $record_id = $_POST['record_id'];
        $lang = $_POST['data-lng'];
        // استعداد استعلام SQL لحذف السجل
        if ($lang === 'francais') {
            // استعداد استعلام SQL لحذف السجل من جدول الفاتورات باللغة الفرنسية
            $sql = "DELETE FROM myfatoraangls WHERE id = ?";
        } else if ($lang === 'arabe') {
            // استعداد استعلام SQL لحذف السجل من جدول الفاتورات باللغة العربية
            $sql = "DELETE FROM myfatoraarab WHERE id = ?";
        }
        
        // تحضير الاستعلام
        $stmt = $conn->prepare($sql);

        // تنفيذ الاستعلام مع تمرير قيم المعلمات
        if ($stmt->execute([$record_id])) {
        //  delet
        
        } else {
        //  pk delet 
        }
        // إغلاق الاستعلام
        $stmt->close();
    }
} catch(PDOException $e) {
    // في حالة وجود خطأ، يمكنك معالجته هنا أو عرض رسالة خطأ
    echo "Error: " . $e->getMessage();
}

// إغلاق اتصال قاعدة البيانات
$conn = null;
?>