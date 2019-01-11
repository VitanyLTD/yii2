<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "additions".
 *
 * @property int $id
 * @property string $description
 * @property int $addition_type_id
 *
 * @property AdditionTypes $additionType
 * @property OrdersHasAdditions[] $ordersHasAdditions
 * @property Orders[] $orders
 */
class Additions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'additions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['addition_type_id'], 'required'],
            [['id', 'addition_type_id'], 'integer'],
            [['description'], 'string', 'max' => 45],
            [['id', 'addition_type_id'], 'unique', 'targetAttribute' => ['id', 'addition_type_id']],
            [['addition_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdditionTypes::className(), 'targetAttribute' => ['addition_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'addition_type_id' => 'Addition Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionType()
    {
        return $this->hasOne(AdditionTypes::className(), ['id' => 'addition_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersHasAdditions()
    {
        return $this->hasMany(OrdersHasAdditions::className(), ['additions_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['id' => 'orders_id'])->viaTable('orders_has_additions', ['additions_id' => 'id']);
    }
}
