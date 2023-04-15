<?php

namespace app\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\User;
use app\models\PostModel;
use app\models\CommentModel;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $posts = new ActiveDataProvider([
            'query' => PostModel::find(),
            'pagination' => false,
        ]);

        return $this->render('index',[
            'posts' => $posts
        ]);
    }

    public function actionPostsManage()
    {
        $posts = new ActiveDataProvider([
            'query' => PostModel::find(),
            'pagination' => false,
        ]);

        $model = new PostModel();

        if (Yii::$app->request->post()) {
            $id = Yii::$app->request->post()['id'];
            PostModel::find()->where(['id'=>$id])->one()->delete();
            return $this->redirect('posts-manage');
        }
        return $this->render('postsAdmin',[
            'posts' => $posts,
            'model' => $model,
        ]);
    }

    public function actionAddPost()
    {
        $model = new PostModel();

        if ($model->load(Yii::$app->request->post())) {
            $cookies = Yii::$app->request->cookies;
            $model->username = $cookies->getValue('user');
            if ($model->validate()) {
                $model->save(false);

                header("location:" . __FILE__);
                return $this->redirect('posts-manage');
            }
        }

        return $this->render('addPost',[
            'model' => $model,
        ]);
    }

    public function actionComments()
    {
        $post_id = Yii::$app->getRequest()->getQueryParam('post_id');
        $post = PostModel::find()->where(['id'=>$post_id])->one();
        $model = new CommentModel();
        $comments = CommentModel::find()->where(['post'=>$post_id])->all();

        if ($model->load(Yii::$app->request->post())) {
            $cookies = Yii::$app->request->cookies;
            $model->username = $cookies->getValue('user');
            $model->post = $post_id;

            if ($model->validate()) {
                $model->save(false);
                return $this->redirect("comments?post_id=$post_id");
            }
        }

        return $this->render('comments',[
            'post' => $post,
            'model' => $model,
            'comments' => $comments,
        ]);
    }

    public function actionRegister()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->roleID = 1;
                $model->save(false);
                $cookies = Yii::$app->response->cookies;

                $cookies->add(new \yii\web\Cookie([
                    'name' => 'user',
                    'value' => $model->username,
                ]));

                $cookies->add(new \yii\web\Cookie([
                    'name' => 'roleID',
                    'value' => $model->roleID,
                ]));
                return $this->goHome();
            }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        $model = new User();

        if($model->load(Yii::$app->request->post())){
            if(User::find()->where(['email' => $model->email, 'password' => $model->password])->exists()){
                $cookies = Yii::$app->response->cookies;
                $cookies->remove('loginError');
                $user = User::find()->where(['email' => $model->email, 'password' => $model->password])->one();

                $cookies->add(new \yii\web\Cookie([
                    'name' => 'user',
                    'value' => $user->username,
                ]));

                $cookies->add(new \yii\web\Cookie([
                    'name' => 'roleID',
                    'value' => $user->roleID,
                ]));
                return $this->goHome();
            }else{
                $cookies = Yii::$app->response->cookies;
                $cookies->add(new \yii\web\Cookie([
                    'name' => 'loginError',
                    'value' => 'There is no such an user!',
                ]));
            }
        }

        return $this->render('login',[
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        $cookies = Yii::$app->response->cookies;
        $cookies->remove('user');
        $cookies->remove('roleID');
        return $this->redirect('index');
    }
}
