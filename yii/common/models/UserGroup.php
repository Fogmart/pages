<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_group".
 *
 * @property int $id
 * @property int $user_id
 * @property int $group_id
 * @property int $can_read
 * @property int $can_edit
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id'], 'required'],
            [['user_id', 'group_id', 'can_read', 'can_edit'], 'integer'],
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
            'group_id' => 'Group ID',
            'can_read' => 'Can Read',
            'can_edit' => 'Can Edit',
        ];
    }
}
