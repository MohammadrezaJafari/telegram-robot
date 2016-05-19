<div class=" form-horizontal group-border-dashed">
    <?php if(1) : ?>
        <div class="header">
            <h3><?php echo 'Header' ?></h3>
        </div>
    <?php endif; ?>
    <div class="content">
        <?php foreach($children as $child) : ?>
                <?php echo $child->render()  ?>
        <?php endforeach ?>
    </div>
</div>
