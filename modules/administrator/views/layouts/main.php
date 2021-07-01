<?php

use app\assets\AdminAsset;
use app\assets\AppAsset;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->


<html lang="en">

<head>
    <?php $this->head() ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Admin</title>
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <?php AdminAsset::register($this); ?>

</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<?php $this->beginBody() ?>

<?= $this->render('header.php')?>
<div class="container" >
<?= $content; ?>
</div>
<?= $this->render('footer.php')?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

