<li>
    <a href="#">
        <i class="fa fa-table"></i>
        <span>@lang('ui::nav.Content Management')</span>
    </a>
    <ul class="sub-menu">
        <li  ><a href="{{URL::to('domain/content/create')}}">@lang('ui::nav.Add New Content')</a></li>
        <li  ><a href="{{URL::to('domain/content')}}">@lang('ui::nav.Content List')</a></li>
    </ul>
<li><a href="#"><i class="fa fa-table"></i><span>@lang('ui::nav.Page Management')</span></a>
    <ul class="sub-menu">
        <li  ><a href="{{URL::to('domain/page/create')}}">@lang('ui::nav.Add New Page')</a></li>
        <li  ><a href="{{URL::to('domain/page')}}">@lang('ui::nav.Page List')</a></li>
    </ul>
</li>
<li><a href="#"><i class="fa fa-table"></i><span>@lang('ui::nav.Gallery Management')</span></a>
    <ul class="sub-menu">
        <li  ><a href="{{URL::to('domain/gallery/create')}}">@lang('ui::nav.Add New Image Gallery')</a></li>
        <li  ><a href="{{URL::to('domain/gallery')}}">@lang('ui::nav.Gallery Image List')</a></li>
    </ul>
</li>
<li><a href="#"><i class="fa fa-table"></i><span>@lang('ui::nav.Slider Management')</span></a>
    <ul class="sub-menu">
        <li  ><a href="{{URL::to('domain/slide/create')}}">@lang('ui::nav.Add New Slide')</a></li>
        <li  ><a href="{{URL::to('domain/slide')}}">@lang('ui::nav.Slide List')</a></li>
    </ul>
</li>


<li><a href="#">
        <i class="fa fa-table"></i><span>@lang('ui::nav.Order Management')</span></a>
    <ul class="sub-menu">
        <li  ><a href="{{URL::to('domain/order')}}">@lang('ui::nav.Order List')</a></li>
    </ul>
</li>
