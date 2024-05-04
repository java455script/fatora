// تعريف المتغيرات اللازمة باستخدام تدمير الكائنات
const addForm = document.getElementById('addForm')
const [nameInput, dateInput, productInput, qieInput, priceInput, totalInput, addBuytton] = ["name", "date", "product", "quantity", "price", "total", "add-button"].map(id => document.getElementById(id));
const myInput = [nameInput, dateInput, productInput, qieInput, priceInput, totalInput];
const box_date = document.querySelector(".box_date");
const dataTable = document.getElementById('dataTable');
//
const boxBtn = document.getElementById('boxBtn');

const rightF = document.getElementById('rightF');
const boxBtnF = document.querySelector('.boxBtnF');
const saveF = document.getElementById('storage');
const language = document.querySelector('.language');

const searchInput = document.querySelector('.searchFilename');

const box_erore = document.querySelector('.box_erore');
const text_erore = document.querySelector('.text_erore');
const boxThisData = document.querySelector('.boxThisData');

const myErore = (myText) => {
  setTimeout(() => box_erore.classList.add('active_box_erore'), 3000);
  setTimeout(() => box_erore.classList.remove('active_box_erore'), 500);
  text_erore.textContent = myText;
}

// تعريف الدالة التي تقوم بحساب الإجمالي
const calculate = () => {
  // استخراج قيمة الكمية من حقل الإدخال
  const qie = parseFloat(qieInput.value);
  // استخراج قيمة السعر من حقل الإدخال
  const prix = parseFloat(priceInput.value);
  // تهيئة المتغير الذي سيحمل الناتج الإجمالي
  let result_total = 0;

  // التأكد من أن قيمة الكمية والسعر مدخلة بشكل صحيح
  if (!isNaN(qie) && !isNaN(prix)) {
    // حساب الناتج الجزئي
    let result = qie * prix;
    // عرض الناتج الجزئي في حقل الإدخال الخاص بالإجمالي
    totalInput.value = result;
  } else {
    // إذا كانت إحدى القيم غير صالحة، قم بعرض قيمة الإجمالي الفارغة
    totalInput.value = result_total;
  }
}

// تعريف الدالة التي تقوم بإزالة صفوف من الجدول باستثناء الصف الأول
const removeTdTblMax1 = (elment) => {
  // الحصول على جميع الصفوف المطابقة للعنصر المحدد
  let rows = document.querySelectorAll(elment);
  // تكرار كل صف والتحقق مما إذا كان الفهرس أكبر من صف العنوان
  rows.forEach((row, index) => {
    if(index > 0) {
      // في حال كان الفهرس أكبر من صف العنوان، قم بإزالة الصف
      row.parentNode.removeChild(row);
    }
  });
}

// دالة لحساب مجموع القيم في الجدول
const fTotal = () => {
  // الحصول على جميع الخلايا التي تحتوي على القيم في الجدول
  let sun = document.querySelectorAll('.td3');
  // تهيئة متغير لحفظ مجموع القيم
  let sum = 0;
  
  // حساب مجموع القيم من الخلايا
  sun.forEach(cell => {
    sum += parseFloat(cell.textContent);
  });

  // إزالة الصف السابق للمجموع إذا كان موجوداً
  const existingSumRow = document.getElementById("sumRow");
  if (existingSumRow) {
    existingSumRow.parentNode.removeChild(existingSumRow);
  }

  // إنشاء صف جديد لعرض المجموع
  const newRow2 = document.getElementById("table_total").insertRow();
  newRow2.id = "sumRow";
  const cell2 = newRow2.insertCell();
  cell2.className = "dataTd datafinTotal";
  cell2.textContent = sum;
}

// دالة لمسح محتوى الحقول
const epty = () => {
  // الحصول على كافة حقول الإدخال وتفريغ محتواها
  myInput.forEach(input => input.value = "");
}

