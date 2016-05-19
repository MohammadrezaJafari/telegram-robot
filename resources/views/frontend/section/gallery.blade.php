<style>
    .thumb_main {
        display: block;
        position: relative;
        overflow: hidden;
        width: 33.33%;
        float: right;
        color: #fff;
        text-align: center;
    }
</style>
<section class="gallery cntr">
    <div class="well4">
        <h2>پروژه ها</h2>
    </div>
    @foreach($images as $image)
        <div class="thumb_main">
            <a href="{{config("ui.uploadPath").$image->image}}" data-fancybox-group="2" class="thumb">
                    <img src="{{config("ui.uploadPath").$image->image}}" alt="">
                <span class="thumb_overlay"> </span>
            </a>
            <div class="thumb_overlay_cnt">
                <em> {{$image->title}} </em>

            </div>
        </div>
    @endforeach
    @if(isset($main))
        <a href="{{URL::to('projects')}}" class="btn btn_pad_big">مشاهده همه پروژه ها</a>
    @endif
</section>

