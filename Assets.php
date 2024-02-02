<?php

namespace gm\humhub\modules\effects;

use humhub\modules\ui\view\components\View;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Asset bundle for Effects
 */
class Assets extends AssetBundle
{
    public $sourcePath = '@effects/resources';

    public $css = [
        'css/humhub-effects.css',
    ];

    public $js = [
        'js/humhub-effects.js',
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