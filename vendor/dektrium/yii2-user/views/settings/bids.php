<?php
?>

    <h1>Hello from jobs of user</h1>
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
<?php
foreach ($bid['bid'] as $b) { ?>
    <ol>
        <li><?=$b->title?></li>
        <li><?=$b->description?></li>
        <li><?=$b->paid?></li>
    </ol>
<?php }
?>