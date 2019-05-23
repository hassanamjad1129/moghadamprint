function userPanelMenuSubItemHandler(elem) {
    if (elem.nextElementSibling.className === "subMenuWrap") {
        if (elem.nextElementSibling.style.display === "block") {
            elem.nextElementSibling.style.display = "none"
        } else if (elem.nextElementSibling.style.display === "none") {
            elem.nextElementSibling.style.display = "block"
        }
    }
}

function userPanelNotifSubItemHandler(elem) {
    if (elem.nextElementSibling.className === "notification-content") {
        if (elem.nextElementSibling.style.display === "block") {
            elem.nextElementSibling.style.display = "none"
        } else if (elem.nextElementSibling.style.display === "none") {
            elem.nextElementSibling.style.display = "block"
        }
    }
}

function userPanelNameSubItemHandler(elem) {
    if (elem.nextElementSibling.className === "userProfileContent") {
        if (elem.nextElementSibling.style.display === "block") {
            elem.nextElementSibling.style.display = "none"
        } else if (elem.nextElementSibling.style.display === "none") {
            elem.nextElementSibling.style.display = "block"
        }
    }
}

function drawerButtonHandler() {
    var menuElement = document.getElementById("smallMenu");
    if (menuElement.style.display === "none") {
        menuElement.style.display = "flex"
    } else if (menuElement.style.display === "flex") {
        menuElement.style.display = "none"
    }
}

function userPanelAccessSubItemHandler(elem) {
    if (elem.nextElementSibling.className === "quikAccessContent") {
        if (elem.nextElementSibling.style.display === "block") {
            elem.nextElementSibling.style.display = "none"
        } else if (elem.nextElementSibling.style.display === "none") {
            elem.nextElementSibling.style.display = "block"
        }
    }
}

var subCat = 0;
var product = 0;
var prdName = "";

function categorySelectHandler(elem) {
    var elements = document.getElementsByClassName("wizardImageItem");
    var counter;
    var innerCounter;
    var cat_id;
    for (counter = 0; counter < elements.length; counter++) {
        var item = elements[counter];
        for (innerCounter = 0; innerCounter < item.classList.length; innerCounter++) {
            if (item.classList[innerCounter] === "wizardCatSelected") {
                item.classList.remove("wizardCatSelected")
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
            var result = "<table class='table table-hover table-striped table-responsive table-bordered table-datatable' style='width: 50%'>" + "<thead>" + "<tr>" + "<th style='width: 100px'>انتخاب</th>" + "<th>نوع کار</th>" + "</tr>" + "</thead><tbody>";
            for (var item in response) {
                var subcategory = response[item];
                result += '<td>' + '<div class="form-check">' + '<label class="toggle">' + '<input type="radio" name="subCategory" value="' + subcategory.id + '"> <span class="label-text"></span>' + '</label>' + '</div>' + '</td>' + '<td>' + subcategory.name + '</td>' + '</tr>'
            }
            result += "</tbody></table>";
            $("#step-2>.step2Content").html(result)
        }
    });
    elem.classList.add("wizardCatSelected");
    $(".table-datatable").dataTable();
    $("html, body").animate({
        scrollTop: $(document).height()
    }, 1000)
}

