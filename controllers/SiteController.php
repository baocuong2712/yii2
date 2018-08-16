<?php

namespace app\controllers;


use app\components\BaseController;
use Yii;
use yii\filters\AccessControl;
use yii\web\Cookie;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\SignupForm;

class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $imageSource = 'holdback-350x150.jpg';
        $imageName = 'Hidden';
        if (isset($_POST['imageName']) && isset($_FILES['imageSource']) && isset($_FILES['imageSource']['name'])) {
            $imageName = $_POST['imageName'];
            $imageSource = $_FILES['imageSource']['name'];
        }
        return $this->render('index', ['imageName' => $imageName, 'imageSource' => $imageSource]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user_id = Yii::$app->user->id;
            if (Yii::$app->user->identity->role == 3){
                return $this->redirect(['reservations/index']);
            } else if (Yii::$app->user->identity->role == 2) {
                return $this->redirect(['rooms/index']);
            } else {
                return $this->redirect(['users/index']);
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
            return $this->render('signup', ['model' => $model]);
        }

        $model->password = '';
        return $this->render('signup', [
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionSay($message = 'Hello')
    {
        return $this ->render('say',['message'=>$message]);
    }

    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->render('entry-confirm', ['model' => $model]);
        } else {

        }
        return $this->render('entry', ['model' => $model]);
    }

    public function actionLanguage()
    {
        if (isset($_POST['lang'])) {
            Yii::$app->language = $_POST['lang'];
            $cookie = new Cookie([
                'name' => 'lang',
                'value' => $_POST['lang']
            ]);
            Yii::$app->getResponse()->getCookies()->add($cookie);
        }

//        $lang = Yii::$app->getRequest()->getCookies()->getValue('lang');
//        return json_encode(['lang' => $lang]);
    }

    public function actionGetEditedImage()
    {
        if (isset($_POST['imageName']) && isset($_POST['imageSource'])) {
            $imageName = $_POST['imageName'];
            $imageSource = $_POST['imageSource'];
            return $this->render('index', ['imageName' => $imageName, 'imageSource' => $imageSource]);
        }
    }
}
