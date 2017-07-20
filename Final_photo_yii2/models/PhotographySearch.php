<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Photography;

/**
 * PhotographySearch represents the model behind the search form about `app\models\Photography`.
 */
class PhotographySearch extends Photography
{
    /**
     * @inheritdoc
     */


    public $globalsearch;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['id', 'size', 'user_id','globalsearch','filename' ,'type', 'caption', 'p_status', 'date'], 'safe'],
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
        $query = Photography::find();

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
    /*    $query->andFilterWhere([
            'id' => $this->id,
            'size' => $this->size,
            'user_id' => $this->user_id,
            'date' => $this->date,
        ]);*/

        $query->orFilterWhere(['like', 'filename', $this->globalsearch])
            ->orFilterWhere(['like', 'type', $this->globalsearch])
            ->orFilterWhere(['like', 'caption', $this->globalsearch])
            ->orFilterWhere(['like', 'p_status', $this->globalsearch]);

        return $dataProvider;
    }
}
