<?php

namespace gm\humhub\modules\effects\assets;

use humhub\modules\ui\view\components\View;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use Yii;

/**
 * Asset bundle for Effects
 */
class Assets extends AssetBundle
{
    public $sourcePath = '@effects/resources';

    public $js = [];

    public $depends = [
        JqueryAsset::class,
    ];

    /**
     * Registers assets and applies settings based on configuration.
     *
     * @param \yii\web\View $view The view instance
     * @return Assets
     */
    public static function register($view)
    {
        $module = Yii::$app->getModule('effects');
        
        if ($module === null) {
            throw new \yii\base\InvalidConfigException("Module 'effects' is not available.");
        }

        $settingsManager = $module->getConfiguration();

        $asset = new self();

        if ($settingsManager->enableSnowfall) {
            $asset->js[] = 'js/snowfall.js';
            $view->registerJsConfig('effects', ['startSnowfall' => true]);
        } elseif ($settingsManager->enableSakuraFall) {
            $asset->js[] = 'js/sakurafall.js';
            $view->registerJsConfig('effects', ['startSakuraFall' => true]);
        } elseif ($settingsManager->enableLeaffall) {
            $asset->js[] = 'js/leaffall.js';
            $view->registerJsConfig('effects', ['startLeafFall' => true]);
        } elseif ($settingsManager->enableRainfall) {
            $asset->js[] = 'js/rainfall.js';
            $view->registerJsConfig('effects', ['startRainFall' => true]);
        }

        $asset->publish($view->getAssetManager());

        $asset->registerAssetFiles($view);

        return $asset;
    }
}
