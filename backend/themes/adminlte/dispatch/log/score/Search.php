<?php
namespace wocenter\backend\themes\adminlte\dispatch\log\score;

use wocenter\backend\modules\data\models\UserScoreType;
use wocenter\backend\modules\log\models\UserScoreLogSearch;
use wocenter\backend\themes\adminlte\components\Dispatch;
use wocenter\libs\Constants;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Search
 *
 * @package wocenter\backend\themes\adminlte\dispatch\log\score
 */
class Search extends Dispatch
{

    public function run()
    {
        $searchModel = new UserScoreLogSearch();
        $searchModel->load(Yii::$app->getRequest()->getQueryParams());

        return $this->assign([
            'model' => $searchModel,
            'action' => ['index'],
            'typeList' => ArrayHelper::merge([Constants::UNLIMITED => Yii::t('wocenter/app', 'Unlimited')], (new UserScoreType())->getSelectList()),
            'actionList' => ArrayHelper::merge([Constants::UNLIMITED => Yii::t('wocenter/app', 'Unlimited')], $searchModel->actionList)
        ])->display('_search');
    }

}
