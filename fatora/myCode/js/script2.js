// الحصول على العناصر بواسطة أسماء علامات الفقرة والصور
const box = document.querySelector('.box');
const searchInput = document.querySelector('.searchFilename');
const spans = document.getElementsByTagName('p'); 
const imageContainers = document.querySelectorAll('.imageContainer');
const idxFatora = document.querySelectorAll('.idxFatora');
const totalFatora = document.querySelectorAll('.totalFatora');
const Delet = document.querySelectorAll('.Delet');
const virifiBtn = document.querySelectorAll('.virifiBtn');
const printBtn = document.querySelectorAll('.printBtn');
const downloadBtn = document.querySelectorAll('.downloadBtn');
const spanVirifi = document.querySelectorAll('.spanVirifi');
const virifiFatora = document.querySelectorAll('.virifiFatora');
const boxVirifi = document.querySelectorAll('.boxVirifi');
const boxNotFond = document.querySelector('.boxNotFond');
const boxTextNotF = document.querySelector('.boxTextNotF');
const boxIconV = document.querySelectorAll('.boxIconV')
const BxtotalFinalFatora = document.querySelector('.boxtotalFinalFatora')
const totalFinalFatora = document.querySelectorAll('.totalFinalFatora')
const btntotalFinalFatora = document.querySelector('.btntotalFinalFatora');
const language = document.querySelector('.language');
const boxImg = document.querySelectorAll('.boxImg');
const myAryFinal = [];

// وظيفة للتحقق من الشراء
const virifiF = () => {
  boxVirifi.forEach((element, i) => {
    if (virifiFatora[i].textContent === "Purchase successful" || virifiFatora[i].textContent.trim() === "تم الشراء بنجاح") {
      if (element.parentNode) {
        element.parentNode.removeChild(element);
      }
    }
  });
  

  virifiFatora.forEach((element, i) => { 
    if (element.textContent.trim() === "Purchase successful" || element.textContent.trim() === "تم الشراء بنجاح") {
      spanVirifi[i].classList.add('active_purchase');
      const iconOk = createButton(null, "fa-solid fa-file-circle-check", "i");
      if (!boxIconV[i].querySelector('.fa-file-circle-check')) 
        boxIconV[i].appendChild(iconOk);
    } else {
      spanVirifi[i].classList.add('active_not_purchase');
      const iconNo = createButton(null, "fa-solid fa-file-circle-xmark", "i"); 
      if (!boxIconV[i].querySelector('.fa-file-circle-xmark')) 
        boxIconV[i].appendChild(iconNo);
    }
  });
}

// استدعاء وظيفة virifiF كل 300 ميلي ثانية
const setIntervalEl = setInterval(virifiF, 300);

// وظيفة لتبديل حالة الزر والرمز
const tglBtn = (btn, icon) => {
  btn.parentNode.classList.toggle('active_BxtotalFinalFatora');
  document.querySelector(icon).classList.toggle('active_btnSh');
}

// تعيين حدث النقر على زر الفاتورة النهائية
btntotalFinalFatora.addEventListener("click", function(event) {
  event.preventDefault();
  tglBtn(this,".down");
});



// تحقق من تحميل الصفحة وإظهار/إخفاء حقل البحث
const NotF = () => {
  if(boxTextNotF.textContent === 'No invoice' || boxTextNotF.textContent === 'لا فاتورة'){
    searchInput.style.display = 'none'
    BxtotalFinalFatora.style.display = 'none'
  } else {
   searchInput.style.display = ''
    BxtotalFinalFatora.style.display = ''
  }
}
NotF();


const deleteRecord = (button) => {
  const record_id = button.getAttribute('data-id');
  const dataLng = button.getAttribute('data-lng');
  const xhr = new XMLHttpRequest();

  xhr.open('POST', '../myBack/delet.php');
 
  
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      location.reload();
    }
  };
  const encodedRecordId = encodeURIComponent(record_id);
  const encodedDataLng = encodeURIComponent(dataLng);

  const params = ('record_id=' + encodedRecordId + '&data-lng=' + encodedDataLng);
  
  xhr.send(params);
;
}


// تعيين الحدث لعناصر الحذف
Delet.forEach(function(button) {
  button.addEventListener("click", function(event) {
    event.preventDefault();
    eventBtnAdd(null, null, null, null, null, null, this, this.textContent , "save fa-solid fa-check", deleteRecord.bind(null,this));
    disableAllButtons(true)
    this.classList.remove('active_button');
    setTimeout(setTimeoutDelet1, 4000);
  });
});



// وظيفة لإرسال بيانات التحقق
const sendVirifiData = (button) => {
  const myId = button.getAttribute('data-id')
  var dataLng = button.getAttribute('data-lng');
  const xhr = new XMLHttpRequest();
 
  xhr.open('POST', '../myBack/update.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
    if (xhr.status === 200) {
      location.reload();
    }
  };
  const encodedRecordId = encodeURIComponent(myId);
  const encodedDataLng = encodeURIComponent(dataLng);

  const params = 'id=' + encodedRecordId + '&data-lng=' + encodedDataLng;
  xhr.send(params);
}

