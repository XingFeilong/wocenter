<?php
namespace wocenter\backend\themes\adminlte\dispatch\operate\inviteLog;

use wocenter\backend\modules\operate\models\InviteLogSearch;
use wocenter\backend\themes\adminlte\components\Dispatch;
use Yii;

/**
 * Class Index
 *
 * @package wocenter\backend\themes\adminlte\dispatch\operate\inviteLog
 */
class Index extends Dispatch
{

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $searchModel = new InviteLogSearch();
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
