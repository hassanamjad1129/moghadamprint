//==============user panel ======================================

function userPanelMenuSubItemHandler(elem) {
    if (elem.nextElementSibling.className === "subMenuWrap") {
        if (elem.nextElementSibling.style.display === "block") {
            elem.nextElementSibling.style.display = "none";
        }
        else if (elem.nextElementSibling.style.display === "none") {
            elem.nextElementSibling.style.display = "block";
        }
    }
}


function userPanelNotifSubItemHandler(elem) {
    if (elem.nextElementSibling.className === "notification-content") {
        if (elem.nextElementSibling.style.display === "block") {
            elem.nextElementSibling.style.display = "none";
        }
        else if (elem.nextElementSibling.style.display === "none") {
            elem.nextElementSibling.style.display = "block";
        }
    }
}

function userPanelNameSubItemHandler(elem) {
    if (elem.nextElementSibling.className === "userProfileContent") {
        if (elem.nextElementSibling.style.display === "block") {
            elem.nextElementSibling.style.display = "none";
        }
        else if (elem.nextElementSibling.style.display === "none") {
            elem.nextElementSibling.style.display = "block";
        }
    }
}


function userPanelAccessSubItemHandler(elem) {
    if (elem.nextElementSibling.className === "quikAccessContent") {
        if (elem.nextElementSibling.style.display === "block") {
            elem.nextElementSibling.style.display = "none";
        }
        else if (elem.nextElementSibling.style.display === "none") {
            elem.nextElementSibling.style.display = "block";
        }
    }
}

//=================================================================

//====================category handler smart wizard ===============
var subCat = 0;
var product = 0;

function categorySelectHandler(elem) {

    var elements = document.getElementsByClassName("wizardImageItem");

    var counter;
    var innerCounter;
    var cat_id;

    for (counter = 0; counter < elements.length; counter++) {
        var item = elements[counter];

        for (innerCounter = 0; innerCounter < item.classList.length; innerCounter++) {
            if (item.classList[innerCounter] === "wizardCatSelected") {
                item.classList.remove("wizardCatSelected");
            }

        }

    }

    cat_id = elem.getAttribute("catId");
    $.ajax({
        type: 'post',
        data: {
            category: cat_id,
        },
        url: "/customer/getSubCategories",
        success: function (response) {
            var response = JSON.parse(response);
            var result = "<table class='table table-hover table-striped table-responsive table-bordered' style='width: 50%'>" +
                "<thead>" +
                "<tr>" +
                "<th style='width: 100px'>انتخاب</th>" +
                "<th>نوع کار</th>" +
                "</tr>" +
                "</thead><tbody>";
            for (var item in response) {
                var subcategory = response[item];
                result +=
                    '<td>' +
                    '<div class="form-check">' +
                    '<label class="toggle">' +
                    '<input type="radio" name="subCategory" value="' + subcategory['id'] + '"> <span class="label-text"></span>' +
                    '</label>'
                    + '</div>'
                    + '</td>'
                    + '<td>' + subcategory['name'] + '</td>'
                    + '</tr>';
            }
            result += "</tbody></table>";
            $("#step-2>.step2Content").html(result);
        }
    });
    elem.classList.add("wizardCatSelected");
}


//=================================================================
$("body").on('change', "input[name=product]", function () {
    product = $(this).val();
    $.ajax({
        type: 'post',
        data: {
            product: $(this).val(),
        },
        url: "/customer/fetchProductInformation",
        success: function (response) {
            response = JSON.parse(response);
            var result = "<div class='col-md-6'><label>نوع :</label>" +
                "<input type='radio' name='type' value='single' /><label for='' style='margin-right: 5px;'>یک رو</label>";
            if (response['double_price'])
                result += "<input type='radio' name='type' value='double' /><label for='' style='margin-right: 5px;'>دو رو</label>";
            result += "</div>";
            result += "<div class='col-md-6'><label>سرعت چاپ :</label>" +
                "<input type='radio' name='speed' value='normal' /><label for='' style='margin-right: 5px;'>عادی</label>";
            if (response['fast_single_price'])
                result += "<input type='radio' name='speed' value='fast' /><label for='' style='margin-right: 5px;'>فوری</label>";
            result += "</div>";
            $("#step-3 .extraOptions").html(result);
        }
    });

});

