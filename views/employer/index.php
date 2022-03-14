<?php

/** @var yii\web\View $this */

use app\models\Companies;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'List Company';
$this->params['breadcrumbs'][] = ['label' => 'Company', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'List';
?>
<div class="site-about">
    <div class="d-flex flex-direction-row justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('Create', ['/company/create'], ['class' => 'btn btn-primary d-flex align-items-center px-3']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name_company',
            'email_company:email',
            [
                'attribute' => 'logo_company',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(
                        '/uploads/' . $data['logo_company'],
                        ['width' => '60px']
                    );
                },

            ],
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