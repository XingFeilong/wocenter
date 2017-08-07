<?php
namespace wocenter\backend\themes\adminlte\dispatch\menu\category;

use wocenter\backend\modules\menu\models\MenuCategorySearch;
use wocenter\backend\themes\adminlte\components\Dispatch;
use Yii;

/**
 * Class Index
 *
 * @package wocenter\backend\themes\adminlte\dispatch\menu\category
 */
class Index extends Dispatch
{

    /**
     * @return string|\yii\web\Response
     */
    public function run()
    {
        $searchModel = new MenuCategorySearch();
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
