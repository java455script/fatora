<?php
// التحقق مما إذا كانت بيانات imageData موجودة في $_POST
if(isset($_POST['submit'])) { 
    // معلومات اتصال PDO
    include_once '../myBack/coon/coon.php';

    try {
        // إنشاء اتصال PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // تعيين وضع الاستثناء PDO للحصول على الأخطاء كاستثناءات
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_POST['language'] === 'francais') {
            // تحديد مسار حفظ الصورة
            $uploadDirectory = '../francais/image/';
        } else if ($_POST['language'] === 'arabe') {
            $uploadDirectory = '../arabe/image/';
        }
        
        // استقبال البيانات المرسلة من النموذج
        $nameData = $_POST['nameData'];
        $imageData = $_POST['imageData'];
        $finalTotal = $_POST['finalTotal'];
        $virifiFatora = $_POST['virifiFatora'];

        // إنشاء اسم فريد للصورة
        $filename = uniqid('image_') . '.png';

        // تحويل بيانات الصورة إلى ملف صورة
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageData = base64_decode($imageData);

        // حفظ الصورة في الملف المحدد
        file_put_contents($uploadDirectory . $filename, $imageData);

       // استعداد استعلام SQL
       if ($_POST['language'] === 'francais') {
           $sql = "INSERT INTO myfatoraangls (name, filename, finalTotal, virifiFatora) VALUES (?, ?, ?, ?)";
       } else if ($_POST['language'] === 'arabe') {
           $sql = "INSERT INTO myfatoraarab (name, filename, finalTotal, virifiFatora) VALUES (?, ?, ?, ?)";
       }


        // تحضير الاستعلام
        $stmt = $conn->prepare($sql);

        // تنفيذ الاستعلام مع تمرير قيم المعلمات
        $stmt->execute([$nameData, $filename, $finalTotal, $virifiFatora]);
        if ($_POST['language'] === 'francais') {
             // إعادة توجيه المستخدم بعد إدراج البيانات بنجاح
              header("Location: http://localhost/fatora/francais/index.php");
        exit(); // تأكد من إيقاف تنفيذ الكود بعد استدعاء header()
        } else if ($_POST['language'] === 'arabe') {
             // إعادة توجيه المستخدم بعد إدراج البيانات بنجاح
             header("Location: http://localhost/fatora/arabe/index.php");
             exit(); // تأكد من إيقاف تنفيذ الكود بعد استدعاء header()
        }
       

    } catch(PDOException $e) {
        // في حالة وجود خطأ، يمكنك معالجته هنا أو عرض رسالة خطأ
        echo "Error: " . $e->getMessage();
    }

    // إغلاق اتصال قاعدة البيانات
    $conn = null;
}
?>