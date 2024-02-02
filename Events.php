<?php

namespace gm\humhub\modules\effects;

use Yii;

class Events
{
    /**
     * Adds a snowfall widget to the layout addons section
     */
    public static function onLayoutAddonsInit($event)
    {
        $event->sender->addWidget(widgets\Snowfall::class);
    }
}
