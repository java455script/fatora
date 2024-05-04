<?php
    // تضمين ملف الحذف
    include_once '../myBack/delet.php';

    // تضمين ملف التحديث
    include_once '../myBack/update.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tousalik cherche fatora</title>
    <link rel="icon" href="../myCode/logo/tousalikHed.png" type="image/x-icon">
    <!-- رابط الأنماط CSS -->
    <link rel="stylesheet" href="../myCode/css/style.css?v=<?php echo time(); ?>">
   
    <!-- رابط مكتبة Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body data-lng='francais'>
<header class="header  shHeader">
    <!-- شريط العنوان -->
    <div class="barHeader"><i class="fa-solid fa-bars-staggered bar"></i></div>

    <!-- حقل البحث -->
    <div class='box_inpt box_inpt2'>
        <input id='searchFilename' style='translate: 4px -2px;' class='search ipt_txt searchFilename' type='text' placeholder='Look for the bill'>
        <div style='display:none;'></div>
        <div class='remove_txt_in chrRemove'><i class='fa-solid fa-xmark'></i></div>
        <?php
        include_once '../myBack/afchName.php';
        ?>
    </div>
</header>

<?php
    // تضمين ملف التنقل
    include_once 'nav.php'; 
?>

<section class='box set'>
    <!-- عرض البيانات -->
    <?php include_once 'show.php';?>

      <!-- رسالة عند عدم العثور على بيانات -->
      <div class='boxNotFond'>
        <div class='boxIcon'><i class="fa-solid fa-face-surprise"></i></div> 
        <div class="boxTextNotF"><span class="fondNot">No Fatora Found</span></div>
        <a class="my_btn" style='color:#fff;' href="fatora.php">Click to return to the search</a>
    </div>

    <!-- إجمالي الفواتير -->
    <div class="boxtotalFinalFatora">
        <!-- فتح القائمة -->
        <button class="btntotalFinalFatora"><i class='fa-solid fa-angle-down down'></i></button>
        
        <div class='BxtotalFinalFatora Qie'>
            <span class='icnTotalFinalFatora' style='background-color:#03b103;'><i class="fa-solid fa-file-circle-check"></i></span>
            <span class='totalFinalFatora'></span>
        </div>
        
        <div class='BxtotalFinalFatora'>
            <span class='icnTotalFinalFatora' style='background-color:#EF233C;'><i class="fa-solid fa-file-circle-xmark"></i></span>
            <span class='totalFinalFatora'></span>
        </div>

        <div class='BxtotalFinalFatora Qie'>
            <span class='icnTotalFinalFatora' style='background-color:#03b103;'><i class="fa-solid fa-file-invoice-dollar"></i></span>
            <span class='totalFinalFatora'></span>
        </div>
        
        <div class='BxtotalFinalFatora'>
            <span class='icnTotalFinalFatora' style='background-color:#EF233C;'><i class="fa-solid fa-file-invoice-dollar"></i></span>
            <span class='totalFinalFatora'></span>
        </div>
        
        <div class='BxtotalFinalFatora Qie'>
            <span class='icnTotalFinalFatora'><i class="fa-solid fa-file-invoice"></i></span>
            <span class='totalFinalFatora'></span>
        </div>
        
        <div class='BxtotalFinalFatora'>
            <span class='icnTotalFinalFatora'><i class="fa-solid fa-file-invoice-dollar"></i></span>
            <span class='totalFinalFatora'></span>
        </div>

        <div class='BxtotalFinalFatora inf'>
            <span class='totalFinalFatora in'></span>
        </div>

    </div>
    <input class="language" type="hidden" name="language" value="francais">
</section>
<script src="../myCode/js/script2.js?v=<?php echo time(); ?>"></script>
<?php include_once '../myCode/phpIprtJs/javaScript.php';?>

</body>
</html>
