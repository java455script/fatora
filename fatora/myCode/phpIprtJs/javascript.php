<script>
// حدد موضع التمرير السابق
const time = 2000;
// تحديد العناصر

const nav = document.querySelector('.nav');
const bar = document.querySelector('.bar');
const search = document.querySelector('.search');
const set = document.querySelector('.set');


const notString = (ipt) => {
      const inputValue = ipt.value;
      const numbersOnly = /^\d*$/;
      
      if (!numbersOnly.test(inputValue)) {
          // إذا كانت القيمة لا تحتوي على أرقام فقط، يتم حذف الأحرف الغير رقمية
          ipt.value = inputValue.replace(/[^\d]/g, '')
      }
}

const notNumber = (input, event, regex, replaceRegex, replacement) => {
  const text = input.value;

  // التحقق من أن النص يحتوي فقط على الأحرف النصية المسموح بها
  if (!regex.test(text)) {
    // إلغاء الحرف المدخل إذا لم يكن حرف نصي
    input.value = text.replace(replaceRegex, replacement);
    event.preventDefault();
  }
};

const boxEty = document.querySelectorAll('.boxEty');
const chrN = (displayValue) => {
  boxEty.forEach(element => {
    element.style.display = displayValue;
  });
};

// دالة لإنشاء زر
const createButton = (text, className, element) => {
  const button = document.createElement(element);
  button.className = className;
  button.textContent = text;
  return button;
} 

///::تفاعل الزر:://///
const eventBtnAdd = (name, date, product, quantity, price, total, btn, textBtn, icon, addRowFunction) => {
  btn.textContent = null;
  btn.disabled = true;
  const onlodBtn = createButton(null, "onlodBtn", "span"); 
  btn.appendChild(onlodBtn);
  
  setTimeout(function () {
    btn.removeChild(onlodBtn);
    const save = createButton(null, icon, "i");
    btn.appendChild(save);

    setTimeout(function () {
      btn.removeChild(save);
      btn.textContent = textBtn;
      btn.disabled = false;

      if (addRowFunction) {
        addRowFunction(name, date, product, quantity, price, total);
      }
    }, time);
    
  }, time);
}

// دالة لتعطيل جميع الأزرار
const disableAllButtons = (disable) => {
  const buttons = document.querySelectorAll('.my_btn');
  buttons.forEach(button => {
      button.disabled = disable;

    if (button.disabled) {
      button.classList.add('active_button');
    } else {
      button.classList.remove('active_button');
    }
  });
};

//
const setTimeoutDelet1 = () => {
  disableAllButtons(false)
}

// إضافة زر للتمرير لأعلى الصفحة
const scrlTop = createButton(null, "my_btnTop btn2 scrlTop", "button");
document.body.appendChild(scrlTop);
const iconTop = createButton(null, "fa-solid fa-chevron-up", "i");
scrlTop.appendChild(iconTop);
scrlTop.addEventListener("click", function(event) {
  event.preventDefault();
  document.body.scrollIntoView({ behavior: 'smooth' });
});

// تفعيل زر التمرير لأعلى عند التمرير لأسفل الصفحة
const scrollFunction = () => {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    scrlTop.classList.add('active_top');
  } else {
    scrlTop.classList.remove('active_top');
  }
  
}
// احصل على عنصر الهيدر
const header = document.querySelector('.header');
let previousScrollPosition = window.pageYOffset ;
const myScrolHeadr = () => {
    // احسب موضع التمرير الحالي
    let currentScrollPosition = window.pageYOffset;
    
    // التحقق من اتجاه التمرير
    if (currentScrollPosition < previousScrollPosition) {
        // إذا كان التمرير لأعلى، عرض الهيدر
        header.style.top = '0';

    } else {
        // إذا كان التمرير لأسفل، إخفاء الهيدر
        header.style.top = `-${header.offsetHeight}px`;
        nameFatora2.forEach(box => {
      box.classList.remove('active_nameFatora2');
    });
    }

    // تحديث موضع التمرير السابق
     previousScrollPosition = currentScrollPosition ; 
}

// أضف مستمع لحدث التمرير
window.addEventListener('scroll', function() {
    myScrolHeadr()
    scrollFunction()
});

// تفاعل زر العرض/الإخفاء
const btnSh = document.getElementById('btnSh');
const tgleBtn = (btn) => {
  btn.classList.toggle('active_btnSh');
  btn.parentNode.nextElementSibling.classList.toggle('active_table');
  btn.parentNode.scrollIntoView({ behavior: 'smooth' });
}

// دالة لإزالة النص في الحقول عند النقر على زر الحذف
const emptyInptIndx = (btn) => {
  btn.previousElementSibling.previousElementSibling.value ='';
  btn.classList.remove('active_remove_txt_in');
  //
  if(search){
    searchImages(this);
    Fond()
  }
  btn.previousElementSibling.previousElementSibling.focus();
}

// تعيين الحدث لأزرار إزالة النص في الحقول
const remove_txt_in = document.querySelectorAll(".remove_txt_in")
remove_txt_in.forEach((val, idx) => {
  val.addEventListener("click", function(event) {
    event.preventDefault();
    emptyInptIndx(this,idx)
  });
});

