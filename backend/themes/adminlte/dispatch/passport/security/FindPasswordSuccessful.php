<?php
namespace wocenter\backend\themes\adminlte\dispatch\passport\security;

use wocenter\backend\themes\adminlte\components\Dispatch;
use Yii;

/**
 * Class FindPasswordSuccessful
 *
 * @package wocenter\backend\themes\adminlte\dispatch\passport\security
 */
class FindPasswordSuccessful extends Dispatch
{

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        if (!Yii::$app->getUser()->getIsGuest()) {
            return $this->controller->goHome();
        }

        $cookie_email = Yii::$app->getRequest()->getCookies()->getValue('_findPwByEmail');
        if (empty($cookie_email)) {
            return $this->controller->redirect('find-password');
        }

        return $this->assign('email', $cookie_email) ->display();
    }

}
