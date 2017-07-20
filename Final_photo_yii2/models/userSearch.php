<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * userSearch represents the model behind the search form about `app\models\User`.
 */
class userSearch extends User
{
    /**
     * @inheritdoc
     */

    public $globalsearch;
    

    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['full_name', 'username','globalsearch' ,'email', 'password', 'auth_key', 'create_Date'], 'safe'],
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


    public function  getFriend()
    {
    
       // $persons = User::find()->where(['username'=>$this->globalsearch])->all();

        


        $query = User::find();
      

       // $this->load($params);

  


       $persons = $query->orFilterWhere(['like', 'username', $this->globalsearch])
            ->orFilterWhere(['like', 'email', $this->globalsearch]);

return $persons;

    }






    public function search($params)
    {
       
        $query = User::find();
        // add conditions that should always apply here



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate())
         {
            // uncomment the following line if you do not want to return any records when validation fails
             //$query->where('0=1');
             return $dataProvider;

        }
//bhai to nakara ho gya hai tere kuch ho nh
        //to apna to dikha kahatnr amtkvier pa 
        //teamvier pa ajaok
        // grid filtering conditions



        $query->orFilterWhere(['like', 'username', $this->globalsearch])
            ->orFilterWhere(['like', 'email', $this->globalsearch]);

         


        return $dataProvider;
    }
}
