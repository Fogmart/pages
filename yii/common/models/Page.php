<?php

namespace common\models;

use common\components\behaviors\StatusBehavior;
use common\models\ImageManager;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use yii\image\drivers\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string $url
 * @property string $image
 * @property int $status_id
 * @property int $sort
 */
class Page extends ActiveRecord
{
    const PAGE_TYPES = ["Текст", "PHP"];
    public $groups_arr;
    public $file;

    /**
     * {@inheritdoc}
     */



    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'whncrt',
                'updatedAtAttribute' => 'whnupd',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['text'], 'string'],
            [['phpurl'], 'string'],
            [['type_id'], 'integer'],
            [['sort'], 'integer', 'max' => 99, 'min'=>1],
            [['title'], 'string', 'max' => 250],
            [['phpurl'], 'string', 'max' => 200],
            [['url'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 100],
            [['file'], 'image'],
            [['groups_arr', 'whnupd', 'whncrt'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'url' => 'УРЛ',
            'sort' => 'Сортировка',
            'groups_arr' => 'Группы',
            'whncrt' => 'Создано',
            'whnupd' => 'Обновлено',
            'phpurl' => 'Адрес PHP файла',
            'type_id' => 'Тип страницы',
        ];
    }

    public function getAuthor(){
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }

    public function getPageGroup(){
        return $this->hasMany(PageGroup::className(), ['page_id'=>'id']);
    }

    public function getImages(){
        return $this->hasMany(ImageManager::className(), ['itm_id'=>'id'])
            ->andWhere(['class'=>self::tableName()] )->orderBy('sort');
    }

    public function getImagesLinks(){
        return ArrayHelper::getColumn($this->images, 'imageUrl');
    }

    public function getImageLinkData(){
        $arr = ArrayHelper::toArray($this->images,[
            ImageManager::className()=>[
                'caption'=>'name',
                'key'=>'id'
            ]]
        );
        return $arr;
    }

    public function getGroups(){
        return $this->hasMany(Group::className(), ['id'=>'group_id'])->via('pageGroup');
    }
    public function getSmallImage(){
        if ($this->image){
            $url  = 'http://yii.loc/uploads/images/page/50x50/'.$this->image;
        } else{
            $url = 'http://yii.loc/uploads/images/nophoto.png';
        }
        return $url;
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->groups_arr = $this->groups;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $arr = ArrayHelper::map($this->groups, 'id', 'id');
        if (($this->groups_arr) ) {
            foreach ($this->groups_arr as $one) {
                if (!in_array($one, $arr)) {
                    $model = new PageGroup();
                    $model->group_id = $one;
                    $model->page_id = $this->id;
                    $model->save();
                }
                if (isset($arr[$one])) {
                    unset($arr[$one]);
                }
            }
        }

        PageGroup::deleteAll(['group_id' => $arr]);
    }


    public function getFullPhpUrl(){
//        return $this->phpurl;
        return "http://pages.loc/".$this->phpurl;
    }
}
