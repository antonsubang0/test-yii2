<?php

use app\models\Employer;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'List Employer';
$this->params['breadcrumbs'][] = ['label' => 'Employer', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'List';
?>
<div class="site-about">
    <div class="d-flex flex-direction-row justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('Create', ['/employer/create'], ['class' => 'btn btn-primary d-flex align-items-center px-3']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'first_name',
            'last_name',
            [
                'label' => 'Full Name',
                'attribute' => 'first_name',
                'value' => 'fullName'

            ],
            'email',
            'phone',
            [

                'attribute' => 'id_company',
                'value' => 'company.name_company'

            ],
            'join_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Employer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_employer' => $model->id_employer]);
                }
            ],
        ],
    ]); ?>
</div>