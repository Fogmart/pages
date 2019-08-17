<?php

namespace backend\controllers;

use common\models\Group;
use common\models\ImageManager;
use common\models\PageGroup;
use Yii;
use common\models\Page;
use common\models\PageSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions'=>['index','create','update', 'delete','assign'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delete-image'=> ['POST'],
                    'sort-image'=> ['POST'],

                ],
            ],
        ];
    }

    /**
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Page model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (
            ($model = Page::find()->with('groups')->andWhere(['id'=>$id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDeleteImage(){
        if (($model = ImageManager::findOne(Yii::$app->request->post('key'))) and $model->delete()){
            return true;
        } else {
            throw new NotFoundHttpException('Не найдено');
        }
    }



    public function actionAssign(){
        $pages = Page::find()->all();
        $groups = Group::find()->all();
        return $this->render('asign', [
            'pages'=>$pages, "groups"=>$groups
        ]);
    }

    public function actionAssigngroup(){
        $post = Yii::$app->request->post();

        if ($post["set"]=='true'){
            $model = new PageGroup();
            $model->group_id = $post["groupid"];
            $model->page_id = $post["pageid"];
            $model->save();
        } else {

            PageGroup::deleteAll(["page_id"=>$post["pageid"], "group_id"=>$post["groupid"] ]);
        }
    }
}
