<div class="col-sm-6 col-md-12">
    <div class="block-flat">
        <div class="header">
            <h3><?php echo $variables['header']  ?></h3>
        </div>
        <div class="content">
            <form method="<?php echo 'POST'?>"  action="<?php echo  $variables['action'] ?>" class="form-horizontal group-border-dashed" role="form" enctype="multipart/form-data">
                {{ csrf_field() }}

            <?php foreach($children as $child) : ?>
                    <?php echo $child->render()  ?>
                <?php endforeach ?>
            </form>
        </div>
    </div>
</div>
