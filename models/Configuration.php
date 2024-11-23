<?php

namespace gm\humhub\modules\effects\models;

use Yii;
use yii\base\Model;
use humhub\components\SettingsManager;

class Configuration extends Model
{
    public ?SettingsManager $settingsManager;
    
    public bool $effectsEnabled = false;
    public string $selectedEffect = '';
    
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
            [['effectsEnabled'], 'boolean'],
            [['selectedEffect'], 'string'],
            [['selectedEffect'], 'in', 'range' => [
                'enableSakuraFall',
                'enableSnowfall',
                'enableLeaffall',
                'enableRainfall',
            ]],
            [['enableSakuraFall', 'enableSnowfall', 'enableLeaffall', 'enableRainfall'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'effectsEnabled' => Yii::t('EffectsModule.base', 'Enable Effects'),
            'selectedEffect' => Yii::t('EffectsModule.base', 'Select Effect'),
            'enableSakuraFall' => Yii::t('EffectsModule.base', 'Sakura Fall Effect'),
            'enableSnowfall' => Yii::t('EffectsModule.base', 'Snowfall Effect'),
            'enableLeaffall' => Yii::t('EffectsModule.base', 'Leaf Fall Effect'),
            'enableRainfall' => Yii::t('EffectsModule.base', 'Rain Fall Effect'),
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

        $this->effectsEnabled = $this->enableSakuraFall || 
            $this->enableSnowfall || 
            $this->enableLeaffall || 
            $this->enableRainfall;

        if ($this->enableSakuraFall) {
            $this->selectedEffect = 'enableSakuraFall';
        } elseif ($this->enableSnowfall) {
            $this->selectedEffect = 'enableSnowfall';
        } elseif ($this->enableLeaffall) {
            $this->selectedEffect = 'enableLeaffall';
        } elseif ($this->enableRainfall) {
            $this->selectedEffect = 'enableRainfall';
        }
    }

    /**
     * Save settings to SettingsManager.
     */
    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $this->enableSakuraFall = false;
        $this->enableSnowfall = false;
        $this->enableLeaffall = false;
        $this->enableRainfall = false;

        if ($this->effectsEnabled && !empty($this->selectedEffect)) {
            $this->{$this->selectedEffect} = true;
        }

        $this->settingsManager->set('enableSakuraFall', $this->enableSakuraFall);
        $this->settingsManager->set('enableSnowfall', $this->enableSnowfall);
        $this->settingsManager->set('enableLeaffall', $this->enableLeaffall);
        $this->settingsManager->set('enableRainfall', $this->enableRainfall);

        return true;
    }
}
