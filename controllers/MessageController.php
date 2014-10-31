<?php

namespace app\controllers;

use Yii;
use app\models\db\Message;
use app\models\form\MessageForm;
use app\models\db\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
{

public $layout = '@app/views/layouts/message';
    public function behaviors()
    {
        return [

        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionInbox()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->searchInbox(Yii::$app->request->queryParams);

        
        return $this->render('inbox', [
            'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
            //'messages' => $messages,
        ]);
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionSent()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->searchSent(Yii::$app->request->queryParams);
        return $this->render('sent', [
            'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
            //'messages' => $messages,
        ]);
    }

    /**
     * Displays a single Message model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MessageForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact()){
                return $this->redirect(['sent']);
            }
            
        }
        return $this->render('create', [
                'model' => $model,
            ]);
    }


    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
