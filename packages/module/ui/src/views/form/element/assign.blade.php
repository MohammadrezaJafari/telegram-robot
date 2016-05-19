
{{\Module\UI\Facade\Asset::js('ui/dual-list/js/dual-list-box.js')}}
{{\Module\UI\Facade\Asset::js('ui/dual-list/js/boot.js')}}

<!--<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">-->
    <div id="dual-list-box" class="form-group row">
        <select multiple="multiple" data-title="<?=$variables['title']?>" class="serviceSelecting"
                data-value="index" data-text="name" name="selectedUsers[]">
            <?php foreach($variables['unselected'] as $user):?>
                <option value="<?=1?>"><?=2?></option>
            <?php endforeach;?>

            <?php foreach($variables['selected'] as $user):?>
                <option selected="selected" value="<?=1?>"><?=2?></option>
            <?php endforeach;?>
        </select>
    </div>

