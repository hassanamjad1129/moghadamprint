@extends('customer.layouts.master')
@section('content')
    <div class="body-wrapper">
        <div id="content" class="site-content">
            <article>
                <h2 style="text-align: center">دسته بندی گالری</h2>
                <br>
                @foreach($pictures as $picture)
                    <div class="col-md-3">
                        <img src="{{ asset($picture->picture) }}" style="width: 100%;border-radius: 8px" alt="">
                        <p>{{ $picture->title1 }}</p>
                        <p>{{ $picture->title2 }}</p>
                    </div>
                @endforeach
            </article>
        </div>
    </div>
@endsection