// دالة لتحديث التاريخ والوقت
const dateTime = () => {
  // الحصول على التاريخ والوقت الحالي
  const currentDate = new Date();
  const empty = ' ';
  // تهيئة التاريخ بالصيغة المطلوبة
  const formattedDate = `${currentDate.getFullYear()}-${(currentDate.getMonth() + 1).toString().padStart(2, '0')}-${currentDate.getDate().toString().padStart(2, '0')}`;
  // تهيئة الوقت بالصيغة المطلوبة
  const formattedTime = `${currentDate.getHours().toString().padStart(2, '0')}:${currentDate.getMinutes().toString().padStart(2, '0')}:${currentDate.getSeconds().toString().padStart(2, '0')}`;
  // تهيئة التاريخ والوقت معًا
  const dateTime = `${formattedDate}${empty}${formattedTime}`;
  // عرض التاريخ والوقت في الحقل المحدد
  date.value = dateTime;
  // إضافة التصميم الخاص بالتاريخ والوقت
  box_date.classList.add('active_date');
}

// تحديث التاريخ والوقت عند تحميل الصفحة
window.onload = function(){
  // استدعاء الدالة لتحديث التاريخ والوقت
  dateTime();
}


//
const setTimeoutDelet2 = (row) => {
  row.parentNode.removeChild(row);
  // تحديث الإجمالي
  fTotal();
  // إحصاء البيانات
  lntData();
}
///////////////////////////////
const deleteRow = (button) => {
  // الحصول على الصف الذي يجب حذفه
  const row = button.parentNode.parentNode;
  // تعطيل جميع أزرار التعديل والحذف
  disableAllButtons(true)
  //
  setTimeout(setTimeoutDelet1, 4000);
  // التحقق مما إذا كان هناك صفوف يمكن حذفها
  if (row.parentNode.rows.length > 1) {
    // إضافة زر الحفظ بجانب الزر الحذف
    eventBtnAdd(null, null, null, null, null, null, button, button.textContent, "save fa-solid fa-check", null);
      // تأخير التوجيه لعرض تأثير الانتقال
      setTimeout(() =>  setTimeoutDelet2(row), 4000);

  } else {
    // إظهار رسالة خطأ إذا لم يكن هناك صفوف لحذفها
    eventBtnAdd(null, null, null, null, null, null, button, button.textContent, "notSave save fa-solid fa-xmark", null);
    if (language.value === 'francais'){
      myErore('The first item cannot be removed')
    } else if (language.value === 'arabe'){
      myErore('لايمكن إزالة العنصر الأول')
    }
  }
}

//
const editRow = (button, i, idx, t_td, v_ipt) => {
  const row = button.parentNode.parentNode;
  const cells = Array.from(row.cells).slice(0, idx);

  // تحديث قيم حقول الإدخال بقيم الخلايا في الصف
  cells.forEach((cell, index) => {
    document.getElementById(v_ipt[index].id).value = cell.textContent;
  });

  // الحصول على زر التعديل والحذف
  const editButton = row.cells[idx].querySelector(`.editButton${i}`);
  const deleteButton = row.cells[idx].querySelector(`.deleteButton${i}`);

  // إضافة أو إزالة الكلاسات اللازمة لتعديل الواجهة
  

  // تعطيل كافة أزرار التعديل والحذف وزر الإضافة
  disableAllButtons(true)

  // إنشاء زر "حفظ" بناءً على عنوان الصفحة الحالية
  let Modified;
  if (language.value === 'francais'){
    Modified = createButton('Save', 'Modified my_btn', "button");
  } else if (language.value === 'arabe'){
    Modified = createButton("حفظ", 'Modified my_btn', "button");
  }
  button.parentNode.parentNode.classList.add('active_tr_edit');
  
  // إضافة زر "حفظ" إلى النموذج
  addForm.appendChild(Modified);

  // دالة لتحديث الصف بعد الحفظ
  const up = () => {
    // إظهار حقل التاريخ
    box_date.classList.add('active_date');
    // إزالة الكلاسات اللازمة لتعديل الواجهة
    button.parentNode.parentNode.classList.remove('active_tr_edit');

    // تفعيل كافة أزرار التعديل والحذف وزر الإضافة
    disableAllButtons(false)

    // تحديث قيم الخلايا بقيم حقول الإدخال
    cells.forEach((cell, index) => {
      cell.textContent = document.getElementById(v_ipt[index].id).value;  
    });
    addForm.removeChild(Modified);

    // إعادة حساب إجمالي القيم
    fTotal();
    nameInput.style.display = 'none'  
    document.querySelector('.remove_name').style.display = 'flex'
  }

  // إضافة مستمع لحدث النقر على زر "حفظ"
  Modified.addEventListener("click", function(event) {
    event.preventDefault();
  
    // التحقق من فارغة قيم الحقول
    const allFieldsFilled = v_ipt.every(input => input.value.trim());
  
    if (allFieldsFilled) {
      // تحديث الصف بعد الحفظ
      eventBtnAdd(null, null, null, null, null, null, this, this.textContent, "save fa-solid fa-check", up.bind(null, this));
      setTimeout(epty, 4100);
    } else {
      eventBtnAdd(null, null, null, null, null, null, this, this.textContent, "save fa-solid fa-xmark", null);
      if (language.value === 'francais'){
        myErore('Input fields are blank')
      } else if (language.value === 'arabe'){
        myErore('حقول الإدخال فارغة')
      }
    }
  });

}

