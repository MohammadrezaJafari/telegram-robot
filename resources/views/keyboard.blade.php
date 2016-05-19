@extends('ui::master')

@section('content')
    <div class="col-sm-6 col-md-12">
        <div class="block-flat">
            <div class="header">
                Keyboard
            </div>
            <div class="content">
                <input type="hidden" name="commands" value="{{$commands}}">
                <input type="hidden" name="data" value="@if(isset($keyboard->name)) {{$keyboard->data}} @endif">

                <form method="<?php echo 'POST'?>"  action="{{route('content.keyboard.store')}}" class="form-horizontal group-border-dashed" role="form" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="hidden" name="command_id" value="{{$command_id}}">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Keyboard Name</label>
                        <div class="col-sm-10">
                            <input name="name" value="@if(isset($keyboard->name)){{$keyboard->name}}@endif" type="text" class="form-control"  placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Keyboard Size</label>
                        <div class="col-sm-3">
                            <input name="row" value="@if(isset($keyboard->row)){{$keyboard->row}}@endif" type="text" class="form-control" id="row" placeholder="Row">
                        </div>
                        <div class="col-sm-3">
                            <input name="column" value="@if(isset($keyboard->column)){{$keyboard->column}}@endif" type="text" class="form-control" id="column" placeholder="Column">
                        </div>
                        <button type="button" class="btn btn-success" onclick="createKeyboard()">
                            OK
                        </button>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary"><?php echo "submit" ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{Asset::js('welcome/js/telegram.js')}}
@stop