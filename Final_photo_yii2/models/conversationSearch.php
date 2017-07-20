<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\conversation;

/**
 * conversationSearch represents the model behind the search form about `app\models\conversation`.
 */
class conversationSearch extends conversation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['conversation_id', 'user_one_id', 'user_two_id'], 'integer'],
            [['first_msg_date'], 'safe'],
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
        $query = conversation::find();

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
            'conversation_id' => $this->conversation_id,
            'user_one_id' => $this->user_one_id,
            'user_two_id' => $this->user_two_id,
            'first_msg_date' => $this->first_msg_date,
        ]);

        return $dataProvider;
    }
}
