<?php
namespace wocenter\backend\themes\adminlte\dispatch\operate\inviteUserInfo;

use wocenter\backend\modules\operate\models\InviteUserInfoSearch;
use wocenter\backend\themes\adminlte\components\Dispatch;
use Yii;

/**
 * Class Index
 *
 * @package wocenter\backend\themes\adminlte\dispatch\operate\inviteUserInfo
 */
class Index extends Dispatch
{

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $searchModel = new InviteUserInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());
        if ($searchModel->message) {
            $this->error($searchModel->message, '', 2);
        }

        return $this->assign([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ])->display();
    }

}
