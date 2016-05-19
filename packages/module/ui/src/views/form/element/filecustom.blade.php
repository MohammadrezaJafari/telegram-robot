{{--{{ Assets::library('jquery') }}--}}
{{--{{ Assets::add('core/bootstrap/css/bootstrap.min.css') }}--}}
{{--{{ Assets::add('core/bootstrap/js/bootstrap.min.js') }}--}}
{{ \Module\UI\Facade\Asset::js('ui/mainelements.js') }}
{{ \Module\UI\Facade\Asset::js('ui/file/file.js') }}
{{ \Module\UI\Facade\Asset::css('ui/file/file.css') }}

<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $variables['label'] ?></label>
    <div class="col-sm-10">
        @if(isset($variables['value']) && $variables['value'] && is_string($variables['value']))
            <?php
            $file = new Symfony\Component\HttpFoundation\File\File(implode(
                    DIRECTORY_SEPARATOR,[base_path(),
                            'public','uploads',$variables['value']]
            ));

            ?>
            @if(substr($file->getMimeType(), 0, 5) == 'image')
                <img class="image-element" src="{{config('ui.uploadPath')}}/{{$variables['value']}}" style="max-width: 300px; max-height: 200px;" data-id="{{'id'}}" />

                {{ \Module\UI\Facade\Asset::add('ui/file/jquery.colorbox.min.js') }}
                {{ \Module\UI\Facade\Asset::add('ui/file/image.js') }}
                <p class="image-pop-up"><a class="group1" href="/uploads/{{$variables['value']}}" title="Me and my grandfather on the Ohoopee.">{{dgettext('form','full size')}}</a></p>

            @else
                <a href="{{config('ui.uploadPath')}}/{{$variables['value']}}" download>{{$variables['value']}}</a>
            @endif
            @if(1)
                <br>
                <br>
                <i class='del-file-one-item  glyphicon  glyphicon-remove-circle' style="left: 10px;"></i>
            @endif

        @endif
        <input id="{{'id'}}" name="{{ $variables['name']  }}[data]"
               @if(isset($variables['value']) && $variables['value'] && is_string($variables['value']))
               value="{{ $variables['value'] }}"
               style="display: None;"
               type="hidden"
               @else
               type="file"
                @endif
        />
        <input name="{{$variables['name']}}[description]" value="{{$variables['description']}}" type="text" class="form-control" id="column" placeholder="Column">
        @if($variables['removeable'])
            <i class='del-arrayset  glyphicon glyphicon-remove-circle'></i>
        @endif
    </div>
</div>
