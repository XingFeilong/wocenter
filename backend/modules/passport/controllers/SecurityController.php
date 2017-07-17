<?php
namespace wocenter\backend\modules\passport\controllers;

use wocenter\core\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * 通行证安全控制器
 *
 * @author E-Kevin <e-kevin@qq.com>
 */
class SecurityController extends Controller
{

    const CAPTCHA_LENGTH_MIN = 4;
    const CAPTCHA_LENGTH_MAX = 5;

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'padding' => 0,
                'minLength' => self::CAPTCHA_LENGTH_MIN,
                'maxLength' => self::CAPTCHA_LENGTH_MAX,
            ],
        ];
    }

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
                        'actions' => [
                            'find-password',
                            'find-password-successful',
                            'captcha',
                            'reset-password',
                            'activate-user',
                            'activate-account',
                            'send-verify',
                        ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'send-verify' => ['post'],
                    'change-password' => ['post'],
                ],
            ],
        ];
    }

    /**
     * 找回密码
     *
     * @return mixed
     */
    public function actionFindPassword()
    {
        return $this->runDispatch();
    }

    /**
     * 找回密码成功
     *
     * @return mixed
     */
    public function actionFindPasswordSuccessful()
    {
        return $this->runDispatch();
    }

    /**
     * 重置密码
     *
     * @return mixed
     */
    public function actionResetPassword()
    {
        return $this->runDispatch();
    }

    /**
     * 激活用户
     *
     * @return mixed
     */
    public function actionActivateUser()
    {
        return $this->runDispatch();
    }

    /**
     * 激活账户
     *
     * @return mixed
     */
    public function actionActivateAccount()
    {
        return $this->runDispatch();
    }

    /**
     * 发送验证码
     *
     * @return mixed
     */
    public function actionSendVerify()
    {
        return $this->runDispatch();
    }

    /**
     * 更改用户密码
     *
     * @return mixed
     */
    public function actionChangePassword()
    {
        return $this->runDispatch();
    }

}
