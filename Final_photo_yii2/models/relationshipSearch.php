<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\relationship;

/**
 * relationshipSearch represents the model behind the search form about `app\models\relationship`.
 */
class relationshipSearch extends relationship
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id_one', 'user_id_two', 'status', 'action_user_id'], 'integer'],
            

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
        $query = relationship::find();

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
            'user_id_one' => $this->user_id_one,
            'user_id_two' => $this->user_id_two,
            'status' => $this->status,
            'action_user_id' => $this->action_user_id,
        ]);

        return $dataProvider;
    }









}
