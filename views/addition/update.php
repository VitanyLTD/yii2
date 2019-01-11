<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Additions */

$this->title = 'Update Additions: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Additions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'addition_type_id' => $model->addition_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="additions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
