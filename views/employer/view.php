<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Companies */

$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Employer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="companies-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_employer' => $model->id_employer], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_employer' => $model->id_employer], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'last_name',
            [
                'label' => 'Full Name',
                'attribute' => 'first_name',
                'value' => function ($model) {
                    return  $model->fullName;
                },

            ],
            'email:email',
            'phone',
            [

                'attribute' => 'id_company',
                'value' => function ($model) {
                    if ($model->company) return $model->company->name_company;
                },

            ],
        ],
    ]) ?>

</div>