<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\ContactForm $model */

use app\models\Companies;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;

$company = Companies::find()->all();
$listData = ArrayHelper::map($company, 'id_company', 'name_company');

$this->title = 'Update Employer';
$this->params['breadcrumbs'][] = ['label' => 'Employer', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="site-contact">

    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <?= Html::a('Back', ['/employer/create'], ['class' => 'btn btn-primary']) ?>

    <?php else : ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            Please insert your employer into my database.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['action' => ['employer/store'], 'id' => 'company-form']); ?>

                <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'last_name') ?>

                <?= $form->field($model, 'id_company')->dropDownList(
                    $listData,
                    ['prompt' => 'Select...']
                ); ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'phone') ?>

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