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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enableSakuraFall'], 'boolean'],
            [['enableSnowfall'], 'boolean'],
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
        ];
    }

    /**
     * Load settings from SettingsManager.
     */
    public function loadBySettings(): void
    {
        $this->enableSakuraFall = (bool)$this->settingsManager->get('enableSakuraFall');
        $this->enableSnowfall = (bool)$this->settingsManager->get('enableSnowfall');
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

        return true;
    }
}
