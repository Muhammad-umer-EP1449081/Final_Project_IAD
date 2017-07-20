<?php

namespace app\controllers;

use Yii;
use app\models\Reply;
use app\models\ReplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\conversation;
use app\models\conversationSearch;




/**
 * ReplyController implements the CRUD actions for Reply model.
 */
class ReplyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }




 public function actionIndex()
    {
        $searchModel = new ReplySearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);



    }





 public function actionDoread($id)
{
       

$current = Reply::find()->where(['cm_id'=>$id])->one();

$current->status = '1';


$current->save();



return $this->redirect(['user/timeline']);


}





 public function actionUnread()
    {
       


$unseens = array();

$unread_cons = conversation::find()->where(['user_one_id'=>Yii::$app->user->identity->id])->orwhere(['user_two_id'=>Yii::$app->user->identity->id])->all();




foreach($unread_cons as $unread_con)
{

   // echo $unread_con->conversation_id. "vvvv" ;
  
  $records = Reply::find()->where(['conversation_id'=>$unread_con->conversation_id ,'status'=>'0' ])->all();


foreach($records as $record)
{


array_push($unseens,$record);
//echo "vvvvvvvvvv".$record->message."VVVVVVVVVVVV" ;

}



}


//foreach($unseens as $unseen)
//{
  //echo $unseen['message'];

//}



return $this->render('unread', [
            'unseens' => $unseens,
        ]);


       }
    


    /**
     * Lists all Reply models.
     * @return mixed
     */
    public function actionIndex1($chatid)
    {
       // $searchModel = new ReplySearch();

        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        //return $this->render('index', [
          //  'searchModel' => $searchModel,
           // 'dataProvider' => $dataProvider,
        //]);



 $model = new Reply();

        if ($model->load(Yii::$app->request->post()) && $model->save())
         {
            return $this->redirect(['view', 'id' => $model->cm_id]);
        


        } 


        else

         {







$query1 = conversation::find()->where(['user_one_id'=>'4','user_two_id'=>'6'])->one();

        if(!$query1)
        {
         $query1 = conversation::find()->where(['user_one_id'=>'4','user_two_id'=>'6'])->one();
        
        }



$querys = Reply::find()->where(['conversation_id'=>$query1->conversation_id])->all();
            


return $this->render('index1', [
             'model' => $model,
            'querys' => $querys,
            'chatid'=> $chatid,
        ]);




//            return $this->render('create', 
  //              [
    //            'model' => $model,
      //      ]);
        }









            //echo $query1->conversation_id;


    }

    /**
     * Displays a single Reply model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Reply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($con_user)
    {


        $model = new Reply();

          
          $model->user_id_message = Yii::$app->user->identity->id;

           $con_id = Reply::getcon($con_user);

    $model->conversation_id = $con_id;
      
        if ($model->load(Yii::$app->request->post()) && $model->save())
         {
            //return $this->redirect(['view', 'id' => $model->cm_id]);
        
    $query1 = conversation::find()->where(['user_one_id'=>Yii::$app->user->identity->id ,'user_two_id'=>$con_user])->one();

        if(!$query1)
        {
         $query1 = conversation::find()->where(['user_one_id'=>$con_user,'user_two_id'=>Yii::$app->user->identity->id])->one();
        
        }



$querys = Reply::find()->where(['conversation_id'=>$query1->conversation_id])->all();
            
            return $this->render('create', [
                'model' => $model,
                'chatid' => $con_user ,
                'querys' => $querys
            ]);


        }

         else
          {


$query1 = conversation::find()->where(['user_one_id'=>Yii::$app->user->identity->id ,'user_two_id'=>$con_user])->one();

        if(!$query1)
        {
         $query1 = conversation::find()->where(['user_one_id'=>$con_user,'user_two_id'=>Yii::$app->user->identity->id])->one();
        
        }


$querys = Reply::find()->where(['conversation_id'=>$query1->conversation_id])->all();
            
            return $this->render('create', [
                'model' => $model,
                'chatid' => $con_user ,
                'querys' => $querys
            ]);


        }
    }

    /**
     * Updates an existing Reply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */


 

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cm_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Reply model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
