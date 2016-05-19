<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        @include('frontend::layouts.headerfa')
    </head>
    <body>
        <div class="page">
            <!--========================================================HEADER=========================================================-->
            <header>
                @section('slider')
                    @if(isset($view['slider']))
                        {{$view['slider']}}
                    @endif
                @show
                <div id="stuck_container" class="stuck_container">
                    <div class="container">
                        <nav class="nav">
                            <ul class="sf-menu" data-type="navbar">
                                <li class="active">
                                    <a href="{{URL::to('/')}}">صفحه اصلی‌</a>
                                </li>
                                <li>
                                    <a href="#">
                                        ضایعات
                                    </a>
                                    <ul>
                                        @foreach($categories as $cat)
                                            <li>
                                                <a href="{{URL::to("table/$cat->id")}}">
                                                    {{$cat->title}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{URL::to('articles')}}">اخبار</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('about-us')}}">
                                        درباره ما
                                    </a>
                                </li>
                                <li>
                                    <a href="{{URL::to('contact-us')}}">ارتباط با ما</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('order')}}">
                                        ثبت سفارش
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </header>
            <!--========================================================CONTENT==========================================================-->
            @section('content')
                <main>
                    {{$view['content']}}
                </main>
            @show
            <!--========================================================FOOTER===========================================================-->
            <hr>
            @section('footer')
                <footer>
                    @include('frontend::footer.footer')
                </footer>
            @show
        </div>
        <script src="{{config('ui.publicPath') ."frontend/js/"}}script.js"></script>
        <script src="{{config('ui.publicPath') ."frontend/js/"}}gmap3.min.js"></script>

    </body>

</html>
