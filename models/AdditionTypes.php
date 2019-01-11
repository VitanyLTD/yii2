<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "addition_types".
 *
 * @property int $id
 * @property string $description
 * @property int $multiselector
 *
 * @property Additions[] $additions
 */
class AdditionTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'addition_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'multiselector'], 'integer'],
            [['description'], 'string', 'max' => 45],
            [['id'], 'unique'],
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
            'multiselector' => 'Multiselector',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdditions()
    {
        return $this->hasMany(Additions::className(), ['addition_type_id' => 'id']);
    }
}
