<?php

namespace app\models\db;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\db\UserCourse;

/**
 * UserCourseSearch represents the model behind the search form about `app\models\db\UserCourse`.
 */
class UserCourseSearch extends UserCourse
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'course_id', 'grade'], 'integer'],
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
        $query = UserCourse::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'course_id' => $this->course_id,
            'grade' => $this->grade,
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
    public function searchDosenKuliah($params)
    {
        $data_query = UserCourse::find()->joinWith(['user'=>function($query){
            $query->andWhere('is_teacher = 1');
        }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $data_query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $data_query->andFilterWhere([
            'user_id' => $this->user_id,
            'course_id' => $this->course_id,
            'grade' => $this->grade,
        ]);

        return $dataProvider;
    }
}
