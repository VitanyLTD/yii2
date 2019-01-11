<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property int $meal_id
 *
 * @property Meals $meal
 * @property Users $user
 * @property OrdersHasAdditions[] $ordersHasAdditions
 * @property Additions[] $additions
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'meal_id'], 'required'],
            [['id', 'user_id', 'meal_id'], 'integer'],
            [['id', 'user_id', 'meal_id'], 'unique', 'targetAttribute' => ['id', 'user_id', 'meal_id']],
            [['meal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meals::className(), 'targetAttribute' => ['meal_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'meal_id' => 'Meal ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeal()
    {
        return $this->hasOne(Meals::className(), ['id' => 'meal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersHasAdditions()
    {
        return $this->hasMany(OrdersHasAdditions::className(), ['orders_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditions()
    {
        return $this->hasMany(Additions::className(), ['id' => 'additions_id'])->viaTable('orders_has_additions', ['orders_id' => 'id']);
    }
}