// دالة لإضافة صف إلى الجدول
const addRow = (name, date, product, quantity, price, total, btn) => {
  // إضافة التصميمات اللازمة لعرض الجدول والأزرار
  dataTable.classList.add('active_table');
  boxBtn.classList.add('active_table_btn');
  boxThisData.classList.add('active_boxThisData')
  nameInput.style.display = 'none'
  document.querySelector('.remove_name').style.display = 'flex'
  // تجهيز البيانات في صفوف الجدول
  const dataArrays = [
    [name, date],
    [product, quantity, price, total]
  ];

  // إضافة كل صف إلى الجدول
  dataArrays.forEach((values, index) => {
    const tableId = index === 0 ? "tableBodyUser" : "tableBody";
    const newRow = document.getElementById(tableId).insertRow();

    // إضافة البيانات إلى الصف
    values.forEach((val, idx) => {
      const cell = newRow.insertCell();
      cell.textContent = val;
      cell.className = "dataTd td" + idx;
      
    });
    
    // إضافة أزرار التحرير والحذف إلى الصف
    const cellBtn = newRow.insertCell();
    cellBtn.className = "btnAction";

    // إنشاء زر "حفظ" بناءً على عنوان الصفحة الحالية
    let editButton, deleteButton;
  if (language.value === 'francais'){
      editButton = createButton("Edit", "my_btn editButton" + index, "button");
      deleteButton = createButton("Delete", "my_btn deleteButton" + index, "button"); 
  } else if (language.value === 'arabe'){
     editButton = createButton("تعديل", "my_btn editButton" + index, "button");
     deleteButton = createButton("حدف", "my_btn deleteButton" + index, "button"); 
  }

    cellBtn.append(editButton, deleteButton);

    // تعيين الاستماع لأحداث النقر على أزرار التحرير والحذف
    if (index === 0) {
      editButton.addEventListener("click", function(event) {
        event.preventDefault();
        disableAllButtons(true);
        eventBtnAdd(null, null, null, null, null, null, this, this.textContent , "save fa-solid fa-check", function() {
          editRow(this, 0, 2, [this.parentNode.parentNode.cells[0], this.parentNode.parentNode.cells[1]], [nameInput, dateInput]);
          nameInput.scrollIntoView({ behavior: 'smooth' }) 
          nameInput.style.display = ''
          document.querySelector('.remove_name').style.display = ''
          box_date.classList.remove('active_date');
        }.bind(this));
        this.classList.remove('active_button');
      });
    } else {
      editButton.addEventListener("click", function(event) {
        event.preventDefault();
        disableAllButtons(true);
        eventBtnAdd(null, null, null, null, null, null, this, this.textContent , "save fa-solid fa-check", function() {
          box_date.classList.add('active_date');
          productInput.scrollIntoView({ behavior: 'smooth' })
          editRow(this, 1, 4, [this.parentNode.parentNode.cells[0], this.parentNode.parentNode.cells[1], this.parentNode.parentNode.cells[2], this.parentNode.parentNode.cells[3]], [productInput, qieInput, priceInput, totalInput]);
        }.bind(this));
        this.classList.remove('active_button');
      });
      deleteButton.addEventListener("click", function(event) {
        event.preventDefault();
        deleteRow(this);
        this.classList.remove('active_button');
      });
    }
  });
  // إزالة الصفوف الزائدة بعد الإضافة
  removeTdTblMax1("#tableBodyUser tr");
  // تحديث الإحصاءات
  lntData();
  // إعادة حساب الإجمالي
  fTotal();
  totlFinl.scrollIntoView({ behavior: 'smooth' }) 

};