// تعيين الحدث لعناصر التحقق
virifiBtn.forEach(function(button) {
  button.addEventListener("click", function(event) {
    event.preventDefault();
    eventBtnAdd(null, null, null, null, null, null, this, this.textContent, "save fa-solid fa-check", sendVirifiData.bind(null, this));
    disableAllButtons(true)
    this.classList.remove('active_button');
    setTimeout(setTimeoutDelet1, 4000);
  });
});

// وظيفة لمراقبة تغييرات في حقل الإدخال وتحديد حالة العنصر التالي
const evtInpt = (input) => {
  if(input.value.length != ""){
    input.nextElementSibling.nextElementSibling.classList.add('active_remove_txt_in');
  } else {
    input.nextElementSibling.nextElementSibling.classList.remove('active_remove_txt_in');
  }
}

// وظيفة لإدارة عرض العناصر على أساس نتائج البحث
const Fond = () => {
  if(myAryFinal.length === 0){
    boxNotFond.style.display = "flex";
    BxtotalFinalFatora.style.display = "none";
   
  } else {
    boxNotFond.style.display = "none";
    BxtotalFinalFatora.style.display = "flex";
  }
}

// وظيفة لحساب المجموع الإجمالي للمستخدمين
const myTotalUser = (myTotal, data) => {
  let totalUser = 0;
  for (let i = 0; i < myTotal.length; i++) {
    const value = parseInt(myTotal[i][data]);
    if (!isNaN(value)) {
      totalUser += value;
    }
    if (language.value === 'francais'){
       totalFinalFatora[5].textContent = totalUser + '  Dh';
    } else if (language.value === 'arabe'){
       totalFinalFatora[5].textContent = totalUser + '  د.م';
    }
  }
};


const ff = (totalV, totalN, nice, _nice, not_nice) => {
  if (totalV > totalN) {
    return nice; 
  } else if (totalV === totalN) {
    return _nice;
  } else if (totalV < totalN) {
    return not_nice;
  }
};

const myGuide = (totalV, totalN) => {
  const fatora = totalFinalFatora[6];
  const parent = fatora.parentNode;

  if (language.value === 'francais') {
    fatora.textContent = ff(totalV, totalN, 'Excellent', 'medium', 'Weak');
  } else if (language.value === 'arabe') {
    fatora.textContent = ff(totalV, totalN, 'ممتاز', 'متوسط', 'ضعيف');
  }
};



const myTotalUserVirif = (myTotal, data) => {
  let totalUser2 = 0;
  let totalUser3 = 0;

  // حساب مجموع القيم بناءً على virfi
  for(let i = 0; i < myTotal.length; i++) {
    const value = parseInt(myTotal[i][data]);
    if (myTotal[i].virfi === "Purchase successful" || myTotal[i].virfi === "تم الشراء بنجاح") {
      if (!isNaN(value)) {
        totalUser2 += value;
      }
    } else if (myTotal[i].virfi === "the rest" || myTotal[i].virfi === "الباقي") {
      if (!isNaN(value)) {
        totalUser3 += value;
      }
    }
  }
     // التحقق من قيم totalUser2 و totalUser3 بعد انتهاء الحلقة
     myGuide(totalUser2,totalUser3)


  // عرض النتيجة بناءً على لغة الصفحة
  if (language.value === 'francais') {
    totalFinalFatora[2].textContent = totalUser2 + '  Dh';
    totalFinalFatora[3].textContent = totalUser3 + '  Dh';
  } else if (language.value === 'arabe') {
    totalFinalFatora[2].textContent = totalUser2 + '  د.م';
    totalFinalFatora[3].textContent = totalUser3 + '  د.م';
  }

  // تأكد من عرض قيم افتراضية إذا كانت القيمة النهائية فارغة
  if (totalFinalFatora[2].textContent.length === 0) {
    totalFinalFatora[2].textContent = '0  Dh';
  }
  if (totalFinalFatora[3].textContent.length === 0) {
    totalFinalFatora[3].textContent = '0  Dh';
  }
};


const myTotalVirifi = (myTotal, oui, no, not) => {
  const purchaseSuccessfulCount = myTotal.filter(item => item.virfi === oui).length;
  const theRest = myTotal.filter(item => item.virfi === no).length;
  totalFinalFatora[0].textContent = purchaseSuccessfulCount;
  totalFinalFatora[1].textContent = theRest;
  if (theRest === 0) {
    totalFinalFatora[1].textContent = not;
  }
  if (purchaseSuccessfulCount === 0) {
    totalFinalFatora[0].textContent = not;
  }
  return purchaseSuccessfulCount;
};


