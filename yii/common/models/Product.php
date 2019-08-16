<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $sklad_id
 * @property string $title
 * @property int $cost
 * @property int $type_id
 * @property string $text
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sklad_id', 'title', 'type_id'], 'required'],
            [['sklad_id', 'cost', 'type_id'], 'integer'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sklad_id' => 'Sklad ID',
            'title' => 'Title',
            'cost' => 'Cost',
            'type_id' => 'Type ID',
            'text' => 'Text',
        ];
    }

    public static function getTypeLst(){
        return ["первый", "второй", "третий"];
    }

    public function getSklad(){
        return $this->hasOne(Sklad::className(), ["id"=>"sklad_id"]);
    }
}
