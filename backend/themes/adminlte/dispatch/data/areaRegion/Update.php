<?php
namespace wocenter\backend\themes\adminlte\dispatch\data\areaRegion;

use wocenter\backend\modules\data\models\AreaRegion;
use wocenter\backend\themes\adminlte\components\Dispatch;
use wocenter\traits\LoadModelTrait;
use Yii;

/**
 * Class Update
 *
 * @package wocenter\backend\themes\adminlte\dispatch\data\areaRegion
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
        /** @var AreaRegion $model */
        $model = $this->loadModel(AreaRegion::className(), $this->_params['id']);
        $request = Yii::$app->getRequest();

        if ($request->getIsPost()) {
            if ($model->load($request->getBodyParams()) && $model->save()) {
                $this->success($model->message, [
                    "/{$this->controller->getUniqueId()}",
                    $model->breadcrumbParentParam => $model->parent_id,
                ]);
            } else {
                $this->error($model->message);
            }
        }

        $breadcrumbs = $model->getBreadcrumbs($model->region_id, '区域管理', '/data/area-region');

        return $this->assign([
            'model' => $model,
            'areaSelectList' => $model->getTreeSelectList($model->getAll()),
            'breadcrumbs' => $breadcrumbs,
            'title' => $breadcrumbs[$model->region_id]['label'],
        ])->display();
    }

}
