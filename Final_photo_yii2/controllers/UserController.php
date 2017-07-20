<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;

use app\models\About;
use app\models\userSearch;
use app\models\ProfilePicture;
use app\models\Photograph;
use app\models\LoginForm;
use yii\data\pagination;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


class UserController extends \yii\web\Controller
{



public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['timeline','login'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login','index'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['timeline','login','index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }




public function actionProfile($userid)
{



if($userid == Yii::$app->user->identity->id)
{

   return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');
}


  $query = Photograph::find()->where(['user_id' => $userid]);
    $countQuery = clone $query;
    $pagination = new Pagination([ 'defaultPageSize'=> 3, 'totalCount' => $countQuery->count()]);
    $posts = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

    return $this->render('search_user_profile', [
         'posts' => $posts,
         'pagination' => $pagination,
         'user_id' => $userid,
    ]); 



}







public function actionIndex()
    {

 if (Yii::$app->user->isGuest) 
         {


            return $this->redirect('/Final_photo_yii2/web/index.php?r=user/login');
          //  return $this->goHome();
          //  $this->redirect('/Final_photo_yii2/web/index.php?r=user/login');
        }
 $searchModel = new userSearch();
        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

}



public function actionHome()
    {

 
      $query = Photograph::find()->where(['p_status'=>'public']);
    $countQuery = clone $query;
    $pagination = new Pagination([ 'defaultPageSize'=> 3, 'totalCount' => $countQuery->count()]);
    $posts = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

    return $this->render('home', [
         'posts' => $posts,
         'pagination' => $pagination,
         'user_id' => Yii::$app->user->identity->id,
    ]);  

}









public function actionTimeline()
    {

    //    Customer::find()
    //->where(['status' => 1])
   // ->orderBy('age')
    //->all();

      $query = Photograph::find()->where(['user_id' => Yii::$app->user->identity->id]);
    $countQuery = clone $query;
    $pagination = new Pagination([ 'defaultPageSize'=> 3, 'totalCount' => $countQuery->count()]);
    $posts = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

    return $this->render('timeline', [
         'posts' => $posts,
         'pagination' => $pagination,
         'user_id' => Yii::$app->user->identity->id,
    ]);  

/*$query = Photograph::find()->where(['user_id'=> '4'])->orderBy('user_id')->all();
        $pagination = new pagination([
            'defaultPageSize'=> 3,
            'totalCount'=> 6,
            ]);

       $posts = $query->offset($pagination->offset)->limit($pagination->limit);


        return $this->render('home',[
          'posts' => $posts ,
          'pagination' => $pagination, 
            ]);

*/


     /*$posts =  Photograph::find()->where(['user_id'=> '4'])->all();

      $pagination = new pagination([
            'defaultPageSize'=> 3,
            'totalCount'=> 6,
            ]);*/


// $posts = $query->offset($pagination->offset)->limit($pagination->limit)->all();
                  
   //  return $this->render('home.php' , ['posts' => $posts , 'pagination'=> $pagination,]);

/*
$query = Category::find();
        $pagination = new pagination([
            'defaultPageSize'=> 20,
            'totalCount'=> $query->count(),
            ]);

       $categories = $query->orderBy('name')->offset($pagination->offset)->limit($pagination->limit)->all();


        return $this->render('index',[
          'categories' => $categories ,
          'pagination' => $pagination, 
            ]);

*/

     }


    public function actionLogin()
    {
         if (!Yii::$app->user->isGuest) 
         {


            return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');
          //  return $this->goHome();
          //  $this->redirect('/Final_photo_yii2/web/index.php?r=user/login');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) 
        {
            //return $this->goBack();
            return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');
        }
        return $this->render('login', [
            'model' => $model,
        ]);


//        return $this->render('login');
    }


    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) 
        {
            return $this->redirect('/Final_photo_yii2/web/index.php?r=user/timeline');
        }


        $user = new User();





    if ($user->load(Yii::$app->request->post())) {
        if ($user->validate()) 
        {


//$id = $user->user_id

            $user->save();

 //$about = new About();

  //     $about->user_id = $user->user_id;

      

    //   $query = Photograph::find()->where(['user_id' => $userid]);





      // $about->date_of_birth = $user->date_of_birth;
       //$about->save();

            // form inputs are valid, do something here

            return $this->redirect('/Final_photo_yii2/web/index.php?r=user/login');
        }
    }

    return $this->render('register', [
        'user' => $user,
    ]);

    }




public function actionTimeline1()
    {

    $model = new userSearch();

    if ($model->load(Yii::$app->request->post()))
     {
        if ($model->validate())
         {
        

          $persons = $model->getFriend();

            // form inputs are valid, do something here
        
        return $this->render('searchFriend', [
        'model' => $model,
        'persons' => $persons,
    ]);


        }



    }

    $persons = $model->getFriend();

    return $this->render('searchFriend', [
        'model' => $model,
        'persons' => $persons,
    ]);
}








}
