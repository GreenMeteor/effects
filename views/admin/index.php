<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model gm\humhub\modules\effects\models\Configuration */

$this->title = Yii::t('EffectsModule.base', 'Effects Settings');
$this->params['breadcrumbs'][] = $this->title;
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
            <?= $form->field($model, 'enableSnowfall')->checkbox() ?>
            <?= $form->field($model, 'enableSakuraFall')->checkbox() ?>
            <?= $form->field($model, 'enableLeaffall')->checkbox() ?>
            <?= $form->field($model, 'enableRainfall')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('EffectsModule.base', 'Save'), ['class' => 'btn btn-primary']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