$("body").on('change', "input[name=product]", function () {
    product = $(this).val();
    prdName = $(this).attr('prd_name');
    swal({
        title: '',
        html: "<center><img src='/assets/img/printing.gif' /><p> لطفا صبر کنید</p><br /></center>",
        confirmButtonText: "تایید",
        allowOutsideClick: !1
    });

    $.ajax({
        type: 'post',
        data: {
            product: $(this).val(),
        },
        url: "/customer/fetchProductInformation",
        success: function (response) {
            swal.close();
            response = JSON.parse(response);
            var result = "<div class='col-md-6'><h3>نوع کار</h3>";
            if (response.single_price || response.fast_single_price) result += ("<input type='radio' name='type' id='single' value='single' class='input-hidden' /><label for='single'><img src='/assets/img/single.jpg' /></label>");
            if (response.double_price || response.fast_double_price) result += "<input type='radio' name='type' id='double' value='double' class='input-hidden' /><label for='double' style='margin-right: 30px;'><img src='/assets/img/double.jpg' /></label>";
            result += "</div>";
            result += ("<div class='col-md-6 speed'><h3>سرعت چاپ</h3>" + ((response.single_price || response.double_price) ? ("<input type='radio' name='speed' id='normal' class='input-hidden' value='normal' /><label for='normal'><img src='/assets/img/normal.jpg' /></label>") : ""));
            if (response.fast_single_price || response.fast_double_price) result += "<input type='radio' name='speed' id='fast' class='input-hidden' value='fast' /><label for='fast' style='margin-right: 30px;'><img src='/assets/img/fast.jpg' /></label>";
            result += "</div>";
            $("#step-3 .extraOptions").html(result)
        }
    })
});
$("body").on('change', 'input[name=type]', function () {
    var type = $(this).val();
    $(".files").html("<h3>در حال بارگزاری..</h3>");
    $.ajax({
        type: 'post',
        url: "/customer/getFiles",
        data: {
            subCategory: subCat
        },
        success: function (response) {
            response = JSON.parse(response);
            var result = "<h3 style='text-align:center'>سایز کار : " + prdName + "</h3>";
            for (item in response) {
                file = response[item];
                result += "<input type='hidden' name='product' value='" + product + "'><div class=\"upload-btn-wrapper col-md-3\">\n" + "                    <button type='button' class=\"btn\" style='width: 100%;font-family: Yekan;cursor: pointer'>" + "<img id='file-" + file.id + "-front' src='' />" + "<i class='fa fa-upload'></i> " + file.front_file_label + "</button>\n" + "                    <input type=\"file\" name=\"file-" + file.id + "-front\" onchange=\"readURL(this);\" />\n" + "                </div>" + ((type === 'double') ? ("<div class=\"upload-btn-wrapper col-md-3\"><button class=\"btn\" style='width: 100%;font-family: Yekan'><img id='file-" + file.id + "-back' src='' />" + "<i class='fa fa-upload'></i> " + file.back_file_label + "</button><input type=\"file\" name=\"file-" + file.id + "-back\" onchange=\"readURL(this);\" /></div>") : "")
            }
            result += ("<div class='clearfix'></div>" + "<div style='    margin: 0 auto;\n" + "    display: flex;\n" + "    flex-direction: row;\n" + "    justify-content: center;\n" + "    align-items: center;\n" + "    padding: 3rem;'><label style='    margin-left: 2rem;\n" + "font-size: 20px;'>سری : </label><input style='width: 50px;\n" + "    text-align: center;\n" + "    border: 2px solid #ff4444;\n" + "    padding: 6px;\n" + "    font-size: 18px;' type='number' min='1' value='1' name='qty'></div>");
            $(".files").html(result)
        }
    })
});
$("body").on('change', "input[name=subCategory]", function () {
    subCat = $(this).val();
    $("#step-3").html("<h3 style='text-align:center'>در حال بارگزاری ...</h3>");
    $.ajax({
        type: 'post',
        data: {
            subCategory: subCat,
        },
        url: "/customer/fetchProducts",
        success: function (response) {
            var response = JSON.parse(response);
            var result = "<table class='table table-striped table-hover table-bordered table-responsive'>" + "<thead>" + "<tr>" + "<th>انتخاب</th>" + "<th>عنوان سایز</th>" + "<th>پهنا</th>" + "<th>ارتفاع</th>" + "<th>قیمت یک رو</th>" + "<th>قیمت دو رو</th>" + "<th>قیمت یک رو فوری</th>" + "<th>قیمت دو رو فوری</th>" + "<th>زمان تحویل عادی</th>" + "<th>زمان تحویل فوری</th>" + "</tr>" + "</thead><tbody>";
            for (var item in response) {
                var product = response[item];
                result += '<tr>' + '<td>' + '<div class="form-check">' + '<label class="toggle">' + '<input type="radio" name="product" prd_name="' + product.name + '" value="' + product.id + '"> <span class="label-text"></span>' + '</label>' + '</div></td>' + '<td>' + product.name + '</td>' + '<td>' + product.x_size + ' میلیمتر ' + '</td>' + '<td>' + product.y_size + ' میلیمتر ' + '</td>' + '<td>' + numberFormat(product.single_price) + ' ریال</td>' + '<td>' + numberFormat(product.double_price) + ' ریال</td>' + '<td>' + numberFormat(product.fast_single_price) + ' ریال</td>' + '<td>' + numberFormat(product.fast_double_price) + ' ریال</td>' + '<td>' + product.normal_delivery + ' روزکاری</td>' + '<td>' + product.fast_delivery + ' روزکاری</td>' + '</tr>'
            }
            result += "</tbody></table>" + "<div class='extraOptions'></div>";
            $("#step-3").html(result)
        }
    })
});
$('.js-tilt').tilt({
    scale: 1.1,
    glare: !0,
    maxGlare: 0.3
});
var toggleHeight = $(window).outerHeight() * .2;
$(window).scroll(function () {
    if ($(window).scrollTop() > toggleHeight) {
        $(".m-backtotop").addClass("active");
        $('pageTop').text('TA-DA! Now hover it and hit dat!')
    } else {
        $(".m-backtotop").removeClass("active");
        $('pageTop').text('(start scrolling)')
    }
});

