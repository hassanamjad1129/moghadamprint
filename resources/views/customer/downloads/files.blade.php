@extends('customer.layouts.master')
@section('content')
    <div id="downloads">
        @foreach($downloads as $download)
            <div class="downloadItem">
                <div class="downloadRowOne">
                    <div class="downloadRowOneRightSide">
                        <img src="{{ asset($download->icon) }}" alt="{{ $download->title }}">
                    </div>
                    <div class="downloadRowOneLeftSide">
                        <p class="downloadTitle">{{ $download->title }}</p>
                    </div>
                </div>
                <p class="downloadDescription">{{ $download->description }}</p>
                <p class="downloadDots">...</p>
                <div class="downloadRowTwo">
                    <div class="downloadCat">
                        <span>دسته بندی :</span>
                        <a href="#" class="downloadCatLink">{{ $download->category->name }}</a>
                    </div>
                    <div class="downloadBtnDiv">
                        <a href="{{ route("customer.downloads.file",[$download]) }}" target="_blank"
                           class="downloadBtn">
                            <i class="ion-android-download"></i>
                            <span>دانلود</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
