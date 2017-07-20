<?php

namespace app\models;


use Yii;
use yii\base\Model;
use yii\base\Security;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\filters\AccessControl;


class User extends ActiveRecord implements IdentityInterface
{
    public $password_repeat;
    public $date_of_birth;

  public function behaviors()
{

return  [

'access' => [

'class' => AccessControl::className(),
'only' => ['timeline'],
'rules' => [
[

      'actions' => ['timeline'],
      'allow' => true,
      'roles' => ['@'],
],

],

]


];

}




    public static function tableName()
    {
        return '{{%user}}';
    }


 public function rules()
    {
        return [
            [['full_name', 'email', 'username' ,'date_of_birth','password' , 'password_repeat'], 'required'],
            ['email', 'email'],
            ['date_of_birth','safe'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }




    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->user_id;
    }


   public function validatePassword($password)
   {
    return $this->password === md5($password);
   }


public static function findByUsername($username)
{

return User::findOne(['username'=> $username]);

}





    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }


public function beforeSave($insert)
{

if(parent::beforeSave($insert))
{

if($this->isNewRecord)
{

    $this->auth_key = \Yii::$app->security->generateRandomString();
}

if(isset($this->password))
{
    $this->password = md5($this->password);
    return parent::beforeSave($insert);
}

}

return true;

}




}