<?php

namespace app\controllers;

use app\models\OrderSearch;
use DateTime;
use Yii;
use app\models\Meals;
use app\models\MealsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MealsController implements the CRUD actions for Meals model.
 */
class MealsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return !\Yii::$app->user->isGuest
                                && \Yii::$app->user->identity->is_admin == 1;
                        },
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Meals models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MealsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Meals model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(['OrderSearch' => ['id' => null,'user_id'=> null, 'meal_id' => $id]]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Meals model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Meals();

        if ($model->load(Yii::$app->request->post())){
            // PHP date()-format
            $model->start_date = DateTime::createFromFormat('d/m/Y', $model->start_date)->format('Y-m-d 00:00:00');
            $model->end_date = DateTime::createFromFormat('d/m/Y', $model->end_date)->format('Y-m-d 23:59:59');

            if($model->save()) { {
            if($model->status == 1){
                $model->updateAll(array('status' => 0), 'id != ' . $model->id);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Meals model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){
            // PHP date()-format
            $model->start_date = DateTime::createFromFormat('d/m/Y', $model->start_date)->format('Y-m-d 00:00:00');
            $model->end_date = DateTime::createFromFormat('d/m/Y', $model->end_date)->format('Y-m-d 23:59:59');

            if($model->save()) {
                if ($model->status == 1) {
                    $model->updateAll(array('status' => 0), 'id != ' . $model->id);
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Meals model.
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
     * Finds the Meals model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Meals the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Meals::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
