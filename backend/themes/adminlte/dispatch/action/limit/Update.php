<?php
namespace wocenter\backend\themes\adminlte\dispatch\action\limit;

use wocenter\backend\modules\action\models\Action;
use wocenter\backend\modules\action\models\ActionLimit;
use wocenter\backend\themes\adminlte\components\Dispatch;
use wocenter\traits\LoadModelTrait;
use Yii;

/**
 * Class Update
 *
 * @package wocenter\backend\themes\adminlte\dispatch\action\limit
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
        /** @var ActionLimit $model */
        $model = $this->loadModel(ActionLimit::className(), $this->_params['id']);
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
            'actionList' => (new Action())->getSelectList('name', 'title'),
        ])->display();
    }

}
