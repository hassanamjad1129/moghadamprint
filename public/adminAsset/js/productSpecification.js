var firstSelected = 0;
var images = 1;
var input = 1;
$(".lfm").filemanager('image');
$('body').on('click', '.lfm', function () {
    $('.lfm').filemanager('image');
});

function addLabel() {
    $("#productSpecification").modal();
}

function setValuesType(elem) {
    var selectedItem = elem.value;
    if (selectedItem == 0)
        return false;
    else if (selectedItem === 'select' || selectedItem === 'radio') {
        if (firstSelected === 0) {
            $(".addNewValue").removeClass('fade');
            $(".values").append(makeDefaultValues());
            firstSelected = selectedItem;
        } else {
            if (firstSelected === 'select' || selectedItem === 'radio') {
                return true;
            }
            firstSelected = selectedItem;
            $(".values").html("");
            $(".values").append(makeDefaultValues());
        }
    } else if (selectedItem === 'picture_radio') {
        if (firstSelected === 0) {
            $(".addNewValue").removeClass('fade');
            $(".values").append(makePictureRadio());
            firstSelected = selectedItem;
        } else {
            if (firstSelected === 'picture_radio') {
                return true;
            }
            firstSelected = selectedItem;
            $(".values").html("");
            $(".values").append(makePictureRadio());
        }
    }
}

function addValue() {
    if (firstSelected === 0)
        return false;
    if (firstSelected === 'select' || firstSelected === 'radio')
        $(".values").append(makeDefaultValues());
    if (firstSelected === 'picture_radio') {
        images++;
        $(".values").append(makePictureRadio());
    }
    return false;
}

function makeDefaultValues() {
    var result = "<label>عنوان گزینه</label>";
    result += "<input class='form-control' />";
    return result;
}

function makePictureRadio() {
    var result = "<label>عنوان گزینه</label>";
    result += "<input class='form-control title' name='" + images + "' type='text' placeholder='عنوان...' />";
    result += "<div class=\"input-group\">\n" +
        "                           <span class=\"input-group-btn\">\n" +
        "                             <a class=\"lfm valueUploadBtn\" data-input=\"thumbnail" + images + "\" class=\"btn btn-primary\">\n" +
        "                               <i class=\"fa fa-picture-o\"></i> انتخاب تصویر\n" +
        "                             </a>\n" +
        "                           </span>\n" +
        "                            <input id=\"thumbnail" + images + "\" placeholder='تصویر ...' class=\"form-control\" type=\"text\">\n" +
        "                        </div>";
    return result;
}

function storeValues() {
    var label = $("#productSpecification .modal-body input[name='name']").val();
    var input_type = $("#productSpecification .modal-body select[name='input_type']").val();

    var labelHidden = "<input type='hidden' name='label-" + input + "' value='" + label + "'>";
    var inputTypeHidden = "<input type='hidden' name='type-" + input + "' value='" + input_type + "'>";

    $("#hiddenInputs").append(labelHidden + inputTypeHidden + retrieveValues(input_type));

    $("#productSpecification .modal-body").html("<label for=\"\">عنوان مشخصه</label>\n" +
        "                    <input type=\"text\" name=\"name\" id=\"\" class=\"form-control\" />\n" +
        "                    <label for=\"\">حالت انتخاب مشخصه</label>\n" +
        "                    <select name=\"input_type\" id=\"\" class=\"form-control\" onchange=\"setValuesType(this)\">\n" +
        "                        <option value=\"0\">انتخاب کنید ...</option>\n" +
        "                        <option value=\"select\">منو کشویی</option>\n" +
        "                        <option value=\"radio\">رادیویی</option>\n" +
        "                        <option value=\"picture_radio\">عکس</option>\n" +
        "                    </select>\n" +
        "                    <div class=\"values\">\n" +
        "\n" +
        "                    </div>\n" +
        "                    <button class=\"btn btn-warning btn-xs fade addNewValue\" style=\"margin-top: 5px\" onclick=\"addValue()\" type=\"button\">افزودن مقدار جدید</button>\n" +
        "                ");
    $("#productSpecification").modal("hide");
    firstSelected = 0;
    input++;
}

function retrieveValues(inputType) {
    var result = "";
    if (inputType === 'select' || inputType === 'radio')
        $(".values input").each(function () {
            var value = $(this).val();
            console.log(value);
            if (value) {
                result += "<input type='hidden' name='value" + input + "[]' value='" + value + "'>";
            }
        });
    else {
        $(".values input.title").each(function () {
            var value = $(this).val();
            var name = $(this).attr('name');
            var imageSrc = $("#thumbnail" + name).val();
            if (value) {
                result += "<input type='hidden' name='value" + input + "[]' value='" + value + "$" + imageSrc + "'>";
            }
        });
    }
    return result;
}

function showResults() {
    var label = $("#productSpecification .modal-body input[name='name']").val();
    var input_type = $("#productSpecification .modal-body select[name='input_type']").val();
    var result="<div class='col-md-12'><label>"+label+"</label>";
    if(input_type==='select'){
        var type=""
    }
    result+="<p></p>";
    $(".specification").html()
}