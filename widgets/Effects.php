<?php

namespace gm\humhub\modules\effects\widgets;

use Yii;
use humhub\components\Widget;
use gm\humhub\modules\effects\assets\Assets;

/**
 * Effects widget to add visual effects (Snowfall/SakuraFall) to the page
 */
class Effects extends Widget
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $view = $this->getView();

        // Get the module instance
        $module = Yii::$app->getModule('effects');
        
        // Ensure the module is available
        if ($module === null) {
            throw new \yii\base\InvalidConfigException("Module 'effects' is not available.");
        }

        // Access the settings manager directly from the module
        $settingsManager = $module->getConfiguration();

        // Register the appropriate assets based on the settings
        $asset = new Assets();

        // Check if Snowfall or Sakura Fall should be enabled based on the settings
        if ($settingsManager->enableSnowfall) {
            $asset->js[] = 'js/snowfall.js'; // Register Snowfall script
        } elseif ($settingsManager->enableSakuraFall) {
            $asset->js[] = 'js/sakurafall.js'; // Register Sakura Fall script
        }

        // Register the assets with the view
        $asset->register($view);

        // Return an empty string as we don't render content directly
        return '';
    }
}
