@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h2>ایجاد محصول جدید</h2>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('products.store') }}" method="post">
            @csrf
            <div class="form-group col-md-6 col-xs-12">
                <label for="category_id">دسته :</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="0">لطفا انتخاب کنید...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label for="name">زیر دسته</label>
                <select name="subcategory_id" id="subcategory_id" class="form-control">
                    <option value="0">لطفا انتخاب کنید...</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="">نام سایز</label>
                <input type="text" name="name" class="form-control"/>
            </div>
            <br>
            <hr>

            <div class="col-md-6">
                <label for="">قیمت یک رو</label>
                <input type="text" name="single_price" class="form-control"/>
            </div>

            <div class="col-md-6">
                <label for="">قیمت دو رو</label>
                <input type="text" name="double_price" class="form-control"/>
            </div>
            <br>
            <hr>

            <div class="col-md-6">
                <label for="">قیمت یک رو فوری</label>
                <input type="text" name="fast_single_price" class="form-control"/>
            </div>

            <div class="col-md-6">
                <label for="">قیمت دو رو فوری</label>
                <input type="text" name="fast_double_price" class="form-control"/>
            </div>

            <div class="col-md-6">
                <label for="x_size">پهنا</label>
                <input type="text" name="x_size" id="x_size" class="form-control"/>
            </div>

            <div class="col-md-6">
                <label for="y_size">ارتفاع</label>
                <input type="text" name="y_size" id="y_size" class="form-control"/>
            </div>

            <div class="col-md-6">
                <label for="normal_delivery">تحویل عادی</label>
                <input type="text" name="normal_delivery" id="normal_delivery" class="form-control"/>
            </div>

            <div class="col-md-6">
                <label for="fast_delivery">تحویل فوری</label>
                <input type="text" name="fast_delivery" id="fast_delivery" class="form-control"/>
            </div>

            <div class="col-md-6">
                <label for="allowFast">مجاز به لت بیشتر</label>
                <select name="allowLats" id="" class="form-control">
                    <option value="0">می باشد</option>
                    <option value="1">نمی باشد</option>
                </select>
            </div>


            <div class="clearfix"></div>
            <div class="col-xs-12">
                <button class="btn btn-primary" type="submit" style="margin-top: 5px"><i class="fa fa-save"></i> ذخیره
                </button>
            </div>
        </form>
    </section>
@endsection
@section('extraScripts')
    <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#category_id").change(function () {
            $.ajax({
                type: 'post',
                url: '{{ route('admin.fetchSubCategories') }}',
                data: {
                    'category_id': $(this).val()
                },
                success: function (response) {
                    response = JSON.parse(response);
                    $("#subcategory_id").html("");
                    var result = "<option value='0'>انتخاب کنید ...</option>";
                    for (item in response) {
                        result += "<option value='" + response[item]['id'] + "'>" + response[item]['name'] + "</option>";
                    }
                    $("#subcategory_id").html(result);
                }
            })
        });
    </script>
@endsection