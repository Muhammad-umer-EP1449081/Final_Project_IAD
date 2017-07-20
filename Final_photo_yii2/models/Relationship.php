<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relationship".
 *
 * @property integer $id
 * @property integer $user_id_one
 * @property integer $user_id_two
 * @property integer $status
 * @property integer $action_user_id
 *
 * @property User $actionUser
 * @property User $userIdOne
 * @property User $userIdTwo
 */
class Relationship extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'relationship';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id_one', 'user_id_two', 'action_user_id'], 'required'],
            [['date', 'accepted_date' ], 'safe'],
            [['user_id_one', 'user_id_two', 'status', 'action_user_id'], 'integer'],
            [['user_id_one', 'user_id_two'], 'unique', 'targetAttribute' => ['user_id_one', 'user_id_two'], 'message' => 'The combination of User Id One and User Id Two has already been taken.'],
            [['action_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['action_user_id' => 'user_id']],
            [['user_id_one'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id_one' => 'user_id']],
            [['user_id_two'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id_two' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id_one' => 'User Id One',
            'user_id_two' => 'User Id Two',
            'status' => 'Status',
            'date' => 'Date',
            'accepted_date' => 'Accepted_date',
            'action_user_id' => 'Action User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'action_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdOne()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id_one']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdTwo()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id_two']);
    }


public function beforeSave($insert) 
{


if ($this->isNewRecord)
{

$this->date=date("Y-m-d H:i:s");  

}
else
{

    $this->accepted_date=date("Y-m-d H:i:s");  
// some code for update
}


parent::beforeSave($insert);

return true;

} 












}
