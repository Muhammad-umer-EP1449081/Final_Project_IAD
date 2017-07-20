<?php

namespace app\controllers;

use Yii;
use app\models\Comments;

use app\models\Photograph;

use app\models\User;


use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * CommentsController implements the CRUD actions for Comments model.
 */
class CommentsController extends Controller
{
    /**
     * @inheritdoc
     */
   /* public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    /**
     * Lists all Comments models.
     * @return mixed
     */
    public function actionIndex()
    {
       /* $dataProvider = new ActiveDataProvider([
            'query' => Comments::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);*/



    }

    /**
     * Displays a single Comments model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        /*return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
$comments = Comments::find()->where(['photograph_id'=>$id])->all();

 return $this->render('view',['comments' => $comments ,'photograph_id'=>$id]);


    }

    /**
     * Creates a new Comments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Comments();
            
         $model->user_id = Yii::$app->user->identity->id;

         $user = User::find()->where(['user_id'=>$model->user_id])->one();

         $model->author = $user->username;

         $photograph = Photograph::find()->where(['id'=>$id])->one();

         $model->photograph_id = $photograph->id;



        if ($model->load(Yii::$app->request->post()) && $model->save()) 
        {
            return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');
        } 

        else

         {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Comments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        
        $model = $this->findModel($id);

    /*   $comments = Comments::find()->where(['photograph_id'=>$id])->all();

 return $this->render('all_Comments',['comments' => $comments]);*/

        if ($model->load(Yii::$app->request->post()) && $model->save())
         {
           
            return $this->redirect(['view', 'id' => $model->id]);
        } 
        else
         {
            return $this->render('update', [
                'model' => $model,
            ]);
        }


    }

    /**
     * Deletes an existing Comments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');
    }

    /**
     * Finds the Comments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comments::findOne($id)) !== null) 
        {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }











}
