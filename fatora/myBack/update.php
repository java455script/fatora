<?php
// التحقق من وجود معرف مرسل
if(isset($_POST['id'])) {
    // معلومات اتصال PDO
    include_once '../myBack/coon/coon.php';

    try {
        // إنشاء اتصال PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // تعيين وضع الاستثناء PDO للحصول على الأخطاء كاستثناءات
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // الحصول على معرّف السجل المرسل
        $id = $_POST['id'];
        
        $lang = $_POST['data-lng'];
        // استعداد استعلام SQL لحذف السجل
        if ($lang === 'francais') {
            $newVirifiFatoraValue = "Purchase successful";
            $sql = "UPDATE myfatoraangls SET virifiFatora = :newVirifiFatoraValue WHERE id = :id";
        } else if ($lang === 'arabe') {
            $newVirifiFatoraValue = "تم الشراء بنجاح"; // استبدل "new_value_here" بالقيمة الجديدة التي تريدها
            $sql = "UPDATE myfatoraarab SET virifiFatora = :newVirifiFatoraValue WHERE id = :id";
        }
        // القيمة الجديدة لحقل virifiFatora
         // استبدل "new_value_here" بالقيمة الجديدة التي تريدها

       

        // تحضير الاستعلام
        $stmt = $conn->prepare($sql);

        // ربط المتغيرات
        $stmt->bindParam(':newVirifiFatoraValue', $newVirifiFatoraValue, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // تنفيذ الاستعلام
        if ($stmt->execute()) {
            echo "تم تحديث حقل virifiFatora بنجاح";
        } else {
            echo "حدث خطأ أثناء تحديث الحقل virifiFatora";
        }

        // إغلاق الاستعلام
        $stmt->close();
    } catch(PDOException $e) {
        // في حالة وجود خطأ، يمكنك معالجته هنا أو عرض رسالة خطأ
        echo "Error: " . $e->getMessage();
    }

    // إغلاق اتصال قاعدة البيانات
    $conn = null;
}
?>  