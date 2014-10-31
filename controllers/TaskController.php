<?php

namespace app\controllers;

use Yii;
use app\models\db\Task;
use app\models\db\TaskSearch;
use app\models\db\Course;
use app\models\db\Submission;
use app\models\db\SubmissionSearch;


use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;



/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    public $layout = '@app/views/layouts/sidebar';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex(){
        if (Yii::$app->user->identity->isTeacher() || Yii::$app->user->identity->isAdmin()){
            $this->redirect(['teacher']);
        } else {
            $this->redirect(['student']);
        }
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionTeacher()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->searchTeacherTasks(Yii::$app->request->queryParams);

        return $this->render('teacher', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionStudent()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->searchStudentTasks(Yii::$app->request->queryParams);

        return $this->render('student', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $submission = new Submission();

        if ($submission->load(Yii::$app->request->post()) && $submission->save() ) {

            $submission->_file = UploadedFile::getInstance($submission,'_file');

            $submission->_file->saveAs('uploads/submissions/'.sha1($submission->id).'.'.$submission->_file->extension);
            $submission->pathfile = 'uploads/submissions/'.sha1($submission->id).'.'.$submission->_file->extension;
            $submission->save();
        }

        $submission->task_id = $id;
        $submission->user_id = Yii::$app->user->identity->id;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'submission' => $submission,
            'submissionDataProvider' => (new SubmissionSearch)->searchUserSubmissions(Yii::$app->request->queryParams),
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();
        $model->user_id = Yii::$app->user->identity->id;

        $courses = Course::find()
        ->joinWith(['userCourses'=>function($query){$query->andWhere(['user_id' => Yii::$app->user->identity->id]);}])
        ->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'courses' => $courses,
            ]);
        }
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->user_id = Yii::$app->user->identity->id;

        $courses = Course::find()
        ->joinWith(['userCourses'=>function($query){$query->andWhere(['user_id' => Yii::$app->user->identity->id]);}])
        ->all();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'courses' => $courses,
            ]);
        }
    }

    /**
     * Deletes an existing Task model.
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
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
