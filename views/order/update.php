<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Settings of order ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Meals', 'url' => ['meals/index']];
$this->params['breadcrumbs'][] = ['label' => 'Orders'];
$this->params['breadcrumbs'][] = Html::encode($model->getUser()->one()->username);
$this->params['breadcrumbs'][] = 'Settings';
?>
<div class="orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
