<?php

namespace gm\humhub\modules\effects;

use yii\helpers\Url;
use humhub\components\Module as BaseModule;
use gm\humhub\modules\effects\models\Configuration;

/**
 * Snowfall module for HumHub.
 */
class Module extends BaseModule
{
    /**
     * @inheritdoc
     */
    public $resourcesPath = 'resources';

    private ?Configuration $configuration = null;

    public function getConfiguration(): Configuration
    {
        if ($this->configuration === null) {
            $this->configuration = new Configuration(['settingsManager' => $this->settings]);
            $this->configuration->loadBySettings();
        }
        return $this->configuration;
    }

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/effects/admin']);
    }
}
