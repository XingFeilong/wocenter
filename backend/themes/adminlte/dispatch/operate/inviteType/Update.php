<?php
namespace wocenter\backend\themes\adminlte\dispatch\operate\inviteType;

use wocenter\backend\modules\account\models\Identity;
use wocenter\backend\modules\data\models\UserScoreType;
use wocenter\backend\modules\operate\models\InviteType;
use wocenter\backend\themes\adminlte\components\Dispatch;
use wocenter\traits\LoadModelTrait;
use Yii;

/**
 * Class Update
 *
 * @package wocenter\backend\themes\adminlte\dispatch\operate\inviteType
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
        /** @var InviteType $model */
        $model = $this->loadModel(InviteType::className(), $this->_params['id']);
        $request = Yii::$app->getRequest();

        if ($request->getIsPost()) {
            if ($model->load($request->getBodyParams()) && $model->save()) {
                $this->success($model->message, ["/{$this->controller->getUniqueId()}"]);
            } else {
                $this->error($model->message);
            }
        }

        return $this->assign([
            'model' => $model,
            'scoreList' => (new UserScoreType())->getSelectList(), // 积分列表
            'inviteIdentityList' => (new Identity())->getSelectList(['is_invite' => 1]), // 可邀请注册的身份列表
        ])->display();
    }

}
