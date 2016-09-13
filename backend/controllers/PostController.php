<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\web\User;

class PostController extends \yii\web\Controller
{
    public function actionIndex(){

    	 $query = Post::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $posts = $query->orderBy('title')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'posts' => $posts,
            'pagination' => $pagination,
        ]);
        //return $this->render('index');
    }
    public function actionCreate_post(){

        if (Yii::$app->user->isGuest) {

            Yii::$app->session->setFlash('notlogin', 'Please Loging!');
             return Yii::$app->getResponse()->redirect(array('/post/index'));

        }else{

                    $model = new Post();

                    if ($model->load(Yii::$app->request->post())) {
                    	 //print_r(Yii::$app->session);
                        if ($model->validate()) {
                        	$model->author_id = Yii::$app->user->id;
                            $model->status = 2 ;
                        	$model->save();
                             /*$model->username = $this->username;
                             $model->email = $this->email;
                             $model->setPassword($this->password);
                             $model->generateAuthKey();*/

                            Yii::$app->session->setFlash('success', 'Successfully Post Created!');
                             return Yii::$app->getResponse()->redirect(array('/post/index'));
                        }
                    }else{
                            return $this->render('create_post', [
                                'model' => $model,
                            ]);
                        }
            }
 
    }


    public function actionApprove($id)
    {
        //$model = new Post();
        $model = Post::find()->where(['id' => $id])->one();
       // $model = $this->findModel($id);
        /*echo "<pre>";
        print_r($model);
        echo "</pre>";*/
        $model->status = 2 ;
        $model->save();
        Yii::$app->session->setFlash('approve', 'Successfully Post Approved!');
         return Yii::$app->getResponse()->redirect(array('/post/index'));
    }
    public function actionUnapprove($id)
    {
        //$model = new Post();
        $model = Post::find()->where(['id' => $id])->one();
       // $model = $this->findModel($id);
        /*echo "<pre>";
        print_r($model);
        echo "</pre>";*/
        $model->status = 1 ;
        $model->save();
        Yii::$app->session->setFlash('unapprove', 'Successfully Post Unapproved!');
         return Yii::$app->getResponse()->redirect(array('/post/index'));
    }
    public function actionDelete($id)
    {  
        $model = Post::find()->where(['id' => $id])->one();
        $model->delete();
        Yii::$app->session->setFlash('delete', 'Successfully Post Delete!');
         return Yii::$app->getResponse()->redirect(array('/post/index'));
    }

}
