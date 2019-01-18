<?php

use nex\chosen\Chosen;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Meals', 'url' => ['meals/index']];
$this->params['breadcrumbs'][] = ['label' => 'Meal #' . $model->getMeal()->one()->id, 'url' => ['meals/view','id' => $model->getMeal()->one()->id]];
$this->params['breadcrumbs'][] = Html::encode(ucwords(strtolower($model->getUser()->one()->username))) . '\'s order';
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">

    <h1><?= Html::encode($model->getUser()->one()->username) ?>'s order of <?= Yii::$app->formatter->format($model->getMeal()->one()->start_date, 'relativeTime') ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <p>
        <?= (Yii::$app->user->identity->is_admin == 1) ? Html::a('Settings', ['update', 'id' => $model->id, 'user_id' => $model->user_id, 'meal_id' => $model->meal_id], ['class' => 'btn btn-primary']) : '' ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'user_id' => $model->user_id, 'meal_id' => $model->meal_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
    </p>


    <?php
        //Loop through all additionTypes
        foreach($modelAdditionTypes->find()->all() as $additionTypeModel){
            echo "<label class=\"custom-file-label\" for=\"addition-{$additionTypeModel->id}\">Choose {$additionTypeModel->description}" . ($additionTypeModel->multiselector == 1 ? 's ' : '') . "</label>";

            //Print description + values
            echo Chosen::widget([
                'name' => 'additions[' . $additionTypeModel->id . ']',
                'id' => 'addition-' . $additionTypeModel->id,
                'items' => ArrayHelper::map($additionTypeModel->getAdditions()->asArray()->all(), 'id','description'),
                'multiple' => ($additionTypeModel->multiselector == 1),
                'allowDeselect' => false,
                'disableSearch' => true, // Search input will be disabled
                'placeholder' => 'Select ' . ($additionTypeModel->multiselector == 1 ? 'multiple ' : '') . $additionTypeModel->description . ($additionTypeModel->multiselector == 1 ? 's ' : ''),
                'noResultsText' => 'No ' . $additionTypeModel->description . ' available',
                'value' => ArrayHelper::getColumn($model->getAdditions()->select('id')->where(['addition_type_id' => $additionTypeModel->id])->asArray()->all(), 'id')
            ]);
        }
        ?>
    <?php
        ActiveForm::end();
    ?>
</div>
