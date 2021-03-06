<?php
namespace wocenter\backend\modules\account\controllers;

use wocenter\backend\core\Controller;
use yii\filters\VerbFilter;

/**
 * IdentityUserController implements the CRUD actions for UserIdentity model.
 */
class IdentityUserController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'active' => ['post'],
                    'forbidden' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all IdentityGroup models.
     *
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        return $this->runDispatch();
    }

    public function actionSearch()
    {
        return $this->runDispatch();
    }

}
