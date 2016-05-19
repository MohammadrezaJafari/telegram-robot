<div class="camera_container">
    <div id="camera" class="camera_wrap">

        @foreach($slides as $slide)
            <div data-src="{{config('ui.uploadPath').$slide->image}}">
                <div class="camera_caption fadeIn" style="background-color:rgba(0, 0, 0, 0.5);">

                    <h2>
                        صدرا حفاظ
                    </h2>
                    <h3>تجربه ی امن در نصب</h3>

                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="container">
    <div class="brand camera">
        <h1 class="brand_name">
            <a href="index.html">
                {{--<img src="frontend/images/logo.jpg" alt="">--}}
            </a>
        </h1>
    </div>
</div>
