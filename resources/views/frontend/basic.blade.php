<section class="well2 " style="text-align: right">
    <div class="container">
        <div class="row">
            <div class="grid_10 preffix_1">
                <h2>{{$title}}</h2>
                @if($title == 'مقالات')
                    <h3>{{$content->title}}</h3>
                    <br>
                    <img src="{{config('ui.uploadPath')."/".$content->image}}">
                    <br><br>
                    <div>
                        {{$content->description}}
                    </div>
                @else
                    {{$description}}
                @endif

            </div>
        </div>
    </div>
</section>