function jumpToTop() {
    $('html, body').animate({
        scrollTop: 0
    }, 'slow', function () {
        return 1
    })
}

function handleMainContentSubCats(element) {
    var detailsElementHeight = element.lastElementChild.offsetHeight;
    var detailsElement = element.lastElementChild;
    detailsElement.setAttribute("height", detailsElementHeight);
    var oldFatherHeight = document.getElementById("mainContent").offsetHeight;
    oldFatherHeight = (oldFatherHeight + detailsElementHeight).toString() + "px";
    document.getElementById("mainContent").style.height = oldFatherHeight
}

function handleMainContentSubCats2(element) {
    var detailsElement = element.lastElementChild;
    var detailsElementHeight = detailsElement.getAttribute("height");
    var oldFatherHeight = document.getElementById("mainContent").offsetHeight;
    oldFatherHeight = (oldFatherHeight - detailsElementHeight).toString() + "px";
    document.getElementById("mainContent").style.height = oldFatherHeight
}

function introModalClosezBtn() {
    introModalElem = document.getElementById("introModalSection");
    if (introModalElem.style.display === "none") {
        introModalElem.style.display = "flex"
    } else if (introModalElem.style.display === "flex") {
        introModalElem.style.display = "none"
    }
}

function openOfferModal() {
    introModalElem = document.getElementById("introModalSection");
    if (introModalElem.style.display === "none") {
        introModalElem.style.display = "flex"
    }
}

function closeWelcomeModal() {
    document.getElementById("welcomeModal").setAttribute("class", "hide")
}

