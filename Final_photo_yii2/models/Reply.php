<?php

namespace app\models;

use Yii;

use app\models\conversation;
use app\models\conversationSearch;




/**
 * This is the model class for table "conversation_messages".
 *
 * @property integer $cm_id
 * @property string $message
 * @property integer $user_id_message
 * @property string $time
 * @property string $status
 * @property integer $conversation_id
 *
 * @property User $userIdMessage
 * @property Conversation $conversation
 */
class Reply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conversation_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'user_id_message', 'conversation_id' ], 'required'],
            [['message', 'status'], 'string'],
            [['user_id_message', 'conversation_id'], 'integer'],
            [['time' , 'status' ], 'safe'],
            [['user_id_message'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id_message' => 'user_id']],
            [['conversation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conversation::className(), 'targetAttribute' => ['conversation_id' => 'conversation_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cm_id' => 'Cm ID',
            'message' => 'Message',
            'user_id_message' => 'User Id Message',
            'time' => 'Time',
            'status' => 'Status',
            'conversation_id' => 'Conversation ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdMessage()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id_message']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversation()
    {
        return $this->hasOne(Conversation::className(), ['conversation_id' => 'conversation_id']);
    }



public static function getcon($con_user)
    {


$query2 = conversation::find()->where(['user_one_id'=> Yii::$app->user->identity->id ,'user_two_id'=>$con_user])->one();

        if(!$query2)
        {
         $query2 = conversation::find()->where(['user_one_id'=>$con_user,'user_two_id'=>Yii::$app->user->identity->id])->one();
        
        }


$conversation_id = $query2->conversation_id;

return $conversation_id;
        
        }




}
