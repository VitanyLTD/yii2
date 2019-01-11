<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Additions */

$this->title = 'Create Additions';
$this->params['breadcrumbs'][] = ['label' => 'Additions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
