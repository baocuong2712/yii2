<?php
/**
 * Created by PhpStorm.
 * User: vanthu-cominit
 * Date: 8/2/2018
 * Time: 10:52 AM
 */
namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class MyAuthenticationController extends Controller {
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['public-page', 'private-page'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['public-page'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['private-page'],
                        'roles' => ['@']
                    ]
                ],
                // Callable function when user is denied
                'denyCallback' => function($rule, $data) {
                    $this->redirect(['login']);
                }
            ]
        ];
    }

    public function actionLogin() {
        $error = null;

        $username = Yii::$app->request->post('username', null);
        $password = Yii::$app->request->post('password', null);

        $user = User::findOne(['username' => $username]);

        if ($username != null && $password != null) {
            if ($user != null) {
                if ($user->validatePassword($password)) {
                    Yii::$app->user->login($user);
                } else {
                    $error = 'Password validation failed!';
                }
            } else {
                $error = "User not found";
            }
        }

        return $this->render('login', ['error' => $error]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['login']);
    }

    public function actionLoginWithForm() {
        $error = null;
        $model = new \app\models\LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            // Unkown this code.
            if(($model->validate())&&($model->user != null))
            {
                Yii::$app->user->login($model->user);
            }
            else
            {
                $error = 'Username/Password error';
            }
        }
        return $this->render('login-with-model', ['model' => $model, 'error' => $error]);
    }

    public function actionInitializeAuthorizations()
    {
        $auth = Yii::$app->authManager;
        // Reset all
        $auth->removeAll();
        // add "createReservation" permission
        $permCreateReservation = $auth->createPermission('createReservation');
        $permCreateReservation->description = 'Create a reservation';
        $auth->add($permCreateReservation);

        // add "updatePost" permission
        $permUpdateReservation = $auth->createPermission('updateReservation');
        $permUpdateReservation->description = 'Update reservation';
        $auth->add($permUpdateReservation);

        // add "operator" role and give this role the "createReservation" permission
        $roleOperator = $auth->createRole('operator');
        $auth->add($roleOperator);
        $auth->addChild($roleOperator, $permCreateReservation);

        // add "admin" role and give this role the "updateReservation" permission
        // as well as the permissions of the "operator" role
        $roleAdmin = $auth->createRole('admin');
        $auth->add($roleAdmin);
        $auth->addChild($roleAdmin, $permUpdateReservation);
        $auth->addChild($roleAdmin, $roleOperator);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($roleOperator, 2);
        $auth->assign($roleAdmin, 1);
    }
}