// إضافة الصف عند تقديم النموذج
document.getElementById("addForm").addEventListener("submit", function(event) {
  event.preventDefault();

  // الحصول على كافة الصفوف الموجودة في الجدول
  let rows = document.querySelectorAll("#tableBodyUser tr");
  // استخراج القيم من حقول الإدخال
  const [name, date, product, quantity, price, total] = Array.from(document.querySelectorAll("#addForm input")).map(input => input.value.trim());

  // التحقق من أن جميع الحقول مملوءة بالبيانات
  if (name && date && product && quantity && price && total) {
    // إضافة الصف وعرض رسالة النجاح
    eventBtnAdd(name, date, product, quantity, price, total, addBuytton,  addBuytton.textContent , "save fa-solid fa-check", addRow);
    disableAllButtons(true);
    addBuytton.classList.remove('active_button');
    setTimeout(setTimeoutDelet1, 4000);
    setTimeout(epty, 4000);

  } else if (rows.length !== 0 && (product && quantity && price && total)) {
    // إذا كان هناك صفوف موجودة بالفعل، قم بإضافة الصف الجديد وعرض رسالة النجاح
    eventBtnAdd(name, date, product, quantity, price, total, addBuytton,  addBuytton.textContent , "save fa-solid fa-check", addRow);
    disableAllButtons(true);
    addBuytton.classList.remove('active_button');
    setTimeout(setTimeoutDelet1, 4000);
    setTimeout(epty, 4000);
  } else {
    // إظهار رسالة الخطأ إذا لم تكن جميع الحقول مملوءة بالبيانات
    eventBtnAdd(null, null, null, null, null, null, addBuytton, addBuytton.textContent, "save fa-solid fa-xmark",null);
    disableAllButtons(true);
    addBuytton.classList.remove('active_button');
    setTimeout(setTimeoutDelet1, 4000);
    if (language.value === 'francais'){
      myErore('Input fields are blank')
    } else if (language.value === 'arabe'){
      myErore('حقول الإدخال فارغة')
    }
  }


});

///////////////////////////////
// دالة لتحديث واجهة المستخدم بناءً على الإدخالات
const evtInptLabl = (input) => {
  if (input.value.length != "") {
    input.classList.add('active_br_inpt');
    input.nextElementSibling.nextElementSibling.classList.add('active_remove_txt_in');
    input.nextElementSibling.classList.add('active_remove_lbl');
  } else {
    input.classList.remove('active_br_inpt')
    input.nextElementSibling.nextElementSibling.classList.remove('active_remove_txt_in');
    input.nextElementSibling.classList.remove('active_remove_lbl');
  }
}

// إضافة مستمعين لأحداث keyup لحقول الإدخال
myInput.forEach((input, idx) => {
  input.addEventListener('keyup', function(event) {
    if (idx >= 3) {
      calculate();
      notString(this); // افعل أي شيء تحتاج إلى القيام به عندما يكون الحقل الرابع أو أكثر
    }else{
      evtInptLabl(this); // افعل أي شيء تحتاج إلى القيام به عند حدوث حدث keyup
      if (language.value === 'francais'){
        notNumber(this,event,/^[A-Za-z\s]*$/,/[^A-Za-z\s]/g, '')
      } else if (language.value === 'arabe'){
        notNumber(this,event,/^[\u0600-\u06FF\s]*$/,/[^\u0600-\u06FF]/g, '')
      }  
      
    }
  });
});

// دالة لعرض عدد الصفوف في الجدول الخاص بالمستخدمين والجدول العام
const lntData = () => {
  const tableRows = document.querySelectorAll('.tableBodyUser tr');
  const lntDataUser = document.getElementById('lntDataUser');

  const tableRows2 = document.querySelectorAll('.tableBody tr');
  const lntDataUser2 = document.getElementById('lntDataUser2');

  // عرض عدد الصفوف في الجدول الخاص بالمستخدمين
  lntDataUser.textContent = tableRows.length - 1;
  // عرض عدد الصفوف في الجدول العام
  lntDataUser2.textContent = tableRows2.length;
}

