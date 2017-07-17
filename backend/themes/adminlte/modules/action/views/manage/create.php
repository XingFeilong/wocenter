<?php
/* @var $this yii\web\View */
/* @var $model \wocenter\backend\modules\action\models\Action */

$this->title = '新增行为';
$this->params['breadcrumbs'][] = ['label' => '行为列表', 'url' => ['/action']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['navSelectPage'] = '/action';
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>