<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model gm\humhub\modules\effects\models\Configuration */

$this->title = Yii::t('EffectsModule.base', 'Effects Settings');
$this->params['breadcrumbs'][] = $this->title;

// Define available effects
$effectOptions = [
    'enableSakuraFall' => Yii::t('EffectsModule.base', 'Sakura Fall'),
    'enableSnowfall' => Yii::t('EffectsModule.base', 'Snowfall'),
    'enableLeaffall' => Yii::t('EffectsModule.base', 'Leaf Fall'),
    'enableRainfall' => Yii::t('EffectsModule.base', 'Rainfall'),
];
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success">
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'effectsEnabled')
            ->checkbox() ?>

        <?= $form->field($model, 'selectedEffect')
            ->dropDownList($effectOptions, [
                'prompt' => Yii::t('EffectsModule.base', '- Select Effect -'),
                'disabled' => !$model->effectsEnabled,
            ]) ?>

        <div class="form-group">
            <?= Html::submitButton(
                Yii::t('EffectsModule.base', 'Save'),
                ['class' => 'btn btn-primary']
            ) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
