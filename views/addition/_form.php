<?php

use app\models\AdditionTypes;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Additions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="additions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'addition_type_id')->dropDownList(
            ArrayHelper::map(AdditionTypes::find()->all(),'id', 'description'),
            [
                'prompt'=>'Type of addition',
            ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
