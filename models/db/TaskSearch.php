<?php

namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\Task;

/**
 * TaskSearch represents the model behind the search form about `app\models\db\Task`.
 */
class TaskSearch extends Task
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'id', 'user_id'], 'integer'],
            [['created_at', 'deadline'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Task::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'course_id' => $this->course_id,
            'id' => $this->id,
            'created_at' => $this->created_at,
            'deadline' => $this->deadline,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchStudentTasks($params)
    {
        $query = Task::find()->joinWith(['studentCourse'=>function($query){
            $query->andWhere([UserCourse::tableName().'.user_id' => Yii::$app->user->identity->id]);
        }])->where('`deadline` > CURRENT_TIMESTAMP')->orderBy(['deadline' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'course_id' => $this->course_id,
            'id' => $this->id,
            'created_at' => $this->created_at,
            'deadline' => $this->deadline,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchTeacherTasks($params)
    {
        $query = Task::find()->with(['course'])->where(['user_id'=>Yii::$app->user->identity->id])->orderBy(['deadline' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'course_id' => $this->course_id,
            'id' => $this->id,
            'created_at' => $this->created_at,
            'deadline' => $this->deadline,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
