<?php
namespace wocenter\backend\themes\adminlte\dispatch\menu\detail;

use wocenter\backend\modules\menu\models\MenuCategory;
use wocenter\backend\modules\menu\models\MenuSearch;
use wocenter\backend\themes\adminlte\components\Dispatch;
use Yii;

/**
 * Class Index
 *
 * @package wocenter\backend\themes\adminlte\dispatch\menu\detail
 */
class Index extends Dispatch
{

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->getRequest()->getQueryParams());

        if ($searchModel->message) {
            $this->error($searchModel->message, '', 2);
        }

        $category = $this->_params['category'];
        $pid = $this->_params[$searchModel->breadcrumbParentParam];
        $categoryName = MenuCategory::find()->select('name')->where(['id' => $category])->scalar();
        $breadcrumbs = $searchModel->getBreadcrumbs(
            $pid,
            $categoryName,
            '/menu/detail',
            ['category' => $category],
            [
                -1 => ['label' => '菜单管理', 'url' => ['/menu']],
            ]
        );

        return $this->assign([
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category,
            'pid' => $pid,
            'breadcrumbs' => $breadcrumbs,
            'title' => $breadcrumbs[$pid]['label'],
        ])->display();
    }

}
