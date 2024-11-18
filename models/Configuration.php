<?php

namespace gm\humhub\modules\effects\models;

use Yii;
use yii\base\Model;
use humhub\components\SettingsManager;

class Configuration extends Model
{
    public ?SettingsManager $settingsManager;

    public bool $enableSakuraFall = false;
    public bool $enableSnowfall = false;
    public bool $enableLeaffall = false;
    public bool $enableRainfall = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enableSakuraFall', 'enableSnowfall', 'enableLeaffall', 'enableRainfall'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'enableSakuraFall' => Yii::t('EffectsModule.base', 'Enable Sakura Fall Effect'),
            'enableSnowfall' => Yii::t('EffectsModule.base', 'Enable Snowfall Effect'),
            'enableLeaffall' => Yii::t('EffectsModule.base', 'Enable Leaf Fall Effect'),
            'enableRainfall' => Yii::t('EffectsModule.base', 'Enable Rain Fall Effect'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'enableSakuraFall' => Yii::t('EffectsModule.base', 'Toggle to enable Sakura Fall effect'),
            'enableSnowfall' => Yii::t('EffectsModule.base', 'Toggle to enable Snowfall effect'),
            'enableLeaffall' => Yii::t('EffectsModule.base', 'Toggle to enable Leaf Fall effect'),
            'enableRainfall' => Yii::t('EffectsModule.base', 'Toggle to enable Rain Fall effect'),
        ];
    }

    /**
     * Load settings from SettingsManager.
     */
    public function loadBySettings(): void
    {
        $this->enableSakuraFall = (bool)$this->settingsManager->get('enableSakuraFall');
        $this->enableSnowfall = (bool)$this->settingsManager->get('enableSnowfall');
        $this->enableLeaffall = (bool)$this->settingsManager->get('enableLeaffall');
        $this->enableRainfall = (bool)$this->settingsManager->get('enableRainfall');
    }

    /**
     * Save settings to SettingsManager.
     */
    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $this->settingsManager->set('enableSakuraFall', $this->enableSakuraFall);
        $this->settingsManager->set('enableSnowfall', $this->enableSnowfall);
        $this->settingsManager->set('enableLeaffall', $this->enableLeaffall);
        $this->settingsManager->set('enableRainfall', $this->enableRainfall);

        return true;
    }
}
