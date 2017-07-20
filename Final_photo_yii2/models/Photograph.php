<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "photographs".
 *
 * @property integer $id
 * @property string $filename
 * @property string $type
 * @property integer $size
 * @property string $caption
 * @property integer $user_id
 * @property string $p_status
 *
 * @property Comments[] $comments
 * @property User $user
 */
class Photograph extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photographs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['caption', 'p_status'], 'required'],
            [['filename','type', 'size', 'user_id'], 'safe'],
            [['size', 'user_id'], 'integer'],
            [['date'], 'safe'],
            [['filename', 'caption'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 100],
            [['p_status'], 'string', 'max' => 11],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Filename',
            'type' => 'Type',
            'size' => 'Size',
            'caption' => 'Caption',
            'user_id' => 'User ID',
            'p_status' => 'P Status',
            'date' => 'Date'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['photograph_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
