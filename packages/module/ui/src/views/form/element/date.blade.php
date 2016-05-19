{{\Module\UI\Facade\Asset::css('layout/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css')}}
{{\Module\UI\Facade\Asset::js('layout/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js')}}
{{\Module\UI\Facade\Asset::js('ui/date/js/boot.js')}}

<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $variables['label'] ?></label>
    <div class="col-sm-10">
        <input name="<?php echo $variables['name'] ?>" class="form-control datetime" size="16" type="text" value="" />
    </div>
</div>

