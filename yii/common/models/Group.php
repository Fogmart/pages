<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Group".
 *
 * @property int $id
 * @property string $name
 */
class Group extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['parid'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parid' => 'Верхняя группа',
        ];
    }


    public function getPageGroup(){
        return $this->hasMany(PageGroup::className(), ['group_id'=>'id']);
    }

    public function getPages(){
        return $this->hasMany(Page::className(), ['id'=>'page_id'])->via('pageGroup');
    }

    public function getOtherGroups(){
        if (isset($this->id)) {
            return Group::find()->where('id != '.$this->id)->all();
        } else {
            return Group::find()->all();
        }
    }

    public function getChild(){
        return Group::find()->where('parid = '.$this->id)->all();
    }

    public function getMainGroups(){
        return Group::find()->where('parid is null')->all();
    }



}