$("body").on('change', 'input[name=type]', function () {

    var type = $(this).val();
    $.ajax({
        type: 'post',
        url: "/customer/getFiles",
        data: {
            subCategory: subCat
        },
        success: function (response) {
            response = JSON.parse(response);
            var result = "";
            for (item in response) {
                file = response[item];
                result += "<input type='hidden' name='product' value='" + product + "'><div class=\"upload-btn-wrapper col-md-3\">\n" +
                    "                    <button class=\"btn\" style='width: 100%;font-family: Yekan;cursor: pointer'><i class='fa fa-upload'></i> " + file['front_file_label'] + "</button>\n" +
                    "                    <input type=\"file\" name=\"file-" + file['id'] + "-front\" />\n" +
                    "                </div>" + ((type === 'double') ? ("<div class=\"upload-btn-wrapper col-md-3\"><button class=\"btn\" style='width: 100%;font-family: Yekan'><i class='fa fa-upload'></i> " + file['back_file_label'] + "</button><input type=\"file\" name=\"file-" + file['id'] + "-back\" /></div>") : "");
            }
            result += ("<div class='clearfix'></div>" + "<div style='    margin: 0 auto;\n" +
                "    display: flex;\n" +
                "    flex-direction: row;\n" +
                "    justify-content: center;\n" +
                "    align-items: center;\n" +
                "    padding: 3rem;'><label style='    margin-left: 2rem;\n" +
                "font-size: 20px;'>سری : </label><input style='width: 50px;\n" +
                "    text-align: center;\n" +
                "    border: 2px solid #ff4444;\n" +
                "    padding: 6px;\n" +
                "    font-size: 18px;' type='number' min='1' value='1' name='qty'></div>");
            $(".files").html(result);
        }
    });
});

$("body").on('change', "input[name=subCategory]", function () {
    subCat = $(this).val();
    $.ajax({
        type: 'post',
        data: {
            subCategory: subCat,
        },
        url: "/customer/fetchProducts",
        success: function (response) {
            var response = JSON.parse(response);
            var result = "<table class='table table-striped table-hover table-bordered table-responsive'>" +
                "<thead>" +
                "<tr>" +
                "<th>انتخاب</th>" +
                "<th>عنوان سایز</th>" +
                "<th>پهنا</th>" +
                "<th>ارتفاع</th>" +
                "<th>قیمت یک رو</th>" +
                "<th>قیمت دو رو</th>" +
                "<th>قیمت یک رو فوری</th>" +
                "<th>قیمت دو رو فوری</th>" +
                "<th>زمان تحویل عادی</th>" +
                "<th>زمان تحویل فوری</th>" +
                
                "</tr>" +
                "</thead><tbody>";
            for (var item in response) {
                var product = response[item];
                result += '<tr>' +
                    '<td>' +
                    '<div class="form-check">' +
                    '<label class="toggle">' +
                    '<input type="radio" name="product" value="' + product['id'] + '"> <span class="label-text"></span>' +
                    '</label>' +
                    '</div></td>' +
                    '<td>' + product['name'] + '</td>' +
                    '<td>' + product['x_size'] +' میلیمتر ' + '</td>' +
                    '<td>' + product['y_size'] +' میلیمتر '+ '</td>' +
                    '<td>' + product['single_price'] + ' ریال</td>' +
                    '<td>' + product['double_price'] + ' ریال</td>' +
                    '<td>' + product['fast_single_price'] + ' ریال</td>' +
                    '<td>' + product['fast_double_price'] + ' ریال</td>' +
                    '<td>' + product['normal_delivery'] + ' روزکاری</td>' +
                    '<td>' + product['fast_delivery'] + ' روزکاری</td>' +
                    '</tr>';
            }
            result += "</tbody></table>" + "<div class='extraOptions'></div>";
            $("#step-3").html(result);
        }
    });
});


$('.js-tilt').tilt({
    scale: 1.1,
    glare: true,
    maxGlare: 0.3
});


//Make sure the user has scrolled at least double the height of the browser
var toggleHeight = $(window).outerHeight() * .2;

$(window).scroll(function () {
    if ($(window).scrollTop() > toggleHeight) {
        //Adds active class to make button visible
        $(".m-backtotop").addClass("active");

        //Just some cool text changes
        $('pageTop').text('TA-DA! Now hover it and hit dat!')

    } else {
        //Removes active class to make button visible
        $(".m-backtotop").removeClass("active");

        //Just some cool text changes
        $('pageTop').text('(start scrolling)')
    }
});

