<?php
namespace frontend\controllers;

use common\models\Group;
use common\models\Page;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class  PageController extends Controller
{


//    public function actionIndex()
//    {
//        $pages = Page::find()->all();
//        return $this->render('all', ['blogs'=>$pages]);
//    }

    public function actionCreate($groupid)
    {
        $model = new Page();
        $model->groups_arr = [$groupid];
        $model->type_id = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id, "groupid"=>$groupid]);
        }

        return $this->render('create', [
            'model' => $model,
            'groupid'=>$groupid
        ]);
    }

    public function actionUpdate($id, $groupid)
    {
        $model = Page::find()->andWhere(['id'=>$id])->one();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $post = Yii::$app->request->post();
            return $this->redirect(['bygroup', 'groupid' => $groupid]);
        }

        return $this->render('update', [
            'model' => $model,
            'groupid' => $groupid,
        ]);
    }

    public function actionOne($url,$groupid)
    {
        if ($page = Page::find()->andWhere(['url'=>$url])->one()){
            return $this->render('one', ['page'=>$page, 'groupid' => $groupid]);
        }else{
            throw new NotFoundHttpException();
        }
    }

    public function actionBygroup($groupid){
        $user = User::findIdentity(Yii::$app->user->identity->getId());
        if ($user->getIsUserGroup($groupid)){
            $pages = Group::find()->andWhere(["id" => $groupid])->one()->pages;
            return $this->render('all', ['pages' => $pages, "groupid"=>$groupid]);
        } else {
            throw new NotFoundHttpException();
        }
    }

}

