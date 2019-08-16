<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "page_group".
 *
 * @property int $id
 * @property int $page_id
 * @property int $group_id
 */
class PageGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id', 'group_id'], 'required'],
            [['page_id', 'group_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'group_id' => 'Group ID',
        ];
    }

    public function getGroup(){
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }


}
