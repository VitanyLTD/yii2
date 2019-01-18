<?php

namespace app\controllers;

use app\models\Additions;
use app\models\AdditionSearch;
use app\models\AdditionTypes;
use app\models\Meals;
use app\models\Users;
use Yii;
use app\models\Orders;
use app\models\OrderSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Orders model.
 */
class OrderController extends Controller
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
                        'actions' => ['create'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return !\Yii::$app->user->isGuest;
                        },
                    ],
                    [
                        'actions' => ['view', 'delete'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return \Yii::$app->request->get('user_id') == \Yii::$app->user->identity->id;
                        },
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @param integer $user_id
     * @param integer $meal_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\db\Exception
     */
    public function actionView($id, $user_id, $meal_id)
    {
        $request = Yii::$app->request;

        //return print_r($request->post('additions'));
        //$get = $request->get();
        if($request->post('additions') != null){
            $data = [];
            $order_id = $request->get('id');
            $meal_id = $request->get('meal_id');

            //Start by deleting the old additions
            Yii::$app->db
                ->createCommand()
                ->delete('orders_has_additions', ['orders_id' => $order_id])
                ->execute();

            foreach($request->post('additions') as $addition){
                if(gettype($addition) == 'array'){
                    foreach($addition as $nestedAddition){
                        if($nestedAddition != null){
                            $data[] = [$order_id,$nestedAddition];
                        }
                    }
                }
                else {
                    if($addition != null) {
                        $data[] = [$order_id, $addition];
                    }
                }

            }

            //Insert new additions
            Yii::$app->db
                ->createCommand()
                ->batchInsert('orders_has_additions', ['orders_id','additions_id'],$data)
                ->execute();

            //return to meal
            return $this->redirect(['meals/view', 'id' => $meal_id]);
        }
        $modelAdditions = new Additions();
        $modelAdditionTypes = new AdditionTypes();
        $searchModel = new AdditionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id, $user_id, $meal_id),
            'searchModel' => $searchModel,
            'modelAdditions' => $modelAdditions,
            'modelAdditionTypes' => $modelAdditionTypes,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();
        $modelUsers = new Users();
        $modelMeals = new Meals();

        //initiate this page with user_id filled in
        $model->user_id = Yii::$app->user->identity->id;

        //if get meal_id has been supplied; apply to model
        if(Yii::$app->request->get('meal_id') != null) {
            $model->meal_id = Yii::$app->request->get('meal_id');
        }

        //if user != admin, apply user_id as well
        if(Yii::$app->user->identity->is_admin == 0){
            $model->id = null;  //set id to null, just in case

            //return error if user is unauthenticated and if meal_id has not been set
            if(!isset($model->meal_id)){
                return $this->render('//site/error', [
                    'name' => 'Oops!',
                    'message' => 'Missing information! Please contact administrator with Error code #55'
                ]);
            }
            else {
                //save model.
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id, 'meal_id' => $model->meal_id]);
                }
            }
        }

        //return print_r($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id, 'meal_id' => $model->meal_id]);
        }


        return $this->render('create', [
            'model' => $model,
            'modelUsers' => $modelUsers,
            'modelMeals' => $modelMeals
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $user_id
     * @param integer $meal_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $user_id, $meal_id)
    {
        $model = $this->findModel($id, $user_id, $meal_id);
        $modelUsers = new Users();
        $modelMeals = new Meals();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'user_id' => $model->user_id, 'meal_id' => $model->meal_id]);
        }

        if(Yii::$app->request->get('meal_id') != null) {
            $model->meal_id = Yii::$app->request->get('meal_id');
        }

        return $this->render('update', [
            'model' => $model,
            'modelUsers' => $modelUsers,
            'modelMeals' => $modelMeals
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $user_id
     * @param integer $meal_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $user_id, $meal_id)
    {
        $this->findModel($id, $user_id, $meal_id)->delete();

        return $this->redirect(['meals/view', 'id' => $meal_id]);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $user_id
     * @param integer $meal_id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $user_id, $meal_id)
    {
        if (($model = Orders::findOne(['id' => $id, 'user_id' => $user_id, 'meal_id' => $meal_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
