@extends('ui::master')

@section('content')
    {{--@include('ui::message.message')--}}
    <button class="btn btn-success" onclick="addText()">
        Add new Text
    </button>
    <button class="btn btn-success" onclick="addMedia('image')">
        Add new Image
    </button>
    <button class="btn btn-success" onclick="addMedia('video')">
        Add new Video
    </button>
    <button class="btn btn-success" onclick="addMedia('audio')">
        Add new Audio
    </button>
    <button class="btn btn-success" onclick="addMedia('file')">
        Add new File
    </button>
    <br>    <br>    <br>    <br>

                {!! $form !!}

    {{Asset::js('welcome/js/telegram.js')}}
@stop