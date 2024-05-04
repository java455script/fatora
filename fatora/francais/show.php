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
            echo "<div class='imageContainer'>

                    <div id='boxVirifi' class='iconVirifi'>
                        <div class='spanVirifi'>
                            <div class='boxIconV'></div> 
                            <span class='virifiFatora'>" . $row["virifiFatora"] . "</span>
                        </div>
                    </div>

                    <div class='boxFatora'>
                        <p class='nameFatora' style='display: none;'>" . $row["name"] . ".</p>
                        <div class='boxImg my_btn'><span class='idxFatora'></span><img class='imgFatora' src='image/" . $row["filename"] . "' alt='" . $row["name"] . "'> </div>
                        <span class='totalFatora' style='display: none;'>" . $row["finalTotal"] . "</span>
                    </div>

                    <div>
                        <button onclick='tgleBtn(this)' id='btnSh' class='btn2 tn2-3 my_btn'><i class='fa-solid fa-angle-down'></i></button>   
                    </div>

                    <div class='boxBtnF'>

                        <div class='box1btnF'>
                            <span class='textBtnF'><span><i class='fa-solid fa-trash'></i></span> Click on the button below to clear the purchase invoice. </span>
                            <button  class='my_btn Delet' data-lng='francais' data-id='" . $row["id"] . "'>Delet</button>
                        </div>

                        <div class='box1btnF'>
                            <span class='textBtnF'><span><i class='fa-solid fa-cloud-arrow-down'></i></span> Click on the button below to download the purchase invoice. </span>
                            <button class='downloadBtn my_btn  downloadButton1'>download</button>
                        </div>

                        <div class='box1btnF'>
                            <span class='textBtnF'><span><i class='fa-solid fa-print'></i></span> Click on the button below to print the bill. </span>
                            <button class='printBtn my_btn  printButton1'>Print</button>
                        </div>

                        <div class='boxVirifi box1btnF'>
                            <span class='textBtnF'><span><i class='fa-solid fa-file-circle-check'></i></span> Click on the button below to activate the invoice purchase. </span>
                            <button class='virifiBtn my_btn printButton1' data-lng='francais' data-id='" . $row["id"] . "'>pay the bill</button>
                        </div>

                    </div>
                </div>";
        }
    } else {
        echo "  <div class='boxNotFond' style='display: flex;'>
                    <div class='boxIcon'><i class='fa-solid fa-face-sad-tear'></i></div> 
                    <div class='boxTextNotF'><span>No invoice</span></div>
                </div>";
    }
} catch(PDOException $e) {
    // في حالة وجود خطأ، يمكنك معالجته هنا أو عرض رسالة خطأ
    echo "Error: " . $e->getMessage();
}

// إغلاق اتصال قاعدة البيانات
$conn = null;
?>