$("body").on('change', "input[type='file']", function () {
    var fileValue = $(this).val();
    if (!fileValue)
        return;
    $(this).parent().parent().children('p:first').html(fileValue.split("\\")[2]);
    var options = {
        beforeSubmit: showRequest,
        success: showResponse,
        uploadProgress: function (event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            $(".progress-bar-striped").attr('aria-valuenow', percentComplete);
            $(".progress-bar-striped").text(percentVal);
            $(".progress-bar-striped").css('width', percentVal)
        },
        error: function () {
            swal.close()
        },
        url: "/customer/checkFile",
        type: 'post'
    };
    $("#finalStep").ajaxSubmit(options);

    function showResponse(responseText, statusText, xhr, $form) {
        swal.close();
        responseText = JSON.parse(responseText);
        if (responseText == 1) {
            alertify.error("خطا! فرمت های مجاز jpg و jpeg می باشند.");
        } else if (responseText == 2) {
            alertify.error('خطا! سایز فایل ارسالی شما بیش از یک میلیمتر از سایز استاندارد اختلاف دارد.');
        } else if (responseText == 3) {
            alertify.error('خطا! فایل ارسالی میبایست CMYK باشد.');
        } else {
            var result = "";
            for (item in responseText) {
                var img = responseText[item];
                if (img[5] !== "") result += "<div style='margin:0 30px;width: " + img[0] + "px;float:right'><h4 class='text-center' style='color:#ff4444'>" + img[6] + "</h4><div style='float:left;opacity: 0.8; background-image: url(" + img[5] + ");width: " + img[0] + "px;height: " + img[1] + "px;background-repeat: no-repeat'><div style='width: 100%;height: 100%;background-repeat:no-repeat;opacity:0.55;background:url(" + img[2] + ");background-repeat: no-repeat;'><div style='width: 100%;height: 100%;padding: " + img[3] + "px " + img[4] + "px'><div style='border:1px solid;width: 100%;height: 100%'></div></div></div></div></div>";
                else result += "<div style='margin:0 30px;width: " + img[0] + "px;float:right'><h4 class='text-center' style='color:#ff4444'>" + img[6] + "</h4><div style='float:left;opacity: 0.8; background-image: url(" + img[2] + ");width: " + img[0] + "px;height: " + img[1] + "px;background-repeat: no-repeat'><div style='width: 100%;height: 100%;padding: " + img[3] + "px " + img[4] + "px'><div style='border:1px solid;width: 100%;height: 100%'></div></div></div></div>"
            }
            $("#result .modal-body").html(result);
            $("#result").removeClass("fade").css('display', "block")
        }
    }

    function showRequest(responseText, statusText, xhr, $form) {
        swal({
            title: '',
            html: "<center><img src='/assets/img/printing.gif' /><p>در حال اپلود فایل لطفا شکیبا باشید ...</p><br /><div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'>0%</div></div></center>",
            confirmButtonText: "باشه",
            allowOutsideClick: !1
        });
        swal.disableButtons()
    }
});

function closeResultModal() {
    $("#result").css('display', 'none')
}

function finisheProccess() {
    $('input[type="file"]').prop('disabled', true);

    var options = {
        beforeSubmit: showRequest,
        success: showResponse,
        error: function () {
            swal.close()
        },
        url: "/customer/order",
        type: 'post'
    };
    $("#finalStep").ajaxSubmit(options);

    function showResponse(responseText, statusText, xhr, $form) {
        swal.close();
        responseText = JSON.parse(responseText);
        console.log(responseText);
        if (responseText == 100) {
            $("#lastModal").modal({
                backdrop: 'static',
                keyboard: !1
            })
        } else if (responseText == 1) {
            $('input[type="file"]').prop('disabled', true);
            alertify.error("خطا! تمامی فایل های مربوطه را آپلود کنید")
        } else {
            $('input[type="file"]').prop('disabled', true);
            alertify.error("خطا در حین ثبت سفارش رخ داده است! دوباره تلاش کنید...")
        }
    }

    function showRequest(responseText, statusText, xhr, $form) {
        $('input[type="file"]').prop('disabled', true);
        swal({
            title: '',
            html: "<center><img src='/assets/img/printing.gif' /><p> در حال اتصال به سرور ...</p><br /><div class='progress'><div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width:0%'>0%</div></div></center>",
            confirmButtonText: "تایید",
            allowOutsideClick: !1
        });
        swal.disableButtons()
    }
}

$(document).ready(function (e) {
    $('.img-check').click(function (e) {
        $('.img-check').not(this).removeClass('check').siblings('input').prop('checked', !1);
        $(this).addClass('check').siblings('input').prop('checked', !0)
    })
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + input.getAttribute('name')).attr('src', e.target.result).css({
                'width': '100%',
                'display': 'block'
            })
        };
        reader.readAsDataURL(input.files[0])
    }
}

$(".table-datatable").dataTable();

function numberFormat(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }
    return s.join(dec)
}