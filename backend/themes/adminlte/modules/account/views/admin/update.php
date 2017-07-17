<?php
/* @var $this yii\web\View */
/* @var $model \wocenter\models\BackendUser */

$this->title = '更新管理员';
$this->params['breadcrumbs'][] = ['label' => '管理员列表', 'url' => ['/account/admin']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['navSelectPage'] = '/account/admin';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>