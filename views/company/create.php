<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = 'Company';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <?= Html::a('Back', ['/company/create'], ['class' => 'btn btn-primary']) ?>

    <?php else : ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            Please insert your company into my database.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'company-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'name_company')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email_company') ?>

                <?= $form->field($model, 'logo_company')->fileInput() ?>

                <?= $form->field($model, 'website_company')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>