// إعادة تحميل الصفحة عند النقر على الزر
rightF.addEventListener("click", function(event) {
  event.preventDefault();
  rightF.classList.add('active_btnSh')
  if(rightF.classList.contains('active_btnSh')) {
    window.location.reload();
  }
});

///////////////////////////////
// الحصول على عنصر الصورة وعنصر الكانفاس
const img = document.getElementById("logo");
const canvas = document.getElementById('tableCanvas');
const ctx = canvas.getContext('2d');

// دالة لاستخراج بيانات الجدول ورسمها على Canvas
const drawTableData = (canvas, ctx) => {
  // الحصول على كافة الصفوف من الجدول
  const rows = dataTable.querySelectorAll('tbody tr, thead tr');
  // حساب عرض الخلية وارتفاع الصفوف
  let cellWidth;
  const cellHeight = 50;
  let rowsHeight = dataTable.offsetHeight+cellHeight+cellHeight+40;
  canvas.height = rowsHeight;

  // تعيين لون الخلفية إلى الأبيض ورسمها
  ctx.fillStyle = "white";
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  // تنظيم النص والخلية
  ctx.font = '17px system-ui';
  ctx.imageSmoothingEnabled = true; // تمكين التنعيم
  ctx.imageSmoothingQuality = "high"; // زيادة جودة التنعيم

  // بدء الرسم
  let y = cellHeight; // بداية الرسم من خلية العنوان
  rows.forEach((row, idx)=> {
  // الحصول على كافة الخلايا في الصف الحالي
  const cells = row.querySelectorAll('.dataTd, .dataTh');
  const reversedCells = Array.from(cells).reverse();
  
  let x = 0; // بداية الخلية الأولى

  // تعريف الدالة changeCells
  const changeCells = (myCells) => {
    myCells.forEach((cell) => {
      // تحديد عرض الخلية بناء على الموقع في الصف
      if(idx <= 1){
        cellWidth = 1200 / 3;
      } else if(row.id.includes("totlFinl") || row.id.includes("sumRow")){
        cellWidth = 1200 / 1.5;
      }else {
        cellWidth = 1200 / 6;
      }

      // تحديد لون النص باستناء الخلية الأولى
      ctx.fillStyle = cell.tagName.toLowerCase() === 'th' ? "black" : "#555";
  
      if (language.value === 'francais'){
        // رسم النص داخل الخلية
         if(idx === 0){
          ctx.fillStyle ='#00000006';
          ctx.fillRect(x, y+80, cellWidth, cellHeight);
          ctx.fillRect(x, y-40, cellWidth, cellHeight+cellHeight);
          ctx.fillStyle ='black';
          ctx.fillText(cell.textContent, x + 15, y+110); 
        }
         else if(idx === 1){
          ctx.fillStyle ='#00000003';
          ctx.fillRect(x, y + 80, cellWidth, cellHeight);
          ctx.fillStyle ='#555';
          ctx.fillText(cell.textContent, x + 15, y+110);
        }
        else {
          ctx.fillText(cell.textContent, x + 11, y + 131);
          ctx.strokeRect(x, y+100, cellWidth, cellHeight);
        }
        ctx.drawImage(img, 15, 20, 80, 80);
      } else if (language.value === 'arabe'){
          // رسم النص داخل الخلية
          if(idx === 0){
            ctx.fillText(cell.textContent, x + 385, y+110);
            ctx.fillStyle ='#00000006';
            ctx.fillRect(x, y+80, cellWidth, cellHeight);
            ctx.fillRect(x, y-40, cellWidth, cellHeight+cellHeight);
          }
           else if(idx === 1){
            ctx.fillText(cell.textContent, x + 385, y+110);
            ctx.fillStyle ='#00000003';
            ctx.fillRect(x, y + 80, cellWidth, cellHeight);
          }
          
        else if(row.id.includes("totlFinl") || row.id.includes("sumRow")){
          ctx.strokeRect(x, y + 100, cellWidth, cellHeight);
          ctx.fillText(cell.textContent, x + 790, y+130)
        }
        else {
          ctx.fillText(cell.textContent, x + 190, y + 131);
          ctx.strokeRect(x, y+100, cellWidth, cellHeight);
        }
        ctx.drawImage(img, 708, 20, 80, 80);
      }
      x += cellWidth; // التحرك إلى الخلية التالية
        // رسم الصورة في أسفل الكانفاس
     
    });
  }
  // استدعاء الدالة changeCells وتمرير الخلايا المناسبة وفقًا للغة المحددة
  if(language.value === 'francais'){
    changeCells(cells);
  } else if(language.value === 'arabe'){
    changeCells(reversedCells);  
  }

  y += cellHeight; // التحرك إلى الصف التالي
});

// تشفير البيانات
const imageData = canvas.toDataURL('image/png');
document.getElementById('imageData').value = imageData;

const nameData = document.querySelector('.td0').textContent;
document.getElementById('nameData').value = nameData;

const totalData = document.getElementById('sumRow').textContent;
document.getElementById('totalData').value = totalData;

}

