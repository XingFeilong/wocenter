<?php
namespace wocenter\backend\themes\adminlte\dispatch\menu\detail;

use wocenter\backend\modules\menu\models\Menu;
use wocenter\backend\modules\menu\models\MenuCategory;
use wocenter\backend\themes\adminlte\components\Dispatch;
use wocenter\Wc;
use Yii;

/**
 * Class Create
 *
 * @package wocenter\backend\themes\adminlte\dispatch\menu\detail
 */
class Create extends Dispatch
{

    /**
     * @return string|\yii\web\Response
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        $model = new Menu();
        $category = $this->_params['category'];
        $pid = $this->_params[$model->breadcrumbParentParam];
        $request = Yii::$app->getRequest();

        // 所选分类是否存在
        $category_name = MenuCategory::find()->select('name')->where(['id' => $category])->scalar();
        if (empty($category_name)) {
            $this->error('所选分类不存在');
        }

        $model->loadDefaultValues();
        $model->category_id = $category;
        $model->parent_id = $pid;

        if (Yii::$app->getRequest()->getIsPost()) {
            if ($model->load($request->getBodyParams()) && $model->save()) {
                $this->success($model->message, [
                    "/{$this->controller->getUniqueId()}",
                    'category' => $category,
                    $model->breadcrumbParentParam => $model->parent_id ?: null,
                ]);
            } else {
                $this->error($model->message);
            }
        }

        $breadcrumbs = $model->getBreadcrumbs(
            $model->parent_id,
            $category_name,
            '/menu/detail',
            ['category' => $model->category_id],
            [
                -1 => ['label' => '菜单管理', 'url' => ['/menu']],
            ],
            ['新增菜单']
        );
        $menuList = Wc::$service->getMenu()->getMenus($model->category_id);

        return $this->assign([
            'model' => $model,
            'menuList' => $model->getTreeSelectList($menuList),
            'breadcrumbs' => $breadcrumbs,
            'title' => end($breadcrumbs),
        ])->display();
    }

}
