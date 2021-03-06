<?php

namespace frontend\controllers;

use common\helpers\TaskHelper;
use common\models\TaskTypes;
use Yii;

use common\models\Priority;
use common\models\Projects;
use common\models\Tasks;
use common\models\User;
use common\models\search\TaskSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\forms\TaskForm;
use frontend\common\behaviors\HistoryBehavior;
use yii\web\Response;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends BaseController
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
            'history' => [
                'class' => HistoryBehavior::class,
                'actions' => [ 'view' ],
                'key' => Tasks::HISTORY_KEY,
                'rememberCount' => 5,
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [

            'model' => $this->findModel($id),
            'user' => Yii::$app->user->identity
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaskForm();

        if ($model->load(Yii::$app->request->post()) && $model->save() ) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', $this->prepareFormData($model));
    }

    /**
     * Updates an existing Tasks model.
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
        return $this->render('update', $this->prepareFormData($model));
    }
    /**
     * Вынес логику которая повторяется в редактировании и создании, чтоб не править постоянно в 2х местах
     * @param $model
     * @return array
    */
    private function prepareFormData( $model ) {
        $usersList = User::find()->all();
        $projectsList = Projects::find()->all();
        $priorityList = Priority::find()->where(['type' => Priority::TYPE_TASK ])->all();
        $templatesList = Tasks::findAll(['is_template' => true ]);
        $typesList = TaskTypes::find()->all();

        return [
            'model' => $model,
            'templatesList' => $templatesList,
            'priorityList' =>  ArrayHelper::map($priorityList, 'id', 'title'),
            'projectsList' => ArrayHelper::map($projectsList, 'id', 'name'),
            'usersList' => ArrayHelper::map($usersList, 'id', 'username'),
            'typesList' => ArrayHelper::map($typesList, 'id', 'name'),
        ];
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    /**
     * Смена статуса задачи
     * @param int $id
     * @param $status string
     * @return bool|Response
    */
    public function actionStatus($id, $status) {
        $model = Tasks::findOne(['id' => $id ]);

        $model->status = $status;
        if ( $model->save() ) {
            return $this->redirect(['view', 'id' => $id ]);
        }
        return false;
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaskForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskForm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
