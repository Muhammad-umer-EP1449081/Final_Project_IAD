<?php

namespace app\controllers;

use Yii;
use app\models\Profilepicture;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;


class ProfilepicController extends \yii\web\Controller
{

public function behaviors()
{

return  [

'access' => [

'class' => AccessControl::className(),
'only' => ['update','insert'],
'rules' => [
[

      'actions' => ['update','insert'],
      'allow' => true,
      'roles' => ['@'],
],

],

]


];

}


    public function actionInsert()
    {


         $model = new Profilepicture();

    if ($model->load(Yii::$app->request->post()))
     {
        if ($model->validate())
         {
                 

                  $image = UploadedFile::getInstance($model ,'filename');

  
                     if(!$image)
                     {
                        return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');
                     }




                     $model->filename = $image->baseName. '.' . $image->extension; 
                    $model->type = $image->type;
                     $model->size = $image->size;
                     $model->user_id = Yii::$app->user->identity->id;



            if($model->save())
            {

                $image->saveAs('images/'.$model->filename);

                return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');

            }


            // form inputs are valid, do something here
            return;
        }
    }

    return $this->render('insert', [
        'model' => $model,
    ]);
    


    }

    public function actionUpdate($id)
    {
     
       // $model = new app\models\Profilepicture();

 $profilepicture =  Profilepicture::find()->where(['pp_id'=>$id])->one();
   
  // $profilepicture = Profilepicture::findModel($id); 

    if ($profilepicture->load(Yii::$app->request->post())) 
    {
    
        if ($profilepicture->validate())
     
         {

         	 $image = UploadedFile::getInstance($profilepicture ,'filename');

  
                     if(!$image)
                     {
                     	return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');
                     }




                     $profilepicture->filename = $image->baseName. '.' . $image->extension; 



         	if($profilepicture->save())
         	{

         		$image->saveAs('images/'.$profilepicture->filename);

         		return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');

         	}
                 
         // Yii::$app->getSession()->setFlash('success','Profile Picture Succesfully updated');
            // form inputs are valid, do something here
        //    return $this->redirect('/Final_photo_yii2/web/index.php?r=user/home');
            // form inputs are valid, do something here
           
        }
    
    }

    return $this->render('update', [
        'profilepicture' => $profilepicture,
    ]);

    }


}
