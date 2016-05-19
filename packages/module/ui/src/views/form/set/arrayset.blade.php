

{{\Module\UI\Facade\Asset::js('ui/arrayset/arrayset.js')}}
{{\Module\UI\Facade\Asset::css('ui/arrayset/arrayset.css')}}

@if($object->getDragable())
{{ Asset::js('ui/arrayset/jquery-ui/jquery-ui.min.js' ) }}
{{ Asset::css('ui/arrayset/jquery-ui/jquery-ui.min.css') }}
@endif
<?php
$items = $object->getChildren();
if(count($items)>0){
    array_shift($items);
}
$sample = $object->getNewItemObj();
?>
<div class="form-group">
@if($variables['label']!="")
    <label class="col-md-2 control-label">{{$variables['label']}}</label>
    <div  class="col-md-10">
@else
    <div  class="col-md-12">
@endif
        <section class="arrayset-container" data-length="{{count($items)}}" id="{{$variables['name']}}" data-max="{{$variables['max']}}" data-min="{{$variables['min']}}" >
            @if($object->getChangeable())
            <div class="arrayset-utility active @if($object->getDragable()) expanded @endif" >
                <i class="fa fa-minus "></i>
                <i class="fa fa-plus active"></i>
                @if($object->getDragable())
                <span class="arrayset-isdragable">
                    {{'Dragable'}}
                    <b class="fa  fa-check-square-o"></b>
                </span>
                @endif
            </div>
            @endif
            <div class='arrayset-sample' data-samplename="{{$variables['name']}}" data-currentname="{{  2 }}">
                <div class='arrayset-item ui-state-hover' >
                    {!! $sample->render() !!}
                    <i style="margin-left: 3px" class='del-arrayset  glyphicon glyphicon-remove-circle'></i>
                </div>
            </div>
            <div class="arrayset-list @if($object->getDragable()) dragable @endif">
            @foreach($items as $item)
                <div class='arrayset-item ui-state-hover'>
                    {!! $item->render()!!}
                    @if($object->getChangeable())
                    <i class='del-arrayset  glyphicon glyphicon-remove-circle'></i>
                    @endif
                </div>
            @endforeach
            </div>
            @if($object->getChangeable())
            <i class='add-arrayset  glyphicon glyphicon glyphicon-plus-sign'></i>
            @endif
            <script type="text/javascript">

            </script>
        </section>
    @if($variables['label']!="")
        </div>

    @endif
</div>

