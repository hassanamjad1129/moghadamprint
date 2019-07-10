@extends('customer.layouts.master')
@section('content')
    <div class="body-wrapper">
        <div id="content" class="site-content">
            <article>
                <h2 style="text-align: center">دسته بندی دانلودها</h2>
                <br>
                @foreach($categories as $category)
                    <div class="col-md-3">
                        <a href="{{ route('customer.files',[$category->id]) }}"
                           style="    padding: 2rem;
    text-align: center;
    width: 100%;
    display: block;
    background: #d60000;
    color: #FFF;
    border-radius: 10px;
    margin-top: 2rem;font-size: 2rem
">{{ $category->name }}</a>
                    </div>
                @endforeach

            </article>
        </div>
    </div>
@endsection