<?php

namespace gm\humhub\modules\effects\assets;

use humhub\modules\ui\view\components\View;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Asset bundle for Effects
 */
class Assets extends AssetBundle
{
    public $sourcePath = '@effects/resources';

    public $js = [
        'js/snowfall.js',
    ];

    /**
     * @inheritdoc
     */
    public static function register($view)
    {
        $config = ['startSnowfall' => true];
        $view->registerJsConfig('effects', $config);
        return parent::register($view);
    }

    public $depends = [
        JqueryAsset::class
    ];
}