const myTotalVirifiLng = (myAryFinal) => {
  let oui, no, not;
  if (language.value === 'francais') {
    oui = "Purchase successful";
    no = "the rest";
    not = "No invoice"
  } else if (language.value === 'arabe') {
    oui = "تم الشراء بنجاح";
    no = "الباقي";
    not = "لا فاتورة"
  }
  myTotalVirifi(myAryFinal, oui, no, not);
};

const searchImages = () => {
  const searchFilename = document.getElementById('searchFilename').value.toLowerCase();
  myAryFinal.length = 0;

  for (let i = 0; i < spans.length; i++) {
    if (spans[i].innerHTML.toLowerCase().indexOf(searchFilename) >= 0) {
      imageContainers[i].style.display = "";
      myAryFinal.push({virfi: virifiFatora[i].textContent, element: imageContainers[i], total: totalFatora[i].textContent });
    } else {
      imageContainers[i].style.display = "none";
    }
    totalFinalFatora[4].textContent = myAryFinal.length;
    
    idxFatora[i].textContent = myAryFinal.length
  }

  myTotalUser(myAryFinal, 'total');
  myTotalVirifi(myAryFinal, null, null);
  myTotalVirifiLng(myAryFinal);
  myTotalUserVirif(myAryFinal, 'total')
};

window.onload = function() {
searchImages()
};

// استدعاء وظيفة البحث عند كتابة نص في حقل البحث
searchInput.addEventListener('keyup', function(event) {
  event.preventDefault();
  searchImages(event.target)
  evtInpt(this);
  Fond();
  searchName()
});
// دالة تقوم بتحديث واجهة المستخدم
const intrevalfunc2 = () => {
  evtInpt(searchInput);
}
// تكرار تنفيذ الدالة بانتظام لتحديث واجهة المستخدم
let setIntervalEl2 = setInterval(intrevalfunc2, 5);

// وظيفة للتنزيل
const myDownload = (i) => {
  const imgElements = document.querySelectorAll('.imgFatora');
  const imgSrc = imgElements[i].src + '?' + new Date().getTime();
  const link = document.createElement('a');
  link.href = imgSrc;
  link.download = new Date().toISOString().slice(0, 10) + ' Tousalik_' + (i + 1) + '.png';
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

// تعيين الحدث لعناصر التنزيل
downloadBtn.forEach(function(button, i) {
  button.addEventListener("click", function(event) {
    event.preventDefault();
    eventBtnAdd(null, null, null, null, null, null, this, this.textContent, "save fa-solid fa-check", myDownload.bind(null, i));
    disableAllButtons(true)
    this.classList.remove('active_button');
    setTimeout(setTimeoutDelet1, 4000);
  });
});

// وظيفة للطباعة
const myPrint = (i) => {
  const imgElements = document.querySelectorAll('.imgFatora');
  const imgSrc = imgElements[i].src;
  const newWindow = window.open(imgSrc);
  newWindow.onload = function() {
    newWindow.print();
    setTimeout(function() {
      newWindow.close();
    }, 50);
  }
}

// تعيين الحدث لعناصر الطباعة
printBtn.forEach(function(button, i) {
  button.addEventListener("click", function(event) {
    event.preventDefault();
    eventBtnAdd(null, null, null, null, null, null, this, this.textContent , "save fa-solid fa-check", myPrint.bind(null, i));
    disableAllButtons(true)
    this.classList.remove('active_button');
    setTimeout(setTimeoutDelet1, 4000);
  });
});


const liHeaders = document.querySelectorAll('.liHeader');
liHeaders[1].classList.add('active')

setTimeout(() => document.getElementById('searchFilename').focus(), 100);
  

if (window.location.href.includes('francais/fatora.php')) {
  const text_lng = document.querySelectorAll('.text_lng');
  const Mylinck = (btnLng) => {
    window.location.href = 'http://localhost/fatora/arabe/fatora.php';
  };
    text_lng[0].addEventListener("click", function(event) {
      event.preventDefault();
      setTimeout(() => Mylinck(this), 300);
    });
  }else if (window.location.href.includes('arabe/fatora.php')) {
    const text_lng = document.querySelectorAll('.text_lng');
    const Mylinck = (btnLng) => {
      window.location.href = 'http://localhost/fatora/francais/fatora.php';
    };
      text_lng[1].addEventListener("click", function(event) {
        event.preventDefault();
        setTimeout(() => Mylinck(this), 300);
      });
    }


// وظيفة للطباعة
const vuImg = (i) => {
  const imgElements = document.querySelectorAll('.imgFatora');
  const imgSrc = imgElements[i].src;
  const newWindow = window.open(imgSrc);
}

// تعيين الحدث لعناصر الطباعة
boxImg.forEach(function(button, i) {
  button.addEventListener("click", function(event) {
    event.preventDefault();
    vuImg(i)
  });
});   