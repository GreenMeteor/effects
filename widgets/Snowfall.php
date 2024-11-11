<?php

namespace gm\humhub\modules\effects\widgets;

use Yii;
use humhub\components\Widget;
use gm\humhub\modules\effects\assets\Assets;

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
