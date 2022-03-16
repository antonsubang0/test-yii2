<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\ContactForm $model */

use app\models\Companies;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

$company = Companies::find()->all();
$listData = ArrayHelper::map($company, 'id_company', 'name_company');

$this->title = 'Create Employer';
$this->params['breadcrumbs'][] = ['label' => 'Employer', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Create';
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        Please insert your employer into my database.
    </p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'employer-form']); ?>

            <?= $form->field($model, 'first_name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'last_name') ?>

            <?= $form->field($model, 'id_company')->dropDownList(
                $listData,
                ['prompt' => 'Select...']
            ); ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'phone')->textInput([
                'type' => 'number'
            ]) ?>
            <?= $form->field($model, 'join_date')->widget(
                DatePicker::className(),
                ['dateFormat' => 'dd-MM-yyyy', 'options' => ['class' => 'form-control']],
            )
            ?>

            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>