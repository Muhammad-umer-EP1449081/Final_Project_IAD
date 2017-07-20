<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Photography;

/**
 * PhotographySearch represents the model behind the search form about `app\models\Photography`.
 */
class SearchForm extends User
{
    /**
     * @inheritdoc
     */


    public $globalsearch;
    
    public function rules()
    {
        return [
            [['full_name', 'email', 'username' ,'password' ,'globalsearch' , 'password_repeat'], 'safe'],
            [['username', 'email'], 'unique', 'targetAttribute' => ['username', 'email']],
            ['email', 'email'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
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
       // $query = Photography::find();

         $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
         {
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

$query->orFilterWhere(['like', 'username', $this->globalsearch])
            ->orFilterWhere(['like', 'email', $this->globalsearch]);





       /* $query->orFilterWhere(['like', 'filename', $this->globalsearch])
            ->orFilterWhere(['like', 'type', $this->globalsearch])
            ->orFilterWhere(['like', 'caption', $this->globalsearch])
            ->orFilterWhere(['like', 'p_status', $this->globalsearch]);*/

        return $dataProvider;
    }
}
