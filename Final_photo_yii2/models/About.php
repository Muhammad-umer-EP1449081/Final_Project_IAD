<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "about".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $date_of_birth
 * @property string $country
 * @property string $martial_status
 * @property string $Gender
 *
 * @property User $user
 */
class About extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'date_of_birth', 'country'], 'required'],
            [['user_id'], 'integer'],
            [['date_of_birth'], 'date', 'format' => 'php:Y-m-d'],
            [['date_of_birth'], 'safe'],
             
            [['martial_status', 'Gender'], 'string'],
            [['country'], 'string', 'max' => 255],
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
            'user_id' => 'User ID',
            'date_of_birth' => 'Date Of Birth',
            'country' => 'Country',
            'martial_status' => 'Martial Status',
            'Gender' => 'Gender',
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
