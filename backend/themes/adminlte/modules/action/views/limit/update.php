<?php
/* @var $this yii\web\View */
/* @var $model \wocenter\backend\modules\action\models\ActionLimit */
/* @var $actionList array */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '行为限制列表', 'url' => ['/action/limit']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['navSelectPage'] = '/action/limit';
?>


<?=
$this->render('_form', [
    'model' => $model,
    'actionList' => $actionList,
]) ?>