function handleMainContentSubCats(element) {

    var detailsElementHeight = element.lastElementChild.offsetHeight;

    var detailsElement = element.lastElementChild;

    detailsElement.setAttribute("height", detailsElementHeight);

    var oldFatherHeight = document.getElementById("mainContent").offsetHeight;

    oldFatherHeight = (oldFatherHeight + detailsElementHeight).toString() + "px";

    document.getElementById("mainContent").style.height = oldFatherHeight;

}

function handleMainContentSubCats2(element) {

    var detailsElement = element.lastElementChild;

    var detailsElementHeight = detailsElement.getAttribute("height");

    var oldFatherHeight = document.getElementById("mainContent").offsetHeight;

    oldFatherHeight = (oldFatherHeight - detailsElementHeight).toString() + "px";

    document.getElementById("mainContent").style.height = oldFatherHeight;

}


function introModalClosezBtn() {
    introModalElem = document.getElementById("introModalSection");
    if (introModalElem.style.display === "none") {
        introModalElem.style.display = "flex";
    }
    else if (introModalElem.style.display === "flex") {
        introModalElem.style.display = "none";
    }
}


function openOfferModal() {
    introModalElem = document.getElementById("introModalSection");
    if (introModalElem.style.display === "none") {
        introModalElem.style.display = "flex";
    }
}

function closeWelcomeModal() {
    document.getElementById("welcomeModal").setAttribute("class", "hide");
}

/////////////////////////
$("body").on('change', "input[type='file']", function () {
    var fileValue = $(this).val();

    $(this).parent().parent().children('p:first').html(fileValue.split("\\")[2]);
    var options = {
        beforeSubmit: showRequest,
        success: showResponse,
        uploadProgress: function (event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            $(".progress-bar-striped").attr('aria-valuenow', percentComplete);
            $(".progress-bar-striped").text(percentVal);
            $(".progress-bar-striped").css('width', percentVal);
        },
        error: function () {
            swal.close();
        },
        url: "/customer/checkFile",        // override for form's 'action' attribute
        type: 'post'      // 'get' or 'post', override for form's 'method' attribute
    };

    // bind form using 'ajaxForm'
    $("#finalStep").ajaxSubmit(options);

    function showResponse(responseText, statusText, xhr, $form) {
        swal.close();
        responseText = JSON.parse(responseText);
        if (responseText == 1) {
            alert('خطا! فرمت های مجاز jpg و jpeg می باشند.');
        } else if (responseText == 2) {
            alert('خطا! سایز فایل ارسالی شما بیش از یک میلیمتر از سایز استاندارد اختلاف دارد.');
        } else {
            var result = "";
            for (item in responseText) {
                var img = responseText[item];
                result += "<div style='float:left;opacity: 0.8; background-image: url(" + img[2] + ");width: " + img[0] + "px;height: " + img[1] + "px;background-repeat: no-repeat'><div style='width: 100%;height: 100%;padding: " + img[3] + "px " + img[4] + "px'><div style='border:1px solid;width: 100%;height: 100%'></div></div></div>";
            }
            $("#result .modal-body").html(result);
            $("#result").removeClass("fade").css('display', "block");
        }
    }

    function showRequest(responseText, statusText, xhr, $form) {
        swal({
            title: '',
            html: "<center><img src='/assets/img/printing.gif' /><p>در حال اپلود فایل لطفا شکیبا باشید ...</p><br /><div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'>0%</div></div></center>",
            confirmButtonText: "باشه"
        });
        swal.disableButtons();
    }


});

function closeResultModal() {
    $("#result").css('display', 'none');
}


function finisheProccess() {
    $("#finalStep").attr('enctype', "");
    var options = {
        beforeSubmit: showRequest,
        success: showResponse,
        error: function () {
            swal.close();
        },
        url: "/customer/order",        // override for form's 'action' attribute
        type: 'post'      // 'get' or 'post', override for form's 'method' attribute
    };

    // bind form using 'ajaxForm'
    $("#finalStep").ajaxSubmit(options);

    function showResponse(responseText, statusText, xhr, $form) {
        swal.close();
        responseText = JSON.parse(responseText);
        console.log(responseText);
        if (responseText == 100) {
            $("#myModal1").css('display', 'block');
        } else {
            alertify.error("خطا در حین ثبت سفارش رخ داده است! دوباره تلاش کنید...")
        }
    }

    function showRequest(responseText, statusText, xhr, $form) {
        swal({
            title: '',
            html: "<center><img src='/assets/img/printing.gif' /><p> لطفا شکیبا باشید ...</p><br /><div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'>0%</div></div></center>",
            confirmButtonText: "باشه"
        });
        swal.disableButtons();
    }

}