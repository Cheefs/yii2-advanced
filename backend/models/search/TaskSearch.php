<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tasks;

/**
 * TaskSearch represents the model behind the search form of `common\models\Tasks`.
 */
class TaskSearch extends Tasks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'execute_user_id', 'is_template', 'project_id', 'type_id', 'create_user_id', 'created_at', 'updated_at', 'priority_id'], 'integer'],
            [['title', 'status'], 'safe'],
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
        $query = Tasks::find();

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
            'execute_user_id' => $this->execute_user_id,
            'is_template' => $this->is_template,
            'project_id' => $this->project_id,
            'type_id' => $this->type_id,
            'create_user_id' => $this->create_user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'priority_id' => $this->priority_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
