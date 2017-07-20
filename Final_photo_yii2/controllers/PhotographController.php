<?php

namespace app\controllers;

use Yii;
use app\models\Photograph;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
/**
 * PhotographController implements the CRUD actions for Photograph model.
 */
class PhotographController extends Controller
{
    /**
     * @inheritdoc
     */


public function behaviors()
{

return  [

'access' => [

'class' => AccessControl::className(),
'only' => ['update','create', 'delete'],
'rules' => [
[

      'actions' => ['update','create','delete'],
      'allow' => true,
      'roles' => ['@'],
],

],

],
'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

];

}



    /**
     * Lists all Photograph models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$dataProvider = new ActiveDataProvider([
            'query' => Photograph::find(),
        ]);
*/
       /* return $this->render('user/home', [
            'dataProvider' => $dataProvider,
        ]);*/
return $this->render('user/timeline');
    }

    /**
     * Displays a single Photograph model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        /*return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
return $this->render('user/timeline');
    }

    /**
     * Creates a new Photograph model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Photograph();
        $user_id = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()))
         {
                     if ($model->validate())   
         {

             $image = UploadedFile::getInstance($model ,'filename');

  
                     if(!$image)
                     {
                        return $this->redirect('/Final_photo_yii2/web/index.php?r=photograph/create');
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

          //  return $this->redirect(['view', 'id' => $model->id]);
        }
    }
         
         else
          {
            return $this->render('create', [
                'model' => $model,
                'user_id' => $user_id,
            ]);
        }
    }

    /**
     * Updates an existing Photograph model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect(['user/timeline', 'id' => $model->id]);
        } 
        else
         {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Photograph model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

// $post = Photograph::find()->where(['id' => $id])->one();

  //      $post->delete();

    //    return $this->redirect('/Final_photo_yii2/web/index.php?r=user/home');


        $this->findModel($id)->delete();

        return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');
    }

    /**
     * Finds the Photograph model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Photograph the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Photograph::findOne($id)) !== null)
         {
            return $model;
        }
         else 
         {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
