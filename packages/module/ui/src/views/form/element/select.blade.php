<div class="form-group">
    <label class="col-sm-2 control-label"><?php echo $variables['label'] ?></label>
    <div class="col-sm-10">
        <select  name="<?php echo $variables['name'] ?>" class="form-control">
            <?php foreach($variables['options'] as $option => $label) :?>
                <option <?php if(isset($variables['value']) && $variables['value'] == $option) echo 'selected' ?> value="<?php echo $option ?>"><?php echo $label ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>