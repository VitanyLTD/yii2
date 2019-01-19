<?php

use nex\chosen\Chosen;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<!--         $form->field($model, 'user_id')->textInput() ?>-->
<!--         $form->field($model, 'meal_id')->textInput() ?>-->

    <label for="user_id">User</label>
    <?= Chosen::widget([
                'name' => 'Orders[user_id]',
                'id' => 'user_id',
                'items' => ArrayHelper::map($modelUsers->find()->asArray()->all(), 'id','username'),
                'multiple' => false,
                'allowDeselect' => false,
                'disableSearch' => true, // Search input will be disabled
                'placeholder' => 'Select user',
                'noResultsText' => 'No users available',
                'value' => $model->user_id
            ]);?>

    <label for="meal_id">Meal</label>
    <?= Chosen::widget([
        'name' => 'Orders[meal_id]',
        'id' => 'meal_id',
        'items' => ArrayHelper::map($modelMeals->find()->where(['status' => 1])->asArray()->all(), 'id','start_date'),
        'multiple' => false,
        'allowDeselect' => false,
        'disableSearch' => true, // Search input will be disabled
        'placeholder' => 'Select meal',
        'noResultsText' => 'No meals available',
        'value' => $model->meal_id
    ]);?>


    <?php ActiveForm::end(); ?>

</div>