///////////////////////////////
// الحصول على عناصر النجاح والشراء
const purchased = document.getElementById("purchased");

// دالة لتنفيذ إجراء الشراء
const khalse = () => {
  const buying = document.querySelector('.buying');
  buying.click(); // تنفيذ الإجراء
}
khalse();
const maKhalse = () => {
  const no_purchase = document.querySelector('.no_purchase');
  no_purchase.click(); // تنفيذ الإجراء
}


purchased.addEventListener("click", function(event) {
  event.preventDefault();
  // إضافة حدث للزر بعد عدم الشراء
  eventBtnAdd(null, null, null, null, null, null, this, this.textContent, "save fa-solid fa-check", maKhalse.bind(null, this));
  disableAllButtons(true)
  this.classList.remove('active_button');
  setTimeout(setTimeoutDelet1, 4000);
});



// دالة لحفظ الفاتورة
const saveFa = () => {
  // رسم بيانات الجدول على الكانفاس وحفظها
  drawTableData(canvas, ctx);
  // النقر على زر حفظ الفاتورة
  const saveFatora = document.getElementById('saveFatora');
  saveFatora.click();
  // النقر على زر تقديم الفاتورة
  const submitFatora = document.getElementById('submitFatora');
  submitFatora.click();
}

// تعيين مستمع لحدث النقر على زر الحفظ
saveF.addEventListener("click", function(event) {
  event.preventDefault();
  // إضافة حدث للزر بعد الحفظ
  eventBtnAdd(null, null, null, null, null, null, this, this.textContent, "save fa-solid fa-check", saveFa.bind(null, this));
  disableAllButtons(true);
  this.classList.remove('active_button');
  setTimeout(setTimeoutDelet1, 4000);
});

// دالة تقوم بتحديث واجهة المستخدم
const intrevalfunc = () => {
  // تحديث واجهة المستخدم بناءً على الإدخالات
  myInput.forEach(input => evtInptLabl(input));
}

// تكرار تنفيذ الدالة بانتظام لتحديث واجهة المستخدم
let setIntervalEl = setInterval(intrevalfunc, 5);

const liHeaders = document.querySelectorAll('.liHeader');
liHeaders[0].classList.add('active')



//lng href
if (window.location.href.includes('francais/index.php')) {
  const text_lng = document.querySelectorAll('.text_lng');
  const Mylinck = (btnLng) => {
    window.location.href = 'http://localhost/fatora/arabe/index.php';
  };
    text_lng[0].onclick = function () {
      setTimeout(() => Mylinck(this), 300);
    };
  }else if (window.location.href.includes('arabe/index.php')) {
    const text_lng = document.querySelectorAll('.text_lng');
    const Mylinck = (btnLng) => {
      window.location.href = 'http://localhost/fatora/francais/index.php';
    };
      text_lng[1].onclick = function () {
        setTimeout(() => Mylinck(this), 300);
      };
    }
    
  
     
    nameInput.addEventListener("keyup", function(event) {
      event.preventDefault();
      searchName()
      nameFatora2.forEach(box => { 
      box.style.transform = 'translateX(-3.5px) translateY(2px)';
      });
    });


// تعيين حدث النقر على nameInput لتغيير قيمة الـ placeholder
nameInput.addEventListener("click", function(event) {
  event.preventDefault();
  if (language.value === 'francais'){
    this.placeholder = 'Look for names';
  } else if (language.value === 'arabe'){
    this.placeholder = 'إبحت عن الأسماء';
  }

});

document.addEventListener("click", function(event) {
  if (event.target !== nameInput) {
      nameInput.placeholder = '';
  }
});