<?php

/** @var yii\web\View $this */

use app\models\Companies;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name_company',
            'email_company:email',
            'logo_company',
            'website_company',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Companies $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_company' => $model->id_company]);
                }
            ],
        ],
    ]); ?>
</div>