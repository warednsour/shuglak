<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bids */

$this->title = Yii::t('main', 'Create Bids');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Bids'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bids-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
