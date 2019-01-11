<?php

namespace app\controllers;

use Yii;
use app\models\Additions;
use app\models\AdditionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdditionController implements the CRUD actions for Additions model.
 */
class AdditionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Additions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdditionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Additions model.
     * @param integer $id
     * @param integer $addition_type_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $addition_type_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $addition_type_id),
        ]);
    }

    /**
     * Creates a new Additions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Additions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'addition_type_id' => $model->addition_type_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Additions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $addition_type_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $addition_type_id)
    {
        $model = $this->findModel($id, $addition_type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'addition_type_id' => $model->addition_type_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Additions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $addition_type_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $addition_type_id)
    {
        $this->findModel($id, $addition_type_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Additions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $addition_type_id
     * @return Additions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $addition_type_id)
    {
        if (($model = Additions::findOne(['id' => $id, 'addition_type_id' => $addition_type_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
