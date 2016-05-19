<div class="tab-container">
    <ul class="nav nav-tabs">
        <?php
            $i=0;
        ?>
        <?php foreach($children as $child) : ?>
            <li class="<?php if($i === 0) echo'active'; ?>"><a data-toggle="tab" href="#<?php echo $child->getVariable('name')."-tab" ?>"><?php echo $child->getVariable('label') ?></a></li>
            <?php $i++; ?>
        <?php endforeach ?>
    </ul>
    <div class="tab-content">
        <?php $i=0;?>
        <?php foreach ($children as $child) :?>
            <div class="tab-pane fade <?php if($i === 0) echo'in active'; ?> cont" id="<?php echo $child->getVariable('name')."-tab" ?>">
                <?php $i++; ?>
                <div class="form-horizontal group-border-dashed">
                    <?php echo $child->render()  ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

