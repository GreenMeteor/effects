<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model gm\humhub\modules\effects\models\Configuration */

$this->title = Yii::t('EffectsModule.base', 'Effects Settings');
$this->params['breadcrumbs'][] = $this->title;

// Determine which effect is enabled
$enabledEffect = null;
if ($model->enableSakuraFall) {
    $enabledEffect = 'enableSakuraFall';
} elseif ($model->enableSnowfall) {
    $enabledEffect = 'enableSnowfall';
} elseif ($model->enableLeaffall) {
    $enabledEffect = 'enableLeaffall';
} elseif ($model->enableRainfall) {
    $enabledEffect = 'enableRainfall';
}
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

        <?= $form->field($model, 'enableSnowfall')->checkbox([
            'disabled' => $enabledEffect !== null && $enabledEffect !== 'enableSnowfall',
        ]) ?>
        <?= $form->field($model, 'enableSakuraFall')->checkbox([
            'disabled' => $enabledEffect !== null && $enabledEffect !== 'enableSakuraFall',
        ]) ?>
        <?= $form->field($model, 'enableLeaffall')->checkbox([
            'disabled' => $enabledEffect !== null && $enabledEffect !== 'enableLeaffall',
        ]) ?>
        <?= $form->field($model, 'enableRainfall')->checkbox([
            'disabled' => $enabledEffect !== null && $enabledEffect !== 'enableRainfall',
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('EffectsModule.base', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