// إضافة حدث النقر على شريط العنوان
const tglNav = (btn) => {
  // تبديل الفئة 'active_bar' على شريط العنوان
  btn.classList.toggle('active_bar');
  
  // تبديل الفئة 'active_nav' على القائمة الجانبية
  nav.classList.toggle('active_nav');

  // تبديل الفئة 'active_search' على حقل البحث إذا كان موجوداً
  if (document.querySelector('.box_inpt2')) {
  document.querySelector('.box_inpt.box_inpt2').classList.toggle('active_search'); 
}

  

  // تبديل الرمز بين القائمة والشريط
  bar.classList.toggle('fa-bars');
  bar.classList.toggle('fa-bars-staggered');
  set.classList.toggle('active_set');
  
}
const barHeader = document.querySelector('.barHeader');
    barHeader.addEventListener("click", function(event) {
      event.preventDefault();
      tglNav(this);
      chrN('');
     //
      nameFatora2.forEach(box => {
          box.classList.remove('active_nameFatora2');
      });
});
//
const box_lng = document.querySelector('.box_lng');
const downLng = document.querySelector('.downLng');

// دالة للتوجيه إلى الصفحات المختلفة بناءً على الفهرس
const Mylinck = (i) => {
  if (i === 0) {
    window.location.href = 'index.php';
  } else if (i === 1) {
    window.location.href = 'fatora.php';
  } 
}
const myLng = (i) => {

    // إضافة الفئة 'active' إلى عنصر معين إذا كان النقر على العنصر ذو الفهرس 2
    if (i === 2) {
      box_lng.classList.toggle('active_box_lng');
      downLng.classList.toggle('active_downLng');
    } else {
      // إزالة الفئة 'active' من العناصر الأخرى
      box_lng.classList.remove('active_box_lng');
      downLng.classList.remove('active_downLng');
    }
}

// تعيين حدث النقر على عناصر القائمة الرئيسية
liHeaders.forEach((element, i) => {
  element.onclick = function() {
    // تبديل الفئة 'active' على العنصر المنقر وإزالتها من العناصر الأخرى
    liHeaders.forEach((el, j) => {
      if (j === i) {
        el.classList.add('active');
      } else {
        el.classList.remove('active');
      }
    });
    
    // تأخير التوجيه لعرض تأثير الانتقال
    setTimeout(() => Mylinck(i), 300);
    myLng(i)
    
  };
});


const nameFatora2 = document.querySelectorAll('.nameFatora2');
const uniqueNames = new Set();
// لكل عنصر في nameFatora2، أضف النص المحتوى فيه إلى uniqueNames مع إزالة نقطة الإسم
nameFatora2.forEach((element, i) => {
  // قم بإزالة نقطة الإسم باستخدام replace()
  const nameWithoutDot = element.textContent.trim().replace('.', '');
  // أضف النص المحتوى إلى uniqueNames
  uniqueNames.add(nameWithoutDot);
});


// دالة لإزالة العنصر من الواجهة
const removeChrNam = (element) => {
  if (element.parentNode) {
    element.parentNode.removeChild(element);
  }
};

// لكل عنصر في nameFatora2
nameFatora2.forEach((element, i) => {
  element.textContent = ''; // مسح محتوى العنصر

  // إذا كان الفهرس أكبر من 0، قم بإزالة العنصر من الواجهة
  if (i > 0) {
    removeChrNam(element);
  }

  // لكل اسم فريد في uniqueNames
  uniqueNames.forEach(name => {
    // إنشاء عنصر جديد من النوع span
    const newElement = createButton(name, "spanName", "span"); 
     // تعيين النص
    element.appendChild(newElement); // إضافة العنصر إلى nameFatora2
  });
});

const spanName = document.querySelectorAll('.spanName');
const searchName = () => {
  const searchFilenameBar = document.querySelector('.searchFilename').value.toLowerCase();
  let found = false; // متغير لتحديد ما إذا كان هناك عنصر يطابق البحث
  
  for (let i = 0; i < spanName.length; i++) {
    if (spanName[i].textContent.toLowerCase().includes(searchFilenameBar)) {
      spanName[i].style.display = ""; // عرض العنصر إذا كانت النصوص متطابقة
      found = true;
    } else {
      spanName[i].style.display = "none"; // إخفاء العنصر إذا لم تكن النصوص متطابقة
    }
  }
  
  // إضافة أو إزالة الفئة active_nameFatora2 بناءً على وجود عنصر يطابق البحث

  nameFatora2.forEach(box => {
    if (found) {
      box.classList.add('active_nameFatora2');
      chrN('none')
    }
    else {
      box.classList.remove('active_nameFatora2');
      chrN('')
    }
    
  });
};

const chrName = (event, searchInput) => {
  event.preventDefault(); // توقف انتشار الحدث لمنع السلوك الافتراضي
  const clickedSpanText = event.target.textContent;
  searchInput.value = clickedSpanText; // تعيين قيمة نص العنصر الذي تم النقر عليه إلى مدخل البحث
  searchInput.focus();
  // إزالة الفئة 'active_nameFatora2' من كل عنصر في nameFatora2
  nameFatora2.forEach(box => {
    box.classList.remove('active_nameFatora2');
  });
  // إذا كانت الصفحة الحالية هي 'fatora.php' في اللغة الفرنسية أو العربية، فاستدعاء دالة searchImages بعد تأخير لمدة 300 ميلي ثانية
  if (search) {
    setTimeout(() => searchImages(event.target), 300);
  }
  chrN('');
}
// إضافة حدث النقر إلى كل عنصر في spanName
spanName.forEach(box => {
  box.addEventListener('click', event => {
    chrName(event, searchInput);
  });
});
</script>