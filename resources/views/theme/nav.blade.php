@foreach($navigation as $nav)
    <li>
        <a href="{{$nav['href']}}">
            <i class="{{$nav['icon']}}"></i>
            <span>{{$nav['menu']}}</span>
        </a>
        @if(isset($nav['sub-menu']))
            <ul class="sub-menu">
                @foreach($nav['sub-menu'] as $subMenu)
                    <li>
                        <a href="{{$subMenu['href']}}">
                            {{$subMenu['title']}}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach