<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>توساليك</title>
<link rel="icon" href="../myCode/logo/tousalikHed.png" type="image/x-icon">
    <!-- Link CSS styles -->
    <link rel="stylesheet" href="../myCode/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../myCode/css/styleAr.css?v=<?php echo time(); ?>">
    <!-- Link Font Awesome icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
 
<!-- <i class="fa-solid fa-bars bar"></i>  -->
<header class="header">
    <div class="barHeader"><i class="fa-solid fa-bars-staggered bar"></i></div>
</header>
<!-- nav -->
<?php
    include_once 'nav.php';
?>

<!-- ////Part 1//// -->
<section class="section_kona set" id="section_kona">

<form id="addForm">
<!-- مدخل الاسم -->
<span class="remove_name">تم مسح حقل الإدخال الإسم</span>
<div class="box_inpt">
    <input type="text" class="ipt_txt searchFilename" id="name">
    <label class="label_ipt" for="name">الاسم</label>
    <div class="remove_txt_in"><i class="fa-solid fa-xmark"></i></div>
    <?php
        include_once '../myBack/afchNameAr.php';
    ?>
</div>
<!-- مدخل التاريخ -->
<div class="box_date box_inpt boxEty">
    <input type="text" class="ipt_txt" id="date">
    <label class="label_ipt" for="date">التاريخ</label>
    <div class="remove_txt_in"><i class="fa-solid fa-xmark"></i></div>
</div>
<!-- مدخل المنتج -->
<div class="box_inpt boxEty">
    <input type="text" class="ipt_txt" id="product">
    <label class="label_ipt" for="product">المنتج</label>
    <div class="remove_txt_in"><i class="fa-solid fa-xmark"></i></div>
</div>
<!-- مدخل الكمية -->
<div class="box_inpt boxEty">
    <input type="text" class="ipt_txt" id="quantity">
    <label class="label_ipt" for="quantity">الكمية</label>
    <div class="remove_txt_in"><i class="fa-solid fa-xmark"></i></div>
</div>
<!-- مدخل السعر -->
<div class="box_inpt boxEty">
    <input type="text" class="ipt_txt" id="price">
    <label class="label_ipt" for="price">السعر</label>
    <div class="remove_txt_in"><i class="fa-solid fa-xmark"></i></div>
</div>
<!-- الإدخال النهائي (للقراءة فقط) -->
<div class="box_inpt boxEty">
    <input type="text" class="ipt_txt" id="total" readonly>
    <label class="label_ipt prT" for="total">الإجمالي</label>
    <div style="display: none"></div>
</div>
<!-- زر إضافة البيانات -->
<button name="shrSubmit" class="my_btn add-button boxEty" id="add-button">إضافة</button>

</form>

<!-- ////Part 2//// -->
<!-- Table to display data -->
<table class="dataTable boxEty" id="dataTable">
<!-- عناوين الجدول لبيانات المستخدم -->
<thead class="tableBodyUser">
    <tr class="tr_titer">
        <th class="dataTh">الاسم</th>
        <th class="dataTh">التاريخ</th>
        <th class="action">العملية</th>
        <th class="lnt"><span id="lntDataUser" class="lnt2"></span></th>
    </tr>
    
</thead>
<tbody class="tableBodyUser" id="tableBodyUser">
    <!-- البيانات ستُدرج هنا بشكل ديناميكي -->
</tbody>

<!-- عناوين الجدول لبيانات المنتج -->
<thead>
    <tr class="tr_titer">
        <th class="dataTh">المنتج</th>
        <th class="dataTh">الكمية</th>
        <th class="dataTh">السعر</th>
        <th class="dataTh">الإجمالي</th>
        <th class="action">العملية</th>
        <th class="lnt"><span id="lntDataUser2" class="lnt2"></span></th>
    </tr>
    
</thead>
<tbody class="tableBody" id="tableBody">
    <!-- البيانات ستُدرج هنا بشكل ديناميكي -->
</tbody>

<!-- عناوين الجدول للإجمالي -->
<thead>
    <tr class="tr_titer" id="totlFinl">
        <th class="dataTh" >الإجمالي النهائي</th>
        
    </tr>
</thead>
<tbody id="table_total">  
    <!-- البيانات ستُدرج هنا بشكل ديناميكي -->
</tbody>

</table>

<!-- عناصر الأزرار -->
<div id="boxBtn" class="boxBtn boxEty">
    <!-- زر التبديل -->
    <button onclick="tgleBtn(this)" id="btnSh" class='btn2 my_btn'><i class="fa-solid fa-angle-down"></i></button>   
    <!-- زر الدوران -->
    <button id="rightF" class='btn2 my_btn'><i class="fa-solid fa-rotate-right"></i></button>
</div>

<!-- الأزرار الإضافية -->
<div class="boxBtnF boxEty">
    <!-- صندوق الأزرار -->
    <div class="box1btnF">
        <!-- نص الزر -->
        <span class="textBtnF"><span><i class="fa-solid fa-database"></i></span> انقر على الزر أدناه لحفظ الفاتورة. </span>
        <!-- زر التخزين -->
        <button id="storage" class="my_btn storage  btnFinal">التخزين</button>
    </div>

    <div class="box1btnF">
        <!-- نص الزر -->
        <span class="textBtnF"><span><i class="fa-solid fa-file-circle-xmark"></i></span> انقر على الزر أدناه لإلغاء الشراء. </span>
        <!-- زر "غير مشترى" -->
        <button id="purchased" class="my_btn purchased  btnFinal">غير مشترى</button>
    </div>

</div>


<div class="boxThisData boxEty">

 <div class='box_text_click'>
 <h2>بضغطة زر واحدة يمكنك إنشاء فاتورة احترافية بميزات عالية.</h2>
 <br>
 <span>الآن، قم بإنشاء فاتورتك، تحتوي على العديد من الميزات مثل التخزين والطباعة والتنزيل وغيرها...</span>
 </div>
 

 <div class='box_img_click'>
    <img src="../myCode/logo/onclick.png" alt="">
 </div>

</div>

<!-- صورة الشعار -->
<img style='display: none;' id='logo' src="../myCode/logo/tousalikHed.png" alt="">
<!-- لوحة الرسم -->
<canvas id="tableCanvas" width="800"></canvas>

</section>

<!-- erore -->
<div class="box_erore boxEty"><span class="text_erore"></span></div>

<!-- نموذج الحفظ -->
<div style='display:none;'>
    <!-- زر الحفظ -->
    <button id="saveFatora" onclick="drawTableData();"></button>
    <!-- نموذج البيانات -->
    <form action="../myBack/add.php" method="post"  id="imageForm" >
        <input type="text" name="nameData" id="nameData">
        <input type="text" name="imageData" id="imageData">
        <input type="text" name="finalTotal" id="totalData">
        <!-- خيارات التحقق -->
        <input type="radio"  class="buying" name="virifiFatora" value="تم الشراء بنجاح">
        <input type="radio"  class="no_purchase" name="virifiFatora" value="الباقي">
        <input class="language" type="hidden" name="language" value="arabe">
        <!-- زر الإرسال -->
        <input id="submitFatora" name="submit" type="submit" value="click">
    </form>
</div>

<script src="../myCode/js/script.js?v=<?php echo time(); ?>"></script>
<?php include_once '../myCode/phpIprtJs/javaScript.php';?>
</body>
</html>