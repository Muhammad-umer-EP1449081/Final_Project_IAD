<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "conversation".
 *
 * @property integer $conversation_id
 * @property integer $user_one_id
 * @property integer $user_two_id
 * @property string $first_msg_date
 *
 * @property User $userTwo
 * @property User $userOne
 * @property ConversationMessages[] $conversationMessages
 */
class Conversation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conversation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_one_id', 'user_two_id'], 'required'],
            [['user_one_id', 'user_two_id'], 'integer'],
            [['first_msg_date'], 'safe'],
            [['user_one_id', 'user_two_id'], 'unique', 'targetAttribute' => ['user_one_id', 'user_two_id'], 'message' => 'The combination of User One ID and User Two ID has already been taken.'],
            [['user_two_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_two_id' => 'user_id']],
            [['user_one_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_one_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'conversation_id' => 'Conversation ID',
            'user_one_id' => 'User One ID',
            'user_two_id' => 'User Two ID',
            'first_msg_date' => 'First Msg Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTwo()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_two_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOne()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_one_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConversationMessages()
    {
        return $this->hasMany(ConversationMessages::className(), ['conversation_id' => 'conversation_id']);
    }
}
