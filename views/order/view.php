<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'user_id' => $model->user_id, 'meal_id' => $model->meal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'user_id' => $model->user_id, 'meal_id' => $model->meal_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user.username',
            'meal.start_date',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getAdditionsAsString();
                },
            ],
        ],
    ]) ?>


    <?php
        $form = ActiveForm::begin();

        //Loop through all additionTypes
        foreach($modelAdditionTypes->find()->all() as $additionTypeModel){

            //Print description + values
            echo $form->field($model, 'additions[id]')
                ->dropDownList(ArrayHelper::map($additionTypeModel->getAdditions()->asArray()->all(), 'id','description'),
                    [
                        'multiple'=>($additionTypeModel->multiselector == 1),
                        'prompt'=>'- Select '.$additionTypeModel->description.' -',
                        'class'=>'chosen-select input-md required',
                    ]
                )->label($additionTypeModel->description);
        }
        ActiveForm::end();
    ?>

</div>
