{{\Module\UI\Facade\Asset::css('layout/js/jquery.icheck/skins/flat/green.css')}}
{{\Module\UI\Facade\Asset::js('layout/js/jquery.icheck/icheck.min.js')}}
{{\Module\UI\Facade\Asset::js('ui/checkbox/js/boot.js')}}

<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $variables['label'] ?></label>
    <div class="col-sm-10">
        <label class="checkbox-inline">
            <input class="icheck" type="checkbox" <?=($variables['checked'])?"checked=''":""?> name="<?php echo $variables['name'] ?>">
        </label>
    </div>
</div>