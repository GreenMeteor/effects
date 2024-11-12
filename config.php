<?php

namespace gm\humhub\modules\effects;

use humhub\widgets\LayoutAddons;
use gm\humhub\modules\effects\Module;
use gm\humhub\modules\effects\Events;

return [
    'id' => 'effects',
    'class' => Module::class,
    'namespace' => 'gm\humhub\modules\effects',
    'events' => [
        ['class' => LayoutAddons::class, 'event' => LayoutAddons::EVENT_INIT, 'callback' => [Events::class, 'onLayoutAddonsInit']],
    ]
];
