<?php

namespace app\controllers;

use Yii;
use app\models\db\Course;
use app\models\db\Department;
use app\models\search\CourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\db\Faculty;
use app\models\db\UserCourse;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends Controller
{
    public $layout = '@app/views/layouts/sidebar';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['admin','update','create','delete','join','quit'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','view'],
                        'roles' => ['?','@'],
                    ],
                    [   
                        //deny other request
                        'allow' => false,
                        'roles' => ['@','?']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionAdmin()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'list_fakultas' => 
                Faculty::find()
                    ->with(['departments'])
                    ->all()
        ]);
    }

    /**
     * Displays a single Course model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest){
            $joined = false;
        } else {
            $user_course = UserCourse::find()
            ->where(['user_id' => Yii::$app->user->identity->id,'course_id' => $id])
            ->one();
            $joined = ($user_course !== null);
        }
        

        return $this->render('view', [
            'model' => $this->findModel($id),
            'joined' => $joined
        ]);
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Course();
        $list_jurusan = Department::find()->with('faculty')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'list_jurusan' => $list_jurusan,
            ]);
        }
    }

    public function actionJoin($id){
        $user_course = UserCourse::find()
        ->where(['user_id' => Yii::$app->user->identity->id,'course_id' => $id])
        ->one();
        if ($user_course === null){
            $user_course = new UserCourse;
            $user_course->user_id = Yii::$app->user->identity->id;
            $user_course->course_id = $id;
            if(!$user_course->save()){
                var_dump($user_course->getErrors());
                exit();
            }
        }
        return $this->redirect(['view','id'=>$id]);
    }

    public function actionQuit($id){
        $user_course = UserCourse::find()
        ->where(['user_id' => Yii::$app->user->identity->id,'course_id' => $id])
        ->one();
        if ($user_course !== null){
            $user_course->delete();
        }
        return $this->redirect(['view','id'=>$id]);
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $list_jurusan = Department::find()->with('faculty')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'list_jurusan' => $list_jurusan,
            ]);
        }
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
