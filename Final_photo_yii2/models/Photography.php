<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photography".
 *
 * @property integer $id
 * @property string $filename
 * @property string $type
 * @property integer $size
 * @property string $caption
 * @property integer $user_id
 * @property string $p_status
 * @property string $date
 */
class Photography extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photography';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filename', 'type', 'size', 'caption', 'user_id', 'p_status'], 'required'],
            [['size', 'user_id'], 'integer'],
            [['date'], 'safe'],
            [['filename', 'caption'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 100],
            [['p_status'], 'string', 'max' => 11],
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
            'date' => 'Date',
        ];
    }
}
