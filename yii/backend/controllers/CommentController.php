<?php

namespace backend\controllers;

use common\models\Comment;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class CommentController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'=>['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ]
                ]
            ],
        ];
    }

    public function actionIndex()
    {
        $comments = Comment::find()->orderBy('created_at desc')  ->all();
        return $this->render('index', ['comments'=>$comments]);
    }

}
