@extends('customer.layouts.master')
@section('content')
    <div class="body-wrapper">
        <div id="content" class="site-content">
            <article>
                <h2 style="text-align: center">تصاویر گالری</h2>
                <br>
                @foreach($pictures as $picture)
                    <div class="col-md-3">
                        <div style="border: 1px solid #AAA">
                            <img src="{{ asset($picture->picture) }}" style="width: 100%;border-radius: 8px" alt="">
                            <p>{{ $picture->title1 }}</p>
                            <p>{{ $picture->title2 }}</p>
                        </div>
                    </div>
                @endforeach
            </article>
        </div>
    </div>
@endsection