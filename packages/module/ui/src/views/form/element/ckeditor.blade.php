{{\Module\UI\Facade\Asset::js('layout/js/ckeditor/ckeditor.js')}}
{{\Module\UI\Facade\Asset::js('layout/js/ckeditor/adapters/jquery.js')}}
{{\Module\UI\Facade\Asset::js('ui/ckeditor/js/boot.js')}}

<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $variables['label'] ?></label>
    <div class="col-sm-10">
        <textarea rows="<?php if(isset($variables['rows'])) {echo $variables['rows'];} else{ echo 5;} ?>" name="<?php echo $variables['name'] ?>" placeholder="<?php echo $variables['placeholder'] ?>" class="form-control ckeditor"><?php if(isset($variables['value'])) echo $variables['value']?></textarea>
    </div>
</div>

