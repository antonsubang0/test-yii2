<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Companies */

$this->title = $model->name_company;
$this->params['breadcrumbs'][] = ['label' => 'Company', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="companies-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_company' => $model->id_company], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_company' => $model->id_company], [
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
        ],
    ]) ?>

</div>