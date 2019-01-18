<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = 'Settings of order ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Meals', 'url' => ['meals/index']];
$this->params['breadcrumbs'][] = ['label' => 'Meal #' . $model->getMeal()->one()->id, 'url' => ['meals/view','id' => $model->getMeal()->one()->id]];
$this->params['breadcrumbs'][] = 'Settings of ' . Html::encode(ucwords(strtolower($model->getUser()->one()->username))) . '\'s order';
?>
<div class="orders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelUsers' => $modelUsers,
        'modelMeals' => $modelMeals
    ]) ?>

</div>
