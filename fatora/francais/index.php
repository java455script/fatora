<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>tousalik</title>
<link rel="icon" href="../myCode/logo/tousalikHed.png" type="image/x-icon">
    <!-- Link CSS styles -->
    <link rel="stylesheet" href="../myCode/css/style.css?v=<?php echo time(); ?>">
     
    <!-- Link Font Awesome icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
 
<!-- <i class="fa-solid fa-bars bar"></i>  -->
<header class="header">
    <button class="barHeader"><i class="fa-solid fa-bars-staggered bar"></i></button>
</header>
<!-- nav -->
<?php
    include_once 'nav.php';
?>

<!-- ////Part 1//// -->
<section class="section_kona set" id="section_kona">

<form id="addForm">

<!-- Input for Name -->
<span class="remove_name">Name input field cleared</span>
<div class="box_inpt">
    <input type="text" class="ipt_txt searchFilename" id="name" >
    <label class="label_ipt" for="name">Name</label>
    <div class="remove_txt_in"><i class="fa-solid fa-xmark"></i></div>
    <?php
        include_once '../myBack/afchName.php';
    ?>
</div>

<!-- Input for Date -->
<div class="box_date box_inpt boxEty">
    <input type="text" class="ipt_txt" id="date">
    <label class="label_ipt" for="date">Date</label>
    <div class="remove_txt_in"><i class="fa-solid fa-xmark"></i></div>
</div>

<!-- Input for Product -->
<div class="box_inpt boxEty">
    <input type="text" class="ipt_txt" id="product">
    <label class="label_ipt" for="product">Product</label>
    <div class="remove_txt_in"><i class="fa-solid fa-xmark"></i></div>
</div>

<!-- Input for Quantity -->
<div class="box_inpt boxEty">
    <input type="text" class="ipt_txt" id="quantity">
    <label class="label_ipt" for="quantity">Qie</label>
    <div class="remove_txt_in"><i class="fa-solid fa-xmark"></i></div>
</div>

<!-- Input for Price -->
<div class="box_inpt boxEty">
    <input type="text" class="ipt_txt" id="price">
    <label class="label_ipt" for="price">Price</label>
    <div class="remove_txt_in"><i class="fa-solid fa-xmark"></i></div>
</div>

<!-- Input for Total (Read-only) -->
<div class="box_inpt boxEty">
    <input type="text" class="ipt_txt" id="total" readonly>
    <label class="label_ipt" for="total">Total</label>
    <div style="display: none"></div>
</div>

<!-- Button to Add Data -->
<button name="shrSubmit" class="my_btn add-button boxEty" id="add-button">Add</button>
</form>

<!-- ////Part 2//// -->
<!-- Table to display data -->
<table class="dataTable boxEty" id="dataTable">

    <!-- Table Headers for User Data -->
    <thead class="tableBodyUser">
        <tr class="tr_titer">
            <th id="titreN" class="dataTh">Name</th>
            <th id="titreD" class="dataTh titreD">Date</th>
            <th class="action">Action</th>
            <th class="lnt"><span id="lntDataUser" class="lnt2"></span></th>
        </tr>
        
    </thead>
    <tbody class="tableBodyUser" id="tableBodyUser">
        <!-- Data will be inserted here dynamically -->
    </tbody>

    <!-- Table Headers for Product Data -->
    <thead>
        <tr class="tr_titer">
            <th class="dataTh">Product</th>
            <th class="dataTh">Qie</th>
            <th class="dataTh">Price</th>
            <th class="dataTh">Total</th>
            <th class="action">Action</th>
            <th class="lnt"><span id="lntDataUser2" class="lnt2"></span></th>
        </tr>
        
    </thead>
    <tbody class="tableBody" id="tableBody">
        <!-- Data will be inserted here dynamically -->
    </tbody>

    <!-- Table Headers for Total -->
    <thead>
        <tr class="tr_titer" id="totlFinl">
            <th class="dataTh" >Total final</th>
        </tr>
    </thead>
    <tbody id="table_total">  
        <!-- Data will be inserted here dynamically -->
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
        <span class="textBtnF"><span><i class="fa-solid fa-database"></i></span> Click on the button below to save the invoice. </span>
        <!-- زر التخزين -->
        <button id="storage" class="my_btn storage  btnFinal">Storage</button>
    </div>

    <div class="box1btnF">
        <!-- نص الزر -->
        <span class="textBtnF"><span><i class="fa-solid fa-file-circle-xmark"></i></span> Click on the button below to cancel the purchase. </span>
        <!-- زر "Not Purchased" -->
        <button id="purchased" class="my_btn purchased  btnFinal">Not purchased</button>
    </div>
</div>


<div class="boxThisData boxEty">

 <div class='box_text_click'>
 <h2>With the push of a button you can create a professional invoice with high features.</h2>
 <br>
 <span>Now, create your invoice, it has many features like storage, printing, downloading, etc...</span>
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
        <input type="radio"  class="buying" name="virifiFatora" value="Purchase successful">
        <input type="radio"  class="no_purchase" name="virifiFatora" value="the rest">
        <input class='language' type="hidden" name="language" value="francais">
        <!-- زر الإرسال -->
        <input id="submitFatora" name="submit" type="submit" value="click">
    </form>
</div>


<script src="../myCode/js/script.js?v=<?php echo time(); ?>"></script>
<?php include_once '../myCode/phpIprtJs/javaScript.php';?>
</body>
</html>