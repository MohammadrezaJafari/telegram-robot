@extends('ui::master')

@section('content')
    {{--@include('ui::message.message')--}}
    <a href="{{$url}}" class="btn btn-success">@lang('domain.content::form.Add') </a>
    <br>    <br>    <br>    <br>
    {{--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">--}}
    {{--<script src="//code.jquery.com/jquery-1.10.2.js"></script>--}}
    {{--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>--}}
    {{Asset::js('datatable/js/jquery.dataTables.min.js')}}
    {{Asset::css('datatable/css/jquery.dataTables.min.css')}}
    {!! $table !!}
@stop