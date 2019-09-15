<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Apple;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','generate','eat','test','eatdelete','falltoground'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','generate','eat','falltoground'],
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
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
     		return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    { 
        if (!Yii::$app->user->isGuest) {
           return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
// создать массив €блок
	public function actionGenerate() {
		$model=new Apple();
		$model->generate();
	//	$m=$model->getAll();
		return $this->render('index',['model' => $model,]);
	}

	// окусить  €блокo
	public function actionEat() {
		$model=Apple::findOne($_REQUEST['id']);
		if($model){
			$model->eat=$model->eat - $_REQUEST['eat'];
			if($model->eat>0)
				$model->save();
			else $model->delete();
		}
		return $this->render('index');
	}
	//удалить €блоко
	public function actionEatdelete() {
		$model=Apple::findOne($_REQUEST['id']);
		if($model){
			$model->delete();
		}
		return $this->render('index');
	}
	// сорвать
	public function actionFalltoground() {
		$model=Apple::findOne($_REQUEST['id']);
		if($model){
			$model->status=2;
			$model->date0=time();
			$model->save();
		}
		return $this->render('index');
	}
}
