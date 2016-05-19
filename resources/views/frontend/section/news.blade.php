<section class=" cntr">
    <div class="well container box__mod1">
        <h2>آخرین مقالات</h2>
        <div class="row" dir="rtl">
            <div class="grid_6 wow fadeInLeft">
                <?php $i = 1; ?>
                @foreach($news as $n)
                    @if($i == 1)
                        <?php $i = 0; continue; ?>
                    @else
                        <?php $i = 1; ?>
                        <article>
                            <img src="{{config('ui.uploadPath')."/".$n->image}}"  width = 570 height =261>
                            <h3>{{$n->title}}</h3>
                            {{$n->summary}}
                            <a href="{{URL::to('article/'.$n->id)}}" class="btn">ادامه</a>
                        </article>
                        <br>
                    @endif
                @endforeach
            </div>
            <div class="grid_6 wow fadeInRight ">
                <?php $i = 0; ?>
                @foreach($news as $n)
                    @if($i == 1)
                        <?php $i = 0; continue; ?>
                    @else
                        <?php $i = 1; ?>
                            <article>
                                <img src="{{config('ui.uploadPath')."/".$n->image}}"  width = 570 height =261>
                                <h3>{{$n->title}}</h3>
                                {{$n->summary}}
                                <a href="{{URL::to('article/'.$n->id)}}" class="btn">ادامه</a>
                            </article>
                            <br>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @if(isset($main))
    <a href="{{URL::to('articles')}}" class="btn btn_pad_big">مشاهده همه مقالات</a>
    @endif
</section>