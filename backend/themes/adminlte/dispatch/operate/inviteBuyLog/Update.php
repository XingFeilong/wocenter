<?php
namespace wocenter\backend\themes\adminlte\dispatch\operate\inviteBuyLog;

use wocenter\backend\modules\operate\models\InviteBuyLog;
use wocenter\backend\themes\adminlte\components\Dispatch;
use wocenter\traits\LoadModelTrait;
use Yii;

/**
 * Class Update
 *
 * @package wocenter\backend\themes\adminlte\dispatch\operate\inviteBuyLog
 */
class Update extends Dispatch
{

    use LoadModelTrait;

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\NotFoundHttpException
     */
    public function run()
    {
        /** @var InviteBuyLog $model */
        $model = $this->loadModel(InviteBuyLog::className(), $this->_params['id']);
        $request = Yii::$app->getRequest();

        if ($request->getIsPost()) {
            if ($model->load($request->getBodyParams()) && $model->save()) {
                $this->success($model->message, ["/{$this->controller->getUniqueId()}"], 2);
            } else {
                $this->error($model->message);
            }
        }

        return $this->assign([
            'model' => $model,
        ])->display();
    }

}