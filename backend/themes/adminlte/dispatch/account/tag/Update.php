<?php
namespace wocenter\backend\themes\adminlte\dispatch\account\tag;

use wocenter\backend\modules\account\models\Tag;
use wocenter\backend\themes\adminlte\components\Dispatch;
use wocenter\traits\LoadModelTrait;
use Yii;

/**
 * Class Update
 *
 * @package wocenter\backend\themes\adminlte\dispatch\account\tag
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
        /** @var Tag $model */
        $model = $this->loadModel(Tag::className(), $this->_params['id']);
        $request = Yii::$app->getRequest();

        if ($request->getIsPost()) {
            if ($model->load($request->getBodyParams()) && $model->save()) {
                $this->success($model->message, [
                    "/{$this->controller->getUniqueId()}",
                    'pid' => $model->parent_id
                ]);
            } else {
                $this->error($model->message);
            }
        }

        $breadcrumbs = $model->getBreadcrumbs($model->id, '标签列表', '/account/tag');

        return $this->assign([
            'model' => $model,
            'tagList' => $model->getTreeSelectList($model->getList()),
            'breadcrumbs' => $breadcrumbs,
            'title' => $breadcrumbs[$model->id]['label'],
        ])->display();
    }

}
