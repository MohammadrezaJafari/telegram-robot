<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $variables['label'] ?></label>
    <div class="col-sm-10">
        <input name="<?php echo $variables['name'] ?>" value="<?php echo (isset($variables['value']))?$variables['value']:"" ?>" type="<?php echo $variables['type'] ?>" class="form-control" id="inputEmail3" placeholder="<?php echo $variables['placeholder'] ?>">
    </div>
</div>

