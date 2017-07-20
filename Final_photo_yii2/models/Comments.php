<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $photograph_id
 * @property string $created
 * @property string $author
 * @property string $body
 *
 * @property Photographs $photograph
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['photograph_id','author', 'body'], 'required'],
            [['photograph_id'], 'integer'],
            [['created','edited'], 'safe'],
            [['body'], 'string'],
            [['author'], 'string', 'max' => 255],
            [['photograph_id'], 'exist', 'skipOnError' => true, 'targetClass' => Photograph::className(), 'targetAttribute' => ['photograph_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photograph_id' => 'Photograph ID',
            'created' => 'Created',
            'edited'=> 'Edited',
            'author' => 'Author',
            'body' => 'Body',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotograph()
    {
        return $this->hasOne(Photographs::className(), ['id' => 'photograph_id']);
    }

    
public function beforeSave($insert) 
{


if ($this->isNewRecord)
{

$this->created=date("Y-m-d H:i:s");  

}
else
{

    $this->edited=date("Y-m-d H:i:s");  
// some code for update
}


parent::beforeSave($insert);

return true;

} 


}
