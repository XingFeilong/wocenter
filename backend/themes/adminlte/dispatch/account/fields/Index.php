<?php
namespace wocenter\backend\themes\adminlte\dispatch\account\fields;

use wocenter\backend\modules\account\models\ExtendFieldSettingSearch;
use wocenter\backend\modules\account\models\ExtendProfile;
use wocenter\backend\themes\adminlte\components\Dispatch;
use wocenter\Wc;
use Yii;

/**
 * Class Index
 *
 * @package wocenter\backend\themes\adminlte\dispatch\account\fields
 */
class Index extends Dispatch
{

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $searchModel = new ExtendFieldSettingSearch();
        $dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());

        if ($searchModel->message) {
            $this->error($searchModel->message, '', 2);
        }

        return $this->assign([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'profileId' => $this->_params['profile_id'],
            'profileName' => ExtendProfile::find()->where('id = :id', [
                ':id' => $this->_params['profile_id'],
            ])->select('profile_name')->scalar(),
            'formTypeList' => Wc::$service->getSystem()->getConfig()->extra('CONFIG_TYPE_LIST'),
        ])->display();
    }

}
