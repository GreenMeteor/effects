<?php

namespace gm\humhub\modules\effects\widgets;

use humhub\components\Widget;
use gm\humhub\modules\effects\Assets;
use Yii;

/**
 * Snowfall widget to add falling snow effect to the page
 */
class Snowfall extends Widget
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $view = $this->getView();
        Assets::register($view);

        return '';
    }
}