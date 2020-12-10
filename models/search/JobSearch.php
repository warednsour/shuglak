<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Job;

/**
 * JobSearch represents the model behind the search form of `app\models\Job`.
 */
class JobSearch extends Job
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pay', 'views', 'publish', 'user_id'], 'integer'],
            [['title', 'description', 'howlong', 'place', 'category', 'link', 'create_date', 'expire_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Job::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pay' => $this->pay,
            'views' => $this->views,
            'publish' => $this->publish,
            'user_id' => $this->user_id,
            'create_date' => $this->create_date,
            'expire_date' => $this->expire_date,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'howlong', $this->howlong])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
