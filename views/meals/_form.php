<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Meals */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meals-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= DatePicker::widget([
        'model' => $model,
        'attribute' => 'start_date',
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]); ?>

    <?= DatePicker::widget([
        'model' => $model,
        'attribute' => 'end_date',
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList(['0' => 'Closed', '1' => 'Open'],['prompt'=>'Select Option']); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
