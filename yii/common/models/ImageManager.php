<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $name
 * @property string $class
 * @property int $itm_id
 * @property string $alt
 */
class ImageManager extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['itm_id'], 'integer'],
            [['name', 'class', 'alt'], 'string', 'max' => 150],
            [['sort'], 'default', 'value' => function($model){
                $count = ImageManager::find()->andWhere(['class'=>$model->class])->count();
                return ($count > 0)?$count++:0;
            }
                ]
        ];
    }

    public function getImageUrl(){
        if($this->name){
            $link = 'http://yii.loc/uploads/images/'.strtolower($this->class).'/'.$this->name;
        }else{
            $link = 'http://yii.loc/uploads/images/nophoto.png';
        }
        return $link;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'class' => 'Class',
            'itm_id' => 'Itm ID',
            'alt' => 'Alt',
        ];
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            ImageManager::updateAllCounters(
                ['sort' => -1],
                ['and', ['class'=>'page', 'itm_id'=>$this->itm_id], ['>', 'sort', $this->sort]]
            );
            return true;
        } else {
            return false;
        }
    }
}
