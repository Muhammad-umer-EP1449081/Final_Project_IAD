<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "profile_picture".
 *
 * @property integer $pp_id
 * @property integer $user_id
 * @property string $filename
 * @property integer $size
 * @property string $type
 *
 * @property User $user
 */
class ProfilePicture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['user_id','size', 'type','filename'], 'safe'],
            [['user_id', 'size'], 'integer'],
            [['filename'], 'string', 'max' => 255],
            [['filename'], 'file' , 'extensions'=> 'png,jpg,gif'],
            [['type'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pp_id' => 'Pp ID',
            'user_id' => 'User ID',
            'filename' => 'Filename',
            'size' => 'Size',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
